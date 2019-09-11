<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Client;
use App\User;
use Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('id', 'DESC')->get();
        return view("backend.clients.index", compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.clients.create');
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
            'phone' => 'string|max:30',
            'website_url' => 'nullable|string|max:100',
            'skype_id' => 'nullable|string|max:30',
            'facebook_id' => 'nullable|string|max:30',
            'street' => 'required|string|max:191',
            'state' => 'required|string|max:80',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:80',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
            
            'profile' => 'nullable|image|max:5120',
            
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
        $user->user_type = 'Client';
        if ($request->hasFile('profile')){
            $image = $request->file('profile');
            $ImageName = time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)->resize(300, 300)->save(base_path('public/uploads/images/clients/') . $ImageName);
            $user->profile = 'clients/' . $ImageName;
        }
        $user->save();

        $client = new Client();
        
        $client->user_id = $user->id;
        $client->client_id = $request->first_name.'-'.str_random(3);
        $client->phone = $request->phone;
        $client->website_url = $request->website_url;
        $client->skype_id = $request->skype_id;
        $client->facebook_id = $request->facebook_id;
        $client->street = $request->street;
        $client->state = $request->state;
        $client->zip_code = $request->zip_code;
        $client->country = $request->country;

        $client->save();
        
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
        $client = Client::where('client_id', $id)->join('users', 'users.id','=','clients.user_id')->first();
        if(! $request->ajax()){
            return view('backend.clients.show', compact('client'));
        }else{
            return view('backend.clients.modal.show', compact('client'));
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
        $client = Client::where('client_id', $id)->join('users', 'users.id','=','clients.user_id')->first();
        if(! $request->ajax()){
            return view('backend.clients.edit', compact('client'));
        }else{
            return view('backend.clients.modal.edit', compact('client'));
        } 
        // return view('backend.clients.edit', compact('client'));
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
        $client = Client::where('client_id', $id)->first();
        $validator = Validator::make($request->all(), [
            
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => [
                'required',
                Rule::unique('users')->ignore($client->user_id),
            ],
            'phone' => 'string|max:30',
            'website_url' => 'nullable|string|max:100',
            'skype_id' => 'nullable|string|max:30',
            'facebook_id' => 'nullable|string|max:30',
            'street' => 'required|string|max:191',
            'state' => 'required|string|max:80',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:80',
            'password' => 'nullable|string|min:6',
            
            'profile' => 'nullable|image|max:5120',
            
        ]);

        if ($validator->fails()) {
            if($request->ajax()){ 
                return response()->json(['result'=>'error', 'message'=>$validator->errors()->all()]);
            }else{
                return back()->withErrors($validator)->withInput();
            }           
        }

        $user = User::find($client->user_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if($request->password != ''){
            $user->password = $request->password;
        }
        if ($request->hasFile('profile')){
            $image = $request->file('profile');
            $ImageName = time() . '.' . $image->getClientOriginalExtension();
            \Image::make($image)->resize(300, 300)->save(base_path('public/uploads/images/clients/') . $ImageName);
            $user->profile = 'clients/' . $ImageName;
        }
        $user->save();

        $client->phone = $request->phone;
        $client->website_url = $request->website_url;
        $client->skype_id = $request->skype_id;
        $client->facebook_id = $request->facebook_id;
        $client->street = $request->street;
        $client->state = $request->state;
        $client->zip_code = $request->zip_code;
        $client->country = $request->country;

        // print_r($client->first_name); exit();

        $client->save();
        
        if(! $request->ajax()){
            return back()->with('success', _lang('Information has been added sucessfully'));
        }else{
            return response()->json(['result'=>'success', 'redirect'=> url('clients'), 'message'=> _lang('Information has been added sucessfully')]);
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
        $client = Client::where('client_id', $id)->first();
        $client->delete();
        return redirect('employees')->with('success', _lang('Information has been deleted'));
    }
}
