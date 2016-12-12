@extends('layouts.master')

@section('title')
    Product Types
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Product Types
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
        <h1 class="h1-table-title"><b>Product Type List</b></h1>

        <a href="{{ route('product-type.create') }}" class="btn btn-success" role="button"> <span class="glyphicon glyphicon-plus"></span><b> New Product Type </b></a>

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
                @foreach($type as $type) 
                    <tr>
                        <td>{{$type->display_name}}</td>	                    
                        <td class="td-action-area">                        
                            <a href="{{ route('product-type.edit', $type->product_type_id) }}" class="btn btn-warning" role="button"> <span class="glyphicon glyphicon-edit"></span> Edit</a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['product-type.destroy', $type->product_type_id],
                                'class' => 'form-action-area',
                            ]) !!}
				            
                            {!! Form::button('<span class="glyphicon glyphicon-trash"></span> <b>Delete</b>', 
                                array(  'id' => 'btnDel', 
                                        'class' => 'btn btn-danger',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#confirmDelete',
                                        'data-title' => 'Delete product type: "'.$type->display_name.'"',
                                        'data-message' => 'Are you sure you want to delete this product type?',
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