<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use Carbon\Carbon;
use App\Service;
use App\Client;
use App\Branch;
use App\Picture;
use Image;

class ServicesController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Client $client)
    {

        $name = $request->name;
        $status = $request->status;

        $request->flash();
        $clients = null;

        if ($name || $status) {  
          
          $services = Service::where('client_id', $client->id)
                            ->where('name', 'LIKE', "%{$name}%")
                            ->orWhere('status', $status)
                            ->with(['client', 'pictures'])
                            ->latest()->paginate(10);

        } else {

        $services = Service::where('client_id', $client->id)->with(['client', 'pictures'])
                    ->latest()->paginate(10);
        }


        return view('dashboard.services.index', compact('services', 'client'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {

        $service = Service::where('id', $service->id)
                    ->with(['client', 'pictures'])->first();

        return view('dashboard.services.show', compact('service'));
    }



    public function create(Client $client)
    {
      $branches = Branch::where('client_id', $client->id)->get();
      return view('dashboard.services.create', compact('branches', 'client'));
    }


    /**
     * Store a newly created client.
     *
     * @param  \App\Modules\Admin\Http\Requests\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request, Client $client)
    { 
        dd($request->all());
        $request->merge([
            'client_id' =>  $client->id
        ]);

        Service::create($request->all());

        return redirect()->route('dashboard.services', $client->id)->with('msg_success', 'Service Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
      $branches = Branch::where('client_id', $service->client->id)->get();
      
      return view('dashboard.services.edit', compact('service', 'branches'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\ClientRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request)
    {
        // dd($request->all());
        $service = Service::where('id', $request->id)->first();

        $service->update($request->all());

        return redirect()->route('dashboard.services', $service->client->id)->with('msg_success', 'Service Updated Successfully');
    }

    /**
     * Delete the service
     */
    public function destroy(Request $request, $id)
    {

      $service = Service::where('id', $id)->first();
      $clientID = $service->client->id;

      $service->delete();

      return redirect()->route('dashboard.services', $clientID)->with('msg_success', 'Service Deleted Successfully');
    }

}
