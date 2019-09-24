@extends('layouts.user')

@section('content')

<section class="profile">
  <div class="container">
    <!-- Page Heading -->
      <div class="row">
        <div class="col-md-5">
          <h2 class="h3 mb-2 text-gray-800 profile">{{ tr('user_profile') }}</h2>
            <p class="mb-4">{{ tr('profile_info') }}</p>
            @include('notifications.notification')
        </div>
        <div class="col-md-7">
          <a href="{{ route('profile.view') }}"  class="btn btn-primary float-right hidden-sm-down">{{ tr('go_back') }}</a>
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
                    <th>{{ tr('user_data') }}</th>
                </tr>                                                                                         
              <tr>
                <td>{{ tr('name') }}</td>
                <td>{{ $user_details->name }}</td> 
              </tr>

              <tr>
                <td>{{ tr('email') }}</td>
                <td>{{ $user_details->email }}</td> 
              </tr> 

              <tr>
                <td>{{ tr('description') }}</td>
                <td>{{ $user_details->description }}</td>
              </tr> 

              <tr>
                <td>{{ tr('mobile') }}</td>
                <td>{{ $user_details->mobile }}</td>
              </tr> 

              <tr>
                <td>{{ tr('picture') }}</td>
                <td><img src="{{ $user_details->picture }}" style="width: 200px;height: 200px"></td>
              </tr>
              
              <tr>
                <td>{{ tr('updated_at') }}</td>
                <td>{{ $user_details->updated_at }}</td>
              </tr>

              <tr>
                <td> <a href="{{ route('profile.edit',$user_details->id) }}" class="btn btn-primary">{{ tr('update_profile') }}</a></td>

                <td> <a href="{{ route('profile.password',$user_details->id) }}" class="btn btn-info">{{ tr('change_password') }}</a></td>

                <td>
                  <a href="{{ route('password.check') }}" class="btn btn-danger">{{ tr('delete_profile') }}</a>
                  </td>
              </tr>                           
              
              </table>
        </div>
      </div>
  </div>
</section>
<!-- /.container-fluid -->

@endsection