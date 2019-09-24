@extends('layouts.users.focused')

@section('content')

<!--Section_Content_Start-->

<section class="login_container">
  <div id="login">
    <div class="container">
      <div id="login-row" class="row justify-content-center align-items-center">
        <div id="login-column" class="col-md-12">
          <div id="login-box" class="col-md-12">
            <a href="#"><img class="img" src="{{ setting()->get('favicon')}}"></a>
            @include('notifications.notification')
            <h5 class="h5">{{ tr('login_info') }}</h5>

            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group row">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">{{ tr('email_address') }}</label>
                <div class="col-sm-5">
                  <input type="email" class="form-control form-control-lg" id="colFormLabelLg" placeholder="example@mail.com" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>
              </div>

              <div class="form-group row">
                  <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">{{ tr('password') }}</label>
                  <div class="col-sm-5">
                    <input type="password" class="form-control form-control-lg" id="colFormLabelLg" placeholder="{{ tr('password') }}" @error('password') is-invalid @enderror name="password" required autocomplete="current-password">
                  </div>
              </div>

              <a href="{{ route('password.request') }}" class="text">{{ tr('forgot_password') }}</a>

              <div>
                <input type="reset" class="a1">
              </div>

              <div class="text-right">
                <button type="submit">{{ tr('login') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    
<!--Section_end-->
@endsection
