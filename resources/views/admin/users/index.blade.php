@extends('layouts.admin') 

@section('content')

<div class="content-fluid">

    <!-- ================ Bread crumb ===================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{ tr('list_users') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ tr('home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ tr('view_users') }}</a></li>
                <li class="breadcrumb-item active">{{ tr('list_users') }}</li>
            </ol>
        </div>
        <div class="col-md-7 align-self-center">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary pull-right hidden-sm-down">{{ tr('add_user') }}</a>
        </div>
    </div>
    <!-- ================ End Bread crumb =================== -->

    @include('notifications.notification') 

    @php $sno = 0; @endphp

    <div class="row">
        <!-- column -->
        <div class="col-12">
            
            <div class="card">
                
                <div class="card-body">
                   
                    <h4 class="card-title">{{ tr('users') }}</h4>
                   
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
                                
                                @if(count($users)>0) 

                                    @foreach($users as $user_details)
                                        
                                        <tr>
                                            <td>{{ ++$sno }}</td>
                                            
                                            <td><a href="{{ route('admin.users.view', ['user_id' => $user_details->id]) }}">{{ $user_details->name }}</a></td>
                                            
                                            <td>{{ $user_details->email }}</td>
                                            
                                            <td>{{ $user_details->mobile }}</td>
                                            
                                            <td>{{ common_date($user_details->updated_at) }}</td>
                                           
                                            @if($user_details->status == APPROVED) 
                                            
                                            <td>
                                                <div class="label label-success">{{ tr('approved') }}</div>
                                            </td>
                                            @else 
                                            <td>
                                                <div class="label label-danger">{{ tr('declined') }}</div>
                                            </td>
                                            @endif

                                            <td>

                                                <div class="dropdown">
                                                   
                                                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">{{ tr('action') }}
                                                        <span class="caret"></span>
                                                    </button>
                                                   
                                                    <ul class="dropdown-menu">
                                                       
                                                        <li><a href="{{ route('admin.users.view',['user_id' => $user_details->id]) }}" class="dropdown-item">{{ tr('view') }}</a></li>
                                                      
                                                        <li><a href="{{ route('admin.users.edit',['user_id' => $user_details->id] ) }}" class="dropdown-item">{{ tr('edit') }}</a></li>
                                                       
                                                        <li><a href="{{ route('admin.users.delete',['user_id' => $user_details->id]) }}" class="dropdown-item" onclick="return confirm('{{ tr('user_delete_confirmation'). $user_details->name }}?')">{{ tr('delete') }}</a>
                                                        </li>
                                                        
                                                        <div class="dropdown-divider"></div>
                                                        
                                                        <li>
                                                            @if($user_details->status == DECLINED)

                                                            <a href="{{ route('admin.users.status',['user_id' => $user_details->id] ) }}" class="dropdown-item">{{ tr('approve') }}</a> 

                                                            @else

                                                            <a href="{{ route('admin.users.status',['user_id' => $user_details->id]) }}" class="dropdown-item" onclick="return confirm('{{ tr('user_decline_confirmation') . $user_details->name }} ?')">{{ tr('decline') }}</a> 

                                                            @endif
                                                            
                                                        </li>

                                                    </ul>

                                                </div>

                                            </td>

                                        </tr>
                                    
                                    @endforeach 

                                @else
                                    
                                    <tr>
                                        <td colspan=5>
                                            <h3>{{ tr('no_user_found') }}</h3>
                                        </td>
                                    </tr>

                                @endif

                            </tbody>
                      
                        </table>
                    
                        {{$users->links()}}
                    
                    </div>
               
                </div>
            
            </div>
        
        </div>
    
    </div>

</div>

@endsection