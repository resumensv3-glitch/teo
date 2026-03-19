@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Establecimientos</h1>
  </div>

  <!-- ============================ -->
  <!--  FORMULARIO CREAR -->
  <!-- ============================ -->
  <section class="section">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Crear nuevo establecimiento</h5>

            <form action="{{ route('establecimientos.store') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label>Nombre del establecimiento</label>
                <input type="text" name="nombre" class="form-control" required>
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

            <h5 class="card-title">Listado de establecimientos</h5>

            <table class="table table-condensed" id="tabla_establecimientos">
              <thead class="table-light">
                <tr>
                  <th class="text-center">ID</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($establecimientos as $item)
                  <tr>
                    <td class="text-center">{{ $item->id }}</td>
                    <td class="text-center">{{ $item->nombre }}</td>
                    <td class="text-center">

                      <!-- EDITAR (MODAL) -->
                      <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                        Editar
                      </button>

                      <!-- ELIMINAR -->
                      <form action="{{ route('establecimientos.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este registro?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                      </form>

                    </td>
                  </tr>

                  <!-- ============================ -->
                  <!-- MODAL EDITAR -->
                  <!-- ============================ -->
                  <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                    <div class="modal-dialog">
                      <form action="{{ route('establecimientos.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Editar Establecimiento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <div class="modal-body">
                            <div class="mb-3">
                              <label>Nombre</label>
                              <input type="text" name="nombre" class="form-control"
                                     value="{{ $item->nombre }}" required>
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