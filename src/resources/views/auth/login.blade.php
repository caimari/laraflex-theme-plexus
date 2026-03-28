@extends('plexus::layouts.app')

@section('content')
<div style="height: 40px;"></div>


<div class="container">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

 </div>



<div class="page-content">

<div class="container">
  <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
      <form method="POST" action="{{ route('member.login') }}">
        @csrf
        <div class="form-group">
          <label for="email" class="control-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="password" class="control-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" id="remember" name="remember"> Remember me
          </label>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
        <div class="text-center">
          <p><a href="{{ route('password.reset') }}">Forgot password?</a> | <a href="{{ route('member.register') }}">Register</a></p>
        </div>
      </form>
    </div>
  </div>
</div>

</div>

<div style="height: 20px;"></div>
@endsection
