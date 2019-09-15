<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;

use App\Models\Client;


class ClientsController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());

      $name = $request->name;
      $status = $request->status;

      $request->flash();
      $clients = null;

      if ($name || $status) {  
        $clients = Client::where('name', 'LIKE', "%{$name}%")
                    ->orWhere('status', $status)
                    ->with(['services', 'pictures', 'user', 'categories', 'followers'])
                    ->orderBy('status', 'asc')->paginate(10);
      } else {

        $clients = Client::with(['services', 'pictures', 'user', 'categories', 'followers'])
                            ->orderBy('status', 'asc')
                            ->paginate(10);
      }


      return view('dashboard.clients.index', compact('clients'));
    }


    /**
     * Goto the form for creating a new client.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();
        $cities = City::all();

      return view('dashboard.clients.create', compact('users', 'cities'));
    }


    /**
     * Store a newly created client.
     *
     * @param  \App\Modules\Admin\Http\Requests\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {

        $client = Client::create($request->all());

        return redirect()->route('dashboard.clients')->with('msg_success', 'Client Add Successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $client = Client::where('id', $client->id)
                    ->with(['services', 'pictures', 'user', 'categories', 'followers'])->first();

        return view('dashboard.clients.show', compact('client'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $users = User::all();
        $cities = City::all();

      return view('dashboard.clients.edit', compact('client', 'users', 'cities'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\ClientRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request)
    {
        // dd($request->all());
        $client = Client::where('id', $request->id)->first();

        $client->update($request->all());

        return redirect()->route('dashboard.clients')->with('msg_success', 'Client Updated Successfully');
    }

    /**
     * Delete the client
     */
    public function destroy(Client $client)
    {

      $client->delete();

      return back()->with('msg_success', 'Client Deleted Successfully');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function services(Client $client)
    {
        $services = Service::where('client_id', $client->id)->with(['client', 'pictures'])
                    ->latest()->paginate(10);

        return view('dashboard.services.index', compact('services', 'client'));

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function servicesShow(Service $service)
    {
        $service = Service::where('id', $service->id)
                    ->with(['client', 'pictures'])->first();

        return view('dashboard.services.show', compact('service'));
    }


}
