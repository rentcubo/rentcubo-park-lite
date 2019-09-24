<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Host;

use App\User;

use App\Booking;

use App\UsersReview;

use App\ServiceLocation;

use App\StaticPage;

use DB, Auth, Hash, Validator, Exception;

use Carbon\Carbon;

use DateTime;

class UserController extends Controller
{

    Protected $user;
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */

    public function __construct() {

        $this->middleware('auth', ['except' => array('index')]);

        $this->middleware(function ($request, $next) {

            $this->user= Auth::user();

            return $next($request);
        });

    }

    public function index() { 

        return view('home');

    }
    /**
    *
    * Profile Management
    *
    **/

    /**
     * @method profile_view()
     * 
     * @uses To view the user's detail
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return user's profile view page
     *
     */
    public function profile_view()
    {
        
        $user_details = $this->user;

        if(!$user_details){

            Auth::logout();

            return redirect('/login');
            
        }

        return view('user.profile.view')->with(['user_details'=> $user_details]);

    }


    /**
     * @method profile edit()
     * 
     * @uses used to edit the user's detail
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return user's profile edit page
     *
     */

    public function profile_edit($id) {

        $user_details = $this->user;

        if(!$user_details){

            return redirect()->route('profile.view')->with('error', tr('no_profile_found'));
            
        }

        return view('user.profile.edit')->with(['user_details' => $user_details]);
    
    }

    /**
     * @method profile_save()
     * 
     * @uses To store the user's detail
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param  NULL
     *
     * @return user's profile view page
     *
     */
    public function profile_save(Request $request)
    {

        $user_details = $this->user;

        if(!$user_details){

            return redirect()->route('profile.view')->with('error', tr('no_profile_found'));
            
        }

        $request->validate([
                
            'name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',

            'email' => 'required|email',

            'description' => 'min:5|max:255',

            'picture' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048',

            'mobile' => 'digits_between:6,13|nullable',
            

        ]);


        if($request->hasFile('picture')){

            delete_picture($user_details->picture, PROFILE_PATH_USER);

            $user_details->picture = upload_picture($request->file('picture'),PROFILE_PATH_USER);

        }
        
        $user_details->name = $request->name;        

        $user_details->email = $request->email;

        $user_details->description = $request->description;

        $user_details->mobile = $request->mobile;

        $user_details->save();

        return view('user.profile.view')->with(['user_details'=> $user_details]);
       
    }

    /**
     * @method profile_password()
     * 
     * @uses used to view password page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param Request of all data
     *
     * @return view of profile password view
     *
     */
    public function profile_password(Request $request) {
    
        $user_details = $this->user;

        if(!$user_details){

            return redirect()->route('profile.view')->with('error', tr('no_profile_found'));
            
        }

        return view('user.profile.password')->with(['user_details' => $user_details]);


    }

    /**
     * @method profile_password_save()
     * 
     * @uses used to save the password
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param Request of all data
     *
     * @return view of profile view
     *
     */
    public function profile_password_save(Request $request) {
        
        $user_details = $this->user;

        if(!$user_details){

            return redirect()->route('profile.view')->with('error', tr('no_profile_found'));
            
        }
          

        $this->validate($request,[

            'old_password' => 'required|min:6',

            'password' => 'required|confirmed|min:6',

        ]);

        if (!\Hash::check($request->old_password, $user_details->password)) {

             return redirect()->back()->with('error', 'wrong_old_password');
        }
            
        $password = \Hash::make($request->password);

        $user_details->password = $password;        

        $user_details->save();

        return redirect()->route('profile.view')->with('success', tr('password_changed'));
        
    }
    /**
     * @method profile_delete()
     * 
     * @uses check the password and delete the user.
     *
     * @created Akshata
     *
     * @updated
     *
     * @param 
     *
     * @return view of profile's view
     *
     */
    public function profile_delete(Request $request) {
        
        try{
            DB::beginTransaction();

            $user_details = $this->user;

            if(!$user_details){

                throw new Exception(tr('no_profile_found'));
                
            }
            if (\Hash::check($request->password, $user_details->password)) {

                delete_picture($user_details->picture, PROFILE_PATH_USER);

                $user_details->delete();

                DB::commit();
                
                return redirect()->route('login')->with('success', tr('account_deleted'));
            
            }

            throw new Exception(tr('password_not_match'));
                
        } catch(Exception $e){

            DB::rollback();

            return redirect()->back()->with('error',$e->getMessage());
        }

    }
    /**
     * @method password_check()
     * 
     * @uses used to delete the user
     *
     * @created Akshata
     *
     * @updated 
     *
     * @param integer id
     *
     * @return view of profile's view
     *
     */
    public function password_check() {

        return view('user.profile.delete');

    }

