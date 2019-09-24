<!-- ========= Left Sidebar - style you can find in sidebar.scss ====== -->
<aside class="left-sidebar">
    
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
      
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            
            <ul id="sidebarnav">

                <!-- Dashboard -->
                <li> <a class="waves-effect waves-dark" href="/admin" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">{{ tr('dashboard') }}</span></a>
                </li>

                <!-- Users -->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>{{ tr('users') }}</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('admin.users.index') }}"><i class="fa fa-circle-o"></i> {{ tr('list_users') }}</a></li>
                        <li><a href="{{ route('admin.users.create') }}"><i class="fa fa-circle-o"></i> {{ tr('add_user') }}</a></li>
                    </ul>
                </li>

                <!-- Providers -->
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-users"></i>
                    <span>{{ tr('providers') }}</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{ route('admin.providers.index')}}"><i class="fa fa-circle-o"></i> {{ tr('list_providers') }} </a></li>
                    <li><a href="{{ route('admin.providers.create')}}"><i class="fa fa-circle-o"></i> {{ tr('add_provider') }}</a></li>
                  
                  </ul>
                </li>

                <!--Service Loctions-->
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-map-marker"></i>
                    <span>{{ tr('service') }}</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    <span style="padding-left: 43px;">{{ tr('locations') }}</span>
                    
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{ route('admin.service_locations.index') }}"><i class="fa fa-circle-o"></i> {{ tr('list_service_locations') }}</a></li>
                    <li><a href="{{ route('admin.service_locations.create') }}"><i class="fa fa-circle-o"></i> {{ tr('add_service_location') }}</a></li>

                  </ul>
                </li>

                <!-- Hosts -->
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-home"></i>
                    <span>{{ tr('hosts') }}</span>
                    
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                     <li><a href="{{ route('admin.hosts.index') }}"><i class="fa fa-circle-o"></i> {{ tr('list_hosts') }}</a></li>
                     <li><a href="{{ route('admin.hosts.create') }}"><i class="fa fa-circle-o"></i> {{ tr('add_host') }} </a></li>
                  </ul>
                </li>

                <!-- Static Pages -->
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-file"></i>
                    <span>{{ tr('static_pages') }}</span>
                    
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                     <li><a href="{{ route('admin.static_pages.index') }}"><i class="fa fa-circle-o"></i> {{ tr('list_static_pages') }}</a></li>
                     <li><a href="{{ route('admin.static_pages.create') }}"><i class="fa fa-circle-o"></i> {{ tr('add_static_page') }} </a></li>
                  </ul>
                </li>

                <!-- Booking Management -->

                 <li> <a class="waves-effect waves-dark" href="{{ route('admin.bookings.index') }}" aria-expanded="false"><i class="fa fa-calendar-check-o"></i><span class="hide-menu">{{ tr('bookings') }}</span></a>
                </li>

                <!-- Settings -->

                 <li> <a class="waves-effect waves-dark" href="{{ route('admin.settings.index') }}" aria-expanded="false"><i class="fa fa-gear"></i><span class="hide-menu">{{ tr('settings') }}</span></a>
                </li>
               

                <!-- Profile -->

                 <li> <a class="waves-effect waves-dark" href="{{ route('admin.profile.view')}}" aria-expanded="false"><i class="fa fa-user-circle-o"></i><span class="hide-menu">{{ tr('profile') }}</span></a>
                </li>

                <!-- Logout -->

                <li> <a class="waves-effect waves-dark" href="{{ route('admin.logout')}}" aria-expanded="false" data-toggle="modal" data-target="#logoutModal" ><i class="fa fa-sign-out"></i><span class="hide-menu">{{ tr('logout') }}</span></a>\

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                    </form>
                </li>

            </ul>

        </nav>
        <!-- End Sidebar navigation -->

    </div>
    <!-- End Sidebar scroll-->

</aside>
<!-- ======= End Left Sidebar - style you can find in sidebar.scss ====== -->