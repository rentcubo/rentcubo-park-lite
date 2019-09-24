@extends('layouts.admin')

@section('content')

    <!-- =========== Container fluid ==========================-->
    <div class="container-fluid">
        
        <!-- ================ Bread crumb ===================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{ tr('dashboard') }}</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                    <li class="breadcrumb-item active">{{ tr('dashboard') }}</li>
                </ol>
            </div>
        </div>
        <!-- ================ End Bread crumb ================= -->

        <!-- =============== List ============================= -->
        <div class="row">
           
            <!-- =========== Total Users =========== -->
            <div class="col-lg-3 col-md-6">
                <div class="card card-body mailbox " style="height: 150px">
                    <h5 class="card-title">{{ tr('total_users') }}</h5>
                    <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                        <!-- Message-->
                        <a href="{{ route('admin.users.index') }}" class="size">
                            <div class="btn btn-danger btn-circle">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="mail-contnet pl-3 pt-2"> 
                                <span class="mail-desc"> <h2>{{ $data->total_users }}</h2> </span> 
                            </div>
                        </a>
                        
                    </div>
                </div>
            </div>
            <!-- =========== End Total Users ===========-->

            <!-- =========== Total Providers ===========-->
            <div class="col-lg-3 col-md-6">
                <div class="card card-body mailbox " style="height: 150px">
                    <h5 class="card-title">{{ tr('total_providers') }}</h5>
                    <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                        <!-- Message-->
                        <a href="{{ route('admin.providers.index') }}" class="size">
                            <div class="btn btn-info btn-circle"><i class="fa fa-user"></i></div>
                            <div class="mail-contnet pl-3 pt-2"> 
                                <span class="mail-desc"> <h2>{{ $data->total_providers ?? 0 }}</h2> </span>
                            </div>
                        </a> 

                    </div>
                </div>
            </div>
            <!-- =========== End Total Providers  ===========-->

            <!-- =========== Total Bookings ===========-->
            <div class="col-lg-3 col-md-6">
                <div class="card card-body mailbox " style="height: 150px">
                    <h5 class="card-title">{{ tr('total_bookings') }}</h5>
                    <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                        <!-- Message-->
                        <a href="{{ route('admin.bookings.index') }}" class="size">
                            <div class="btn btn-primary btn-circle"><i class="fa fa-calendar"></i></div>
                            <div class="mail-contnet pl-3 pt-2"> <span class="mail-desc"> <h2>{{ $data->total_bookings ?? 0 }}</h2> </span> </div>
                        </a>
                        
                    </div>
                </div>
            </div>
            <!-- =========== End Total Users ===========-->

            <!-- =========== Total Earnings  ======================-->
            <div class="col-lg-3 col-md-6">
                <div class="card card-body mailbox " style="height: 150px">
                    <h5 class="card-title">{{ tr('total_earnings') }}</h5>
                    <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                        <!-- Message-->
                        <a href="{{ route('admin.bookings.index') }}" class="size">
                            <div class="btn btn-danger btn-circle"><i class="fa fa-dollar"></i></div>
                            <div class="mail-contnet pl-3 pt-2"> <span class="mail-desc"> <h2>{{ formatted_amount($data->total_earnings ?? 0) }}</h2> </span> </div>
                        </a>
                        
                    </div>
                </div>
            </div>
            <!-- =========== End Total Earnings  ===========-->

        </div>
        <!-- =============== End List ========================= -->
 
        <!-- =========== Recent Users and Providers =========== -->
        <div class="row">
            
            <!--  =========== Start Recent Users details ======-->
            <div class="col-lg-6 col-md-12">
                <div class="card card-body mailbox">
                    <h5 class="card-title">{{ tr('recent_users') }}</h5>
                    <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                        @if(count($recent_users)>0)
                            
                            @foreach($recent_users as $user_details)
                            <!-- Message -->
                            <a href="{{ route('admin.users.view',['user_id' => $user_details->id]) }}">
                                <img src="{{ $user_details->picture }}" style="height: 40px; width: 40px" class="rounded-circle">
                                <div class="mail-contnet">
                                    <h5>{{ $user_details->name }}</h5> 
                                    <span class="mail-desc">{{ $user_details->email }}</span> 
                                    <span class="time">{{ $user_details->mobile }}</span> 
                                </div>
                            </a>
                            @endforeach
                            <br>
                        
                        @else
                        
                            <h3>{{ tr('no_user_found') }}</h3>
                              
                        @endif
                        
                    </div>

                    @if(count($recent_users)>0)
                        <br>
                        <a href="{{ route('admin.users.index') }}"><button class="btn btn-primary pl-10">{{ tr('view_all') }}</button></a>
                    @endif

                </div>

            </div>
            <!-- =========== End Recent Users details details =========== -->

            <!-- =========== Start Recent Providers =========== -->
            <div class="col-lg-6 col-md-12">
            
                <div class="card card-body mailbox">
                    <h5 class="card-title">{{ tr('recent_providers') }}</h5>
                   
                    <div class="message-center ps ps--theme_default ps--active-y" data-ps-id="a045fe3c-cb6e-028e-3a70-8d6ff0d7f6bd">
                       
                        @if(count($recent_providers)>0)

                            @foreach($recent_providers as $provider_details)
                                
                                <!-- Message -->
                                <a href="{{ route('admin.providers.view',$provider_details->id) }}">
                                    <img src="{{ $provider_details->picture }}" style="height: 40px; width: 40px" class="rounded-circle">
                                    <div class="mail-contnet">
                                        <h5>{{ $provider_details->name }}</h5> 
                                        <span class="mail-desc">{{ $provider_details->email }}</span> 
                                        <span class="time">{{ $provider_details->mobile }}</span> 
                                    </div>
                                </a> 

                            @endforeach
                        <br> 

                        @else

                            <h3>{{ tr('no_provider_found') }}</h3> 

                        @endif

                    </div>

                    @if(count($recent_providers)>0)

                        <br>

                        <a href="{{ route('admin.providers.index') }}">
                            <button class="btn btn-primary pl-10">{{ tr('view_all') }}</button>
                        </a>
               
                    @endif
               
                </div>

            </div>
            <!-- =========== End Recent Providers details =========== -->
            
        </div>
        <!-- ========= End Recent Users and Providers ======== -->
      
    </div>
    <!-- =========== End Container fluid ======================-->

@endsection