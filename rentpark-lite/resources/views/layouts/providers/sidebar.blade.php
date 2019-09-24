<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('provider.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-image mx-3"><img src="{{ Setting::get('site_logo')}}" alt="homepage"  class="dark-logo" /></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('provider.dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>{{ tr('dashboard') }}</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        {{ tr('items') }}
      </div>

      <!-- Nav Item - Pages Collapse Menu[ Hosts] -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-home"></i>
          <span>{{ tr('hosts') }}</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('provider.hosts.index') }}">{{ tr('list_hosts') }}</a>
            <a class="collapse-item" href="{{ route('provider.hosts.create') }}">{{ tr('add_host') }}</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('provider.bookings.index') }}">
          <i class="fas fa-calendar"></i>
          <span>{{ tr('bookings') }}</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Heading -->
      <div class="sidebar-heading">
        {{ tr('provider') }}
      </div>

      <!-- Nav Item - Profile -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('provider.profile.view', Auth()->user()->id) }}">
          <i class="fas fa-user"></i>
          <span>{{ tr('profile') }}</span></a>
      </li>

      <!-- Nav Item - Logout -->
      <li class="nav-item">
          <a class="nav-link" href="{{ route('provider.logout') }}" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt"></i>
          <span>{{ tr('logout') }}</span></a>
      </li>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->