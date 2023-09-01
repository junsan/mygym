<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduledClass;

class BookingController extends Controller
{
    public function create() {
        $scheduledClasses = ScheduledClass::where('date_time', '>', now())->with(['classType', 'instructor'])->oldest('date_time')->get();
        
        return view('member.book')->with('scheduledClasses', $scheduledClasses);
    }

    public function store(Request $request) {
        auth()->user()->bookings()->attach($request->scheduled_class_id);

        return redirect()->route('booking.index');
    }

    public function index() {
        $bookings =  auth()->user()->bookings()->where('date_time', '>', now())->get();

        return view('member.upcoming')->with('bookings', $bookings);
    }

    public function destroy(int $id) {
        auth()->user()->bookings()->detach($id);

        return redirect()->route('booking.index');
    }
}
