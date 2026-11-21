# Intégration du prototype Pharmacie du Plateau dans Laravel

Les pages HTML du prototype sont converties en vues Blade et rangées par espace fonctionnel. Le design, les fichiers CSS/JavaScript et les URL historiques en `.html` sont conservés.

## Organisation des vues

```text
resources/views/
├── layouts/app.blade.php
├── partials/header.blade.php
├── partials/footer.blade.php
├── pages/
│   ├── vitrine/       # index, presentation, horaires, catalogue, miel, contact, prévention, mentions légales...
│   ├── client/        # connexion, inscription, profil, demandes, messagerie...
│   ├── professionnel/ # connexion et écrans professionnels
│   ├── admin/         # tableau de bord et gestion
│   └── erreur/        # 404, 405, 419, 429, 500, 503
└── errors/            # vues conventionnelles reconnues par Laravel
```

## Installation

Projet cible : `C:\xampp\htdocs\pharmacie-du-plateau`.

1. Extraire ce ZIP.
2. Copier le dossier `resources/views` du paquet dans `C:\xampp\htdocs\pharmacie-du-plateau\resources\`. Fusionner les dossiers si demandé, sans remplacer tout `resources`.
3. Copier `public/assets` dans `C:\xampp\htdocs\pharmacie-du-plateau\public\`.
4. Faire une copie de sécurité de `routes/web.php`.
5. Copier tout le contenu de `routes-web.php` du paquet dans `C:\xampp\htdocs\pharmacie-du-plateau\routes\web.php`.
6. Depuis le dossier du projet, exécuter une commande à la fois :

```powershell
php artisan optimize:clear
php artisan route:list
php artisan serve
```

7. Ouvrir `http://127.0.0.1:8000`.

## Correspondance des espaces

- `pages/vitrine` : pages publiques.
- `pages/client` : espace client.
- `pages/professionnel` : espace professionnel.
- `pages/admin` : administration (tableau de bord et pages de gestion, toutes dans le gabarit `layouts/admin.blade.php` avec le menu `partials/admin-sidebar.blade.php`).
- `public/assets/js/admin.js` : comportements du tableau de bord (menu mobile, état affiché sur le site, filtres, gardes). À copier avec le dossier `public/assets`.
- Coordonnées et histoire de la pharmacie (adresse, téléphones, mission, vision) : reprises du document d’historique ; e-mail encore à confirmer dans `config.js`.
- `pages/erreur` : pages d’erreur HTTP. Laravel utilise les petits fichiers de `views/errors` pour retrouver automatiquement ces vues lors des erreurs correspondantes.

Les URL en `.html` sont conservées. Par exemple `/presentation.html` affiche `pages.vitrine.presentation`.

## Limites actuelles

L’intégration concerne les vues et la navigation. Les formulaires, l’authentification, la transmission d’ordonnances, la messagerie, les notifications et les fonctions d’administration restent des démonstrations non reliées à MySQL. Ne pas y saisir de vraies ordonnances ni données personnelles pour le moment. Les écrans évoquant des commandes ou achats devront être revus pour respecter le périmètre : aucune vente de médicaments en ligne. Les coordonnées, horaires, jours de garde et services à confirmer doivent être validés par la pharmacie.
