<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\site;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\WeeklySchedule;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    //
    public function Schedule()
    {
        $users = User::where('position', 1)->get();
        $sites = site::all();
        $schedules = Schedule::all();
        return view('Schedule', ['users' => $users, 'sites' => $sites]);
    }
     public function setSchedule(Request $request)
    {
        $users = User::all();
        $sites = site::all();
        $formattedDate = now()->format('Y-m-d H:i:s');
        $weekStart = now()->addWeek()->startOfWeek(Carbon::MONDAY);
        $weekStartString = $weekStart->format('Y-m-d');
        $weekEnd = now()->addWeek()->endOfWeek(Carbon::MONDAY);
        $weeks = WeeklySchedule::where('week_start_date', $weekStart)
                       ->where('user_id',$request->tech)
                       ->first();

        $weeks = ($weeks->week_start_date);

        if($weeks==$weekStartString){
            $errorFlag = true;
          return view('Schedule', ['error' => $errorFlag, 'users' => $users, 'sites' => $sites]);
        }

        else{
        $weeklySchedule = WeeklySchedule::create([
            'user_id'=>$request->tech,
            'week_start_date' => $weekStart,
            'week_end_date' => $weekEnd,
        ]);

        $schedule = Schedule::create([
            'user_id'=>$request->tech,
            'weekly_schedule_id' => $weeklySchedule->id,
            'mon'=>$request->mon,
            'tue'=>$request->tue,
            'wed'=>$request->wed,
            'thu'=>$request->thu,
            'fri'=>$request->fri,
            'sat'=>$request->sat,
            'sun'=>$request->sun,

        ]);

        return view('Schedule', ['users' => $users, 'sites' => $sites]);
    }}
}
