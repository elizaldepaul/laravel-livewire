<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/create-user', [UserController::class, 'createUser']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

// Routes for user only
Route::middleware(['auth', 'user'])->group(function () {
    
});

// Routes for admin only
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin_dashboard', [UserController::class, 'adminDashboard']);
    Route::post('/addUser', [UserController::class, 'addUser']);
    Route::post('/editUser', [UserController::class, 'editUser']);
    Route::delete('/deleteUser', [UserController::class, 'deleteUser']);
});
Route::get('/user_dashboard', [UserController::class, 'userDashboard']);    