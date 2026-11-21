@extends('layouts.admin')

@section('title', 'Validation des publications · Pharmacie du Plateau')
@section('description', 'Cycle éditorial de sensibilisation : brouillon, soumis, validé, publié, dépublié ou archivé.')
@section('page', 'admin-publications')
@section('crumb', 'Validation des publications')
@section('heading', 'Validation des publications')
@section('lead', 'Cycle éditorial de sensibilisation : brouillon, soumis, validé, publié, dépublié ou archivé.')

@section('content')
@verbatim
<div class="notice notice-warning"><span class="notice-icon">i</span><p>Chaque publication exige validation par la pharmacie, dates de publication et de mise à jour et mention de prévention générale — ni diagnostic ni prescription.</p></div><div class="section-tight"><div class="section-heading"><div><span class="eyebrow">Workflow éditorial</span><h2 style="font-size:1.8rem">États d’une publication</h2></div></div><div class="card-grid four"><article class="surface-card"><span class="badge">Brouillon</span><p>Rédaction non publiée.</p></article><article class="surface-card"><span class="badge badge-pending">Soumis</span><p>À examiner par la pharmacienne.</p></article><article class="surface-card"><span class="badge badge-in-progress">Validé</span><p>Autorisé à publier.</p></article><article class="surface-card"><span class="badge badge-closed">Publié / dépublié / archivé</span><p>États de diffusion à historiser.</p></article></div></div><form class="form-panel" data-demo-form><h3>Proposer un changement · démo</h3><div class="field"><label for="publication-title">Titre</label><input id="publication-title" required></div><div class="field"><label for="publication-state">Transition demandée</label><select id="publication-state" required><option value="">Choisir un état</option><option>Brouillon → soumis</option><option>Soumis → validé</option><option>Validé → publié</option><option>Publié → dépublié</option><option>Publié → archivé</option></select></div><div class="field"><label for="publication-date">Date de publication / mise à jour</label><input id="publication-date" type="date"></div><button class="button" type="submit">Préparer · démo</button><p class="form-status" data-form-status role="status"></p></form>
@endverbatim
@endsection
