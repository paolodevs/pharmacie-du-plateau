@extends('layouts.app')

@section('title', 'Page introuvable · Pharmacie du Plateau')
@section('description', 'Page introuvable — Pharmacie du Plateau.')

@section('content')
@verbatim
<main id="main-content" data-page="not-found"><section class="page-hero"><div class="container"><div class="breadcrumbs"><a href="index.html" data-transition>Accueil</a><span aria-hidden="true">/</span><span>Erreur 404</span></div><span class="eyebrow reveal">Erreur 404</span><h1 class="display-title page-title" data-split-title>Page introuvable</h1><p class="lead reveal">Cette page n’existe pas ou son adresse a changé.</p></div></section><section class="section"><div class="narrow"><div class="glass-card"><span class="stat-value">404</span><h2>Reprenons le chemin</h2><p>La page recherchée n’a pas été trouvée. Vous pouvez revenir à l’accueil ou consulter les informations pratiques.</p><div class="button-row"><a class="button" href="index.html" data-transition>Retour à l’accueil</a><a class="button button-secondary" href="contact.html" data-transition>Contacter la pharmacie</a></div></div></div></section></main>
@endverbatim
@endsection
