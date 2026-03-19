@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Medicamentos</h1>
  </div>

  <!-- ============================ -->
  <!--  FORMULARIO CREAR -->
  <!-- ============================ -->
  <section class="section">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nuevo Medicamento</h5>

            <form action="{{ route('medicamentos.store') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="medicamento" class="form-control" required>
              </div>

              <div class="mb-3">
                <label>Stock</label>
                <input type="number" name="stock" class="form-control" required>
              </div>

              <div class="mb-3">
                <label>Dosis</label>
                <input type="text" name="dosis" class="form-control">
              </div>

              <div class="mb-3">
                <label>Indicaciones</label>
                <textarea name="indicaciones" class="form-control"></textarea>
              </div>

              <button class="btn btn-primary">Guardar</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============================ -->
  <!--  LISTADO -->
  <!-- ============================ -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            <h5 class="card-title">Listado de medicamentos</h5>

            <table class="table table-condensed" id="tabla_medicamentos">
              <thead class="table-light">
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Stock</th>
                  <th class="text-center">Dosis</th>
                  <th class="text-center">Indicaciones</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($medicamentos as $item)
                  <tr>
                    <td class="text-center">{{ $item->id }}</td>
                    <td class="text-center">{{ $item->medicamento }}</td>
                    <td class="text-center">{{ $item->stock }}</td>
                    <td class="text-center">{{ $item->dosis }}</td>
                    <td class="text-center">{{ $item->indicaciones }}</td>
                    <td class="text-center">

                      <!-- EDITAR -->
                      <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                        Editar
                      </button>

                      <!-- ELIMINAR -->
                      <form action="{{ route('medicamentos.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este medicamento?')">
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
                      <form action="{{ route('medicamentos.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Editar Medicamento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <div class="modal-body">

                            <div class="mb-3">
                              <label>Nombre</label>
                              <input type="text" name="medicamento" class="form-control"
                                     value="{{ $item->medicamento }}" required>
                            </div>

                            <div class="mb-3">
                              <label>Stock</label>
                              <input type="number" name="stock" class="form-control"
                                     value="{{ $item->stock }}" required>
                            </div>

                            <div class="mb-3">
                              <label>Dosis</label>
                              <input type="text" name="dosis" class="form-control"
                                     value="{{ $item->dosis }}">
                            </div>

                            <div class="mb-3">
                              <label>Indicaciones</label>
                              <textarea name="indicaciones" class="form-control">{{ $item->indicaciones }}</textarea>
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
    $('#tabla_medicamentos').DataTable({
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