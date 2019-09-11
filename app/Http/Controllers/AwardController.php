<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Award;
use App\User;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $awards = Award::orderBy('id', 'DESC')->get();
        return view('backend.awards.index',compact('awards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(! $request->ajax()){
            return view('backend.awards.create');
        }else{
            return view('backend.awards.modal.create');
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
            'types_of_award_id' => 'required|numeric',
            'gift_item' => 'required|string|max:100',
            'cash_price' => 'nullable|numeric',
            'employee_id' => 'required',
            'month_year' => 'required',
        ]);
        if ($validator->fails()) {
            if($request->ajax()){ 
                return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
            }else{
                return back()->withErrors($validator)->withInput();
            }           
        }
        $month_year = (explode('/', $request->month_year));
        $award = new Award();

        $award->types_of_award_id = $request->types_of_award_id;
        $award->gift_item = $request->gift_item;
        $award->cash_price = $request->cash_price;
        $award->employee_id = $request->employee_id;
        $award->month = $month_year[0];
        $award->year = $month_year[1];
        
        $award->save();
        
        if(! $request->ajax()){
            return redirect('awards')->with('success', _lang('Information has been added'));
        }else{
            return response()->json(['result' => 'success', 'redirect' => url('/awards'), 'message' => _lang('Information has been added sucessfully')]);
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
        $award = Award::find($id);
        if(! $request->ajax()){
            return view('backend.awards.show', compact('award'));
        }else{
            return view('backend.awards.modal.show', compact('award'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $award = Award::find($id);
        $award->month_year = $award->month . '/' . $award->year;
        if(! $request->ajax()){
            return view('backend.awards.edit', compact('award'));
        }else{
            return view('backend.awards.modal.edit', compact('award'));
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
            'types_of_award_id' => 'required|numeric',
            'gift_item' => 'required|string|max:100',
            'cash_price' => 'nullable|numeric',
            'employee_id' => 'required',
            'month_year' => 'required',
        ]);
        if ($validator->fails()) {
            if($request->ajax()){ 
                return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
            }else{
                return back()->withErrors($validator)->withInput();
            }           
        }
        $month_year = (explode('/', $request->month_year));
        $award = Award::find($id);
        
        $award->types_of_award_id = $request->types_of_award_id;
        $award->gift_item = $request->gift_item;
        $award->cash_price = $request->cash_price;
        $award->employee_id = $request->employee_id;
        $award->month = $month_year[0];
        $award->year = $month_year[1];
        
        $award->save();

        if(! $request->ajax()){
            return redirect('awards')->with('success', _lang('Information has been updated'));
        }else{
            return response()->json(['result' => 'success', 'redirect' => url('awards'), 'message' => _lang('Information has been updated sucessfully')]);
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
        $award = Award::find($id);
        $award->delete();
        if(! $request->ajax()){
            return back()->with('success', _lang('Information has been deleted'));
        }else{
            return response()->json(['result'=>'success','message'=>_lang('Information has been deleted sucessfully')]);
        }
    }
}
