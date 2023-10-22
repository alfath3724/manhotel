<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\RoomCleaningsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ReservationsController;

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
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['isadmin'])->group(function (){
        Route::get('user', [UserController::class, 'index'])->name('user');
        Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user-edit');
        Route::put('user/update/{id}', [UserController::class, 'update'])->name('user-update');
        Route::delete('user/{id}', [UserController::class, 'delete'])->name('user-delete');
        Route::get('user/search', [UserController::class, 'search'])->name('user-search');
    });

    Route::get('room', [RoomsController::class, 'index'])->name('room');
    Route::get('room/search', [RoomsController::class, 'search'])->name('room-search');
    Route::middleware(['isadmin'])->group(function (){
        Route::get('room/create', [RoomsController::class, 'create'])->name('room-create');
        Route::post('room/store', [RoomsController::class, 'store'])->name('room-store');
        Route::get('room/edit/{id}', [RoomsController::class, 'edit'])->name('room-edit');
        Route::put('room/update/{id}', [RoomsController::class, 'update'])->name('room-update');
        Route::delete('room/{id}', [RoomsController::class, 'delete'])->name('room-delete');
    });

    Route::get('roomcleaning', [RoomCleaningsController::class, 'index'])->name('roomcleaning');
    Route::get('roomcleaning/search', [RoomCleaningsController::class, 'search'])->name('roomcleaning-search');
    Route::middleware('isadmin')->group(function (){
        Route::get('roomcleaning/create', [RoomCleaningsController::class, 'create'])->name('roomcleaning-create');
        Route::post('roomcleaning/store', [RoomCleaningsController::class, 'store'])->name('roomcleaning-store');
        Route::get('roomcleaning/edit/{id}', [RoomCleaningsController::class, 'edit'])->name('roomcleaning-edit');
        Route::put('roomcleaning/update/{id}', [RoomCleaningsController::class, 'update'])->name('roomcleaning-update');
        Route::delete('roomcleaning/{id}', [RoomCleaningsController::class, 'delete'])->name('roomcleaning-delete');
    });
    Route::middleware(['iskebersihan'])->group(function (){
        Route::get('roomcleaning/cleaned/{id}', [RoomCleaningsController::class, 'cleaned'])->name('roomcleaning-cleaned');
    });

    Route::middleware(['isadmin'])->group(function (){
        Route::get('role', [RolesController::class, 'index'])->name('role');
        Route::get('role/create', [RolesController::class, 'create'])->name('role-create');
        Route::post('role/store', [RolesController::class, 'store'])->name('role-store');
        Route::get('role/edit/{id}', [RolesController::class, 'edit'])->name('role-edit');
        Route::put('role/update/{id}', [RolesController::class, 'update'])->name('role-update');
        Route::delete('role/{id}', [RolesController::class, 'delete'])->name('role-delete');
        Route::get('role/search', [RolesController::class, 'search'])->name('role-search');
    });

    Route::middleware(['isreservasi'])->group(function (){
        Route::get('reservation', [ReservationsController::class, 'index'])->name('reservation');
        Route::get('reservation/create', [ReservationsController::class, 'create'])->name('reservation-create');
        Route::post('reservation/store', [ReservationsController::class, 'store'])->name('reservation-store');
        Route::get('reservation/edit/{id}', [ReservationsController::class, 'edit'])->name('reservation-edit');
        Route::put('reservation/update/{id}', [ReservationsController::class, 'update'])->name('reservation-update');
        Route::delete('reservation/{id}', [ReservationsController::class, 'delete'])->name('reservation-delete');
        Route::get('reservation/search', [ReservationsController::class, 'search'])->name('reservation-search');
    });
});

require __DIR__.'/auth.php';
