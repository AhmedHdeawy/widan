<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Branch;
use App\Client;
use App\Picture;
use Image;

class BranchesController extends Controller
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
          
          $branches = Branch::where('client_id', $client->id)
                            ->where('name', 'LIKE', "%{$name}%")
                            ->orWhere('status', $status)
                            ->with(['client', 'services', 'city', 'pictures'])
                            ->latest()->paginate(10);

        } else {

        $branches = Branch::where('client_id', $client->id)->with(['client', 'services', 'city', 'pictures'])
                    ->latest()->paginate(10);
        }


        return view('dashboard.branches.index', compact('branches', 'client'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {

        $branch = Branch::where('id', $branch->id)
                    ->with(['client', 'pictures'])->first();

        return view('dashboard.branches.show', compact('branch'));
    }



    public function create(Client $client)
    {
      $branches = Branch::where('client_id', $client->id)->get();
      return view('dashboard.branches.create', compact('branches', 'client'));
    }


    /**
     * Store a newly created client.
     *
     * @param  \App\Modules\Admin\Http\Requests\ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request, Client $client)
    { 
        dd($request->all());
        $request->merge([
            'client_id' =>  $client->id
        ]);

        Branch::create($request->all());

        return redirect()->route('dashboard.branches', $client->id)->with('msg_success', 'Branch Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
      $branches = Branch::where('client_id', $branch->client->id)->get();
      
      return view('dashboard.branches.edit', compact('branch', 'branches'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\ClientRequest  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request)
    {
        // dd($request->all());
        $branch = Branch::where('id', $request->id)->first();

        $branch->update($request->all());

        return redirect()->route('dashboard.branches', $branch->client->id)->with('msg_success', 'Branch Updated Successfully');
    }

    /**
     * Delete the branch
     */
    public function destroy(Request $request, $id)
    {

      $branch = Branch::where('id', $id)->first();
      $clientID = $branch->client->id;

      $branch->delete();

      return redirect()->route('dashboard.branches', $clientID)->with('msg_success', 'Branch Deleted Successfully');
    }

}
