<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\bibliothequeController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\panierController;
use App\Http\Controllers\produitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//public route
Route::post('/login', [authController::class, 'login']);
Route::post('/logout', [authController::class, 'logout']);
Route::get('/register', [authController::class, 'register']);
Route::get('/', [clientController::class, 'index']);
Route::post('/signin', [clientController::class, 'signin']);
Route::post('/signup', [clientController::class, 'store']);

//protected route
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/getProduit', [produitController::class, 'show']);
    Route::post('/addProduit', [produitController::class, 'store']);
    Route::post('/updateProduit', [produitController::class, 'update']);
    Route::post('/getPanier', [panierController::class, 'show']);
    Route::post('/addPanier', [panierController::class, 'store']);
    Route::post('/getBiblio', [bibliothequeController::class, 'show']);
    Route::post('/addBiblio', [bibliothequeController::class, 'store']);
});

//Route::resource('tasks',authController::class);
