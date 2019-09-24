@extends('layouts.user')

@section('content')

    <!--Section_Content_First_Start-->
    <section>

        <div class="bg-img">

            <div class="bg_content">

                <h1>{{ tr('find_parkings') }}</h1>

                <p>{{ tr('choose_spaces_info') }}</p>

                <div class="click_option">
                    <span id="demo1" class="click_option1" onclick="myFunction1()">{{ tr('hourly') }}</span>
                    <span id="demo" class="click_option2" onclick="myFunction()">{{ tr('monthly') }}</span>
                </div>

                <form action="{{ route('hosts.index') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <span>{{ tr('parking_at') }}</span><br>
                        <input class="form-control input-lg" id="inputl" name="search" type="text11" placeholder="Where do you want to park?">
                        <button class="material-icons">&#xe55c;</button>
                    </div>
                    
                    <div class="input-group">
                        {{-- <input type="text1" class="form-control_1" placeholder="Select a date & time"><i class="fas fa-angle-down"></i>
                        <small aria-hidden="true">ARRIVING ON</small>
                        <input type="text2" class="form-control_2" placeholder="Select a date & time">
                        
                        <div class="i">
                            <i class="fas fa-angle-down"></i>
                        </div>

                        <small class="small">LEAVING ON</small> --}}

                        <button type="click_option_btn" class="btn btn-primary btn-lg btn-block">{{ tr('show_parking_spaces') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!--Section_Content_First_end-->

    <!--Section_Content_Second_Start-->
    <section class="index">
        <div class="container">
            <h1>{{ tr('parking_made_easy') }}</h1>
            <div class="row justify-content-md-center">
                <div class="col">
                    <div class="circle">
                        <img src="{{ asset('user-assets/img/2.png') }}">
                        <hr>
                    </div>

                    <div>
                        <strong>{{ tr('whenever_whereever') }}</strong>
                    </div>

                    <div>
                        <small><p> {{ tr('choose_millions_across') }}<span>{{ tr('the_uk') }}</span></p></small>
                        <small><p>{{ tr('find_your_best_option') }} <span>{{ tr('journey') }}</span></p></small>
                    </div>

                </div>

                <div class="col">
                    <div class="circle">
                        <img src="{{ asset('user-assets/img/3.png') }}">
                        <hr>
                    </div>
                            
                    <div>
                        <strong><span>{{ tr('piece_of_mind') }}</span></strong>
                    </div>
                        
                    <div>
                        <small><p>{{ tr('view_information_on') }}<span>{{ tr('and_restrictions') }}</span></p></small>
                        <small><p>{{ tr('reserve_in_advance') }}</p></small>
                    </div>
                </div>
                    
                <div class="col">
                    <div class="circle">
                        <img src="{{ asset('user-assets/img/4.png') }}">
                    </div>
                        
                    <div>
                        <strong>{{ tr('seemless_experience') }}</strong>
                    </div>
                        
                    <div>
                        <small><p>{{ tr('pay_for_rentpark') }}</p></small>
                        <small><p>{{ tr('follow_easy_directions') }}</p></small>
                    </div>
                </div>
            </div>
        </div>
    </section>      

    <!--Section_Content_Second_end-->

    <!--Section_Content_Third_Start-->
    <section class="bg-img_first">
        <div class="bg_content_first">
            <h2>{{ tr('download_the') }}<span>{{ tr('uks_favourite') }}</span> {{ tr('parking_app') }}</h2>

            <p>{{ tr('rated_5_stars') }}</p><br>

            <p class="p1">{{ tr('enter_email_address_to_download') }}</p>

            <input type="textarea" placeholder="{{ tr('enter_email') }}" ><button class="index_btn" align="center">{{ tr('send_link') }}</button>

            <p class="p2">{{ tr('or_download_from') }}</p>

            <img class="favicon_img" src="{{ asset('user-assets/img/apple.svg') }}"><img class="favicon_img" src="{{ asset('user-assets/img/google.svg') }}">
        </div>
    </section>

    <!--Section_Content_Third_end-->

    <!--Section_Content_Four_Start-->
    <section class="bg-img_second">

        <div class="bg_content_second">

            <h2>{{ tr('rent_out_parking') }}</h2>

            <p>{{ tr('make_easy_tax_free') }}</p>

            <button type="submit_btn1">{{ tr('learn_how_to_earn_today') }}</button>
        </div>
    </section>
        
    <!--Section_Content_Four_end-->

    <!--Section_Slider_Start-->
    <section class="sliderhead">
        <h2>{{ tr('what') }} <span>{{ tr('users') }}</span> {{ tr('are_saying') }}</h2>

        <p>{{ tr('dont_just_take') }}</p> 

        <p>{{ tr('customer_reviews_for_london') }}</p>
    </section>

    <section class="center slider">
        <div>
            <div class="slidertop">
                <p>{{ tr('simple_and_easy_to_use') }}
                </p>
            </div>
            
            <img class="sliderimg" src="{{ asset('user-assets/img/s1.jpg') }}">
            
            <div class="sliderbottom">
                <h6>Gemma T</h6>
                <p>Marriot Bristol Royal Car Park, Bristol</p>
                <span><i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i></span>
            </div>
        </div>

        <div>
            <div class="slidertop">
                <p>{{ tr('simple_and_easy_to_use') }}
                </p>
            </div>

            <img class="sliderimg" src="{{ asset('user-assets/img/s2.jpg') }}">

            <div class="sliderbottom">
                <h6>Carol N</h6>
                <p>Marriot Bristol Royal Car Park, Bristol
                </p>
                <span><i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i></span>
            </div>
        </div>

        <div>
            <div class="slidertop">
                <p>{{ tr('simple_and_easy_to_use') }}
                </p>
            </div>

            <img class="sliderimg" src="{{ asset('user-assets/img/s3.jpg') }}">

            <div class="sliderbottom">
                <h6>Carol N</h6>
                <p>Marriot Bristol Royal Car Park, Bristol
                </p>
                <span><i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i></span>
            </div>
        </div>

        <div>
            <div class="slidertop">
                <p>{{ tr('simple_and_easy_to_use') }}
                </p>
            </div>  

            <img class="sliderimg" src="{{ asset('user-assets/img/s4.jpg') }}">

            <div class="sliderbottom">
                <h6>Carol N</h6>
                <p>Marriot Bristol Royal Car Park, Bristol
                </p>
                <span><i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i></span>
            </div>
        </div>

        <div>   
            <div class="slidertop">
                <p>{{ tr('simple_and_easy_to_use') }}
                </p>
            </div>

            <img class="sliderimg" src="{{ asset('user-assets/img/s5.png') }}">

            <div class="sliderbottom">
                <h6>Carol N</h6>
                <p>Marriot Bristol Royal Car Park, Bristol
                </p>
                <span><i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i></span>
            </div>
        </div>

        <div>   
            <div class="slidertop">
                <p>{{ tr('simple_and_easy_to_use') }}
                </p>
            </div>

            <img class="sliderimg" src="{{ asset('user-assets/img/s6.png') }}">
            
            <div class="sliderbottom">
                <h6>Carol N</h6>
                <p>Marriot Bristol Royal Car Park, Bristol
                </p>
                <span><i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i>
                <i class="fa fa-star checked"></i></span>
            </div>
        </div>
    </section>

    <!--Section_Slider_end-->

    <!--Section_Content_Fifth_Start-->

    <section class="bg-img_third">
        <div class="bg_content_third">
            <h3>{{ tr('car_park_management') }}</h3>
            <p>{{ tr('maximised_yield_of_app') }}
            </p>
            <button type="submit_btn2">{{ tr('learn_about_solution') }}</button>
        </div>
    </section>

    <!--Section_Content_Fifth_end-->

@endsection

