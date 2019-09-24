@extends('layouts.provider')

@section('content')

	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ tr('dashboard') }}</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Hosts Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ tr('hosts_available') }}</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_hosts ?? 0}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-home fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

             <!-- Bookings Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">{{ tr('bookings') }}</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_bookings ?? 0.00}}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ tr('earnings') }}</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{Setting::get('currency') }} {{ $earnings ?? 0.00}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">{{ tr('recent_earnings_overview') }}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                      
                        @if(count($bookings)>0)
                           @foreach($bookings as $booking)

                            <div class="row wrapper d-flex align-items-center py-2 border-bottom pl-10">
                              
                              <div class="d-flex col-lg-3 float-left align-items-center  justify-content-lg-end">
                                 <img src="{{ $booking->user()->first() ? $booking->user()->first()->picture : asset('placeholder.jpg')}}" class="img-sm rounded-circle" style="width: 40px; height: 40px" alt="profile">
                              </div>
                              <div class="col-lg-4">
                                

                                 <h6 class="ml-1 mb-1">

                                          {{ $booking->user()->first() ? $booking->user()->first()->name :  tr('no_user_available') }}

                                          </h6>

                                          <small class="text-muted ml-auto">
                                            <i class="fa fa-home" aria-hidden="true"></i>

                                    
                                            @if($booking->host()->first()!=NULL)

                                              <a href="{{ route('provider.hosts.view',$booking->host()->first()->id) }}">{{ $booking->host()->first()->host_name }}</a>                    
                                            @else
                                              {{ tr('no_host_available') }}
                                            @endif
                                          </small>

                                           <br>  
                                          <small class="text-muted ml-auto">

                                            {{ $booking->user()->first() ? $booking->currency.$booking->total : 0.00 }}

                                          </small> 
                                    </div>


                                    <div class="d-flex col-lg-3 float-left pull-left justify-content-lg-end" style="float:left;">
                                      
                                      <a href="{{ route('provider.bookings.view',$booking->id) }}"><i class="fa fa-info-circle float-left" style="font-size:38px;" aria-hidden="true"></i></a>

                                    </div>

                                  </div>
                                
                                 <br>
                            
                          @endforeach
                          <br>
                            <a href="{{ route('provider.bookings.index') }}"><button class="btn btn-primary pl-10">{{ tr('view_all') }}</button></a>
              
                          @else
                              <tr><td colspan=5><h3>{{ tr('no_booking_found') }}</h3></td></tr>
                          @endif


                  </div>
                  
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-6 col-lg-6">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">{{ tr('hosts') }}</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row">
                     <div class="col-md-10 col-md-offset-1">
                         <div class="panel panel-default">
                             <div class="panel-heading"><b>{{ tr('hosts_status') }}</b></div>
                             <div class="panel-body">
                                 <canvas id="canvas"></canvas>
                             </div>
                         </div>
                     </div>
                   </div>
                
                </div>


                
              </div>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

@endsection