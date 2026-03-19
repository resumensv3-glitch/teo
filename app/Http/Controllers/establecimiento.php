<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establecimiento;

class EstablecimientoController extends Controller
{
    // LISTAR
    public function index()
    {
        $establecimientos = Establecimiento::all();

        $titulo = 'Establecimientos';

        return view('modules.establecimiento.index', compact('titulo', 'establecimientos'));
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        Establecimiento::create($request->all());

        return redirect()->route('establecimiento')->with('success', 'Establecimiento creado correctamente');
    }

    // ACTUALIZAR (YA NO NECESITAS EDIT)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $establecimiento = Establecimiento::findOrFail($id);
        $establecimiento->update($request->all());

        return redirect()->route('establecimiento')->with('success', 'Actualizado correctamente');
    }

    // ELIMINAR
    public function destroy($id)
    {
        Establecimiento::destroy($id);

        return redirect()->route('establecimiento')->with('success', 'Eliminado correctamente');
    }
}