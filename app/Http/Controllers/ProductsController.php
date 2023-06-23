<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\category;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registerid = Auth::user()->id;
        $data = Products::where('register_id',$registerid)->with('createdBy')->get();
        

        $Products = Products::latest()->paginate(5);
    
        return view('products.index',compact('Products','data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        $category= category::get();
        return view('products.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:90048',
            'category_id' => 'required',
            
        ]); 
        $input = $request->all();
       
        if ($image = $request->file('image')) {
            
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
      
        
        Products::create($input);
     
        return redirect()->route('products.index')
                        ->with('success','Products created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products,$id)
    {
        
        $product= Products ::where('id',$id)->first();
        $category= category::get();
     
        return view('products.edit',compact('product','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
            'category_id' => 'required',
        ]);
    
        $input = $request->all();
        
        if ($image = $request->file('image')){
            
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $request['image']->move(base_path() . '/public/images', $profileImage);
            $input['image'] = "$profileImage";
        }
          $product->update($input);
          $e = Products::get();
    
        return redirect()->route('products.index')
                        ->with('success','Products updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        
        $product->delete();
    
        return redirect()->route('products.index')
                        ->with('success','Products deleted successfully');
    }
}
