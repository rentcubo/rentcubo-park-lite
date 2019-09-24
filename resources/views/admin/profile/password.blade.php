@extends('layouts.admin') 
@section('content')

    <div class="content-wrapper">

       <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">{{ tr('admin_profile') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.profile.view') }}">{{ tr('admin_profile') }}</a></li>
                            <li class="breadcrumb-item active">{{ tr('change_password') }}</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.profile.view') }}" class="btn btn-primary pull-right hidden-sm-down">{{ tr('admin_profile') }}</a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                @include('notifications.notification')



                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ tr('admin_profile') }}</h4>

                                <form method="post" action="{{ route('admin.profile.password') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">

                                        <label class="oldpassword">{{ tr('old_password') }} *</label>
                                        <input type="password" class="form-control" name="oldpassword" placeholder="{{ tr('old_password') }}" value="{{ old('old_password') }}" required />
                                    </div>
                                    <div class="form-group">
                                                    
                                        <label class="password">{{ tr('new_password') }} *</label>

                                        <input type="password" name="password" class="form-control" placeholder="{{ tr('new_password') }}" value="{{ old('password') }}" required >

                                    </div>
                                    <div class="form-group">
                                                    
                                        <label class="cpassword">{{ tr('confirm_new_password') }} *</label>

                                        <input type="password" name="password_confirmation" class="form-control" placeholder="{{ tr('confirm_new_password') }}"  value="{{ old('password_confirmation') }}" required>
                                                    
                                    </div>
                                  
                                    <button type="submit" class="btn btn-primary">{{ tr('change_password') }}</button>
                                 </form>
                            </div>
                        </div>    
                    </div>    
        
    </div>


@endsection
