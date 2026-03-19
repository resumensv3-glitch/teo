@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Recetas</h1>
  </div>

  <!-- ============================ -->
  <!-- FORMULARIO -->
  <!-- ============================ -->
  <section class="section">
    <div class="card">
      <div class="card-body">

        <h5 class="card-title">Nueva Receta</h5>

        <form action="{{ route('recetas.store') }}" method="POST">
          @csrf

          <div class="row">

            <!-- MÉDICO -->
            <div class="col-md-4">
              <label>Médico</label>
              <select name="medico_id" class="form-control" required>
                <option value="">Seleccione</option>
                @foreach($medicos as $m)
                  <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                @endforeach
              </select>
            </div>

            <!-- PACIENTE -->
            <div class="col-md-4">
              <label>Paciente</label>
              <select name="paciente_id" class="form-control" required>
                <option value="">Seleccione</option>
                @foreach($pacientes as $p)
                  <option value="{{ $p->id }}">{{ $p->nombre }}</option>
                @endforeach
              </select>
            </div>

          </div>

          <hr>

          <!-- ============================ -->
          <!-- AGREGAR MEDICAMENTO -->
          <!-- ============================ -->
          <div class="row">

            <div class="col-md-4">
              <label>Medicamento</label>
              <select id="medicamento" class="form-control">
                <option value="">Seleccione</option>
                @foreach($medicamentos as $med)
                  <option value="{{ $med->id }}">{{ $med->medicamento }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-2">
              <label>Cantidad</label>
              <input type="number" id="cantidad" class="form-control">
            </div>

            <div class="col-md-3">
              <label>Dosis</label>
              <input type="text" id="dosis" class="form-control">
            </div>

            <div class="col-md-2 mt-4">
              <button type="button" class="btn btn-success" onclick="agregarMedicamento()">
                Agregar
              </button>
            </div>

          </div>

          <br>

          <!-- TABLA -->
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Medicamento</th>
                <th>Cantidad</th>
                <th>Dosis</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="detalle"></tbody>
          </table>

          <button class="btn btn-primary">Guardar Receta</button>

        </form>

      </div>
    </div>
  </section>

</main>
@endsection