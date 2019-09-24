@extends('layouts.users.focused')

@section('content')

<!--Section_Content_Start-->
<section class="terms">
  <div id="login">
    <div class="container">
      <div id="login-row" class="row justify-content-center align-items-center">
        <div id="login-column" class="col-md-12">
            <div id="login-box" class="col-md-12">

                <h1>{{ $page->title ?? tr('title') }}</h1>

                <p>{!! $page->description ?? tr('description') !!}</p>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
    
<!--Section_end-->
@endsection