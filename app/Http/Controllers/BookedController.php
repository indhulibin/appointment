<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeSlot;
use App\Models\Booked;

class BookedController extends Controller
{
    public function Available_slot()
    {       
        return view('appointement');
        
    }

    public function get_time(Request $request)
    {
        // $date = Booked::where('appointment_date',$request->appointment_date)->get();
        // $timeSlot = $date->time->slot;
    //    $appointments = DB::table('bookeds')
    // ->join('time_slots', 'bookeds.time_id', '=', 'time_slots.id')
    // ->select('bookeds.appointment_date', 'time_slots.slot')
    // ->get();

    $bookedTimeSlots = Booked::where('appointment_date',$request->appointment_date)->pluck('time_id')->toArray();
    $availableTimeSlots = TimeSlot::whereNotIn('id', $bookedTimeSlots)->get();
    return response()->json($availableTimeSlots);
    }

}
