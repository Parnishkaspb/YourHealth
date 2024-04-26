<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});


