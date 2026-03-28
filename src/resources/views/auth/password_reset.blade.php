@extends('plexus::layouts.app')

@section('content')

<div style="height: 20px;"></div>
<div class="page-content page-sidebar">

{!! session('error') !!}

<div class="container">
  <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
      <form method="POST" action="{{ route('accounts.password.reset.submit') }}">
        @csrf
        <div class="form-group">
          <label for="email" class="control-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Reset Password</button>
        </div>
        <div class="text-center mt-3">
          <a href="{{ route('accounts.login') }}">Back to Login</a>
        </div>
      </form>
    </div>
  </div>
</div>

</div>
@endsection
