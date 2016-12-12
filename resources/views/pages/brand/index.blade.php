@extends('layouts.master')

@section('title')
    Brands 
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Brands 
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
        <h1 class="h1-table-title"><b>Brand List</b></h1>

        <a href="{{ route('brand.create') }}" class="btn btn-success" role="button"> <span class="glyphicon glyphicon-plus"></span><b> New Brand </b></a>

        <br>
        <br>

        <table class="table table-striped">
            <thead>
                <tr>	
                    <th>NAME</th>                   
                    <th>ACTIONS</th>				
                </tr>
            </thead>

            <tbody>
                @foreach($brand as $brand) 
                    <tr>
                        <td>{{$brand->display_name}}</td>	                    
                        <td class="td-action-area">                        
                            <a href="{{ route('brand.edit', $brand->brand_id) }}" class="btn btn-warning" role="button"> <span class="glyphicon glyphicon-edit"></span> <b>Edit</b></a>

                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['brand.destroy', $brand->brand_id],
                                'class' => 'form-action-area',
                            ]) !!}

                            {!! Form::button('<span class="glyphicon glyphicon-trash"></span> <b>Delete</b>', 
                                array(  'id' => 'btnDel', 
                                        'class' => 'btn btn-danger',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#confirmDelete',
                                        'data-title' => 'Delete brand: "'.$brand->display_name.'"',
                                        'data-message' => 'Are you sure you want to delete this brand?',
                                        'data-btncancel' => 'btn-default',
                                        'data-btnaction' => 'btn-danger',
                                        'data-btntxt' => 'Confirm'
                                    )) 
                            !!}				                                        
				            
                            {!! Form::close() !!}
                            
                        </td> 
                        

                    </tr>
                @endforeach
            </tbody>
        </table>

        @include('modals.delete')

        <br>
    </div>
@endsection