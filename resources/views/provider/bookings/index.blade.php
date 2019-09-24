@extends('layouts.provider')

@section('content')

	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">{{ tr('bookings_index') }}</h1>
          <p class="mb-4">{{ tr('booking_index_info') }}</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ tr('list_bookings') }}</h6>
            </div>
            @php  $sno = 0; @endphp

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>{{ tr('sno') }}</th>
                      <th>{{ tr('user_name') }}</th>
                      <th>{{ tr('host_name') }}</th>
                      <th>{{ tr('checkin') }}</th>
                      <th>{{ tr('checkout') }}</th>
                      <th>{{ tr('status') }}</th>
                      <th>{{ tr('action') }}</th>
                    </tr>
                  </thead>
                
                   @if(count($bookings)>0)
              @foreach($bookings as $booking)
                    <tr>
                        <td>{{ ++$sno }}</td>
                        <td>

                          @if($booking->user()->first()!=NULL)

                            {{ $booking->user()->first()->name }}
                          @else
                            {{ tr('no_user_available') }}
                          @endif  
                        </td>


                  <td>

                    @if($booking->host()->first()!=NULL)

                      <a href="{{ route('provider.hosts.view',$booking->host()->first()->id) }}">{{ $booking->host()->first()->host_name }}</a>                    
                    @else
                      {{ tr('no_host_available') }}
                    @endif
                  </td>

                  <td>{{ $booking->checkin }}</td>
                  <td>{{ $booking->checkout }}</td>                   
                      
                      {!! booking_status($booking->status) !!}

                  <td>
                    <div class="dropdown">
                      <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">{{ tr('action') }}
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a href="{{ route('provider.bookings.view',$booking->id) }}" class="dropdown-item">{{ tr('view') }}</a></li>
                                        
                        @if($booking->status ==BOOKING_CREATED)
                            <div class="dropdown-divider"></div>
                              <li><a href="{{ route('provider.bookings.status',$booking->id) }}" class="dropdown-item">{{ tr('cancel') }}</a></li>
                        @endif
                      </ul>
                    </div> 
                  </td>
                </tr>

                @endforeach            
                     
                @else
                    <tr><td colspan=5><h3>{{ tr('no_booking_found') }}</h3></td></tr>
                @endif
                      
            </table>

              {{$bookings->links()}}

              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
@endsection