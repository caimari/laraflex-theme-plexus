@extends('plexus::layouts.app')

@section('content')

<div style="height: 40px;"></div>

@if (session('success'))
    <div class="alert alert-success mt-4">
        {{ session('success') }}
    </div>
@endif

@if (isset($url) && $errors->has('admin'))
    <div class="alert alert-danger mt-4">
        {{ $errors->first('admin') }}
    </div>
@endif
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="panel panel-default" style="border: none;">
                    <div class="panel-heading text-left">{{ isset($url) ? ucwords($url) : ""}} {{ __('Register') }}</div>

                    <div class="panel-body">
                        @isset($url)
                            <form method="POST" action='{{ route("$url.register") }}' aria-label="{{ __('Register') }}">
                        @else
                            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @endisset
                            @csrf

                            <div class="form-group">
                                <label for="name" class="control-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password" class="control-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="control-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            <div class="form-group">
                                <div class="text-left">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        </div>
                
                    </div>

                    <div class="text-left">
                            <p>Already registered? <a href="{{ route('member.login') }}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div style="height: 20px;"></div>

@endsection
