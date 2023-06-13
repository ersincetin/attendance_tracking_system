<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Setting\ClassController;
use App\Http\Controllers\Admin\Setting\CourseController;
use App\Http\Controllers\Admin\Setting\RoleController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\StudentAuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
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

Route::prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::get('users', [UserController::class, 'index']);
    Route::prefix('user')->group(function () {
        Route::get('profile', function (): View {
            return view('admin.profile.index');
        });
        Route::post('get', [UserController::class, 'show']);
        Route::post('dataTable', [UserController::class, 'dataTables']);
        Route::post('create', [UserController::class, 'store']);
        Route::post('update', [UserController::class, 'update']);
        Route::post('delete', [UserController::class, 'destroy']);

        Route::post('setAssigningClass', [UserController::class, 'setAssigningClass']);
    });
    Route::get('teachers', [UserController::class, 'teachers']);
    Route::get('student_affairs', [UserController::class, 'student_affairs']);

    Route::get('students', [StudentController::class, 'index']);
    Route::prefix('student')->group(function () {
        Route::post('dataTable', [StudentController::class, 'dataTables']);
        Route::post('get', [StudentController::class, 'show']);
        Route::post('create', [StudentController::class, 'store']);
        Route::post('update', [StudentController::class, 'update']);
        Route::post('delete', [StudentController::class, 'destroy']);

        Route::post('logout', [StudentAuthenticatedSessionController::class, 'destroy']);
    });

    Route::prefix('settings')->group(function () {
        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, 'index']);
            Route::post('dataTable', [RoleController::class, 'dataTables']);
            Route::post('get', [RoleController::class, 'show']);
            Route::post('create', [RoleController::class, 'store']);
            Route::post('update', [RoleController::class, 'update']);
            Route::post('delete', [RoleController::class, 'destroy']);

            Route::get('permission/{id}', [RoleController::class, 'permission']);
            Route::post('permission/update', [RoleController::class, 'permissionUpdate']);
        });

        Route::prefix('class')->group(function () {
            Route::get('/', [ClassController::class, 'index']);
            Route::post('dataTable', [ClassController::class, 'dataTables']);
            Route::post('get', [ClassController::class, 'show']);
            Route::post('getList', [ClassController::class, 'list']);
            Route::post('create', [ClassController::class, 'store']);
            Route::post('update', [ClassController::class, 'update']);
            Route::post('delete', [ClassController::class, 'destroy']);
            Route::post('setAssigningCourse', [ClassController::class, 'setAssigningCourse']);
        });

        Route::prefix('course')->group(function () {
            Route::get('/', [CourseController::class, 'index']);
            Route::post('dataTable', [CourseController::class, 'dataTables']);
            Route::post('get', [CourseController::class, 'show']);
            Route::post('getList', [CourseController::class, 'list']);
            Route::post('create', [CourseController::class, 'store']);
            Route::post('update', [CourseController::class, 'update']);
            Route::post('delete', [CourseController::class, 'destroy']);
        });

    });

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);
});

Route::prefix('student')->middleware('auth.student')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
});

Route::prefix('admin')->middleware('guest')->group(function () {
    /**Route for Admin and Teacher*/
    Route::get('login', [AuthenticatedSessionController::class, 'create']);
    Route::post('auth', [AuthenticatedSessionController::class, 'store']);
});
Route::prefix('student')->middleware('guest')->group(function () {
    Route::get('login', [StudentAuthenticatedSessionController::class, 'create']);
    Route::post('auth', [StudentAuthenticatedSessionController::class, 'store']);
});

//require __DIR__ . '/auth.php';
