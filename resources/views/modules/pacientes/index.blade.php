@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Pacientes</h1>
  </div>

  <!-- ============================ -->
  <!-- FORMULARIO CREAR -->
  <!-- ============================ -->
  <section class="section">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">

            <h5 class="card-title">Nuevo Paciente</h5>

            <form action="{{ route('pacientes.store') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
              </div>

              <div class="mb-3">
                <label>Apellido</label>
                <input type="text" name="apellido" class="form-control">
              </div>

              <div class="mb-3">
                <label>Edad</label>
                <input type="number" name="edad" class="form-control">
              </div>

              <div class="mb-3">
                <label>Sexo</label>
                <select name="sexo" class="form-control">
                  <option value="">Seleccione</option>
                  <option value="M">Masculino</option>
                  <option value="F">Femenino</option>
                </select>
              </div>

              <div class="mb-3">
                <label>Teléfono</label>
                <input type="text" name="telefono" class="form-control">
              </div>

              <div class="mb-3">
                <label>Dirección</label>
                <textarea name="direccion" class="form-control"></textarea>
              </div>

              <button class="btn btn-primary">Guardar</button>

            </form>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================ -->
  <!-- LISTADO -->
  <!-- ============================ -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            <h5 class="card-title">Listado de pacientes</h5>

            <table class="table table-condensed" id="tabla_pacientes">
              <thead class="table-light">
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Edad</th>
                  <th class="text-center">Sexo</th>
                  <th class="text-center">Teléfono</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pacientes as $item)
                  <tr>
                    <td class="text-center">{{ $item->id }}</td>
                    <td class="text-center">{{ $item->nombre }} {{ $item->apellido }}</td>
                    <td class="text-center">{{ $item->edad }}</td>
                    <td class="text-center">{{ $item->sexo }}</td>
                    <td class="text-center">{{ $item->telefono }}</td>
                    <td class="text-center">

                      <!-- EDITAR -->
                      <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                        Editar
                      </button>

                      <!-- ELIMINAR -->
                      <form action="{{ route('pacientes.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar paciente?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                      </form>

                    </td>
                  </tr>

                  <!-- ============================ -->
                  <!-- MODAL EDITAR -->
                  <!-- ============================ -->
                  <div class="modal fade" id="editModal{{ $item->id }}">
                    <div class="modal-dialog">
                      <form action="{{ route('pacientes.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Editar Paciente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <div class="modal-body">

                            <div class="mb-3">
                              <label>Nombre</label>
                              <input type="text" name="nombre" class="form-control" value="{{ $item->nombre }}">
                            </div>

                            <div class="mb-3">
                              <label>Apellido</label>
                              <input type="text" name="apellido" class="form-control" value="{{ $item->apellido }}">
                            </div>

                            <div class="mb-3">
                              <label>Edad</label>
                              <input type="number" name="edad" class="form-control" value="{{ $item->edad }}">
                            </div>

                            <div class="mb-3">
                              <label>Sexo</label>
                              <select name="sexo" class="form-control">
                                <option value="M" {{ $item->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ $item->sexo == 'F' ? 'selected' : '' }}>Femenino</option>
                              </select>
                            </div>

                            <div class="mb-3">
                              <label>Teléfono</label>
                              <input type="text" name="telefono" class="form-control" value="{{ $item->telefono }}">
                            </div>

                            <div class="mb-3">
                              <label>Dirección</label>
                              <textarea name="direccion" class="form-control">{{ $item->direccion }}</textarea>
                            </div>

                          </div>

                          <div class="modal-footer">
                            <button class="btn btn-success">Actualizar</button>
                          </div>
                        </div>

                      </form>
                    </div>
                  </div>

                @endforeach
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </section>

</main>
@endsection

@push('scripts')
<script>
  $(document).ready(function(){
    $('#tabla_pacientes').DataTable({
      pageLength: 10,
      language: {
        emptyTable: "No hay información",
        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
        infoEmpty: "Mostrando 0 a 0 de 0 registros",
        lengthMenu: "Mostrar _MENU_ registros",
        search: "Buscar:",
        paginate: {
          first: "Primero",
          last: "Último",
          next: "Siguiente",
          previous: "Anterior"
        }
      }
    });
  });
</script>
@endpush