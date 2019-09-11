<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Notice;
use Validator;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::orderBy('id', 'DESC')->get();
        return view('backend.notices.index', compact('notices'));
    }
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		if( ! $request->ajax()){
		    return view('backend.notices.create');
		}else{
            return view('backend.notices.modal.create');
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
			
           'title' => 'required|string|max:191',
           'description' => 'required|string|max:191',

		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error', 'message'=>$validator->errors()->all()]);
			}else{
				return back()->withErrors($validator)->withInput();
			}			
		}
		
	
        $notice = new Notice();
        
        $notice->title = $request->title;
        $notice->description = $request->description;
        $notice->status = 'Active';

        $notice->save();
        
		if(! $request->ajax()){
            return back()->with('success', _lang('Information has been added sucessfully'));
        }else{
		    return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Information has been added sucessfully'),'data'=>$notice]);
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
        $notice = Notice::find($id);
		if(! $request->ajax()){
		    return view('backend.notices.show', compact('notice'));
		}else{
			return view('backend.notices.modal.show', compact('notice'));
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
        $notice = Notice::find($id);
		if(! $request->ajax()){
		    return view('backend.notices.edit', compact('notice'));
		}else{
			return view('backend.notices.modal.edit', compact('notice'));
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
			
           'title' => 'required|string|max:191',
           'description' => 'required|string|max:191',
           'status' => 'required',

		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error', 'message'=>$validator->errors()->all()]);
			}else{
				return back()->withErrors($validator)->withInput();
			}			
		}
		
	
        $notice = Notice::find($id);
        
        $notice->title = $request->title;
        $notice->description = $request->description;
        $notice->status = $request->status;

        $notice->save();
		
		if(! $request->ajax()){
            return redirect('notices')->with('success', _lang('Information has been updated sucessfully'));
        }else{
		    return response()->json(['result'=>'success','action'=>'update', 'message'=>_lang('Information has been updated sucessfully'),'data'=>$notice]);
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
        $notice = Notice::find($id);
        $notice->delete();
        if(! $request->ajax()){
            return back()->with('success', _lang('Information has been deleted'));
        }else{
            return response()->json(['result'=>'success','message'=>_lang('Information has been deleted')]);
        }
    }
}
