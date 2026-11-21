@extends('layouts.app')

@section('title', 'Connexion professionnelle · Pharmacie du Plateau')
@section('description', 'Point d’entrée de démonstration. L’accès par rôle et l’authentification réelle ne sont pas configurés.')

@section('content')
@verbatim
<main id="main-content" data-page="connexion-pro"><section class="page-hero"><div class="container"><div class="breadcrumbs"><a href="index.html" data-transition>Accueil</a><span aria-hidden="true">/</span><span>Espace professionnel</span></div><span class="eyebrow reveal">Espace professionnel</span><h1 class="display-title page-title" data-split-title>Connexion professionnelle</h1><p class="lead reveal">Point d’entrée de démonstration. L’accès par rôle et l’authentification réelle ne sont pas configurés.</p></div></section><section class="section"><div class="narrow"><div class="notice notice-warning" style="margin-bottom:20px"><span class="notice-icon">i</span><p>Écran visuel uniquement : aucune protection par rôle n’est active. Ne saisissez pas d’identifiants réels.</p></div><form class="form-panel" data-demo-form><div class="field"><label for="pro-email">E-mail professionnel</label><input id="pro-email" type="email" autocomplete="username" required></div><div class="field"><label for="pro-password">Mot de passe</label><input id="pro-password" type="password" autocomplete="current-password" required></div><button class="button" type="submit">Continuer en démonstration</button><p class="form-status" data-form-status role="status"></p><p class="small muted" style="margin-top:15px"><a href="file-pro.html" data-transition>Ouvrir la file d’exemple</a> · page non protégée dans le prototype</p></form></div></section></main>
@endverbatim
@endsection
