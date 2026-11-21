@extends('layouts.app')

@section('title', 'Mon profil · Pharmacie du Plateau')
@section('description', 'Les champs de profil illustrent l’interface prévue. Aucune modification ne sera enregistrée.')

@section('content')
@verbatim
<main id="main-content" data-page="profil"><section class="page-hero"><div class="container"><div class="breadcrumbs"><a href="index.html" data-transition>Accueil</a><span aria-hidden="true">/</span><span>Espace client · démonstration</span></div><span class="eyebrow reveal">Espace client · démonstration</span><h1 class="display-title page-title" data-split-title>Mon profil</h1><p class="lead reveal">Les champs de profil illustrent l’interface prévue. Aucune modification ne sera enregistrée.</p></div></section><section class="section"><div class="narrow"><div class="notice notice-warning" style="margin-bottom:20px"><span class="notice-icon">i</span><p>Pas de compte réel, aucun profil prérempli. N’entrez pas d’informations personnelles réelles.</p></div><form class="form-panel" data-demo-form><div class="field-grid"><div class="field"><label for="profile-first">Prénom</label><input id="profile-first" autocomplete="given-name"></div><div class="field"><label for="profile-last">Nom</label><input id="profile-last" autocomplete="family-name"></div></div><div class="field"><label for="profile-phone">Téléphone</label><input id="profile-phone" type="tel" autocomplete="tel"></div><div class="field"><label for="profile-email">E-mail facultatif</label><input id="profile-email" type="email" autocomplete="email"></div><button class="button" type="submit">Enregistrer · démo</button><p class="form-status" data-form-status role="status"></p></form></div></section></main>
@endverbatim
@endsection
