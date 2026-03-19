<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Establecimiento;

class MedicoController extends Controller
{
    // LISTAR
    public function index()
    {
        $titulo = "Médicos";

        $medicos = Medico::with('establecimiento')->get();
        $establecimientos = Establecimiento::all();

        return view('medico.index', compact('medicos','establecimientos','titulo'));
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'especialidad' => 'nullable|string',
            'establecimiento_id' => 'required|exists:establecimientos,id'
        ]);

        Medico::create($request->all());

        return back()->with('success', 'Médico creado correctamente');
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'establecimiento_id' => 'required|exists:establecimientos,id'
        ]);

        $medico = Medico::findOrFail($id);
        $medico->update($request->all());

        return back()->with('success', 'Médico actualizado');
    }

    // ELIMINAR
    public function destroy($id)
    {
        Medico::destroy($id);

        return back()->with('success', 'Médico eliminado');
    }
}