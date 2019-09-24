@extends('layouts.providers.focused')

@section('content')
 <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">{{ tr('provider_password') }}</h1>
                    <p class="mb-4">{{ tr('password_reset_info') }}</p>
                  </div>
                   @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                  <form class="user" method="POST" action="{{ route('provider.password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                                <input id="password" type="password" class="form-control form-control-user" placeholder="{{ tr('new_password') }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            
                                <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" placeholder="{{ tr('confirm_new_password') }}" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                           
                        </div>

                       
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ tr('reset_password') }}
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