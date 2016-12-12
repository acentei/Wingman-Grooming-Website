<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;

use App\Models\NewsletterType;
use App\Models\Newsletter;

use Auth;
use Mail;

class NewsletterController extends Controller
{
    /**
     *  Authenticate access
     */
    public function __construct()
    {          
        $this->middleware('auth',['except' => ['index','show']]);      
        
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
        $isSearch = "";
        
        $search = \Request::get('search');
        $category = \Request::get('category');
        
        if(!empty($search))
        {
            $isSearch = "true";
        }

        $this->selectedCat = NewsletterType::where('display_name',\Request::get('category'))
                                        ->where('active',1)
                                        ->where('deleted',0)
                                        ->get();  

        $newsletter = Newsletter::where('active',1)
                                  ->where('deleted',0)
                                  ->where(function ($query) {
                                        $query->where('title','LIKE','%'.\Request::get('search').'%')
                                              ->orWhere('body','LIKE','%'.\Request::get('search').'%');
                                    })
                                  ->whereHas('category',function ($query) {
                                        if(count($this->selectedCat) != 0)
                                        {
                                            $query->where('newsletter_type_id','=',$this->selectedCat[0]->newsletter_type_id);
                                        }                                
                                    })
                                  ->orderBy('created_date','DESC')
                                  ->paginate(9);

        return view('pages.newsletter.index',['newsletter' => $newsletter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newsType = NewsletterType::where('active',1)
                                  ->where('deleted',0)
                                  ->get()
                                  ->lists("display_name",'newsletter_type_id');
        
        return view('pages.newsletter.create',['newsType' => $newsType]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newsletter = new Newsletter();
                
        $titleSlug = Str::slug($request->title);
        
        $slug = $titleSlug;
        
        //check if there is same slug
        $sameSlugCount = Newsletter::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
                
        if($sameSlugCount == 0)
        {
            $newsletter->slug = $slug;
        }
        //if there is one or more slug with the same
        else
        {
            $finalSluggable = $request->title.' '.$sameSlugCount;

            $newsletter->slug = Str::slug($finalSluggable); 
        }
        
        $newsletter->title = $request->title;
        $newsletter->newsletter_type_id = $request->newsletterType;        
        $newsletter->body = $request->body;
        
        $newsletter->save();
        
        //image uploading
        $url = url('/').'/images/newsletter'; 
                
        if($request->hasFile('img_newsletter')) 
        {
            $files = Input::file('img_newsletter');
            $name = $files->getClientOriginalName();
            $extension = $files->getClientOriginalExtension();
            $size = getImageSize($files);
            $fileExts = array('jpg','jpeg','png','gif','bmp');
                        
            $filePath = public_path().'/images/newsletter/'.$newsletter->newsletter_id;
            $files->move($filePath, $name);             
            
            $image = [];
            $image['imagePath'] = $url.'/'.$newsletter->newsletter_id.'/'.$name;

            $newsletter->image = $image['imagePath'];                
        }
        
        $newsletter->save();

        $data = array(
                        'image' => $newsletter->image,
                        'url' => url('/').'/newsletter/'.date('Y-m-d').'/'.$newsletter->slug,
                    );

        Mail::send('pages.emails.newsletter-email', $data, function($message) use ($data)
        {
            $message->subject('Wingman Grooming Newsletter');
            $message->from('ecommerce.mark8@gmail.com', 'Wingman Grooming');
            $message->to('ecommerce.mark8@gmail.com');
        });

        return redirect()->route('newsletter.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date,$slug)
    {     
        $newsletter = Newsletter::where('active',1)
                                ->where('deleted',0)
                                ->where('slug',$slug)
                                ->get();
        
        $recent =  Newsletter::where('newsletter_id','!=',$newsletter[0]->newsletter_id)
                              ->where('active',1)
                              ->where('deleted',0)
                              ->orderBy('created_date','DESC')
                              ->get()
                              ->take(8);
        
        return view('pages.newsletter.fullarticle',['newsletter' => $newsletter[0], 'recent' => $recent]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newsletter = Newsletter::find($id);
        
        $newsType = NewsletterType::where('active',1)
                                  ->where('deleted',0)
                                  ->get()
                                  ->lists("display_name",'newsletter_type_id');
        
        return view('pages.newsletter.edit',['newsType' => $newsType,'newsletter' => $newsletter]);
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
        $newsletter = Newsletter::find($id);
        
        $titleSlug = Str::slug($request->title);
        
        $slug = $titleSlug;
        
        //check if there is same slug
        $sameSlugCount = Newsletter::where('newsletter_id','!=',$id)
                                   ->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
                
        if($sameSlugCount == 0)
        {
            $newsletter->slug = $slug;
        }
        //if there is one or more slug with the same
        else
        {
            $finalSluggable = $request->title.' '.$sameSlugCount;

            $newsletter->slug = Str::slug($finalSluggable); 
        }
        
        $newsletter->title = $request->title;
        $newsletter->newsletter_type_id = $request->newsletterType;        
        $newsletter->body = $request->body;
        $newsletter->modified_date = date('Y-m-d H:i:s');
        $newsletter->modified_by = "ADMIN";
        
        $newsletter->save();
        
        //image uploading
        $url = url('/').'/images/newsletter'; 
                        
        if($request->hasFile('img_newsletter')) 
        {
            $files = Input::file('img_newsletter');
            $name = $files->getClientOriginalName();
            $extension = $files->getClientOriginalExtension();
            $size = getImageSize($files);
            $fileExts = array('jpg','jpeg','png','gif','bmp');
                        
            $filePath = public_path().'/images/newsletter/'.$newsletter->newsletter_id;
            $files->move($filePath, $name);             
            
            $image = [];
            $image['imagePath'] = $url.'/'.$newsletter->newsletter_id.'/'.$name;

            $newsletter->image = $image['imagePath'];                
        }
        
        $newsletter->save();
        
        return redirect()->route('newsletter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsletter = Newsletter::find($id);
        
        $newsletter->deleted = 1;
        $newsletter->active = 0;
        $newsletter->modified_date = date('Y-m-d H:i:s');
        $newsletter->modified_by = "ADMIN";
                
        $newsletter->save();
        
        return redirect()->route('newsletter.index');
    }
}
