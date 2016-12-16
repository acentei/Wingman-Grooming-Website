@extends('layouts.master')

@section('title')
    Promo Codes
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Promo Codes
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
        <h1 class="h1-table-title"><b>Promo Codes List</b></h1>

        <a href="{{ route('promo-codes.create') }}" class="btn btn-success" role="button"> <span class="glyphicon glyphicon-plus"></span><b> New Promo Code </b></a>

        <a href="{{ url('show-generate') }}" class="btn btn-success" role="button"> <span class="glyphicon glyphicon-plus"></span><b> Generate for Subscribers</b></a>

        <br>
        <br>

        <h2 style="text-align:center;">DURATION BASED PROMOS</h2>
        <hr style="margin-top:-10px;border-top: 1px solid #000;">

        <table class="table table-striped">
            <thead>
                <tr>	
                    <th>CODE</th>                   
                    <th>DESCRIPTION</th>                                                      
                    <th>STATUS</th>                   
                    <th>ACTIONS</th>				
                </tr>
            </thead>

            <tbody>
                @foreach($duration as $promo) 
                    <tr>
                        <td>{{$promo->code}}</td>	                    
                        <td>{{$promo->description}}</td>
                        <td>    
                            
                            @if($promo->expiration_date != 0000-00-00)                        
                                @if( $promo->expiration_date >= date('Y-m-d') )
                                    <span style="color:#449d44;"><b>ONGOING</b></span>           
                                @else
                                    @if( $promo->start_date >= date('Y-m-d') )
                                        <span style="color:#ec971f;"><b>NOT YET STARTED</b></span>                            
                                    @elseif( $promo->expiration_date <= date('Y-m-d') )
                                        <span style="color:#c9302c;"><b>EXPIRED</b></span> 
                                    @endif
                                @endif  
                            @else
                                @if($promo->active != 0)
                                    <span style="color:#449d44;"><b>ACTIVE</b></span>
                                @else
                                    <span style="color:#c9302c;"><b>USED</b></span> 
                                @endif
                            @endif                                                              
                        </td>

                        <td class="td-action-area">                        
                            <a href="{{ route('promo-codes.edit', $promo->promo_id) }}" class="btn btn-warning" role="button"> <span class="glyphicon glyphicon-edit"></span> Edit</a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['promo-codes.destroy', $promo->promo_id],
                                'class' => 'form-action-area',
                            ]) !!}
				            
                            {!! Form::button('<span class="glyphicon glyphicon-trash"></span> <b>Delete</b>', 
                                array(  'id' => 'btnDel', 
                                        'class' => 'btn btn-danger',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#confirmDelete',
                                        'data-title' => 'Delete promo code: "'.$promo->code.'"',
                                        'data-message' => 'Are you sure you want to delete this promo code?',
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
        <br><br>

        <h2 style="text-align:center;">SUBSCRIBER BASED PROMOS</h2>
        <hr style="margin-top:-10px;border-top: 1px solid #000;">

        <table class="table table-striped">
            <thead>
                <tr>    
                    <th>CODE</th>                   
                    <th>DESCRIPTION</th>                                                      
                    <th>STATUS</th>                   
                    <th>ACTIONS</th>                
                </tr>
            </thead>

            <tbody>
                @foreach($subscriber as $promo) 
                    <tr>
                        <td>{{$promo->code}}</td>                       
                        <td>{{$promo->description}}</td>
                        <td>    
                            
                            @if($promo->expiration_date != 0000-00-00)                        
                                @if( $promo->expiration_date >= date('Y-m-d') )
                                    <span style="color:#449d44;"><b>ONGOING</b></span>           
                                @else
                                    @if( $promo->start_date >= date('Y-m-d') )
                                        <span style="color:#ec971f;"><b>NOT YET STARTED</b></span>                            
                                    @elseif( $promo->expiration_date <= date('Y-m-d') )
                                        <span style="color:#c9302c;"><b>EXPIRED</b></span> 
                                    @endif
                                @endif  
                            @else
                                @if($promo->active != 0)
                                    <span style="color:#449d44;"><b>ACTIVE</b></span>
                                @else
                                    <span style="color:#c9302c;"><b>USED</b></span> 
                                @endif
                            @endif                                                              
                        </td>

                        <td class="td-action-area">                        
                           {{--  <a href="{{ route('promo-codes.edit', $promo->promo_id) }}" class="btn btn-warning" role="button"> <span class="glyphicon glyphicon-edit"></span> Edit</a>
                           --}}

                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['promo-codes.destroy', $promo->promo_id],
                                'class' => 'form-action-area',
                            ]) !!} 
                            
                            {!! Form::button('<span class="glyphicon glyphicon-trash"></span> <b>Delete</b>', 
                                array(  'id' => 'btnDel', 
                                        'class' => 'btn btn-danger',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#confirmDelete',
                                        'data-title' => 'Delete promo code: "'.$promo->code.'"',
                                        'data-message' => 'Are you sure you want to delete this promo code?',
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
        <br><br>

        <h2 style="text-align:center;">SPECIAL PROMOS</h2>
        <hr style="margin-top:-10px;border-top: 1px solid #000;">

        <table class="table table-striped">
            <thead>
                <tr>    
                    <th>CODE</th>                   
                    <th>DESCRIPTION</th>                                                      
                    <th>STATUS</th>                   
                    <th>ACTIONS</th>                
                </tr>
            </thead>

            <tbody>
                @foreach($special as $promo) 
                    <tr>
                        <td>{{$promo->code}}</td>                       
                        <td>{{$promo->description}}</td>
                        <td>    
                            
                            @if($promo->expiration_date != 0000-00-00)                        
                                @if( $promo->expiration_date >= date('Y-m-d') )
                                    <span style="color:#449d44;"><b>ONGOING</b></span>           
                                @else
                                    @if( $promo->start_date >= date('Y-m-d') )
                                        <span style="color:#ec971f;"><b>NOT YET STARTED</b></span>                            
                                    @elseif( $promo->expiration_date <= date('Y-m-d') )
                                        <span style="color:#c9302c;"><b>EXPIRED</b></span> 
                                    @endif
                                @endif  
                            @else
                                @if($promo->active != 0)
                                    <span style="color:#449d44;"><b>ACTIVE</b></span>
                                @else
                                    <span style="color:#c9302c;"><b>USED</b></span> 
                                @endif
                            @endif                                                              
                        </td>

                        <td class="td-action-area">                        
                            <a href="{{ route('promo-codes.edit', $promo->promo_id) }}" class="btn btn-warning" role="button"> <span class="glyphicon glyphicon-edit"></span> Edit</a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['promo-codes.destroy', $promo->promo_id],
                                'class' => 'form-action-area',
                            ]) !!}
                            
                            {!! Form::button('<span class="glyphicon glyphicon-trash"></span> <b>Delete</b>', 
                                array(  'id' => 'btnDel', 
                                        'class' => 'btn btn-danger',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#confirmDelete',
                                        'data-title' => 'Delete promo code: "'.$promo->code.'"',
                                        'data-message' => 'Are you sure you want to delete this promo code?',
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