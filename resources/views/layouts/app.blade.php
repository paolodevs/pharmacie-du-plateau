<!doctype html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="@yield('description', 'Pharmacie du Plateau au Bénin. Informations pratiques et ressources de prévention.')">
    <title>@yield('title', 'Pharmacie du Plateau')</title>
    <link rel="icon" href="{{ asset('assets/favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/config.js') }}" defer></script>
    <script src="{{ asset('assets/js/core.js') }}" defer></script>
    @stack('page-scripts')
</head>
<body>

  <a class="skip-link" href="#main-content">Aller au contenu principal</a>
  <div id="preloader" aria-hidden="true"><svg class="preloader-mark" viewBox="0 0 64 64" fill="none"><path d="M26 7h12v19h19v12H38v19H26V38H7V26h19V7Z" stroke="currentColor" stroke-width="3" stroke-linejoin="round"/></svg></div>
  <div id="page-curtain" aria-hidden="true"></div>
  
@include('partials.header')

@yield('content')

@include('partials.footer')

  <canvas id="ambient-canvas" aria-hidden="true"></canvas><span class="cursor-halo" aria-hidden="true"></span><span class="cursor-dot" aria-hidden="true"></span>
  <div id="site-toast" class="site-toast" role="status" aria-live="polite" aria-atomic="true"></div>
</body>
</html>
