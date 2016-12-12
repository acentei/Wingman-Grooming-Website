@extends('layouts.master')

@section('title')
    Edit FAQS
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Edit FAQS
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

    {!! Form::model($faqs, [
	    'method' => 'PUT',
	    'route' => ['faqs.update', $faqs->about_id],
	]) !!}
    
    <br>

    <div id="panel-style" class="panel panel-primary" style="width: 90%; margin: auto;">
        <div id="panel-style-header" class="panel-heading">
            <h3 class="panel-title"><b>Edit FAQS</b></h3>
        </div>
        
        <div class="panel-body">
            <div class="form-horizontal">
                
                <div class="form-group">                   
                    <div class="col-sm-12">                         
                        <textarea id="faqs" name="faqs" rows="50" class="form-control" placeholder="Write your message..">{{$faqs->faqs}}</textarea>
                    </div>                   
                </div> 
                                
                <div>
                    <input id="button" type="submit" name="publish" value="Update" class="btn btn-success"/>
                    <a id="btnCancel" data-href="{{ route('faqs.index') }}" class="btn btn-danger"
                        class = "btn btn-danger" data-toggle = "modal" data-target = "#confirmCancel"
                        data-title = "Cancel editing Policy?" data-message = "Your changes will not be saved. Are you sure?"
                        data-btncancel = "btn-default" data-btnaction = "btn-danger" data-btntxt = "Confirm">
                           
                        Cancel 
                    </a>
            
                </div>              
                
            </div>
        </div>
    </div>    
    
    <br>

    @include('modals.cancel')

    {!! Form::close() !!}  

    <script type="text/javascript">
            
        // ------- TINY MCE, WYSIWYG TEXT EDITOR ----------- //
        tinymce.init({ selector:'textarea#faqs',                           
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
                            
                            var base_url = "http://localhost:8080/wingmangrooming/public";
                            //var base_url = window.location.hostname;

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
    </script>

@endsection

