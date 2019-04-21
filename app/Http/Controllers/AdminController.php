<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;
use Hash;   
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function showEditProfilePage()
    {
        return view('admin.profile.edit');
    }

    public function saveProfile(Request $request)
    {
        $profile_image = '';
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasfile('profile_image'))
        {
            $image  = $request->file('profile_image');
            $profile_image   = time().'_'.$image->getClientOriginalName();
            $image->move(public_path().'/images/profile_image/', $profile_image);  
        }

        $User = User::find(Auth::user()->id);
        $User->name = $request->name;
        $User->email = $request->email;
        if ($profile_image) {
            $User->profile_image = $profile_image;
        }
        $User->save();

        return back()->with('message', 'Successfully saved.');
    }

    public function showEditPasswordPage()
    {
        return view('admin.profile.changePassword');
    }

    public function saveChangePassword(Request $request)
    {
        if(Auth::Check())
        {
            $request_data = $request->All();
            $validator = $this->admin_credential_rules($request_data);
            if($validator->fails())
            {
                return back()
                        ->withErrors($validator)
                        ->withInput();
            }
            else
            {  
                $current_password = Auth::User()->password;           
                if(Hash::check($request_data['current-password'], $current_password))
                {           
                    $user_id = Auth::User()->id;                       
                    $obj_user = User::find($user_id);
                    $obj_user->password = Hash::make($request_data['password']);;
                    $obj_user->save(); 
                    return back()->with('message', 'Successfully saved.');
                }
                else
                {          
                    return back()->with('error', 'Please enter correct current password.');
                }
            }        
        }
        else
        {
            return redirect()->to('/');
        }    
    }

    public function admin_credential_rules(array $data)
    {
        $messages = [
            'current-password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
        ];

        $validator = Validator::make($data, [
            'current-password' => 'required',
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',     
        ], $messages);

        return $validator;
    }    
}
