<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

use App\Models\Carousel;

use Auth;

class CarouselController extends Controller
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
    	$caro = Carousel::where('active',1)
    					->where('deleted',0)
    					->get();

        return view('pages.homepage.carousel.index',['carousel' => $caro]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.homepage.carousel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carousel = new Carousel();        
              
        $carousel->title = $request->title;
        $carousel->description = $request->description;
        $carousel->button_label = $request->btn_lbl;
        $carousel->link = $request->link;       

        $carousel->save();

        //image uploading
        $url = url('/').'/images/carousel';

        if($request->hasFile('photo')) 
        {
            $files = Input::file('photo');
            $name = $files->getClientOriginalName();
            $extension = $files->getClientOriginalExtension();
            $size = getImageSize($files);
            $fileExts = array('jpg','jpeg','png','gif','bmp');

            $filePath = public_path().'/images/carousel/'.$carousel->carousel_id;
            $files->move($filePath, $name);             

            $image = [];
            $image['imagePath'] = $url.'/'.$carousel->carousel_id.'/'.$name;

            $carousel->img = $image['imagePath'];                
        } 

        $carousel->save();

        return redirect()->route('carousel.index');
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
        $caro = Carousel::find($id);

        return view('pages.homepage.carousel.edit',['caro' => $caro]);
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
        $carousel = Carousel::find($id);        
              
        $carousel->title = $request->title;
        $carousel->description = $request->description;
        $carousel->button_label = $request->btn_lbl;
        $carousel->link = $request->link;       

        $carousel->save();

        //image uploading
        $url = url('/').'/images/carousel';

        if($request->hasFile('photo')) 
        {
            $files = Input::file('photo');
            $name = $files->getClientOriginalName();
            $extension = $files->getClientOriginalExtension();
            $size = getImageSize($files);
            $fileExts = array('jpg','jpeg','png','gif','bmp');

            $filePath = public_path().'/images/carousel/'.$carousel->carousel_id;
            $files->move($filePath, $name);             

            $image = [];
            $image['imagePath'] = $url.'/'.$carousel->carousel_id.'/'.$name;

            $carousel->img = $image['imagePath'];                
        } 

        $carousel->save();

        return redirect()->route('carousel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carousel = Carousel::find($id);

        $carousel->delete();

        return redirect()->route('carousel.index');
    }
}
