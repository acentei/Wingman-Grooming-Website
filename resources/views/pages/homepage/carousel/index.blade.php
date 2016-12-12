@extends('layouts.master')

@section('title')
    Carousel Items
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Carousel Items
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
        <h1 class="h1-table-title"><b>Carousel Item List</b></h1>

        <a href="{{ route('carousel.create') }}" class="btn btn-success" role="button"> <span class="glyphicon glyphicon-plus"></span><b> New Carousel Item </b></a>

        <br>
        <br>
        <div class="shop-products">
            
            @foreach($carousel as $caro)
                <div class="shop-product-container prod-list">
                    <div class="shop-product-image">
                        <img src="{{$caro->img}}" height="auto" width="100%" style="max-width:190px;">
                    </div>

                    <div class="shop-product-details">
                        <div class="prod-detail-name">
                            {{$caro->title}}
                        </div>
                    </div>
                    
                    <br>
                    
                    <a href="{{route('carousel.edit',$caro->carousel_id)}}" class="btn btn-warning" role="button"> <span class="glyphicon glyphicon-edit"></span><b> Edit</b></a>

                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['carousel.destroy', $caro->carousel_id],
                        'class' => 'form-action-area',
                    ]) !!}
                    
                    {!! Form::button('<span class="glyphicon glyphicon-trash"></span> <b>Delete</b>', 
                        array(  'id' => 'btnDel', 
                                'class' => 'btn btn-danger',
                                'data-toggle' => 'modal',
                                'data-target' => '#confirmDelete',
                                'data-title' => 'Delete carousel item: "'.$caro->title.'"',
                                'data-message' => 'Are you sure you want to delete this carousel item?',
                                'data-btncancel' => 'btn-default',
                                'data-btnaction' => 'btn-danger',
                                'data-btntxt' => 'Confirm'
                        )) 
                    !!}
                    
                    {!! Form::close() !!}
                </div>
            @endforeach
            
        </div>

        @include('modals.delete')

        <br>
    </div>
@endsection