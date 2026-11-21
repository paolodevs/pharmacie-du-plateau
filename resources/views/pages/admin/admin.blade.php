@extends('layouts.admin')

@section('title', 'Tableau de bord · Gestion · Pharmacie du Plateau')
@section('description', 'Tableau de bord de gestion : état affiché sur le site, demandes et gardes. Aucune donnée personnelle n’est exposée.')
@section('page', 'admin')
@section('heading', 'Bonjour, [Prénom]')
@section('lead', 'Tableau de bord de gestion : état affiché sur le site, demandes et gardes. Aucune donnée personnelle n’est exposée.')
@section('badge', 'Chiffres de démonstration')

@section('content')
@verbatim
<section class="adm-state" data-state-card data-state="open" aria-labelledby="state-title">
  <div class="adm-state-sign" aria-hidden="true">
    <span class="adm-state-ring"></span>
    <svg viewBox="0 0 24 24" fill="none"><path d="M9 2.8h6v6.1h6.1v6.2H15v6.1H9v-6.1H2.9V8.9H9V2.8Z" fill="currentColor"/></svg>
  </div>
  <div class="adm-state-body">
    <h2 id="state-title">État affiché sur le site</h2>
    <p class="adm-state-now">Affiché aux visiteurs : <strong data-state-now>Ouverte</strong></p>
    <fieldset class="adm-state-options">
      <legend class="visually-hidden">Choisir l’état à afficher</legend>
      <input type="radio" name="site-state" id="st-open" value="open" checked>
      <label for="st-open">Ouverte</label>
      <input type="radio" name="site-state" id="st-duty" value="duty">
      <label for="st-duty">De garde</label>
      <input type="radio" name="site-state" id="st-closed" value="closed">
      <label for="st-closed">Fermée</label>
    </fieldset>
    <button class="button" type="button" data-state-publish>Publier sur le site · démo</button>
    <p class="adm-note">Dans le service prévu, l’état serait calculé depuis le planning et pourrait être forcé ici. Rien n’est publié dans ce prototype.</p>
  </div>
</section>

<div class="adm-kpis">
  <div class="adm-kpi">
    <span class="adm-kpi-label"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 13h4l2 3h4l2-3h4M4 13V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v7M4 13v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5"/></svg>Demandes en attente</span>
    <span class="adm-kpi-number" data-count-up="3">3</span>
    <span class="adm-kpi-caption">Exemple fictif</span>
  </div>
  <div class="adm-kpi">
    <span class="adm-kpi-label"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M6 7h12l-1 12H7L6 7ZM9 7a3 3 0 0 1 6 0"/></svg>Commandes reçues cette semaine</span>
    <span class="adm-kpi-number" data-count-up="14">14</span>
    <span class="adm-kpi-caption">Exemple fictif</span>
  </div>
  <div class="adm-kpi">
    <span class="adm-kpi-label"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M21 12a8 8 0 0 1-11.6 7.1L4 20l1-4.6A8 8 0 1 1 21 12Z"/></svg>Conversations traitées</span>
    <span class="adm-kpi-number" data-count-up="11">11</span>
    <span class="adm-kpi-caption">Exemple fictif</span>
  </div>
  <div class="adm-kpi">
    <span class="adm-kpi-label"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>Délai moyen de réponse (h)</span>
    <span class="adm-kpi-number" data-count-up="2">2</span>
    <span class="adm-kpi-caption">Exemple fictif</span>
  </div>
</div>

