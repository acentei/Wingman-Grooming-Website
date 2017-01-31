<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

use File;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Brand;
use App\Models\ProductProperty;

use Auth;

class ProductController extends Controller
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
        $product = Product::where('active',1)
                          ->where('deleted',0)
                          ->orderBy('name','ASC')
                          ->paginate(12);                          
        
        return view('pages.shop.product.index',['products' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = Brand::where('active',1)
                      ->where('deleted',0)
                      ->get()
                      ->lists("display_name",'brand_id');
        
        $type = ProductType::where('active',1)
                      ->where('deleted',0)
                      ->get()
                      ->lists("display_name",'product_type_id');
        
        
        return view('pages.shop.product.create',['brand' => $brand,'type' => $type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $product = new Product();
        
        $slug = Str::slug($request->pcode.' '.$request->pname);        
        
        //check if there is same slug
        $sameSlugCount = Product::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
                
        if($sameSlugCount == 0)
        {
            $product->slug = $slug;
        }
        //if there is one or more slug with the same
        else
        {
            $finalSluggable = $request->pcode.' '.$request->pname.' '.$sameSlugCount;

            $product->slug = Str::slug($finalSluggable); 
        }
        
        $product->product_code = $request->pcode;
        $product->product_type_id = $request->type;
        $product->brand_id = $request->brand;
        $product->name = $request->pname;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stocks = $request->stock;
        $product->tags = '{'.$request->tags.'}';;
        
        $product->save();
        
        //image uploading
        $url = url('/').'/images/product';
        
        $file_list = Input::file();
                
        foreach($file_list as $key => $value) 
        {
            if($request->hasFile($key)) 
            {
                $files = Input::file($key);
                $name = $files->getClientOriginalName();
                $extension = $files->getClientOriginalExtension();
                $size = getImageSize($files);
                $fileExts = array('jpg','jpeg','png','gif','bmp');

                $filePath = public_path().'/images/product/'.$product->product_id;
                $files->move($filePath, $name);             

                $image = [];
                $image['imagePath'] = $url.'/'.$product->product_id.'/'.$name;

                $product->$key = $image['imagePath'];                
            }           
        }
        
        $product->save();
        
        //IF THERE IS MULTIPLE PRODUCT DETAILS SAVE
        if(!empty($request->propertyName))
        {
            foreach($request->propertyName as $key => $pname)
            {   
                $detail = new ProductProperty();

                if($key == 0)
                {
                    continue;    
                }

                $detail->product_id = $product->product_id;
                $detail->name = $request->propertyName[$key];                     
                $detail->value = $request->propertyValue[$key]; 
                $detail->created_by = "ADMIN"; 

                $detail->save();            
            }    
        }
        
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::with('brand','producttype','property')
                          ->where('slug',$slug)
                          ->get();        
        
        return view('pages.shop.product.show',['product' => $product[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('property')
                          ->find($id);
                
        $brand = Brand::where('active',1)
                      ->where('deleted',0)
                      ->get()
                      ->lists("display_name",'brand_id');
        
        $type = ProductType::where('active',1)
                      ->where('deleted',0)
                      ->get()
                      ->lists("display_name",'product_type_id');
        
        
        return view('pages.shop.product.edit',['brand' => $brand,'type' => $type,'product' => $product]);
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
        $product = Product::find($id);
        
        $slug = Str::slug($request->pcode.' '.$request->pname);        
        
        //check if there is same slug
        $sameSlugCount = Product::where('product_id','!=',$id)
                                ->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
                
        if($sameSlugCount == 0)
        {
            $product->slug = $slug;
        }
        //if there is one or more slug with the same
        else
        {
            $finalSluggable = $request->pcode.' '.$request->pname.' '.$sameSlugCount;

            $product->slug = Str::slug($finalSluggable); 
        }        

        $product->product_code = $request->pcode;
        $product->product_type_id = $request->type;
        $product->brand_id = $request->brand;
        $product->name = $request->pname;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stocks = $request->stock;
        $product->tags = '{'.$request->tags.'}';
        $product->modified_date = date('Y-m-d H:i:s');
        $product->modified_by = "ADMIN";
        
        $product->save();
        
        //image uploading
        $url = url('/').'/images/product';
        
        $file_list = Input::file();
                
        foreach($file_list as $key => $value) 
        {
            if($request->hasFile($key)) 
            {
                $files = Input::file($key);
                $name = $files->getClientOriginalName();
                $extension = $files->getClientOriginalExtension();
                $size = getImageSize($files);
                $fileExts = array('jpg','jpeg','png','gif','bmp');

                $filePath = public_path().'/images/product/'.$product->product_id;
                $files->move($filePath, $name);             

                $image = [];
                $image['imagePath'] = $url.'/'.$product->product_id.'/'.$name;

                $product->$key = $image['imagePath'];                
            }           
        }
        
        $product->save();
        
        //--- delete all details related to product --- //
        $delProdProp = ProductProperty::where("product_id",$id)
                                      ->get();
        
        if(!empty($delProdProp))
        {
            ProductProperty::where("product_id",$id)
                           ->delete();
        }            
        
        // --- end delete --- //
        
        //IF THERE IS MULTIPLE PRODUCT DETAILS SAVE
        if(!empty($request->propertyName))
        {
            foreach($request->propertyName as $key => $pname)
            {   
                $detail = new ProductProperty();

                if($key == 0)
                {
                    continue;    
                }

                $detail->product_id = $product->product_id;
                $detail->name = $request->propertyName[$key];                     
                $detail->value = $request->propertyValue[$key]; 
                $detail->created_by = "ADMIN"; 

                $detail->save();            
            }    
        }
        
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
                
        $product->active = 0;
        $product->deleted = 1;
        $product->modified_date = date('Y-m-d H:i:s');
        $product->modified_by = "ADMIN";
        
        $product->save();
        
        return redirect()->route('product.index');
    }
}
