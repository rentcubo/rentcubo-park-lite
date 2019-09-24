@extends('layouts.user')

@section('content')

<section class="booking_management_container">
  <div class="container">
    <!-- Page Heading -->
    <h2 class="h2 mb-1 text-gray-800 booking">{{ tr('bookings_index') }}</h2>
    <p class="mb-4">{{ tr('booking_index_info') }}</p>

    @php  $sno = 0; @endphp

     <div class="card shadow mb-3">        
     @include('notifications.notification')    
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table" id="dataTable"  width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>{{ tr('sno') }}</th>
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

                          @if($booking->host()->first()!=NULL)

                            <a href="{{ route('hosts.view',$booking->host()->first()->id) }}">{{ $booking->host()->first()->host_name }}</a>                    
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
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">

                                  <li><a href="{{ route('bookings.view',$booking->id) }}" class="dropdown-item">{{ tr('view') }}</a></li>

                                  @if($booking->status == BOOKING_CREATED)
                                      
                                      <li><a href="{{ route('bookings.checkin',$booking->id) }}" class="dropdown-item" onclick="return confirm('{{ tr('checkin_confirm')}}')">{{ tr('checkin') }} </a></li>
                                  @endif

                                   @if($booking->status == BOOKING_CHECKIN )
                                      
                                      <li><a href="{{ route('bookings.checkout',$booking->id) }}" class="dropdown-item" onclick="return confirm('{{ tr('checkout_confirm')}}')">{{ tr('checkout') }} </a></li>
                                
                                  @endif

                                  @if($booking->status ==BOOKING_CREATED)
                                    <div class="dropdown-divider"></div>
                                      
                                      <li><a href="{{ route('bookings.status',$booking->id) }}" class="dropdown-item" onclick="return confirm('{{ tr('booking_delete')}}')">{{ tr('cancel') }} </a></li>
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
</section>
	
  <!-- /.container-fluid --> 
@endsection