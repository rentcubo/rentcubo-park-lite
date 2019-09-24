 @extends('layouts.provider')

@section('content')

<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
          <div class="row">
                        <div class="col-md-5">
                             <h1 class="h3 mb-2 text-gray-800">{{ tr('update_password') }}</h1>
          <p class="mb-4">{{ tr('password_info') }}</p>
                        </div>
                        <div class="col-md-7">
                            <a href="{{ route('provider.profile.view') }}"  class="btn btn-primary float-right hidden-sm-down">{{ tr('go_back') }}</a>
                        </div>
                    </div>  
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ tr('update_password') }}</h6>
            </div>
            <div class="card-body">
                
                <form action="{{ route('provider.profile.password.save') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">
                            

                            <input type="hidden" name="id" class="form-control" value="{{ $provider_details->id }}" >

                        </div>
                        
                         <div class="form-group">
                            
                            <label class="old_password">{{ tr('old_password') }} *</label>

                            <input type="password" name="old_password" class="form-control" placeholder="{{ tr('old_password')}} " value="{{ old('old_password') }}" required>

                        </div>

                        <div class="form-group">
                            
                            <label class="password">{{ tr('new_password') }} *</label>

                            <input type="password" name="password" class="form-control" placeholder="{{ tr('new_password') }} " value="{{ old('password') }}" required>

                        </div>

                        <div class="form-group">
                            
                            <label class="password_confirmation">{{ tr('confirm_new_password') }} *</label>

                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ tr('confirm_new_password') }}" value="{{ old('password_confirmation') }}" required>

                        </div>



                        <input type="submit" name="Submit" value="{{ tr('submit') }}" class="btn btn-primary">

                    </form>

            </div>
          </div>
    </div>
  @endsection