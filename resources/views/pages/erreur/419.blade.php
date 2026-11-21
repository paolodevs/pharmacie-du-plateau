@extends('layouts.app')

@section('title', '419 · Session expirée | Pharmacie du Plateau')
@section('description', 'Votre session a expiré. Rechargez la page puis réessayez.')

@section('content')
<main id="main-content" class="section">
    <div class="narrow" style="text-align:center">
        <span class="eyebrow">Erreur HTTP 419</span>
        <h1 class="display-title page-title">Session expirée</h1>
        <p class="lead">Votre session a expiré. Rechargez la page puis réessayez.</p>
        <a class="button" href="{{ url('/') }}">Retour à l’accueil</a>
    </div>
</main>
@endsection
