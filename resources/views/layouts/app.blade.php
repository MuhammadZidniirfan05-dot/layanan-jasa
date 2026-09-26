<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $settings->site_name }} — {{ $settings->tagline }}</title>
    <meta name="description" content="{{ $settings->tagline }}" />

    @if($settings->favicon)
        <link rel="icon" href="{{ asset('storage/' . $settings->favicon) }}" />
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --brand-primary: {{ $settings->primary_color }};
            --brand-secondary: {{ $settings->secondary_color }};
            --brand-accent: {{ $settings->accent_color }};
        }
        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            background: #EBF4FA;
        }
        .card-shadow {
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04), 0 12px 32px rgba(15, 23, 42, 0.06);
        }
        .hero-slide {
            background-size: cover;
            background-position: center 35%;
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 1.6s ease-in-out;
        }
        .hero-slide.active { opacity: 1; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(22px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes floatY {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        @keyframes pulseRing {
            0% { box-shadow: 0 0 0 0 color-mix(in srgb, var(--brand-accent) 45%, transparent); }
            70% { box-shadow: 0 0 0 14px color-mix(in srgb, var(--brand-accent) 0%, transparent); }
            100% { box-shadow: 0 0 0 0 color-mix(in srgb, var(--brand-accent) 0%, transparent); }
        }
        .anim-fade-up { opacity: 0; animation: fadeUp 0.8s cubic-bezier(0.16,1,0.3,1) forwards; }
        .anim-float { animation: floatY 4s ease-in-out infinite; }
        .anim-pulse { animation: pulseRing 2.2s ease-out infinite; }

        .reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.7s cubic-bezier(0.16,1,0.3,1), transform 0.7s cubic-bezier(0.16,1,0.3,1); }
        .reveal-visible { opacity: 1 !important; transform: translateY(0) !important; }
        .reveal-left { opacity: 0; transform: translateX(-32px); transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1), transform 0.8s cubic-bezier(0.16,1,0.3,1); }
        .reveal-left.reveal-visible { opacity: 1 !important; transform: translateX(0) !important; }
        .reveal-right { opacity: 0; transform: translateX(32px); transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1), transform 0.8s cubic-bezier(0.16,1,0.3,1); }
        .reveal-right.reveal-visible { opacity: 1 !important; transform: translateX(0) !important; }
        .reveal-scale { opacity: 0; transform: scale(0.92); transition: opacity 0.6s ease, transform 0.6s ease; }
        .reveal-scale.reveal-visible { opacity: 1 !important; transform: scale(1) !important; }

        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-6px); }
        .btn-press { transition: transform 0.15s ease; }
        .btn-press:active { transform: scale(0.96); }
        .icon-pop { transition: transform 0.3s ease; }
        .group:hover .icon-pop { transform: scale(1.12) rotate(-4deg); }
        [x-cloak] { display: none !important; }

        .nav-link { position: relative; padding-bottom: 6px; }
        .nav-link::after {
            content: '';
            position: absolute;
            left: 0; right: 100%; bottom: 0;
            height: 2px;
            background: var(--brand-primary);
            transition: right 0.3s ease;
        }
        .nav-link:hover::after,
        .nav-link.nav-active::after { right: 0; }
        .nav-link.nav-active { opacity: 1 !important; }
    </style>
</head>
<body class="antialiased">
    @yield('content')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale');

            if ('IntersectionObserver' in window) {
                var io = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('reveal-visible');
                            io.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

                revealEls.forEach(function (el) { io.observe(el); });
            } else {
                revealEls.forEach(function (el) { el.classList.add('reveal-visible'); });
            }

            setTimeout(function () {
                revealEls.forEach(function (el) { el.classList.add('reveal-visible'); });
            }, 2000);

            var counters = document.querySelectorAll('[data-counter-target]');
            if ('IntersectionObserver' in window) {
                var cio = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (!entry.isIntersecting) return;
                        var el = entry.target;
                        var target = parseFloat(el.getAttribute('data-counter-target')) || 0;
                        var suffix = el.getAttribute('data-counter-suffix') || '';
                        var start = performance.now();
                        var duration = 1200;
                        function step(t) {
                            var p = Math.min((t - start) / duration, 1);
                            var eased = 1 - Math.pow(1 - p, 3);
                            el.textContent = Math.floor(target * eased) + suffix;
                            if (p < 1) requestAnimationFrame(step);
                        }
                        requestAnimationFrame(step);
                        cio.unobserve(el);
                    });
                }, { threshold: 0.4 });
                counters.forEach(function (el) { cio.observe(el); });
            } else {
                counters.forEach(function (el) {
                    el.textContent = el.getAttribute('data-counter-target') + (el.getAttribute('data-counter-suffix') || '');
                });
            }

            // Active nav underline: highlight the nav link matching the section currently in view
            var navLinks = document.querySelectorAll('[data-nav-link]');
            if (navLinks.length && 'IntersectionObserver' in window) {
                var navSections = [];
                navLinks.forEach(function (link) {
                    var targetId = link.getAttribute('data-nav-link');
                    var section = document.getElementById(targetId);
                    if (section) navSections.push({ id: targetId, el: section });
                });

                if (navSections.length) {
                    var navObserver = new IntersectionObserver(function (entries) {
                        entries.forEach(function (entry) {
                            if (!entry.isIntersecting) return;
                            var matchId = null;
                            navSections.forEach(function (s) { if (s.el === entry.target) matchId = s.id; });
                            if (!matchId) return;
                            navLinks.forEach(function (l) {
                                l.classList.toggle('nav-active', l.getAttribute('data-nav-link') === matchId);
                            });
                        });
                    }, { rootMargin: '-45% 0px -50% 0px', threshold: 0 });

                    navSections.forEach(function (s) { navObserver.observe(s.el); });
                }
            }

            // ===== Hero slideshow: ganti class .active tiap 6 detik =====
            var heroSlides = document.querySelectorAll('.hero-slide');
            if (heroSlides.length > 1) {
                var heroCurrent = 0;
                setInterval(function () {
                    heroSlides[heroCurrent].classList.remove('active');
                    heroCurrent = (heroCurrent + 1) % heroSlides.length;
                    heroSlides[heroCurrent].classList.add('active');
                }, 6000);
            }
        });
    </script>
</body>
</html>