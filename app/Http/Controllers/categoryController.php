<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $registerid =Auth::user()->id;
        $list = category::with(['categorys'=>function($q)use($registerid){
            $q->where('register_id',$registerid);
        }])->get();

        
        // return($userid);
        // $datas = products::with('created_id')->where('user_id',$userid)->get();
        // return $datas->category_id;
       
        
      
        $category = category::latest()->paginate(5);
        
    
        return view('category.index',compact('category','list'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        $to = Auth::user()->email;
        $datas=array('name'=>$request->name);
        Mail::send('user.email',$datas,function($message) use($to){
            $message->to($to);
            $message->subject('NEW CATEGORY ADDED...');
        });
    
        category::create($request->all());
     
        return redirect()->route('category.index')
                        ->with('success','category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
       
        return view('category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
    
        $category->update($request->all());
    
        return redirect()->route('category.index')
                        ->with('success','category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        
        $category->delete();
    
        return redirect()->route('category.index')
                        ->with('success','category deleted successfully');
    }
    

    

}
