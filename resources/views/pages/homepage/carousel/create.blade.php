@extends('layouts.master')

@section('title')
    New Carousel Item
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	 New Carousel Item
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
        'action' => 'CarouselController@store',
        'files' => 'true'
    ]) !!}
    <br>

    <div id="panel-style" class="panel panel-primary">
        <div id="panel-style-header" class="panel-heading">
            <h3 class="panel-title"><b>New Carousel Item</b></h3>
        </div>
        
        <div class="panel-body">
            <div class="form-horizontal">
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Title</label>    
                    <div class="col-sm-10">                              
                        <input type="text" name="title" class="form-control" maxlength = "255" />
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Photo</label>    
                    <div class="col-sm-3">   
                        <input type="file" class="imgInput" id="fileUpload" type="file" name="photo" required>
                        <img class="inputPreview" src="#" alt="your image" />
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Description</label>    
                    <div class="col-sm-10">      
                        <textarea name="description" rows="5" class="form-control" style="resize:none;"></textarea>                        
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Button Label</label>    
                    <div class="col-sm-10">                              
                        <input type="text" name="btn_lbl" class="form-control" maxlength = "255" />
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Link</label>    
                    <div class="col-sm-10">                              
                        <input type="text" name="link" class="form-control" maxlength = "255" />
                    </div>       
                </div>
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label"></label>    
                    <div class="col-sm-10">                              
                        <input id="button" type="submit" value="Save" class="btn btn-success"/>
                        <a data-href="{{ route('carousel.index') }}"
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

    </script>
    
    {!! Form::close() !!}

@endsection