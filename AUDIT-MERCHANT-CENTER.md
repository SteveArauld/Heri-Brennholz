# Audit Merchant Center — Heri Brennholz GmbH

Date : 2026-09-12
Périmètre : audit uniquement, aucune correction appliquée (conforme à ÉTAPE 1).

## 0. Stack détectée

- Laravel 13.17, PHP ^8.3 (`composer.json`)
- Base de données : SQLite par défaut (`.env.example:23` `DB_CONNECTION=sqlite`). Pas de MySQL/Postgres configuré en dur — à vérifier en production.
- Frontend : Blade + Vite + Tailwind v4, thème "omniva" (`resources/views/layouts/omniva.blade.php`). Pas de SPA (pas de Vue/React).
- Pas de package de paiement dans `composer.json` (pas de Stripe/PayPal/Omnipay/Klarna SDK).
- **Donnée produit = fichiers JSON statiques**, pas une base gérée dynamiquement au sens CMS :
  - `database/data/products.json` (165 produits, 5 catégories)
  - `database/data/stoves.json` (34 produits, 3 catégories)
  - Seeder : `database/seeders/ShopSeeder.php` (upsert vers `Product`/`Category`/`ProductImage` via `source_id`)
- **⚠ Découverte critique** : les `permalink` des produits scrapés pointent vers `https://lacompagnie-de-laremorque.com/...`, un site de location de remorques sans rapport avec le bois de chauffage. Cela confirme que **le catalogue entier est une donnée de démonstration/scraping tierce jamais remplacée par le vrai catalogue du client**. Ceci est antérieur et plus grave que les problèmes de prix listés ci-dessous — à vous signaler en priorité.

---

## 1. BLOQUANT

### 1.1 Catalogue produit non fiable (donnée tierce, pas les vrais produits du client)
Voir §0. Tant que le vrai catalogue Heri Brennholz n'est pas fourni, aucun flux Merchant Center ne doit être publié : les descriptions, prix, images proviennent d'un scrape d'un site tiers sans rapport avec l'activité.

### 1.2 Prix incohérents — priorité confirmée
Exemple type : `Holzpellets Premium ENplus A1 15 kg` (source_id 18014) :
```json
"price": 249.95, "currency": "CHF", "categories": ["brennholz"], "weight": null, "formatted_weight": "ND"
```
- 249.95 CHF pour un sac de 15 kg = **16.66 CHF/kg**, contre des palettes de 65–70 sacs (975–1050 kg) vendues 137–330 CHF, soit **0.14–0.31 CHF/kg** → écart de **50 à 100x**.
- `weight: null` et `formatted_weight: "ND"` — "ND" est un résidu français ("non défini") laissé par le scraping, preuve supplémentaire que ces fiches n'ont jamais été relues.
- Catégorisé `brennholz` (bûches) au lieu de `holzpellets` (pellets) — voir §1.4.

Échantillon de palettes pellets (toutes en `currency: CHF`) :
| Produit | Prix | Poids | CHF/kg |
|---|---|---|---|
| Pellet MAGIC POLAR – Palette 70×15kg | 213.36 | 1050 kg | 0.20 |
| Pellet Rochefort – Palette 65×15kg | 213.36 | 975 kg | 0.22 |
| Holzpellets BADGER – Palette 65×15kg | 207.84 | 975 kg | 0.21 |
| Heizfuxx "Blue" – 975 kg | 191.41 | 975 kg | 0.20 |
| Pellets HEIZFUXX Rot EN+ A1 – Palette 65×15kg | 326.92 | 975 kg | 0.34 |
| **Holzpellets Premium ENplus A1 15 kg** | **249.95** | **15 kg (supposé)** | **16.66** |

Constat confirmé : les palettes ressortent bien à 0.14–0.34 CHF/kg contre 0.40–0.60 CHF/kg sur le marché suisse réel — **tous les prix pellets de ce catalogue semblent sous-évalués d'un facteur ~2**, en plus du cas aberrant du sac de 15 kg.
**Action requise avant toute correction : tableau complet CHF/kg pour tous les produits pellets/briquettes et CHF/stère pour le bois — à produire une fois le vrai catalogue confirmé (voir §1.1). Aucun prix n'est corrigé ici.**

### 1.3 Devise : incohérence base de données / commande
- Migration `2026_09_11_092803_change_currency_to_chf.php` et commit `f9edabf` ont bien migré `products`/`orders` vers CHF par défaut.
- **Mais `app/Http/Controllers/CheckoutController.php:58` crée encore les commandes avec `'currency' => 'EUR'` en dur.** Toute nouvelle commande passée aujourd'hui est enregistrée en EUR alors que l'affichage produit/panier est en CHF. C'est un bug actif, pas seulement historique.

