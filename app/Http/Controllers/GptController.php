<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\DB;

class GptController extends Controller
{

  public function index(Request $request)
  {
    $question = $request->input('question');

    $tables = "CREATE TABLE customers (
      customer_id INT PRIMARY KEY,
      first_name VARCHAR(50),
      last_name VARCHAR(50),
      email VARCHAR(100),
      gender ENUM('M', 'F'),
      country VARCHAR(50)
    );
    
    CREATE TABLE `categories` (
      `CategoryID` int(11) NOT NULL,
      `CategoryName` varchar(100) NOT NULL
    );
    
    CREATE TABLE `products` (
      `product_id` int(11) NOT NULL,
      `ProductName` varchar(100) NOT NULL,
      `Description` text DEFAULT NULL,
      `Price` decimal(10,2) NOT NULL,
      `StockQuantity` int(11) NOT NULL DEFAULT 0,
      `CategoryID` int(11) DEFAULT NULL,
       FOREIGN KEY (CategoryID) REFERENCES categories(CategoryID)
    );
    
    CREATE TABLE orders (
      order_id INT PRIMARY KEY,
      customer_id INT,
      order_date DATETIME,
      status ENUM('placed', 'shipped', 'delivered'),
      shipping_country VARCHAR(50),
      shipping_speed ENUM('standard', 'express'),
      discount DECIMAL(5, 2),
      total DECIMAL(10, 2),
      FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
    );
    
    CREATE TABLE order_items (
    order_id INT,
    product_id INT,
    quantity INT,
    price DECIMAL(10, 2),
    PRIMARY KEY (order_id, product_id),
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
    );
    
    CREATE TABLE reviews (
    review_id INT PRIMARY KEY,
    customer_id INT,
    product_id INT,
    rating INT,
    review_text VARCHAR(500),
    review_date DATETIME,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
    );
    ";

    $messages = [
      ['role' => 'system', 'content' => "You are a helpful assistant that knows a lot about SQL language and manages a database.
            You are using MySQL dbms.
            You MUST answer only with the SQL query for that query and don't wrap it into a code block. Don't include any explanation.Don't add any line breaks or string escaps or special characters.
            Today is " . Date('d-m-Y H:i:s') . ",
            The database tables are: {$tables}"],
      ['role' => 'user', 'content' => $question],
    ];
    $result = OpenAI::chat()->create([
      'model' => 'gpt-3.5-turbo-1106',
      'messages' => $messages,
    ]);



    $sqlQuery = Arr::get($result, str_replace("\\n", "", "choices.0.message.content"));
    $db_result = $this->runRaw($sqlQuery);

    if ($db_result == "") {
      return json_encode(array(
        "success" => false,
        "question" => $question,
        "query" => $sqlQuery,
        "db_result" => $db_result,
        "nl_response" => "",
        "msg" => "Your question does not align with database schema"
      ));
    } else {
      return json_encode($this->sqlToNatural($question, $sqlQuery, json_encode($db_result)));
    }
  }

  public function runRaw($sql)
  {
    return DB::select($sql);
  }
  public function sqlToNatural($question, $sqlQuery, $db_result)
  {
    $messages = [
      ['role' => 'system', 'content' => "You are a helpful assistant , Your job is to convert sql response to natural langauge, you will be given user question, sql query and response of that query so your job will be to understand question , query and sql response data to convert that into natural language as user question's language"],
      ['role' => 'user', 'content' => "
        user question : {$question},
        sql query : {$sqlQuery},
        result of that query : {$db_result},
        Please convert this query result in natural language. Use same language as question for answer
        "],
    ];

    $result = OpenAI::chat()->create([
      'model' => 'gpt-3.5-turbo-1106',
      'messages' => $messages,
    ]);

    $response = Arr::get($result, str_replace("\\n", "", "choices.0.message.content"));

    return array(
      "success" => true,
      "question" => $question,
      "query" => $sqlQuery,
      "db_result" => $db_result,
      "nl_response" => $response,
    );
  }
}
