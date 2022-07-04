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
        <a class="nav-link collapsed" href="{{ route('admin.categories.index') }}">
          <i class="bi bi-folder-fill"></i>
          <span>Categories</span>
        </a>
      </li><!-- End Roles Nav -->

    </ul>

</aside><!-- End Sidebar-->