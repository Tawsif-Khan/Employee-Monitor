<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\History;
use App\Models\Activity;
use App\Models\Idle;
use App\Models\Duration;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use Auth;

class EmployeeController extends Controller
{

    function loginOrCreateEmployee(Request $request)
    {

        $employee = Employee::where('username', $request->username)->first();
        if ($employee == null) {
            $employee = new Employee();
            $employee->username = $request->username;
        }
        $employee->deviceInfo = $request->deviceInfo;
        $employee->save();

        return response()->json(['success' => 1, 'employee_id' => $employee->id], 200);
    }

    function updateHistory(Request $request)
    {

        $history = History::where('domain', $request->domain)->where('employee_id', $request->employee_id)
            ->whereDate('created_at', '=', date('Y-m-d'))->first();


        if ($history == null) {
            $history = new History();
            $history->employee_id = $request->employee_id;
            $history->domain = $request->domain;
            $history->duration = $request->duration / 60;
        } else {
            $history->duration = $history->duration + ($request->duration / 60);
        }
        $history->duration = number_format($history->duration, 2, '.', '');

        $history->save();

        $activity = new Activity();
        $activity->employee_id = $request->employee_id;
        $activity->domain = $request->domain;
        $activity->duration = $request->duration / 60;
        $activity->save();

        return response()->json(['success' => 1], 200);
    }

    function deleteEmployee(Request $request)
    {
        $res = Employee::find($request->employee_id)->delete();

        $employees = Employee::paginate(20);

        return redirect('employees')->with(['employees' => $employees]);
    }

    function editEmployee(Request $request)
    {

        $employee = Employee::find($request->id);
        $users = User::all();

        return view('employee_edit', ['employee' => $employee, 'users' => $users]);
    }

    function updateEmployee(Request $request)
    {
        // dd($request->leader_id);
        $employee = Employee::find($request->employee_id);
        $employee->leader_id = $request->leader_id;
        $employee->hourly_rate = $request->hourly_rate;
        $employee->save();

        return redirect('employees');
    }


    function dashboard(Request $request)
    {

        if (!Auth::user()) {

            return redirect()->route('login');
        }
        if (!isset($request->date)) {
            $request->date = date('Y-m-d');
        } else {
            $request->date .= ' 00:00:00';
        }
        if (Auth::user()->email == 'admin@admin.com') {
            $employees = Employee::all();
        } else {
            $employees = Employee::where('leader_id', Auth::user()->id)->get();
        }
        $histories = History::whereDate('created_at', $request->date)->where('employee_id', $request->employee_id)->get();
        $activities = DB::table('activities')->join('employees', 'activities.employee_id', '=', 'employees.id')
            ->whereDate('activities.created_at', $request->date)
            ->where('activities.employee_id', $request->employee_id)->select('activities.*', 'employees.username')
            ->orderby('id', 'desc')->paginate(20);

        $images = Idle::where('employee_id', $request->employee_id)->whereDate('created_at', $request->date)->orderby('id', 'desc')->paginate(20);

        $chart = array();
        $totalTime  = 0;
        $duration = array();
        foreach ($histories as $history) {
            $duration[$this->get_domain($history->domain)] = 0;
        }
        foreach ($histories as $history) {
            $duration[$this->get_domain($history->domain)] += $history->duration;
        }

        foreach ($duration as $key => $dur) {
            $data = array();

            $data['label'] = $key . ' (' . $dur . ' m)';
            $data['data'] = $dur;
            $totalTime += $data['data'];
            array_push($chart, $data);
        }
        if (isset($request->employee_id))
            $earnings = ($this->getDuration($request) / 3600) * Employee::find($request->employee_id)->hourly_rate;
        else {
            $earnings = null;
        }
        $activities->setPath('?employee_id=' . $request->employee_id . '&date=' . $request->date);

        return view('dashboard')->with(['earnings' => $earnings, 'totalTime' => $totalTime, 'employees' => $employees, 'chart' => $chart, 'activities' => $activities, 'images' => $images, 'date' => $request->date, 'employee_id' => $request->employee_id]);
    }

    function employees(Request $request)
    {
        // dd(Auth::user()->id);
        if (Auth::user()->email == 'admin@admin.com') {
            $employees = Employee::paginate(20);
        } else {
            $employees = Employee::where('leader_id', Auth::user()->id)->paginate(20);
        }
        return view('employees')->with(['employees' => $employees]);
    }


    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageName = time() . '.' . $request->img->extension();

        $request->img->move(public_path('images'), $imageName);
        //dd(public_path('images'), $imageName);
        $idle = new Idle();
        $idle->employee_id = $request->employee_id;
        $idle->image = $imageName;
        $idle->save();

        /* Store $imageName name in DATABASE from HERE */

        return response()->json(['success' => 1], 200);
    }

    public function start(Request $request)
    {
        $duration = new Duration();
        $duration->startTime = time();
        $duration->employee_id = $request->employee_id;
        $duration->save();

        return response()->json(['success' => 1], 200);
    }

    public function stop(Request $request)
    {
        $duration = Duration::where('employee_id', $request->employee_id)->latest()->get();
        // dd($duration);
        if (sizeof($duration) > 0) {
            $duration = $duration[0];
            $duration->endTime = time();
            $duration->employee_id = $request->employee_id;
            $duration->save();
        } else {

            return response()->json(['success' => 0], 200);
        }
        return response()->json(['success' => 1], 200);
    }

    public function durationThisMonth(Request $request)
    {
        $sum = $this->getDuration($request);
        $hourly_rate = Employee::find($request->employee_id)->hourly_rate;

        return response()->json(['success' => 1, 'duration' => $sum, 'hourly_rate' => $hourly_rate], 200);
    }

    public function getDuration(Request $request)
    {
        $now = Carbon::now();
        $sum = 0;
        $duration = Duration::whereMonth('created_at', $now->month)->where('employee_id', $request->employee_id)->get();
        foreach ($duration as $time) {
            if ($time->endTime != null && $time->endTime) {
                $sum = $sum + ($time->endTime - $time->startTime);
            } else {
                $sum = $sum + (time() - $time->startTime);
            }
        }
        return $sum;
    }

    function get_domain($url)
    {
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
        return false;
    }
}
