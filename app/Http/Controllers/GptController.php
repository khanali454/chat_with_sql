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


    $tables = "CREATE TABLE `action` (
            `Id` int(10) NOT NULL,
            `Module` varchar(50) NOT NULL,
            `Record` int(11) NOT NULL,
            `User` int(10) NOT NULL,
            `Add_Date` datetime NOT NULL,
            `Type` varchar(20) NOT NULL,
            `Page` varchar(50) NOT NULL,
            `Details` text NOT NULL,
            PRIMARY KEY (Id)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          CREATE TABLE `ads` (
            `ID` int(11) NOT NULL,
            `title` varchar(255) NOT NULL,
            `place` varchar(255) NOT NULL,
            `town` varchar(30) NOT NULL,
            `type` varchar(30) NOT NULL,
            `member` int(10) NOT NULL,
            `case` varchar(30) NOT NULL,
            `mobile` varchar(30) NOT NULL,
            `email` varchar(30) NOT NULL,
            `photo1` text NOT NULL,
            `small_photo1` text NOT NULL,
            `photo2` text NOT NULL,
            `photo3` text NOT NULL,
            `photo4` text NOT NULL,
            `photo5` text NOT NULL,
            `prise` varchar(30) NOT NULL,
            `detail` text NOT NULL,
            `video` text NOT NULL,
            `cat` int(10) NOT NULL,
            `add_date` date NOT NULL DEFAULT '0000-00-00',
            `visit` int(10) NOT NULL,
            `add_by` int(10) NOT NULL,
            `lang` varchar(10) NOT NULL,
            `active` varchar(10) NOT NULL
            PRIMARY KEY (ID)
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          CREATE TABLE `attach` (
            `ID` int(10) NOT NULL,
            `Name` int(10) NOT NULL,
            `Module` varchar(20) NOT NULL,
            `Request` int(10) NOT NULL,
            `Invoice` varchar(200) NOT NULL,
            `Deleted` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          CREATE TABLE `booking` (
            `ID` int(10) NOT NULL,
            `name` varchar(255) NOT NULL,
            `mobile` varchar(100) NOT NULL,
            `email` varchar(200) NOT NULL,
            `room1` int(10) NOT NULL,
            `room2` int(10) NOT NULL,
            `room3` int(10) NOT NULL,
            `kids12` int(10) NOT NULL,
            `kids6` int(10) NOT NULL,
            `infant` int(10) NOT NULL,
            `comment` text NOT NULL,
            `program` int(10) NOT NULL,
            `add_date` date NOT NULL,
            `ip` varchar(100) NOT NULL,
            `seen` varchar(10) NOT NULL,
            PRIMARY KEY (ID)
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `booking_amount` (
            `ID` int(10) NOT NULL,
            `title` varchar(255) NOT NULL,
            `customer` int(10) NOT NULL,
            `amount` int(50) NOT NULL,
            `points` int(10) NOT NULL,
            `details` text NOT NULL,
            `booking_date` date NOT NULL,
            `employee` int(10) NOT NULL,
            `add_date` date NOT NULL,
            `active` varchar(10) NOT NULL,
            PRIMARY KEY (ID)
          
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          CREATE TABLE `category` (
            `ID` int(11) NOT NULL,
            `name` varchar(255) NOT NULL,
            `img` varchar(255) NOT NULL,
            `details` text NOT NULL,
            `img2` varchar(100) NOT NULL,
            `photo` varchar(100) NOT NULL,
            `sub` int(11) NOT NULL DEFAULT 0,
            `type` varchar(20) NOT NULL,
            `lang` varchar(10) NOT NULL,
            `main_show` varchar(10) NOT NULL,
            `position` varchar(10) NOT NULL,
            `news_no` int(2) NOT NULL DEFAULT 0,
            `active` varchar(25) NOT NULL,
            `add_by` int(11) NOT NULL DEFAULT 0,
            `order` varchar(5) NOT NULL,
            `degree` char(2) NOT NULL,
            `description` varchar(255) NOT NULL,
            `header` text NOT NULL,
            `footer` text NOT NULL,
            `num` int(3) NOT NULL DEFAULT 0,
            `row_num` int(3) NOT NULL DEFAULT 0,
            `percent` int(3) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `clients` (
            `ID` int(10) NOT NULL,
            `Name` varchar(255) NOT NULL,
            `Phone` varchar(50) NOT NULL,
            `City` varchar(200) NOT NULL,
            `Nationality` varchar(200) NOT NULL,
            `Referral` varchar(255) NOT NULL,
            `Active` int(5) NOT NULL DEFAULT 1,
            `Deleted` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `corprate` (
            `ID` int(10) NOT NULL,
            `name` varchar(255) NOT NULL,
            `mobile1` varchar(100) NOT NULL,
            `mobile2` varchar(20) NOT NULL,
            `nation_id` varchar(20) NOT NULL,
            `corporate_name` varchar(200) NOT NULL,
            `branch` varchar(200) NOT NULL,
            `town` varchar(100) NOT NULL,
            `job` varchar(100) NOT NULL,
            `address1` varchar(255) NOT NULL,
            `address2` varchar(255) NOT NULL,
            `email` varchar(100) NOT NULL,
            `points` int(100) NOT NULL,
            `password` varchar(100) NOT NULL,
            `thecode` varchar(100) NOT NULL,
            `active` varchar(10) NOT NULL,
            `add_date` date NOT NULL,
            PRIMARY KEY (ID)
          
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `country` (
            `ID` int(3) NOT NULL,
            `name` varchar(200) NOT NULL,
            `flag` varchar(100) NOT NULL,
            `active` varchar(10) NOT NULL,
            `lang` varchar(10) NOT NULL,
            PRIMARY KEY (ID)
          
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `customer` (
            `ID` int(10) NOT NULL,
            `name` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `password` varchar(100) NOT NULL,
            `identity` varchar(100) NOT NULL,
            `mobile` varchar(255) NOT NULL,
            `phone` varchar(255) NOT NULL,
            `details` text NOT NULL,
            `add_date` date NOT NULL,
            `last_login` datetime NOT NULL,
            `active` varchar(10) NOT NULL,
            PRIMARY KEY (ID)
          
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `customers` (
            `ID` int(11) NOT NULL,
            `title` varchar(255) NOT NULL,
            `country` varchar(50) NOT NULL,
            `town` varchar(30) NOT NULL,
            `type` varchar(30) NOT NULL,
            `member` int(10) NOT NULL,
            `case` varchar(30) NOT NULL,
            `mobile` varchar(30) NOT NULL,
            `email` varchar(30) NOT NULL,
            `photo1` text NOT NULL,
            `small_photo1` text NOT NULL,
            `photo2` text NOT NULL,
            `photo3` text NOT NULL,
            `photo4` text NOT NULL,
            `photo5` text NOT NULL,
            `prise` varchar(30) NOT NULL,
            `detail` text NOT NULL,
            `video` text NOT NULL,
            `cat` int(10) NOT NULL,
            `add_date` date NOT NULL DEFAULT '0000-00-00',
            `visit` int(10) NOT NULL,
            `add_by` int(10) NOT NULL,
            `lang` varchar(10) NOT NULL,
            `active` varchar(10) NOT NULL,
            PRIMARY KEY (ID)
          
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `days` (
            `ID` int(10) NOT NULL,
            `DETAILS` varchar(255) NOT NULL,
            `MODULE` varchar(100) NOT NULL,
            `Request` int(10) NOT NULL,
            `DELETED` int(10) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `fhrequest` (
            `ID` int(10) NOT NULL,
            `Source` varchar(200) NOT NULL,
            `Destination` varchar(200) NOT NULL,
            `Going_Date` date NOT NULL,
            `Going_Departure` varchar(100) NOT NULL,
            `Going_Arrival` varchar(100) NOT NULL,
            `Returning_Date` date NOT NULL,
            `Returning_Departure` varchar(100) NOT NULL,
            `Returning_Arrival` varchar(100) NOT NULL,
            `Degree` varchar(200) NOT NULL,
            `Carrier` varchar(200) NOT NULL,
            `Hotel` varchar(200) NOT NULL,
            `Stars` varchar(100) NOT NULL,
            `Check_In` date NOT NULL,
            `Check_Out` date NOT NULL,
            `City` varchar(200) NOT NULL,
            `Room_Type` varchar(100) NOT NULL,
            `Confirmation_No1` varchar(100) NOT NULL,
            `Confirmation_No2` varchar(200) NOT NULL,
            `Price` double NOT NULL,
            `Price2` varchar(200) NOT NULL,
            `Details` text NOT NULL,
            `Roles1` text NOT NULL,
            `Roles2` text NOT NULL,
            `Client` int(10) NOT NULL,
            `Persons` varchar(255) NOT NULL,
            `Employee` varchar(255) NOT NULL,
            `Approved` int(5) NOT NULL DEFAULT 0,
            `Active` int(5) NOT NULL DEFAULT 1,
            `Deleted` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `flights` (
            `ID` int(10) NOT NULL,
            `From` varchar(200) NOT NULL,
            `To` varchar(200) NOT NULL,
            `Flight_Date` date NOT NULL,
            `Time_From` varchar(100) NOT NULL,
            `Time_To` varchar(100) NOT NULL,
            `Carrier` varchar(200) NOT NULL,
            `Type` varchar(100) NOT NULL,
            `Request` int(10) NOT NULL,
            `DELETED` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `frequest` (
            `ID` int(10) NOT NULL,
            `Flights` int(5) NOT NULL DEFAULT 0,
            `Hotels` int(5) NOT NULL DEFAULT 0,
            `Includes` int(5) NOT NULL DEFAULT 0,
            `Days` int(5) NOT NULL DEFAULT 0,
            `Visa` int(5) NOT NULL DEFAULT 0,
            `Destinations` int(10) NOT NULL,
            `Flight_Type` varchar(100) NOT NULL,
            `Source` varchar(200) NOT NULL,
            `Destination` varchar(200) NOT NULL,
            `Going_Date` date NOT NULL,
            `Going_Departure` varchar(100) NOT NULL,
            `Going_Arrival` varchar(100) NOT NULL,
            `Returning_Date` date NOT NULL,
            `Returning_Departure` varchar(100) NOT NULL,
            `Returning_Arrival` varchar(100) NOT NULL,
            `Degree` varchar(200) NOT NULL,
            `Carrier` varchar(200) NOT NULL,
            `Detail` text NOT NULL,
            `Notes` text NOT NULL,
            `Travel_Notes` text NOT NULL,
            `Roles1` text NOT NULL,
            `Roles2` text NOT NULL,
            `Client` int(10) NOT NULL,
            `Price` double NOT NULL,
            `Price2` varchar(200) NOT NULL,
            `Pinned` int(5) NOT NULL DEFAULT 5,
            `Service_Start` date NOT NULL,
            `Service_End` date NOT NULL,
            `Adult_Price` double NOT NULL,
            `Child_Price` double NOT NULL,
            `Infant_Price` double NOT NULL,
            `Confirmation_No` varchar(100) NOT NULL,
            `Persons` varchar(255) NOT NULL,
            `Employee` varchar(255) NOT NULL,
            `Type` varchar(100) NOT NULL,
            `Copied` int(10) NOT NULL,
            `Active` int(5) NOT NULL DEFAULT 1,
            `Deleted` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `hotels` (
            `ID` int(11) NOT NULL,
            `NAME` varchar(255) NOT NULL,
            `DEGREE` int(10) NOT NULL,
            `DESTINATION` varchar(200) NOT NULL,
            `NIGHTS` int(10) NOT NULL,
            `Check_In` varchar(50) NOT NULL,
            `Check_Out` varchar(50) NOT NULL,
            `Room_Type` varchar(100) NOT NULL,
            `PHOTO` varchar(100) NOT NULL,
            `Request` int(10) NOT NULL,
            `DELETED` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci
          
          CREATE TABLE `include` (
            `ID` int(10) NOT NULL,
            `Details` text NOT NULL,
            `Module` varchar(100) NOT NULL,
            `Request` int(10) NOT NULL,
            `Deleted` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci
          
          CREATE TABLE `notifications` (
            `ID` int(10) NOT NULL,
            `Name` text NOT NULL,
            `Type` varchar(200) NOT NULL,
            `Category` varchar(100) NOT NULL,
            `Active` int(5) NOT NULL DEFAULT 1,
            `Deleted` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci
          
          CREATE TABLE `orequest` (
            `ID` int(10) NOT NULL,
            `Service` varchar(200) NOT NULL,
            `Price` double NOT NULL,
            `Price2` varchar(200) NOT NULL,
            `Details` text NOT NULL,
            `Roles1` text NOT NULL,
            `Roles2` text NOT NULL,
            `Client` int(10) NOT NULL,
            `Persons` varchar(255) NOT NULL,
            `Employee` varchar(255) NOT NULL,
            `Active` int(5) NOT NULL DEFAULT 1,
            `Deleted` int(5) NOT NULL DEFAULT 0.
            PRIMARY KEY (ID)
          
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          CREATE TABLE `payment` (
            `ID` int(10) NOT NULL,
            `Request` int(11) NOT NULL,
            `Method` varchar(255) NOT NULL,
            `Amount` double NOT NULL,
            `Code` varchar(50) NOT NULL,
            `ApprovedBy` int(5) NOT NULL,
            `Active` int(5) NOT NULL DEFAULT 1,
            `Deleted` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          CREATE TABLE `photo` (
            `ID` int(11) NOT NULL,
            `name` varchar(255) NOT NULL DEFAULT '',
            `small_pic` varchar(255) NOT NULL DEFAULT '0',
            `larg_pic` varchar(255) NOT NULL DEFAULT '0',
            `visit` int(11) NOT NULL DEFAULT 0,
            `adddate` date NOT NULL DEFAULT '0000-00-00',
            `addby` int(11) NOT NULL DEFAULT 0,
            `active` varchar(30) NOT NULL DEFAULT '',
            `print` varchar(30) NOT NULL DEFAULT '',
            `detail` varchar(255) NOT NULL DEFAULT '',
            `cat` int(11) NOT NULL DEFAULT 0,
            `send2f` varchar(20) NOT NULL DEFAULT '',
            `lang` varchar(10) NOT NULL DEFAULT '',
            PRIMARY KEY (ID)
          
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `price` (
            `ID` int(10) NOT NULL,
            `Supplier` int(10) NOT NULL,
            `Module` varchar(20) NOT NULL,
            `Request` int(10) NOT NULL,
            `Net_Price` double NOT NULL,
            `Sale_Price` double NOT NULL,
            `Method` varchar(255) NOT NULL,
            `Currency` varchar(200) NOT NULL,
            `Invoice` varchar(200) NOT NULL,
            `Deleted` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `program` (
            `ID` int(10) NOT NULL,
            `TITLE` varchar(255) NOT NULL,
            `ABOUT` text NOT NULL,
            `PERIOD` varchar(100) NOT NULL,
            `TOWNS` varchar(255) NOT NULL,
            `PRICE` varchar(100) NOT NULL,
            `TERMS` text NOT NULL,
            `INCLUDES` text NOT NULL,
            `DETAILS` text NOT NULL,
            `CATEGORY` int(10) NOT NULL,
            `is_Flight` int(10) NOT NULL,
            `is_Reception` int(10) NOT NULL,
            `is_Transfer` int(10) NOT NULL,
            `is_Hotel` int(10) NOT NULL,
            `is_Breakfast` int(10) NOT NULL,
            `is_HalfBoard` int(10) NOT NULL,
            `is_Allinclusive` int(10) NOT NULL,
            `is_Tours` int(10) NOT NULL,
            `is_Visa` int(10) NOT NULL,
            `is_Sim` int(10) NOT NULL,
            `is_Wifi` int(5) NOT NULL DEFAULT 0,
            `PHOTO1` varchar(255) NOT NULL,
            `PHOTO2` varchar(255) NOT NULL,
            `PHOTO3` varchar(255) NOT NULL,
            `PHOTO4` varchar(255) NOT NULL,
            `PHOTO5` varchar(255) NOT NULL,
            `MODULE` varchar(200) NOT NULL,
            `ADD_DATE` varchar(100) NOT NULL,
            `ACTIVE` int(10) NOT NULL,
            `DELETED` int(10) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `program2` (
            `ID` int(10) NOT NULL,
            `name` varchar(255) NOT NULL,
            `seo` varchar(255) NOT NULL,
            `tags` text NOT NULL,
            `price` int(50) NOT NULL,
            `price_for` varchar(255) NOT NULL,
            `Stars` int(3) NOT NULL,
            `price2` int(50) DEFAULT NULL,
            `period` varchar(200) NOT NULL,
            `detail` text NOT NULL,
            `photo` varchar(255) NOT NULL,
            `photo1` varchar(200) NOT NULL,
            `small_photo1` varchar(100) NOT NULL,
            `photo2` varchar(200) NOT NULL,
            `photo3` varchar(200) NOT NULL,
            `photo4` varchar(200) NOT NULL,
            `photo5` varchar(200) NOT NULL,
            `conditions` text NOT NULL,
            `include1` varchar(255) NOT NULL,
            `include2` varchar(255) NOT NULL,
            `include3` varchar(255) NOT NULL,
            `include4` varchar(255) NOT NULL,
            `include5` varchar(255) NOT NULL,
            `include6` varchar(255) NOT NULL,
            `include7` varchar(255) NOT NULL,
            `include8` varchar(255) NOT NULL,
            `include9` varchar(255) NOT NULL,
            `include10` varchar(255) NOT NULL,
            `category` int(10) NOT NULL,
            `active` varchar(10) NOT NULL,
            `add_date` date NOT NULL,
            `lang` varchar(10) NOT NULL,
            PRIMARY KEY (ID)
          
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `program3` (
            `ID` int(10) NOT NULL,
            `name` varchar(255) NOT NULL,
            `cities` varchar(255) NOT NULL,
            `seo` varchar(255) NOT NULL,
            `tags` text NOT NULL,
            `price` int(50) NOT NULL,
            `country` int(10) NOT NULL,
            `period` varchar(200) NOT NULL,
            `going` text NOT NULL,
            `returning` text NOT NULL,
            `towns` text NOT NULL,
            `video` text NOT NULL,
            `details` text NOT NULL,
            `feature` text NOT NULL,
            `conditions` text NOT NULL,
            `photo1` varchar(200) NOT NULL,
            `small_photo1` varchar(100) NOT NULL,
            `photo2` varchar(200) NOT NULL,
            `photo3` varchar(200) NOT NULL,
            `photo4` varchar(200) NOT NULL,
            `photo5` varchar(200) NOT NULL,
            `price_room1` int(100) NOT NULL,
            `price_room2` int(100) NOT NULL,
            `price_room3` int(100) NOT NULL,
            `price_kids12` int(100) NOT NULL,
            `price_kids6` int(100) NOT NULL,
            `price_infant` int(100) NOT NULL,
            `active` varchar(10) NOT NULL,
            `add_date` date NOT NULL,
            `lang` varchar(10) NOT NULL,
            PRIMARY KEY (ID)
          
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `rating` (
            `ID` int(10) NOT NULL,
            `Name` varchar(255) NOT NULL,
            `Category` varchar(100) NOT NULL,
            `Pinned` int(5) NOT NULL DEFAULT 0,
            `Details` text NOT NULL,
            `Notes` text NOT NULL,
            `Active` int(5) NOT NULL DEFAULT 1,
            `Deleted` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID),
            PRIMARY KEY (ID)
          
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          CREATE TABLE `request` (
            `ID` int(10) NOT NULL,
            `Destination` int(10) NOT NULL,
            `Client` int(10) NOT NULL,
            `Hotel` varchar(200) NOT NULL,
            `Stars` varchar(100) NOT NULL,
            `Check_In` date NOT NULL,
            `Check_Out` date NOT NULL,
            `City` varchar(200) NOT NULL,
            `Persons` varchar(50) NOT NULL,
            `Room_Type` varchar(100) NOT NULL,
            `Confirmation_No` varchar(100) NOT NULL,
            `Price` double NOT NULL,
            `Price2` varchar(200) NOT NULL,
            `Employee` varchar(100) NOT NULL,
            `Details` text NOT NULL,
            `Roles1` text NOT NULL,
            `Roles2` text NOT NULL,
            `Active` int(5) NOT NULL DEFAULT 1,
            `Deleted` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `roles` (
            `ID` int(11) NOT NULL,
            `Name` varchar(255) NOT NULL,
            `Permission` text NOT NULL,
            `Active` int(5) NOT NULL DEFAULT 1,
            `Deleted` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `suppliers` (
            `ID` int(10) NOT NULL,
            `Name` varchar(255) NOT NULL,
            `Category` varchar(255) NOT NULL,
            `Url` varchar(255) NOT NULL,
            `Destinations` text NOT NULL,
            `Type` varchar(50) NOT NULL,
            `Active` int(10) NOT NULL DEFAULT 1,
            `Deleted` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `target` (
            `ID` int(10) NOT NULL,
            `Employee` int(10) NOT NULL,
            `Amount` double NOT NULL,
            `Tdate` date NOT NULL,
            `Active` int(5) NOT NULL DEFAULT 1,
            `Deleted` int(5) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `terms` (
            `ID` int(11) NOT NULL,
            `Name` varchar(255) NOT NULL,
            `Details` text NOT NULL,
            `Type` varchar(200) NOT NULL,
            `Active` int(5) DEFAULT 1,
            PRIMARY KEY (ID)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `users` (
            `ID` int(10) NOT NULL,
            `NAME` varchar(100) NOT NULL,
            `USERNAME` varchar(100) NOT NULL,
            `PASSWORD` varchar(255) NOT NULL,
            `ACTIVE` varchar(20) NOT NULL,
            `STAFF` int(10) NOT NULL,
            `STATUS` varchar(100) NOT NULL,
            `IS_ADMIN` varchar(10) NOT NULL,
            `ROLES` varchar(255) NOT NULL,
            `ADD_DATE` datetime NOT NULL,
            `LAST_LOGIN` datetime NOT NULL,
            `TIMESTAMP` int(50) NOT NULL,
            `DELETED` int(10) NOT NULL DEFAULT 0,
            PRIMARY KEY (ID)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
          
          
          
          CREATE TABLE `worktime` (
            `ID` int(11) NOT NULL,
            `Day` varchar(100) NOT NULL,
            `From1` text NOT NULL,
            `To1` text NOT NULL,
            `From2` text NOT NULL,
            `To2` text NOT NULL,
            `Employee` int(10) NOT NULL,
            `Active` int(5) NOT NULL DEFAULT 1,
            PRIMARY KEY (ID)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";

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
