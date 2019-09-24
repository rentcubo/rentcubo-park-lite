@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">{{ tr('static_page_detail') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.static_pages.index') }}">{{ tr('view_static_pages') }}</a></li>
                            <li class="breadcrumb-item active">{{ tr('static_page_detail') }}</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.static_pages.index') }}" class="btn btn-primary pull-right hidden-sm-down">{{ tr('go_back') }}</a>
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
                    <h4 class="card-title">{{ tr('static_page_detail') }}</h4>
					

		            <div class="box-body">
		              <table class="table ">
		                <tr>
		                  	<th>{{ tr('details') }}</th>
		                  	<th>{{ tr('static_page_data') }}</th>
		                </tr>
		             	<tr>
		             		<td>{{ tr('title') }}</td>
		             		<td>{{ $static_page->title }}</td>	
		             	</tr>

		             	<tr>
		             		<td>{{ tr('type') }}</td>
		             		<td>{{ $static_page->type }}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('description') }}</td>
		             		<td>{!! $static_page->description !!}</td>
		             	</tr>	

		             	<tr>
		             		<td>{{ tr('created_at') }}</td>
		             		<td>{{ $static_page->created_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>{{ tr('updated_at') }}</td>
		             		<td>{{ $static_page->updated_at }}</td>
		             	</tr>

		             	<tr>
		             		<td>{{ tr('status') }}</td>
		             		@switch($static_page->status)

                                @case(DECLINED)
                                    <td><div class="label label-danger">{{ tr('declined') }}</div></td>
                                @break

                                @case(APPROVED)
                                    <td><div class="label label-success">{{ tr('approved') }}</div></td>
                                @break

                            @endswitch
		             	</tr>

		             	<tr>
		             		<td> <a href="{{ route('admin.static_pages.edit',['static_page_id' => $static_page->id]) }}" class="btn btn-primary">{{ tr('edit') }}</a></td>

		             		<td>
		             			
		             			@if($static_page->status==DECLINED)
	                                    
	                                <a href="{{ route('admin.static_pages.status',$static_page->id) }}" class="btn btn-primary" > {{ tr('approve') }}</a>

	                            @elseif($static_page->status==APPROVED)
	                                
	                                <a href="{{ route('admin.static_pages.status',$static_page->id) }}" class="btn btn-info" onclick="return confirm('{{  tr('static_page_decline_confirmation') . $static_page->static_page_name }} ?')" > {{ tr('decline') }}</a>

	                            @endif
	                            
		             		</td>

		             		<td>
		             			<a href="{{ route('admin.static_pages.delete',$static_page->id) }}" class="btn btn-danger" onclick="return confirm('{{ tr('static_page_delete_confirmation') . $static_page->static_page_name }}?')">{{ tr('delete') }}</a>
               				</td>
		             	</tr>			             					
									
		              </table>
		        
		            </div>
	          </div>								
			</div>							
		</div>
	</div>
@endsection