<div class="sidebar" style="background-color: #000; opacity: 10">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
            </li>
            <li class="nav-title">
                {{ Auth::user()->name }}
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Productos</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.products.index') }}"><i class="icon-user"></i> Lista</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-user-following"></i> Crear Nuevo</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Convocatorias</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-chart"></i> Lista</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-chart"></i> Nuevo</a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
