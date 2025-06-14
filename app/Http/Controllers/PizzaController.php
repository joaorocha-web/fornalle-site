<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Pizza;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Middleware\Authorize;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('area-admin');
        $pizzas = \App\Models\Pizza::all();
        return view('admin.pizza', ['pizzas' => $pizzas]); 
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.register');
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
            'image_url' => 'sometimes|image',
        ]);

         $pizza = new Pizza();
         
        if(isset($request->file)){
            $fileName = rand(0, 99) . '-' . $request->file('image_url')->getClientOriginalName();
            $path = $request->file('image_url')->storeAs('pizza_images', $fileName);
            $pizza->image_url = $path;
        }
        
      

       
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
        if($pizza) return view('admin.edit', ['pizza' => $pizza]);
        

        return redirect()->route("pizza.index");   
           
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
        'name' => 'required',
        'category' => 'required',
        'description' => 'required|max:100',
        'price' => 'required|numeric|min:0',
        'image_url' => 'sometimes|image', 
    ]);

    $pizza = Pizza::findOrFail($id);

   
    if ($request->hasFile('image_url')) {
        
        if ($pizza->image_url && Storage::exists($pizza->image_url)) {
            Storage::delete($pizza->image_url);
        }

       
        $fileName = rand(0, 99) . '-' . $request->file('image_url')->getClientOriginalName();
        $path = $request->file('image_url')->storeAs('pizza_images', $fileName);
        $pizza->image_url = $path;
    }

    $pizza->name = $request->name;
    $pizza->category = $request->category;
    $pizza->description = $request->description;
    $pizza->price = $request->price;
    $pizza->status = $request->status;
    
    $pizza->save();

    return redirect()->route("pizza.index")->with('success', 'Pizza atualizada com sucesso!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         if (!Gate::allows('manager-access')) {
        return response()->json([
            'success' => false,
            'message' => 'Acesso negado'
        ], 403);
    }
        try {
        $pizza = Pizza::findOrFail($id);
        $pizza->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pizza excluída com sucesso'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erro: ' . $e->getMessage()
        ], 500);
    }
    }
}
