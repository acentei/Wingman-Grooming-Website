@extends('layouts.master')

@section('title')
    Edit Welcome Note
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Edit Welcome Note
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

    {!! Form::model($welcome, [
	    'method' => 'PUT',
	    'route' => ['welcome.update', $welcome->about_id],
	  ]) !!}
    
    <br>

    <div id="panel-style" class="panel panel-primary" style="width: 90%; margin: auto;">
        <div id="panel-style-header" class="panel-heading">
            <h3 class="panel-title"><b>Edit Welcome Note</b></h3>
        </div>
        
        <div class="panel-body">
            <div class="form-horizontal">
                
                <div class="form-group">                   
                    <div class="col-sm-12">                         
                        <textarea id="note" style="resize:none;" name="note" rows="10" class="form-control" placeholder="Write your note..">{{$welcome->welcome_note}}</textarea>
                    </div>                   
                </div> 
                                
                <div>
                    <input id="button" type="submit" name="publish" value="Update" class="btn btn-success"/>

                    <a id="btnCancel" data-href="{{ route('home.index') }}" class="btn btn-danger"
                          class = "btn btn-danger" data-toggle = "modal" data-target = "#confirmCancel"
                          data-title = "Cancel editing Welcome note?" data-message = "Your changes will not be saved. Are you sure?"
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

@endsection

