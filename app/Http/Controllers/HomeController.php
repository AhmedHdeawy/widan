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
     * Show the about page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contactus()
    {
        return view('front.contactus');
    }


    /**
     * Show the ContactUs Page.
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

}
