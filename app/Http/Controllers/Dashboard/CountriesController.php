<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;

use App\Models\Country;


class CountriesController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $name = $request->name;
      $status = $request->status;

      $request->flash();

      // Fetch All Countries
      $countries = Country::latest();

      // Filter Countries by Search
      if (isset($name)) {  
        $countries = $countries->where('countries_name', 'LIKE', "%{$name}%");
      
      } elseif ( isset($status)) {
        
        $countries = $countries->where('countries_status', $status);

      } else {
        $countries = $countries->with('cities');
      }

        $countries = $countries->paginate(15);        

      return view('dashboard.countries.index', compact('countries'));
    }


    /**
     * Goto the form for creating a new country.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.countries.create');
    }


    /**
     * Store a newly created country.
     *
     * @param  \App\Modules\Admin\Http\Requests\CountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        // dd($request->all());

        $country = Country::create($request->all());

        return redirect()->route('admin.countries.index')->with('msg_success', __('lang.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        $country = Country::where('id', $country->id)->with('clients')->first();
        return view('dashboard.countries.show', compact('country'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
      return view('dashboard.countries.edit', compact('country'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\CountryRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, Country $country)
    {
        $country->update($request->all());

        return redirect()->route('admin.countries.index')->with('msg_success', __('lang.updatedSuccessfully'));
    }

    /**
     * Delete the country
     */
    public function destroy(Country $country)
    {
      $country->delete();

      return back()->with('msg_success', __('lang.deletedSuccessfully'));
    }


    /**
     * Craete Slug for each Client
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function makeSlug($string = null, $separator = "-") {

        if (is_null($string)) {
            return "";
        }

        // Remove spaces from the beginning and from the end of the string
        $string = trim($string);

        // Lower case everything 
        // using mb_strtolower() function is important for non-Latin UTF-8 string | more info: http://goo.gl/QL2tzK
        $string = mb_strtolower($string, "UTF-8");;

        // Make alphanumeric (removes all other characters)
        // this makes the string safe especially when used as a part of a URL
        // this keeps latin characters and arabic charactrs as well
        $string = preg_replace("/[^a-z0-9_\s-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", "", $string);

        // Remove multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);

        // Convert whitespaces and underscore to the given separator
        $string = preg_replace("/[\s_]/", $separator, $string);
        return $string;
    }


}
