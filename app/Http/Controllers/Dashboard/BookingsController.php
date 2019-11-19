<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;

use App\Models\Booking;
use App\Models\Service;
use App\User;


class BookingsController extends Controller
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
        'bookings.status'              => [ '=', request('status') ]
      ];

      $query = Booking::latest()->groupBy('id');
      
      $searchQuery = $this->handleSearch($query, $inputsArray);

      $bookings = $searchQuery->paginate(env('perPage'));

      return view('dashboard.bookings.index', compact('bookings'));
    }


    /**
     * Goto the form for creating a new booking.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::active()->get();

        $users = User::active()->get();

        $days = $this->getBookingDays();

        $times = $this->getBookingTime();

      return view('dashboard.bookings.create', compact('services', 'users', 'days', 'times'));
    }


    /**
     * Store a newly created booking.
     *
     * @param  \App\Modules\Admin\Http\Requests\BookingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingRequest $request)
    {
        $request->merge([
            'name'   =>  User::findOrFail($request->user_id)->name
        ]);

        $booking = Booking::create($request->all());

        return redirect()->route('admin.bookings.index')->with('msg_success', __('lang.createdSuccessfully'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Booking $booking)
    {
        return view('dashboard.bookings.show', compact('booking'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        $services = Service::active()->get();

        $users = User::active()->get();

        $days = $this->getBookingDays();

        $times = $this->getBookingTime();

      return view('dashboard.bookings.edit', compact('booking', 'services', 'users', 'days', 'times'));

      // return view('dashboard.bookings.edit', compact('booking'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Http\Requests\BookingRequest  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(BookingRequest $request, Booking $booking)
    {

        $booking->update($request->all());

        return redirect()->route('admin.bookings.index')->with('msg_success', __('lang.updatedSuccessfully'));
    }

    /**
     * Delete the booking
     */
    public function destroy(Booking $booking)
    {
        
        // Delete Record
        $booking->delete();

      return back()->with('msg_success', __('lang.deletedSuccessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function doneBooking(Request $request, Booking $booking)
    {
        $booking->status = '2';
        $booking->save();
        
        return redirect()->route('admin.bookings.index')->with('msg_success', __('lang.updatedSuccessfully'));
    }


    /**
     * Function to Get Available Booking Days
     */
    private function getBookingDays()
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
     * Function to Get Available Booking Time
     */
    private function getBookingTime()
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
