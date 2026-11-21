@extends('layouts.app')

@section('title', 'Pharmacie du Plateau · Prendre soin du vivant')
@section('description', 'Pharmacie du Plateau au Bénin. Prendre soin du vivant : informations pratiques, horaires et ressources de prévention.')

@section('content')
@verbatim
<main id="main-content" data-page="home">
<section class="story-track" data-story-track aria-label="Récit de la pharmacie en cinq temps">
  <div class="story-stage">
    <article class="story-panel is-active" data-story-panel="0" aria-label="1 sur 5 — Accueil">
      <div class="hero">
        <div class="hero-art" aria-hidden="true"><svg viewBox="0 0 400 400" fill="none"><circle cx="200" cy="200" r="188" fill="#fff1e2" stroke="#f58220" stroke-width="3"/><circle cx="200" cy="200" r="140" fill="#15803d"/><path d="M178 120h44v58h58v44h-58v58h-44v-58h-58v-44h58v-58Z" fill="#fff"/><circle cx="318" cy="92" r="34" fill="#f58220"/><circle cx="76" cy="318" r="22" fill="#14532d"/><circle cx="342" cy="300" r="12" fill="#f58220"/><path d="M60 140c20-30 52-34 74-22-10 28-44 40-74 22Z" fill="#f58220" opacity=".9"/><path d="M296 352c-26 6-50-6-58-28 28-8 56 4 58 28Z" fill="#15803d" opacity=".85"/></svg></div>
       
        <div class="container"><div class="hero-copy" data-parallax="0.08">
          <span class="eyebrow">Pharmacie de proximité · Bénin</span>
          <h1 data-split-title>Prendre soin du vivant</h1>
          <p class="lead">Un repère de proximité pour s’informer et trouver le bon interlocuteur. Les coordonnées et horaires sont à confirmer par la pharmacie.</p>
          <div class="button-row"><a class="button" href="presentation.html" data-transition data-magnetic>Découvrir la pharmacie <svg class="button-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 12h15m-6-6 6 6-6 6"/></svg></a><a class="button button-secondary" href="horaires.html" data-transition>Voir les horaires</a></div>
          <div class="station-status"><span class="chip chip-dark"><i class="status-dot"></i><span data-opening-status>Planning à confirmer</span></span><span class="chip chip-dark">Prochaine garde : <span data-next-duty>[à confirmer]</span></span></div>
        </div></div>
        <span class="hero-side-note">Une pharmacie au cœur du vivant</span>
      </div>
    </article>
    <article class="story-panel" data-story-panel="1" aria-label="2 sur 5 — Fly-in"><div class="panel-overlay"></div>
      <div class="container"><div class="panel-copy"><div class="panel-topline"><span class="panel-index">02</span><span>Un lieu de repère</span></div><h2 class="display-title" data-split-title>Au plus près de vos besoins</h2><p class="lead">Découvrez les informations pratiques, les services confirmés et les ressources de prévention, à votre rythme.</p><div class="button-row panel-callout"><a class="button" href="presentation.html" data-transition>Voir la présentation</a><a class="button button-secondary" href="contact.html" data-transition>Accéder au contact</a></div></div></div>
    </article>
    <article class="story-panel" data-story-panel="2" aria-label="3 sur 5 — Services">
      <div class="panel-image" style="background:linear-gradient(120deg,#eef7f0,#ffffff 55%,#ffe7cf);" data-parallax="0.3"></div><div class="panel-overlay"></div>
      <div class="container"><div class="panel-copy"><div class="panel-topline"><span class="panel-index">03</span><span>La mission</span></div><h2 class="display-title" data-split-title>Quatre repères, des services à confirmer</h2><p class="lead">Les prestations n’ont pas encore été validées par l’équipe. Chaque point renvoie vers les informations disponibles, sans supposer la présence d’un service.</p>
        <div class="hotspot-map" style="position:relative;max-width:600px;min-height:210px;margin-top:28px;border-radius:28px;background:linear-gradient(145deg,#f1f8f3,#fff5ea);border:1px solid rgba(20,83,45,.16)">
          <a class="hotspot" style="left:16%;top:24%" href="presentation.html" data-transition aria-label="Service 1, à confirmer"><span>Service 01 · [à confirmer]</span></a>
          <a class="hotspot" style="left:70%;top:16%" href="catalogue.html" data-transition aria-label="Service 2, à confirmer"><span>Service 02 · [à confirmer]</span></a>
          <a class="hotspot" style="left:42%;top:60%" href="sensibilisation.html" data-transition aria-label="Service 3, à confirmer"><span>Service 03 · [à confirmer]</span></a>
          <a class="hotspot" style="left:83%;top:70%" href="contact.html" data-transition aria-label="Service 4, à confirmer"><span>Service 04 · [à confirmer]</span></a>
        </div>
      </div></div>
    </article>
    <article class="story-panel" data-story-panel="3" aria-label="4 sur 5 — Station et accès"><div class="panel-overlay"></div>
      <div class="container"><div class="station-grid"><div class="panel-copy"><div class="panel-topline"><span class="panel-index">04</span><span>Votre station</span></div><h2 class="display-title" data-split-title>Les informations utiles, en un lieu</h2><p class="lead">Des accès directs aux coordonnées et aux repères du quotidien. Les données restent à confirmer.</p><div class="station-status"><span class="chip chip-dark"><i class="status-dot"></i><span data-opening-status>Planning à confirmer</span></span><span class="chip chip-dark">Prochaine garde : <span data-next-duty>[à confirmer]</span></span></div></div>
          <div class="glass-card"><span class="eyebrow">Accès rapides</span><div class="quick-links"><a class="quick-link" href="contact.html#telephone" data-transition><span>Téléphone</span><span data-contact-value="phone">[à confirmer]</span></a><a class="quick-link" href="contact.html#adresse" data-transition><span>Adresse</span><span data-contact-value="address">[à confirmer]</span></a><a class="quick-link" href="contact.html#itineraire" data-transition><span>Itinéraire</span><span aria-hidden="true">Ouvrir le repère ↗</span></a><a class="quick-link" href="horaires.html" data-transition><span>Horaires &amp; garde</span><span>Consulter ↗</span></a><a class="quick-link" href="contact.html" data-transition><span>Écrire à l’équipe</span><span>Contacter ↗</span></a></div></div>
        </div></div>
    </article>
    <article class="story-panel" data-story-panel="4" aria-label="5 sur 5 — Rubriques et repères">
      <div class="container"><div class="station-grid"><div class="panel-copy"><div class="panel-topline"><span class="panel-index">05</span><span>Un même lieu</span></div><h2 class="display-title" data-split-title>Choisir son prochain repère</h2><p class="lead">Accédez aux informations et ressources disponibles. Les chiffres ci-dessous décrivent la navigation du site, pas l’activité de la pharmacie.</p><div class="button-row panel-callout"><a class="button" href="catalogue.html" data-transition>Voir les rubriques</a><a class="button button-secondary" href="contact.html" data-transition>Poser une question</a></div></div>
          <div><div class="card-grid" style="grid-template-columns:1fr"><div class="stat-card"><span class="stat-value" data-count-up="4">0</span><span class="stat-label">repères de service à confirmer</span></div><div class="stat-card"><span class="stat-value" data-count-up="5">0</span><span class="stat-label">accès rapides présentés</span></div><div class="stat-card"><span class="stat-value" data-count-up="3">0</span><span class="stat-label">espaces de démonstration</span></div></div></div>
        </div></div>
    </article>
    <div class="story-progress" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></div>
  </div>
