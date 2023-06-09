<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// dd(123);

Route::post('/subscribe/messages', 'TelegramBotController@subscribeMessage');
Route::post('/set/webhook', 'TelegramBotController@setWebHook');
Route::get('/get/updates', 'TelegramBotController@getWebHookUpdates');
Route::get('/mylaravel/bot', 'TelegramBotController@getWebHookUpdates');
// use Mpociot\BotMan\BotMan;
// $botman = app('botman');
Route::post('/bot', 'TelegramBotController@laravelBot');
