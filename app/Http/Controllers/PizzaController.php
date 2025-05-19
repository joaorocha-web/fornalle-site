<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Pizza;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizzas = \App\Models\Pizza::all();
        return view('site.pizza', ['pizzas' => $pizzas]);
       
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('site.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required|max:100',
            'price' => 'required|numeric|min:0',
        ]);

        $pizza = new Pizza();
        $pizza->name = $request->name;
        $pizza->category = $request->category;
        $pizza->description = $request->description;
        $pizza->price = $request->price;
        $pizza->status = $request->status;
        $pizza->save();

        return redirect()->route("pizza.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $pizza = Pizza::where('id', $id)->first();
        if($pizza) return view('site.edit', ['pizza' => $pizza]);
        

        return redirect()->route("pizza.index");   
           
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'status' => $request->status
        ];
        Pizza::where('id', $id)->update($data);
        return redirect()->route("pizza.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      Pizza::where('id', $id)->delete();
      return redirect()->route("pizza.index");
    }
}
