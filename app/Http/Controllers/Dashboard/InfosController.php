<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InfoRequest;

use App\Models\Info;


class InfosController extends Controller
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
        'info_translations.infos_desc'   => [ 'like', request('desc') ],
        'infos.infos_status'              => [ '=', request('status') ]
      ];

      $query = Info::join('info_translations', 'infos.id', 'info_translations.info_id')
                        ->groupBy('infos.id');
      
      $searchQuery = $this->handleSearch($query, $inputsArray);

      $infos = $searchQuery->paginate(env('perPage'));

      return view('dashboard.infos.index', compact('infos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Info $info)
    {
        $showLang = $request->showLang;
        return view('dashboard.infos.show', compact('info', 'showLang'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function edit(Info $info)
    {
      return view('dashboard.infos.edit', compact('info'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\InfoRequest  $request
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(InfoRequest $request, Info $info)
    {
        $info->update($request->all());

        return redirect()->route('admin.infos.index')->with('msg_success', __('lang.updatedSuccessfully'));
    }

}
