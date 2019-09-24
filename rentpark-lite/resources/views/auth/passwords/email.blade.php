@extends('layouts.users.focused')

@section('content')
<!--Section_Start-->
<section class="forget_password">
  <div id="login">
    <div class="container">
      <div id="login-row" class="row justify-content-center align-items-center">
        <div id="login-column" class="col-md-12">
          <div id="login-box" class="col-md-12">
            <a href="#"><img class="img" src="{{ setting()->get('favicon')}} "></a>
            @include('notifications.notification')
            <h5 class="h5">{{ tr('reset_info') }}</h5>
            <form method="POST" action="{{ route('password.email') }}">
              @csrf
              <div class="form-group row">
                <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">{{ tr('email_address') }}
                </label>
                <div class="col-sm-5">
                <input type="email" class="form-control form-control-lg" id="colFormLabelLg" placeholder="example@mail.com" {{ $errors->has('email') ? ' is-invalid' : '' }} name="email" value="{{ old('email') }}" required>
                </div>
              </div>

              <div>
                <input type="reset" class="a1"{{ tr('reset') }}>
              </div>
              
              <div class="text-right">
                <button type="submit">{{ tr('reset_password') }}</button>
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
