@extends('layouts.master')

@section('title')
    New Promo Code
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	 New Promo Code
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
        'action' => 'PromoCodeController@store',
    ]) !!}
    <br>

    <div id="panel-style" class="panel panel-primary">
        <div id="panel-style-header" class="panel-heading">
            <h3 class="panel-title"><b>New Promo Code</b></h3>
        </div>
        
        <div class="panel-body">
            <div class="form-horizontal">
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Code</label>    
                    <div class="col-sm-4">                              
                        <input type="text" name="code" class="uppercase-text form-control" maxlength = "255" required />
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Description</label>    
                    <div class="col-sm-10">                              
                        <textarea rows="4" cols="50" name="description" class="no-expand-textarea form-control" required></textarea>                        
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Discount Type</label>    
                    <div class="col-sm-3">                              
                        <select id="selDiscount" class="form-control" name="discount_type" required>
                            <option value="" selected>-- SELECT TYPE --</option>
                            <option value="Percent">Percentage</option>
                            <option value="Amount">Amount</option>                            
                        </select>
                    </div>       
                </div>

                <div id="discPerc" class="form-group" style="display:none;">   
                    <label for="title" class="col-sm-2 control-label">Discount(Percent)</label>    
                    <div class="col-sm-2">                              
                        <input type="number" name="discount_percent" class="form-control" placeholder="0" min="1" max="100" />
                    </div>       
                </div>

                <div id="discAmt" class="form-group" style="display:none;">   
                    <label for="title" class="col-sm-2 control-label">Discount(Amount)</label>    
                    <div class="col-sm-2">                              
                        <input type="number" name="discount_amt" class="form-control" placeholder="0" min="1" max="99999" />
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">One Time Use</label>    
                    <div class="chkbox col-sm-1">                              
                        <input type="checkbox" name="oneTimeUse" value="1">
                    </div>       
                </div>

                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Subscribers Only</label>    
                    <div class="chkbox col-sm-1">                              
                        <input type="checkbox" name="subscOnly" value="1">
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Start Date</label>    
                    <div class="col-sm-4">                              
                        <input type="text" id="datepicker" name="start_date" class="form-control" maxlength = "255" />
                    </div>       
                </div>
                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label">Expiration Date</label>    
                    <div class="col-sm-4">                              
                        <input type="text" id="datepicker2" name="expiration_date" class="form-control" maxlength = "255" />
                    </div>       
                </div>
                                
                <div class="form-group">   
                    <label for="title" class="col-sm-2 control-label"></label>    
                    <div class="col-sm-10">                              
                        <input id="button" type="submit" value="Save" class="btn btn-success"/>
                        <a data-href="{{ route('promo-codes.index') }}"
                            class = "btn btn-danger" data-toggle = "modal" data-target = "#confirmCancel"
                            data-title = "Cancel Creation"  data-message = "Your changes will not be saved. Are you sure?"
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
        //date picker
        $( document ).ready(function() {
            $( "#datepicker,#datepicker2" ).datepicker({
                format: 'MM dd, yy',
                formatSubmit: 'MM dd, yy',
            }); 
        }); 

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