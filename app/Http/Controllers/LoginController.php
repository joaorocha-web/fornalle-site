<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(){
        return view('site.login');
    }

    public function validation(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            // // return redirect()->route('pizza.index');
            $login['success'] = true;
            echo json_encode($login);
            return;
        }else{
            // return redirect()->back()->with('error', 'Usuário Inválido');
            $login['success'] = false;
            $login['message'] = "Usuário Inválido";
            echo json_encode($login);
            return;
        }
        
    }

    public function logout(){
        Auth::logout();
        session()->flush();
        session()->regenerate();
        session()->start();
        return redirect()->route('main');
    }
}
