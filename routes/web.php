<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminReservationController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Rutas del administrador
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Administración de equipos
        Route::get('/equipment', [EquipmentController::class, 'index'])
            ->name('equipment.index');

        Route::get('/equipment/create', [EquipmentController::class, 'create'])
            ->name('equipment.create');

        Route::post('/equipment', [EquipmentController::class, 'store'])
            ->name('equipment.store');

        Route::get('/equipment/{equipment}/edit', [EquipmentController::class, 'edit'])
            ->name('equipment.edit');

        Route::put('/equipment/{equipment}', [EquipmentController::class, 'update'])
            ->name('equipment.update');

        Route::delete('/equipment/{equipment}', [EquipmentController::class, 'destroy'])
            ->name('equipment.destroy');

        // Consultar todas las reservaciones
        Route::get('/reservations', [AdminReservationController::class, 'index'])
            ->name('reservations.index');

        // Cancelar una reservación
        Route::post('/reservations/{reservationId}/cancel', [AdminReservationController::class, 'cancel'])
            ->name('reservations.cancel');
    });

// Rutas del estudiante
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('student.dashboard');
        })->name('dashboard');

        Route::get('/equipment', [ReservationController::class, 'availableEquipment'])
            ->name('equipment.index');

        Route::post('/equipment/{equipmentId}/reserve', [ReservationController::class, 'store'])
            ->name('equipment.reserve');

        Route::get('/reservations', [ReservationController::class, 'myReservations'])
            ->name('reservations.index');

        Route::post('/reservations/{reservationId}/cancel', [ReservationController::class, 'cancel'])
            ->name('reservations.cancel');
    });
