<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
//use App\Http\Controllers\Auth\LoginController;

use Laravel\Fortify\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Auth::routes();
Route::post('/users', [UserController::class, 'store'])->name('users.store');

//Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
//Route::post('/login', [AuthController::class, 'login']);

// Rutas para las vistas
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

