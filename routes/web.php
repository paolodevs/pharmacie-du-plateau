<?php

use Illuminate\Support\Facades\Route;

/* Les URL historiques en .html sont conservées pour les liens du prototype. */
$pages = [
    'index' => 'pages.vitrine.index',
    'presentation' => 'pages.vitrine.presentation',
    'horaires' => 'pages.vitrine.horaires',
    'catalogue' => 'pages.vitrine.catalogue',
    'miel' => 'pages.vitrine.miel',
    'contact' => 'pages.vitrine.contact',
    'article-prevention' => 'pages.vitrine.article-prevention',
    'sensibilisation' => 'pages.vitrine.sensibilisation',
    'mentions-legales' => 'pages.vitrine.mentions-legales',
    'confidentialite' => 'pages.vitrine.confidentialite',
    'connexion' => 'pages.client.connexion',
    'inscription' => 'pages.client.inscription',
    'reinitialisation' => 'pages.client.reinitialisation',
    'espace-client' => 'pages.client.espace-client',
    'profil' => 'pages.client.profil',
    'mes-commandes' => 'pages.client.mes-commandes',
    'mes-demandes' => 'pages.client.mes-demandes',
    'messagerie' => 'pages.client.messagerie',
    'connexion-pro' => 'pages.professionnel.connexion-pro',
    'detail-pro' => 'pages.professionnel.detail-pro',
    'file-pro' => 'pages.professionnel.file-pro',
    'notifications-pro' => 'pages.professionnel.notifications-pro',
    'transmission-pro' => 'pages.professionnel.transmission-pro',
    'admin' => 'pages.admin.admin',
    'admin-catalogue' => 'pages.admin.admin-catalogue',
    'admin-comptes' => 'pages.admin.admin-comptes',
    'admin-planning' => 'pages.admin.admin-planning',
    'admin-publications' => 'pages.admin.admin-publications',
    'journal-actions' => 'pages.admin.journal-actions'
];

Route::view('/', 'pages.vitrine.index')->name('home');
Route::redirect('/index.html', '/');

Route::get('/404.html', function () {
    return response()->view('pages.erreur.404', [], 404);
});

Route::get('/{page}.html', function (string $page) use ($pages) {
    abort_unless(isset($pages[$page]), 404);
    return view($pages[$page]);
})->where('page', '[a-z0-9-]+');

Route::fallback(function () {
    return response()->view('pages.erreur.404', [], 404);
});