### 1.4 Catégorisation erronée
Catégories en base (via `category_product`, alimentées par le champ `"categories"` du JSON) :
| Catégorie (slug) | Nb produits |
|---|---|
| holzpellets | 39 |
| scheitholz | 33 |
| brennholz | 24 |
| holzbriketts | 13 |
| kaminholz | 56 |
| pelletoefen | 28 |
| kaminoefen | 3 |
| kamineinsaetze | 3 |

Constat confirmé : **le sac "Holzpellets Premium ENplus A1 15 kg" est classé `brennholz`** au lieu de `holzpellets`. `brennholz`, `kaminholz`, `scheitholz` se recouvrent sémantiquement (tous = "bois de chauffage/bûches" en allemand) sans logique de distinction visible dans les données. Un remaniement complet des règles de catégorisation est nécessaire — liste produit → catégorie actuelle → catégorie proposée à produire une fois le catalogue réel confirmé.

### 1.5 Téléphone factice partout
`+41 00 000 00 00` (lien `tel:+41000000000`) codé en dur à 3 endroits :
- `resources/views/pages/impressum.blade.php:31`
- `resources/views/pages/contact.blade.php:20`
- `resources/views/layouts/omniva.blade.php:508-509`

**⚠ En attente de votre confirmation explicite** (déjà demandée) : vous avez indiqué vouloir utiliser **+49 152 36942793** (mobile allemand) comme numéro principal, ce qui contredit l'objectif "Suisse uniquement" de ce brief et le propre avertissement de vos instructions initiales (risque de suspension Merchant Center, perte de crédibilité). Je n'ai encore rien figé sur ce point — merci de confirmer avant que je propage un numéro à travers le site.

### 1.6 Pays de livraison par défaut = Allemagne au checkout
`resources/views/checkout/index.blade.php:28` :
```blade
<input name="country" value="{{ old('country', 'Deutschland') }}" required>
```
Champ libre (pas de select), pré-rempli **"Deutschland"** par défaut, alors que l'entreprise est suisse. Aucune validation de format CH pour le NPA (`CheckoutController.php:41-47` : règles génériques `string`/`max`, aucune regex CH/DE, aucune liste blanche de pays).

### 1.7 Paiement : logos sans intégration réelle
`resources/views/layouts/omniva.blade.php:456` affiche 7 logos (Rechnung, Vorkasse, SEPA, PayPal, Visa, Mastercard, Klarna) en boucle, purement décoratifs :
```php
@foreach (['rechnung'=>'Kauf auf Rechnung','vorkasse'=>...,'sepa'=>...,'paypal'=>...,'visa'=>...,'mastercard'=>...,'klarna'=>...] as $slug => $label)
    <img src="/assets/images/payment/{{ $slug }}.svg" ...>
@endforeach
```
**Aucune intégration de paiement n'existe** : pas de SDK dans `composer.json`, le formulaire de checkout ne propose même pas de champ de sélection de moyen de paiement, et `CheckoutController.php` crée seulement une commande `pending` puis envoie des emails — aucun encaissement. **Les 7 logos sont un signal trompeur pour Merchant Center** (motif de suspension confirmé). SEPA et Klarna sont en plus orientés zone euro ; **TWINT (dominant en Suisse) est totalement absent**.

### 1.8 Pages légales manquantes annoncées en pied de page
- `/agb#4-lieferung` et `/agb#5-widerrufsrecht-fur-kundinnen-und-kunden-in-deutschland` (`omniva.blade.php:390,400`) ne sont que des ancres dans `/agb`, pas des pages autonomes.
- **`/versand` n'existe pas** (ni route ni vue) — seulement une ancre `/agb#4-lieferung`.
- **`/rueckgabe` n'existe pas du tout**, aucune trace même en tant que référence.
- `/kontakt`, `/faq`, `/datenschutz`, `/agb` existent bien comme routes (`routes/web.php:36-41`).

### 1.9 GTIN absents sur les marques
Non vérifiable précisément produit par produit sans le catalogue réel confirmé (§1.1), mais aucun champ `gtin`/`mpn`/`brand` structuré n'a été identifié dans le schéma `products` actuel au-delà des champs scrapés bruts — à traiter avec le catalogue réel.

---

## 2. MAJEUR

### 2.1 Mentions Allemagne omniprésentes
Message "Schweiz und Deutschland" / livraison DE présent dans quasiment toutes les pages :
`home.blade.php:147`, `contact.blade.php:23`, `about.blade.php:20,28`, `faq.blade.php:12-14`, `terms.blade.php:29,32-33,37-38`, `privacy.blade.php:19,26,33,42`, `shop/show.blade.php:125,173,175`, `cart/index.blade.php:126`, `emails/orders/customer.blade.php:57`, meta descriptions dans `omniva.blade.php:13,19,29,136`.
→ Correction systématique nécessaire (ÉTAPE 2), fichier par fichier.

