@extends('layouts.admin')

@section('content')

	<div class="content-wrapper">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">{{ tr('list_static_pages') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.static_pages.index') }}">{{ tr('view_static_pages') }}</a></li>
                            <li class="breadcrumb-item active">{{ tr('list_static_pages') }}</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.static_pages.create') }}" class="btn btn-primary pull-right hidden-sm-down">{{ tr('add_static_page') }}</a>
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
                    <h4 class="card-title">{{ tr('static_pages') }}</h4>
                    <div class="table-responsive">
		            <table class="table">
		                <tr>
		                  	
		                  	<th>{{ tr('sno') }}</th>
		                  	<th>{{ tr('title') }}</th>
		                  	<th>{{ tr('type') }}</th>
		                  	<th>{{ tr('status') }}</th>
		                  	<th>{{ tr('action') }}</th>
		                </tr>

		                @if(count($static_pages)>0)
							@foreach($static_pages as $static_page)
								<tr>
								 	<td>{{ ++$sno }}</td>

									<td><a href="{{ route('admin.static_pages.view',$static_page->id) }}">{{ $static_page->title }}</a></td>

									<td>{{ $static_page->type }}</td>
									
									 @switch($static_page->status)

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
                                                <li><a href="{{ route('admin.static_pages.view',$static_page->id) }}" class="dropdown-item" >{{ tr('view') }}</a></li>
                                                <li><a href="{{ route('admin.static_pages.edit',['static_page_id' => $static_page->id]) }}" class="dropdown-item">{{ tr('edit') }}</a></li>
                                                <li><a href="{{ route('admin.static_pages.delete',$static_page->id) }}" class="dropdown-item" onclick="return confirm('{{ tr('static_page_delete_confirmation') . $static_page->static_page_name }}?')" >{{ tr('delete') }}</a></li>
                                                <div class="dropdown-divider"></div>
                                                    <li>
								                        @if($static_page->status==DECLINED)
								                                
								                            <a href="{{ route('admin.static_pages.status',$static_page->id) }}" class="dropdown-item" > {{ tr('approve') }}</a>

								                        @elseif($static_page->status==APPROVED)
								                                
								                            <a href="{{ route('admin.static_pages.status',$static_page->id) }}" class="dropdown-item" onclick="return confirm(' {{ tr('static_page_decline_confirmation') . $static_page->static_page_name }} ?')" > {{ tr('decline') }}</a>

								                        @endif
                                                     </li>
                                            </ul>
                                         </div> 
									</td>								
								</tr>
							@endforeach
						@else
				            <tr><td colspan=5><h3>{{ tr('no_static_page_found') }}</h3></td></tr>
				        @endif
						       		
				    </table>
				    
				    {{$static_pages->links()}}

		            </div>		            
	          </div>		
			</div>							
		</div>
	</div>
		

@endsection

