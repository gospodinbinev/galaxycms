<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.roles.index') }}">
          <i class="bi bi-list-ul"></i>
          <span>Roles</span>
        </a>
      </li><!-- End Roles Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.users.index') }}">
          <i class="bi bi-people-fill"></i>
          <span>Users</span>
        </a>
      </li><!-- End Roles Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#products-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="products-nav" class="nav-content collapse

        @if (Route::is('admin.categories.*') || Route::is('admin.brands.*') || 
        Route::is('admin.sizes.*') || Route::is('admin.colors.*'))show 
        @endif"
        
        data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.categories.index') }}">
              <i class="bi bi-circle"></i>
              <span>Categories</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.brands.index') }}">
              <i class="bi bi-circle"></i>
              <span>Brands</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.sizes.index') }}">
              <i class="bi bi-circle"></i>
              <span>Sizes</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.colors.index') }}">
              <i class="bi bi-circle"></i>
              <span>Colors</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

    </ul>

</aside><!-- End Sidebar-->