### 2.2 Impressum : IDE présent mais TVA absente
`resources/views/pages/impressum.blade.php` contient déjà :
- Handelsregister-Nr. : `CH-241.4.020.905-9`
- UID/IDE : `CHE-228.719.493`
(à vérifier/valider — non authentifiés indépendamment ici)
**Aucun numéro de TVA suisse n'est présent.** Selon vos instructions : `[[À COMPLÉTER : numéro de TVA suisse]]` — je ne l'invente pas, à me fournir.

### 2.3 Liens sociaux vides
`omniva.blade.php:312,319,326,333` — facebook.com, instagram.com, linkedin.com, x.com, tous en URL racine sans profil réel.

### 2.4 Badge panier figé
`omniva.blade.php:598` : `<span class="toolbar-count">2</span>` — valeur statique dans la barre d'outils mobile, jamais mise à jour par JS (contrairement aux compteurs `.js-cart-count` du header, corrects, lignes 251/258, mis à jour lignes 661/683).

### 2.5 Disclaimer newsletter
Aucun texte anglais trouvé littéralement — le texte actuel est déjà en allemand (`omniva.blade.php:408-421` : *"Abonnieren Sie unseren Newsletter... Kein Spam."*). **Point à réexaminer avec vous** : soit le texte a déjà été corrigé avant cet audit, soit vous faisiez référence à un autre endroit — merci de préciser si un texte anglais subsiste ailleurs (email transactionnel ?).
Autre problème structurel repéré : pas de vrai service newsletter — les inscriptions passent par le formulaire de contact générique (`PageController::contactSubmit`), aucun consentement RGPD/nLPD explicite, aucun désabonnement.

### 2.6 Secret exposé dans le dépôt
`.env.example:47` contient un mot de passe SMTP Hostinger en clair (`MAIL_PASSWORD='Elodie237#@'`). Hors périmètre Merchant Center mais **sécurité critique** — à faire tourner et retirer du dépôt/historique git dès que possible. Je vous le signale séparément de l'audit Merchant Center proprement dit.

---

## 3. MINEUR / À VÉRIFIER

- `robots.txt` (`public/robots.txt`) : `Disallow:` vide — Googlebot et Googlebot-Image ne sont pas bloqués. `.htaccess` = règles Laravel standards, aucun blocage détecté. **Pas de problème identifié ici.**
- Comptage produits : **199 produits au total** (165 + 34), confirmé par le log du seeder. Conforme à l'attente "~199".
- Pas de colonne `is_published`/`status` sur `products` — tous les produits seedés sont "actifs" par construction ; pas de mécanisme de brouillon.
- Tous les produits ont `in_stock: true` dans le JSON source (aucun `false` trouvé) — à vérifier si c'est réaliste ou un artefact du scraping (probable, vu §0).
- Impressum contient une section "Hinweis für Kundinnen und Kunden in Deutschland" avec clause de règlement des litiges — à supprimer en ÉTAPE 2/3 (périmètre Suisse uniquement), mais vérifier d'abord si des clients allemands existants doivent être traités différentiellement (obligations résiduelles) — **je vous demande confirmation avant suppression**.
- GTIN/MPN/brand : non structurés dans le schéma actuel, dépendent du vrai catalogue.

---

## 4. Décisions à prendre avant de continuer (ÉTAPE 2+)

1. **Le catalogue produit actuel (`products.json`/`stoves.json`) est une donnée scrapée d'un site tiers sans rapport (location de remorques). Avez-vous un vrai catalogue Heri Brennholz à intégrer, ou dois-je continuer à travailler sur ces données comme base à corriger ?** C'est la question la plus importante — toute la suite de l'audit (prix, catégories, GTIN, flux Merchant Center) dépend de la réponse.
2. Confirmation du numéro de téléphone à publier (Suisse +41 77 811 28 93 vs Allemand +49 152 36942793) — en attente, signalé au §1.5.
3. Numéro de TVA suisse manquant — à fournir, ne sera pas inventé.
4. Faut-il conserver le fichier `.env.example` avec un vrai mot de passe SMTP dedans, ou le nettoyer immédiatement (recommandé) ?
5. Périmètre Liechtenstein : à inclure dans "Suisse uniquement" ou exclu ? (mentionné comme option dans le brief)
6. Règle de retour spécifique pour palettes/poêles (marchandise lourde) — distincte des 14 jours standard ou non ?

**Aucune correction n'a été appliquée à ce stade. J'attends vos réponses aux points ci-dessus avant de passer à l'ÉTAPE 2 (suppression du périmètre allemand) et à l'ÉTAPE 3 (pages légales).**
