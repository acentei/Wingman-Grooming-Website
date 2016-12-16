@extends('layouts.master')

@section('title')
    {{$newsletter->title}} | Wingman Grooming
@endsection

{{--META TAGS--}}
@section('meta-url')
	{{Request::url()}}
@endsection

@section('meta-title')
	{{$newsletter->title}} | Wingman Grooming
@endsection

@section('meta-description')
    {{$newsletter->title}}
@endsection

@section('meta-image')
	{{$newsletter->image}}
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
                <div class="full-article-title">{{$newsletter->title}}</div>
                
                <div class="full-article-date">
                    {{ date('F d Y', strtotime($newsletter->created_date)) }}
                </div>
                <hr class="mobile-only">
            </div> 
            
            
        </div>
        
        <div class="newsletter-article-body">   
            
            <div class="full-article-left">
                @if(Auth::user())      
                    <div class="row-action">
                        <div class="btn-group pull-left">
                            <table>
                                <tr>
                                    <td>
                                        <a id="btnEdit" href="{{ route('newsletter.edit', $newsletter->newsletter_id) }}" class="btn btn-warning" role="button">
                                            <span id="editable" title="Edit" class="glyphicon glyphicon-edit"></span>
                                            <b>Edit</b>
                                        </a>
                                        
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['newsletter.destroy', $newsletter->newsletter_id],
                                            'class' => 'form-action-area',
                                        ]) !!}

                                        {!! Form::button('<span class="glyphicon glyphicon-trash"></span> <b>Delete</b>', 
                                            array(  'id' => 'btnDel', 
                                                'class' => 'btn btn-danger',
                                                'data-toggle' => 'modal',
                                                'data-target' => '#confirmDelete',
                                                'data-title' => 'Delete article: "'.$newsletter->title.'"',
                                                'data-message' => 'Are you sure you want to delete this article?',
                                                'data-btncancel' => 'btn-default',
                                                'data-btnaction' => 'btn-danger',
                                                'data-btntxt' => 'Confirm'
                                            )) 
                                        !!}

                                        {!! Form::close() !!}
                                    </td>                           

                                </tr>
                            </table>
                        </div>
                    </div>                
                <br>
                <br>
                @endif 
                
                <div class="full-article-image">
                    <img src="{{$newsletter->image}}" width="650px" height="800px">
                </div>

                 <div class="newsletter-full-article">
                                        
                    <div class="full-article-full-desc">
                        {!! $newsletter->body !!}
                    </div>
                    <br>
                    <hr>
                </div>
                
            </div>
            
            {{-- RECENT ARTICLES --}}
            <div class="full-article-right">
                <span>Recent Articles</span>
                
                @foreach($recent as $rec)
                    <div class="recent-article">
                        <div class="recent-article-title">
                            <a href="{{ route('newsletter-show',[date('Y-m-d', strtotime($rec->created_date)),$rec->slug]) }}">{{$rec->title}}</a>
                        </div>

                        <div class="recent-article-date">
                            {{ date('F d Y', strtotime($rec->created_date)) }}
                        </div>
                    </div>                
                @endforeach         
                
            </div>                
        </div>        
    </div>
    
    @include('modals.delete')
    
@endsection