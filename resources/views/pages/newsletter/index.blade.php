@extends('layouts.master')

@section('title')
    Newsletter | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Newsletter
@endsection

@section('meta-description')
    Blogs, Articles, Newsletter
@endsection

@section('meta-image')
	
@endsection

{{-- STYLES AND SCRIPTS--}}
@section('styles')

@endsection

@section('scripts')
    
@endsection

@section('content')
    <div class="newsletter-container">
        <div class="newsletter-header">
            <div class="newsletter-header-left">
                <hr class="mobile-only">
                <div class="newsletter-title">Newsletter</div>
                
                <div class="newsletter-details">
                    <a href="{{ route('newsletter.index', ['category' => 'News'])}}">RECENT NEWS</a> 
                    <a href="{{ route('newsletter.index', ['category' => 'Blog'])}}">BLOG</a>
                    <a href="{{ route('newsletter.index', ['category' => 'Article'])}}">ARTICLES</a>
                </div>
                <hr class="mobile-only">
            </div> 

            {!! Form::open([      
                'method' => 'GET',
                'url' => 'newsletter'
            ]) !!}
                
                <div class="newsletter-header-right">
                    <div class="newsletter-search">
                        <div class="nl-search-border">
                                <input id="txtSearch" name="search" type="text" placeholder="Search Newsletter"> 
                            </span>              
                        </div>
                    </div> 
                </div>  
                
            {!! Form::close() !!}            
              
        </div>  
        
        <br><br>

        <!-- ADD VALIDATION OR MIDDLEWARE AUTH-->
        @if(Auth::user())
            <a href="{{ route('newsletter.create') }}" class="btn btn-success" role="button"> <span class="glyphicon glyphicon-plus"></span><b> New Newsletter </b></a>    
        @endif
        
        <div class="newsletter-body">
            
            @foreach($newsletter as $news)
                <div class="newsletter-img">   
                    <div class="newsletter-img-container">
                        <img src="{{$news->image}}" width="330" max-height="330">
                    </div>

                    <div class="hover-details">
                        <div class="nl-article-title">
                            <span>{{$news->title}}</span>
                        </div>

                        <div class="nl-article-date">
                            <span><i>{{ date('F d Y', strtotime($news->created_date)) }}</i></span>
                        </div>

                        <div class="nl-article-link">
                            <a href="{{ route('newsletter-show',[date('Y-m-d', strtotime($news->created_date)),$news->slug]) }}">- SEE ARTICLE -</a>
                        </div>
                    </div>             
                </div>     
            @endforeach          

            
        </div>

        <div class="custom-pagination">
            {!! $newsletter->render(new \Illuminate\Pagination\BootstrapThreePresenter($newsletter)) !!}
        </div>

            {{-- {{ $newsletter->appends(Request::input())->render() }} --}}
    </div>

@endsection