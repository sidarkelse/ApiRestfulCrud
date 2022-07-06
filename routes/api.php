<?php

use App\Http\Controllers\ApiController;
use GuzzleHttp\Promise\Create;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('students',[ApiController::class,'AllStudent']);
Route::get('students/{id}',[ApiController::class,'getStudents']);
Route::post('students', [ApiController::class,'createStudent']);
Route::put('students/{id}',[ApiController::class,'updateStudent']);
Route::delete('students/{id}',[ApiController::class,'deleteStudent']);

//API RESTful
