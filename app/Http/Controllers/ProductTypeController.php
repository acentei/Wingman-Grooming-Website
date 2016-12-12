<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\ProductType;

use Auth;

class ProductTypeController extends Controller
{
    /**
     *  Authenticate access
     */
    public function __construct()
    {          
        $this->middleware('auth');      
        
        if (Auth::check()){
            parent::__construct();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = ProductType::where('active',1)
                           ->where('deleted',0)
                           ->get();
        
        return view('pages.producttype.index',['type' => $type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.producttype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = new ProductType();
                
        $type->display_name = $request->name;
                
        $type->save();
        
        return redirect()->route('product-type.index');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = ProductType::find($id);
        
        return view('pages.producttype.edit',['type' => $type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = ProductType::find($id);
                
        $type->display_name = $request->name;
                
        $type->save();
        
        return redirect()->route('product-type.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = ProductType::find($id);
        
        $type->deleted = 1;
        $type->active = 0;
                
        $type->save();
        
        return redirect()->route('product-type.index'); 
    }
}
