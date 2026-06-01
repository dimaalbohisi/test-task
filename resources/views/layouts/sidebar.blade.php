<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/tasks') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-tasks"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Task Manager</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/tasks') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Management Panels
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/tasks') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Tasks List</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('/users') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Users List</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Status
    </div>

    <li class="nav-item">
        <a class="nav-link" href="#" style="opacity: 0.6;">
            <i class="fas fa-fw fa-check-circle"></i>
            <span>Completed Tasks</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
