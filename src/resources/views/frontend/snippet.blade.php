@extends('plexus::layouts.app')

@section('content')
@inject('route', 'Illuminate\Support\Facades\Route')
<div style="height: 20px;"></div>

{!! $snippet->content !!}

@endsection

