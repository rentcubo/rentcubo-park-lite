@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

        <!-- ================ Bread crumb ===================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{ tr('user_detail') }}</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ tr('view_users') }}</a></li>
                    <li class="breadcrumb-item active">{{ tr('user_detail') }}</li>
                </ol>
            </div>
            <div class="col-md-7 align-self-center">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary pull-right hidden-sm-down">{{ tr('view_users') }}</a>
            </div>
        </div>
        <!-- ================ End Bread crumb =================== -->

         @include('notifications.notification')

		<div class="row">

		    <div class="col-12">
		        
		        <div class="card">
		        
		            <div class="card-body">
	            
	                	<h4 class="card-title">{{ tr('user_details') }}</h4>

			            <div class="box-body">
				            
				            <table class="table">
				                
				                <tr>
				                  	<th>{{ tr('details') }}</th>
				                  	<th>{{ tr('user_data') }}</th>
				                </tr>
				             	<tr>
				             		<td> {{ tr('name') }}</td>
				             		<td>{{ $user_details->name }}</td>	
				             	</tr>

				             	<tr>
				             		<td>{{ tr('email') }}</td>
				             		<td>{{ $user_details->email }}</td>
				             	</tr>	

				             	<tr>
				             		<td>{{ tr('mobile') }}</td>
				             		<td>{{ $user_details->mobile }}</td>
				             	</tr>

				             	<tr>
				             		<td>{{ tr('description') }}</td>
				             		<td>{{ $user_details->description }}</td>
				             	</tr>	

				             	<tr>
				             		<td>{{ tr('picture') }}</td>
				             		<td><img src="{{ $user_details->picture }}" style="width: 200px;height: 200px"></td>
				             	</tr>

				             	<tr>
				             		<td>{{ tr('created_at') }}</td>
				             		<td>{{ common_date($user_details->created_at) }}</td>
				             	</tr>

				             	<tr>
				             		<td>{{ tr('updated_at') }}</td>
				             		<td>{{ common_date($user_details->updated_at) }}</td>
				             	</tr>

				             	<tr>
			             		<td>{{ tr('status') }}</td>
			             		
	                            @if($user_details->status == APPROVED) 
                                    <td>
                                        <div class="label label-success">{{ tr('approved') }}</div>
                                    </td>
                                @else
                                 	<td>
                                        <div class="label label-danger">{{ tr('declined') }}</div>
                                    </td> 
                                @endif

				             	</tr>

				             	<tr>

				             		<td> <a href="{{ route('admin.users.edit',['user_id' => $user_details->id]) }}" class="btn btn-primary">{{ tr('edit') }}</a></td>

				             		<td>
		                               
		                                @if($user_details->status == APPROVED)
		                                   
		                                    <a href="{{ route('admin.users.status',['user_id' => $user_details->id])}}" class="btn btn-info" onclick="return confirm(' {{ tr('user_decline_confirmation'). $user_details->name }}')">{{ tr('decline') }}</a>

		                                @else
		                                
		                                  <a href="{{ route('admin.users.status',['user_id' => $user_details->id])}}" class="btn btn-primary">{{ tr('approve') }}</a>

		                                @endif
			             			
				             		</td>

				             		<td>
				             			<a href="{{ route('admin.users.delete',['user_id' => $user_details->id])}}" class="btn btn-danger" onclick="return confirm('{{ tr('user_delete_confirmation') . $user_details->name }}?')" >{{ tr('delete') }}</a>
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