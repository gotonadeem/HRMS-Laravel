<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Holiday;
use App\Setting;
use Validator;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($month = '')
    {
        if($month == ''){
            return redirect('holidays/month/' . date('F'));
        }
        $month_num = date('m', strtotime($month));
        $holidays = Holiday::whereMonth('date', $month_num)->orderBy('date', 'ASC')->get();
        return view('backend.holidays.index', compact('month', 'holidays'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if( ! $request->ajax()){
            return view('backend.holidays.create');
        }else{
            return view('backend.holidays.modal.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_weekend_holidays(Request $request)
    {
        if( ! $request->ajax()){
            return view('backend.holidays.weekend');
        }else{
            return view('backend.holidays.modal.weekend');
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
        $validator = Validator::make($request->all(), 
            [

                'title'    => "required|array|min:1",
                'title.*'  => 'required|string|distinct|min:3',
                'date'    => "required|array|min:1",
                'date.*'  => 'required|date|distinct|unique:holidays,date',

            ],
            [

                'unique' => 'This date (:input) has already added in holidays list.',

            ]
        );

        if ($validator->fails()) {
            if($request->ajax()){ 
                return response()->json(['result' => 'error', 'message'=>$validator->errors()->all()]);
            }else{
                return back()->withErrors($validator)->withInput();
            }			
        }

        for ($i=0; $i < count($request->title); $i++) { 
            if($request->title[$i] != '' && $request->date[$i] != ''){
                $holiday = new Holiday();
                $holiday->title = $request->title[$i];
                $holiday->date = $request->date[$i];
                $holiday->save();
            }
        }
        

        $month = date('F', strtotime($request->date[0]));
        if(! $request->ajax()){
            return redirect('holidays/month/' . $month)->with('success', _lang('Information has been added'));
        }else{
            return response()->json(['result'=>'success', 'redirect'=> url('holidays/month/' . $month) , 'message'=>_lang('Information has been added'),'data' => $holiday]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_weekend_holiday(Request $request)
    {
        $validator = Validator::make($request->all(),[

            'day'    => "required",

        ]);

        if ($validator->fails()) {
            if($request->ajax()){ 
                return response()->json(['result' => 'error', 'message'=>$validator->errors()->all()]);
            }else{
                return back()->withErrors($validator)->withInput();
            }           
        }

        if(get_option('weekend_holiday') == ''){
            foreach (get_weekend_holiday($request->day) as $date) {
                if(!Holiday::whereDate('date', $date)->exists()){
                    $holiday = new Holiday();
                    $holiday->title = _lang('Weekend Holiday');
                    $holiday->date = $date;
                    $holiday->save();
                }
            }
        }

        $setting = new Setting();
        $setting->name = 'weekend_holiday';
        $setting->value = $request->day;
        $setting->save();
        
        if(! $request->ajax()){
            return redirect('holidays')->with('success', _lang('Information has been added'));
        }else{
            return response()->json(['result'=>'success', 'redirect'=> url('holidays') , 'message'=>_lang('Weekend holiday has been save sucessfully')]);
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
        $holiday = Holiday::find($id);
        if(! $request->ajax()){
            return view('backend.holidays.show', compact('holiday'));
        }else{
            return view('backend.holidays.modal.show', compact('holiday'));
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
        $holiday = Holiday::find($id);
        $holiday->delete();
        if(! $request->ajax()){
            return back()->with('success', _lang('Information has been deleted'));
        }else{
            return response()->json(['result'=>'success','message'=>_lang('Information has been deleted')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_weekend_holiday($id)
    {

        $holidays = Holiday::whereIn('date', get_weekend_holiday($id))->get();
        foreach ($holidays as $holiday) {
            $holiday->delete();
        }

        $setting = Setting::where('name', 'weekend_holiday');
        $setting->delete();

        return back()->with('success', _lang('Information has been deleted'));
    }
}
