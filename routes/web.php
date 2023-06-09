<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use Illuminate\View\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::get('users', [UserController::class, 'index']);
    Route::post('getUser', [UserController::class, 'show']);
    Route::post('usersDataTable', [UserController::class, 'dataTables']);
    Route::post('createUser', [UserController::class, 'store']);
    Route::post('updateUser', [UserController::class, 'update']);
    Route::post('deleteUser', [UserController::class, 'destroy']);
    Route::get('profile', function (): View {
        return view('admin.profile.index');
    });
    Route::get('teachers', [UserController::class, 'teachers']);
    Route::get('student_affairs', [UserController::class, 'student_affairs']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);
});

Route::prefix('login')->middleware('guest')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'create']);
    Route::post('auth', [AuthenticatedSessionController::class, 'store']);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//require __DIR__ . '/auth.php';
