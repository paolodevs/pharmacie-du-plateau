@extends('layouts.app')

@section('title', 'Connexion client · Pharmacie du Plateau')
@section('description', 'Écran de connexion présenté à titre de prototype. L’authentification réelle n’est pas activée.')

@section('content')
@verbatim
<main id="main-content" data-page="connexion"><section class="page-hero"><div class="container"><div class="breadcrumbs"><a href="index.html" data-transition>Accueil</a><span aria-hidden="true">/</span><span>Espace client</span></div><span class="eyebrow reveal">Espace client</span><h1 class="display-title page-title" data-split-title>Connexion client</h1><p class="lead reveal">Écran de connexion présenté à titre de prototype. L’authentification réelle n’est pas activée.</p></div></section><section class="section"><div class="narrow"><div class="notice notice-warning" style="margin-bottom:22px"><span class="notice-icon" aria-hidden="true">i</span><p>Aucune authentification n’est active. N’entrez pas vos identifiants réels.</p></div><form class="form-panel" data-demo-form><div class="field"><label for="login-identity">Téléphone ou e-mail</label><input id="login-identity" name="identity" autocomplete="username" required></div><div class="field"><label for="login-password">Mot de passe</label><input id="login-password" name="password" type="password" autocomplete="current-password" required></div><button class="button" type="submit">Continuer en démonstration</button><p class="form-status" data-form-status role="status"></p><div class="button-row" style="margin-top:15px"><a href="inscription.html" data-transition>Créer un compte</a><a href="reinitialisation.html" data-transition>Mot de passe oublié ?</a></div></form></div></section></main>
@endverbatim
@endsection
