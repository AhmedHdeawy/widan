<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;

use App\Models\Service;


class ServicesController extends Controller
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
        'service_translations.services_title'   => [ 'like', request('title') ],
        'services.services_status'              => [ '=', request('status') ]
      ];

      $query = Service::join('service_translations', 'services.id', 'service_translations.service_id')
                        ->groupBy('services.id');
      
      $searchQuery = $this->handleSearch($query, $inputsArray);

      $services = $searchQuery->paginate(env('perPage'));

      return view('dashboard.services.index', compact('services'));
    }


    /**
     * Goto the form for creating a new service.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.services.create');
    }


    /**
     * Store a newly created service.
     *
     * @param  \App\Modules\Admin\Http\Requests\ServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
       // dd($request->all());
        $service = Service::create($request->all());

        return redirect()->route('admin.services.index')->with('msg_success', __('lang.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Service $service)
    {
        $showLang = $request->showLang;
        return view('dashboard.services.show', compact('service', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
      return view('dashboard.services.edit', compact('service'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\ServiceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->all());

        return redirect()->route('admin.services.index')->with('msg_success', __('lang.updatedSuccessfully'));
    }

    /**
     * Delete the service
     */
    public function destroy(Service $service)
    {
        // Get Image name
        $logo = $service->services_logo;
        
        // Delete Record
        $service->delete();

        // Delete Image
        $this->deleteFile('services/', $logo);


      return back()->with('msg_success', __('lang.deletedSuccessfully'));
    }

}