<div class="adm-grid">
  <section class="adm-card" aria-labelledby="recent-title">
    <div class="adm-card-head">
      <h2 id="recent-title">Demandes récentes</h2>
      <span class="adm-count" data-result-count="#admin-requests" aria-live="polite">5 éléments</span>
    </div>
    <div class="adm-toolbar" role="search" aria-label="Filtrer les demandes">
      <select class="filter-control" data-filter-control data-filter-target="#admin-requests" data-filter-key="state" aria-label="Filtrer par statut">
        <option value="">Tous les statuts</option>
        <option value="pending">En attente</option>
        <option value="info">Info demandée</option>
        <option value="answered">Réponse envoyée</option>
        <option value="closed">Clôturée</option>
      </select>
      <select class="filter-control" data-filter-control data-filter-target="#admin-requests" data-filter-key="type" aria-label="Filtrer par type">
        <option value="">Tous les types</option>
        <option value="order">Commande</option>
        <option value="message">Message</option>
        <option value="question">Question en privé</option>
      </select>
    </div>
    <div class="data-table-wrap">
      <table class="data-table adm-stacked" id="admin-requests">
        <caption class="visually-hidden">Demandes récentes fictives</caption>
        <thead>
          <tr><th scope="col">Référence</th><th scope="col">Type</th><th scope="col">Reçue</th><th scope="col">Statut</th></tr>
        </thead>
        <tbody>
          <tr data-filter-item data-state="pending" data-type="order"><td data-label="Référence" class="adm-ref">EXEMPLE-7KQ</td><td data-label="Type">Commande</td><td data-label="Reçue">11h42</td><td data-label="Statut"><span class="badge badge-pending">En attente</span></td></tr>
          <tr data-filter-item data-state="pending" data-type="question"><td data-label="Référence" class="adm-ref">EXEMPLE-Q3D</td><td data-label="Type">Question en privé</td><td data-label="Reçue">10h05</td><td data-label="Statut"><span class="badge badge-pending">En attente</span></td></tr>
          <tr data-filter-item data-state="info" data-type="message"><td data-label="Référence" class="adm-ref">EXEMPLE-H8N</td><td data-label="Type">Message</td><td data-label="Reçue">Hier</td><td data-label="Statut"><span class="badge badge-in-progress">Info demandée</span></td></tr>
          <tr data-filter-item data-state="answered" data-type="order"><td data-label="Référence" class="adm-ref">EXEMPLE-4TR</td><td data-label="Type">Commande</td><td data-label="Reçue">Hier</td><td data-label="Statut"><span class="badge badge-new">Réponse envoyée</span></td></tr>
          <tr data-filter-item data-state="closed" data-type="message"><td data-label="Référence" class="adm-ref">EXEMPLE-ZP6</td><td data-label="Type">Message</td><td data-label="Reçue">9 nov.</td><td data-label="Statut"><span class="badge badge-closed">Clôturée</span></td></tr>
          <tr class="adm-empty-row" data-filter-empty hidden>
            <td colspan="4">
              <div class="adm-empty">
                <strong>Aucune demande ne correspond</strong>
                <p>Changez le statut ou le type choisi.</p>
                <button class="button button-secondary button-small" type="button" data-filter-reset="#admin-requests">Effacer les filtres</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <p class="adm-foot"><span>Le contenu d’un message ne s’afficherait qu’à l’ouverture de la demande.</span><span>Références d’exemple</span></p>
  </section>

  <aside class="adm-side">
    <section class="adm-card" aria-labelledby="duty-title">
      <div class="adm-card-head"><h2 id="duty-title">Prochaines gardes</h2></div>
      <ul class="adm-duty" data-duty-list>
        <li><strong>[date à confirmer]</strong>Aucune garde publiée</li>
      </ul>
      <a class="adm-add" href="admin-planning.html">Ajouter une garde ou une fermeture</a>
    </section>

    <section class="adm-card" aria-labelledby="log-mini">
      <div class="adm-card-head">
        <h2 id="log-mini">Dernières actions</h2>
        <a class="adm-arrow" href="journal-actions.html">Journal <span aria-hidden="true">→</span></a>
      </div>
      <ul class="adm-minilog">
        <li><span>[date à confirmer]</span> Exemple de réponse à une demande</li>
        <li><span>[date à confirmer]</span> Exemple de modification d’horaires</li>
        <li><span>[date à confirmer]</span> Exemple d’ajout de garde</li>
      </ul>
    </section>

    <section class="adm-card" aria-labelledby="load-title">
      <div class="adm-card-head"><h2 id="load-title">Aperçu de chargement</h2></div>
      <button class="button button-secondary button-small" type="button" data-skeleton-toggle="#admin-skeleton" aria-pressed="false" aria-controls="admin-skeleton">Voir l’aperçu de chargement</button>
      <div id="admin-skeleton" class="skeleton adm-skeleton" aria-hidden="true">
        <span class="skeleton-row"></span><span class="skeleton-row"></span><span class="skeleton-row"></span>
      </div>
    </section>
  </aside>
</div>
@endverbatim
@endsection
