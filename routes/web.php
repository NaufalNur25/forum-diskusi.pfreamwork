<?php

use App\Http\Controllers\Authentication as AuthService;
use App\Http\Controllers\Admin as AdminService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;

Route::get('/', function () {
    return redirect()->route('posts.index');
})->name('home');

Route::get('/api/csrf', function (\Illuminate\Http\Request $request) {
    return response()->json([
        'csrf_token' => $request->session()->token()
    ]);
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::middleware('guest')->group(function () {
    # ROLE: User
    Route::get('/login', [AuthService\LoginController::class, 'view'])->name('authentication.login');
    Route::post('/login', [AuthService\LoginController::class, 'login'])->name('authentication.login.action');
    Route::get('/register', [AuthService\RegisterController::class, 'view'])->name('authentication.register');
    Route::post('/register', [AuthService\RegisterController::class, 'register'])->name('authentication.register.action');
    Route::get('/forget-password', [AuthService\ForgetPasswordController::class, 'view'])->name('authentication.forget-password');
    Route::post('/forget-password', [AuthService\ForgetPasswordController::class, 'sendLinkToMail'])->name('authentication.forget-password.action');
    Route::get('/reset-password/{token}', [AuthService\ResetPasswordController::class, 'view'])->name('authentication.reset-password');
    Route::post('/reset-password', [AuthService\ResetPasswordController::class, 'resetPassword'])->name('authentication.reset-password.action');

    # ROLE: Admin
    Route::get('/login/privilege/{role}', [AdminService\Authentication\LoginController::class, 'view'])->name('admin.authentication.login');
    Route::post('/login/privilege', [AdminService\Authentication\LoginController::class, 'login'])->name('admin.authentication.login.action');
});

Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function () {
    Route::get('/dashboard', [AdminService\Dashboard::class, 'index'])->name('admin.dashboard');
});

Route::middleware(UserMiddleware::class)->group(function () {
    # PAGE: User
    Route::post('/logout', AuthService\LogoutController::class)->name('authentication.logout');

    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');


    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::post('/posts/{post}/interact', [InteractionController::class, 'store'])->name('posts.interact');

    Route::post('/comments/{comment}/answers', [AnswerController::class, 'store'])->name('answers.store');
    Route::get('/profile', [ProfileController::class, 'view'])->name('Profile.view');
});
Route::post('/logout', AuthService\LogoutController::class)->name('authentication.logout');
