<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("admin")->group(function () {
  Route::get('/login', [UserController::class, 'login'])->name('admin.login');
  Route::post('/postsignin', [UserController::class, 'postSignin'])->name('admin.postSignin');
  Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
  Route::get('/getlogout', [UserController::class, 'getLogout'])->name('admin.getlogout');
});

Route::prefix("admin")->middleware('auth')->group(function () {
 Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
 Route::get('/getallusers', [UserController::class, 'getAllUsers'])->name('admin.getallusers');
});