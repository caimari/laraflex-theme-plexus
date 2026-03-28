@extends('plexus::layouts.app')

@section('content')

<div style="height: 20px;"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    Hi there, awesome member
                    <p></p>
                    @auth('member')
                    If you see the one it means that you are logged in correctly: 
                    <p></p>
                    <h1>1</h1>
                    @endauth

                </div>
            </div>
        </div>
    </div>
</div>
@endsection