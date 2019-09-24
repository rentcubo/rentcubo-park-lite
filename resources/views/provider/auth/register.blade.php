@extends('layouts.providers.focused')

@section('content')

	 <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">{{ tr('create_account') }}</h1>
              </div>
              <form class="user" method="post">
              	@csrf 

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="Name" name="name" placeholder="{{ tr('name') }}" value ="{{ old('name') }}" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="Mobile" name="mobile" placeholder="{{ tr('mobile') }}" value="{{ old('mobile') }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="{{ tr('email_address') }}" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="{{ tr('password') }}" name="password" value="{{ old('password') }}" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="{{ tr('confirm_password') }}" name="password_confirmation" required>
                  </div>
                </div>
                <input type="submit" value="{{ tr('register') }}" class="btn btn-primary btn-user btn-block">
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="{{ route('provider.password.request') }}">{{ tr('forgot_password') }}</a>
              </div>
              <div class="text-center">
                <a class="small" href="{{ route('provider.login') }}">{{ tr('already_account') }}</a>
              </div>
            </div>
          </div>
        </div>


@endsection