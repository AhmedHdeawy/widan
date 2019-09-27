<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Models\Slider;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Info;
use App\Models\Setting;
use App\Models\ContactUs;
use App\Models\Booking;
use App\User;

class HomeController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $sliders = Slider::active()->get();

        $services = Service::active()->limit(3)->get();
        
        $blogs = Blog::active()->limit(3)->get();

        return view('front.home', compact('sliders', 'services', 'blogs'));
    }


    /**
     * Show the about page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function about()
    {
        return view('front.about');
    }

    /**
     * Show the services page.
     *
     * @return \Illuminate\Http\Response
     */
    public function services()
    {
        $services = Service::active()->get();

        return view('front.services', compact('services'));
    }

     /**
     * Show the service page.
     *
     * @return \Illuminate\Http\Response
     */
    public function service(Request $request, $title)
    {
        $id = explode('-', $title)[0];

        $service = Service::where('id', $id)->first();
        
        return view('front.service', compact('service'));
    }


    /**
     * Show the blogs page.
     *
     * @return \Illuminate\Http\Response
     */
    public function blogs()
    {
        $blogs = Blog::active()->get();

        return view('front.blogs', compact('blogs'));
    }

     /**
     * Show the blog page.
     *
     * @return \Illuminate\Http\Response
     */
    public function blog(Request $request, $title)
    {
        $id = explode('-', $title)[0];

        $blog = Blog::where('id', $id)->first();

        return view('front.blog', compact('blog'));
    }


    /**
     * Show the ContactUs page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contactus()
    {
        return view('front.contactus');
    }


    /**
     * Post the ContactUs Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postContactUs(Request $request)
    {        
        // Validate Form
        $this->validateContactUs($request);
        
        // Create New Row
        ContactUs::create($request->all());

        return redirect()->route('contactus')->with('status', __('lang.contactUsDone'));

    }


    /**
     * Validate Form Request.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateContactUs(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|max:100',
            'message' => 'required|string',
        ])->validate();   
    }


    /**
     * Show the Booking page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function booking()
    {

        $services = Service::active()->get();

        $days = $this->getBookingDays();

        $times = $this->getBookingTime();

        return view('front.booking', compact('days', 'times', 'services'));
    }

    /**
     * Function to Get Available Booking Days
     */
    private function getBookingDays()
    {
        // Get Week Days
        $datetime = new \DateTime();
        // Exclude Today from Days
        $datetime->add( date_interval_create_from_date_string('1 days') );
        
        $days = [];

        for ($i=0; $i < 20; $i++) { 
                
            // Exclude Friday from each week
            if ($datetime->format('N') == 5){
                // add new day after Friday
                $datetime->add( date_interval_create_from_date_string('1 days') );
                continue;

            } else {

                // Create Option for Select Tag
                $days[] = 
                '<option value="'.$datetime->format('Y-m-d').'">' . __('lang.'.$datetime->format('D')) . ' - ' .$datetime->format('Y/m/d') . '</option>';

                // Add New Day
                $datetime->add( date_interval_create_from_date_string('1 days') );
            }
        }

        return $days;
    }

    /**
     * Function to Get Available Booking Time
     */
    private function getBookingTime()
    {
        // Get Week Days
        $datetime = new \DateTime('08:00:00');
        $time = [];

        for ($i=0; $i <= 12; $i++) { 
                
            // Create Option for Select Tag
                $time[] = 
                '<option value="'.$datetime->format('H:i:s').'">' . $datetime->format('H A') . '</option>';

                // Add Hour
                $datetime->add( new \DateInterval('PT1H') );
                // $datetime->add( new \DateInterval('PT30M') );
        }

        return $time;
    }


    /**
     * Post the Booking Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postBooking(Request $request)
    {        
        // Validate Form
        $this->validateBooking($request);

        $request->merge([
            'user_id'   =>  auth()->user()->id
        ]);

        // Create New Row
        Booking::create($request->all());

        return redirect()->route('booking')->with('status', __('lang.bookingDone'));

    }


    /**
     * Validate Form Request.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateBooking(Request $request)
    {
        
        Validator::make($request->all(), [
            'name' => 'required|string|max:100|min:2',
            'email' => 'required|email|max:100|min:2',
            'phone' => 'required|max:100|min:2',
            'city' => 'required|max:100|min:2',
            'building' => 'required|max:100|min:2',
            'unit' => 'required|max:100|min:1',
            'street' => 'required|max:100|min:2',
            'day' => 'required|max:100|min:2',
            'time_from' => 'required|max:100|min:2',
            'time_to' => 'required|max:100|after:time_from',
            'notes' => 'string|nullable',

        ])->validate();   
    }



    /**
     * Show the Profile page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile(Request $request, $username)
    {
        return view('front.profile');
    }


    /**
     * Post the Profile Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {        
        // Validate Form
        $this->validateProfile($request);

        $user = User::findOrFail(auth()->user()->id);

        // Update User Profile
        $user->update($request->all());

        return redirect()->route('profile', auth()->user()->username)->with('status', __('lang.updatedSuccessfully'));

    }


    /**
     * Validate Form Request.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateProfile(Request $request)
    {
        Validator::make($request->all(), [
            'name'      => 'required|string|max:100|min:2',
            'email'     => 'required|max:100|min:2|email|unique:users,email,'. auth()->user()->id .',id',
            'phone'     => 'required|max:100|min:2',
            'password'  => 'confirmed',
            'avatar'    => 'nullable',

        ])->validate();   
    }

}