</section>
<div class="marquee" aria-hidden="true"><div class="marquee-track"><span class="marquee-word">À l’écoute du vivant</span><i class="marquee-dot"></i><span class="marquee-word">Au rythme du quotidien</span><i class="marquee-dot"></i><span class="marquee-word">À l’écoute du vivant</span><i class="marquee-dot"></i><span class="marquee-word">Au rythme du quotidien</span><i class="marquee-dot"></i></div></div>
<section class="section"><div class="container"><div class="section-heading"><div><span class="eyebrow reveal">Repères pratiques</span><h2 class="reveal" data-split-title>Avant votre passage</h2><p class="reveal">Confirmez les informations directement auprès de la pharmacie. La présence de l’équipe et la disponibilité d’un produit ne sont jamais garanties par le statut affiché.</p></div><a class="button button-secondary" href="horaires.html" data-transition>Consulter horaires &amp; gardes ↗</a></div>
  <div class="notice notice-warning reveal"><span class="notice-icon" aria-hidden="true">i</span><p><strong>Informations à confirmer.</strong> Les horaires, le prochain jour de garde, les coordonnées et toute fermeture exceptionnelle ne sont pas encore renseignés. Consultez la pharmacie avant de vous déplacer.</p></div>
  <div class="card-grid two" style="margin-top:22px"><a class="surface-card reveal" href="horaires.html" data-transition data-tilt data-cursor-label><span class="card-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4c-9 0-15 4-15 11a5 5 0 0 0 5 5c7 0 11-6 10-16Z"/><path d="M5 19c2-4 6-7 11-10"/></svg></span><h3>Horaires & garde</h3><p>Planning hebdomadaire, calendrier de garde et date de mise à jour — informations à confirmer.</p><span class="card-footer"><span>Explorer</span><span aria-hidden="true">↗</span></span></a><a class="surface-card reveal" href="sensibilisation.html" data-transition data-tilt data-cursor-label><img class="card-image" src="/manus-storage/async-images/SwPk66Db0gi2QLQ1Q1i4Rx/image-3.webp" alt="Illustration botanique décorative" loading="lazy"><h3>Sensibilisation</h3><p>Informations générales de prévention. Aucun diagnostic ni aucune prescription.</p><span class="card-footer"><span>Explorer</span><span aria-hidden="true">↗</span></span></a></div>
</div></section>
</main>
@endverbatim
@endsection

@push('page-scripts')
<script src="{{ asset('assets/js/story.js') }}" defer></script>
@endpush
