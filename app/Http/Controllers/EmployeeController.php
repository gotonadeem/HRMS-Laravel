<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Employee;
use App\User;
use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'DESC')->get();
        return view('backend.employees.index', compact('employees'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if( ! $request->ajax()){
            return view('backend.employees.create');
        }else{
            return view('backend.employees.modal.create');
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
            
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'father_name' => 'nullable|string|max:191',
            'mother_name' => 'nullable|string|max:191',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string|max:30',
            'street' => 'required|string|max:191',
            'state' => 'required|string|max:80',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:80',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
            'employee_id' => 'required|unique:employees',
            'department_id' => 'required|numeric',
            'designation_id' => 'required|numeric',
            'joining_date' => 'required|date',
            'exit_date' => 'nullable|date',
            'account_holder_name' => 'nullable|string|max:191',
            'account_number' => 'nullable|string|max:80',
            'bank_name' => 'nullable|string|max:191',
            'bank_identifier_code' => 'nullable|string|max:100',
            'branch_location' => 'nullable|string|max:100',
            'profile' => 'nullable|image|max:5120',
            'resume' => 'nullable|max:5120|mimes:doc,docx,pdf',
            'joining_letter' => 'nullable|max:5120|mimes:doc,docx,pdf',
            'id_card' => 'nullable|max:5120|mimes:doc,docx,pdf',

        ]);
        
        if ($validator->fails()) {
            if($request->ajax()){ 
                return response()->json(['result'=>'error', 'message'=>$validator->errors()->all()]);
            }else{
                return back()->withErrors($validator)->withInput();
            }           
        }
        
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->user_type = 'Employee';
        if ($request->hasFile('profile')){
            $image = $request->file('profile');
            $ImageName = time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)->resize(300, 300)->save(base_path('public/uploads/images/employees/') . $ImageName);
            $user->profile = 'employees/' . $ImageName;
        }
        $user->save();
    
        $employee = new Employee();
        
        $employee->user_id = $user->id;
        $employee->father_name = $request->father_name;
        $employee->mother_name = $request->mother_name;
        $employee->dob = $request->dob;
        $employee->phone = $request->phone;
        $employee->street = $request->street;
        $employee->state = $request->state;
        $employee->zip_code = $request->zip_code;
        $employee->country = $request->country;
        $employee->employee_id = $request->employee_id;
        $employee->department_id = $request->department_id;
        $employee->designation_id = $request->designation_id;
        $employee->joining_date = $request->joining_date;
        $employee->exit_date = $request->exit_date;
        $employee->joining_salary = $request->joining_salary;
        $employee->current_salary = $request->current_salary;
        $employee->account_holder_name = $request->account_holder_name;
        $employee->account_number = $request->account_number;
        $employee->bank_name = $request->bank_name;
        $employee->bank_identifier_code = $request->bank_identifier_code;
        $employee->branch_location = $request->branch_location;
        
        if($request->hasFile('resume')){
            $file = $request->file('resume');
            $file_name = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('public/uploads/files/'), $file_name);
            $employee->resume = 'files/' . $file_name;
        }
        if($request->hasFile('joining_letter')){
            $file = $request->file('joining_letter');
            $file_name = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('public/uploads/files/'), $file_name);
            $employee->joining_letter = 'files/' . $file_name;
        }
        if($request->hasFile('id_card')){
            $file = $request->file('id_card');
            $file_name = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('public/uploads/files/'), $file_name);
            $employee->id_card = 'files/' . $file_name;
        }
        
        $employee->save();
        
        if(! $request->ajax()){
            return back()->with('success', _lang('Information has been added sucessfully'));
        }else{
            return response()->json(['result'=>'success', 'redirect'=> url('employees'), 'message'=> _lang('Information has been added sucessfully')]);
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
        $employee = Employee::find($id);
        if(! $request->ajax()){
            return view('backend.employees.show', compact('employee'));
        }else{
            return view('backend.employees.modal.show', compact('employee'));
        } 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $employee = Employee::find($id);
        if(! $request->ajax()){
            return view('backend.employees.edit', compact('employee'));
        }else{
            return view('backend.employees.modal.edit', compact('employee'));
        }  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $validator = Validator::make($request->all(), [
            
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'father_name' => 'nullable|string|max:191',
            'mother_name' => 'nullable|string|max:191',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string|max:30',
            'street' => 'required|string|max:191',
            'state' => 'required|string|max:80',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:80',
            'email' => [
                'required',
                Rule::unique('users')->ignore($employee->user_id),
            ],
            'password' => 'nullable|string|min:6',
            'department_id' => 'required|numeric',
            'designation_id' => 'required|numeric',
            'joining_date' => 'required|date',
            'exit_date' => 'nullable|date',
            'account_holder_name' => 'nullable|string|max:191',
            'account_number' => 'nullable|string|max:80',
            'bank_name' => 'nullable|string|max:191',
            'bank_identifier_code' => 'nullable|string|max:100',
            'branch_location' => 'nullable|string|max:100',
            'profile' => 'nullable|image|max:5120',
            'resume' => 'nullable|max:5120|mimes:doc,docx,pdf',
            'joining_letter' => 'nullable|max:5120|mimes:doc,docx,pdf',
            'id_card' => 'nullable|max:5120|mimes:doc,docx,pdf',
            'status' => 'required',

        ]);
        
        if ($validator->fails()) {
            if($request->ajax()){ 
                return response()->json(['result'=>'error', 'message'=>$validator->errors()->all()]);
            }else{
                return back()->withErrors($validator)->withInput();
            }           
        }
        
        $user = User::find($employee->user_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if($request->password != ''){
            $user->password = $request->password;
        }
        $user->status = $request->status;
        if ($request->hasFile('profile')){
            $image = $request->file('profile');
            $ImageName = time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)->resize(300, 300)->save(base_path('public/uploads/images/employees/') . $ImageName);
            $user->profile = 'employees/' . $ImageName;
        }
        $user->save();
        
        $employee->father_name = $request->father_name;
        $employee->mother_name = $request->mother_name;
        $employee->dob = $request->dob;
        $employee->phone = $request->phone;
        $employee->street = $request->street;
        $employee->state = $request->state;
        $employee->zip_code = $request->zip_code;
        $employee->country = $request->country;
        $employee->department_id = $request->department_id;
        $employee->designation_id = $request->designation_id;
        $employee->joining_date = $request->joining_date;
        $employee->exit_date = $request->exit_date;
        $employee->joining_salary = $request->joining_salary;
        $employee->current_salary = $request->current_salary;
        $employee->account_holder_name = $request->account_holder_name;
        $employee->account_number = $request->account_number;
        $employee->bank_name = $request->bank_name;
        $employee->bank_identifier_code = $request->bank_identifier_code;
        $employee->branch_location = $request->branch_location;
        
        if($request->hasFile('resume')){
            $file = $request->file('resume');
            $file_name = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('public/uploads/files/'), $file_name);
            $employee->resume = 'files/' . $file_name;
        }
        if($request->hasFile('joining_letter')){
            $file = $request->file('joining_letter');
            $file_name = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('public/uploads/files/'), $file_name);
            $employee->joining_letter = 'files/' . $file_name;
        }
        if($request->hasFile('id_card')){
            $file = $request->file('id_card');
            $file_name = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('public/uploads/files/'), $file_name);
            $employee->id_card = 'files/' . $file_name;
        }

        $employee->save();
        
        if(! $request->ajax()){
            return redirect('employees')->with('success', _lang('Information has been updated sucessfully'));
        }else{
            return response()->json(['result'=>'success', 'redirect'=> url('employees'), 'message'=>_lang('Information has been updated sucessfully')]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect('employees')->with('success', _lang('Information has been deleted'));
    }
}
