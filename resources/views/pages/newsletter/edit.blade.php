@extends('layouts.master')

@section('title')
    Edit Newsletter - {{$newsletter->title}}
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	 Edit Newsletter - {{$newsletter->title}}
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
    
    {!! Form::model($newsletter, [		
	    'method' => 'PUT',
        'route' => ['newsletter.update', $newsletter->newsletter_id],
        'files' => 'true'
	]) !!}
    <br>

    <div id="panel-style" class="panel panel-primary">
        <div id="panel-style-header" class="panel-heading">
            <h3 class="panel-title"><b>Edit Newsletter - {{$newsletter->title}}</b></h3>
        </div>
        
        <div class="panel-body">
            <div class="form-horizontal">
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Title</label>    
                    <div class="col-sm-10">                              
                        <input type="text" name="title" value="{{$newsletter->title}}" class="form-control" maxlength = "255" required />
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Type</label>    
                    <div class="col-sm-3">                              
                         {!! Form::select('newsletterType', $newsType,$newsletter->newsletter_type_id, ['id'=>'newsletterType','class' => 'form-control',
                                             'placeholder'=>'-- Select Type --', 'required']) !!}             
                    </div>       
                </div>
                
                <div class="form-group imgPreview">   
                    <label for="title" class="col-sm-2 control-label">Image Preview</label>
                    
                    <div class="col-sm-3">
                        <img class="imagePreview" src="{{$newsletter->image}}" alt="{{$newsletter->title}}'s cover image" />
                    </div>
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Replacement Image</label>    
                            
                    <div class="col-sm-3">   
                        <input type="file" class="imgInput" id="fileUpload" type="file" name="img_newsletter">
                        <img class="inputPreview" src="#" alt="your image" />
                    </div> 
                </div>
                
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Body</label> 
                    <div class="col-sm-10">                         
                        <textarea id="body" name="body" rows="50" class="form-control ckeditor" placeholder="Write your message..">{{$newsletter->body}}</textarea>
                    </div>                   
                </div>  
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label"></label>    
                    <div class="col-sm-10">                              
                        <input id="button" type="submit" value="Update" class="btn btn-success"/>                        
                        <a id="btnCancel" data-href="{{ route('newsletter.index') }}" class="btn btn-danger"
                            class = "btn btn-danger" data-toggle = "modal" data-target = "#confirmCancel"
                            data-title = "Cancel editing: '{{$newsletter->title}}'" data-message = "Your changes will not be saved. Are you sure?"
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
            
            // ------- TINY MCE, WYSIWYG TEXT EDITOR ----------- //
            tinymce.init({ selector:'textarea#body',                           
                           theme: 'modern',
                           plugins: [
                                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                                'searchreplace wordcount visualblocks visualchars code fullscreen',
                                'insertdatetime media nonbreaking save table contextmenu directionality',
                                'emoticons template paste textcolor colorpicker textpattern imagetools'
                           ],
                           toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                           toolbar2: 'print preview media | forecolor backcolor emoticons | fontselect |  fontsizeselect',
                           image_advtab: true,
                           templates: [
                                 { title: 'Test template 1', content: 'Test 1' },
                                 { title: 'Test template 2', content: 'Test 2' }
                           ],
                           content_css: [
                                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                                '//www.tinymce.com/css/codepen.min.css',  
                                '{{ URL::asset('/css/tinymce-custom.css') }}',
                           ],   
                           forced_root_block : 'div',
                           fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
                           file_browser_callback: function(field_name, url, type, win){
                               
                                var x = window.innerWidth || document.documentElement.clientWidth;
                                var y = window.innerHeight || document.documentElement.clientHeight;
                                
                                //var base_url = "http://localhost:8080/wingmangrooming/public";
                                var base_url = window.location.origin;

                                var cmsURL = base_url+'/filemanager/show?&field_name='+field_name+'&lang='+tinymce.settings.language;

                                if(type == 'image') {           
                                    cmsURL = cmsURL + "&type=images";
                                }
                               
                                tinyMCE.activeEditor.windowManager.open({
                                    file: cmsURL,
                                    title: 'File Manager',
                                    width: x * 0.8,
                                    height: y * 0.8,
                                    resizable: "yes",
                                    close_previous: "no"
                                });
                           }
                                                
                           
                         });
        
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

@endsection