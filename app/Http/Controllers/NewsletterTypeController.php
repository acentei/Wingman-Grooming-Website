<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\NewsletterType;

use Auth;

class NewsletterTypeController extends Controller
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
        $newsType = NewsletterType::where('active',1)
                           ->where('deleted',0)
                           ->get();
        
        return view('pages.newslettertype.index',['newsType' => $newsType]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.newslettertype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newsType = new NewsletterType();
                
        $newsType->display_name = $request->name;
                
        $newsType->save();
        
        return redirect()->route('newsletter-type.index');
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
        $newsType = NewsletterType::find($id);
        
        return view('pages.newslettertype.edit',['newsType' => $newsType]);
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
        $newsType = NewsletterType::find($id);
                
        $newsType->display_name = $request->name;
                
        $newsType->save();
        
        return redirect()->route('newsletter-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsType = NewsletterType::find($id);
        
        $type->deleted = 1;
        $type->active = 0;        
                
        $newsType->save();
        
        return redirect()->route('newsletter-type.index');
    }
}
