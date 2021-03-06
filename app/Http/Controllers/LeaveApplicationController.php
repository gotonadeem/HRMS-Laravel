<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\LeaveApplication;
use App\Attendance;
use App\Rules\AppliedLeave;
use Validator;

class LeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leave_applications = LeaveApplication::orderBy('id', 'DESC')->get();
        return view('backend.leave_applications.index', compact('leave_applications'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if( ! $request->ajax()){
            return view('backend.leave_applications.create');
        }else{
            return view('backend.leave_applications.modal.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
           	'date.*' => ['required', new AppliedLeave(get_employee_id(), $request->date)],
           	'leave_type_id.*' => 'required|numeric',
           	'absent_reason.*' => 'nullable|string|max:140',
        ]);

        if ($validator->fails()) {
            if($request->ajax()){ 
                return response()->json(['result' => 'error', 'message' => $validator->errors()->all()]);
            }else{
                return back()->withErrors($validator)->withInput();
            }			
        }

        for ($i=0; $i < count($request->date); $i++) { 
            $leave_application = new LeaveApplication();
        
            $leave_application->employee_id = get_employee_id();
            $leave_application->date = $request->date[$i];
            $leave_application->leave_type_id = $request->leave_type_id[$i];
            $leave_application->absent_reason = $request->absent_reason[$i];

            $leave_application->save();
            $name = $leave_application->employee->user->first_name . ' ' . $leave_application->employee->user->last_name;
            notification($name . _lang(' has applied for leave on ') . date('D, jS F Y', strtotime($leave_application->date)), null, $user_id);
        }

        if(! $request->ajax()){
            return back()->with('success', _lang('Leave request has been sended sucessfully.'));
        }else{
            return response()->json(['result' => 'success', 'redirect' => url('leave_applications'), 'message' => _lang('Leave request has been sended sucessfully.')]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $leave_application = LeaveApplication::find($id);
        if(! $request->ajax()){
            return view('backend.leave_applications.show', compact('leave_application'));
        }else{
            return view('backend.leave_applications.modal.show', compact('leave_application'));
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function status($id, $status)
    {
        $leave_application = LeaveApplication::find($id);
        if($leave_application->status == 0){
            $leave_application->status = $status;
            $leave_application->save();
            if($status == 1){
                $attendance = new Attendance();
                $attendance->employee_id = $leave_application->employee_id;
                $attendance->date = $leave_application->date;
                $attendance->status = 0;
                $attendance->leave_type_id = $leave_application->leave_type_id;
                $attendance->absent_reason = $leave_application->absent_reason;
                $attendance->save();
            }
            if($status == 1){
                $status = _lang('Approved.');
            }elseif($status == 2){
                $status = _lang('Rejected.');
            }
            $user_id = $leave_application->employee->user->id;
            notification(_lang('Leave request has been ') . $status, null, $user_id);
            return back()->with('success', _lang('Leave request has been ') . $status);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $leave_application = LeaveApplication::find($id);
        $leave_application->delete();

        if(! $request->ajax()){
            return back()->with('success', _lang('Information has been deleted'));
        }else{
            return response()->json(['result'=>'success','message'=>_lang('Information has been deleted')]);
        }
    }
}
