@extends('layouts.admin')

@section('content')

    <div class="content-wrapper">

        <!-- ================ Bread crumb ===================== -->
        <div class="row page-titles">         
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{ tr('edit_user') }}</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ tr('view_users') }}</a></li>
                    <li class="breadcrumb-item active">{{ tr('edit_user') }}</li>
                </ol>
            </div>
         
            <div class="col-md-7 align-self-center">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary pull-right hidden-sm-down">{{ tr('view_users') }}</a>
            </div>
       
        </div>
        <!-- ================ End Bread crumb =================== -->

        @include('notifications.notification')

        @include('admin.users._form')

    </div>

@endsection