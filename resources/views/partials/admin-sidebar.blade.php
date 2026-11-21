@php
    /* Menu de gestion. La page active est reconnue à partir de l'URL (/admin.html, /admin-planning.html…). */
    $adminNav = [
        'Pilotage' => [
            ['admin.html', 'Tableau de bord', 'M4 20V10M10 20V4M16 20v-7M22 20H2'],
        ],
        'Contenus' => [
            ['admin-planning.html', 'Horaires & gardes', 'M3.5 10h17M8 3v4M16 3v4M5.5 5h13a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-13a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z'],
            ['admin-publications.html', 'Publications', 'M7 8h10M7 12h10M7 16h6M5 4h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z'],
            ['admin-catalogue.html', 'Miel & catalogue', 'M21 8 12 3 3 8v8l9 5 9-5V8ZM3 8l9 5 9-5M12 13v8'],
        ],
        'Accès et traçabilité' => [
            ['admin-comptes.html', 'Comptes professionnels', 'M9 11.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM2.5 20a6.5 6.5 0 0 1 13 0M16 4.5a3.5 3.5 0 0 1 0 7M18 14a6 6 0 0 1 3.5 6'],
            ['journal-actions.html', 'Journal d’actions', 'M3 12a9 9 0 1 0 3-6.7M3 4v4h4M12 8v4l3 2'],
        ],
    ];
@endphp
<aside class="adm-sidebar" id="adm-sidebar" aria-label="Navigation · Gestion">
  <a class="brand" href="index.html" aria-label="Pharmacie du Plateau, accueil du site">
    <span class="brand-mark" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M9 2.8h6v6.1h6.1v6.2H15v6.1H9v-6.1H2.9V8.9H9V2.8Z" fill="currentColor"/><path d="M17.8 4.5c1.9.2 2.8 1.1 3 3" stroke="#f58220" stroke-width="1.2" stroke-linecap="round"/></svg></span>
    <span class="brand-copy"><span class="brand-name">Pharmacie du Plateau</span><span class="brand-country">Gestion</span></span>
  </a>

  <div class="adm-role">
    <strong>[Prénom Nom] · Pharmacienne titulaire</strong>
    <span>Rôle non authentifié · démonstration</span>
  </div>

  <nav class="adm-nav" aria-label="Gestion">
    @foreach ($adminNav as $group => $links)
      <p class="adm-nav-group">{{ $group }}</p>
      @foreach ($links as [$href, $label, $icon])
        <a href="{{ $href }}" @if (request()->is($href)) aria-current="page" @endif>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="{{ $icon }}"/></svg>
          <span>{{ $label }}</span>
        </a>
      @endforeach
    @endforeach
  </nav>

  <div class="adm-sidebar-foot adm-nav">
    <a href="index.html">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m3 11 9-7 9 7M5 10v10h14V10"/></svg>
      <span>Site public</span>
    </a>
    <a href="connexion-pro.html">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M15 4h3a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-3M10 17l5-5-5-5M15 12H4"/></svg>
      <span>Se déconnecter · démo</span>
    </a>
  </div>
</aside>
