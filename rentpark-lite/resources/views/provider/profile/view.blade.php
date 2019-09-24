@extends('layouts.provider')

@section('content')

	<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="row">
                        <div class="col-md-5">
                             <h1 class="h3 mb-2 text-gray-800">{{ tr('provider_profile') }}</h1>
          <p class="mb-4">{{ tr('profile_info') }}</p>
                        </div>
                    </div>  
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ tr('profile') }}</h6>
            </div>
            <div class="card-body">
              <table class="table table-borderless">
                    <tr>
                        <th>{{ tr('details') }}</th>
                        <th>{{ tr('provider_data') }}</th>
                    </tr>                                                                                         
                  <tr>
                    <td>{{ tr('name') }}</td>
                    <td>{{ $provider_details->name }}</td> 
                  </tr>

                  <tr>
                    <td>{{ tr('email') }}</td>
                    <td>{{ $provider_details->email }}</td> 
                  </tr> 

                  <tr>
                    <td>{{ tr('mobile') }}</td>
                    <td>{{ $provider_details->mobile }}</td>
                  </tr> 
                  
                  <tr>
                    <td>{{ tr('description') }}</td>
                    <td>{{ $provider_details->description }}</td>
                  </tr> 

                  <tr>
                    <td>{{ tr('picture') }}</td>
                    <td><img src="{{ $provider_details->picture }}" style="width: 200px;height: 200px"></td>
                  </tr>

                  <tr>
                    <td>{{ tr('work') }}</td>
                    <td>{{ $provider_details->work }}</td>
                  </tr> 

                  <tr>
                    <td>{{ tr('school') }}</td>
                    <td>{{ $provider_details->school }}</td>
                  </tr> 

                  <tr>
                    <td>{{ tr('languages') }}</td>
                    <td>{{ $provider_details->languages}}</td>
                  </tr> 

                  <tr>
                    <td>{{ tr('updated_at') }}</td>
                    <td>{{ $provider_details->updated_at }}</td>
                  </tr>

                  <tr>
                    <td>{{ tr('status') }}</td>
                    @switch($provider_details->status)

                                @case(0)
                                    <td><div class="label label-danger">{{ tr('declined') }}</div></td>
                                @break

                                @case(1)
                                    <td><div class="label label-success">{{ tr('approved') }}</div></td>
                                @break

                            @endswitch
                  </tr>

                  <tr>
                    <td> <a href="{{ route('provider.profile.edit') }}" class="btn btn-primary">{{ tr('update_profile') }}</a></td>

                    <td> <a href="{{ route('provider.profile.password') }}" class="btn btn-info">{{ tr('change_password') }}</a></td>

                    <td>
                      <a href="{{ route('provider.password.check')}}" class="btn btn-danger">{{ tr('delete_profile') }}</a>
                      </td>
                  </tr>                           
                  
                  </table>
            </div>
          </div>

        </div>

	<!-- /.container-fluid -->
@endsection