@extends('plexus::layouts.app')
@section('content')
   
                           
<div class="container">

@if ($homePageSetting->content_type == 'page')
    @if(isset($homePageSetting->content))
        @include('plexus::frontend.page', ['page' => $homePageSetting->content])
    @else
        <p>Error: Page not found.</p>
    @endif
@elseif ($homePageSetting->content_type == 'post')
    @if(isset($homePageSetting->content))
        @include('plexus::frontend.post', ['post' => $homePageSetting->content])
    @else
         <p>Error: Post not found.</p>
    @endif
@elseif ($homePageSetting->content_type == 'snippet')
    @if(isset($homePageSetting->content))
        @include('plexus::frontend.snippet', ['snippet' => $homePageSetting->content])
    @else
         <p>Error: Code snippet not found.</p>
    @endif
@else
   
<div style="height: 20px;"></div>
<div class="container">
    <div class="alert alert-warning" role="alert">
    There are no pages, posts or code snippets assigned on the front page to display.
    </div>
</div>

@endif

</div>
@endsection