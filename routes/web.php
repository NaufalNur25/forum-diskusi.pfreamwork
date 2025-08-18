<?php

use App\Http\Controllers\Authentication as AuthService;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('home');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthService\LoginController::class, 'view'])->name('authentication.login');
    Route::post('/login', [AuthService\LoginController::class, 'login'])->name('authentication.login.action');
    Route::get('/register', [AuthService\RegisterController::class, 'view'])->name('authentication.register');
    Route::post('/register', [AuthService\RegisterController::class, 'register'])->name('authentication.register.action');
    Route::get('/forget-password', [AuthService\ForgetPasswordController::class, 'view'])->name('authentication.forget-password');
});

Route::post('/logout', AuthService\LogoutController::class)->name('authentication.logout');
Route::middleware('')->group(function () {
});
