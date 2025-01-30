<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}"/>
    
    <title>Welcome - {{ config('app.name') }}</title>
    
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    @vite('resources/css/home.css')

</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">
  <div class="card text-center p-4 shadow rounded" style="max-width: 600px;">
        
    <div>
      <img src="{{ asset('img/logo_crm_2.png') }}" alt="Logo de {{ config('app.name') }}" style="max-width: 200px">
    </div>

    <p class="text-light mt-3">
      <strong>{{ config('app.name') }}</strong> is an open-source project designed to demonstrate the basic functionalities of a CRM system. Built with Laravel 10 and integrated with the AdminLTE 3 template, this system features basic authentication and an intuitive interface. This project is part of my professional portfolio as a freelance developer.
    </p>

    @if (Route::has('login') && Auth::check())
      <div class="mt-4">
        <a href="{{ route('dashboard.index') }}" class="btn btn-info btn-sm mr-2">
          <i class="fas fa-sign-in-alt"></i> GO TO DASHBOARD
        </a>
      </div>
    @elseif (Route::has('login') && !Auth::check())
      <div class="mt-4">
        <a href="{{ route('login') }}" class="btn btn-info btn-sm mr-2">
          <i class="fas fa-sign-in-alt"></i> SIGN IN
        </a>
        <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">
          <i class="fas fa-user-plus"></i> REGISTER
        </a>
      </div>
    @endif

    <footer class="mt-5 text-muted small">
      <p class="mb-1">Created by Vladimir Faundez H.</p>
      <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </footer>

  </div>
</body>
</html>
