<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{UserController, MedicController, MyRecomendationController, MyVisitController, ProfileAmbulanceController};

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/medics', [MedicController::class, 'index']);

    Route::get('/myvisits', [MyVisitController::class, 'index']);
    Route::post('/myvisits', [MyVisitController::class, 'store']);


    Route::get('/myvisits/{visit}', [MyVisitController::class, 'show']);
    Route::patch('/myvisits/{visit}', [MyVisitController::class, 'update']);


    Route::get('/update', [UserController::class, 'edit']);
    Route::patch('/update/{user}', [UserController::class, 'update']);

});



Route::prefix('medic')->group(function () {
    Route::post('/login', [MedicController::class, 'login']);
    Route::group(['middleware' => ['auth:medic']], function () {
        Route::controller(MedicController::class)->group(function () {
            Route::post('/register', 'store');
            Route::post('/logout', 'logout');
            Route::get('/update', 'edit');
            Route::patch('/update/{medic}', 'update');
        });

        Route::controller(MyVisitController::class)->group(function () {
            Route::get('/visits', 'medic_index');
            Route::patch('/visit/{visit}', 'people_came');

        });

        Route::controller(MyRecomendationController::class)->group(function () {
            Route::post('/recomendation', 'store');
            Route::patch('/recomendation/{recomendation}', 'update');
        });

        Route::controller(ProfileAmbulanceController::class)->group(function () {
            Route::get('/specialization', 'index');
            Route::post('/specialization', 'store');
            Route::patch('/specialization/{specialization}', 'update');
        });



        // Route::post('/specialization', [ProfileAmbulanceController::class, 'store']);

        // Route::get('/update', [MedicController::class, 'edit']);
        // Route::patch('/update/{medic}', [MedicController::class, 'update']);
        // Route::post('/register', [MedicController::class, 'store']);
        // Route::post('/logout', [MedicController::class, 'logout']);

        // Route::patch('/visit/{visit}', [MyVisitController::class, 'people_came']);
        // Route::get('/visits', [MyVisitController::class, 'medic_index']);

        // Route::post('/recomendation', [MyRecomendationController::class, 'store']);
        // Route::patch('/recomendation/{recomendation}', [MyRecomendationController::class, 'update']);
    });
});