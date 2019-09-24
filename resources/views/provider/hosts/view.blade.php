@extends('layouts.provider') 

@section('content')

  <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="row">
                        <div class="col-md-5">
                             <h1 class="h3 mb-2 text-gray-800">{{ tr('host_detail') }}</h1>
          <p class="mb-4">{{ tr('host_view_info') }}</p>
                        </div>
                        <div class="col-md-7">
                            <a href="{{ route('provider.hosts.index') }}"  class="btn btn-primary float-right hidden-sm-down">{{ tr('go_back') }}</a>
                        </div>
                    </div>  
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ tr('host') }}</h6>
            </div>
            <div class="card-body">
              <table class="table table-borderless">
                    <tr>
                        <th>{{ tr('details') }}</th>
                        <th>{{ tr('host_data') }}</th>
                    </tr>                                                                                         
                  <tr>
                    <td>{{ tr('host_name') }}</td>
                    <td>{{ $host->host_name }}</td> 
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
                    <td>{{ tr('location') }}</td>
                    <td>
                      @if($host->service_location()->first()!=NULL)
                        {{ $host->service_location()->first()->name }}
                      @else
                        {{ tr('no_location_found') }}
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
                    <td> <a href="{{ route('provider.hosts.edit',$host->id) }}" class="btn btn-primary">{{ tr('edit') }}</a></td>

                    <td>
                      <a href="{{ route('provider.hosts.delete',$host->id) }}" class="btn btn-danger" onclick="return confirm(' {{ tr('host_delete_confirmation') . $host->host_name }}?')">{{ tr('delete') }}</a>
                      </td>
                  </tr>                 
                  
                  </table>
            </div>
          </div>

        </div>

  <!-- /.container-fluid -->
@endsection