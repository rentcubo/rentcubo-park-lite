@extends('layouts.user') 

@section('content')

  <section class="single_host">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">

                    <img class="img" src="{{ $host_details->picture }}" alt="{{ $host_details->host_name }}">

                    <p class="p">{{ tr('space_name') }}:<a href="">{{ $host_details->host_name }}</a></p>

                    <p class="p">{{ tr('description') }}:</p>

                    <p class="Description">* {{ $host_details->description }}</p>

                    <p class="p">{{ tr('full_address') }}:</p>

                    <p class="address"> {{ $host_details->full_address }}</p>

                    <h2 class="h2"><span class="span">{{ tr('host') }}</span> {{ tr('is') }} <a href=""><c class="loc"> {{ $host_details->host_type }}
                    </c></a></h2>

                    <h2 class="h2"><span class="span">{{ tr('location') }}</span> {{ tr('on') }} <a href=""><c class="loc">
                        {{ $host_details->service_location_name }}
                    </c></a></h2>

           
                      {{-- <div class="rating">
                        <label>
                          
                          <input type="radio" name="stars" checked/>
                          @for($i=0; $i< $host_details->booking_rating; $i++)
                            <span class="icon">★</span>
                          @endfor
                          
                        </label>
                        <label> 
                          <span class="icon">★</span>
                          <span class="icon">★</span>
                          <span class="icon">★</span>
                          <span class="icon">★</span>
                          <span class="icon">★</span>
                          <b class="b">({{ $host_details->booking_rating_count }})</b>
                        </label> 
                      </div> --}}

                    <div class="rating">
                        
                        <div class="row">
                            
                            <div class="host-rating"></div>
                            <b class="b">({{ $host_details->booking_rating_count }})</b>
                        </div>
                        
                    </div>

                  
                    <p class="p"><a href="">{{ tr('available_spaces') }}:  <b>{{ $host_details->total_spaces }}</b></a></p>
                    <p class="p"><a href="">{{ tr('per_hour') }}:  <b>{{ formatted_amount($host_details->per_hour) }}</b></a></p>

                </div>

                <div class="col-sm-5 other border-left rounded-top border-success ">
                    
                    <div class="card booking-pos">
                        <div class="card-shadow ">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                              <h6 class="m-0 font-weight-bold text-primary">{{ tr('booking') }}</h6>
                            </div>
                            @include('notifications.notification')

                            <div class="card-body">
                                <form action="{{ route('bookings.save' , $host_details->id )}}"  method="POST">
                                    @csrf

                                    <input type="hidden" name="id" class="id" value="{{ $host_details->id }}">
                                    <div class="row">         
                                        <div class="col-6 form-group pmd-textfield pmd-textfield-floating-label">
                                            <label class="control-label" for="check_in">{{ tr('checkin') }} * </label>
                                           {{--  <input type="datetime-local" name="check_in" class="check_in form-control" value="{{ old('check_in') }}" onchange="checkin_func(this)"  step="1" required  /> --}}

                                           <input type='datetime' class="form-control" placeholder="{{ tr('checkin') }}" name="check_in" id='check_in' autocomplete="off" />
                                        </div>

                                        <div class="col-6 form-group pmd-textfield pmd-textfield-floating-label">
                                            <label class="control-label" for="check_out">{{ tr('checkout') }} *</label>
                                            {{-- <input type="datetime-local" name="check_out" class="form-control check_out" value="{{ old('check_out') }}" onchange="checkout_func(this);" step="1"  required /> --}}

                                            <input type='datetime' class="form-control" name="check_out" id='check_out' placeholder="{{ tr('checkout') }}" autocomplete="off"/>
                                        </div>

                                    </div>
                                    <br>

                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label" for="description">{{ tr('description') }} * </label>
                                        <input type="text" name="description" placeholder="{{ tr('description') }}" value="{{ old('description') }}" class="form-control " id="description" required />
                                    </div>
                                    <br>

                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        <label class="control-label" >{{ tr('mode_of_payment'). ' : ' .tr('cod') }}</label>
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" name = "check" type="checkbox" id="gridCheck" required>
                                            <label class="form-check-label" for="gridCheck"><a {{ route('pages','terms') }}>{{ tr('terms') }}</a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                        
                                         <input type="hidden" name="timezone" class="form-control " id="timezone"  value="" />

                                    </div>

                                    <br>

                                    <input type="submit" class="btn btn-info submit" name="submit"  id="submit" value="{{ tr('book_now') }}">

                                    </form>

                            </div>
                        </div>
                    </div>     
                </div>      
            </div>
        </div>
    </section>
    
    <!--Section_end-->

{{-- Datetime Plugin --}}
<script type="text/javascript" src="{{asset('user-assets/js/Intimidatetime.js')}}"> </script>
<link rel="stylesheet" type="text/css" href="{{ asset('user-assets/css/Intimidatetime.css') }} ">

{{-- Rating Plugin --}}
<script type="text/javascript" src="{{asset('user-assets/js/jquery.star-rating-svg.min.js')}}"> </script>
<link rel="stylesheet" type="text/css" href="{{ asset('user-assets/css/star-rating-svg.css') }} ">

<script type="text/javascript">

    $(".host-rating").starRating({
        starSize: 25,
        initialRating: "{{ $host_details->booking_rating }}",
        readOnly: true,
        callback: function(currentRating, $el){
            // make a server call here
        }
    });

</script>

    <script type="text/javascript">

        timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

        document.getElementById('timezone').value = timezone;
    </script>

<script type="text/javascript">
    $('#check_in').intimidatetime();
    $('#check_out').intimidatetime();
</script>
@endsection