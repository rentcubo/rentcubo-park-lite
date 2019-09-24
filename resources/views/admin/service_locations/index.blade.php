@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">{{ tr('list_service_locations') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.service_locations.index') }}">{{ tr('service_locations') }}</a></li>
                            <li class="breadcrumb-item active">{{ tr('list_service_locations') }}</li>
                        </ol>
                    </div>

                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.service_locations.create') }}" class="btn btn-primary pull-right hidden-sm-down">{{ tr('add_service_location') }}</a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
         
         @include('notifications.notification')

        @php  $sno = 0; @endphp

	<div class="row">
        <!-- column -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ tr('service_locations') }}</h4>
                    <div class="table-responsive">
                        <table class="table">
			                <tr>
			                  	
			                  	<th>{{ tr('sno') }}</th>
			                  	<th>{{ tr('name') }}</th>
			                  	<th>{{ tr('full_address') }}</th>
			                  	<th>{{ tr('description') }}</th>
			                  	<th>{{ tr('updated_at') }}</th>
			                  	<th>{{ tr('status') }}</th>
			                  	<th>{{ tr('action') }}</th>
			                </tr> 	

							@if(count($service_locations)>0)

								@foreach($service_locations as $service_location)

						            <tr>
						            	<td>{{ ++$sno }}</td>
										<td><a href="{{ route('admin.service_locations.view',$service_location->id) }}">{{ $service_location->name }}</a></td>
										<td>{{ $service_location->full_address }}</td>
										<td>{{ $service_location->description }}</td>
										<td>{{ $service_location->updated_at }}</td>
										
                                        @switch($service_location->status)

                                            @case(DECLINED)
                                                <td><div class="label label-danger">{{ tr('declined') }}</div></td>
                                            @break

                                            @case(APPROVED)
                                                <td><div class="label label-success">{{ tr('approved') }}</div></td>
                                            @break

                                        @endswitch

										<td>
											 <div class="dropdown">
                                                      <button class="btn btn-success dropdown-toggle " type="button" data-toggle="dropdown">{{ tr('action') }}
                                                      <span class="caret"></span></button>
                                                      <ul class="dropdown-menu">
                                                        <li ><a href="{{ route('admin.service_locations.view',$service_location->id) }}" class="dropdown-item" >{{ tr('view') }}</a></li>
                                                        <li><a href="{{ route('admin.service_locations.edit',$service_location->id) }}" class="dropdown-item" >{{ tr('edit') }}</a></li>
                                                        <li><a href="{{ route('admin.service_locations.delete',$service_location->id) }}" class="dropdown-item" onclick="return confirm(' {{ tr('service_location_decline_confirmation') . $service_location->name }} ?')" >{{ tr('delete') }}</a></li>
                                                        <div class="dropdown-divider"></div>
                                                         <li>
                                                             @if($service_location->status == DECLINED)
                                                                
                                                                <a href="{{ route('admin.service_locations.status',$service_location->id) }}" class="dropdown-item">{{ tr('approve') }} </a>

                                                            @elseif($service_location->status == APPROVED)
                                                                
                                                                <a href="{{ route('admin.service_locations.status',$service_location->id) }}" class="dropdown-item" onclick="return confirm('{{ tr('service_location_decline_confirmation'). $service_location->name }} ? ')">{{ tr('decline') }}</a>

                                                            @endif
                                                         </li>
                                                      </ul>
                                                </div> 
										</td>
						            </tr>

						        @endforeach

				            @else
				            	<tr><td colspan=5><h3>{{ tr('no_service_location_found') }}</h3></td></tr>
                                
				            @endif

				        </table>
                        
				        {{$service_locations->links()}} 

		            </div>		            
	          </div>				
			</div>							
		</div>
	</div>


@endsection

