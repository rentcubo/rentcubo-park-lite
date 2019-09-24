<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Host;

use App\ServiceLocation;

use App\Provider;

use App\Booking;

use App\ProviderReview;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;

use DB,Exception;

class ProviderController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        $this->middleware('auth:provider');
    }

    /**
     * @method index()
     * 
     * @uses used to display the index
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of  index and response
     *
     */
    public function index()
    { 

        $provider_id = Auth()->guard('provider')->user()->id;

        $total_hosts = Host::where('provider_id',$provider_id)->orderBy('id')->get()->count();

        $total_bookings = Booking::where('provider_id',$provider_id)->orderBy('id', 'desc')->get()->count();

        $bookings = Booking::where('provider_id',$provider_id)->orderBy('id', 'desc')->take(10)->get();

        $earnings = Booking::where('provider_id',$provider_id)->where('status',BOOKING_COMPLETED)->orderBy('id')->sum('total');

        return view('provider.dashboard')->with(['total_hosts'=>$total_hosts, 'total_bookings'=>$total_bookings, 'bookings'=>$bookings, 'earnings'=>$earnings]);
    }

    /**
    *
    * Dashboard
    *
    **/

     /**
     * @method chart()
     * 
     * @uses used to display the chart
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return json response
     *
     */
    public function chart()
    { 

        $provider_id = Auth()->guard('provider')->user()->id;

        $hosts = Host::where('provider_id',$provider_id)->orderBy('id')->get();

        return response()->json($hosts);

    }

    
    /**
    *
    *
    * Host Management in provider Panel
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
    public function hosts_index() {

        $provider_id = Auth()->guard('provider')->user()->id;

        $hosts = Host::where('provider_id',$provider_id)->orderBy('created_at', 'desc')->paginate(10);

        return view('provider.hosts.index')->with('hosts', $hosts);        

    }


    /**
     * @method hosts_create()
     * 
     * @uses used to create the profile of Host
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of Create Host Page
     *
     */

    public function hosts_create() {

        $host = NULL;

        $service_locations = ServiceLocation::where('status', APPROVED)->get();

        $providers = Provider::orderBy('name')->get();

        return view('provider.hosts.create')->with(['host' => $host, 'service_locations' => $service_locations, 'providers' => $providers ]);

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

        $provider_id = Auth()->guard('provider')->user()->id;

        $host = Host::where('provider_id', $provider_id)
            ->where('id', $id)->first();

        if(!$host){

            return redirect()->route('provider.hosts.index')->with('error', tr('no_host_found'));
            
        }
        
        return view('provider.hosts.view')->with('host', $host);
    }


   /**
     * @method hosts_save()
     * 
     * @uses used to save the data of host
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param Request of all data
     *
     * @return view of hosts index
     *
     */
    public function hosts_save(Request $request) {

        $this->validate($request,[

            'host_name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',

            'host_type' => 'required|min:6|max:8',

            'description' => 'required| min:5|max:255',

            'picture' => 'image|nullable|max:2999|mimes:jpeg,bmp,png,jpg',

            'service_location' => 'required|min:3|max:50',

            'total_spaces' => 'required|min:1|max:5000|numeric',

            'full_address' => 'required|min:3|max:50',

            'per_hour' => 'required|min:1|max:5000|numeric',

        ]);

        $service_location_id = ServiceLocation::where('name',$request->service_location)->first()->id;

        $provider_id = Auth()->guard('provider')->user()->id;

        if(!$request->id){

            //Create Host

            $host = New Host;

            $host->unique_id = uniqid(base64_encode(str_random(60)));

            $host->status = DECLINED;

             //Handle File Upload

            $host->picture = asset('noimage.jpg');
        } else {

            $host = Host::find($request->id);

             //Handle File Upload
            if($request->hasFile('picture')){

                delete_picture($host->picture, FILE_PATH_HOST);

            }
            
        }

        $host->provider_id = $provider_id;        

        $host->host_name = $request->host_name;        

        $host->host_type = $request->host_type;

        $host->description = $request->description;

        $host->service_location_id = $service_location_id;

        $host->total_spaces = $request->total_spaces;        

        $host->full_address = $request->full_address;

        $host->per_hour = $request->per_hour; 

        if($request->hasFile('picture')){

            $host->picture = upload_picture($request->file('picture'), FILE_PATH_HOST);

        } 

        $host->save();

        return redirect()->route('provider.hosts.view', ['host_id' => $host->id])->with('success', tr('host_saved'));
    }

    /**
     * @method hosts_edit()
     * 
     * @uses used to display the edit page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of edit page
     *
     */

    public function hosts_edit($id) {

        $provider_id = Auth()->guard('provider')->user()->id;
        
        $host = Host::where('provider_id', $provider_id)
            ->where('id', $id)->first();

        if(!$host){

            return redirect()->route('provider.hosts.index')->with('error', tr('no_host_found'));
            
        }

        $service_locations = ServiceLocation::where('status', APPROVED)->get();

        return view('provider.hosts.edit')->with(['host' => $host, 'service_locations' => $service_locations]);
    
    }

    /**
     * @method hosts_delete()
     * 
     * @uses used to delete the host
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of host's index
     *
     */
    public function hosts_delete($id) {

        $provider_id = Auth()->guard('provider')->user()->id;

        $host = Host::where('provider_id', $provider_id)
            ->where('id', $id)->first();

        $provider_id = Auth()->guard('provider')->user()->id;

        if(!$host){

            return redirect()->route('provider.hosts.index')->with('error',tr('no_host_found'));
            
        }

        delete_picture($host->picture, FILE_PATH_HOST);

        $host->delete();

        return redirect()->route('provider.hosts.index')->with('success', tr('host_removed'));
        
    }


    /**
    *
    * Profile Management
    *
    **/


    /**
     * @method profile_view()
     * 
     * @uses used to display the view page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param 
     *
     * @return view of particular host
     *
     */
    public function profile_view() {

        $provider_id = Auth()->guard('provider')->user()->id;

        $provider_details = Provider::find($provider_id);

        if(!$provider_details){

            return redirect()->route('provider.profile.view')->with('error', tr('no_profile_found'));
            
        }
        
        return view('provider.profile.view')->with('provider_details', $provider_details);
    }

    /**
     * @method profile_edit()
     * 
     * @uses used to edit the profile
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return profile edit form
     *
     */

    public function profile_edit() {

        $provider_id = Auth()->guard('provider')->user()->id;
        
        $provider_details = Provider::find($provider_id);

        if(!$provider_details){

            return redirect()->route('provider.profile.view')->with('error', tr('no_profile_found'));
            
        }

        return view('provider.profile.edit')->with(['provider_details' => $provider_details]);
    
    }


    /**
     * @method profile_save() 
     * 
     * @uses used to save the data of profile
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
public function profile_save(Request $request) {
    
        $provider_id = Auth()->guard('provider')->user()->id;
        
        $provider_details = Provider::find($provider_id);

        if(!$provider_details){

            return redirect()->route('provider.profile.view')->with('error', tr('no_profile_found'));
            
        }

        $this->validate($request,[

            'name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',

            'email' => 'required|email',

            'description' => 'required| min:5|max:255',

            'mobile' => 'digits_between:6,13|nullable',

            'picture' => 'image|nullable|max:2999|mimes:jpeg,bmp,png,jpg',

            'work' => 'max:50',

            'school' => 'max:50',

            'languages' => 'max:100',

        ]);


        //Handle File Upload
        if($request->hasFile('picture')){

            delete_picture($provider_details->picture,PROFILE_PATH_PROVIDER);

            $provider_details->picture = upload_picture($request->file('picture'),PROFILE_PATH_PROVIDER);

        } 

        $provider_details->name = $request->name;        

        $provider_details->email = $request->email;

        $provider_details->description = $request->description?: "";

        $provider_details->mobile = $request->mobile?: "";

        $provider_details->work = $request->work?: "";        

        $provider_details->school = $request->school?: "";

        $provider_details->languages = $request->languages?: "";

        $provider_details->save();

        return redirect()->route('provider.profile.view')->with('success', tr('profile_saved'));
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
    
        $provider_id = Auth()->guard('provider')->user()->id;
        
        $provider_details = Provider::find($provider_id);

        if(!$provider_details){

            return redirect()->route('provider.profile.view')->with('error',tr('no_profile_found'));
            
        }

        return view('provider.profile.password')->with(['provider_details' => $provider_details]);

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
    
        $provider_id = Auth()->guard('provider')->user()->id;
        
        $provider_details = Provider::find($provider_id);

        if(!$provider_details){

            return redirect()->route('provider.profile.view')->with('error',tr('no_profile_found'));
            
        }
          
        $this->validate($request,[

            'old_password' => 'required|min:6',

            'password' => 'required|confirmed|min:6',

        ]);


        if (!\Hash::check($request->old_password, $provider_details->password)) {

             return redirect()->back()->with('error', "Old Password is wrong");
        }

        $provider_details->password = \Hash::make($request->password);      

        $provider_details->save();

        return redirect()->route('provider.profile.view')->with('success', tr('password_changed'));
        
    }

    /**
     * @method profile_delete()
     * 
     * @uses check the password and delete the provider.
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

            $provider_id = Auth()->guard('provider')->user()->id;
        
            $provider_details = Provider::find($provider_id);
       
            if (\Hash::check($request->password, $provider_details->password)) {

            delete_picture($provider_details->picture, PROFILE_PATH_PROVIDER);

            $provider_details->delete();

            DB::commit();

            return redirect()->route('provider.login')->with('success', tr('account_deleted'));
        
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
     * @uses checking password before deleting the provider
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

        return view('provider.profile.delete');
    }

    /**
    *
    *
    * Booking Management in Admin Panel
    *
    */

    /**
     * @method bookings_index()
     * 
     * @uses used to display the list of booking 
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

        $provider_id = Auth()->guard('provider')->user()->id;

        $bookings = Booking::where('provider_id', $provider_id)->orderBy('created_at', 'desc')->paginate(10);

        return view('provider.bookings.index')->with('bookings', $bookings);        
 
    }


    /**
     * @method bookings_view()
     * 
     * @uses used to display the Booking Details Page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param id
     *
     * @return view of particular Booking
     *
     */
    public function bookings_view($id) {

        $provider_id = Auth()->guard('provider')->user()->id;

        $booking = Booking::where('provider_id', $provider_id)
            ->where('id',$id)->first();

        if(!$booking){

            return redirect()->route('provider.bookings.index')->with('error', tr('no_booking_found'));
            
        }

        $booking->rating = $booking->provider_review()->first()->review ?? 0;

        return view('provider.bookings.view')->with('booking', $booking);
    }

    /**
     * @method bookings_status()
     * 
     * @uses used to status of the booking
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
    public function bookings_status($id) {

        $provider_id = Auth()->guard('provider')->user()->id;

        $booking = Booking::where('provider_id', $provider_id)
            ->where('id', $id)->first();

        if(!$booking){

            return redirect()->route('provider.bookings.index')->with('error', tr('no_booking_found'));
            
        }

        $booking->status = BOOKING_PROVIDER_CANCEL;

        $booking->save();

        return redirect()->back()->with('success',tr('status_updated'));
      
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

        $provider_id = Auth()->guard('provider')->user()->id;

        $booking = Booking::where('provider_id', $provider_id)
            ->where('id',$id)->first();

        if(!$booking){

            return redirect()->route('provider.bookings.index')->with('error', tr('no_booking_found'));
            
        }


        if($booking->provider_review()->first()!=NULL) {

            return redirect()->back()->with('error', tr('already_review_updated'));
        }

         $this->validate($request,[

            'booking_id' => 'required',

            'comment' => 'required|min:3',

            'stars' => 'required|numeric|min:1|max:5',

        ]);
        
        $provider_review = new ProviderReview;

        $provider_review->user_id = $booking->user()->first()->id;

        $provider_review->booking_id = $id;

        $provider_review->provider_id = $provider_id;

        $provider_review->comment = $request->comment;

        $provider_review->review = $request->stars;

        $booking->status = BOOKING_COMPLETED;

        $booking->save();

        $provider_review->save();

        return redirect()->back()->with('success',tr('review_updated'));
        
    }

}
