<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="/{{ env('URL_REMOTE', '') }}dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Plastitodo ADMIN</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="/{{ env('URL_REMOTE', '') }}dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->


        <li class="nav-item has-treeview">
          <a href="#" class="nav-link {{ setActive(['rubros*']) }} {{ setActive(['categories*']) }} {{ setActive(['stockproducts*']) }} {{ setActive(['existencias*']) }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Almacen
              <i class="fas fa-angle-left right"></i>

            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('rubros.index') }}" class="nav-link {{ setActive(['rubros*']) }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Rubros</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('categories.index') }}" class="nav-link {{ setActive(['categories*']) }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Categorías</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('stockproducts.index') }}" class="nav-link {{ setActive(['stockproducts*']) }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Procutos Stock</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('stockproducts.existencias') }}" class="nav-link {{ setActive(['existencias*']) }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Existencias</p>
              </a>
            </li>

          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link {{ setActive(['proveedors*']) }}">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Compras
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('proveedors.index') }}" class="nav-link {{ setActive(['proveedors*']) }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Proveedores</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/charts/flot.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Productos Compra</p>
              </a>
            </li>

          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link {{ setActive(['clients*']) }} {{ setActive(['lista_de_precios*']) }} {{ setActive(['sales*']) }}">
            <i class="nav-icon fas fa-tree"></i>
            <p>
              Ventas
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('clients.index') }}" class="nav-link {{ setActive(['clients*']) }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Clientes</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('saleproducts.lista_de_precios') }}" class="nav-link {{ setActive(['lista_de_precios*']) }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Lista de Precios</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('sales.index') }}" class="nav-link {{ setActive(['sales*']) }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Lista de Ventas</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('sales.create') }}" class="nav-link {{ setActive(['sales*']) }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Nueva Venta</p>
              </a>
            </li>


          </ul>
        </li>


      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
