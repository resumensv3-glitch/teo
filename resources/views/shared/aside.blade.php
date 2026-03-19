<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Gestión General -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#gestion-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-hospital"></i>
                <span>Gestión</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="gestion-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">

                <!-- Establecimiento -->
                <li>
                    <a href="{{ route('establecimiento') }}">
                        <i class="bi bi-circle"></i>
                        <span>Establecimiento</span>
                    </a>
                </li>

                <!-- Médico -->
                <li>
                    <a href="{{ route('medico') }}">
                        <i class="bi bi-circle"></i>
                        <span>Médico</span>
                    </a>
                </li>

                <!-- Paciente -->
                <li>
                    <a href="{{ route('paciente') }}">
                        <i class="bi bi-circle"></i>
                        <span>Paciente</span>
                    </a>
                </li>

            </ul>
        </li>

        <!-- Inventario -->
        @can('ver-inventario')
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#inventario-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-pills"></i>
                <span>Inventario</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>

            <ul id="inventario-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">

                <!-- Medicamento -->
                <li>
                    <a href="{{ route('medicamento') }}">
                        <i class="bi bi-circle"></i>
                        <span>Medicamento</span>
                    </a>
                </li>

            </ul>
        </li>
        @endcan

        <!-- Recetas -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('receta') }}">
                <i class="fa-solid fa-file-medical"></i>
                <span>Recetas</span>
            </a>
        </li>

        <!-- Usuarios (solo admin) -->
        @can('ver-usuarios')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('usuarios') }}">
                <i class="fa-solid fa-users"></i>
                <span>Usuarios</span>
            </a>
        </li>
        @endcan

    </ul>
</aside>