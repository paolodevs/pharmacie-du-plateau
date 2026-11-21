<!doctype html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#ffffff">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="@yield('description', 'Espace de gestion de la Pharmacie du Plateau (démonstration).')">
    <title>@yield('title', 'Gestion · Pharmacie du Plateau')</title>
    <link rel="icon" href="{{ asset('assets/favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/config.js') }}" defer></script>
    <script src="{{ asset('assets/js/core.js') }}" defer></script>
    <script src="{{ asset('assets/js/admin.js') }}" defer></script>
    @stack('page-scripts')
</head>
<body class="admin-body" data-page="@yield('page', 'admin')">

  <a class="skip-link" href="#main-content">Aller au contenu principal</a>

  <div class="adm-app" data-app>
    @include('partials.admin-sidebar')
    <div class="adm-scrim" data-app-scrim></div>

    <div class="adm-main">
      <div class="adm-demo" role="note">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9"/><path d="M12 11v5M12 8h.01"/></svg>
        <span class="adm-demo-long">Mode démonstration : aucune authentification, aucune donnée réelle, rien n’est envoyé ni enregistré.</span>
        <span class="adm-demo-short">Démonstration : rien n’est enregistré.</span>
      </div>

      <header class="adm-topbar">
        <button class="adm-icon-btn adm-menu-toggle" type="button" data-app-menu aria-expanded="false" aria-controls="adm-sidebar" aria-label="Ouvrir la navigation">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
        <nav class="adm-crumbs" aria-label="Fil d’Ariane">
          <a href="admin.html">Gestion</a>
          @hasSection('crumb')
            <span aria-hidden="true">/</span>
            <span aria-current="page">@yield('crumb')</span>
          @endif
        </nav>
        <div class="adm-topbar-actions">
          <a class="adm-link-site" href="index.html">Voir le site</a>
          <button class="theme-toggle" type="button" data-theme-toggle aria-label="Basculer le thème clair ou sombre" aria-pressed="false"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2m0 16v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M2 12h2m16 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42"/></svg></button>
          <span class="adm-avatar" aria-hidden="true">PH</span>
        </div>
      </header>

      <main class="adm-content" id="main-content">
        <div class="adm-head">
          <div>
            <h1>@yield('heading')</h1>
            @hasSection('lead')
              <p>@yield('lead')</p>
            @endif
          </div>
          @hasSection('badge')
            <span class="badge">@yield('badge')</span>
          @endif
        </div>

        @yield('content')
      </main>
    </div>
  </div>

  <div id="site-toast" class="site-toast" role="status" aria-live="polite" aria-atomic="true"></div>
</body>
</html>
