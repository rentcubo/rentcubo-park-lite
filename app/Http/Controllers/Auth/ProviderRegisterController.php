<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use App\Provider;

use Auth;

class ProviderRegisterController extends Controller
{
    public function __construct() {

        $this->middleware('guest:provider');

    }

    public function showRegisterForm() {

      	return view('provider.auth.register');
    }


    public function register(Request $request) {

      	$this->validate($request, [
      		'name'=>'min:3|max:50',
      		'mobile' => 'regex:/[6-9][0-9]{9}/',
      		'email'=>'required|email|unique:providers,email',
      		'password'=>'required|min:6|confirmed',
          'mobile' => 'digits_between:6,13|nullable',
      	]);

        $provider = New Provider;

        $provider->name = $request->name;

        $provider->unique_id = uniqid(base64_encode(str_random(60)));

      	$provider->email = $request->email;

      	$provider->mobile = $request->mobile;

      	$provider->password = Hash::make($request->password);

        $provider->picture = '/placeholder.jpg';

        $provider->languages = '';

        $provider->remember_token = $request->remember_token?: "";
        
        $provider->save();

      	return redirect()->route('provider.login')->with(['profile'=>$provider, 'success'=>'Provider Registerd Successfully and Account is waiting for admin approval.']);
       
    }
}
