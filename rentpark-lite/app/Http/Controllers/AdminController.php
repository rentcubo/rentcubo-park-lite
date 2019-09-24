<?php

namespace App\Http\Controllers;

use Faker\Provider\Image;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

use Illuminate\Validation\Rule;

use App\Admin;

use App\Booking;

use App\Host;

use App\Provider;

use App\ServiceLocation;

use App\User;

use App\StaticPage;

use DB, Auth, Hash, Validator, Exception;

use Setting;

use \Mail;

use App\Helpers\Helper;

class AdminController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        $this->middleware('auth:admin');

    }

    /**
     * @method index()
     * 
     * @uses used to display the index page of dashboard
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of dashboard
     *
     */
    public function index() { 
       
        $recent_users = User::orderBy('created_at', 'desc')->take(10)->get();
        
        $recent_providers = Provider::orderBy('created_at', 'desc')->take(10)->get();

        $data['total_users'] = User::count();

        $data['total_providers'] = Provider::count();

        $data['total_bookings'] = Booking::count();

        $data['total_earnings'] = Booking::where('status',BOOKING_COMPLETED)->sum('total');

        $data = json_decode(json_encode($data));

        return view('admin.dashboard')
                ->with('recent_users',$recent_users)
                ->with('recent_providers',$recent_providers)
                ->with('data',$data);
    }

    /** ========== User Management Methods starts =========== **/
      
    /**
     * @method users_index()
     * 
     * @uses used to display the list of users
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of users list
     *
     */
    public function users_index() {

        $users = User::orderBy('created_at','desc')->paginate(10);

        return view('admin.users.index')->with('users', $users);
        
    }

    /**
     * @method users_create()
     * 
     * @uses used to create the profile of User
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of Create User Page
     *
     */
    public function users_create() {

        $user_details = new User;

        return view('admin.users.create')->with('user_details', $user_details);

    }

    /**
     * @method users_edit()
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
    public function users_edit(Request $request) {
        
        try {
            
            $user_details = User::find($request->user_id);

            if(!$user_details) {
                
                throw new Exception("No User found", 101);                
            }

            return view('admin.users.edit')->with('user_details', $user_details);
                
        } catch (Exception $e) {

            $error = $e->getMessage();

            return redirect()->route('admin.users.index')->with('error', tr('no_user_found'));
        }
    }

    /**
     * @method users_save()
     * 
     * @uses used to save the data of user
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param Request of all data
     *
     * @return view of users index
     *
     */
    public function users_save(Request $request) {

        try {
           
            DB::begintransaction();

            $validator = Validator::make( $request->all(), [

                'name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',
               'email' => $request->user_id ? 'required|email|max:191'.$request->user_id.',id' : 'required|email|max:191|unique:users,email,NULL,id',
                'picture' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048',
                'description' => 'required|min:5|max:255',
                'mobile' => 'digits_between:6,13|nullable',
                'password' => $request->user_id ? "" : 'required|min:6|confirmed',
                ]
            );

            if($validator->fails()) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);
            }
            
            if($request->user_id) {

                $user_details = User::find($request->user_id);

                $message = tr('user_updated_success');

                if($request->hasFile('picture')) {

                    delete_picture($user_details->picture, PROFILE_PATH_USER);

                }

            } else {
                
                $user_details = New User;

                $message = tr('user_created_success');

                $user_details->unique_id = uniqid(base64_encode(str_random(60)));

                $user_details->password = \Hash::make($request->password);

                $user_details->status = APPROVED;

                $user_details->picture = asset('placeholder.jpg');

            }
            $user_details->name = $request->name ?: $user_details->name;        

            $user_details->email = $request->email ?: $user_details->email;        

            $user_details->description = $request->description ?: $user_details->description;

            $user_details->mobile = $request->mobile ?: $user_details->mobile;

            $user_details->token = $request->token ?: "";

            $user_details->token_expiry = $request->token_expiry ?: "";
            

            if($request->hasFile('picture')) {

                $user_details->picture = upload_picture($request->file('picture'), PROFILE_PATH_USER);
            }

            if($user_details->save()) {
    
                DB::commit(); 
            
                if(!$request->user_id) {

                    if(Setting::get('is_email_configured') == YES) {

                        $to_name = $request->name;

                        $to_email = $request->email;            

                        $data = ["name"=> $request->name, "body" => tr('account_created'), "username" => $request->email, "password" => $request->password, "link" => route('login')];

                        Mail::send('admin.users.mail.index', $data, function($message) use ($to_name, $to_email) {$message->to($to_email, $to_name)->subject(tr('account_activation'));

                        $message->from(\Config::get('mail.from.address'), "RentPark");;}); 
                    }

                }        
    
                return redirect()->route('admin.users.view',['user_id'=>$user_details->id])->with('success',$message);
            }

            throw new Exception(tr('user_not_saved'), 1);
                        
        } catch (Exception $e) {
            
            DB::rollback();

            $error = $e->getMessage();

            return redirect()->back()->withInput()->with('error', $error);

        }
        
    }
    
    /**
     * @method users_view()
     * 
     * @uses used to display the view page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param id
     *
     * @return view of particular user
     *
     */
    public function users_view(Request $request) {

        try {
            
            $user_details = User::find($request->user_id);

            if(!$user_details) {
                
                return redirect()->route('admin.users.index')->with('error',tr('no_user_found'));
            }

            return view('admin.users.view',['user_id' =>$user_details->id])->with('user_details', $user_details);
             
        } catch (Exception $e) {

            $error = $e->getMessage();

            return redirect()->route('admin.users.index')->with('error', tr('no_user_found'));
        }
    }

    /**
     * @method users_delete()
     * 
     * @uses used to delete the user
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of user's index
     *
     */
    public function users_delete(Request $request) {

        try {
            
            DB::begintransaction();

            $user_details = User::find($request->user_id);

            if(!$user_details) {
                
                throw new Exception(tr('no_user_found'), 101);
            }

            $user_picture = $user_details->picture;

            if($user_details->delete()) {

                DB::commit();
                
                delete_picture($user_picture , PROFILE_PATH_USER);

                return redirect()->route('admin.users.index')->with('success', tr('user_removed'));  
            }

            throw new Exception(tr('user_not_removed'), 101);

        } catch (Exception $e) {

            DB::rollback();

            $error = $e->getMessage();

            return redirect()->back()->with('error', tr('no_user_found'));
        }       
        
    }

    /**
     * @method users_status()
     * 
     * @uses used to status of the user
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of user's index
     *
     */
    public function users_status(Request $request) {

        try {

            DB::begintransaction();

            $user_details = User::find($request->user_id);

            if(!$user_details) {
                
                throw new Exception(tr('no_user_found'), 101);                
            }

            $user_details->status = $user_details->status == APPROVED ? DECLINED : APPROVED;

            if($user_details->save()) {

                DB::commit();

                return redirect()->back()->with('success', tr('status_updated')); 
            
            }

            throw new Exception(tr('user_status_not_updated'), 1);
            
        } catch (Exception $e) {

            DB::rollback();

            $error = $e->getMessage();

            return redirect()->back()->with('error', tr('no_user_found'));
        } 
    }

    /** ========== User Management Methods ends =========== **/


    /** ===== Service Location Management Methods starts ====== **/

    /**
     * @method service_locations_index()
     * 
     * @uses used to display the list of service location
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of service location list
     *
     */
    public function service_locations_index() {

        $service_locations = ServiceLocation::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.service_locations.index')->with('service_locations', $service_locations);

    }

    /**
     * @method service_locations_create()
     * 
     * @uses used to create the profile of Service Loction
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of Create Service Location Page
     *
     */
    public function service_locations_create() {

        $service_location = NULL;

        return view('admin.service_locations.create')->with('service_location', $service_location);
    }

    /**
     * @method service_locations_view()
     * 
     * @uses used to display the view page of Service Location
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param id
     *
     * @return view of particular Service location
     *
     */
    public function service_locations_view($id) {

        $service_location = ServiceLocation::find($id);

        if(!$service_location) {
            
            return redirect()->route('admin.service_locations.index')->with('error', tr('no_service_location_found'));
        }

        return view('admin.service_locations.view')->with('service_location', $service_location);        
    }


   /**
     * @method service_locations_save()
     * 
     * @uses used to save the data of Service Location
     *
     * @created NAVEEN S
     *
     * @updated BALAJI M
     *
     * @param Request of all data
     *
     * @return view of Service Locations index
     *
     */
    public function service_locations_save(Request $request) {

        $this->validate($request,[

            'name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',

            'full_address' => 'required|min:3|max:200',

            'picture' => 'sometimes|image|nullable|max:2999|mimes:jpeg,bmp,png,jpg',

            'description' => 'required| min:5|max:255',

        ]);

        if(!$request->id){
        
            //Create Service Location

            $service_location = New ServiceLocation;

            $service_location->unique_id = uniqid(base64_encode(str_random(60)));

            $service_location->status = APPROVED;

            $service_location->picture = asset('/noimage.jpg');

        } else {


            $service_location = ServiceLocation::find($request->id);

            if($request->hasFile('picture')) {

                delete_picture($service_location->picture, FILE_PATH_SERVICE_LOCATION);

            }

        }
        
        
        $service_location->name = $request->name;        

        $service_location->full_address = $request->full_address;        

        $service_location->description = $request->description;

        if($request->hasFile('picture')){

            $service_location->picture = upload_picture($request->file('picture'), FILE_PATH_SERVICE_LOCATION);

        }

        $service_location->save();

        return redirect()->route('admin.service_locations.view',['service_location_id' => $service_location->id])->with('success', tr('service_location_saved'));
    }

    /**
     * @method service_locations_edit()
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

    public function service_locations_edit($id) {
        
        $service_location = ServiceLocation::find($id);

        if(!$service_location) {
            
            return redirect()->route('admin.service_locations.index')->with('error', tr('no_service_location_found'));
        }

        return view('admin.service_locations.edit')->with('service_location', $service_location);

    }


    /**
     * @method service_locations_delete()
     * 
     * @uses used to delete the service location
     *
     * @created NAVEEN S
     *
     * @updated BALAJI M
     *
     * @param integer id
     *
     * @return view of service location's index
     *
     */
    public function service_locations_delete($id) {

        $service_location = ServiceLocation::find($id);

        if(!$service_location) {
            
            return redirect()->route('admin.service_locations.index')->with('error', tr('no_service_location_found'));
        }

        delete_picture($service_location->picture, FILE_PATH_SERVICE_LOCATION);

        $service_location->delete();

        return redirect()->route('admin.service_locations.index')->with('success', tr('service_location_removed'));
        
        
    }

    /**
     * @method service_locations_status()
     * 
     * @uses used to status of the service_location
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of service_location's index
     *
     */
    public function service_locations_status($id) {

        $service_location = ServiceLocation::find($id);

        if(!$service_location) {
            
            return redirect()->route('admin.service_locations.index')->with('error', tr('no_service_location_found'));
        }

        $service_location->status = $service_location->status == APPROVED ? DECLINED : APPROVED;

        $service_location->save();

        return redirect()->back()->with('Success', tr('status_updated'));
        
    }

    /** ====== Service Location Management Methods ends ====== **/


    /**
    *
    *
    * Host Management in Admin Panel
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

        $hosts = Host::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.hosts.index')->with('hosts',$hosts);        

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

        $service_locations = ServiceLocation::where('status', APPROVED)->orderBy('name')->get();

        $providers = Provider::approved()->get();

        return view('admin.hosts.create')->with(['host' => $host, 'service_locations' => $service_locations, 'providers' => $providers ]);

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

        $host = Host::find($id);

        if(!$host){

            return redirect()->route('admin.hosts.index')->with('error', tr('no_host_found'));
            
        }
        
        return view('admin.hosts.view')->with('host', $host);
    }


   /**
     * @method hosts_save()
     * 
     * @uses used to save the data of host
     *
     * @created NAVEEN S
     *
     * @updated BALAJI M
     *
     * @param Request of all data
     *
     * @return view of hosts index
     *
     */
    public function hosts_save(Request $request) {


        $this->validate($request,[

            'host_name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',

            'provider_name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',

            'host_type' => 'required|min:6|max:8',

            'description' => 'required| min:5|max:255',

            'picture' => 'image|nullable|max:2999|mimes:jpeg,bmp,png,jpg',

            'service_location' => 'required|min:3|max:50',

            'total_spaces' => 'required|min:1|max:5000|numeric',

            'full_address' => 'required|min:3|max:50',

            'per_hour' => 'required|min:1|max:5000|numeric',

        ]);

        $service_location_id = ServiceLocation::where('name', $request->service_location)->first()->id;

        $provider_id = Provider::where('name', $request->provider_name)->first()->id;

        if(!$request->id){
        
            //Create Host

            $host = New Host;

            $host->unique_id = uniqid(base64_encode(str_random(60)));

            $host->status = APPROVED;

            $host->picture = asset('noimage.jpg');

        } else {

            $host = Host::find($request->id);

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

        return redirect()->route('admin.hosts.view',['host_id' => $host->id])->with('success', tr('host_saved'));
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
        
        $host = Host::find($id);

        if(!$host){

            return redirect()->route('admin.hosts.index')->with('error', tr('no_host_found'));
            
        }

        $service_locations = ServiceLocation::orderBy('name')->get();

        $providers = Provider::orderBy('name')->get();

        return view('admin.hosts.edit')->with(['host' => $host, 'service_locations' => $service_locations, 'providers' => $providers]);
    
    }


    /**
     * @method hosts_delete()
     * 
     * @uses used to delete the user
     *
     * @created NAVEEN S
     *
     * @updated BALAJI M
     *
     * @param integer id
     *
     * @return view of host's index
     *
     */
    public function hosts_delete($id) {

        $host = Host::find($id);

        if(!$host){

            return redirect()->route('admin.hosts.index')->with('error',tr('no_host_found'));
            
        }

        delete_picture($host->picture, FILE_PATH_HOST);

        $host->delete();

        return redirect()->route('admin.hosts.index')->with('success', tr('host_removed'));
        
    }

    /**
     * @method hosts_status()
     * 
     * @uses used to status of the host
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
    public function hosts_status($id) {

        $host = Host::find($id);

        if(!$host) {
            
            return redirect()->route('admin.hosts.index')->with('error', tr('no_host_found'));
        }

        $host->status = $host->status == APPROVED ? DECLINED : APPROVED;

        $host->save();

        return redirect()->back()->with('Success', tr('status_updated'));
        
        
    }



    /**
    *
    *
    * Static Pages Management in Admin Panel
    *
    */

    /**
     * @method static_pages_index()
     * 
     * @uses To display the list of static pages
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of static pages list
     *
     */
    public function static_pages_index() {

        $static_pages = StaticPage::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.static_pages.index')->with('static_pages',$static_pages);        

    }

    /**
     * @method static_pages_create()
     * 
     * @uses used to create the Static Page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of Create Static Page
     *
     */

    public function static_pages_create() {

        $static_page = NULL;

        $page_types = ['about' , 'contact' , 'privacy' , 'terms' , 'help' , 'faq' , 'refund', 'cancellation'];


        foreach ($page_types as $key => $page_type) {

            // Check the record exists

            $check_page = StaticPage::where('type', $page_type)->first();

            if($check_page) {
                unset($page_types[$key]);
            }
        }

        return view('admin.static_pages.create')
                ->with('static_page' , $static_page)
                ->with('page_types' , $page_types);

    }


    /**
     * @method static_pages_view()
     * 
     * @uses used to display the view page
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param id
     *
     * @return view of particular Static Page
     *
     */
    public function static_pages_view($id) {

        $static_page = StaticPage::find($id);

        if(!$static_page){

            return redirect()->route('admin.static_pages.index')->with('error', tr('no_static_page_found'));
            
        }
        
        return view('admin.static_pages.view')->with('static_page', $static_page);
    }


   /**
     * @method static_pages_save()
     * 
     * @uses To save the data of static_page
     *
     * @created NAVEEN S
     *
     * @updated 
     *
     * @param Request of all data
     *
     * @return view of static_pages index
     *
     */
    public function static_pages_save(Request $request) {

        try {

            $this->validate($request,[

                'title' => 'required|min:3|max:255',

                'type' => 'required|min:3|max:255',

                'description' => 'required',

            ]);
        
            if(!$request->static_page_id){
        
                //Create Static Page

                $static_page = New StaticPage;

                $static_page->unique_id = uniqid(base64_encode(str_random(60)));

                $static_page->status = APPROVED;

            } else {

                $static_page = StaticPage::find($request->static_page_id);

            }

            $static_page->title = $request->title;
            
            $static_page->type = $request->type;

            $static_page->description = $request->description;

            $static_page->save();

        } catch(Exception $e) {

            $error = $e->getMessage();

            return redirect()->route('admin.static_pages.index')->with('error' , $error);
            
        }
        

        return redirect()->route('admin.static_pages.view', ['static_page_id' => $static_page->id])->with('success', tr('page_saved'));
    }

    /**
     * @method static_pages_edit()
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

    public function static_pages_edit(Request $request) {
        
        $static_page = StaticPage::find($request->static_page_id);

        if(!$static_page){

            return redirect()->route('admin.static_pages.index')->with('error', tr('no_page_found'));
            
        }

        $page_types = ['about' , 'contact' , 'privacy' , 'terms' , 'help' , 'faq' , 'refund', 'cancellation'];
        
        return view('admin.static_pages.edit')
            ->with('static_page', $static_page)
            ->with('page_types' , $page_types);
    
    }


    /**
     * @method static_pages_delete()
     * 
     * @uses used to delete the user
     *
     * @created NAVEEN S
     *
     * @updated 
     *
     * @param integer id
     *
     * @return view of static_pages's index
     *
     */
    public function static_pages_delete($id) {

        $static_pages = StaticPage::find($id);

        if(!$static_pages){

            return redirect()->route('admin.static_pages.index')->with('error',tr('no_page_found'));
            
        }

        $static_pages->delete();

        return redirect()->route('admin.static_pages.index')->with('success', tr('page_removed'));
        
    }

    /**
     * @method static_pages_status()
     * 
     * @uses used to status of the host
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of static_page's index
     *
     */
    public function static_pages_status($id) {

        $static_page = StaticPage::find($id);

        if(!$static_page) {
            
            return redirect()->route('admin.static_pages.index')->with('error', tr('no_page_found'));
        }

        $static_page->status = $static_page->status == APPROVED ? DECLINED : APPROVED;

        $static_page->save();

        return redirect()->back()->with('Success', tr('status_updated'));
        
        
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
     * @uses To list out booking details
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

        $bookings = Booking::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.bookings.index')->with('bookings',$bookings);        

    }

    /**
     * @method bookings_view()
     * 
     * @uses to display the Booking Details based on $id
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

        $booking_details = Booking::find($id);

        if(!$booking_details){

            return redirect()->route('admin.bookings.index')->with('error', tr('no_booking_found'));            
        }

        $booking_details->rating = $booking_details->users_review()->first()->ratings ?? 0;
        
        return view('admin.bookings.view')->with('booking_details', $booking_details);
    }

    /**
    *
    * Providers Management
    *
    **/


    /**
     * @method providers_index()
     * 
     * @uses used to list the providers
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return provider's list
     *
     */

    public function providers_index(Request $request) {

        $providers = Provider::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.providers.index')->with('providers', $providers);
    }

    /**
     * @method providers_create()
     * 
     * @uses used to create the provider
     *
     * @created BALAJI M
     *
     * @updated NAVEEN S
     *
     * @param integer id
     *
     * @return provider's create form
     *
     */
    public function providers_create() {

        $provider_details = new Provider;

        return view('admin.providers.create')->with('provider_details', $provider_details);;
    }

    /**
     * @method providers_edit()
     * 
     * @uses used to edit the provider detail
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return provider's edit form
     *
     */
    public function providers_edit($id) {
        
        try {
            
            $provider_details = Provider::find($id);

            if(!$provider_details) {

                throw new Exception("Provider Not Found", 101);
            }

            return view('admin.providers.edit')->with('provider_details', $provider_details);

        } catch (Exception $e) {
             
            $error = $e->getMessage();

            return redirect()->route('admin.providers.index')->with('error', tr('no_provider_found'));
        }

    }
    
    /**
     * @method providers_save()
     * 
     * @uses used to save the provider's detail in db
     *
     * @created BALAJI M
     *
     * @updated NAVEEN S
     *
     * @param integer id
     *
     * @return provider's index page
     *
     */
    public function providers_save(Request $request) {

        $request->validate([
                
            'name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',

            'email' => 'required|email',
                
            'picture' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048',

            'mobile' => 'digits_between:6,13|nullable',

            'work' => 'min:3|max:255|nullable',

            'school' => 'min:3|max:255|nullable',

            'languages' => 'min:3|max:255|nullable',

        ]);

        if(!$request->id) {
            
            $request->validate([

                'email' => 'required|email|unique:providers,email',

                'password' => 'sometimes|required|min:6|confirmed',
            ]);
            
            $provider_details = new Provider;

            $provider_details->unique_id = rand();

            $provider_details->password = Hash::make($request->password) ?: "";

            $provider_details->status = APPROVED;

            $provider_details->picture = asset('placeholder.jpg');
            
        } else {

            $provider_details = Provider::find($request->id);

            if($request->hasFile('picture')){

                delete_picture($provider_details->picture, PROFILE_PATH_PROVIDER);

            }

        }

        $provider_details->name = $request->name;

        $provider_details->email = $request->email;

        $provider_details->description = $request->description;

        $provider_details->mobile = $request->mobile ;

        $provider_details->work = $request->work ?:"";

        $provider_details->school = $request->school ?:"";

        $provider_details->languages = $request->languages ?:""; 

        $provider_details->remember_token = $request->remember_token ?: "";
        
        if($request->hasFile('picture')){

            $provider_details->picture = upload_picture( $request->file('picture'),PROFILE_PATH_PROVIDER);
        }

        $provider_details->save();

        return redirect(route('admin.providers.view',['provider_id' => $provider_details->id]))->with('success', tr('provider_saved'));
       
    }

    /**
     * @method providers_view()
     * 
     * @uses used to show the provider detail
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return provider's detail
     *
     */
    public function providers_view($provider_id) {

        $provider = Provider::find($provider_id);

        if(!$provider) {

            return redirect()->route('admin.providers.index')->with('error', tr('no_provider_found'));            
        }

        return view('admin.providers.view')->with('provider', $provider);
    }

    /**
     * @method providers_delete()
     * 
     * @uses used to delete the provider detail
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return provider's index
     *
     */
    public function providers_delete($id) {

        $provider = Provider::find($id);

        if(!$provider) {

            return redirect()->route('admin.providers.index')->with('error',tr('no_provider_found'));

        }

        delete_picture($provider->picture, PROFILE_PATH_PROVIDER);

        $provider->delete();

        return redirect(route('admin.providers.index'))->with('success', tr('provider_removed'));
    }

    /**
     * @method providers_status()
     * 
     * @uses used to status of the provider
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param integer id
     *
     * @return view of provider's index
     *
     */
    public function providers_status($id) {

        $provider = Provider::find($id);

        if(!$provider) {
            
            return redirect()->route('admin.providers.index')->with('error',tr('no_provider_found'));
        }

        $provider->status = $provider->status == APPROVED ? DECLINED : APPROVED;

        $provider->save();

        return redirect()->back()->with('success', tr('status_updated'));
        
        
    }


    /**
    *
    *
    * Settings in Admin Panel
    *
    */

    /**
     * @method settings_index()
     * 
     * @uses used to display the Setting Page 
     *
     * @created NAVEEN S
     *
     * @updated
     *
     * @param NULL
     *
     * @return view of settings
     *
     */
    public function settings_index() {

        return view('admin.settings.index');
    }


    public function settings_save(Request $request) {

        $this->validate($request,[

            'site_name' => 'required|min:3|max:50',

            'site_logo' => 'image|nullable|max:2999|mimes:png',

            'favicon' => 'image|nullable|max:2999|mimes:png',

            'currency' => 'required',

        ]);

        setting();

        //Handle File Upload
        if($request->hasFile('favicon')){

            $image = $request->file('favicon');

            //Filename to store
            $fileNameToStore = asset('favicon.png');

            //Upload Image

            $image->move(public_path().'/', $fileNameToStore);

            setting(['favicon' => $fileNameToStore])->save();

        } 

         if($request->hasFile('site_logo')){

            $image = $request->file('site_logo');

            //Filename to store
            $fileNameToStore = asset('logo.png');

            //Upload Image

            $image->move(public_path().'/', $fileNameToStore);

            setting(['site_logo' => $fileNameToStore])->save();

        } 
            
        setting(['site_name' => $request->site_name, 'currency' => $request->currency])->save();


        return redirect()->route('admin.settings.index')->with('success', 'Settings Saved');
    }

    /**
     * @method admin_profile_save()
     * 
     * @uses used to store the admin detail
     *
     * @created BALAJI M
     *
     * @updated NAVEEN S
     *
     * @param integer id
     *
     * @return admin profile view page
     *
     */
    public function admin_profile_save(Request $request)
    {
        $request->validate([
                
            'name' => 'required|min:3|max:50|regex:/^[a-z A-Z]+$/',

            'email' => 'required|email',
                
            'password' => 'sometimes|required|min:6|confirmed',

            'picture' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        $admin = Admin::find(Auth()->guard('admin')->user()->id);

        $admin->name = $request->name?: "";
        
        $admin->email = $request->email?: "";

        $admin->about = $request->about?: "";

        $admin->mobile = $request->mobile?: "";      

        if($request->hasFile('picture')){

            delete_picture($admin->picture, PROFILE_PATH_ADMIN);

            $admin->picture = upload_picture($request->file('picture'),PROFILE_PATH_ADMIN);
        }
    
        $admin->save();

        return view('admin.profile.view')->with('admin', $admin);
        
    }

    /**
     * @method admin_profile_edit()
     * 
     * @uses used to edit the admin detail
     *
     * @created BALAJI M
     *
     * @updated NAVEEN S
     * 
     * @param integer id
     *
     * @return admin profile edit form
     *
     */
    public function admin_profile_edit() 
    {
        
        $admin = Admin::find(Auth()->guard('admin')->user()->id);

        return view('admin.profile.edit')->with('admin', $admin);

    }

    /**
     * @method admin_profile_view()
     * 
     * @uses used to view the admin detail
     *
     * @created BALAJI M
     *
     * @updated
     *
     * @param integer id
     *
     * @return admin profile view page
     *
     */
    public function admin_profile_view()
    {
        $admin = Admin::find(Auth()->guard('admin')->user()->id);

        return view('admin.profile.view')->with('admin',$admin);

    }

    /**
     * @method change_password()
     * 
     * @uses used to view the password change form
     *
     * @created BALAJI M
     *
     * @updated NAVEEN S
     *
     * @param integer id
     *
     * @return admin profile view page
     *
     */
    public function change_password()
    {
        $admin = Admin::find(Auth()->guard('admin')->user()->id);

        return view('admin.profile.password')->with('admin', $admin);
    }

    /**
     * @method change_password_save()
     * 
     * @uses used to change the admin password
     *
     * @created BALAJI M
     *
     * @updated NAVEEN S
     *
     * @param integer id
     *
     * @return admin profile view page
     *
     */
    public function change_password_save(Request $request)
    {

        $request->validate([

                'password' => 'sometimes|required|min:6|confirmed',
            ]);

        $admin = Admin::find(Auth()->guard('admin')->user()->id);

        if (Hash::check($request->oldpassword, $admin->password)) {
            
            $admin->password = Hash::make($request->password);

            $admin->save();
            
        } else
        {

            return redirect()->back()->with('error', tr('wrong_old_password'));
        }
        return redirect()->route('admin.profile.view',$admin->id)->with('success', tr('password_changed'));

    }

}


