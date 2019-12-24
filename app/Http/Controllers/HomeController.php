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
use App\Models\Day;
use App\Models\Time;
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
        
        return view('front.booking', compact('days', 'services'));
    }

    /**
     * Post the Booking Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postBooking(Request $request)
    {        

        // dd($request->all());

        // Validate Form
        $this->validateBooking($request);

        // If User is Authenticated
        if (auth()->check()) {
            $request->merge([
                'user_id'   =>  auth()->user()->id
            ]);
        }

        // Calculate Price
        $request->merge([
            'price'   =>  $this->calculatePrice($request->times_id)
        ]);

        // Create New Row
        $booking = Booking::create($request->all());

        // Update Time booking count by one
        $givenTime = $booking->time;
        $givenTime->booking_count = $booking->time->booking_count + 1;
        $givenTime->save();

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
            'days_id' => 'required|numeric',
            'times_id' => 'required|numeric',
            'notes' => 'string|nullable',

        ])->validate();   
    }

    /**
     * Function to Get Available Booking Days
     */
    private function getBookingDays()
    {
        // Get all days that greater than or equal Today
        $datetime = new \DateTime();
        $days = Day::where('day', '>=', $datetime->format('Y-m-d'))->get();

        return $days;
    }

    /**
     * Function to Get Available Booking Time based on given Day
     */
    private function getBookingTime($day)
    {
        // in case i called function in this class
        if ($day) {
            
            $times = Time::where('days_id', $day)->get();
            return $times;

        } else {
            
            return $request->all();
        }
        
    }

    /**
     * Function to Get Available Booking Time based on given Day
     */
    public function dayTimes(Request $request)
    {
        // called with JSON
        
        // First, Get Day
        $day = Day::where('day', $request->day)->first();

        // Get Workers Count
        $workersCount = Setting::where('settings_key', 'workers')->value('settings_value');

        // Get Today to exclude times that after now
        $datetime = new \DateTime();
        $today = $datetime->format('Y-m-d');

        // Get available times fro this day
        $times = Time::where('days_id', $day->id)->where('booking_count', '<', $workersCount)->orderBy('id');
        
        if ($today == $request->day) {
            $times->where('time_from', '>', $datetime->format('H:i:s'))->get();
            
        }

        $times = $times->get();

        return $times;
    }

    /**
     * Caclulate Price
     */
    private function calculatePrice($timeID)
    {
        // Get Hour Price
        $hourPrice = Setting::where('settings_key', 'hour_price')->value('settings_value');

        // Get Number of Hours
        $num_of_hours = Time::find($timeID) ? Time::find($timeID)->num_of_hours : 3;

        // price withoit VAT
        $price = $hourPrice * $num_of_hours;

        // VAT value
        $vat = 0.05 * $price;

        // With VAT
        $priceWithVat = $vat + $price;

        return $priceWithVat;
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
