<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title class="notranslate">{{ $site_settings['site_title'] ?? ($site_settings['site_name'] ?? 'PT Kayaba Indonesia') }}
    </title>
    <link rel="icon"
        href="{{ isset($site_settings['site_favicon']) ? asset('storage/' . $site_settings['site_favicon']) : asset('assets/img/kybputih.png') }}"
        type="image/png">
    <meta name="description" content="{{ $site_settings['meta_description'] ?? '' }}">
    <meta name="keywords" content="{{ $site_settings['meta_keywords'] ?? '' }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #fff;
            overflow-x: hidden;
            letter-spacing: -0.01em;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', 'Inter', sans-serif;
        }

        .navbar-kyb {
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            padding: 5px 0;
            min-height: 75px;
        }

        .nav-container {
            padding-left: 3%;
            padding-right: 3%;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 60px;
            width: auto;
            transition: 0.3s;
        }

        .navbar-nav {
            display: flex;
            gap: 20px;
        }

        .navbar-kyb .nav-link {
            color: #000 !important;
            font-weight: 700;
            font-size: 14px;
            padding: 10px 20px !important;
            white-space: nowrap;
            transition: all 0.3s ease;
            border-radius: 5px;
        }

        .navbar-kyb .nav-link:hover {
            color: #eb0a1e !important;
            background: #f8f8f8;
            transform: translateY(-2px);
        }




        .dropdown-item img {
            width: 22px;
            height: auto;
            margin-right: 10px;
            border: 1px solid #eee;
        }

        .dropdown-toggle {
            border: 2px solid #000 !important;
            border-radius: 50px !important;
            padding: 8px 20px !important;
            transition: all 0.3s ease;
            background: #fff;
            min-height: 40px;
            display: inline-flex;
            align-items: center;
        }

        .dropdown-toggle:hover {
            background: #f8f8f8 !important;
            border-color: #000 !important;
            color: #000 !important;
            transform: translateY(-2px);
        }

        .dropdown-toggle:active,
        .dropdown-toggle.show {
            background: #f0f0f0 !important;
            border-color: #000 !important;
            color: #000 !important;
        }

        .dropdown-toggle::after {
            margin-left: 8px;
        }


        .btn-login-toyota {
            border: 2px solid #000;
            border-radius: 50px;
            padding: 8px 20px !important;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            color: #000;
            transition: all 0.3s ease;
            min-height: 40px;
        }

        .btn-login-toyota:hover {
            background: #eb0a1e;
            border-color: #eb0a1e;
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(235, 10, 30, 0.3);
        }

        .btn-login-toyota:active {
            background: #c00818;
            border-color: #c00818;
            transform: translateY(0);
        }

        .btn-login-toyota i {
            font-size: 16px;
        }

        /* Responsivitas untuk Tab dan HP */
        @media (max-width: 991px) {
            .navbar-brand img {
                height: 50px;
            }

            .navbar-collapse {
                background: #fff;
                padding: 20px;
                border-top: 1px solid #eee;
            }



            .btn-login-toyota {
                justify-content: center;
                width: 100%;
            }
        }

        /* Hide Google Translate original UI elements */
        .goog-te-banner-frame.skiptranslate,
        .goog-te-gadget-icon,
        .goog-te-gadget-simple,
        .skiptranslate iframe,
        .goog-te-balloon-frame,
        .goog-tooltip,
        .goog-tooltip:hover,
        #google_translate_element {
            display: none !important;
        }

        /* Remove Google Translate highlight effect */
        .goog-text-highlight {
            background-color: transparent !important;
            box-shadow: none !important;
            border: none !important;
        }

        /* Fix body shift from Google Translate */
        body {
            top: 0px !important;
            position: static !important;
        }

        /* Event Dropdown Styling */
        .event-dropdown .nav-link.dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 5px;
            border: none !important;
            background: transparent !important;
            padding: 10px 20px !important;
        }

        .event-dropdown .nav-link.dropdown-toggle::after {
            display: none;
        }

        .event-dropdown .nav-link.dropdown-toggle[aria-expanded="true"] i {
            transform: rotate(180deg);
        }

        .event-dropdown-menu {
            border-radius: 12px;
            padding: 8px 0;
            margin-top: 8px;
            min-width: 280px;
            animation: dropdownFadeIn 0.3s ease;
        }

        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .event-dropdown-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .event-dropdown-item:hover {
            background: linear-gradient(90deg, #fff5f5 0%, #ffe8ea 100%);
            color: #eb0a1e !important;
            padding-left: 25px;
        }

        .event-dropdown-item i {
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .event-dropdown-item:hover i {
            transform: scale(1.2);
        }

        .dropdown-divider {
            margin: 8px 0;
            border-color: #f0f0f0;
        }

        /* Footer Styling */
        .footer-dark {
            background: #212529;
            color: #fff;
            font-size: 14px;
            padding-top: 0;
        }

        .footer-dark .footer-top {
            padding: 20px 0 10px 0;
            background: #212529;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-dark .footer-about .brand-text {
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 1px;
        }

        .footer-dark .footer-about .company-desc {
            font-size: 15px;
            line-height: 26px;
            color: rgba(255, 255, 255, 0.9);
            margin-top: 10px;
            max-width: 400px;
        }

        .footer-dark .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 16px;
            transition: 0.3s;
            text-decoration: none;
        }

        .footer-dark .social-links a:hover {
            background: #fff;
            color: #eb0a1e;
            transform: translateY(-3px);
        }

        .footer-dark h4 {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            position: relative;
            padding-bottom: 5px;
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;
        }

        .footer-dark h4::after {
            content: '';
            position: absolute;
            display: block;
            width: 25px;
            height: 2px;
            background: #fff;
            bottom: 0;
            left: 0;
        }

        .footer-dark .footer-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-dark .footer-links ul li {
            padding: 4px 0;
            display: flex;
            align-items: center;
        }

        .footer-dark .footer-links ul li:first-child {
            padding-top: 0;
        }

        .footer-dark .footer-links ul a {
            color: rgba(255, 255, 255, 0.9);
            transition: 0.3s;
            display: inline-block;
            line-height: 1;
            text-decoration: none;
        }

        .footer-dark .footer-links ul i {
            padding-right: 8px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 12px;
            line-height: 1;
        }

        .footer-dark .footer-links ul a:hover {
            color: #fff;
            padding-left: 5px;
        }

        .footer-dark .footer-contact p {
            line-height: 26px;
            color: rgba(255, 255, 255, 0.9);
        }

        .footer-dark .footer-bottom {
            padding-top: 10px;
            padding-bottom: 10px;
            color: #fff;
            text-align: center;
            border-top: none;
        }

        .footer-dark .copyright {
            margin-bottom: 5px;
        }

        .footer-dark .credits {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.8);
        }

        .footer-dark .credits a {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .footer-dark .footer-bottom {
                padding-top: 20px;
                padding-bottom: 20px;
            }

            .footer-dark .footer-contact {
                text-align: left !important;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-kyb fixed-top shadow-sm">
        <div class="container-fluid nav-container">
            <a class="navbar-brand notranslate" href="/">
                <img src="{{ isset($site_settings['site_logo']) ? asset('storage/' . $site_settings['site_logo']) : asset('assets/img/kybLogo.png') }}"
                    alt="{{ $site_settings['site_title'] ?? 'KYB Logo' }}">
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#about">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#products">Produk</a></li>
                    <li class="nav-item dropdown event-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="eventDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span>Pencapaian</span>
                            <i class="bi bi-chevron-down ms-1"
                                style="font-size: 0.75rem; transition: transform 0.3s ease;"></i>
                        </a>
                        <ul class="dropdown-menu event-dropdown-menu shadow border-0" aria-labelledby="eventDropdown">
                            <li>
                                <a class="dropdown-item event-dropdown-item" href="/sertificate">
                                    <i class="bi bi-patch-check-fill me-2" style="color: #eb0a1e;"></i>
                                    <span>Sertificate</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item event-dropdown-item" href="/penghargaan">
                                    <i class="bi bi-trophy-fill me-2" style="color: #eb0a1e;"></i>
                                    <span>Penghargaan</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item event-dropdown-item" href="/event">
                                    <i class="bi bi-calendar-event-fill me-2" style="color: #eb0a1e;"></i>
                                    <span>Events</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link"
                            href="https://hrd.kyb.co.id/recruitment/index.php">Karir</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#contact">Kontak</a></li>
                </ul>

                <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-4">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-globe me-1"></i> Bahasa
                        </a>
                        <ul class="dropdown-menu shadow border-0" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="#" onclick="changeLanguage('id')">
                                    <img src="https://flagcdn.com/w20/id.png" class="me-2"
                                        style="width: 20px; border: 1px solid #eee;">Indonesia
                                </a></li>
                            <li><a class="dropdown-item" href="#" onclick="changeLanguage('en')">
                                    <img src="https://flagcdn.com/w20/gb.png" class="me-2"
                                        style="width: 20px; border: 1px solid #eee;">English
                                </a></li>
                            <li><a class="dropdown-item" href="#" onclick="changeLanguage('ja')">
                                    <img src="https://flagcdn.com/w20/jp.png" class="me-2"
                                        style="width: 20px; border: 1px solid #eee;">Jepang
                                </a></li>
                        </ul>
                    </div>

                    <a href="/login" class="btn-login-toyota">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk
                    </a>

                </div>
            </div>
        </div>
    </nav>

    <main style="margin-top: 110px;">
        @yield('content')
    </main>

    <!-- Footer Section -->
    <footer id="footer" class="footer-dark">
        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 col-md-12 footer-about">
                        <a href="/" class="logo d-flex align-items-center mb-3 text-decoration-none">
                            <span
                                class="brand-text">{{ $site_settings['site_title'] ?? ($site_settings['site_name'] ?? 'PT Kayaba Indonesia') }}</span>
                        </a>
                        <p class="company-desc" style="margin-top: 5px; font-size: 0.85rem;"> Leading Manufacturer of
                            Shock Absorbers & Hydraulic Equipment. Member of Astra Otoparts & KYB Corporation Japan.
                            <br>
                            {{ $site_settings['site_description'] ?? 'Leading Manufacturer of Shock Absorbers & Hydraulic Equipment. Member of Astra Otoparts & KYB Corporation Japan.' }}
                        </p>
                        <div class="social-links d-flex mt-2 gap-2">
                            @if (!empty($site_settings['social_facebook']))
                                <a href="https://www.linkedin.com/company/ptkybi-kayaba-indonesia/"
                                    class="social-icon" target="_blank"><i class="bi bi-linkedin"></i></a>
                            @endif
                            @if (!empty($site_settings['social_instagram']))
                                <a href="https://www.instagram.com/pt.kyb.id/" class="social-icon" target="_blank"><i
                                        class="bi bi-instagram"></i></a>
                            @endif
                            @if (!empty($site_settings['social_youtube']))
                                <a href="https://www.youtube.com/@PT.KAYABAINDONESIA" class="social-icon"
                                    target="_blank"><i class="bi bi-youtube"></i></a>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-3 col-6 footer-links">
                        <h4>Tautan Penting</h4>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-chevron-right"></i> <a href="/">Beranda</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="/#about">Tentang Kami</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="/#products">Produk</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                        <h4>Hubungi Kami</h4>
                        <p>
                            <strong>{{ $site_settings['site_title'] ?? ($site_settings['site_name'] ?? 'PT Kayaba Indonesia') }}</strong>
                            <br>
                            {!! nl2br(
                                e(
                                    $site_settings['contact_address'] ??
                                        "Jl. Jawa No.4, Blok II, Jatiwangi\nCikarang Barat, Bekasi 17530\nIndonesia",
                                ),
                            ) !!} <br><br>
                            <strong>Phone:</strong> {{ $site_settings['contact_phone'] ?? '+62 21 8981456' }}<br>
                            <strong>Email:</strong> {{ $site_settings['contact_email'] ?? 'info@kyb.astra.co.id' }}<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container footer-bottom clearfix">
            <div class="copyright">
                &copy; Copyright
                2026 <strong><span>{{ $site_settings['site_title'] ?? ($site_settings['site_name'] ?? 'PT Kayaba Indonesia') }}</span></strong>.
                All Rights Reserved
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <div id="google_translate_element" style="display:none;"></div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'id,en,ja',
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    <script>
        function changeLanguage(lang) {
            var selectField = document.querySelector("select.goog-te-combo");
            if (selectField) {
                selectField.value = lang;
                selectField.dispatchEvent(new Event("change"));
            }
        }
    </script>

    @if (isset($site_settings['google_analytics']) && $site_settings['google_analytics'])
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $site_settings['google_analytics'] }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '{{ $site_settings['google_analytics'] }}');
        </script>
    @endif

</body>

</html>