	/**
	*
	* Booking Management
	*
	**/

    /**
     * @method bookings_index()
     * 
     * @uses used to display the all list of booking 
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of booking list
     *
     */
    public function bookings_index() {


        $bookings = Booking::where('user_id', $this->user->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('user.bookings.index')->with('bookings', $bookings);        

    }

    /**
     * @method bookings_view()
     * 
     * @uses used to display the Booking Details Page
     *
     * @created NAVEEN S
     *
     * @updated Akshata
     *
     * @param id
     *
     * @return view of particular Booking
     *
     */
    public function bookings_view(Request $request) {
        try{

            $booking_details = Booking::where('user_id', $this->user->id)
            ->where('id',$request->id)->first();
        
            if(!$booking_details){

                throw new Exception(tr('no_booking_found'),101);  
            }
            
            $booking_details->host_id = $booking_details->host->id;

            $booking_details->host_name = $booking_details->host->host_name ?? tr('no_host_available');

            $booking_details->provider_name = $booking_details->provider->name ?? tr('no_provider_available'); 

            $booking_details->location = $booking_details->host->service_location->name ?? tr('no_location_available');

            $booking_details->rating = $booking_details->users_review()->first()->ratings ?? 0;

            return view('user.bookings.view')->with('booking_details', $booking_details);

        } catch(Exception $e){

            return redirect()->route('bookings.index')->with('error',$e->getMessage());
        }

    }


    /**
     * @method bookings_save()
     * 
     * @uses used to save the booking of user
     *
     * @created NAVEEN S
     *
     * @updated 
     *
     * @param Request of all data
     *
     * @return booking list page
     *
     */
    public function bookings_save(Request $request, $id) {

    	$host = Host::where('id', $id)->first();

    	if(!$host) {

    		return tr('no_host_found');
    	}
        
        $now = now($request->timezone);

       $this->validate($request,[

            'check_in' => 'required|date|after:'.$now,

            'check_out' => 'required|date|after:check_in',

            'description' => 'required|min:3|max:255'

        ]); 
  
		$check_in = Carbon::createFromFormat('Y-m-d H:i', $request->check_in);

		$check_out = Carbon::createFromFormat('Y-m-d H:i', $request->check_out);
 		
        $duration_min = $check_in->diffInMinutes($check_out);

        $duration = $duration_min/60;
        
		$per_hour = $host->per_hour;

		$total = $duration * $per_hour;

		$booking_details = new Booking;

		$booking_details->unique_id = uniqid(base64_encode(str_random(60)));

		$booking_details->user_id = $this->user->id;

		$booking_details->provider_id = $host->provider_id;

		$booking_details->host_id = $host->id;

		$booking_details->total_spaces = $host->total_spaces;

		$booking_details->description = $request->description;

		$booking_details->checkin = $request->check_in;

		$booking_details->checkout = $request->check_out;

		$booking_details->duration = $duration;

		$booking_details->per_hour = $per_hour;

		$booking_details->total = $total;

		$booking_details->status = BOOKING_CREATED;

		$booking_details->save();

        return redirect()->route('bookings.index')->with('success', tr('booking_created'));  

    }

     /**
     * @method bookings_status()
     * 
     * @uses used to status of the booking
     *
     * @created NAVEEN S
     *
     * @updated Akshata
     *
     * @param integer id
     *
     * @return view of booking's index
     *
     */
    public function bookings_status(Request $request) {
        try{
            DB::beginTransaction();

            $booking_details = Booking::where('user_id', $this->user->id)
                            ->where('id',$request->id)->first();

            if(!$booking_details){

                throw new Exception(tr('no_booking_found'),101);
                
            }

            $booking_details->status = BOOKING_USER_CANCEL;

            $booking_details->save();

            DB::commit();

            $bookings = Booking::where('user_id', $this->user->id)->orderBy('created_at', 'desc')->paginate(10);

            return view('user.bookings.index')->with('bookings', $bookings); 

        } catch(Exception $e){

            DB::rollback();

            return redirect()->route('bookings.index')->with('error',$e->getMessage());
        }       
               
    }

     /**
     * @method bookings_checkin()
     * 
     * @uses To checkin the park
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return checkin status
     *
     */
    public function bookings_checkin($id) {

        $booking_details = Booking::where('user_id', $this->user->id)
                            ->where('id',$id)->first();

        if(!$booking_details){

            return redirect()->route('bookings.index')->with('error', tr('no_booking_found'));
            
        }

        $booking_details->status = BOOKING_CHECKIN;

        $booking_details->save();

        return redirect()->back()->with('success', tr('checkin_completed'));
               
    }

    /**
     * @method bookings_checkout()
     * 
     * @uses To checkout from park
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return checkout status
     *
     */
    public function bookings_checkout($id) {

        $booking_details = Booking::where('user_id', $this->user->id)
                            ->where('id',$id)->first();

        if(!$booking_details){

            return redirect()->route('bookings.index')->with('error', tr('no_booking_found'));
            
        }

        $booking_details->status = BOOKING_CHECKOUT;

        $booking_details->save();

        return redirect()->back()->with('success', tr('checkout_completed'));
               
    }


        /**
     * @method bookings_rating()
     * 
     * @uses used to rating of the booking
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of booking's index
     *
     */
    public function bookings_rating(Request $request, $id) {

        $user_id = $this->user->id;

        $booking_details = Booking::where('user_id', $user_id)
            ->where('id',$id)->first();

        if(!$booking_details){

            return redirect()->route('bookings.index')->with('error', tr('no_booking_found'));
            
        }


        if($booking_details->users_review()->first()!=NULL) {

            return redirect()->back()->with('error', tr('already_review_updated'));
        }

         $this->validate($request,[

            'booking_id' => 'required',

            'review' => 'required|min:3',

            'rating' => 'required|numeric|min:1|max:5',

        ]);
        
        $user_review = new UsersReview;

        $user_review->host_id = $booking_details->host()->first()->id;

        $user_review->booking_id = $id;

        $user_review->user_id = $user_id;

        $user_review->review = $request->review;

        $user_review->ratings = $request->rating;

        $booking_details->status = BOOKING_COMPLETED;

        $booking_details->save();

        $user_review->save();

        return redirect()->back()->with('success',tr('review_updated'));
        
    }

    /**
    *
    *
    * Host Management
    *
    */

    /**
     * @method hosts_index()
     * 
     * @uses used to display the list of hosts
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of hosts list
     *
     */
    public function hosts_index(Request $request) {

        // $hosts = Host::where('status', APPROVED)->orderBy('created_at', 'desc')->paginate(30);

        $hosts = Host::select('hosts.*')
                    ->join('providers', 'providers.id', '=', 'hosts.provider_id')
                    ->where('hosts.status',APPROVED)
                    ->where('providers.status',APPROVED)
                    ->orderBy('created_at', 'desc')
                    ->paginate(30);

        if($request->search) {

            // $hosts = Host::where('status', APPROVED)->orderBy('created_at', 'desc')->Where('service_location_id', ServiceLocation::where('name','like', '%' . $request->search . '%')->first()->id)->paginate(30);

            $hosts =Host::select('hosts.*')
                        ->join('service_locations', 'service_locations.id', '=', 'hosts.service_location_id')
                        ->join('providers', 'providers.id', '=', 'hosts.provider_id')
                        ->where('hosts.status',APPROVED)
                        ->where('providers.status',APPROVED)
                        ->where('service_locations.name','like', '%' . $request->search . '%')
                        ->orWhere('hosts.host_name','like', '%' . $request->search . '%')
                        ->orderBy('created_at', 'desc')
                        ->paginate(30);

        }

        foreach ($hosts as $key => $host) {
            
            $host->service_location_name = $host->service_location->name??tr('no_location_found');

            $host->booking_rating = round(UsersReview::where('host_id',$host->id)->avg('ratings'))??0;

            $host->booking_rating_count = round(UsersReview::where('host_id',$host->id)->count('ratings'));
        }


        return view('user.hosts.index')->with('hosts', $hosts);        

    }

    /**
     * @method hosts_view()
     * 
     * @uses used to display the view page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param id
     *
     * @return view of particular host
     *
     */
    public function hosts_view($id) {
        
        // $host_details = Host::where('id',$id)->where('status', APPROVED)->first();

        $host_details = Host::select('hosts.*')
                    ->join('providers', 'providers.id', '=', 'hosts.provider_id')
                    ->where('hosts.id', $id)
                    ->where('hosts.status',APPROVED)
                    ->where('providers.status',APPROVED)
                    ->first();

        if(!$host_details){

            return redirect()->route('hosts.index')->with('error', tr('no_host_found'));
            
        }

        $host_details->booking_rating = round(UsersReview::where('host_id',$id)->avg('ratings'));   

        $host_details->booking_rating_count = UsersReview::where('host_id',$id)->count('ratings');

        $host_details->service_location_name = $host_details->service_location->name ?? tr('no_location_found');
    
        return view('user.hosts.view')->with('host_details', $host_details);
    }

    /**
     * @method pages()
     * 
     * @uses To display the view page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of page
     *
     */
    public function pages(Request $request) {
        
        $page = StaticPage::where('type',$request->page_type)->where('status',APPROVED)->first();

        return view('pages.page')->with('page', $page);
    }


}
