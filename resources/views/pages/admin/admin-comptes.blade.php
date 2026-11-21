@extends('layouts.admin')

@section('title', 'Comptes professionnels & rôles · Pharmacie du Plateau')
@section('description', 'Gestion des comptes professionnels, des rôles définis par la pharmacienne et de la désactivation rapide.')
@section('page', 'admin-comptes')
@section('crumb', 'Comptes professionnels & rôles')
@section('heading', 'Comptes professionnels & rôles')
@section('lead', 'Gestion des comptes professionnels, des rôles définis par la pharmacienne et de la désactivation rapide.')

@section('content')
@verbatim
<div class="notice notice-warning"><span class="notice-icon">i</span><p>Aucun accès par rôle n’est configuré dans le prototype. Les comptes et noms du personnel doivent être gérés côté serveur.</p></div><div class="table-toolbar"><h2 style="font-size:1.8rem">Comptes de démonstration</h2><span class="badge">Personnel : noms à confirmer</span></div><div class="data-table-wrap"><table class="data-table"><thead><tr><th>Compte</th><th>Rôle</th><th>État</th><th>Action prévue</th></tr></thead><tbody><tr><td>[personnel à confirmer]</td><td>Défini par la pharmacienne</td><td><span class="badge">Non connecté</span></td><td>Désactivation rapide · non active</td></tr></tbody></table></div><form class="form-panel" data-demo-form style="margin-top:22px"><h3>Préparer un changement · démo</h3><div class="field"><label for="staff-name">Nom professionnel</label><input id="staff-name" placeholder="[nom à confirmer]" required></div><div class="field"><label for="staff-role">Rôle</label><select id="staff-role" required><option value="">Rôle défini par la pharmacienne</option><option>Rôle autorisé · à configurer</option></select></div><div class="checkbox-row"><input id="staff-disable" type="checkbox"><label for="staff-disable">Préparer une désactivation rapide (non appliquée)</label></div><button class="button" type="submit">Valider · démo</button><p class="form-status" data-form-status role="status"></p></form>
@endverbatim
@endsection
