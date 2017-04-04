<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile($id){
        return view('user.profile', ['user' => User::where('id',$id)->first()]);
    }

    public function editProfile($id){
        return view('user.editProfile', ['user' => User::where('id',$id)->first()]);
    }
}
