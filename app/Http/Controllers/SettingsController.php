<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Carbon\Carbon;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function general(Request $request)
    {
        
        if($request->all() == null){
           return view('backend.administration.settings.general');
        }else{
            foreach($request->except('_token') as $key => $value){
                $data = array();
                $data['value'] = is_array($value) ? serialize($value) : $value; 
                $data['updated_at'] = Carbon::now();
                if ($request->hasFile($key)) {
                    $image = $request->file($key);
                    $name = $key . '.' .$image->getClientOriginalExtension();
                    $path = public_path('/uploads/images/');
                    if($key == 'logo'){
                        $name = 'logo.png';
                        \Image::make($image)->resize(175, 50)->save($path . $name);
                    }else{
                        $image->move($path, $name);
                    }
                    $data['value'] = $name; 
                    $data['updated_at'] = Carbon::now();
                }
                if(Setting::where('name', $key)->exists()){  
                    Setting::where('name','=',$key)->update($data);         
                }else{
                    $data['name'] = $key; 
                    $data['created_at'] = Carbon::now();
                    Setting::insert($data); 
                }
            }
            if(! $request->ajax()){
                return redirect('administration/settings/general')->with('success', _lang('Saved sucessfully'));
            }else{
                return response()->json(['result' => 'success', 'message' => _lang('Saved sucessfully')]);
            }
        }
    }
}
