<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    // LISTAR
    public function index()
    {
        $titulo = "Pacientes";
        $pacientes = Paciente::all();

        return view('paciente.index', compact('pacientes','titulo'));
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'edad' => 'nullable|numeric',
            'sexo' => 'nullable|in:M,F',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string'
        ]);

        Paciente::create($request->all());

        return back()->with('success', 'Paciente creado correctamente');
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $paciente = Paciente::findOrFail($id);
        $paciente->update($request->all());

        return back()->with('success', 'Paciente actualizado');
    }

    // ELIMINAR
    public function destroy($id)
    {
        Paciente::destroy($id);

        return back()->with('success', 'Paciente eliminado');
    }
}