<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use App\Employee;
use App\Holiday;
use Carbon\Carbon;
use DB;

class AttendanceController extends Controller
{
	public function index(Request $request)
	{
		$date = Carbon::now()->toDateString();
		die();
		$attendances = [];
		if ($request->isMethod('post')) {
    		$date = $request->date;
    		$holiday = \App\Holiday::where('date', $date)->first();
    		if(!$holiday){
    			$attendances = Employee::select('*', 'employees.employee_id AS employee_id', 'attendances.status AS status')
    			->join('users', 'users.id', '=', 'employees.user_id')
    			->leftJoin('attendances', function ($join) use ($date) {
    				$join->on('attendances.employee_id', '=', 'employees.employee_id');
    				$join->where('attendances.date', '=', $date);
    			})
    			->where('users.status', 'Active')
    			->orderBy('employees.id', 'ASC')
    			->get();
    		}
    		var_dump ($holiday);
		}
		return view('backend.attendances.index', compact('date', 'holiday', 'attendances'));
	}

	public function store(Request $request)
	{
		for ($i=0; $i < count($request->employee_id); $i++) {
			$temp = array();
			$temp['employee_id'] = $request->employee_id[$i];
			$temp['date'] = $request->date;

			$attendance = Attendance::firstOrNew($temp);
			$old_status = $attendance->status; // for checking email notification
			$attendance->employee_id = $temp['employee_id'];
			$attendance->date = $temp['date'];
			$attendance->status = isset($request->status[$i]) ? $request->status[$i] : 0;
			if(!isset($request->status[$i])){
				$attendance->leave_type_id = $request->leave_type_id[$i];
				$attendance->absent_reason = $request->absent_reason[$i];
			}else{
				$attendance->leave_type_id = 0;
				$attendance->absent_reason = '';
			}
			$attendance->save();

			if($old_status != $attendance->status){
				
			}
		}
		if(! $request->ajax()){
		   	return redirect('attendances/manage')->with('success', _lang('Saved Sucessfully'));
        }else{
		   	return response()->json(['result' => 'success', 'redirect'=> url('attendances/manage'), 'message' => _lang('Saved Sucessfully')]);
		}
	}

	public function report(Request $request)
	{
        $month = Carbon::now()->format('m/Y');
		$report_data = [];
		if ($request->isMethod('post')) {
			$month = (explode('/', $request->month));
			$num_of_days =  cal_days_in_month(CAL_GREGORIAN, $month[0], $month[1]);
			$query = DB::table('attendances')
					->select('attendances.*')
					->join('employees', 'employees.employee_id', '=', 'attendances.employee_id')
					->join('users', 'users.id', '=', 'employees.user_id')
					->whereMonth('date', $month[0])
					->whereYear('date', $month[1])
					->where('users.status', 'Active')
					->orderBy('date', 'asc')
					->get();

			$query2 = Employee::select('*')
								->join('users', 'users.id', '=', 'employees.user_id')
								->where('users.status', 'Active')
								->orderBy('employees.id', 'ASC')
								->get();
			$holidays = Holiday::whereMonth('date', $month[0])
						->whereYear('date', $month[1])
						->orderBy('date', 'ASC')
						->get()
						->toArray();

			$report_data = array();
			$employees = array();
			for($i = 1; $i <= $num_of_days; $i++){	
				$date = new \DateTime($month[1] . '-' .$month[0] . '-' .$i);
			    $date = $date->format('Y-m-d');
			    $status = array('0' => 'A', '1' => 'P','2' => 'H', '3' => '');
				foreach($query as $data){
					if(in_array($date, array_column($holidays, 'date'))){
						$report_data[$data->employee_id][$date] = $status[2];
					}else{
						if($date == $data->date){			
							$report_data[$data->employee_id][$date] = $status[$data->status];
						}else{
							if(! isset($report_data[$data->employee_id][$date])){
								$report_data[$data->employee_id][$date] = $status[3];
							}
						}
					}
				}			
			}
			foreach($query2 as $employee){
				$employees[$employee->employee_id] = $employee;
			}
			$month = $request->month;
		}
		return view('backend.attendances.report', compact('month', 'num_of_days', 'employees', 'report_data'));
	}

	public function summary(Request $request)
	{
		$month = '';
		$summary = Attendance::select([
									'*',
									'users.status AS status',
									DB::raw("COUNT(attendances.status) AS total_attendance"),
									DB::raw("SUM(CASE WHEN attendances.status = '1' THEN 1 ELSE 0 END) AS present"),
									DB::raw("SUM(CASE WHEN attendances.status = '0' THEN 1 ELSE 0 END) AS absent"),
									DB::raw("(SELECT date FROM attendances WHERE employees.employee_id = attendances.employee_id AND attendances.status = 1 ORDER BY attendances.id ASC LIMIT 1) AS last_present"),
									DB::raw("(SELECT date FROM attendances WHERE employees.employee_id = attendances.employee_id AND attendances.status = 0 ORDER BY attendances.id ASC LIMIT 1) AS last_absent")
								])
								->join('employees', 'employees.employee_id', '=', 'attendances.employee_id')
								->join('users', 'users.id', '=', 'employees.user_id')
								->groupBy('attendances.employee_id')
								->orderBy('employees.id', 'ASC')
								->get();

		if ($request->isMethod('post')) {
			$month = (explode('/', $request->month));
    		$summary = Attendance::select([
    									'*',
    									'users.status AS status',
    									DB::raw("COUNT(attendances.status) AS total_attendance"),
    									DB::raw("SUM(CASE WHEN attendances.status = '1' THEN 1 ELSE 0 END) AS present"),
    									DB::raw("SUM(CASE WHEN attendances.status = '0' THEN 1 ELSE 0 END) AS absent"),
										DB::raw("(SELECT date FROM attendances WHERE employees.employee_id = attendances.employee_id AND attendances.status = 1 ORDER BY attendances.id ASC LIMIT 1) AS last_present"),
										DB::raw("(SELECT date FROM attendances WHERE employees.employee_id = attendances.employee_id AND attendances.status = 0 ORDER BY attendances.id ASC LIMIT 1) AS last_absent")
    								])
									->join('employees', 'employees.employee_id', '=', 'attendances.employee_id')
									->join('users', 'users.id', '=', 'employees.user_id')
									->groupBy('attendances.employee_id')
									->whereMonth('attendances.date', $month[0])
    								->whereYear('attendances.date', $month[1])
									->orderBy('employees.id', 'ASC')
									->get();

			$month = $request->month;
		}
		return view('backend.attendances.summary', compact('month', 'summary'));
	}
}
