@extends('layouts.master')

@section('title')
    Wingman Grooming | Home
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	Wingman Grooming | Home
@endsection

@section('meta-description')
    Online retailer of Men's Grooming Products.
@endsection

@section('meta-image')
	
@endsection

{{-- STYLES AND SCRIPTS--}}
@section('styles')
    
@endsection

@section('scripts')

@endsection

@section('header')

    <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
    <!-- Indicators -->  
        <ol class="carousel-indicators">
            @foreach($carousel as $key => $caro)
                @if($key == 0)
                    <li data-target="#myCarousel" data-slide-to="{{$key}}" class="active"></li>
                @else
                    <li data-target="#myCarousel" data-slide-to="{{$key}}"></li>
                @endif                
            @endforeach
        </ol>

        <div class="carousel-inner">
            @foreach($carousel as $key => $caro)

                @if($key == 0)
                    <div class="item active"> 
                        <img src="{{$caro->img}}" alt="{{$caro->title}}">
                      
                        <div class="carousel-caption">
                            <h1><span>{{$caro->title}}</span></h1>
                            <p>{{$caro->description}}</p>

                            @if($caro->link)
                                <p><a class="btn wingman-btn" href="{{$caro->link}}" role="button">{{$caro->button_label}}</a></p>
                            @endif
                        </div>
                    </div>   
                @else
                    <div class="item"> 
                        <img src="{{$caro->img}}" alt="{{$caro->title}}">
                      
                        <div class="carousel-caption">
                            <h1><span>{{$caro->title}}</span></h1>
                            <p>{{$caro->description}}</p>
                            @if($caro->link)
                                <p><a class="btn wingman-btn" href="{{$caro->link}}" role="button">{{$caro->button_label}}</a></p>
                            @endif
                        </div>
                    </div>   
                @endif

            @endforeach   
        </div>

    </div> 

@endsection

@section('content')
    <div class="quotes">
        <div class="quotation">
            @if(Auth::user())       
                <div class="row welcome-note">
                    <div class="btn-group pull-right">
                        <table>
                            <tr>
                                <td>
                                    <a id="btnEdit" href="{{ route('welcome.edit',$welcome->about_id) }}" class="btn btn-warning" role="button">
                                        <span id="editable" title="Edit" class="glyphicon glyphicon-edit"></span>
                                    </a>
                                </td>                           

                            </tr>
                        </table>
                    </div>
                </div>    
            @endif

            <p>    
                <b>{{$welcome->welcome_note}}</b>
            </p>
        </div>    
    </div>
    
    <div class="hs-container">
        <div class="home-section hs-news">
            <div class="hs-title-underline">
                <span class="hs-title"><!---<img src="./images/nl-icon.png"> --> NEWSLETTER</span>
            </div>

            <div class="hs-supp-details">
                <a href="{{ route('newsletter.index', ['category' => 'News'])}}">RECENT NEWS</a> | 
                <a href="{{ route('newsletter.index', ['category' => 'Blog'])}}">BLOG</a> | 
                <a href="{{ route('newsletter.index', ['category' => 'Article'])}}">ARTICLES</a>
            </div>
            
            <div class="hs-nl-articles">
                
                @foreach($newsletter as $news)
                
                    <div class="nl-article-box">

                        <div class="nl-article-img">                            
                            <img src="{{$news->image}}">
                        </div>

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
                @endforeach                
                
            </div>
            
        </div>
    </div>    

    <div class="hs-container">
        <div class="home-section">
            <div class="hs-title-underline">
                <span class="hs-title"><!---<img src="./images/inst-icon.png"> --> INSTAGRAM</span>
            </div>

            <div class="hs-supp-details">
                <a target="_blank" href="https://www.instagram.com/wingman_grooming">@WINGMAN_GROOMING/</a>
            </div>

            <div class="hs-inst-gallery">           

                @for($i=0; $i < 5; $i++)
                    <div class="gallery-box">
                        <a target="_blank" href="{{ $instagram[$i]->link }}">
                            <img src="{{ $instagram[$i]->images->standard_resolution->url }}">      
                        </a>               
                    </div>    
                 @endfor  
            </div>
            <!--
            <div class="inst-link">
                <span>@WINGMAN_GROOMING</span>
            </div>
-->
            
        </div>
    </div>
@endsection