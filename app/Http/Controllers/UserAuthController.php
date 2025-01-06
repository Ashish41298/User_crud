<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

class UserAuthController extends Controller
{
    public function Dashboard(){
        $cuser = User::find(Auth::user()->id);
        return view('user.dashboard', compact('cuser'));
    }
    public function loginview(){
        return view('user.Login');
    }

    public function logindata(Request $request){
        $validated = $request->validate([
            "email"=>"required|email",
            "password"=>"required|min:6"
        ]);

        $check = Auth::attempt($validated);
        if($check && $check !== ""){
            return redirect()->route('Dashboard');
        }else{
            return redirect()->route('login')->with('error', 'credentials are invalid!');
        }
    }

    public function registerview(){
        return view('user.Register');
    }

    public function registerdata(Request $request){

        $validated = $request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:users",
            "password"=>"required|min:6",
            "phone"=>"required|min:10",
            "address"=>"required",
            "image"=>"image|mimes:png,jpeg,jpg,gif,svg"
        ]);

        $file = $request->file('image');
        $filename = "";
        if(!empty($file) && $file !==""){
            $path = public_path()."/profile_image/";
            $filename = "profile_image_".time()."_".$file->getClientOriginalName();
            $moved = $file->move($path,$filename);
        }

        $newuser = User::create([
            "name"=>$validated['name'],
            "email"=>$validated['email'],
            "password"=>$validated['password'],
            "phone"=>$validated['phone'],
            "address"=>$validated['address'],
            "image"=> $filename
        ]);
        if(!empty($newuser) && $newuser !==" "){
            Auth::login($newuser);
            return redirect()->route('Dashboard')->with("success","User created successfully!");
        }else{
            return redirect()->route('register')->with("error", "something whent to wrong! please try again.");
        }
    }

    public function editprofile(){
        $cuser = User::find(Auth::user()->id);
        return view('user.editprofile', compact('cuser'));
    }

    public function editprofiledata(Request $request){
        $userdata = User::find(Auth::user()->id);
        $validated = $request->validate([
            "name"=>"required",
            "email"=>"required|email",
            "password"=>"required|min:6",
            "phone"=>"required|min:10",
            "address"=>"required",
            "image"=>"image|mimes:png,jpeg,jpg,gif,svg"
        ]);
        
        $file = $request->file('image');
        $filename = "";
        if(!empty($file) && $file !==""){
            $path = public_path()."/profile_image/";
            if(file_exists($path.$userdata->image)){
                $userdata->image ?? unlink($path.$userdata->image);
            }
            $filename = "profile_image_".time()."_".$file->getClientOriginalName();
            $moved = $file->move($path,$filename);
        }else{
            $filename = $userdata->image;
        }

       
            $updated = $userdata->update([
                "name"=>$validated['name'],
                "email"=>$validated['email'],
                "password"=> $validated['password'],
                "phone"=>$validated['phone'],
                "address"=>$validated['address'],
                "image"=> $filename
            ]);
       
        $updateduser = User::find(Auth::user()->id);
        if($updated!==" "){
            Auth::login($updateduser);
            return redirect()->route('Dashboard')->with("success","Profile updating successfull.");
        }else{
            return redirect()->route('register')->with("error", "something whent to wrong! please try again.");
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
