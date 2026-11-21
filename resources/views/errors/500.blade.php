@extends('layouts.app')

@section('title', '500 · Erreur interne | Pharmacie du Plateau')
@section('description', 'Une erreur inattendue est survenue sur le serveur. Notre équipe pourra examiner le problème.')

@section('content')
<main id="main-content" class="section">
    <div class="narrow" style="text-align:center">
        <span class="eyebrow">Erreur HTTP 500</span>
        <h1 class="display-title page-title">Erreur interne</h1>
        <p class="lead">Une erreur inattendue est survenue sur le serveur. Notre équipe pourra examiner le problème.</p>
        <a class="button" href="{{ url('/') }}">Retour à l’accueil</a>
    </div>
</main>
@endsection
