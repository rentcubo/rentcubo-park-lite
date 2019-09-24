@extends('layouts.providers.focused')

@section('content')

	 <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">{{ tr('welcome_back') }}</h1>
                  </div>
                  <form class="user" method="post">
                    @csrf

                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="{{ tr('enter_email') }}" name="email" value= "{{ old('email') }}" required> 
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="{{ tr('password') }}" name="password" required>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">{{ tr('remember_me') }}</label>
                      </div>
                    </div>
                    <input type="submit" value="{{ tr('login') }}" class="btn btn-primary btn-user btn-block">
                    <hr>
                    
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="{{ route('provider.password.request') }} ">{{ tr('forgot_password') }}</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="{{ route('provider.register') }}">{{ tr('create_account') }}</a>
                  </div>
                </div>
              </div>
            </div>


@endsection