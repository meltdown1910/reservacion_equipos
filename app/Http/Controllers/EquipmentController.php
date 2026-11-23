<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    // Mostrar todos los equipos
    public function index()
    {
        $equipment = Equipment::orderBy('name')->get();

        return view('admin.equipment.index', compact('equipment'));
    }

    // Mostrar formulario para registrar un equipo
    public function create()
    {
        return view('admin.equipment.create');
    }

    // Guardar un equipo nuevo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:equipment,code'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        Equipment::create($validated);

        return redirect()
            ->route('admin.equipment.index')
            ->with('success', 'Equipo registrado correctamente.');
    }

    // Mostrar formulario para editar un equipo
    public function edit(Equipment $equipment)
    {
        return view('admin.equipment.edit', compact('equipment'));
    }

    // Actualizar un equipo
    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255', 'unique:equipment,code,' . $equipment->id],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        $equipment->update($validated);

        return redirect()
            ->route('admin.equipment.index')
            ->with('success', 'Equipo actualizado correctamente.');
    }

    // Eliminar un equipo
    public function destroy(Equipment $equipment)
    {
        if ($equipment->reservations()->exists()) {
            return redirect()
                ->route('admin.equipment.index')
                ->with('error', 'No se puede eliminar este equipo porque tiene reservaciones registradas.');
        }

        $equipment->delete();

        return redirect()
            ->route('admin.equipment.index')
            ->with('success', 'Equipo eliminado correctamente.');
    }
}
