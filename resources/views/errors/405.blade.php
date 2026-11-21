@extends('layouts.app')

@section('title', '405 · Méthode non autorisée | Pharmacie du Plateau')
@section('description', 'La méthode utilisée pour accéder à cette page n’est pas autorisée.')

@section('content')
<main id="main-content" class="section">
    <div class="narrow" style="text-align:center">
        <span class="eyebrow">Erreur HTTP 405</span>
        <h1 class="display-title page-title">Méthode non autorisée</h1>
        <p class="lead">La méthode utilisée pour accéder à cette page n’est pas autorisée.</p>
        <a class="button" href="{{ url('/') }}">Retour à l’accueil</a>
    </div>
</main>
@endsection
