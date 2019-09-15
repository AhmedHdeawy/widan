<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;

use App\Models\City;
use App\Models\Country;

class CitiesController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $name = $request->name;
      $country = $request->country;
      $status = $request->status;

      $request->flash();

      // Fetch All Cities
      $cities = City::latest();

      // Filter Cities by Search
      if (isset($name)) {  
        $cities = $cities->where('cities_name', 'LIKE', "%{$name}%");
      
      } elseif ( isset($country)) {
        
        $cities = $cities->where('countries_id', $country);

      } elseif ( isset($status)) {
        
        $cities = $cities->where('cities_status', $status);

      } else {
        $cities = $cities->with('country');
      }

      $cities = $cities->paginate(15);


      $countries = Country::all();


      return view('dashboard.cities.index', compact('cities', 'countries'));
    }


    /**
     * Goto the form for creating a new city.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();

      return view('dashboard.cities.create', compact('countries'));
    }


    /**
     * Store a newly created city.
     *
     * @param  \App\Modules\Admin\Http\Requests\CityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $city = City::create($request->all());

        return redirect()->route('admin.cities.index')->with('msg_success', __('lang.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        $city = City::where('id', $city->id)->with('clients')->first();
        return view('dashboard.cities.show', compact('city'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $countries = Country::all();

      return view('dashboard.cities.edit', compact('city', 'countries'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\CityRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        $city->update($request->all());

        return redirect()->route('admin.cities.index')->with('msg_success', __('lang.updatedSuccessfully'));
    }

    /**
     * Delete the city
     */
    public function destroy(City $city)
    {
      $city->delete();

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
