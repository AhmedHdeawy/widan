<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DayRequest;

use App\Models\Day;
use App\Models\Time;


class DaysController extends Controller
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
        'days.day'              => [ '=', request('day') ]
      ];

      $query = Day::groupBy('id');
      
      $searchQuery = $this->handleSearch($query, $inputsArray);

      $days = $searchQuery->paginate(env('perPage'));

      return view('dashboard.days.index', compact('days'));
    }


    /**
     * Goto the form for creating a new day.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $days = $this->getDayDays();

        $times = $this->getDayTime();

      return view('dashboard.days.create', compact('days', 'times'));
    }


    /**
     * Store a newly created day.
     *
     * @param  \App\Modules\Admin\Http\Requests\DayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DayRequest $request)
    {

        $existDay = Day::where('day', $request->day)->first();

        if ($existDay) {
            
            // check if this time is exist also
            $existTime = $existDay->times()->where('time_from', $request->time_from)->where('time_to', $request->time_to)->first();
            
            if ($existTime) {
                    // If Exist, so return without create
                    return redirect()->route('admin.days.index')->with('msg_success', __('lang.daysTimesExist'));

            } else {
                // else, Create Time for this Day
                $existDay->times()->create([
                    'time_from' =>  $request->time_from,
                    'time_to' =>    $request->time_to,
                    'num_of_hours'  =>  $this->hoursNumber($request->time_from, $request->time_to)
                ]);

                return redirect()->route('admin.days.index')->with('msg_success', __('lang.createdSuccessfully'));   
            }

        } else {

            // Create new Day
            $day = Day::create($request->all());

            $day->times()->create([
                'time_from' =>  $request->time_from,
                'time_to' =>    $request->time_to,
                'num_of_hours'  =>  $this->hoursNumber($request->time_from, $request->time_to)
            ]);
            
            return redirect()->route('admin.days.index')->with('msg_success', __('lang.createdSuccessfully'));
        }
        
        return redirect()->route('admin.days.index');


    }


    /**
     * Calculate Difference between hours
     */
    public function hoursNumber($from, $to)
    {
        // Explode Time to h:i:s
        $timeFrom = explode(":", $from)[0];
        $timeTo = explode(":", $to)[0];

        // Get Difference
        return $timeTo - $timeFrom;

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Day $day)
    {
        return view('dashboard.days.show', compact('day'));
    }

    /**
     * Delete the day
     */
    public function deleteTime(Time $time)
    {
        $day = $time->day;
        if (count($day->times) == 1) {
            
            // Delete Day with it's Times
            $day->delete();
            return back()->with('msg_success', __('lang.deletedSuccessfully'));

        } else {
            // Delete Time
            $time->delete();

          return back()->with('msg_success', __('lang.deletedSuccessfully'));
            # code...
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Day  $day
     * @return \Illuminate\Http\Response
     */
    public function doneDay(Request $request, Day $day)
    {
        $day->status = '2';
        $day->save();
        
        return redirect()->route('admin.days.index')->with('msg_success', __('lang.updatedSuccessfully'));
    }


    /**
     * Function to Get Available Day Days
     */
    private function getDayDays()
    {
        // Get Week Days
        $datetime = new \DateTime();
        // Exclude Today from Days
        $datetime->add( date_interval_create_from_date_string('1 days') );
        
        $days = [];

        for ($i=0; $i < 20; $i++) { 
                
            // Exclude Friday from each week
            if ($datetime->format('N') == 5){
                // add new day after Friday
                $datetime->add( date_interval_create_from_date_string('1 days') );
                continue;

            } else {

                // Create Option for Select Tag
                $days[] = 
                '<option value="'.$datetime->format('Y-m-d').'">' . __('lang.'.$datetime->format('D')) . ' - ' .$datetime->format('Y/m/d') . '</option>';

                // Add New Day
                $datetime->add( date_interval_create_from_date_string('1 days') );
            }
        }

        return $days;
    }

    /**
     * Function to Get Available Day Time
     */
    private function getDayTime()
    {
        // Get Week Days
        $datetime = new \DateTime('08:00:00');
        $time = [];

        for ($i=0; $i <= 12; $i++) { 
                
            // Create Option for Select Tag
                $time[] = 
                '<option value="'.$datetime->format('H:i:s').'">' . $datetime->format('H A') . '</option>';

                // Add Hour
                $datetime->add( new \DateInterval('PT1H') );
                // $datetime->add( new \DateInterval('PT30M') );
        }

        return $time;
    }

}
