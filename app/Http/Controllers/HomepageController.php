<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Vinkla\Instagram\Facades\Instagram; 

use App\Models\Newsletter;
use App\Models\Carousel;
use App\Models\About;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //instagram images
        $response     = Instagram::users()->getMedia('self');
        $instagrams   =  json_encode($response->get()); 

        $inst = json_decode($instagrams);       

        //3 recent article
        $articles =  Newsletter::where('active',1)
                                  ->where('deleted',0)
                                  ->orderBy('created_date','DESC')
                                  ->get()
                                  ->take(3);    

        $carousel = Carousel::where('active',1)
                            ->where('deleted',0)
                            ->get();

        $welcomenote = About::get();
        
        return view('pages.homepage.home',['instagram' => $inst, 'newsletter' => $articles,'carousel' => $carousel,'welcome' => $welcomenote[0]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
