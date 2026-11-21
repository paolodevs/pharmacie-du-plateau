@extends('layouts.admin')

@section('title', 'Journal des actions importantes · Pharmacie du Plateau')
@section('description', 'Le journal métier réel devra conserver les actions importantes sans exposer de données sensibles.')
@section('page', 'journal-actions')
@section('crumb', 'Journal des actions importantes')
@section('heading', 'Journal des actions importantes')
@section('lead', 'Le journal métier réel devra conserver les actions importantes sans exposer de données sensibles.')

@section('content')
@verbatim
<div class="notice notice-danger"><span class="notice-icon">!</span><p>Ne jamais inclure d’information médicale ou personnelle dans les journaux, références ou URL. Aucun journal réel n’est connecté.</p></div><div class="table-toolbar"><h2 style="font-size:1.8rem">Événements fictifs</h2><span class="badge">Démonstration sans données client</span></div><div class="data-table-wrap"><table class="data-table"><caption class="visually-hidden">Événements génériques fictifs</caption><thead><tr><th>Quand</th><th>Catégorie</th><th>Action</th><th>État</th></tr></thead><tbody><tr><td>[date à confirmer]</td><td>Configuration</td><td>Exemple de mise à jour de planning</td><td><span class="badge">Démo</span></td></tr><tr><td>[date à confirmer]</td><td>Publication</td><td>Exemple de validation éditoriale</td><td><span class="badge">Démo</span></td></tr></tbody></table></div><p class="small muted" style="margin-top:14px">Dans le service réel, conserver auteur autorisé, date, action et résultat — jamais de donnée personnelle ou de santé dans le journal.</p>
@endverbatim
@endsection
