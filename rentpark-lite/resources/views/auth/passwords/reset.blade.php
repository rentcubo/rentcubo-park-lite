@extends('layouts.users.focused')

@section('content')

<!--Section_Start-->

<section class="signup">
    <div id="login"> 
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-12">
                    <div id="login-box" class="col-md-12">
                        <a href="#"><img class="img" src="{{ setting()->get('favicon')}}"></a>
                        @include('notifications.notification')
                        <h5 class="h5">{{ tr('password_reset_info') }}</h5>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">{{ tr('email_address') }}</label>
                                <div class="col-sm-5">
                                    <input type="email4" class="form-control form-control-lg" id="colFormLabelLg" placeholder="example@mail.com" name="email" value="{{ old('email') }}" required >
                                </div>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">{{ tr('password') }}</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control form-control-lg" id="colFormLabelLg" placeholder="{{ tr('password') }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">{{ tr('confirm_password') }}</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control form-control-lg" id="colFormLabelLg" placeholder="{{ tr('confirm_password') }}" name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <input type="reset"  class="a1" value="{{ tr('reset') }}" >
                                
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

@endsection
