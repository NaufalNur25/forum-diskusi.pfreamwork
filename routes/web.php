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
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check() && Auth::user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('posts.index');
})->name('home');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::middleware(UserMiddleware::class)->group(function () {
    # PAGE: User
    Route::post('/post', [PostController::class, 'store'])->name('posts.store');
    Route::get('/post/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/post/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/post/{post}/interact', [InteractionController::class, 'store'])->name('posts.interact');
    Route::post('/comments/{comment}/answers', [AnswerController::class, 'store'])->name('answers.store');

    Route::get('/profile', [ProfileController::class, 'view'])->name('Profile.view');
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('Profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('Profile.update');
});

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

Route::get('/verified', [AuthService\VerifiedEmailController::class, 'verifiedEmail'])->name('authentication.verified.action');
Route::post('/logout', AuthService\LogoutController::class)->name('authentication.logout');

Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function () {
    Route::get('/dashboard', [AdminService\Dashboard::class, 'index'])->name('admin.dashboard');

    Route::prefix('master')->group(function () {
        Route::prefix('category')->group(function () {
            Route::get('/', [AdminService\Master\CategoryController::class, 'index'])->name('admin.master.category');
            Route::post('/', [AdminService\Master\CategoryController::class, 'store'])->name('admin.master.category.store');
            Route::get('/create', [AdminService\Master\CategoryController::class, 'create'])->name('admin.master.category.create');
            Route::get('/{category}/edit', [AdminService\Master\CategoryController::class, 'edit'])->name('admin.master.category.edit');
            Route::put('/{category}', [AdminService\Master\CategoryController::class, 'update'])->name('admin.master.category.update');
            Route::delete('/{category}', [AdminService\Master\CategoryController::class, 'destroy'])->name('admin.master.category.destroy');
        });

        Route::prefix('role')->group(function () {
            Route::get('/', [AdminService\Master\RoleController::class, 'index'])->name('admin.master.role');
            Route::post('/', [AdminService\Master\RoleController::class, 'store'])->name('admin.master.role.store');
            Route::get('/create', [AdminService\Master\RoleController::class, 'create'])->name('admin.master.role.create');
            Route::get('/{role}/edit', [AdminService\Master\RoleController::class, 'edit'])->name('admin.master.role.edit');
            Route::put('/{role}', [AdminService\Master\RoleController::class, 'update'])->name('admin.master.role.update');
            Route::delete('/{role}', [AdminService\Master\RoleController::class, 'destroy'])->name('admin.master.role.destroy');
        });
    });


    Route::prefix('user')->group(function () {
        Route::get('/', [AdminService\User\UserController::class, 'index'])->name('admin.user');
        Route::post('/', [AdminService\User\UserController::class, 'store'])->name('admin.user.store');
        Route::get('/create', [AdminService\User\UserController::class, 'create'])->name('admin.user.create');
        Route::get('/{user}', [AdminService\User\UserController::class, 'show'])->name('admin.user.show');
        Route::get('/{user}/edit', [AdminService\User\UserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/{user}', [AdminService\User\UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/{user}', [AdminService\User\UserController::class, 'destroy'])->name('admin.user.destroy');

        Route::post('/impersonate/{user}', [AdminService\Authentication\ImpersonateController::class, 'action'])->name('admin.user.impersonate');
        Route::post('/forget-password/{user}', [AdminService\Authentication\ForgetPasswordController::class, 'sendLinkToMail'])->name('admin.user.forget-password');
        Route::post('/verified-email/{user}', [AdminService\Authentication\VerifiedEmailController::class, 'sendLinkToMail'])->name('admin.user.verified-email');
        Route::patch('/changed-email/{user}', [AdminService\Authentication\ChangedEmailController::class, 'action'])->name('admin.user.change-email');
        Route::patch('/banned/{user}', [AdminService\Authentication\BannedController::class, 'action'])->name('admin.user.banned');
    });
});
