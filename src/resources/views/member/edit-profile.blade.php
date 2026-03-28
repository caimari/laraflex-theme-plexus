@extends('plexus::layouts.app')

@section('content')

<script>
$(document).ready(function() {
    // Al cargar la página, ocultamos todos los tabs excepto el activo.
    $('.tab-pane').not('.active').hide();

    // Cuando se haga clic en un enlace del tab...
    $('#myTabs a').click(function(e) {
        e.preventDefault(); // Evita que el enlace cambie la URL.

        var tabId = $(this).attr('href'); // Obtiene el ID del tab a mostrar.

        // Ocultamos todos los tabs y eliminamos la clase 'active' de los enlaces del tab.
        $('.tab-pane').hide();
        $('#myTabs li').removeClass('active');

        // Muestra el tab correcto y agrega la clase 'active' al enlace del tab correcto.
        $(tabId).show();
        $(this).parent().addClass('active');
    });
});


</script>

<div style="height: 20px;"></div>

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


<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked" id="myTabs">
                <li class="active">
                    <a href="#profile" data-toggle="tab">Profile</a>
                </li>
                <li>
                    <a href="#password" data-toggle="tab">Password</a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="profile">
                    <!-- Tus formularios de perfil aquí -->
                    <form action="{{ route('member.profile.edit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="history">History</label>
                            <textarea class="form-control" id="history" name="history" rows="5">{{ $user->history }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                <div class="tab-pane" id="password">
                    <!-- Tus formularios de contraseña aquí -->
                    <form method="POST" action="{{ route('member.password.change') }}">
                        @csrf
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="height: 20px;"></div>




@endsection
