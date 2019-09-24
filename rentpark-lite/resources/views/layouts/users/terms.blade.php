@extends('layouts.users.focused')

@section('content')

<!--Section_Content_Start-->
<section class="terms">
  <div id="login">
    <div class="container">
      <div id="login-row" class="row justify-content-center align-items-center">
        <div id="login-column" class="col-md-12">
            <div id="login-box" class="col-md-12">
                
                {{-- <h1>{{ tr('term') }}</h1>

                <h3>{{ tr('license') }}</h3>
                <p>{{ tr('license_info') }}</p>

                <h3>{{ tr('delievery') }}</h3>
                <p>{{ tr('delievery_info') }}</p>

                <h3>{{ tr('ownership') }}</h3>
                <p>{{ tr('ownership_info') }}
                </p>
                <h3>{{ tr('browser') }}</h3>
                <p>{{ tr('browser_info') }}</p>

                <h3>{{ tr('updates') }}</h3>
                <p>{{ tr('updates_info') }}
                </p> --}}
                <h1>{{ $page->title }}</h1>

                <p>{{ $page->description }}</p>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
    
<!--Section_end-->
@endsection