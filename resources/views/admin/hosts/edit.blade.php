@extends('layouts.admin')

@section('content')

    <div class="content-wrapper">

       <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">{{ tr('edit_host') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.hosts.index') }}">{{ tr('view_hosts') }}</a></li>
                            <li class="breadcrumb-item active">{{ tr('edit_host') }}</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.hosts.index') }}" class="btn btn-primary pull-right hidden-sm-down">{{ tr('view_hosts') }}</a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                 @include('notifications.notification')


        @include('admin.hosts._form')
    </div>
@endsection