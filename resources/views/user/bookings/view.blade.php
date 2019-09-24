@extends('layouts.user')

@section('content')

<section class="booking_management_container">
  <div class="container">

  	<!-- Page Heading -->
    <h2 class="h2 mb-1 text-gray-800 booking">{{ tr('booking_detail') }}</h2>
    <p class="mb-4">{{ tr('view_booking_info') }}</p>
    @include('notifications.notification')

  	 <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
		            <div class="box-body">
		              <table class="table no-border ">

		                <tr>
		                  	<th>{{ tr('details') }}</th>
		                  	<th>{{ tr('booking_data') }}</th>
		                </tr>

		             	<tr>
		             		<td>{{ tr('host_name') }}</td>
		             		<td>
								<a href="{{ route('hosts.view', $booking_details->host_id) }}">{{ $booking_details->host_name }}</a>
						     </td>	
		             	</tr>

		             	<tr>
		             		<td>{{ tr('provider_name') }}</td>
		             		<td>

								{{ $booking_details->provider_name }}

		             		</td>
		             	</tr>

		             	<tr>
		             		<td>{{ tr('location') }}</td>
		             		<td>
								
								{{ $booking_details->location}}

		             		</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('description') }}</td>
		             		<td>{{ $booking_details->description }}</td>
		             	</tr>

		             	<tr>
		             		<td>{{ tr('checkin_time') }}</td>
		             		<td>{{ $booking_details->checkin }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('checkout_time') }}</td>
		             		<td>{{ $booking_details->checkout }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('duration') }}</td>
		             		<td>{{ time_show($booking_details->duration) }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('mode_of_payment') }}</td>
		             		<td>{{ $booking_details->payment_mode }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('per_hour') }}</td>
		             		<td>{{ formatted_amount($booking_details->per_hour) }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('total') }}</td>
		             		<td>{{ formatted_amount($booking_details->total) }}</td>
		             	</tr>	


		             	<tr>
		             		<td>{{ tr('status') }}</td>
		             		
		             		{!! booking_status($booking_details->status) !!}

		             	</tr>	

		             	@if($booking_details->status==BOOKING_PROVIDER_CANCEL & $booking_details->status==BOOKING_USER_CANCEL)
			             	<tr>
			             		<td>{{ tr('cancelled_date') }}</td>
			             		<td>{{ $booking_details->cancelled_date }}</td>
			             	</tr>
			             @endif

			             @if($booking_details->status==BOOKING_CHECKOUT)
		                  <tr>
		                    <td>{{ tr('review') }}</td>

		                    <td><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">{{ tr('click_me') }}</button></td>   

		                    <div class="modal fade" id="myModal" role="dialog">
		                      <div class="modal-dialog">
		                      
		                        <!-- Modal content-->
		                        <div class="modal-content">
		                          <div class="modal-header">
		                          	<h3 class="h3 text-success" >{{ tr('submit_review') }}</h3>
		                            <button type="button" class="close" data-dismiss="modal">&times;</button>
		                          </div>
		                          <div class="modal-body">
		                            <form action="{{ route('bookings.rating', $booking_details->id) }}" method="post">       
		                              @csrf

		                              <input type="hidden" name="booking_id" class="form-control" value="{{ $booking_details->id }}" >

		                                  <div class="rating" class="form-control">
		                                  
		                                  <label>
		                                    <input type="radio" name="rating" value="1" @if($booking_details->users_review()->first()!=NULL) {{ $booking_details->users_review()->first()->rating == '1' ? 'checked' : '' }} @endif/>
		                                    <span class="icon">★</span>
		                                  </label>
		                                  <label>
		                                    <input type="radio" name="rating" value="2" @if($booking_details->users_review()->first()!=NULL) {{ $booking_details->users_review()->first()->rating == '2' ? 'checked' : '' }} @endif/>
		                                    <span class="icon">★</span>
		                                    <span class="icon">★</span>
		                                  </label>
		                                  <label>
		                                    <input type="radio" name="rating" value="3" @if($booking_details->users_review()->first()!=NULL) {{ $booking_details->users_review()->first()->rating == '3' ? 'checked' : '' }} @endif/>
		                                    <span class="icon">★</span>
		                                    <span class="icon">★</span>
		                                    <span class="icon">★</span>   
		                                  </label>
		                                  <label>
		                                    <input type="radio" name="rating" value="4" @if($booking_details->users_review()->first()!=NULL) {{ $booking_details->users_review()->first()->rating == '4' ? 'checked' : '' }} @endif/>
		                                    <span class="icon">★</span>
		                                    <span class="icon">★</span>
		                                    <span class="icon">★</span>
		                                    <span class="icon">★</span>
		                                  </label>
		                                  <label>
		                                    <input type="radio" name="rating" value="5" @if($booking_details->users_review()->first()!=NULL) {{ $booking_details->users_review()->first()->rating == '5' ? 'checked' : '' }} @endif/>
		                                    <span class="icon">★</span>
		                                    <span class="icon">★</span>
		                                    <span class="icon">★</span>
		                                    <span class="icon">★</span>
		                                    <span class="icon">★</span>
		                                  </label>
		                                </div> 
		                                     
		                              

		                              <div class="form-group">
		                                  <label>{{ tr('review') }} *</label>
		                                  <input type="text" name="review" class="form-control "  placeholder="{{ tr('review') }}" @if($booking_details->users_review()->first()!=NULL) value="{{ $booking_details->users_review()->first()->review}}"@endif>

		                              </div> 
		                               
		                               
		                                <input type="submit" name="submit" value="{{ tr('submit') }}">
		                       
		                            </form>
		                          </div>
		                          <div class="modal-footer">
		                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ tr('close') }}</button>
		                          </div>
		                        </div>
		                        
		                      </div>
		                    </div>               
		                  </tr>  
		                  @endif  

		                  @if($booking_details->status == BOOKING_COMPLETED)

		                    <tr>
		                      <td>{{ tr('review') }}</td>
		                      <td>@if($booking_details->users_review()->first()!=NULL) 
		                          {{ $booking_details->users_review()->first()->review}}
		                        @endif
		                      </td>
		                    </tr>

		                    <tr>
		                      <td>{{ tr('rating') }}</td>
		                      <td><div class="booking-rating"></div></td>

		                    </tr>

		                  @endif
		             	
		             	<tr>
			             	@if($booking_details->status == BOOKING_CREATED )
	                                      
		                         <td><a href="{{ route('bookings.checkin',$booking_details->id) }}" class="btn btn-primary button" onclick="return confirm('{{ tr('checkin_confirm')}}')">{{ tr('checkin') }} </a></td>
		                     @endif

		                     @if($booking_details->status == BOOKING_CHECKIN )
		                          
		                         <td><a href="{{ route('bookings.checkout',$booking_details->id) }}" class="btn btn-info button" onclick="return confirm('{{ tr('checkout_confirm')}}')">{{ tr('checkout') }} </a></td>
		                     @endif	  

			             	@if($booking_details->status == BOOKING_CREATED)
	                                  
			             		<td><a href="{{ route('bookings.status',$booking_details->id) }}" class="btn btn-danger button" onclick="return confirm('{{ tr('booking_delete')}}')">{{ tr('booking_cancel') }}</a></td>

			             	@endif
		             	</tr>
		              </table>
		        
		            </div>
	          </div>								
			</div>							
		</div>
	</div>
  </div>
</section>

	<script type="text/javascript" src="{{asset('user-assets/js/jquery.star-rating-svg.min.js')}}"> </script>
	<link rel="stylesheet" type="text/css" href="{{ asset('user-assets/css/star-rating-svg.css') }} ">
	<script type="text/javascript">

        $(".booking-rating").starRating({
            starSize: 20,
            initialRating: "{{ $booking_details->rating }}",
            readOnly: true,
            callback: function(currentRating, $el){
                // make a server call here
            }
        });
	</script>
	
  
@endsection