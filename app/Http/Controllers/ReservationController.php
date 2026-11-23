<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    // Mostrar los equipos disponibles
    public function availableEquipment()
    {
        $equipment = Equipment::whereDoesntHave('reservations', function ($query) {
            $query->where('status', 'active');
        })
        ->orderBy('name')
        ->get();

        return view('student.equipment.index', compact('equipment'));
    }

    // Reservar un equipo
    public function store(Request $request, $equipmentId)
    {
        DB::transaction(function () use ($request, $equipmentId) {

            // Bloquear el equipo mientras se procesa la reservación
            $equipment = Equipment::whereKey($equipmentId)
                ->lockForUpdate()
                ->firstOrFail();

            // Comprobar si ya tiene una reservación activa
            $alreadyReserved = Reservation::where('equipment_id', $equipment->id)
                ->where('status', 'active')
                ->exists();

            if ($alreadyReserved) {
                throw ValidationException::withMessages([
                    'equipment' => 'Este equipo ya fue reservado por otro estudiante.',
                ]);
            }

            // Crear la reservación para el usuario autenticado
            Reservation::create([
                'user_id' => $request->user()->id,
                'equipment_id' => $equipment->id,
                'status' => 'active',
                'reserved_at' => now(),
            ]);
        });

        return redirect()
            ->route('student.equipment.index')
            ->with('success', 'Equipo reservado correctamente.');
    }

    // Mostrar las reservaciones del estudiante autenticado
    public function myReservations(Request $request)
    {
        $reservations = $request->user()
            ->reservations()
            ->with('equipment')
            ->orderByDesc('reserved_at')
            ->get();

        return view('student.reservations.index', compact('reservations'));
    }

    // Cancelar una reservación propia
    public function cancel(Request $request, $reservationId)
    {
        DB::transaction(function () use ($request, $reservationId) {

            // Buscar solamente dentro de las reservaciones del usuario actual
            $reservation = $request->user()
                ->reservations()
                ->whereKey($reservationId)
                ->lockForUpdate()
                ->firstOrFail();

            if ($reservation->status !== 'active') {
                throw ValidationException::withMessages([
                    'reservation' => 'Esta reservación ya no está activa.',
                ]);
            }

            $reservation->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
            ]);
        });

        return redirect()
            ->route('student.reservations.index')
            ->with('success', 'Reservación cancelada correctamente.');
    }
}
