<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;

use App\Models\Slider;


class SlidersController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
      $request->flash();

      $inputsArray = [    
        'slider_translations.sliders_title'   => [ 'like', request('title') ],
        'sliders.sliders_status'              => [ '=', request('status') ]
      ];

      $query = Slider::join('slider_translations', 'sliders.id', 'slider_translations.slider_id')
                        ->groupBy('sliders.id');
      
      $searchQuery = $this->handleSearch($query, $inputsArray);

      $sliders = $searchQuery->paginate(env('perPage'));

      return view('dashboard.sliders.index', compact('sliders'));
    }


    /**
     * Goto the form for creating a new slider.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.sliders.create');
    }


    /**
     * Store a newly created slider.
     *
     * @param  \App\Modules\Admin\Http\Requests\SliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
       // dd($request->all());
        $slider = Slider::create($request->all());

        return redirect()->route('admin.sliders.index')->with('msg_success', __('lang.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Slider $slider)
    {
        $showLang = $request->showLang;
        return view('dashboard.sliders.show', compact('slider', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
      return view('dashboard.sliders.edit', compact('slider'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\SliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        $slider->update($request->all());

        return redirect()->route('admin.sliders.index')->with('msg_success', __('lang.updatedSuccessfully'));
    }

    /**
     * Delete the slider
     */
    public function destroy(Slider $slider)
    {
        // Get Image name
        $logo = $slider->sliders_img;
        
        // Delete Record
        $slider->delete();

        // Delete Image
        $this->deleteFile('sliders/', $logo);


      return back()->with('msg_success', __('lang.deletedSuccessfully'));
    }

}
