@extends('layouts.master')

@section('title')
    Product - {{$product->name}} 
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Product - {{$product->name}} 
@endsection

@section('meta-description')
    Product - {{$product->description}} 
@endsection

@section('meta-image')
	Product - {{$product->photo}} 
@endsection

{{-- STYLES AND SCRIPTS--}}
@section('styles')

@endsection

@section('scripts')

@endsection

@section('content')
    <br>

    <div id="panel-style" class="panel panel-primary">  
        
        <div class="panel-body">
            
            <div class="form-horizontal">  
                
                <div class="form-group">
                    
                    <div class="product-row-action">
                        <div class="btn-group pull-right">
                            <table>
                                <tr>
                                    <td>
                                        <a id="btnEdit" href="{{route('product.edit',$product->product_id)}}" class="btn btn-warning" role="button">
                                            <span id="editable" title="Edit" class="glyphicon glyphicon-edit"></span>
                                            <b>Edit</b>
                                        </a>

                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['product.destroy', $product->product_id],
                                            'class' => 'form-action-area',
                                        ]) !!}                                       

                                        {!! Form::button('<span class="glyphicon glyphicon-trash"></span> <b>Delete</b>', 
                                            array(  'id' => 'btnDel', 
                                                    'class' => 'btn btn-danger',
                                                    'data-toggle' => 'modal',
                                                    'data-target' => '#confirmDelete',
                                                    'data-title' => 'Delete product: "'.$product->name.'"',
                                                    'data-message' => 'Are you sure you want to delete this product?',
                                                    'data-btncancel' => 'btn-default',
                                                    'data-btnaction' => 'btn-danger',
                                                    'data-btntxt' => 'Confirm'
                                            )) 
                                        !!}

                                        {!! Form::close() !!}
                                    </td>                           

                                </tr>
                            </table>
                        </div>
                    </div>
                    
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Product Code</label>    
                    <div class="shop-show-col col-sm-5">                              
                        {{$product->product_code}}
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Type</label>    
                    <div class="shop-show-col col-sm-3">                              
                        {{$product['producttype']->display_name}}   
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Brand</label>    
                    <div class="shop-show-col col-sm-3">                              
                        {{$product['brand']->display_name}}   
                    </div>       
                </div>
                
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Main Photo</label>    
                    <div class="shop-show-col col-sm-10">                              
                        <img class="imagePreview" src="{{$product->photo}}" alt="{{$product->name}}'s main photo image" /><br><br>
                    </div>
                </div>                
                               
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Photo 2</label>    
                    <div class="col-sm-10">                              
                        <img class="imagePreview" src="{{$product->photo_2}}" alt="{{$product->name}}'s 2nd photo image" /><br><br>
                    </div>
                </div>
                                
                <div id="imgActive3" class="form-group">
                    <label for="title" class="col-sm-2 control-label">Photo 3</label>    
                    <div class="shop-show-col col-sm-10">                              
                        <img class="imagePreview" src="{{$product->photo_3}}" alt="{{$product->name}}'s 3rd photo image" /><br><br>
                    </div>
                </div>
                                
                <div id="imgActive4" class="form-group">
                    <label for="title" class="col-sm-2 control-label">Photo 4</label>    
                    <div class="shop-show-col col-sm-10">                              
                        <img class="imagePreview" src="{{$product->photo_4}}" alt="{{$product->name}}'s 4th photo image" /><br><br>
                    </div>
                </div>
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Name</label>    
                    <div class="shop-show-col col-sm-10">                              
                        {{$product->name}}
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Description</label>    
                    <div class="shop-show-col col-sm-10">                              
                        <pre class="prodshow-pre">{{$product->description}}</pre>
                    </div>       
                </div>
                                
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <h3 class="h3-title">Product Details</h3>
                        <hr class="hr-black">
                    </div>
                </div>
                
                <div class="form-group">                     
                    <label for="title" class="col-sm-2 control-label"></label> 
                    <div id="dynamicProperty" class="col-sm-10">    
                        @foreach($product['property'] as $key => $detail)
                            <div id="propDD" class="shop-dynamic">
                                <label for="title" class="col-sm-2 control-label">{{$detail->name}}</label>    
                                <div class="shop-show-col col-sm-10">                              
                                    <p>{{$detail->value}}</p>
                                </div>                                 
                                
                                <br>  
                            </div>  
                        @endforeach
                    </div>                    
                </div>
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Price</label> 
                    
                    <div class="shop-show-col col-sm-2" style="display: flex;">   
                        <b style="font-size: 15pt;">{{$product->price}}</b>&nbsp;
                       
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Stock Quantity</label>    
                    <div class="shop-show-col col-sm-2">                              
                        {{$product->stocks}}
                    </div>       
                </div>     

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Tags</label>    
                    <div class="shop-show-col col-sm-2">  

                        {{trim($product->tags,"{ }")}}
                    
                    </div>       
                </div>                        
                
            </div>
        </div>
    </div>

    @include('modals.delete')

@endsection