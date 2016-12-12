@extends('layouts.master')

@section('title')
    Newsletter Types
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Newsletter Types
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
    <div class="cms-table">
        <h1 class="h1-table-title"><b>Newsletter Type List</b></h1>

        <a href="{{ route('newsletter-type.create') }}" class="btn btn-success" role="button"> <span class="glyphicon glyphicon-plus"></span><b> New Newsletter Type </b></a>

        <br>
        <br>

        <table class="table table-striped">
            <thead>
                <tr>	
                    <th>TYPE</th>                   
                    <th>ACTIONS</th>				
                </tr>
            </thead>

            <tbody>
                @foreach($newsType as $type) 
                    <tr>
                        <td>{{$type->display_name}}</td>	                    
                        <td class="td-action-area">                        
                            <a href="{{ route('newsletter-type.edit', $type->newsletter_type_id) }}" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['newsletter-type.destroy', $type->newsletter_type_id],
                                'class' => 'form-action-area',
                            ]) !!}
				            
                            {!! Form::button('<span class="glyphicon glyphicon-trash"></span> Delete', array('type' => 'submit', 'class' => 'btn btn-danger')) !!}
				                
                            {!! Form::close() !!}
                            {{--
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['brand.destroy', $brand->brand_id],
                                'class' => 'form-action-area',
                            ]) !!}

                            {!! Form::button('<span class="glyphicon glyphicon-trash"></span> <b>Delete</b>', 
                                        array(  'class' => 'btn btn-danger',
                                                'data-btntxt' => 'Confirm'
                            )) !!}

                            {!! Form::close() !!}
                            --}}
                        </td> 
                        

                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>
    </div>
@endsection