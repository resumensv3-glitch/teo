<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receta;
use App\Models\RecetaDetalle;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Medicamento;
use Illuminate\Support\Facades\DB;

class RecetaController extends Controller
{
    // LISTAR + FORMULARIO
    public function index()
    {
        $titulo = "Recetas";

        $medicos = Medico::all();
        $pacientes = Paciente::all();
        $medicamentos = Medicamento::all();

        return view('receta.index', compact(
            'titulo',
            'medicos',
            'pacientes',
            'medicamentos'
        ));
    }

    // GUARDAR RECETA + DETALLE
    public function store(Request $request)
    {
        $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'medicamento_id' => 'required|array',
            'cantidad' => 'required|array'
        ]);

        DB::beginTransaction();

        try {

            // 🧾 Guardar receta
            $receta = Receta::create([
                'medico_id' => $request->medico_id,
                'paciente_id' => $request->paciente_id,
                'fecha' => now()
            ]);

            // 💊 Guardar detalle
            for ($i = 0; $i < count($request->medicamento_id); $i++) {

                RecetaDetalle::create([
                    'receta_id' => $receta->id,
                    'medicamento_id' => $request->medicamento_id[$i],
                    'cantidad' => $request->cantidad[$i],
                    'dosis' => $request->dosis[$i] ?? null,
                ]);

                // 🔥 OPCIONAL: DESCONTAR STOCK
                $med = Medicamento::find($request->medicamento_id[$i]);
                if ($med) {
                    $med->stock -= $request->cantidad[$i];
                    $med->save();
                }
            }

            DB::commit();

            return back()->with('success', 'Receta guardada correctamente');

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', 'Error al guardar receta');
        }
    }

    // ELIMINAR (opcional)
    public function destroy($id)
    {
        Receta::destroy($id);
        return back()->with('success', 'Receta eliminada');
    }
}