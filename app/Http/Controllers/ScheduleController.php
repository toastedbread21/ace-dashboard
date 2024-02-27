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
        $week = now()->startOfWeek(Carbon::MONDAY);
        $start = $week->format('Y-m-d');
        $weekEnd = $week->copy()->endOfWeek(Carbon::SUNDAY);
        $end = $weekEnd->format('Y-m-d');
        $nextWeek = now()->startOfWeek(Carbon::MONDAY)->addWeek();
        $nstart = $week->format('Y-m-d');
        $nextWeekEnd = $week->copy()->endOfWeek(Carbon::SUNDAY)->addWeek();
        $nend = $weekEnd->format('Y-m-d');
        $weekRange = [$start, $end, $nstart, $nend];
        $schedules = Schedule::all();
        return view('Schedule', ['users' => $users, 'sites' => $sites, 'weekRange' => $weekRange]);
    }
     public function setSchedule(Request $request)
    {

        $users = User::all();
        $sites = site::all();
        $formattedDate = now()->format('Y-m-d');

        if($request->scheduleOption=='thisWeek'){
        $week = now()->startOfWeek(Carbon::MONDAY);
        $weekStartString = $week->format('Y-m-d');
        $weekEnd = now()->endOfWeek(Carbon::SUNDAY);
        }
        elseif ($request->scheduleOption=='nextWeek') {
        $week = now()->addWeek()->startOfWeek(Carbon::MONDAY);
        $weekStartString = $week->format('Y-m-d');
        $weekEnd = now()->addWeek()->endOfWeek(Carbon::SUNDAY);
        }
        $weeks = WeeklySchedule::where('week_start_date', $week)
                       ->where('user_id',$request->tech)
                       ->first();

                       if (is_null($weeks)) {
                        $this->insert($request, $week, $weekEnd);
                    }

                    $users = User::where('position', 1)->get();
                    $sites = Site::all();
                    $week = now()->startOfWeek(Carbon::MONDAY);
                    $start = $week->format('Y-m-d');
                    $weekEnd = $week->copy()->endOfWeek(Carbon::SUNDAY);
                    $end = $weekEnd->format('Y-m-d');
                    $nextWeek = now()->startOfWeek(Carbon::MONDAY)->addWeek();
                    $nstart = $nextWeek->format('Y-m-d');
                    $nextWeekEnd = $nextWeek->copy()->endOfWeek(Carbon::SUNDAY);
                    $nend = $nextWeekEnd->format('Y-m-d');
                    $weekRange = [$start, $end, $nstart, $nend];
                    $schedules = Schedule::all();

                    if (!is_null($weeks) && ($weeks->week_start_date == $start || $weeks->week_start_date == $nstart)) {
                        $errorFlag = true;
                        return view('Schedule', ['error' => $errorFlag, 'users' => $users, 'sites' => $sites, 'weekRange' => $weekRange]);
                    }

                    return view('Schedule', ['users' => $users, 'sites' => $sites, 'weekRange' => $weekRange]);
                }
     private function insert($request, $week, $weekEnd){
        $weeklySchedule = WeeklySchedule::create([
            'user_id'=>$request->tech,
            'week_start_date' => $week,
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

    }
    }

