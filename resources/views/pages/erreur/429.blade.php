@extends('layouts.app')

@section('title', '429 · Trop de requêtes | Pharmacie du Plateau')
@section('description', 'Vous avez effectué trop de requêtes en peu de temps. Veuillez patienter avant de réessayer.')

@section('content')
<main id="main-content" class="section">
    <div class="narrow" style="text-align:center">
        <span class="eyebrow">Erreur HTTP 429</span>
        <h1 class="display-title page-title">Trop de requêtes</h1>
        <p class="lead">Vous avez effectué trop de requêtes en peu de temps. Veuillez patienter avant de réessayer.</p>
        <a class="button" href="{{ url('/') }}">Retour à l’accueil</a>
    </div>
</main>
@endsection
