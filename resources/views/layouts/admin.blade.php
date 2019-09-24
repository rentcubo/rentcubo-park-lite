<!DOCTYPE html>
<html>

<head>
    <!-- Include the head data -->
	@include('layouts.admin.styles')
</head>

<body class="fix-header fix-sidebar card-no-border">

    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">{{ Setting::get('site_name')}}</p>
        </div>
    </div>

    <div id="main-wrapper">

        <!-- Include the Header -->

    	@include('layouts.admin.header')

    	@include('layouts.admin.sidebar')

        <div class="page-wrapper">

            <!-- Content will extend in another file -->
        	@yield('content')

            <!-- Include the footer -->
        	@include('layouts.admin.footer')

        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  {{-- <a class="btn btn-primary" href="{{ route('provider.logout') }}">Logout</a> --}}

                   <a class="btn btn-primary" href="{{ route('admin.logout') }}"    onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                   </a>

                  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>

                </div>
        
            </div>
       
        </div>
   
    </div>

    <!-- Include the all scripts -->
    @include('layouts.admin.scripts')
    
</body>

</html>