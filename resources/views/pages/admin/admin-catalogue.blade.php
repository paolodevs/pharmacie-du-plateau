@extends('layouts.admin')

@section('title', 'Gestion du miel & catalogue · Pharmacie du Plateau')
@section('description', 'Modifier les contenus informatifs et les informations du miel sans connexion à un stock.')
@section('page', 'admin-catalogue')
@section('crumb', 'Gestion du miel & catalogue')
@section('heading', 'Gestion du miel & catalogue')
@section('lead', 'Modifier les contenus informatifs et les informations du miel sans connexion à un stock.')

@section('content')
@verbatim
<div class="notice notice-warning"><span class="notice-icon">i</span><p>Pas de connexion au logiciel métier ni de gestion de stock. Ne pas afficher de disponibilité garantie.</p></div><form class="form-panel" data-demo-form style="margin-top:20px"><h3>Informations du miel alimentaire · démo</h3><div class="field"><label for="honey-description">Description</label><textarea id="honey-description"></textarea></div><div class="field-grid"><div class="field"><label for="honey-format">Formats · à confirmer</label><input id="honey-format"></div><div class="field"><label for="honey-price">Prix · à confirmer</label><input id="honey-price" inputmode="decimal"></div></div><div class="field"><label for="honey-pickup">Modalités de retrait et paiement · à confirmer</label><input id="honey-pickup"></div><button class="button" type="submit">Enregistrer · démo</button><p class="form-status" data-form-status role="status"></p></form><div class="section-tight"><h3>Catégories du catalogue informatif</h3><div class="card-grid three"><article class="surface-card"><h3>Cosmétiques</h3><p>Aucune gestion de stock.</p></article><article class="surface-card"><h3>Consommables médicaux stériles</h3><p>Disponibilité à vérifier.</p></article><article class="surface-card"><h3>Consommables médicaux non stériles</h3><p>Disponibilité à vérifier.</p></article></div></div><div class="notice"><span class="notice-icon">i</span><p>Photos du vrai miel et emballages : à fournir et valider avant publication. Le miel reste un produit alimentaire, jamais un médicament.</p></div>
@endverbatim
@endsection
