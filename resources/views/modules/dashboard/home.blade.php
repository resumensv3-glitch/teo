@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Bienvenido, {{ Auth::user()->name }}!</h5>

            <div class="row text-center mb-4">
              <div class="col-md-4 mb-3">
                <div class="bg-success text-white rounded p-3 shadow-sm">
                  <h6 class="mb-1">Total de Ingresos</h6>
                  <h4 class="mb-0">${{ number_format($totalVentas, 2) }}</h4>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="bg-danger text-white rounded p-3 shadow-sm">
                  <h6 class="mb-1">Total de Egresos</h6>
                  <h4 class="mb-0">{{ number_format($cantidadVentas) }}</h4>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="bg-info text-white rounded p-3 shadow-sm">
                  <h6 class="mb-1">Saldo total</h6>
                  <h4 class="mb-0">{{ number_format(count($productosBajosStock)) }}</h4>
                </div>
              </div>
            </div>

            <h5 class="mb-3">Ultimos movimientos</h5>
            <ul class="list-group">
              @forelse ($ventasRecientes as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Venta #{{ $item->id }}
                  <span class="badge bg-secondary">${{ number_format($item->total_venta, 2) }}</span>
                </li>
              @empty
                <li class="list-group-item text-muted">No hay ventas recientes</li>
              @endforelse
            </ul>

          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection


