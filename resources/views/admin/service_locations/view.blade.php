@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">{{ tr('service_location_detail') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.service_locations.index') }}">{{ tr('service_locations') }}</a></li>
                            <li class="breadcrumb-item active">{{ tr('service_location_detail') }}</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.service_locations.index') }}" class="btn btn-primary pull-right hidden-sm-down">{{ tr('service_locations') }}</a>
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
                	<h4 class="card-title">{{ tr('service_location_detail') }}</h4>
		              <table class="table">
		                <tr>
		                  	<th>{{ tr('details') }}</th>
		                  	<th>{{ tr('service_location_data') }}</th>
		                </tr>
		             	<tr>
		             		<td>{{ tr('name') }}</td>
		             		<td>{{ $service_location->name }}</td>	
		             	</tr>

		             	<tr>
		             		<td>{{ tr('picture') }}</td>
		             		<td><img src="{{ $service_location->picture }}" style="width: 200px;height: 200px"></td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('full_address') }}</td>
		             		<td>{{ $service_location->full_address }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('description') }}</td>
		             		<td>{{ $service_location->description }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('created_at') }}</td>
		             		<td>{{ $service_location->created_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>{{ tr('updated_at') }}</td>
		             		<td>{{ $service_location->updated_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>{{ tr('status') }}</td>
		             		@switch($service_location->status)

                                @case(DECLINED)
                                    <td><div class="label label-danger">{{ tr('declined') }}</div></td>
                                @break

                                @case(APPROVED)
                                    <td><div class="label label-success">{{ tr('approved') }}</div></td>
                                @break

                            @endswitch
		             	</tr>

		             	<tr>
		             		<td> <a href="{{ route('admin.service_locations.edit',$service_location->id) }}" class="btn btn-primary">{{ tr('edit') }}</a></td>

		             		<td>
		             			@switch($service_location->status)

	                                @case(DECLINED)
	                                    <a href="{{ route('admin.service_locations.status',$service_location->id) }}" class="btn btn-primary">{{ tr('approve') }}</a>
	                                @break

	                                @case(APPROVED)
	                                    <a href="{{ route('admin.service_locations.status',$service_location->id) }}" class="btn btn-info" onclick="return confirm('{{ tr('service_location_decline_confirmation'). $service_location->name }} ? ')">{{ tr('decline') }}</a>
	                                @break

	                            @endswitch
		             			
		             			
		             		</td>

		             		<td>
		             			<a href="{{ route('admin.service_locations.delete',$service_location->id) }}" class="btn btn-danger" onclick="return confirm(' {{ tr('service_location_decline_confirmation') . $service_location->name }} ?')" >{{ tr('delete') }}</a>
               				</td>
		             	</tr>			             					
									
		              </table>
		        
		            </div>
	          </div>								
			</div>							
		</div>
	</div>
@endsection