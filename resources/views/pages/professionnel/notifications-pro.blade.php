@extends('layouts.app')

@section('title', 'Notifications internes · Pharmacie du Plateau')
@section('description', 'Écran d’information sur les commandes, sans donnée personnelle ou médicale.')

@section('content')
@verbatim
<main id="main-content" data-page="notifications-pro"><section class="page-hero"><div class="container"><div class="breadcrumbs"><a href="index.html" data-transition>Accueil</a><span aria-hidden="true">/</span><span>Espace professionnel · démonstration</span></div><span class="eyebrow reveal">Espace professionnel · démonstration</span><h1 class="display-title page-title" data-split-title>Notifications internes</h1><p class="lead reveal">Écran d’information sur les commandes, sans donnée personnelle ou médicale.</p></div></section><section class="section"><div class="container"><div class="notice"><span class="notice-icon">i</span><p>Une notification interne de commande ne doit contenir aucune donnée personnelle ni médicale. La notification de démonstration ci-dessous n’est pas envoyée.</p></div><div class="card-grid two" style="margin-top:24px"><article class="surface-card"><span class="badge badge-new">Nouveau</span><h3 style="margin-top:17px">Commande de miel · exemple</h3><p>Une nouvelle demande de commande de produit alimentaire est à vérifier dans le service réel.</p><span class="small muted">Aucun nom, téléphone, détail médical ou référence de document.</span></article><article class="surface-card"><span class="badge badge-pending">En attente</span><h3 style="margin-top:17px">État de démonstration</h3><p>Aucune notification réelle chargée.</p></article></div></div></section></main>
@endverbatim
@endsection
