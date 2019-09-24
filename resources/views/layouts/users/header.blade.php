<header>
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    
    <a href="{{ route('home') }}"><img class="logo" src="{{ setting()->get('site_logo')}}"></a>
        
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        
      <span class="navbar-toggler-icon"></span>
        
    </button>
        
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ml-auto">
        

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Authentication Links -->
        @guest
          <a class="nav-item nav-link" href="{{ route('provider.login') }}">{{ tr('hosts') }}</a>
          <a class="nav-item nav-link notactive" href="{{ route('login') }}">{{ tr('login') }} <span class="sr-only">(current)</span></a>
          <a class="nav-item nav-link active link-active" href="{{ route('register') }}">{{ tr('register') }}<span class="sr-only">(current)</span></a> 
        @else
          <div class="topbar-divider d-none d-sm-block"></div>
          <a class="nav-item nav-link" href="{{ route('hosts.index') }}">{{ tr('hosts') }}</a>
           <a class="nav-item nav-link" href="{{ route('bookings.index') }}">{{ tr('booking_management') }}</a>
          <a class="nav-item nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth()->user()->name }}<span class="sr-only">(current)</span>
            
          </a>
          
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="{{ route('profile.view') }}">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              {{ tr('profile') }}
            </a>
  
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              {{ tr('logout') }}
            </a>
          </div>

        @endguest
      </div>
    </div>
  </nav>
</header>