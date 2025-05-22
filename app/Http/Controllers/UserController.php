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
        // $user['password'] = bcrypt($request->password);
        User::create($user);
    }
}
