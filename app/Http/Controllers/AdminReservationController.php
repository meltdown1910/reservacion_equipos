<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AdminReservationController extends Controller
{
    // Mostrar todas las reservaciones
    public function index()
    {
        $reservations = Reservation::with(['user', 'equipment'])
            ->orderByDesc('reserved_at')
            ->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    // Cancelar una reservación desde el panel del administrador
    public function cancel($reservationId)
    {
        DB::transaction(function () use ($reservationId) {

            $reservation = Reservation::whereKey($reservationId)
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
            ->route('admin.reservations.index')
            ->with('success', 'La reservación fue cancelada correctamente.');
    }
}
