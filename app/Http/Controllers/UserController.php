<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(){
        return view('site.new_user');
    }

    public function store(Request $request){
       
          $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255', // Adicionado validação
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'remember' => 'nullable|boolean' // Campo do checkbox
    ]);

    $user = User::create([
        'name' => $validatedData['name'],
        'last_name' => $validatedData['last_name'], // Incluído aqui
        'email' => $validatedData['email'],
        'password' => bcrypt($validatedData['password']),
        'remember_token' => $request->boolean('remember') ? Str::random(60) : null
    ]);

    Auth::login($user);

    return redirect()->route('main')->with('success', 'Usuário criado com sucesso!');
       
    }

    public function registerAdm(){
        return view('admin.registerAdm');
    }

    public function storeAdm(Request $request){
        $user = $request->all();
        $user['password'] = bcrypt($request->password);
        $user['role'] = 'admin';

        User::create($user);
    }
}
