<!DOCTYPE html>

<!--[if IE 8]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Heri Brennholz') — Brennholz, Pellets &amp; Scheite aus der Schweiz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Heri Brennholz GmbH – Brennholz, Holzpellets, Holzbriketts und Kaminholz aus eigener Schweizer Produktion. Trocken, zertifiziert, kostenlose Lieferung in die Schweiz und nach Deutschland.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'Heri Brennholz') — Brennholz, Pellets &amp; Scheite aus der Schweiz">
    <meta property="og:description"
        content="Heri Brennholz GmbH – Brennholz, Holzpellets, Holzbriketts und Kaminholz. Trocken, zertifiziert, kostenlose Lieferung in die Schweiz und nach Deutschland.">
    <meta property="og:image" content="{{ asset('assets/images/thumb.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Heri Brennholz GmbH">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Heri Brennholz') — Brennholz, Pellets &amp; Scheite aus der Schweiz">
    <meta name="twitter:description"
        content="Heri Brennholz GmbH – Brennholz, Holzpellets, Holzbriketts und Kaminholz. Trocken, zertifiziert, kostenlose Lieferung in die Schweiz und nach Deutschland.">
    <meta name="twitter:image" content="{{ asset('assets/images/thumb.jpg') }}">

    <!-- font -->
    <link rel="stylesheet" href="/assets/fonts/fonts.css">
    <link rel="stylesheet" href="/assets/icon/icomoon/style.css">
    <!-- css -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/css/animate.css">
    <link rel="stylesheet" href="/assets/css/image-compare-viewer.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">

    <!-- Favicon and Touch Icons  -->
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/logo/favicon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/logo/favicon-16.png">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/logo/apple-touch-icon.png">
    @stack('styles')
    <style>
        /* Barre orange : chaque annonce tient sur une seule ligne */
        .tf-topbar .text-adver {
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }
        .tf-topbar .swiper-topbar { overflow: hidden; }
        .tf-topbar .text-adver .br-line { flex: 0 0 auto; }
        /* Fiche produit : galerie miniatures nette */
        .pdp-thumbs img.is-active { border-color: #111 !important; }

        /* ===== Tiroir panier ===== */
        .boire-cart-drawer { width: 420px; max-width: 92vw; display: flex; flex-direction: column; background: #fff; }
        .boire-cart-head { display: flex; align-items: center; justify-content: space-between; padding: 20px 24px; border-bottom: 1px solid #ece5da; }
        #cartDrawerBody { flex: 1; display: flex; flex-direction: column; min-height: 0; }
        .boire-cart-scroll { flex: 1; overflow-y: auto; padding: 8px 24px; }
        .boire-cart-item { display: grid; grid-template-columns: 64px 1fr auto; gap: 14px; padding: 18px 0; border-bottom: 1px solid #f0ebe3; }
        .boire-cart-thumb { display: block; }
        .boire-cart-thumb img { width: 64px; height: 64px; object-fit: cover; border-radius: 8px; background: #f6f2ec; }
        .boire-cart-name { display: block; font-weight: 500; color: #1c140f; line-height: 1.3; margin-bottom: 4px; }
        .boire-cart-name:hover { text-decoration: underline; }
        .boire-cart-line { font-size: 13px; color: #7a7167; }
        .boire-cart-remove { border: 0; background: none; padding: 0; margin-top: 4px; font-size: 12px; color: #a1968a; text-decoration: underline; cursor: pointer; }
        .boire-cart-remove:hover { color: #1c140f; }
        .boire-cart-price { font-weight: 600; white-space: nowrap; }
        .boire-cart-foot { border-top: 1px solid #ece5da; padding: 20px 24px 24px; }
        .boire-cart-subtotal { display: flex; align-items: center; justify-content: space-between; font-weight: 600; font-size: 16px; }
        .boire-cart-note { font-size: 12px; color: #8a8075; margin: 6px 0 14px; }
        .boire-cart-actions { display: grid; gap: 10px; }
        .boire-cart-actions .tf-btn { width: 100%; justify-content: center; }
        .boire-cart-empty { text-align: center; padding: 48px 24px; display: flex; flex-direction: column; align-items: center; gap: 14px; }
    </style>
</head>

<body>
    <!-- Scroll Top -->
    <button id="goTop" type="button">
        <span class="d-none">Text</span>
        <span class="border-progress"></span>
        <span class="ic-wrap">
            <span class="icon icon-ArrowCaretUp"></span>
        </span>
    </button>
    <!-- /Scroll Top -->


    <main id="wrapper">
        <!-- Topbar -->
        <div class="tf-topbar  bg-main-12 sm-d-none">
            <div class="container-full">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="tf-btn-swiper-main">
                            <div class="text-white fs-18 nav-prev-swiper">
                                <i class="icon icon-ArrowCaretLeft"></i>
                            </div>
                            <div dir="ltr" class="swiper tf-swiper swiper-topbar" data-touch="false" data-auto="true"
                                data-loop="true" data-speed="1500">
                                <div class="swiper-wrapper">
                                    <!-- slide 1 -->
                                    <div class="swiper-slide">
                                        <div class="text-adver text-white text-caption">
                                            Kostenlose Lieferung in die Schweiz und nach Deutschland
                                            <span class="br-line bg-white"></span>
                                            <a href="/shop" class="fw-semibold link-underline">
                                                Zum Shop
                                            </a>
                                        </div>
                                    </div>
                                    <!-- slide 2 -->
                                    <div class="swiper-slide">
                                        <div class="text-adver text-white text-caption">
                                            Trockenes Holz &amp; zertifizierte Pellets, palettenweise geliefert.
                                            <span class="br-line bg-white"></span>
                                            <a href="/shop" class="fw-semibold link-underline">
                                                Zum Shop
                                            </a>
                                        </div>
                                    </div>
                                    <!-- slide 3 -->
                                </div>
                                <!-- <div class="sw-dot-default tf-sw-pagination"></div> -->
                            </div>
                            <div class="text-white fs-18 nav-next-swiper">
                                <i class="icon icon-ArrowCaretRight"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="tf-list justify-content-end">
                            <a href="/ueber-uns" class="text-caption text-white link-underline">Über uns</a>
                            <a href="/shop" class="text-caption text-white link-underline">Unsere Produkte</a>
                            <a href="/kontakt" class="text-caption text-white link-underline">Kontakt</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Topbar -->
        <!-- Header -->
        <header class="tf-header">
            <div class="header-inner">
                <div class="container-full">
                    <div class="header-inner_wrap">
                        <div class="header-left">
                            <div class="box-btn-open-menu d-flex d-xl-none">
                                <a href="#mobileMenu" data-bs-toggle="offcanvas" class="d-xl-none">
                                    <i class="icon icon-OpenMenu fs-24"></i>
                                </a>
                            </div>
                            <nav class="box-navigation d-none d-xl-block">
                                <ul class="box-nav-menu">
                                    <li class="menu-item">
                                        <a href="{{ route('home') }}" class="item-link {{ request()->routeIs('home') ? 'activeMenu' : '' }}">
                                            <span class="text">Startseite</span>
                                        </a>
                                    </li>
                                    <li class="menu-item position-relative">
                                        <a href="{{ route('shop.index') }}" class="item-link {{ request()->routeIs('shop.*') || request()->routeIs('product.*') ? 'activeMenu' : '' }}">
                                            <span class="text">Shop</span>
                                            <i class="icon icon-ArrowCaretDown"></i>
                                        </a>
                                        <div class="sub-menu">
                                            <ul class="sub-menu_list">
                                                <li class="sub-menu_item">
                                                    <a href="{{ route('shop.index') }}" class="sub-menu_link text-caption">
                                                        <span class="text">Alle Produkte</span>
                                                    </a>
                                                </li>
                                                @foreach ($navCategories as $navCat)
                                                    <li class="sub-menu_item">
                                                        <a href="{{ route('shop.category', $navCat) }}" class="sub-menu_link text-caption">
                                                            <span class="text">{{ $navCat->name }} ({{ $navCat->products_count ?? $navCat->products()->count() }})</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('pages.contact') }}" class="item-link {{ request()->routeIs('pages.contact') ? 'activeMenu' : '' }}">
                                            <span class="text">Kontakt</span>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('pages.privacy') }}" class="item-link {{ request()->routeIs('pages.privacy') ? 'activeMenu' : '' }}">
                                            <span class="text">Datenschutz</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header-center">
                            <h1>
                                <a href="/" class="logo-site">
                                    <img width="90" height="80" src="/assets/images/logo/logo.png" alt="Heri Brennholz GmbH">
                                </a>
                            </h1>
                        </div>
                        <div class="header-right">
                            <ul class="nav-icon-list tf-list justify-content-end">
                                <li class="d-none d-sm-block">
                                    <a href="#search" data-bs-toggle="offcanvas" class="nav-icon-item link"
                                        aria-label="Open search">
                                        <span class="icon icon-Search" aria-hidden="true"></span>
                                    </a>
                                </li>

                                <li class="d-none d-sm-block">
                                    <a href="{{ route('wishlist.index') }}" class="nav-icon-item link has-number" aria-label="Favoris">
                                        <i class="icon icon-Hearth2"></i>
                                        <span class="number-order js-wishlist-count">{{ $wishlist->count() }}</span>
                                    </a>
                                </li>
                                <li class="d-none d-sm-block">
                                    <a href="{{ route('cart.index') }}" class="nav-icon-item link has-number" aria-label="Warenkorb">
                                        <i class="icon icon-ShoppingBag"></i>
                                        <span class="number-order js-cart-count">{{ $cart->count() }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#shoppingCart" data-bs-toggle="offcanvas"
                                        class="nav-icon-item link has-number" aria-label="Warenkorb öffnen">
                                        <i class="icon icon-Bag"></i>
                                        <span class="number-order js-cart-count">{{ $cart->count() }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- flash message --}}
        @if (session('status'))
            <div class="container"><div style="background:#eef7ee;border:1px solid #cbe3cb;padding:12px 16px;border-radius:8px;margin:16px 0;text-align:center;">{{ session('status') }}</div></div>
        @endif

        @yield('content')

        <footer class="tf-footer">
            <span class="br-line fake-class top-0"></span>
            <div class="footer-inner">
                <div class="container">
                    <div class="footer-inner_wrap">
                        <div class="ft-infor">
                            <a href="/" class="logo-site">
                                <img loading="lazy" width="90" height="80" src="/assets/images/logo/logo.png"
                                    alt="Heri Brennholz GmbH">
                            </a>
                            <ul class="list-infor-contact tf-list vertical gap-15">
                                <li class="infor-contact_item">
                                    <span class="ic-w">
                                        <i class="icon icon-DotLocation"></i>
                                    </span>
                                    <a href="https://www.google.com/maps?q=15+Yarran+St,+Punchbowl+2198+NSW,+Australia"
                                        class="text-caption fw-medium link-underline link-black">
                                        15 Yarran St, Punchbowl 2198 NSW, Australia
                                    </a>
                                </li>
                                <li class="infor-contact_item">
                                    <span class="ic-w">
                                        <i class="icon icon-Phone"></i>
                                    </span>
                                    <a href="tel:6483421245" class="text-caption fw-medium link-underline link-black">
                                        (64) 8342 1245
                                    </a>
                                </li>
                                <li class="infor-contact_item">
                                    <span class="ic-w">
                                        <i class="icon icon-LetterEnvelope"></i>
                                    </span>
                                    <a href="mailto:support@example.com"
                                        class="text-caption fw-medium link-underline link-black">
                                        support@example.com
                                    </a>
                                </li>
                            </ul>
                            <a href="/kontakt" class="tf-btn-line gap-6">
                                <span class="text-caption fw-medium">
                                    Get direction
                                </span>
                                <i class="icon icon-ArrowUpRight"></i>
                            </a>
                            <div class="social-list social-color">
                                <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer"
                                    class="social-facebook" aria-label="Facebook">
                                    <span class="icon">
                                        <i class="icon-FacebookLogo" aria-hidden="true"></i>
                                    </span>
                                </a>

                                <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"
                                    class="social-instagram" aria-label="Instagram">
                                    <span class="icon">
                                        <i class="icon-InstagramLogo" aria-hidden="true"></i>
                                    </span>
                                </a>

                                <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"
                                    class="social-linkin" aria-label="LinkedIn">
                                    <span class="icon">
                                        <i class="icon-LinkinLogo" aria-hidden="true"></i>
                                    </span>
                                </a>

                                <a href="https://x.com/" target="_blank" rel="noopener noreferrer" class="social-x"
                                    aria-label="X">
                                    <span class="icon">
                                        <i class="icon-XLogo" aria-hidden="true"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="footer-col-block foot-col-link-1 ms-auto">
                            <p class="footer-heading footer-heading-mobile">Über uns</p>
                            <div class="tf-collapse-content">
                                <ul class="footer-menu-list">
                                    <li>
                                        <a href="/ueber-uns" class="text-caption fw-medium link-black link-underline">
                                            Über uns
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/kontakt" class="text-caption fw-medium link-black link-underline">
                                            Kontakt
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/ueber-uns" class="text-caption fw-medium link-black link-underline">
                                            Unsere Geschichte
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/shop"
                                            class="text-caption fw-medium link-black link-underline">
                                            Zum Shop
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-col-block foot-col-link-2">
                            <p class="footer-heading footer-heading-mobile">Informationen</p>
                            <div class="tf-collapse-content">
                                <ul class="footer-menu-list">
                                    <li>
                                        <a href="{{ route('pages.impressum') }}" class="text-caption fw-medium link-black link-underline">
                                            Impressum
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/datenschutz" class="text-caption fw-medium link-black link-underline">
                                            Datenschutz
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/agb"
                                            class="text-caption fw-medium link-black link-underline">
                                            AGB
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/agb#5-widerrufsrecht-fur-kundinnen-und-kunden-in-deutschland" class="text-caption fw-medium link-black link-underline">
                                            Rückgabe & Erstattung
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/faq" class="text-caption fw-medium link-black link-underline">
                                            FAQ
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/agb#4-lieferung" class="text-caption fw-medium link-black link-underline">
                                            Versand
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-col-block foot-col-contact">
                            <p class="footer-heading footer-heading-mobile">Newsletter abonnieren</p>
                            <div class="tf-collapse-content">
                                <div class="ft-contact">
                                    <p class="desc text-caption fw-medium">
                                        Abonnieren Sie unseren Newsletter und erhalten Sie unsere Angebote zu Brennholz und Pellets. Kein Spam.
                                    </p>
                                    <form action="{{ route('pages.contact.submit') }}" method="POST" class="form-subscribe-v2">
                                        @csrf
                                        <input type="hidden" name="name" value="Newsletter-Abonnent">
                                        <input type="hidden" name="message" value="Newsletter-Anmeldung (Footer)">
                                        <fieldset class="form-field">
                                            <label for="iptSubEmail" class="d-none">
                                                E-Mail
                                            </label>
                                            <input id="iptSubEmail" type="email" class="text-caption"
                                                name="email" placeholder="Ihre E-Mail-Adresse" aria-label="E-Mail-Adresse" required>
                                            <button type="submit" class="btn-action_submit tf-btn animate-btn"
                                                aria-label="Abonnieren">
                                                <i class="icon icon-ArrowRight" aria-hidden="true"></i>
                                            </button>
                                        </fieldset>
                                    </form>
                                    <p>
                                        *By entering the e-mail you accept the
                                        <a href="/agb"
                                            class="cl-text-main text-decoration-underline d-inline-block">
                                            terms and conditions
                                        </a>
                                        and the
                                        <a href="/datenschutz"
                                            class="cl-text-main text-decoration-underline d-inline-block">
                                            privacy policy.
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="footer-bottom_wrap">
                        <span class="br-line fake-class top-0"></span>
                        <div class="text-nocopy text-caption cl-text-main">
                            © {{ date('Y') }} Heri Brennholz GmbH. Alle Rechte vorbehalten.
                        </div>
                        <ul class="method-list">
                            <li class="img-method">
                                <img loading="lazy" width="43" height="25"
                                    src="/assets/images/payment/american-express.svg" alt="Image">
                            </li>
                            <li class="img-method">
                                <img loading="lazy" width="40" height="25" src="/assets/images/payment/apple-pay.svg"
                                    alt="Image">
                            </li>
                            <li class="img-method">
                                <img loading="lazy" width="40" height="25" src="/assets/images/payment/diners.svg"
                                    alt="Image">
                            </li>
                            <li class="img-method">
                                <img loading="lazy" width="40" height="25" src="/assets/images/payment/discover.svg"
                                    alt="Image">
                            </li>
                            <li class="img-method">
                                <img loading="lazy" width="40" height="25" src="/assets/images/payment/google-pay.svg"
                                    alt="Image">
                            </li>
                            <li class="img-method">
                                <img loading="lazy" width="40" height="25" src="/assets/images/payment/maestro.svg"
                                    alt="Image">
                            </li>
                            <li class="img-method">
                                <img loading="lazy" width="40" height="25" src="/assets/images/payment/master.svg"
                                    alt="Image">
                            </li>
                            <li class="img-method">
                                <img loading="lazy" width="40" height="25" src="/assets/images/payment/shopify.svg"
                                    alt="Image">
                            </li>
                            <li class="img-method">
                                <img loading="lazy" width="40" height="25" src="/assets/images/payment/union-pay.svg"
                                    alt="Image">
                            </li>
                            <li class="img-method">
                                <img loading="lazy" width="40" height="25" src="/assets/images/payment/visa.svg"
                                    alt="Image">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </main>
    <!-- Mobile Menu -->
    <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
        <div class="canvas-header">
            <button type="button" class="link-rotate" data-bs-dismiss="offcanvas">
                <i class="icon icon-Close2"></i>
            </button>
        </div>
        <div class="canvas-body">
            <div class="mb-content-top">
                <div id="wrapper-menu-navigation"></div>
                <div class="group-btn gap-7">
                    <a href="{{ route('cart.index') }}" class="tf-btn rounded-4 style-stroke-3 small gap-10 text-black">
                        <i class="icon icon-ShoppingBag fs-14"></i>
                        <span class="text-caption letter-space--3">Warenkorb ({{ $cart->count() }})</span>
                    </a>
                    <a href="#search" data-bs-toggle="offcanvas"
                        class="tf-btn rounded-4 style-stroke-3 small gap-10 text-black">
                        <i class="icon icon-Search2 fs-14"></i>
                        <span class="text-caption letter-space--3">Suchen</span>
                    </a>
                </div>
                <div class="need-help-wrap">
                    <p class="text-caption cl-text-main fw-medium text-decoration-underline mb-15">Brauchen Sie Hilfe?</p>
                    <div class="tf-list vertical gap-6">
                        <a href="{{ route('pages.contact') }}" class="d-block text-caption">
                            Adresse:
                            <span class="fw-medium">Fiderholzstrasse 7, 4562 Biberist, Schweiz</span>
                        </a>
                        <a href="mailto:info@heri-brennholz.ch" class="d-block text-caption">
                            E-Mail: <span class="fw-medium">info@heri-brennholz.ch</span>
                        </a>
                        <a href="tel:+41000000000" class="d-block text-caption">
                            Telefon: <span class="fw-medium">+41 00 000 00 00</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Mobile Menu -->

    <!-- Search -->
    <div class="offcanvas offcanvas-top popup-search full" id="search">
        <div class="btn-close-popup" data-bs-dismiss="offcanvas">
            <i class="icon icon-Close2"></i>
        </div>
        <div class="container">
            <div class="canvas-heading">
                <h4 class="title">
                    Wonach suchen Sie?
                </h4>
                <form class="form-search" action="{{ route('shop.search') }}" method="GET">
                    <input type="text" name="q" placeholder="Pellets, Scheite, Brennholz …" value="{{ request('q') }}">
                    <button type="submit" class="btn-action_submit">
                        <i class="icon icon-Search"></i>
                    </button>
                </form>
                <div class="popuplar-search">
                    <span class="text-caption fw-medium">
                        Beliebte Suchanfragen:
                    </span>
                    <div class="list-popular">
                        @foreach ($navCategories as $navCat)
                            <a href="{{ route('shop.category', $navCat) }}" class="popular-item text-caption fw-medium">{{ $navCat->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="offcanvas-content">
                <h4 class="title">Unsere Kategorien</h4>
                <div class="tf-grid-layout tf-col-2 md-col-3 xl-col-4 gap-15">
                    @foreach ($navCategories as $navCat)
                        <a href="{{ route('shop.category', $navCat) }}" class="card-product text-center p-3" style="border:1px solid #ece7e1;border-radius:10px;display:block;">
                            <span class="name-product fw-medium d-block">{{ $navCat->name }}</span>
                            <span class="text-caption opacity-75">{{ $navCat->products()->count() }} Produkte</span>
                        </a>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- /Search -->
    <!-- Toolbar -->
    <div class="tf-toolbar-bottom">
        <div class="toolbar-item">
            <a href="#search" data-bs-toggle="offcanvas">
                <span class="toolbar-icon">
                    <i class="icon icon-Search2"></i>
                </span>
                <span class="toolbar-label">Suchen</span>
            </a>
        </div>
        <div class="toolbar-item">
            <a href="/shop">
                <span class="toolbar-icon">
                    <i class="icon icon-User"></i>
                </span>
                <span class="toolbar-label">Konto</span>
            </a>
        </div>
        <div class="toolbar-item">
            <a href="/shop">
                <span class="toolbar-icon">
                    <i class="icon icon-StoreFront"></i>
                </span>
                <span class="toolbar-label">Shop</span>
            </a>
        </div>
        <div class="toolbar-item">
            <a href="/shop">
                <span class="toolbar-icon">
                    <i class="icon icon-HearchStroke"></i>
                </span>
                <span class="toolbar-label">Favoriten</span>
            </a>
        </div>
        <div class="toolbar-item">
            <a href="/warenkorb">
                <span class="toolbar-icon">
                    <i class="icon icon-ShoppingBag"></i>
                    <span class="toolbar-count">2</span>
                </span>
                <span class="toolbar-label">Cart</span>
            </a>
        </div>
    </div>
    <!-- /Toolbar -->
    <!-- Shopping Cart -->
    <div class="offcanvas offcanvas-end boire-cart-drawer" id="shoppingCart" tabindex="-1">
        <div class="boire-cart-head">
            <h5 class="m-0">Ihr Warenkorb</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Schließen"></button>
        </div>
        <div id="cartDrawerBody">
            @include('partials.cart-drawer-body')
        </div>
    </div>
    <!-- /Shopping Cart -->
    <!-- Quick View -->
    <div class="modal fade" id="modalQuickView" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content"></div>
        </div>
    </div>
    <!-- /Quick View -->
    <!-- Size Guide -->
    <div class="modal modalCentered fade modal-size" id="modalSize">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-heading d-flex align-items-center justify-content-between">
                    <h5 class="title-pop">Size Chart</h5>
                    <span class="cs-pointer d-flex link" data-bs-dismiss="modal">
                        <i class="icon-Close link-rotate fs-24"></i>
                    </span>
                </div>
                <div class="modal-main">
                    <div class="tf-rte">
                        <div class="tf-table-res-df mb-25">
                            <p class="fw-medium mb-15">Size Chart</p>
                            <div class="overflow-auto">
                                <table class="tf-sizeguide-table text-caption">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>US</th>
                                            <th>Bust</th>
                                            <th>Waist</th>
                                            <th>Low Hip</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>XS</td>
                                            <td>2</td>
                                            <td>32</td>
                                            <td>24 - 25</td>
                                            <td>33 - 34</td>
                                        </tr>
                                        <tr>
                                            <td>S</td>
                                            <td>4</td>
                                            <td>34 - 35</td>
                                            <td>26 - 27</td>
                                            <td>35 - 26</td>
                                        </tr>
                                        <tr>
                                            <td>M</td>
                                            <td>6</td>
                                            <td>36 - 37</td>
                                            <td>28 - 29</td>
                                            <td>38 - 40</td>
                                        </tr>
                                        <tr>
                                            <td>L</td>
                                            <td>8</td>
                                            <td>38 - 29</td>
                                            <td>30 - 31</td>
                                            <td>42 - 44</td>
                                        </tr>
                                        <tr>
                                            <td>XL</td>
                                            <td>10</td>
                                            <td>40 - 41</td>
                                            <td>32 - 33</td>
                                            <td>45 - 47</td>
                                        </tr>
                                        <tr>
                                            <td>XXL</td>
                                            <td>12</td>
                                            <td>42 - 43</td>
                                            <td>34 - 35</td>
                                            <td>48 - 50</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tf-page-size-chart-content">
                            <div class="chart-note">
                                <p class="fw-medium mb-24">Style Measurements:</p>
                                <div class="title text-caption fw-medium mb-10">1. Chest</div>
                                <p class="text-caption mb-10">Measure at the fullest part of your chest, keeping the
                                    tape parallel to the floor.</p>
                                <div class="title text-caption fw-medium mb-10">2. Waist</div>
                                <p class="text-caption mb-10">Measure at the smallest part of your waist. This is
                                    usually below the rib cage and above the hip bone.</p>
                                <div class="title text-caption fw-medium mb-10">3. Hip</div>
                                <p class="text-caption mb-10">Measure at the fullest part of your seat, keeping the tape
                                    parallel to the floor.</p>
                            </div>
                            <div class="chart-image">
                                <img loading="lazy" width="258" height="297" src="/assets/images/item/size-chart.jpg"
                                    alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Size Guide -->
    <!-- Compare -->
    <div class="modal modalCentered fade modal-compare" id="modalCompare">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="btn-close-popup" data-bs-dismiss="modal">
                    <i class="icon icon-Close2"></i>
                </div>
                <h4 class="modal-title text-center">
                    Compare Products
                </h4>
                <div class="tf-compare-list main-list-clear wrap-empty_text">
                    <div class="tf-compare-offcanvas list-empty">
                        <p class="box-text_empty text-caption cl-text-main text-center w-100">Your Compare is curently
                            empty</p>
                        <div class="tf-compare-item file-delete">
                            <a href="/shop">
                                <div class="icon remove">
                                    <i class="icon-Close"></i>
                                </div>
                                <img class="radius-10" width="288" height="339"
                                    src="/assets/images/product/product-5.jpg" alt="Image">
                            </a>
                            <a href="/shop"
                                class="name-prd_compare fw-medium link-underline text-line-clamp-1">
                                Short Sleeve Crew Neck Basic T-Shirt
                            </a>
                        </div>
                        <div class="tf-compare-item file-delete">
                            <a href="/shop">
                                <div class="icon remove">
                                    <i class="icon-Close"></i>
                                </div>
                                <img class="radius-10" width="288" height="339"
                                    src="/assets/images/product/product-6.jpg" alt="Image">
                            </a>
                            <a href="/shop"
                                class="name-prd_compare fw-medium link-underline text-line-clamp-1">
                                Pocket Detail Shirt
                            </a>
                        </div>
                        <div class="tf-compare-item file-delete">
                            <a href="/shop">
                                <div class="icon remove">
                                    <i class="icon-Close"></i>
                                </div>
                                <img class="radius-10" width="288" height="339"
                                    src="/assets/images/product/product-7.jpg" alt="Image">
                            </a>
                            <a href="/shop"
                                class="name-prd_compare fw-medium link-underline text-line-clamp-1">
                                Pocket Detail Shirt
                            </a>
                        </div>
                        <div class="tf-compare-item file-delete">
                            <a href="/shop">
                                <div class="icon remove">
                                    <i class="icon-Close"></i>
                                </div>
                                <img class="radius-10" width="288" height="339"
                                    src="/assets/images/product/product-8.jpg" alt="Image">
                            </a>
                            <a href="/shop"
                                class="name-prd_compare fw-medium link-underline text-line-clamp-1">
                                Gentle Foam Cleanser
                            </a>
                        </div>
                    </div>
                    <div class="tf-compare-buttons">
                        <a href="/shop" class="tf-btn rounded-6 size2 animate-btn btn-action_direc">
                            <span class="text-caption">
                                Compare
                            </span>
                        </a>
                        <button type="button"
                            class="tf-btn rounded-6 size2 style-stroke-2 clear-list-empty tf-compare-button-clear-all">
                            <span class="text-caption">
                                Clear all
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Compare -->
    <!-- Login -->
    <div class="offcanvas offcanvas-end popup-log" id="canvasLogin">
        <div class="canvas-wrapper">
            <div class="popup-header">
                <div class="heading pt-0 mb-0">
                    <h5 class="title fw-semibold">Log in</h5>
                    <span class="icon-Close2 link-rotate" data-bs-dismiss="offcanvas"></span>
                </div>
            </div>

            <div class="canvas-body">
                <form class="form-log" action="account-page.html">
                    <div class="form-content gap-15">
                        <input class="text-caption" type="email" placeholder="Email*" required>
                        <input class="text-caption" type="password" placeholder="Password*" required>
                    </div>
                    <a href="#canvasResetPass" data-bs-toggle="offcanvas"
                        class="text-caption cl-text-main link-black text-decoration-underline mb-24">
                        Forgot your password?
                    </a>
                    <div class="tf-grid-layout ssm-col-2 gap-12">
                        <button type="submit" class="tf-btn rounded-6 size2 animate-btn w-100">
                            Sign in
                        </button>
                        <a href="#canvasRegister" data-bs-toggle="offcanvas"
                            class="tf-btn rounded-6 size2 style-stroke-2  w-100">
                            Create an account
                        </a>
                    </div>
                </form>
                <div class="other-log">
                    <span class="text-center mb-24 d-block">
                        Or sign in with:
                    </span>
                    <a href="#" class="btn-action_other other-facebook tf-btn rounded-6 size3 w-100 animate-btn mb-8">
                        <span class="ic-wrap">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="16" cy="16" r="16" fill="#3B5998" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M20.155 10.656L18.649 10.657C17.468 10.657 17.239 11.218 17.239 12.041V13.857H20.056L19.689 16.702H17.239V24H14.302V16.702H11.846V13.857H14.302V11.76C14.302 9.325 15.789 8 17.96 8C19 8 19.894 8.077 20.155 8.112V10.656ZM16 0C7.164 0 0 7.163 0 16C0 24.836 7.164 32 16 32C24.837 32 32 24.836 32 16C32 7.163 24.837 0 16 0Z"
                                    fill="white" />
                            </svg>
                        </span>
                        FACEBOOK
                    </a>
                    <a href="#" class="btn-action_other tf-btn rounded-6 size3 w-100 animate-btn">
                        <span class="ic-wrap">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_481_2548)">
                                    <path
                                        d="M30.7917 13.2181L17.7392 13.2174C17.1629 13.2174 16.6957 13.6846 16.6957 14.2609V18.4306C16.6957 19.0069 17.1629 19.4741 17.7392 19.4741H25.0896C24.2847 21.5629 22.7824 23.3123 20.8658 24.4237L24 29.8493C29.0276 26.9416 32 21.8398 32 16.1287C32 15.3155 31.9401 14.7342 31.8202 14.0796C31.7291 13.5823 31.2973 13.2181 30.7917 13.2181Z"
                                        fill="#167EE6" />
                                    <path
                                        d="M15.9999 25.7391C12.4028 25.7391 9.26257 23.7738 7.57601 20.8654L2.15063 23.9926C4.91157 28.7777 10.0837 32 15.9999 32C18.9023 32 21.6408 31.2186 23.9999 29.8568V29.8493L20.8658 24.4237C19.4321 25.2552 17.7731 25.7391 15.9999 25.7391Z"
                                        fill="#12B347" />
                                    <path
                                        d="M24 29.8568V29.8493L20.8658 24.4237C19.4322 25.2551 17.7733 25.7391 16 25.7391V32C18.9023 32 21.641 31.2186 24 29.8568Z"
                                        fill="#0F993E" />
                                    <path
                                        d="M6.26088 16C6.26088 14.2269 6.74475 12.5681 7.57606 11.1346L2.15069 8.00745C0.781375 10.3591 0 13.0903 0 16C0 18.9098 0.781375 21.6409 2.15069 23.9926L7.57606 20.8654C6.74475 19.4319 6.26088 17.7731 6.26088 16Z"
                                        fill="#FFD500" />
                                    <path
                                        d="M15.9999 6.26088C18.3456 6.26088 20.5003 7.09437 22.1832 8.48081C22.5984 8.82281 23.2018 8.79813 23.5821 8.41781L26.5365 5.46344C26.968 5.03194 26.9373 4.32562 26.4763 3.92575C23.6566 1.47956 19.9879 0 15.9999 0C10.0837 0 4.91157 3.22231 2.15063 8.00744L7.57601 11.1346C9.26257 8.22625 12.4028 6.26088 15.9999 6.26088Z"
                                        fill="#FF4B26" />
                                    <path
                                        d="M22.1833 8.48081C22.5984 8.82281 23.2019 8.79813 23.5822 8.41781L26.5366 5.46344C26.968 5.03194 26.9373 4.32562 26.4764 3.92575C23.6567 1.4795 19.9879 0 16 0V6.26088C18.3456 6.26088 20.5003 7.09437 22.1833 8.48081Z"
                                        fill="#D93F21" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_481_2548">
                                        <rect width="32" height="32" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                        GOOGLE
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Login -->
    <!-- Register -->
    <div class="offcanvas offcanvas-end popup-log" id="canvasRegister">
        <div class="canvas-wrapper">
            <div class="popup-header">
                <div class="heading pt-0 mb-0">
                    <h5 class="title fw-semibold">Create account</h5>
                    <span class="icon-Close2 link-rotate" data-bs-dismiss="offcanvas"></span>
                </div>
            </div>
            <div class="canvas-body">
                <form class="form-register">
                    <div class="form-content gap-12">
                        <input class="text-caption" type="text" placeholder="Username or email address*" required>
                        <div class="password-wrapper  w-100">
                            <input class="text-caption password-field" type="password" placeholder="Password*" required>
                            <span class="toggle-pass icon-EyeSlice cl-text-main"></span>
                        </div>
                        <div class="password-wrapper  w-100">
                            <input class="text-caption password-field" type="password" placeholder="Confirm Password*"
                                required>
                            <span class="toggle-pass icon-EyeSlice cl-text-main"></span>
                        </div>
                    </div>
                    <div class="checkbox-wrap">
                        <input class="tf-check style-small" type="checkbox" id="agree-term_register">
                        <label for="agree-term_register" class="text-caption">
                            I agree with
                            <a href="/agb" class="text-decoration-underline">
                                AGB
                            </a>
                        </label>
                    </div>
                    <div class="tf-grid-layout ssm-col-2 gap-12">
                        <button type="submit" class="tf-btn rounded-6 size2 animate-btn w-100">
                            Register
                        </button>
                        <a href="#canvasLogin" data-bs-toggle="offcanvas"
                            class="tf-btn rounded-6 size2 style-stroke-2  w-100">
                            Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Register -->
    <!-- Reset Pass -->
    <div class="offcanvas offcanvas-end popup-log" id="canvasResetPass">
        <div class="canvas-wrapper">
            <div class="popup-header">
                <div class="heading pt-0 mb-0">
                    <h5 class="title fw-semibold">Reset Your Password</h5>
                    <span class="icon-Close2 link-rotate" data-bs-dismiss="offcanvas"></span>
                </div>
            </div>

            <div class="canvas-body">
                <p class="text-caption cl-text-main mb-24">
                    Forgot your password? No worries! Enter your registered email to receive a link and securely reset
                    it in just a few steps.
                </p>
                <form class="form-reset">
                    <div class="form-content">
                        <input class="text-caption" type="email" placeholder="Enter Your Email*" required>
                    </div>
                    <div class="tf-grid-layout ssm-col-2 gap-12">
                        <button type="submit" class="tf-btn rounded-6 size2 animate-btn w-100">
                            Reset Password
                        </button>
                        <button type="button" data-bs-dismiss="offcanvas"
                            class="tf-btn rounded-6 size2 style-stroke-2  w-100">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Reset Pass -->

    <!-- Demo -->
    <div class="modal modalCentered fade modal-demo" id="modalDemo">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close-popup" data-bs-dismiss="modal">
                    <i class="icon icon-Close2"></i>
                </button>
                <h4 class="demo-title">Omniva Templates</h4>
                <div class="row-demo">
                    <div class="demo-item">
                        <a href="/" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-1.jpg"
                                alt="Image">
                            <p class="list-badge">
                                <span class="demo-label type-new">New</span>
                            </p>
                        </a>
                        <a href="/" class="demo-name text-caption fw-medium link-underline">
                            Skincare
                        </a>
                    </div>
                    <div class="demo-item">
                        <a href="/shop" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-2.jpg"
                                alt="Image">
                            <p class="list-badge">
                                <span class="demo-label type-hot">Hot</span>
                                <span class="demo-label type-trend">Trend</span>
                            </p>
                        </a>
                        <a href="/shop" class="demo-name text-caption fw-medium link-underline">
                            Swimwear
                        </a>
                    </div>
                    <div class="demo-item">
                        <a href="/shop" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-3.jpg"
                                alt="Image">
                        </a>
                        <a href="/shop" class="demo-name text-caption fw-medium link-underline">
                            Fashion
                        </a>
                    </div>
                    <div class="demo-item">
                        <a href="/shop" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-4.jpg"
                                alt="Image">
                            <p class="list-badge">
                                <span class="demo-label type-hot">Hot</span>
                            </p>
                        </a>
                        <a href="/shop" class="demo-name text-caption fw-medium link-underline">
                            Fashion 02
                        </a>
                    </div>
                    <div class="demo-item">
                        <a href="/shop" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-5.jpg"
                                alt="Image">
                            <p class="list-badge">
                                <span class="demo-label type-trend">Trend</span>
                                <span class="demo-label type-new">New</span>
                            </p>
                        </a>
                        <a href="/shop" class="demo-name text-caption fw-medium link-underline">
                            Jewelry
                        </a>
                    </div>
                    <div class="demo-item">
                        <a href="/shop" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-6.jpg"
                                alt="Image">
                        </a>
                        <a href="/shop" class="demo-name text-caption fw-medium link-underline">
                            Furniture
                        </a>
                    </div>
                    <div class="demo-item">
                        <a href="/shop" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-7.jpg"
                                alt="Image">
                            <p class="list-badge">
                                <span class="demo-label type-new">New</span>
                                <span class="demo-label type-hot">Hot</span>
                            </p>
                        </a>
                        <a href="/shop" class="demo-name text-caption fw-medium link-underline">
                            Accessories
                        </a>
                    </div>
                    <div class="demo-item">
                        <a href="/shop" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-8.jpg"
                                alt="Image">
                            <p class="list-badge">
                                <span class="demo-label type-trend">Trend</span>
                                <span class="demo-label type-hot">Hot</span>
                            </p>
                        </a>
                        <a href="/shop" class="demo-name text-caption fw-medium link-underline">
                            Pet Store
                        </a>
                    </div>
                    <div class="demo-item">
                        <a href="/shop" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-9.jpg"
                                alt="Image">
                        </a>
                        <a href="/shop" class="demo-name text-caption fw-medium link-underline">
                            Garden & Outdoor
                        </a>
                    </div>
                    <div class="demo-item">
                        <a href="/shop" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-10.jpg"
                                alt="Image">
                            <p class="list-badge">
                                <span class="demo-label type-hot">Hot</span>
                            </p>
                        </a>
                        <a href="/shop" class="demo-name text-caption fw-medium link-underline">
                            Baby
                        </a>
                    </div>
                    <div class="demo-item">
                        <a href="/shop" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-11.jpg"
                                alt="Image">
                            <p class="list-badge">
                                <span class="demo-label type-trend">Trend</span>
                            </p>
                        </a>
                        <a href="/shop" class="demo-name text-caption fw-medium link-underline">
                            Kid Fashion
                        </a>
                    </div>
                    <div class="demo-item">
                        <a href="/shop" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-12.jpg"
                                alt="Image">
                            <p class="list-badge">
                                <span class="demo-label type-new">New</span>
                                <span class="demo-label type-hot">Hot</span>
                            </p>
                        </a>
                        <a href="/shop" class="demo-name text-caption fw-medium link-underline">
                            Organic
                        </a>
                    </div>
                    <div class="demo-item">
                        <a href="/shop" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-13.jpg"
                                alt="Image">
                        </a>
                        <a href="/shop" class="demo-name text-caption fw-medium link-underline">
                            Office
                        </a>
                    </div>
                    <div class="demo-item">
                        <a href="/shop" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-14.jpg"
                                alt="Image">
                            <p class="list-badge">
                                <span class="demo-label type-new">New</span>
                            </p>
                        </a>
                        <a href="/shop" class="demo-name text-caption fw-medium link-underline">
                            POD Store
                        </a>
                    </div>
                    <div class="demo-item">
                        <a href="/shop" class="demo-img">
                            <img loading="lazy" width="205" height="258" src="/assets/images/demo/demo-15.jpg"
                                alt="Image">
                            <p class="list-badge">
                                <span class="demo-label type-trend">Trend</span>
                                <span class="demo-label type-hot">Hot</span>
                            </p>
                        </a>
                        <a href="/shop" class="demo-name text-caption fw-medium link-underline">
                            Single Product
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Demo -->

    <!-- Newletter -->
    <div class="modal modalCentered fade modal-newsletter-v1" tabindex="-1" aria-labelledby="newsletterTitle"
        aria-hidden="true" id="modalNewletterV1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="image">
                    <button type="button" class="btn-close-popup" data-bs-dismiss="modal" aria-label="Close">
                        <i class="icon icon-Close2" aria-hidden="true"></i>
                    </button>
                    <img loading="lazy" width="525" height="352" src="/assets/images/section/newletter-1.jpg"
                        alt="Image">
                </div>
                <div class="content">
                    <h4 class="title" id="newsletterTitle">
                        Sign up to our Newsletter
                    </h4>
                    <p class="desc text-caption cl-text-4">
                        Erfahren Sie als Erste die neuesten Angebote zu Brennholz und Pellets.
                    </p>
                    <form class="form-newsletter">
                        <fieldset>
                            <i class="icon icon-Newsletter"></i>
                            <input type="email" placeholder="Your email address" required>
                        </fieldset>
                        <button type="submit" class="tf-btn rounded-6 size2 w-100 animate-btn">
                            Send
                        </button>
                    </form>
                    <div class="tf-list social-color list-social style-2 justify-content-center">
                        <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer"
                            class="social-facebook" aria-label="Facebook">
                            <span class="icon">
                                <i class="icon-Facebook" aria-hidden="true"></i>
                            </span>
                        </a>

                        <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer"
                            class="social-instagram" aria-label="Instagram">
                            <span class="icon">
                                <i class="icon-Instagram" aria-hidden="true"></i>
                            </span>
                        </a>

                        <a href="https://x.com/" target="_blank" rel="noopener noreferrer" class="social-x"
                            aria-label="X">
                            <span class="icon">
                                <i class="icon-X" aria-hidden="true"></i>
                            </span>
                        </a>

                        <a href="https://www.tiktok.com/" target="_blank" rel="noopener noreferrer"
                            class="social-tiktok" aria-label="TikTok">
                            <span class="icon">
                                <i class="icon-Tiktok2" aria-hidden="true"></i>
                            </span>
                        </a>

                        <a href="https://www.pinterest.com/" target="_blank" rel="noopener noreferrer"
                            class="social-pinterest" aria-label="Pinterest">
                            <span class="icon">
                                <i class="icon-Pinterest" aria-hidden="true"></i>
                            </span>
                        </a>
                    </div>
                    <p class="text-caption">
                        <span class="cl-text-4">
                            Will be used in accordance with our
                        </span>
                        <a href="/datenschutz" class="fw-medium link text-decoration-underline">
                            Privacy Policy
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- /Newletter -->


    <!-- Javascript -->
    <script src="/assets/js/plugin/bootstrap.min.js"></script>
    <script src="/assets/js/plugin/jquery.min.js"></script>
    <script src="/assets/js/plugin/swiper-bundle.min.js"></script>
    <script src="/assets/js/plugin/bootstrap-select.min.js"></script>
    <script src="/assets/js/plugin/count-down.js"></script>
    <script src="/assets/js/plugin/infinityslide.js"></script>
    <script src="/assets/js/plugin/wow.min.js"></script>
    <script src="/assets/js/plugin/parallaxie.js"></script>
    <script src="/assets/js/plugin/countto.js"></script>
    <script src="/assets/js/plugin/image-compare-viewer.min.js"></script>
    <script src="/assets/js/plugin/image-compare-viewer.js"></script>

    <script src="/assets/js/carousel.js"></script>
    <script src="/assets/js/main.js"></script>
    <script>
    // Safety net: never let a leftover preloader / modal backdrop freeze the page.
    (function () {
        function unstick() {
            document.querySelectorAll('#preload, .modal-backdrop, .offcanvas-backdrop').forEach(function (el) { el.remove(); });
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        }
        window.addEventListener('load', function () { setTimeout(unstick, 400); });
        // If an offcanvas/modal is open, Escape or a click outside always clears it.
        document.addEventListener('keydown', function (e) { if (e.key === 'Escape') unstick(); });
    })();
    </script>
    <script>
    document.addEventListener('submit', function (e) {
        var form = e.target.closest('form.js-add-to-cart');
        if (!form) return;
        e.preventDefault();
        fetch(form.action, {method:'POST', headers:{'X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content,'Accept':'application/json','Content-Type':'application/x-www-form-urlencoded'}, body:new URLSearchParams(new FormData(form))})
        .then(function(r){return r.json();})
        .then(function(data){
            document.querySelectorAll('.js-cart-count').forEach(function(el){el.textContent=data.count;});
            // met à jour le contenu du tiroir SANS l'ouvrir
            fetch('{{ route('cart.drawer') }}').then(function(r){return r.text();}).then(function(h){
                var b=document.getElementById('cartDrawerBody'); if(b) b.innerHTML=h;
            });
            boireToast(data.message || 'Produkt in den Warenkorb gelegt.');
        }).catch(function(){form.submit();});
    });

    // ---- Retrait depuis le tiroir (sans quitter la page) ----
    document.addEventListener('submit', function (e) {
        var form = e.target.closest('form.js-cart-remove');
        if (!form) return;
        e.preventDefault();
        fetch(form.action, {method:'POST', headers:{'X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content,'Accept':'application/json','Content-Type':'application/x-www-form-urlencoded'}, body:new URLSearchParams(new FormData(form))})
        .then(function(){ return fetch('{{ route('cart.drawer') }}'); })
        .then(function(r){ return r.text(); })
        .then(function(h){
            var b=document.getElementById('cartDrawerBody');
            if(b){
                b.innerHTML=h;
                var c=b.querySelector('#drawerCount');
                if(c) document.querySelectorAll('.js-cart-count').forEach(function(el){el.textContent=c.textContent;});
            }
        })
        .catch(function(){ form.submit(); });
    });

    // ---- Toast léger ----
    function boireToast(msg){
        var t=document.getElementById('boireToast');
        if(!t){t=document.createElement('div');t.id='boireToast';
            t.style.cssText='position:fixed;z-index:99999;left:50%;bottom:28px;transform:translateX(-50%);background:#1c140f;color:#fff;padding:12px 20px;border-radius:8px;font-size:14px;box-shadow:0 8px 24px rgba(0,0,0,.25);opacity:0;transition:opacity .25s;';
            document.body.appendChild(t);}
        t.textContent=msg;t.style.opacity='1';
        clearTimeout(t._h);t._h=setTimeout(function(){t.style.opacity='0';},2600);
    }

    // ---- Favoris ----
    document.addEventListener('click', function(e){
        var a=e.target.closest('.js-wishlist');
        if(!a) return;
        e.preventDefault(); e.stopPropagation();
        fetch('{{ route('wishlist.toggle') }}',{method:'POST',headers:{'X-CSRF-TOKEN':document.querySelector('meta[name=csrf-token]').content,'Accept':'application/json','Content-Type':'application/x-www-form-urlencoded'},body:'product_id='+a.dataset.id})
        .then(function(r){return r.json();})
        .then(function(data){
            document.querySelectorAll('.js-wishlist-count').forEach(function(el){el.textContent=data.count;});
            var li=a.closest('.wishlist'), ic=a.querySelector('.icon'), tip=a.querySelector('.tooltip');
            if(li) li.classList.toggle('active', data.added);
            if(ic){ic.classList.toggle('icon-Hearth2',!data.added); ic.classList.toggle('icon-Trash',data.added);}
            if(tip) tip.textContent = data.added ? 'Aus Favoriten entfernen' : 'Zu Favoriten hinzufügen';
            boireToast(data.message);
        }).catch(function(){});
    });

    // ---- Aperçu rapide : lightbox autonome (aucune dépendance au CSS du template) ----
    (function(){
        var ov=null;
        function close(){ if(ov){ ov.remove(); ov=null; document.body.style.overflow=''; } }
        function open(url){
            close();
            ov=document.createElement('div');
            ov.setAttribute('id','boireQuickview');
            ov.style.cssText='position:fixed;inset:0;z-index:100000;display:flex;align-items:center;justify-content:center;padding:20px;background:rgba(15,10,7,.6);';
            ov.innerHTML='<div class="bqv-panel" style="background:#fff;border-radius:14px;max-width:900px;width:100%;max-height:90vh;overflow:auto;position:relative;box-shadow:0 30px 80px rgba(0,0,0,.35);">'
                + '<button type="button" class="bqv-close" aria-label="Schließen" style="position:absolute;top:10px;right:12px;z-index:2;border:0;background:#f1ece6;width:34px;height:34px;border-radius:50%;font-size:20px;line-height:1;cursor:pointer;">&times;</button>'
                + '<div class="bqv-body" style="padding:8px;"><div style="padding:48px;text-align:center;">Wird geladen …</div></div></div>';
            document.body.appendChild(ov);
            document.body.style.overflow='hidden';
            ov.addEventListener('click', function(e){ if(e.target===ov || e.target.closest('.bqv-close')) close(); });
            fetch(url, {headers:{'X-Requested-With':'XMLHttpRequest'}})
                .then(function(r){ return r.text(); })
                .then(function(h){ var b=ov.querySelector('.bqv-body'); if(b) b.innerHTML=h; })
                .catch(function(){ window.location = url.replace('/apercu',''); });
        }
        document.addEventListener('click', function(e){
            var a=e.target.closest('.js-quickview');
            if(!a) return;
            e.preventDefault();
            open(a.dataset.url);
        });
        document.addEventListener('keydown', function(e){ if(e.key==='Escape') close(); });
    })();
    </script>
    @stack('scripts')
</body>

</html>