<!-- ########################### Initialize Modal Window for confirmation ########################-->
<div class="modal fade" id="addCartSuccess" tabindex="-1" role="dialog" aria-labelledby="confirmCancelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">            
            <div class="modal-body">
                <div class="modal-content-container">
                    <div class="modal-product-image-ac">
                        <img src="http://placehold.it/150x150" width="150" height="150">
                    </div>
                    <div class="modal-order-details">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  ADDED TO CART
                        
                        <div class="modal-order-table">
                            <table>
                                <thead>
                                    <td>ITEM</td>
                                    <td>QTY</td>
                                    <td>TOTAL</td>                                    
                                </thead>
                                
                                <tbody>
                                    <td id="name">Water Based Pomade</td>
                                    <td id="quantity" style="text-align: right;">x 1</td>
                                    <td id="price" style="text-align: right;">$18.00</td>
                                </tbody>
                            </table>
                        </div> 
                        
                    </div>
                    
                </div>
                
                <div class="modal-order-buttons">
                    <div class="modal-order-button-left">
                        <a href="#">Continue Shopping</a>
                    </div>

                    <div class="modal-order-button-right">
                        <a href="#">proceed to checkout</a>
                    </div>
                </div>
                
            </div> <!-- End Modal Body -->            
        </div> <!-- End Modal Content -->
    </div> <!-- End Modal Dialog -->
</div> <!-- End Modal -->


	<!-- Javascript functions to control modal data injection -->
<script type="text/javascript">
    $href = "";
    $checkOutHref = "";
    
    $('#addCartSuccess').on('show.bs.modal', function (e) {
      $image = $(e.relatedTarget).attr('data-image');
      $(this).find('.modal-product-image-ac img').attr('src',$image);

      $name = $(e.relatedTarget).attr('data-name');
      $(this).find('td#name').text($name);
        
      $quantity = $(e.relatedTarget).attr('data-quantity');
      $(this).find('td#quantity').text("x "+$quantity);
        
      $price = $(e.relatedTarget).attr('data-price');
      $(this).find('td#price').text("Php "+$price*$quantity); 

      $href = $(e.relatedTarget).attr('data-href');
      $checkOutHref = $(e.relatedTarget).attr('data-checkout');
    });

    //-- proceed to check out --//
    $('#addCartSuccess').find('.modal-order-button-right').on('click', function(e){ 
        //$(this).data('form').submit();  
        window.location.assign($checkOutHref);
    });

    //-- Form confirm (yes/ok) handler, submits form --//
    $('#addCartSuccess').find('.modal-order-button-left').on('click', function(e){ 
        //$(this).data('form').submit();  
        //window.open($href, '_self');            
        $('#addCartSuccess').modal('hide');
    });

</script>