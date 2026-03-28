@extends('plexus::layouts.app')

@section('content')
<div style="height: 40px;"></div>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-default" style="border: none;">
            <!--    <div class="panel-heading text-left">{{ __('Reset Password') }}</div> -->

                <div class="panel-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('member.password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

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
                            <div class="text-left">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-left">
                <p><a href="{{ route('member.login') }}">Back to Login</a></p>
            </div>
        </div>
    </div>
</div>

<div style="height: 20px;"></div>

@endsection
