@extends('layouts.provider')

@section('content')

   <!-- Begin Page Content -->
    <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">{{ tr('confirm_password') }}</h6>
            </div>
            <div class="card-body">
                  
                <form action="{{ route('provider.password.delete') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            
                            <label class="password_confirmation">{{ tr('confirm_password') }} *</label>

                            <input type="password" name="password" class="form-control" placeholder="{{ tr('confirm_password') }}" value="{{ old('password_confirmation') }}" required>

                        </div>

                        <input type="submit" name="Submit" value="{{ tr('submit') }}" class="btn btn-primary">

                    </form>

            </div>
          </div>
    </div>
@endsection