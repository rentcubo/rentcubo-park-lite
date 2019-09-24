@extends('layouts.providers.focused')

@section('content')
 <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">{{ tr('forgot_your_password') }}</h1>
                    <p class="mb-4">{{ tr('forgot_password_info') }}</p>
                  </div>

                  <form class="user" method="POST" action="{{ route('provider.password.email') }}">
                    {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"  aria-describedby="emailHelp" placeholder="{{ tr('enter_email') }}"  required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                       
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ tr('reset_link') }}
                        </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="{{ route('provider.register') }}">{{ tr('create_account') }}</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="{{ route('provider.login') }}">{{ tr('already_account') }}</a>
                  </div>
                </div>
              </div>
            </div>
@endsection