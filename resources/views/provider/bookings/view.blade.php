@extends('layouts.provider') 

@section('content')

  <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="row">
                        <div class="col-md-5">
                             <h1 class="h3 mb-2 text-gray-800">{{ tr('booking_detail') }}</h1>
          <p class="mb-4">{{ tr('view_booking_info') }}</p>
                        </div>
                        <div class="col-md-7">
                            <a href="{{ route('provider.bookings.index') }}"  class="btn btn-primary float-right hidden-sm-down">{{ tr('bookings') }}</a>
                        </div>
                    </div>  
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ tr('booking') }}</h6>
            </div>
            <div class="card-body">
              <table class="table table-borderless">
                    <tr>
                        <th>{{ tr('details') }}</th>
                        <th>{{ tr('booking_data') }}</th>
                    </tr>                                                                                         
                  <tr>
                    <td>{{ tr('user_name') }}</td>
                    <td>

                        @if($booking->user()->first()!=NULL)

                          {{ $booking->user()->first()->name }}
                        @else
                            {{ tr('no_user_available') }}
                        @endif  
                    </td>  
                  </tr>

                  <tr>
                    <td>{{ tr('user_image') }}</td>
                    <td>

                        @if($booking->user()->first()!=NULL)

                         <img src="{{ $booking->user()->first()->picture }}" style="width: 200px;height: 200px">
                        @else
                            {{ tr('no_user_available') }}
                        @endif  
                    </td>  
                  </tr>
                  <td>{{ tr('user_email') }}</td>
                    <td>

                        @if($booking->user()->first()!=NULL)

                          {{ $booking->user()->first()->email }}
                        @else
                            {{ tr('no_user_available') }}
                        @endif  
                    </td>  
                  </tr>

                  <td>{{ tr('user_mobile') }}</td>
                    <td>

                        @if($booking->user()->first()!=NULL)

                          {{ $booking->user()->first()->mobile }}
                        @else
                            {{ tr('no_user_available') }}
                        @endif  
                    </td>  
                  </tr>

                  <tr>
                    <td>{{ tr('host_name') }}</td>
                    <td>

                      @if($booking->host()->first()!=NULL)

                        <a href="{{ route('provider.hosts.view',$booking->host()->first()->id) }}">{{ $booking->host()->first()->host_name }}</a>                   
                      @else
                        {{ tr('no_host_available') }}
                      @endif

                    </td>
                  </tr> 

                  <tr>
                    <td>{{ tr('checkin_time') }}</td>
                    <td>{{ $booking->checkin }}</td>
                  </tr> 

                  <tr>
                    <td>{{ tr('checkout_time') }}</td>
                    <td>{{ $booking->checkout }}</td>
                  </tr> 

                  <tr>
                    <td>{{ tr('mode_of_payment') }}</td>
                    <td>{{ $booking->payment_mode }}</td>
                  </tr> 

                  <tr>
                    <td>{{ tr('total_amount') }}</td>
                    <td>{{ formatted_amount($booking->total) }}</td>
                  </tr> 

                  <tr>
                    <td>{{ tr('status') }}</td>
                    
                    {!! booking_status($booking->status) !!}
                    
                  </tr> 
                  @if($booking->status==BOOKING_COMPLETED)
                  <tr>
                    <td>{{ tr('review') }}</td>

                    <td><button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">{{ tr('click_me') }}</button></td>   

                    <div class="modal fade" id="myModal" role="dialog">
                      <div class="modal-dialog">
                      
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('provider.bookings.rating', $booking->id) }}" method="post">       
                              @csrf

                              <input type="hidden" name="booking_id" class="form-control" value="{{ $booking->id }}" >

                                  <div class="rating" class="form-control">
                                  
                                  <label>
                                    <input type="radio" name="stars" value="1" @if($booking->provider_review()->first()!=NULL) {{ $booking->provider_review()->first()->review == '1' ? 'checked' : '' }} @endif/>
                                    <span class="icon">★</span>
                                  </label>
                                  <label>
                                    <input type="radio" name="stars" value="2" @if($booking->provider_review()->first()!=NULL) {{ $booking->provider_review()->first()->review == '2' ? 'checked' : '' }} @endif/>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                  </label>
                                  <label>
                                    <input type="radio" name="stars" value="3" @if($booking->provider_review()->first()!=NULL) {{ $booking->provider_review()->first()->review == '3' ? 'checked' : '' }} @endif/>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>   
                                  </label>
                                  <label>
                                    <input type="radio" name="stars" value="4" @if($booking->provider_review()->first()!=NULL) {{ $booking->provider_review()->first()->review == '4' ? 'checked' : '' }} @endif/>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                  </label>
                                  <label>
                                    <input type="radio" name="stars" value="5" @if($booking->provider_review()->first()!=NULL) {{ $booking->provider_review()->first()->review == '5' ? 'checked' : '' }} @endif/>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                  </label>
                                </div> 
                                     
                              

                              <div class="form-group">
                                  <label>{{ tr('comments') }} *</label>
                                  <input type="text" name="comment" class="form-control "  placeholder="{{ tr('comments') }}" @if($booking->provider_review()->first()!=NULL) value="{{ $booking->provider_review()->first()->comment}}"@endif>

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

                  @if($booking->status == BOOKING_COMPLETED)

                    <tr>
                      <td>{{ tr('comment') }}</td>
                      <td>@if($booking->provider_review()->first()!=NULL) 
                          {{ $booking->provider_review()->first()->comment}}
                        @endif
                      </td>
                    </tr>

                    <tr>
                      <td>{{ tr('rating') }}</td>

                      <td>


                        @if($booking->provider_review()->first()!=NULL)                           

                              <div class="booking-rating"></div>
                          @endif
                      </td>
                    </tr>

                  @endif       

                  <tr>
                    <td>
                      @if($booking->status == BOOKING_CREATED)
              
                        <a href="{{ route('provider.bookings.status',$booking->id) }}" class="btn btn-danger">{{ tr('cancel') }}</a>
                      @endif
                    </td>
                  </tr>    
                  
                  </table>


            </div>
          </div>

        </div>

  <!-- /.container-fluid -->

  <script src="{{ asset('provider-assets/vendor/jquery/jquery.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('provider-assets/js/jquery.star-rating-svg.min.js')}}"> </script>

  <link rel="stylesheet" type="text/css" href="{{ asset('provider-assets/css/star-rating-svg.css') }} ">
  <script type="text/javascript">

        $(".booking-rating").starRating({
            starSize: 20,
            initialRating: "{{ $booking->rating }}",
            readOnly: true,
            callback: function(currentRating, $el){
                // make a server call here
            }
        });
  </script>
@endsection