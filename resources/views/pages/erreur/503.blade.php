@extends('layouts.app')

@section('title', '503 · Service temporairement indisponible | Pharmacie du Plateau')
@section('description', 'Le service est momentanément indisponible. Veuillez réessayer un peu plus tard.')

@section('content')
<main id="main-content" class="section">
    <div class="narrow" style="text-align:center">
        <span class="eyebrow">Erreur HTTP 503</span>
        <h1 class="display-title page-title">Service temporairement indisponible</h1>
        <p class="lead">Le service est momentanément indisponible. Veuillez réessayer un peu plus tard.</p>
        <a class="button" href="{{ url('/') }}">Retour à l’accueil</a>
    </div>
</main>
@endsection
