<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicamento;

class MedicamentoController extends Controller
{
    // LISTAR
    public function index()
    {
        $titulo = "Medicamentos";
        $medicamentos = Medicamento::all();

        return view('medicamento.index', compact('medicamentos', 'titulo'));
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'medicamento' => 'required|string|max:255',
            'stock' => 'required|numeric',
            'dosis' => 'nullable|string',
            'indicaciones' => 'nullable|string'
        ]);

        Medicamento::create($request->all());

        return back()->with('success', 'Medicamento creado correctamente');
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $request->validate([
            'medicamento' => 'required|string|max:255',
            'stock' => 'required|numeric'
        ]);

        $medicamento = Medicamento::findOrFail($id);
        $medicamento->update($request->all());

        return back()->with('success', 'Medicamento actualizado');
    }

    // ELIMINAR
    public function destroy($id)
    {
        Medicamento::destroy($id);

        return back()->with('success', 'Medicamento eliminado');
    }
}