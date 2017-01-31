@extends('layouts.master')

@section('title')
    Edit Product - {{$product->name}}
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	 Edit Product - {{$product->name}}
@endsection

@section('meta-description')
    
@endsection

@section('meta-image')
	
@endsection

{{-- STYLES AND SCRIPTS--}}
@section('styles')

@endsection

@section('scripts')

@endsection

@section('content')
    
    {!! Form::model($product, [		
	    'method' => 'PUT',
        'route' => ['product.update', $product->product_id],
        'files' => 'true'
	]) !!}

    <br>

    <div id="panel-style" class="panel panel-primary">
        <div id="panel-style-header" class="panel-heading">
            <h3 class="panel-title"><b>Edit Product - {{$product->name}}</b></h3>
        </div>
        
        <div class="panel-body">
            <div class="form-horizontal">
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Product Code</label>    
                    <div class="col-sm-5">                              
                        <input type="text" name="pcode" value="{{$product->product_code}}" class="form-control" maxlength = "255" required />
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Type</label>    
                    <div class="col-sm-3">                              
                        {!! Form::select('type', $type,$product->product_type_id, ['id'=>'type','class' => 'form-control',
                                             'placeholder'=>'-- Select Type --', 'required']) !!}    
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Brand</label>    
                    <div class="col-sm-3">                              
                        {!! Form::select('brand', $brand,$product->brand_id, ['id'=>'brand','class' => 'form-control',
                                             'placeholder'=>'-- Select Brand --', 'required']) !!} 
                    </div>       
                </div>
                
                <div id="imgActive1" class="form-group">
                    <label for="title" class="col-sm-2 control-label">Main Photo</label>    
                    <div class="col-sm-10">                              
                        <img class="imagePreview" src="{{$product->photo}}" alt="{{$product->name}}'s main photo image" /><br><br>
                        <a class="btn btn-success" onClick="hideImgActive(1);">Change Image</a>
                    </div>
                </div>
                
                <div id="imgReplace1" class="form-group" style="display:none;">
                    <label for="title" class="col-sm-2 control-label">Main Photo</label>    
                    <div class="col-sm-3">   
                        <input type="file" class="imgInput" id="fileUpload" type="file" name="photo">
                        <img class="inputPreview" src="#" alt="your image" />
                    </div>
                </div>
                               
                <div id="imgActive2" class="form-group">
                    <label for="title" class="col-sm-2 control-label">Photo 2</label>    
                    <div class="col-sm-10">                              
                        <img class="imagePreview" src="{{$product->photo_2}}" alt="{{$product->name}}'s 2nd photo image" /><br><br>
                        <a class="btn btn-success" onClick="hideImgActive(2);">Change Image</a>
                    </div>
                </div>
                
                <div id="imgReplace2" class="form-group" style="display:none;">
                    <label for="title" class="col-sm-2 control-label">Photo 2</label>    
                    <div class="col-sm-3">   
                        <input type="file" class="imgInput" id="fileUpload" type="file" name="photo_2" >
                        <img class="inputPreview" src="#" alt="your image" />
                    </div>
                </div>
                
                <div id="imgActive3" class="form-group">
                    <label for="title" class="col-sm-2 control-label">Photo 3</label>    
                    <div class="col-sm-10">                              
                        <img class="imagePreview" src="{{$product->photo_3}}" alt="{{$product->name}}'s 3rd photo image" /><br><br>
                        <a class="btn btn-success" onClick="hideImgActive(3);">Change Image</a>
                    </div>
                </div>
                
                <div id="imgReplace3" class="form-group" style="display:none;">
                    <label for="title" class="col-sm-2 control-label">Photo 3</label>    
                    <div class="col-sm-3">   
                        <input type="file" class="imgInput" id="fileUpload" type="file" name="photo_3" >
                        <img class="inputPreview" src="#" alt="your image" />
                    </div>
                </div>
                
                <div id="imgActive4" class="form-group">
                    <label for="title" class="col-sm-2 control-label">Photo 4</label>    
                    <div class="col-sm-10">                              
                        <img class="imagePreview" src="{{$product->photo_4}}" alt="{{$product->name}}'s 4th photo image" /><br><br>
                        <a class="btn btn-success" onClick="hideImgActive(4);">Change Image</a>
                    </div>
                </div>
                
                <div id="imgReplace4" class="form-group" style="display:none;">
                    <label for="title" class="col-sm-2 control-label">Photo 4</label>    
                    <div class="col-sm-3">   
                        <input type="file" class="imgInput" id="fileUpload" type="file" name="photo_4" >
                        <img class="inputPreview" src="#" alt="your image" />
                    </div>
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Name</label>    
                    <div class="col-sm-10">                              
                        <input type="text" name="pname" value="{{$product->name}}" class="form-control" maxlength = "255" required />
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Description</label>    
                    <div class="col-sm-10">                              
                        <textarea name="description" rows="5" class="form-control" style="resize:none;">{{$product->description}}</textarea>
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
                    <div class="col-sm-10">
                        <a id="addProperty" class="btn btn-success" onClick="addProperty();"><span class="glyphicon glyphicon-plus"></span> Add Property</a>
                    </div>
                </div>
                
                <div class="form-group" style="display:none;">   
                    <div class="col-sm-10"> 
                        <div id="propDD" class="shop-dynamic">
                            
                            <label for="title" class="col-sm-2 control-label">Name</label>    
                            <div class="col-sm-10">                              
                                <input id="detail_name" type="text" name="propertyName[]" class="form-control" maxlength = "255" />
                            </div> 
                            <br>
                            <br>
                            
                            <label for="title" class="col-sm-2 control-label">Value</label>    
                            <div class="col-sm-10">                              
                                <input id="detail_value" type="text" name="propertyValue[]" class="form-control" />
                            </div>
                                <br>                       
                            {!! Form::button('<span class="glyphicon glyphicon-trash"></span>', array('id' => 'btnRemove' ,'type' => 'button', 'class' => 'btn btn-danger','onClick' => 'delDiv(this.id);')) !!}    
                           
                        </div>                       
                        
                    </div>
                </div>
                
                <div class="form-group">                     
                    <label for="title" class="col-sm-2 control-label"></label> 
                    <div id="dynamicProperty" class="col-sm-10">    
                        @foreach($product['property'] as $key => $detail)
                            <div id="divpropDD{{$key}}" class="shop-dynamic">
                                <label for="title" class="col-sm-2 control-label">Name</label>    
                                <div class="col-sm-10">                              
                                    <input id="detail_name" type="text" name="propertyName[]" value="{{$detail->name}}" class="form-control" maxlength = "255" />
                                </div> 
                                <br>
                                <br>

                                <label for="title" class="col-sm-2 control-label">Value</label>    
                                <div class="col-sm-10">   
                                    <textarea id="detail_value" rows="1" style="resize:none;overflow:hidden;" name="propertyValue[]" class="form-control" onfocus="textAreaAdjust(this)" >{{$detail->value}}</textarea>                                    
                                </div>
                                    <br>    
                                <div>
                                    {!! Form::button('<span class="glyphicon glyphicon-trash"></span>', array('id' => 'btnRemovepropDD'."$key" ,'type' => 'button', 'class' => 'btn btn-danger','onClick' => 'delDiv(this.id);')) !!}    
                                </div>
                            </div>
                        @endforeach                    
                    </div>                    
                </div>
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Price</label> 
                    
                    <div class="col-sm-2" style="display: flex;">   
                        <b style="font-size: 15pt;padding-top: 5px;">Php</b>&nbsp;
                        <input type="number" name="price" value="{{$product->price}}" class="form-control" placeholder="0" min="0" required />                     
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Stock Quantity</label>    
                    <div class="col-sm-2">                              
                        <input type="number" name="stock" value="{{$product->stocks}}" class="form-control" placeholder="0" min="0" required />
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Tags</label>    
                    <div class="col-sm-10">                              
                        <textarea name="tags" rows="5" class="form-control" style="resize:none;">{{$product->tags}}</textarea>
                    </div>       
                </div>
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label"></label>    
                    <div class="col-sm-10">                              
                        <input id="button" type="submit" value="Update" class="btn btn-success"/>                        
                        <a id="btnCancel" data-href="{{ route('product.index') }}" class="btn btn-danger"
                            class = "btn btn-danger" data-toggle = "modal" data-target = "#confirmCancel"
                            data-title = "Cancel editing: '{{$product->name}}'" data-message = "Your changes will not be saved. Are you sure?"
                            data-btncancel = "btn-default" data-btnaction = "btn-danger" data-btntxt = "Confirm">
                               
                            Cancel 
                        </a> 
                    </div>       
                </div>                
                
            </div>
        </div>
    </div>
    
    @include('modals.cancel')
    
    {!! Form::close() !!}
    
    <script type="text/javascript">
        
        //------------------ IMAGE PREVIEW -------------//
        function readURL() {
            var $input = $(this);      

            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

            if (extn == "png" || extn == "jpg" || extn == "jpeg") 
            {
                if (typeof (FileReader) != "undefined") 
                {            
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $input.next('.inputPreview').attr('src', e.target.result).show();
                            $(".imgPreview").hide();
                        }
                        reader.readAsDataURL(this.files[0]);                
                    }
                } 
                else 
                {
                    alert("This browser does not support FileReader.");
                }
            } 
            else
            {
                $input.next('.inputPreview').hide();
                $(this)[0].value = '';

                alert("Please select images only.");
            }
        }

        $(".imgInput").change(readURL);
        
        
        // ------- ADDING DYNAMIC PANEL  ----------- //                         
            
        var $ddTemp = $("#propDD");              
        var propHash = 1 + {{count($product['property'])}};

        function addProperty()
        {                                    
            var $newDD = $ddTemp.clone();       

            $newDD.attr("id","divpropDD"+propHash);
            $newDD.find(".btn.btn-danger")
                    .attr("id","btnRemovepropDD"+propHash);

            $newDD.find("#detail_name")
                    .attr("required","true");

            $newDD.find("#detail_value")
                    .attr("required","true");

            $("#dynamicProperty").append($newDD.fadeIn());
        }  

        function delDiv(id){    
            var propHash = propHash - 1;

            var divID = id.replace("btnRemove","div"); 
            var element = document.getElementById(divID);

            element.parentNode.removeChild(element);
        }
        
        
        // ------- HIDING PREVIEW TO CHANGE IMAGE -------- //
        
        function hideImgActive($id){    
            $("#imgActive"+$id).hide();
            $("#imgReplace"+$id).show();
        }
        
        // -------- AUTO ADJUST TEXTAREA FOR VALUE -------- //
        function textAreaAdjust(o) {            
            
            if((o.value.length) > 50)
            {
                o.style.height = "1px";
                o.style.height = (25+o.scrollHeight)+"px";
            }           
        }
        
    </script>

@endsection