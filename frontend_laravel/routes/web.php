<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [UserController::class, 'login'])->name('postLogin');
Route::get('/logout', [UserController::class, 'logout'])->name('logoutUser');

Route::get('/showRegister', [UserController::class, 'showRegister'])->name('showRegister');
Route::post('/register', [UserController::class, 'register'])->name('postRegister');

Route::get('/admin', [UserController::class, 'showAdmin'])->name('showAdmin');
Route::get('/user', [UserController::class, 'showUser'])->name('showUser');

Route::get('/showAddUser', [UserController::class, 'showAddUser'])->name('showAddUser');
Route::post('/addUser', [UserController::class, 'adduser'])->name('postAddUser');

Route::get('/showUpdateUser/{id}', [UserController::class, 'showUpdateUser'])->name('showUpdateUser');
Route::post('/updateUser/{id}', [UserController::class, 'updateuser'])->name('postUpdateUser');

Route::post('/deleteUser/{id}', [UserController::class, 'deleteuser'])->name('postDeleteUser');




