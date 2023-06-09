<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function getIndex()
    {
        $attendance = Attendance::getAttendance();

        // 勤務開始前
        if (empty($attendance)) {
            return view('index')->with([
                "is_attendance_start" => true,
            ]);
        }

        $rest = $attendance->rests->whereNull("end_time")->first();

        // 勤務終了後
        if ($attendance->end_time) {
            return view('index');
        }

        // 勤務開始後
        if ($attendance->start_time) {
            if (isset($rest)) {
                return view('index')->with([
                    "is_rest_end" => true,
                ]);
            } else {
                return view('index')->with([
                    "is_attendance_end" => true,
                    "is_rest_start" => true,
                ]);
            }
        }
    }

    public function startAttendance()
    {
        $id = Auth::id();

        $dt = new Carbon();
        $date = $dt->toDateString();
        $time = $dt->toTimeString();

        Attendance::create([
            'user_id' => $id,
            'date' => $date,
            'start_time' => $time,
        ]);

        return redirect('/')->with('result', '
        勤務開始しました');
    }

    public function endAttendance()
    {
        $id = Auth::id();

        $dt = new Carbon();
        $date = $dt->toDateString();
        $time = $dt->toTimeString();

        Attendance::where('user_id', $id)->where('date', $date)->update(['end_time' => $time]);

        return redirect('/')->with('result', '
        勤務終了しました');
    }

    public function getAttendance(Request $request)
    {
        $num = (int)$request->num;
        $dt = new Carbon();
        if ($num == 0) {
            $date = $dt;
        } elseif ($num > 0) {
            $date = $dt->addDays($num);
        } else {
            $date = $dt->subDays(-$num);
        }
        $fixed_date = $date->toDateString();

        $attendances = Attendance::where('date', $fixed_date)->paginate(5);

        $adjustAttendances = Attendance::adjustAttendance($attendances);

        return view('attendance', compact("adjustAttendances", "num", "fixed_date"));
    }
}
