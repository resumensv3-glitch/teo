<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard: todos los roles -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Ventas: admin y cajero -->
        @can('ver-ventas')
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#ventas-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-cart-shopping"></i><span>Movimientos</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="ventas-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('ventas-nueva') }}">
                        <i class="bi bi-circle"></i><span>Registrar ingresos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('detalle-venta') }}">
                        <i class="bi bi-circle"></i><span>Registrar egresos</span>
                    </a>
                </li>
            </ul>
        </li>
        @endcan


        <!-- Categorías y Productos: admin y bodeguero -->
        @can('ver-inventario')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('categorias') }}">
                <i class="fa-solid fa-list-check"></i>
                <span>Inventario</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#productos-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-window-restore"></i><span>Ujieres</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="productos-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('productos') }}">
                        <i class="bi bi-circle"></i><span>Administrar productos</span>
                    </a>
                </li>
                @can('ver-admin')
                <li>
                    <a href="{{ route('reportes_productos') }}">
                        <i class="bi bi-circle"></i><span>Reportes de productos</span>
                    </a>
                </li>
                @endcan
            </ul>
        </li>

        <!-- Compras y Proveedores: admin y bodeguero -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('compras') }}">
                <i class="fa-solid fa-shop"></i>
                <span>Compras</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('proveedores') }}">
                <i class="fa-solid fa-truck"></i>
                <span>Proveedores</span>
            </a>
        </li>
        @endcan

        <!-- Usuarios: solo admin -->
        @can('ver-usuarios')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('usuarios') }}">
                <i class="fa-solid fa-users"></i>
                <span>Usuarios</span>
            </a>
        </li>
        @endcan

    </ul>
</aside>
