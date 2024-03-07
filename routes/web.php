<?php

use App\Livewire\AddModalForm;
use App\Livewire\IndexComponent;
use App\Livewire\UserDashBoard;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Livewire\Livewire;

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

Route::get('/', [Controller::class, 'index']);

// Route::get('/', function () {
//     return view('index');
// });
// Routes for both admin and user
Route::post('/create-user', [UserController::class, 'createUser']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

// Routes for user only
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user_dashboard', [UserController::class, 'userDashboard']);
});

// Routes for admin only
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin_dashboard', [UserController::class, 'adminDashboard']);
    Route::post('/addUser', [UserController::class, 'addUser']);
    Route::post('/editUser', [UserController::class, 'editUser']);
    Route::delete('/deleteUser', [UserController::class, 'deleteUser']);
});

// Route::get('/', IndexComponent::class);

// Route::get('/user', [UserDashboard::class, 'mount']);
// Route::get('/login', UserDashBoard::class)->name('login');
// Route::get('/addUser', [AddModalForm::class, 'addUser']);
