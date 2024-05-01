<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController, MedicController, MyVisitController, ProfileAmbulanceController};



Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/medics', [MedicController::class, 'index']);

    Route::get('/myvisits', [MyVisitController::class, 'index']);
    Route::post('/myvisits', [MyVisitController::class, 'store']);


    Route::get('/myvisits/{visit}', [MyVisitController::class, 'show']);
    Route::patch('/myvisits/{visit}', [MyVisitController::class, 'update']);
});



Route::prefix('medic')->group(function () {
    Route::post('/login', [MedicController::class, 'login']);
    Route::group(['middleware' => ['auth:medic']], function () {
        Route::post('/register', [MedicController::class, 'store']);
        Route::post('/logout', [MedicController::class, 'logout']);
        Route::post('/specialization', [ProfileAmbulanceController::class, 'store']);


        Route::patch('/visit/{visit}', [MyVisitController::class, 'people_came']);
    });
});