@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">{{ tr('list_hosts') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.hosts.index') }}">{{ tr('view_hosts') }}</a></li>
                            <li class="breadcrumb-item active">{{ tr('list_hosts') }}</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.hosts.create') }}" class="btn btn-primary pull-right hidden-sm-down">{{ tr('add_host') }}</a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                 @include('notifications.notification')
        
    @php  $sno = 0; @endphp

	<div class="row">
						
		<div class="col-12">
            <div class="card">
                <div class="card-body" >
                    <h4 class="card-title">{{ tr('hosts') }}</h4>
                    <div class="table-responsive">
		            <table class="table">
		                <tr>
		                  	
		                  	<th>{{ tr('sno') }}</th>
		                  	<th>{{ tr('host_name') }}</th>
		                  	<th>{{ tr('provider_name') }}</th>
		                  	<th>{{ tr('host_type') }}</th>
		                  	<th>{{ tr('service_location') }}</th>
		                  	<th>{{ tr('total_spaces') }}</th>
		                  	<th>{{ tr('per_hour') }}</th>
		                  	<th>{{ tr('updated_at') }}</th>
		                  	<th>{{ tr('status') }}</th>
		                  	<th>{{ tr('action') }}</th>
		                </tr>

		                @if(count($hosts)>0)
							@foreach($hosts as $host)
								<tr>
								 	<td>{{ ++$sno }}</td>
									<td><a href="{{ route('admin.hosts.view',$host->id) }}">{{ $host->host_name }}</a></td>
									<td>
										@if($host->provider()->first()!=NULL)
											<a href="{{ route('admin.providers.view', $host->provider()->first()->id) }}">{{ $host->provider()->first()->name }}</a>
										@else
											{{ tr('no_provider_available') }}
										@endif
									</td>
									<td>{{ $host->host_type }}</td>
									<td>
										@if($host->service_location()->first()!=NULL)
											<a href="{{ route('admin.service_locations.view',$host->service_location()->first()->id) }}">{{ $host->service_location()->first()->name }}</a>
										@else
											{{ tr('no_service_location_found') }}
										@endif
									</td>
									<td>{{ $host->total_spaces }}</td>
									<td>{{ formatted_amount($host->per_hour) }}</td>
									<td>{{ $host->updated_at }}</td>
									 @switch($host->status)

                                                @case(0)
                                                    <td><div class="label label-danger">{{ tr('decline') }}</div></td>
                                                @break

                                                @case(1)
                                                    <td><div class="label label-success">{{ tr('approved') }}</div></td>
                                                @break

                                            @endswitch
									<td>
										<div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">{{ tr('action') }}
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('admin.hosts.view',$host->id) }}" class="dropdown-item" >{{ tr('view') }}</a></li>
                                                <li><a href="{{ route('admin.hosts.edit',$host->id) }}" class="dropdown-item">{{ tr('edit') }}</a></li>
                                                <li><a href="{{ route('admin.hosts.delete',$host->id) }}" class="dropdown-item" onclick="return confirm('{{ tr('host_delete_confirmation') . $host->host_name }}?')" >{{ tr('delete') }}</a></li>
                                                <div class="dropdown-divider"></div>
                                                    <li>
								                        @if($host->status==DECLINED)
								                                
								                            <a href="{{ route('admin.hosts.status',$host->id) }}" class="dropdown-item" > {{ tr('approve') }}</a>

								                        @elseif($host->status==APPROVED)
								                                
								                            <a href="{{ route('admin.hosts.status',$host->id) }}" class="dropdown-item" onclick="return confirm(' {{ tr('host_decline_confirmation') . $host->host_name }} ?')" > {{ tr('decline') }}</a>

								                        @endif
                                                     </li>
                                            </ul>
                                         </div> 
									</td>								
								</tr>
							@endforeach
						@else
				            <tr><td colspan=5><h3>{{ tr('no_host_found') }}</h3></td></tr>
				        @endif
						       		
				    </table>
				    
				    {{$hosts->links()}}

		            </div>		            
	          </div>		
			</div>							
		</div>
	</div>
		

@endsection

