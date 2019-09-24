@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">{{ tr('host_detail') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.hosts.index') }}">{{ tr('view_hosts') }}</a></li>
                            <li class="breadcrumb-item active">{{ tr('host_detail') }}</li>
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

		 <div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ tr('host_detail') }}</h4>
					

		            <div class="box-body">
		              <table class="table ">
		                <tr>
		                  	<th>{{ tr('details') }}</th>
		                  	<th>{{ tr('host_data') }}</th>
		                </tr>
		             	<tr>
		             		<td>{{ tr('host_name') }}</td>
		             		<td>{{ $host->host_name }}</td>	
		             	</tr>

		             	<tr>
		             		<td>{{ tr('provider_name') }}</td>
		             		<td>
		             			@if($host->provider()->first()!=NULL)
									<a href="{{ route('admin.providers.view', $host->provider()->first()->id) }}">{{ $host->provider()->first()->name }}</a>
								@else
									{{ tr('no_provider_available') }}
								@endif

		             		</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('host_type') }}</td>
		             		<td>{{ $host->host_type }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('description') }}</td>
		             		<td>{{ $host->description }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('picture') }}</td>
		             		<td><img src="{{ $host->picture }}" style="width: 200px;height: 200px"></td>
		             	</tr>

		             	<tr>
		             		<td>{{ tr('service_location') }}</td>
		             		<td>
		             			@if($host->service_location()->first()!=NULL)
									<a href="{{ route('admin.service_locations.view',$host->service_location()->first()->id) }}">{{ $host->service_location()->first()->name }}</a>
								@else
									{{ tr('no_service_location_found') }}
								@endif

		             		</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('total_spaces') }}</td>
		             		<td>{{ $host->total_spaces }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('full_address') }}</td>
		             		<td>{{ $host->full_address }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('per_hour') }}</td>
		             		<td>{{ formatted_amount($host->per_hour) }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('created_at') }}</td>
		             		<td>{{ $host->created_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>{{ tr('updated_at') }}</td>
		             		<td>{{ $host->updated_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>{{ tr('status') }}</td>
		             		@switch($host->status)

                                @case(DECLINED)
                                    <td><div class="label label-danger">{{ tr('declined') }}</div></td>
                                @break

                                @case(APPROVED)
                                    <td><div class="label label-success">{{ tr('approved') }}</div></td>
                                @break

                            @endswitch
		             	</tr>

		             	<tr>
		             		<td> <a href="{{ route('admin.hosts.edit',$host->id) }}" class="btn btn-primary">{{ tr('edit') }}</a></td>

		             		<td>
		             			
		             			@if($host->status==DECLINED)
	                                    
	                                <a href="{{ route('admin.hosts.status',$host->id) }}" class="btn btn-primary" > {{ tr('approve') }}</a>

	                            @elseif($host->status==APPROVED)
	                                
	                                <a href="{{ route('admin.hosts.status',$host->id) }}" class="btn btn-info" onclick="return confirm('{{  tr('host_decline_confirmation') . $host->host_name }} ?')" > {{ tr('decline') }}</a>

	                            @endif
	                            
		             		</td>

		             		<td>
		             			<a href="{{ route('admin.hosts.delete',$host->id) }}" class="btn btn-danger" onclick="return confirm('{{ tr('host_delete_confirmation') . $host->host_name }}?')">{{ tr('delete') }}</a>
               				</td>
		             	</tr>			             					
									
		              </table>
		        
		            </div>
	          </div>								
			</div>							
		</div>
	</div>
@endsection