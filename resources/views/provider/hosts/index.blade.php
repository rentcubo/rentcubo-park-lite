@extends('layouts.provider')

@section('content')

	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">{{ tr('hosts_index') }}</h1>
          <p class="mb-4">{{ tr('all_hosts_info') }}</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ tr('list_hosts') }}</h6>
            </div>
            @php  $sno = 0; @endphp

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>{{ tr('sno') }}</th>
                        <th>{{ tr('host_name') }}</th>
                        <th>{{ tr('host_type') }}</th>
                        <th>{{ tr('location') }}</th>
                        <th>{{ tr('total_spaces') }}</th>
                        <th>{{ tr('per_hour') }}</th>
                        <th>{{ tr('updated_at') }}</th>
                        <th>{{ tr('status') }}</th>
                        <th>{{ tr('action') }}</th>
                    </tr>
                  </thead>
                
                    @if(count($hosts)>0)
              @foreach($hosts as $host)
                <tr>
                  <td>{{ ++$sno }}</td>
                  <td><a href="{{ route('provider.hosts.view',$host->id) }}">{{ $host->host_name }}</a></td>
                  <td>{{ $host->host_type }}</td>
                  <td>
                    @if($host->service_location()->first()!=NULL)
                      {{ $host->service_location()->first()->name }}
                    @else
                     {{ tr('no_location_found') }}
                    @endif
                  </td>
                  <td>{{ $host->total_spaces }}</td>
                  <td>{{ formatted_amount($host->per_hour) }}</td>
                  <td>{{ $host->updated_at }}</td>
                   @switch($host->status)

                                                @case(DECLINED)
                                                    <td><div class="label label-danger">{{ tr('declined') }}</div></td>
                                                @break

                                                @case(APPROVED)
                                                    <td><div class="label label-success">{{ tr('approved') }}</div></td>
                                                @break

                                            @endswitch
                  <td>
                    <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">{{ tr('action')}}
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('provider.hosts.view',$host->id) }}" class="dropdown-item" >{{ tr('view') }}</a></li>
                                                <li><a href="{{ route('provider.hosts.edit',$host->id) }}" class="dropdown-item">{{ tr('edit') }}</a></li>
                                                <li><a href="{{ route('provider.hosts.delete',$host->id) }}" class="dropdown-item" onclick="return confirm(' {{ tr('host_delete_confirmation') . $host->host_name }}?')" >{{ tr('delete') }}</a></li>
                                                <div class="dropdown-divider"></div>
                                                      
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
        <!-- /.container-fluid -->
@endsection