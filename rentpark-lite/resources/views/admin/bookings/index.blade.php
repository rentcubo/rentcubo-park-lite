@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

        <!-- ================ Bread crumb ===================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{ tr('list_bookings') }}</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                    <li class="breadcrumb-item active">{{ tr('list_bookings') }}</li>
                </ol>
            </div>
        </div>
        <!-- ================ End Bread crumb =================== -->
         
        @include('notifications.notification')

        @php  $sno = 0; @endphp

		<div class="row">
        
        <!-- column -->
        <div class="col-12">
        
            <div class="card">
        
                <div class="card-body">
        
                    <h4 class="card-title">{{ tr('users') }}</h4>                    
        
                    <div class="table-responsive">
                        
                        <table class="table">
				         	<tr>			                  	
				                <th>{{ tr('sno') }}</th>
				                <th>{{ tr('user_name') }}</th>
				                <th>{{ tr('provider_name') }}</th>
				                <th>{{ tr('host_name') }}</th>
				                <th>{{ tr('checkin') }}</th>
				                <th>{{ tr('checkout') }}</th>
				                <th>{{ tr('status') }}</th>
				                <th>{{ tr('action') }}</th>
				            </tr>
			            	               	
							@if(count($bookings)>0)

								@foreach($bookings as $booking_details)
							        <tr>
							            <td>{{ ++$sno }}</td>
							            <td>

							            	@if($booking_details->user()->first()!=NULL)

							            		<a href="{{ route('admin.users.view',['user_id' => $booking_details->user()->first()->id]) }}">{{ $booking_details->user()->first()->name }}</a>
							            	@else
							            		{{ tr('no_user_available') }}
							            	@endif	
							            	</td>

							            <td>
							            	@if($booking_details->provider()->first()!=NULL)

							            		<a href="{{ route('admin.providers.view',$booking_details->provider()->first()->id) }}">{{ $booking_details->provider()->first()->name }}</a>
							            	@else
							            		{{ tr('no_provider_available') }}
							            	@endif

							            </td>
										<td>

											@if($booking_details->host()->first()!=NULL)

												<a href="{{ route('admin.hosts.view',$booking_details->host()->first()->id) }}">{{ $booking_details->host()->first()->host_name }}</a>										
											@else
												{{ tr('no_host_available') }}
											@endif
										</td>

										<td>{{ $booking_details->checkin }}</td>
										<td>{{ $booking_details->checkout }}</td>										
								       	{!! booking_status($booking_details->status) !!}

										<td><a href="{{ route('admin.bookings.view',$booking_details->id) }}" class="btn btn-info">{{ tr('view') }}</a></td>
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
	
	</div>
	
@endsection

