@extends('layouts.master')

@section('title')
    New Product
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	 New Product
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
    
    {!! Form::open([      
        'method' => 'POST',
        'action' => 'ProductController@store',
        'files' => 'true'
    ]) !!}
    <br>

    <div id="panel-style" class="panel panel-primary">
        <div id="panel-style-header" class="panel-heading">
            <h3 class="panel-title"><b>New Product</b></h3>
        </div>
        
        <div class="panel-body">
            <div class="form-horizontal">
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Product Code</label>    
                    <div class="col-sm-5">                              
                        <input type="text" name="pcode" class="form-control" maxlength = "255" required />
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Type</label>    
                    <div class="col-sm-3">                              
                        {!! Form::select('type', $type,0, ['id'=>'type','class' => 'form-control',
                                             'placeholder'=>'-- Select Type --', 'required']) !!}    
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Brand</label>    
                    <div class="col-sm-3">                              
                        {!! Form::select('brand', $brand,0, ['id'=>'brand','class' => 'form-control',
                                             'placeholder'=>'-- Select Brand --', 'required']) !!} 
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Main Photo</label>    
                    <div class="col-sm-3">   
                        <input type="file" class="imgInput" id="fileUpload" type="file" name="photo" required>
                        <img class="inputPreview" src="#" alt="your image" />
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Photo 2</label>    
                    <div class="col-sm-3">   
                        <input type="file" class="imgInput" id="fileUpload" type="file" name="photo_2">
                        <img class="inputPreview" src="#" alt="your image" />
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Photo 3</label>    
                    <div class="col-sm-3">   
                        <input type="file" class="imgInput" id="fileUpload" type="file" name="photo_3">
                        <img class="inputPreview" src="#" alt="your image" />
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Photo 4</label>    
                    <div class="col-sm-3">   
                        <input type="file" class="imgInput" id="fileUpload" type="file" name="photo_4">
                        <img class="inputPreview" src="#" alt="your image" />
                    </div>        
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Name</label>    
                    <div class="col-sm-10">                              
                        <input type="text" name="pname" class="form-control" maxlength = "255" required />
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Description</label>    
                    <div class="col-sm-10">                              
                        <textarea name="description" rows="5" class="form-control" style="resize:none;"></textarea>
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
                                <textarea id="detail_value" rows="1" style="resize:none;overflow:hidden;" name="propertyValue[]" class="form-control" onkeyup="textAreaAdjust(this)"></textarea>                                    
                            </div>
                                <br> 
                            <div>
                                {!! Form::button('<span class="glyphicon glyphicon-trash"></span>', array('id' => 'btnRemove' ,'type' => 'button', 'class' => 'btn btn-danger','onClick' => 'delDiv(this.id);')) !!}    
                            </div>
                        </div>                       
                        
                    </div>
                </div>
                
                <div class="form-group">                     
                    <label for="title" class="col-sm-2 control-label"></label> 
                    <div id="dynamicProperty" class="col-sm-10">    
                             
                    
                    </div>                    
                </div>
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Price</label> 
                    
                    <div class="col-sm-2" style="display: flex;">   
                        <b style="font-size: 15pt;padding-top: 5px;">Php</b>&nbsp;
                        <input type="number" name="price" class="form-control" placeholder="0" min="0" required />                     
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Stock Quantity</label>    
                    <div class="col-sm-2">                              
                        <input type="number" name="stock" class="form-control" placeholder="0" min="0" required />
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Tags</label>    
                    <div class="col-sm-10">                              
                        <textarea name="tags" rows="5" class="form-control" style="resize:none;"></textarea>
                    </div>       
                </div>
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label"></label>    
                    <div class="col-sm-10">                              
                        <input id="button" type="submit" value="Save" class="btn btn-success"/>
                        <a data-href="{{ route('product.index') }}"
                            class = "btn btn-danger" data-toggle = "modal" data-target = "#confirmCancel"
                            data-title = "Cancel Creation"  data-message = "Your changes will not be saved. Are you sure?"
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
        var propHash = 1;

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

            propHash = propHash + 1;
        }  

        function delDiv(id){  
            var propHash = propHash - 1;

            var divID = id.replace("btnRemove","div"); 
            var element = document.getElementById(divID);

            element.parentNode.removeChild(element);
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