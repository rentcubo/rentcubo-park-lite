@extends('layouts.admin')

@section('content')

	<div class="content-fluid">

		 <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">{{ tr('list_providers') }}</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.providers.index') }}">{{ tr('view_providers') }}</a></li>
                            <li class="breadcrumb-item active">{{ tr('list_providers') }}</li>
                        </ol>
                    </div>
                    <div class="col-md-7 align-self-center">
                        <a href="{{ route('admin.providers.create') }}" class="btn btn-primary pull-right hidden-sm-down">{{ tr('add_provider') }}</a>
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
                    <h4 class="card-title">{{ tr('providers') }}</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ tr('sno') }}</th>
                                <th>{{ tr('name') }}</th>
                                <th>{{ tr('email') }}</th>
                                <th>{{ tr('mobile') }}</th>
                                <th>{{ tr('updated_at') }}</th>
                                <th>{{ tr('status') }}</th>
                                <th>{{ tr('action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($providers)>0)
                                    @foreach($providers as $provider)
                                        <tr>
                                            <td>{{ ++$sno }}</td>
                                            <td><a href="{{ route('admin.providers.view',$provider->id) }}">{{ $provider->name }}</a></td>
                                            <td>{{ $provider->email }}</td>
                                            <td>{{ $provider->mobile }}</td>   
                                            <td>{{ $provider->updated_at }}</td>
                                            @switch($provider->status)

                                                @case(DECLINED)
                                                    <td><div class="label label-danger">{{ tr('declined') }}</div></td>
                                                @break

                                                @case(APPROVED)
                                                    <td><div class="label label-success">{{ tr('approved') }}</div></td>
                                                @break

                                            @endswitch
                                            <td>
                                                 <div class="dropdown">
                                                      <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">{{ tr('action') }}
                                                      <span class="caret"></span></button>
                                                      <ul class="dropdown-menu">
                                                        <li><a href="{{ route('admin.providers.view',$provider->id) }}" class="dropdown-item" >{{ tr('view') }}</a></li>
                                                        <li><a href="{{ route('admin.providers.edit',$provider->id) }}" class="dropdown-item" >{{ tr('edit') }}</a></li>
                                                        <li><a href="{{ route('admin.providers.delete',$provider->id) }}" class="dropdown-item" onclick="return confirm('{{ tr('provider_delete_confirmation') . $provider->name }} ?')" >{{ tr('delete') }}</a></li>
                                                         <div class="dropdown-divider"></div>
                                                         <li>
                                                            @if($provider->status == DECLINED)
                                                                <a href="{{ route('admin.providers.status',$provider->id) }}" class="dropdown-item"> {{ tr('approve') }}</a>
                                                
                                                            @elseif($provider->status == APPROVED)
                                                                <a href="{{ route('admin.providers.status',$provider->id) }}" class="dropdown-item" onclick="return confirm('{{ tr('provider_decline_confirmation') . $provider->name }} ?')"> {{ tr('decline') }}</a>

                                                            @endif
                                                        </li>
                                                      </ul>
                                                </div> 
                                            </td>
                                        </tr>
                                     @endforeach
                                      
                                     
                                    @else
                                        <tr><td colspan=5><h3>{{ tr('no_provider_found') }}</h3></td></tr>
                                    @endif
                            </tbody>
                        </table>
                        {{$providers->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
		

@endsection

