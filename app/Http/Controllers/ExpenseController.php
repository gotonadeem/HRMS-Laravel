<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Expense;
use Validator;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::orderBy('id', 'DESC')->get();
        return view('backend.expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if( ! $request->ajax()){
            return view('backend.expenses.create');
        }else{
            return view('backend.expenses.modal.create');
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
            
            'name' => 'required|string|max:191',
            'purchase_from' => 'required|string|max:191',
            'date' => 'required|date',
            'amount' => 'required',
            'bill' => 'nullable|max:1240|mimes:doc,docx,pdf',

        ]);

        if ($validator->fails()) {
            if($request->ajax()){ 
                return response()->json(['result' => 'error', 'message'=>$validator->errors()->all()]);
            }else{
                return back()->withErrors($validator)->withInput();
            }           
        }

        $expense = new Expense();

        $expense->name = $request->name;
        $expense->purchase_from = $request->purchase_from;
        $expense->date = $request->date;
        $expense->amount = $request->amount;
        if($request->hasFile('bill')){
            $file = $request->file('bill');
            $file_name = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('public/uploads/files/'), $file_name);
            $expense->bill = 'files/' . $file_name;
        }

        $expense->save();

        if(! $request->ajax()){
            return redirect('expenses')->with('success', _lang('Information has been added'));
        }else{
            return response()->json(['result'=>'success', 'redirect'=> url('expenses') , 'message'=>_lang('Information has been added')]);
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
        $expense = Expense::find($id);
        if(! $request->ajax()){
            return view('backend.expenses.show', compact('expense'));
        }else{
            return view('backend.expenses.modal.show', compact('expense'));
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
        $expense = Expense::find($id);
        if(! $request->ajax()){
            return view('backend.expenses.edit', compact('expense'));
        }else{
            return view('backend.expenses.modal.edit', compact('expense'));
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
    
        $validator = Validator::make($request->all(), [
            
            'name' => 'required|string|max:191',
            'purchase_from' => 'required|string|max:191',
            'date' => 'required|date',
            'amount' => 'required',
            'bill' => 'nullable|max:1240|mimes:doc,docx,pdf',

        ]);
        
        if ($validator->fails()) {
            if($request->ajax()){ 
                return response()->json(['result'=>'error', 'message'=>$validator->errors()->all()]);
            }else{
                return back()->withErrors($validator)->withInput();
            }           
        }
        
    
        $expense = Expense::find($id);
        $expense->name = $request->name;
        $expense->purchase_from = $request->purchase_from;
        $expense->date = $request->date;
        $expense->amount = $request->amount;
        if($request->hasFile('bill')){
            $file = $request->file('bill');
            $file_name = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('public/uploads/files/'), $file_name);
            $expense->bill = 'files/' . $file_name;
        }
        $expense->save();
        
        if(! $request->ajax()){
            return redirect('expenses')->with('success', _lang('Information has been updated sucessfully'));
        }else{
            return response()->json(['result'=>'success', 'redirect'=> url('expenses'), 'message'=>_lang('Information has been updated sucessfully')]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $expense = Expense::find($id);
        $expense->delete();
        if(! $request->ajax()){
            return back()->with('success', _lang('Information has been deleted'));
        }else{
            return response()->json(['result'=>'success','message'=>_lang('Information has been deleted')]);
        }
    }
}
