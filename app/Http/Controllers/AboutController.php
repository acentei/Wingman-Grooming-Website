<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\About;

use Auth;

class AboutController extends Controller
{
    /**
     *  Authenticate access
     */
    public function __construct()
    {          
        $this->middleware('auth',['except' => 'index']);      
        
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
        $about = About::get();          
            
        return view('pages.about.index',['about' => $about[0]]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $about = About::find($id);
                
        return view('pages.about.edit',['about' => $about]);
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
        $about = About::find($id);
        
        $about->about_website = $request->about;
                
        $about->save();
        
        return redirect()->route('about.index');   
    }
}
