<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GptController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// front look
Route::get('/', function(){
    return view('chatbox');
});

// to do post request
Route::post("/miner", [GptController::class, "index"])->name("sendreq");


