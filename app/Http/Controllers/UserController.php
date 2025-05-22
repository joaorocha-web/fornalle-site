<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(){
        return view('site.new_user');
    }

    public function store(Request $request){
       
        $user = $request->all();
        $user['password'] = bcrypt($request->password);
        $user['remember_token'] = $request->remember_token ? Str::random(60) : null;
        User::create($user);
    }
}
