@section('footer')
    <div class="footer-container">        
        <div class="footer-content">        
            <div class="ft-content">
                <div class="footer-column">
                    <div class="footer-column-section">
                        <div class="footer-column-each">
                            
                                <label class="lbl-large-bold underline">NEWSLETTER</label>
                                               

                            <label class="lbl-small">SUBSCRIBE TO OUR MAILING LIST</label>

                            {!! Form::open([      
                                'method' => 'POST',
                                'url' => 'subscribe'
                            ]) !!}

                            <div class="foot-subscribe">
                                <div class="ft-box">
                                    <input id="txtEmail" name="email" type="email" placeholder="YOUR E-MAIL" required>                                
                                </div>
                                <div class="ft-box ft-box-button">
                                    <input id="btnSubscribe" type="submit" value=" SUBSCRIBE">
                                </div>
                                
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <div class="footer-column">
                    <div class="footer-column-section">
                        <div class="footer-column-each ft-column-mid">
                             <label class="lbl-large-bold underline">NAVIGATION+</label>
                            <div class="foot-nav">
                                <ul>
                                    <li class="footer-column"><a href="{{route('faqs.index')}}">FAQS</a></li>
                                    <li class="footer-column"><a href="{{route('stockist.index')}}">STOCKISTS</a></li>
                                    <li class="footer-column"><a href="{{route('policy.index')}}">POLICY</a></li>                    
                                </ul>
                            </div> 
                        </div>                   
                    </div>
                </div>            

                <div class="footer-column ft-column-right">
                    <div class="footer-column-section">
                        <div class="footer-column-each">
                            <label class="lbl-large-bold underline">CONNECT+</label>

                            <label class="lbl-small">GET SOCIAL</label>
                            <div class="foot-social">
                                <ul>
                                    <li class="ft-img-social"><a id="facebook" target="_blank" href="https://www.facebook.com/wingmangrooming" title="Wingman Grooming on Facebook"><img src="{{ URL::asset('/images/facebook.png') }}"></a></li>
                                    <li class="ft-img-social"><a id="instagram" target="_blank" href="https://www.instagram.com/wingman_grooming" title="Wingman Grooming on Instagram"><img src="{{ URL::asset('/images/instagram.png') }}"></a></li>
                                    <li class="ft-img-social"><a id="twitter" target="_blank" href="#" title="Wingman Grooming on Twitter"><img src="{{ URL::asset('/images/twitter.png') }}"></a></li>                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>  
                
            </div>
            
             <div class="footer-copyright">                    
                <label>
                    © COPYRIGHT 2016 WINGMAN MERCATURA, INC. DESIGNED BY PINELIGHT STUDIOS.
                </label>                    
            </div>  
            {{-- 
            <div class="ft-btn">
                <a href="#"><img src="http://placehold.it/50x20"></a>
                <a href="#"><img src="http://placehold.it/50x20"></a>
                <a href="#"><img src="http://placehold.it/50x20"></a>
                <a href="#"><img src="http://placehold.it/50x20"></a>
                <a href="#"><img src="http://placehold.it/50x20"></a>
            </div> --}}
            
        </div>
    </div>

    <script>
        $('#txtEmail').focus(
            function()
            {
                $(this).parent('div').css('border-color','#fff');
            }).blur(            
                        function(){
                            $(this).parent('div').css('border-color','grey');
                        }
                    );
        
    </script>
@endsection