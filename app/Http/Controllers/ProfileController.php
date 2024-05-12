<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // Admin Profile Page
    public function index(){
        $id = Auth::user()->id;
        $user = User::where('id' , $id)->first();

        return view('admin.profile.index' , compact('user'));
    }

    // Update Profile
    public function updateProfile(Request $request){
        $this->validateData($request);

        User::where('id' , Auth::user()->id)->update([
            'name' => $request->name ,
            'email' => $request->email ,
            'phone' => $request->phone ,
            'address' => $request->address ,
            'gender' => $request->gender ,
        ]);

        return back()->with(['success' => 'Updated Successfully !']);
    }

    // Update Password Page
    public function updatePasswordPage(){
        return view('admin.profile.password');
    }

    // Update Password
    public function updatePassword(Request $request){
        $this->validatePassword($request);

        $db = User::where('id',Auth::user()->id)->first();
        $dbPw = $db->password;

        $userOldPw = $request->old;
        $userNewPw = $request->new;

        if (Hash::check($userOldPw, $dbPw)) {
            User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($userNewPw)
            ]);
            return redirect()->route('admin#profile');
        } else {
            return back()->with(['fail'=>'Old password does not match ... !']);
        }
    }

    private function validateData($request){
        Validator::make($request->all(),[
            'name' => 'required' ,
            'email' => 'required'
        ])->validate();
    }
    private function validatePassword($request){
        Validator::make($request->all(),[
            'old' => 'required' ,
            'new' => 'required|min:8' ,
            'confirm' => 'required|min:8|same:new'
        ])->validate();
    }
}
