<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Session;
use Cookie;

use App\Models\ProductType;
use App\Models\Brand;
use App\Models\Product;

class ShopController extends Controller
{
    /**
     *  
     */
    public function __construct()
    {  
        $this->dateNow = date('Y-m-d');    
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $isSearch = '';

        //return dynamic values
        $brand = Brand::where('active',1)
                      ->where('deleted',0)
                      ->orderBy('display_name','ASC')     
                      ->get();

        $brandList = Brand::where('active',1)
                      ->where('deleted',0)
                      ->orderBy('display_name','ASC')     
                      ->get()
                      ->lists("display_name",'brand_id');
        
        $type = ProductType::where('active',1)
                           ->where('deleted',0)
                           ->get();
        
        $product = Product::with('property')
                          ->where('active',1)
                          ->where('deleted',0)
                          ->get();       
        
        //-------------- SEARCH --------------//
        // $isSearch = "";
        // $isBrand = "";
        //$isCategory = "";
        
        $search = \Request::get('search');
        $reqBrand = \Request::get('brand');
        $reqType = \Request::get('category');
        $reqFilter = \Request::get('filter');
        
        $this->selectedType = ProductType::where('display_name',\Request::get('category'))
                                        ->where('active',1)
                                        ->where('deleted',0)
                                        ->get();     

        $this->selectedBrand = Brand::where('display_name',\Request::get('brand'))
                                   ->where('active',1)
                                   ->where('deleted',0)
                                   ->get();      
        
        if(!empty($search))
        {
            $isSearch = "true";
        }
        
        if(!empty($reqBrand))
        {
            $isBrand = "true";
            Session::put('brand_name', $reqBrand);            
        }
        else
        {
            setcookie('brand_class', '');
            setcookie('brand_id', '');
        }

        if(!empty($reqType))
        {
            $isCategory = "true";
            Session::put('type_name', $reqType);            
        }      
        else
        {
            setcookie('cat_class', '');
            setcookie('cat_id', '');
        }
        
        if(!empty($reqFilter))
        {
            $isFilter = "true";
            Session::put('filter', $reqFilter); 
            
            $filter = explode("-", \Request::get('filter'));
        
            $filterName = $filter[0];
            $filterAct = $filter[1];
        }
        else
        {
            $filterName = 'name';
            $filterAct = 'asc';
            
//            setcookie('brand_class', '');
//            setcookie('brand_id', '');
        }


        $product = Product::with('property','brand.product','brand.product.property') 
                          ->where(function($query) {
                                $query->where('name','LIKE','%'.\Request::get('search').'%')
                                      ->orWhere('description','LIKE','%'.\Request::get('search').'%')
                                      ->orWhere('tags','LIKE','%'.\Request::get('search').'%');
                            })  
                          ->whereHas('brand',function ($query) {
                                if(count($this->selectedBrand) != 0)
                                {
                                    $query->where('brand_id','=',$this->selectedBrand[0]->brand_id);
                                }                                
                            })
                          ->whereHas('producttype', function($query){   
                                if(count($this->selectedType) != 0)
                                {                            
                                    $query->where('product_type_id','=',$this->selectedType[0]->product_type_id);  
                                }   
                            })
                         
                          ->where('active',1)
                          ->where('deleted',0)     
                          ->orderBy($filterName,$filterAct)
                          ->paginate(12);        
                        
        return view('pages.shop.index',['brand' => $brand,'prodtype' => $type,'products' => $product,'now' => $this->dateNow, 
                                        'brandList' => $brandList,'isSearch' => $isSearch,'search' => $search] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($slug)
    {
        $product = Product::with('brand','brand.product','producttype','property')
                          ->where('slug',$slug)
                          ->first();     
        
        return view('pages.shop.productmobile',['product' => $product]);
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
