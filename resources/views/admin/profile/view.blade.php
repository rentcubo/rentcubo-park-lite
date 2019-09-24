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
                            <li class="breadcrumb-item active">{{ tr('admin_profile') }}</li>
                        </ol>
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

		            <div class="box-body">
		              <table class="table ">
		                <tr>
		                  	<th>{{ tr('details') }}</th>
		                  	<th>{{ tr('admin_data') }}</th>
		                </tr>
		             	<tr>
		             		<td>{{ tr('name') }} </td>
		             		<td>{{ $admin->name }}</td>	
		             	</tr>

		             	<tr>
		             		<td>{{ tr('email') }}</td>
		             		<td>{{ $admin->email }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('mobile') }}</td>
		             		<td>{{ $admin->mobile }}</td>
		             	</tr>	
		             	
		             	<tr>
		             		<td>{{ tr('about') }}</td>
		             		<td>{{ $admin->about }}</td>
		             	</tr>

		             	<tr>
		             		<td>{{ tr('picture') }}</td>
		             		<td><img src="{{ $admin->picture }}" style="width: 200px;height: 200px"></td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('updated_at') }}</td>
		             		<td>{{ $admin->updated_at }}</td>
		             	</tr>

		        

		             		<td> <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">{{ tr('edit') }}</a></td>

		             		<td>
		             			<a href="{{ route('admin.profile.password') }}" class="btn btn-danger" >{{ tr('change_password') }}</a>
               				</td>
		             	</tr>			             					
									
		              </table>
		        
		            </div>
	          </div>								
			</div>							
		</div>
	</div>
</div>
@endsection