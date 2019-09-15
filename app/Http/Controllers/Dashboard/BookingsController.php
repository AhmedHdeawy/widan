<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Booking;


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

      $query = Booking::groupBy('id');
      
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
      return view('dashboard.bookings.create');
    }


    /**
     * Store a newly created booking.
     *
     * @param  \App\Modules\Admin\Http\Requests\BookingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingRequest $request)
    {

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
      return view('dashboard.bookings.edit', compact('booking'));
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

}
