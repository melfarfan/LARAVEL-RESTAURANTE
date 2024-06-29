<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-university"></i> --}}
            <img src="{{ asset('images/logopizzas.png') }}" alt="Logo" width="50px">
           
        </div>

        <div class="sidebar-brand-text mx-3">RESTAURANTE</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>INICIO</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    @php
    //Es para verificar si la ruta fue seleccionada, requiere un array con los nombres de las rutas para verificar sus extensiones
    //.index, .create, .update, .edit, .show. Ejemplo selectedRout(['estudiantes']) verificará así y devolverá true o false
    //estudiantes.index, estudiantes.create, estudiantes.update, estudiantes.edit, estudiantes.show
    //Por defecto usar solo para verificar rutas de ese tipo por cada elemento del array enviado
    //También se puede enviar extensiones personalizadas y esos serán las nuevas extensiones a verificar por cada elemento
    function isRouteSelected($rutas, $extension = null)
    {
    $extension = $extension ?? ['index', 'create', 'update', 'edit', 'show'];
    foreach ($rutas as $ruta) {
    foreach ($extension as $view) {
    if (Route::is($ruta . '.' . $view)) {
    return true;
    }
    }
    }
    return false;
    }
    function addAttribMenu($applyAttributes = false)
    {
    $menu = [
    'nav-link' => $applyAttributes ? '' : 'collapsed',
    'aria-expanded' => $applyAttributes ? 'true' : 'false',
    'nav-item' => $applyAttributes ? 'active' : '',
    'collapse' => $applyAttributes ? 'show' : '',
    ];
    return $menu;
    }

    $routesModuleEstudents = ['estudiantes', 'generos', 'expedicion_cis'];
    $menu_estudiantes = addAttribMenu(isRouteSelected($routesModuleEstudents));

    $menu_administradores = addAttribMenu(
    isRouteSelected(['users']) ||
    Route::is('users.delete') ||
    isRouteSelected(['empresas'], ['index', 'create']) ||
    isRouteSelected(['roles', 'permissions'], ['index', 'create']),
    );

    @endphp

    <li class="nav-item {{ $menu_estudiantes['nav-item'] }}">
        <a class="nav-link collapsed {{ $menu_estudiantes['nav-link'] }}" href="#" data-toggle="collapse" data-target="#collapseEstudent" aria-expanded="{{ $menu_estudiantes['aria-expanded'] }}" aria-controls="collapseEstudent">
            <i class='fas fa-donate'></i>
            <span>VENTAS</span>
        </a>
        <div id="collapseEstudent" class="collapse {{ $menu_estudiantes['collapse'] }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <a class="collapse-item {{ Route::is('estudiantes.index') ? 'active' : '' }}" href="{{ route('estudiantes.index') }}">Estudiantes</a>
                <a class="collapse-item {{ Route::is('clientes.index') ? 'active' : '' }}" href="{{ route('clientes.index') }}">Clientes</a>
                <a class="collapse-item {{ Route::is('medicos.index') ? 'active' : '' }}" href="{{ route('medicos.index') }}">Medicos</a> -->

                
                <a class="collapse-item {{ Route::is('customers.index') ? 'active' : '' }}" href="{{ route('customers.index') }}">Clientes</a>

               <a class="collapse-item {{ Route::is('categories.index') ? 'active' : '' }}" href="{{ route('categories.index') }}">Categorías</a>

              <a class="collapse-item {{ Route::is('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}">Productos</a>

              <a class="collapse-item {{ Route::is('sales.index') ? 'active' : '' }}" href="{{ route('sales.index') }}">Ventas</a>

            </div>
        </div>
    </li>
    <hr class="sidebar-divider">

    @hasrole('Admin')
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ $menu_administradores['nav-item'] }}">
        <a class="nav-link collapsed {{ $menu_administradores['nav-link'] }}" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="{{ $menu_administradores['aria-expanded'] }}" aria-controls="collapsePages">
            <i class="fas fa-user-shield"></i>
            <span>ADMINISTRADOR</span>
        </a>
        <div id="collapsePages" class="collapse {{ $menu_administradores['collapse'] }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Roles & Permisos</h6>
                <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                <a class="collapse-item" href="{{ route('permissions.index') }}">Permisos</a>
                <a class="collapse-item {{ Route::is('users.index') ? 'active' : '' }}" href="{{ route('users.index') }}">Usuarios</a>
                <!-- <a class="collapse-item {{ Route::is('empresas.index') ? 'active' : '' }}" href="{{ route('empresas.index') }}">Empresa</a> -->

                <!-- <a class="collapse-item {{ Route::is('customers.index') ? 'active' : '' }}" href="{{ route('customers.index') }}">Clientes</a>

                <a class="collapse-item {{ Route::is('categories.index') ? 'active' : '' }}" href="{{ route('categories.index') }}">Categorías</a>

                <a class="collapse-item {{ Route::is('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}">Productos</a> -->


            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    @endhasrole

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>Cerrar Seción</span>
        </a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>