<?php

use App\Http\Controllers\Authentication as AuthService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/api/csrf', function (\Illuminate\Http\Request $request) {
    return response()->json([
        'csrf_token' => $request->session()->token()
    ]);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthService\LoginController::class, 'view'])->name('authentication.login');
    Route::post('/login', [AuthService\LoginController::class, 'login'])->name('authentication.login.action');
    Route::get('/register', [AuthService\RegisterController::class, 'view'])->name('authentication.register');
    Route::post('/register', [AuthService\RegisterController::class, 'register'])->name('authentication.register.action');
    Route::get('/forget-password', [AuthService\ForgetPasswordController::class, 'view'])->name('authentication.forget-password');
Route::post('/forget-password', [AuthService\ForgetPasswordController::class, 'sendLinkToMail'])->name('authentication.forget-password.action');
    Route::get('/reset-password/{token}', [AuthService\ResetPasswordController::class, 'view'])->name('authentication.reset-password');
    Route::post('/reset-password', [AuthService\ResetPasswordController::class, 'resetPassword'])->name('authentication.reset-password.action');

});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', AuthService\LogoutController::class)->name('authentication.logout');

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); // Menampilkan semua post
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // Menampilkan form
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // Menyimpan post baru


    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::post('/posts/upload-trix-image', [PostController::class, 'uploadImage'])->name('posts.upload-image');
});
