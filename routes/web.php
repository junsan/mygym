<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', DashboardController::class)->middleware('auth')->name('dashboard');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard', function() {
    return view('admin.dashboard');
})->middleware(['auth'])->name('admin.dashboard');

Route::get('/instructor/dashboard', function() {
    return view('instructor.dashboard');
})->middleware(['auth'])->name('instructor.dashboard');

Route::get('/member/dashboard', function() {
    return view('member.dashboard');
})->middleware(['auth'])->name('member.dashboard');