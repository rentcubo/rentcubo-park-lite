@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">{{ tr('provider_detail') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ 'home' }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.providers.index') }}">{{ tr('view_providers') }}</a></li>
                            <li class="breadcrumb-item active">{{ tr('provider_detail') }}</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.providers.index') }}" class="btn btn-primary pull-right hidden-sm-down">{{ tr('view_providers') }}</a>
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
                <h4 class="card-title">{{ tr('provider_details') }}</h4>

		            <div class="box-body">
		              <table class="table ">
		                <tr>
		                  	<th>{{ tr('details') }}</th>
		                  	<th>{{ tr('provider_data') }}</th>
		                </tr>
		             	<tr>
		             		<td>{{ tr('name') }}</td>
		             		<td>{{ $provider->name }}</td>	
		             	</tr>

		             	<tr>
		             		<td>{{ tr('email') }}</td>
		             		<td>{{ $provider->email }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('mobile') }}</td>
		             		<td>{{ $provider->mobile }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('description') }}</td>
		             		<td>{{ $provider->description }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('picture') }}</td>
		             		<td><img src="{{ $provider->picture }}" style="width: 200px;height: 200px"></td>
		             	</tr>

		             	<tr>
		             		<td>{{ tr('work') }}</td>
		             		<td>{{ $provider->work }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('school') }}</td>
		             		<td>{{ $provider->school }}</td>
		             	</tr>


		             	<tr>
		             		<td>{{ tr('languages') }}</td>
		             		<td>{{ $provider->languages }}</td>
		             	</tr>		

		             	<tr>
		             		<td>{{ tr('created_at') }}</td>
		             		<td>{{ $provider->created_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>{{ tr('updated_at') }}</td>
		             		<td>{{ $provider->updated_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>{{ tr('status') }}</td>
		             		
		             		@switch($provider->status)

                                @case(DECLINED)
                                    <td><div class="label label-danger">{{ tr('declined') }}</div></td>
                                @break

                                @case(APPROVED)
                                    <td><div class="label label-success">{{ tr('approved') }}</div></td>
                                @break

                            @endswitch
		             	</tr>

		             	<tr>

		             		<td> <a href="{{ route('admin.providers.edit',$provider->id) }}" class="btn btn-primary">{{ tr('edit') }}</a></td>

		             		<td>
		             			@if($provider->status == DECLINED)
                                   <a href="{{ route('admin.providers.status',$provider->id) }}" class="btn btn-primary">{{ tr('approve') }}</a>

                                @elseif($provider->status == APPROVED)
                                    <a href="{{ route('admin.providers.status',$provider->id) }}" class="btn btn-info" onclick="return confirm('{{ tr('provider_decline_confirmation') .$provider->name }} ?')"> {{ tr('decline') }}</a>

                           		 @endif
		             			
		             		</td>

		             		<td>
		             			<a href="{{ route('admin.providers.delete',$provider->id) }}" class="btn btn-danger" onclick="return confirm('{{ tr('provider_delete_confirmation') . $provider->name }}?')" >{{ tr('delete') }}</a>
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