@extends('layouts.master')

@section('title')
    Edit Promo Code - {{$promo->code}}
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	 Edit Promo Code - {{$promo->code}}
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
    
    {!! Form::model($promo, [		
	    'method' => 'PUT',
        'route' => ['promo-codes.update', $promo->promo_id],
	]) !!}
    <br>

    <div id="panel-style" class="panel panel-primary">
        <div id="panel-style-header" class="panel-heading">
            <h3 class="panel-title"><b>Edit Promo Code - {{$promo->code}}</b></h3>
        </div>
        
        <div class="panel-body">
            <div class="form-horizontal">
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Code</label>    
                    <div class="col-sm-4">                              
                        <input type="text" name="code" value="{{$promo->code}}" class="uppercase-text form-control" maxlength = "255" required />
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Description</label>    
                    <div class="col-sm-10">                              
                        <textarea rows="4" cols="50" name="description" class="no-expand-textarea form-control" required>{{$promo->description}}</textarea>                        
                    </div>       
                </div>
                
               <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Discount Type</label>    
                    <div class="col-sm-3">                              
                        <select id="selDiscount" class="form-control" name="discount_type" data-value="{{$promo->discount_type}}" data-discvalue="{{$promo->discount_value}}" required>
                            <option value="">-- SELECT TYPE --</option>
                            <option value="Percent">Percentage</option>
                            <option value="Amount">Amount</option>                            
                        </select>
                    </div>       
                </div>

                <div id="discPerc" class="form-group" style="display:none;">   
                    <label for="title" class="col-sm-2 control-label">Discount(Percent)</label>    
                    <div class="col-sm-2">                              
                        <input type="number" id="discount_percent" name="discount_percent" class="form-control" placeholder="0" min="1" max="100" />
                    </div>       
                </div>

                <div id="discAmt" class="form-group" style="display:none;">   
                    <label for="title" class="col-sm-2 control-label">Discount(Amount)</label>    
                    <div class="col-sm-2">                              
                        <input type="number" id="discount_amt" name="discount_amt" class="form-control" placeholder="0" min="1" max="99999" />
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">One Time Use</label>    
                    <div class="chkbox col-sm-1">
                        @if($promo->is_one_time_use == 1)                              
                            <input type="checkbox" name="oneTimeUse" value="1" checked>
                        @else
                            <input type="checkbox" name="oneTimeUse" value="1">
                        @endif
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Subscribers Only</label>    
                    <div class="chkbox col-sm-1">     
                        @if($promo->is_subscriber_only == 1)                         
                            <input type="checkbox" name="subscOnly" value="1" checked>
                        @else
                            <input type="checkbox" name="subscOnly" value="1">
                        @endif
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Start Date</label>    
                    <div class="col-sm-4">                              
                        <input type="text" id="datepicker" name="start_date" value="{{ date('F d, Y', strtotime($promo->start_date)) }}" class="form-control" maxlength = "255" required />
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Expiration Date</label>    
                    <div class="col-sm-4">                              
                        <input type="text" id="datepicker2" name="expiration_date" value="{{ date('F d, Y', strtotime($promo->expiration_date)) }}" class="form-control" maxlength = "255" required />
                    </div>       
                </div>
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label"></label>    
                    <div class="col-sm-10">                              
                        <input id="button" type="submit" value="Update" class="btn btn-success"/>
                        <a id="btnCancel" data-href="{{ route('promo-codes.index') }}" class="btn btn-danger"
                            class = "btn btn-danger" data-toggle = "modal" data-target = "#confirmCancel"
                            data-title = "Cancel editing: '{{$promo->code}}'" data-message = "Your changes will not be saved. Are you sure?"
                            data-btncancel = "btn-default" data-btnaction = "btn-danger" data-btntxt = "Confirm">
                               
                            Cancel 
                        </a> 
                    </div>       
                </div>      

                @include('modals.cancel')          
                
            </div>
        </div>
    </div>

    <script type="text/javascript"> 
        $( document ).ready(function() {            
            $( "#datepicker,#datepicker2" ).datepicker({   
                format: 'MM dd, yy',
                formatSubmit: 'MM dd, yy',
                
            }); 

            //set discount type value and details
            var perc = document.getElementById('discPerc');
            var amt = document.getElementById('discAmt');
            var sel = document.getElementById('selDiscount');
            var txtPerc = document.getElementById('discount_percent');
            var txtAmt = document.getElementById('discount_amt');
            var value = $("#selDiscount").attr("data-discvalue");            

            if($("#selDiscount").attr("data-value") == "Percent")
            {
                sel.value = "Percent";
                perc.style.display = "block";
                txtPerc.value = value;
            }
            else if($("#selDiscount").attr("data-value") == "Amount")
            {
                sel.value = "Amount";
                amt.style.display = "block";
                txtAmt.value = value;
            }

        }); 
    
        //display and undisplay of text box corresponding discount type
        $('#selDiscount').on('change', function() {
            var perc = document.getElementById('discPerc');
            var amt = document.getElementById('discAmt');

            if($(this).val() == "Percent")
            {
                perc.style.display = "block";
                amt.style.display = "none";
                amt.value = 0;
            }
            else if($(this).val() == "Amount")
            {
                amt.style.display = "block";
                perc.style.display = "none";
                perc.value = 0;
            }
            else
            {
                amt.style.display = "none";
                amt.value = 0;
                perc.style.display = "none";
                perc.value = 0;
            }
        });


    </script>
    
    {!! Form::close() !!}

@endsection