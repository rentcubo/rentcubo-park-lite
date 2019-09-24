@extends('layouts.user')

@section('content')

	<!--Section_Content_Start-->

    <section class="hosts">
        <div class="container">
            @include('notifications.notification')
            @if(count($hosts)>0)

                    <div class="row">
                        @foreach($hosts as $i => $host)
                            <div class="col-md-4">                
                                <a href="{{ route('hosts.view', $host->id) }}">
                                    <img class="img" src="{{ $host->picture }}" alt="{{ $host->host_name }}">
                                    <h2 class="h2"><span class="span">{{ $host->host_name }}</span> is <c class="loc">{{ $host->host_type }}</c></h2>
                                    {{-- <span>
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                        <i class="fa fa-star checked"></i>
                                        <b class="b">(3,376)</b>
                                    </span> --}}

                                    {{-- <div class="rating">
                                        <label>

                                          @for($i=0; $i< $host->booking_rating; $i++)
                                            
                                            <i class="fa fa-star checked"></i>
                                          @endfor
                                          
                                        </label>
                                        <label> 
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>

                                          <b class="b">({{ $host->booking_rating_count }})</b>
                                        </label> 

                                      </div>

 --}}

                                    <div class="row">
                                            <div class="host-rating-{{ $i }}"></div> 
                                            <b class="b">({{ $host->booking_rating_count }})</b>
                                    </div>        

                                    <span>
                                        <p class="p">{{ formatted_amount($host->per_hour?:0) }}</p>
                                        <h6 class="h6">{{ tr('per_hour_price') }}</h6>
                                    </span>

                                    <h4 class="h4">
            
                                        {{ $host->service_location_name }}
                                      
                                    </h4>
                                    <h5 class="h5">{{ tr('location') }}</h5>
                                </a>
                            </div>
                        @endforeach
                    </div>

            @else
 
                <h2>{{ tr('no_host_found') }}</h2>

            @endif
        </div>
        @if(count($hosts)>0)
                
                <div>{{ $hosts->links() }}</div>
        @endif
    
    </section>
    
    <!--Section_Content_end-->
<script type="text/javascript" src="{{asset('user-assets/js/jquery.star-rating-svg.min.js')}}"> </script>
<link rel="stylesheet" type="text/css" href="{{ asset('user-assets/css/star-rating-svg.css') }} ">

<script type="text/javascript">


    @foreach($hosts as $i => $host)
        $(".host-rating-{{ $i }}").starRating({
            starSize: 20,
            initialRating: "{{ $host->booking_rating }}",
            readOnly: true,
            callback: function(currentRating, $el){
                // make a server call here
            }
        });
    @endforeach
</script>

@endsection