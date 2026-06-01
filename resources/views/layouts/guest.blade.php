<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistem Penerimaan KIP Kuliah - {{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* =========================================================
           KIP KULIAH — GUEST LAYOUT BACKGROUND
           Animasi kampus malam hari dengan partikel mengambang
        ========================================================= */

        body {
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', 'Figtree', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* --- Wrapper utama: Latar malam & scene kampus --- */
        .kip-guest-wrapper {
            min-height: 100vh;
            width: 100%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            /* Gradien langit malam biru tua */
            background: radial-gradient(ellipse at 50% 25%, #1a3a6e 0%, #0a1628 50%, #04080f 100%);
        }

        /* --- Canvas SVG latar belakang --- */
        .kip-bg-canvas {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        /* --- Kartu form: di tengah layar --- */
        .kip-card-container {
            position: relative;
            z-index: 20;
            width: 100%;
            max-width: 440px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        /* === ANIMASI === */

        /* Partikel mengambang ke atas */
        @keyframes kip-float-up {
            0% {
                transform: translateY(0) scale(1);
                opacity: 0.8;
            }

            60% {
                opacity: 0.9;
            }

            100% {
                transform: translateY(-100vh) scale(0.2);
                opacity: 0;
            }
        }

        /* Bintang berkelip */
        @keyframes kip-twinkle {

            0%,
            100% {
                opacity: 0.25;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.3);
            }
        }

        /* Awan mengambang pelan */
        @keyframes kip-drift {

            0%,
            100% {
                transform: translateX(0) translateY(0);
            }

            50% {
                transform: translateX(15px) translateY(-6px);
            }
        }

        /* Sinar lampu taman */
        @keyframes kip-beam {
            0% {
                opacity: 0;
                transform: scaleY(0);
            }

            25% {
                opacity: 0.15;
                transform: scaleY(1);
            }

            75% {
                opacity: 0.15;
            }

            100% {
                opacity: 0;
                transform: scaleY(1.05);
            }
        }

        /* Orb/lampu berdenyut */
        @keyframes kip-orb-pulse {

            0%,
            100% {
                opacity: 0.5;
                r: 4;
            }

            50% {
                opacity: 1;
                r: 7;
            }
        }

        /* Garis putus-putus jalan bergerak */
        @keyframes kip-road-dash {
            from {
                stroke-dashoffset: 0;
            }

            to {
                stroke-dashoffset: -40;
            }
        }

        /* --- Partikel individual dengan delay berbeda --- */
        .kip-p1 {
            animation: kip-float-up 6.0s 0.0s ease-in infinite;
        }

        .kip-p2 {
            animation: kip-float-up 6.0s 1.2s ease-in infinite;
        }

        .kip-p3 {
            animation: kip-float-up 6.0s 2.5s ease-in infinite;
        }

        .kip-p4 {
            animation: kip-float-up 6.0s 3.8s ease-in infinite;
        }

        .kip-p5 {
            animation: kip-float-up 6.0s 0.7s ease-in infinite;
        }

        .kip-p6 {
            animation: kip-float-up 7.0s 2.1s ease-in infinite;
        }

        .kip-p7 {
            animation: kip-float-up 5.5s 4.3s ease-in infinite;
        }

        .kip-p8 {
            animation: kip-float-up 6.5s 1.6s ease-in infinite;
        }

        /* --- Bintang berkelip --- */
        .kip-s1 {
            animation: kip-twinkle 2.1s 0.0s ease-in-out infinite;
        }

        .kip-s2 {
            animation: kip-twinkle 3.2s 0.5s ease-in-out infinite;
        }

        .kip-s3 {
            animation: kip-twinkle 2.7s 1.1s ease-in-out infinite;
        }

        .kip-s4 {
            animation: kip-twinkle 1.9s 0.3s ease-in-out infinite;
        }

        .kip-s5 {
            animation: kip-twinkle 2.5s 1.8s ease-in-out infinite;
        }

        .kip-s6 {
            animation: kip-twinkle 3.0s 0.9s ease-in-out infinite;
        }

        .kip-s7 {
            animation: kip-twinkle 2.3s 2.2s ease-in-out infinite;
        }

        .kip-s8 {
            animation: kip-twinkle 1.8s 0.6s ease-in-out infinite;
        }

        /* --- Awan --- */
        .kip-cloud1 {
            animation: kip-drift 12s ease-in-out infinite;
        }

        .kip-cloud2 {
            animation: kip-drift 16s 3s ease-in-out infinite;
        }

        .kip-cloud3 {
            animation: kip-drift 10s 6s ease-in-out infinite;
        }

        /* --- Sinar lampu taman --- */
        .kip-beam1 {
            transform-origin: bottom center;
            animation: kip-beam 4.0s 0.0s ease-in-out infinite;
        }

        .kip-beam2 {
            transform-origin: bottom center;
            animation: kip-beam 4.0s 1.4s ease-in-out infinite;
        }

        /* --- Orb lampu --- */
        .kip-orb1 {
            animation: kip-orb-pulse 3.0s 0.0s ease-in-out infinite;
        }

        .kip-orb2 {
            animation: kip-orb-pulse 3.0s 1.5s ease-in-out infinite;
        }

        .kip-orb3 {
            animation: kip-orb-pulse 2.5s 0.8s ease-in-out infinite;
        }

        /* --- Garis jalan --- */
        .kip-road {
            animation: kip-road-dash 1s linear infinite;
        }

        /* --- Branding bawah --- */
        .kip-bottom-brand {
            position: absolute;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 30;
            display: flex;
            align-items: center;
            gap: 6px;
            color: rgba(255, 255, 255, 0.35);
            font-size: 11px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            white-space: nowrap;
            pointer-events: none;
        }

        /* --- Badge header --- */
        .kip-header-badge {
            text-align: center;
            margin-bottom: 1.25rem;
        }

        .kip-header-badge span {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 999px;
            padding: 6px 16px;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        /* --- Ribbon aksen bawah --- */
        .kip-ribbon {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #1e40af, #0ea5e9, #1e40af);
            opacity: 0.85;
        }
    </style>
</head>

<body class="font-sans antialiased">

    <!-- =====================================================
         WRAPPER UTAMA
    ====================================================== -->
    <div class="kip-guest-wrapper">

        <svg class="kip-bg-canvas" viewBox="0 0 1440 900" xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid slice" aria-hidden="true">
            <defs>
                <!-- Gradien langit -->
                <radialGradient id="g-sky" cx="50%" cy="25%" r="70%">
                    <stop offset="0%" stop-color="#1a3a6e" />
                    <stop offset="100%" stop-color="#04080f" />
                </radialGradient>
                <!-- Cahaya bulan -->
                <radialGradient id="g-moon" cx="50%" cy="50%" r="50%">
                    <stop offset="0%" stop-color="#fffbe6" stop-opacity="0.85" />
                    <stop offset="100%" stop-color="#e0c860" stop-opacity="0" />
                </radialGradient>
                <!-- Cahaya lampu taman -->
                <radialGradient id="g-lamp1" cx="50%" cy="50%" r="50%">
                    <stop offset="0%" stop-color="#fde68a" stop-opacity="0.6" />
                    <stop offset="100%" stop-color="#fbbf24" stop-opacity="0" />
                </radialGradient>
                <radialGradient id="g-lamp2" cx="50%" cy="50%" r="50%">
                    <stop offset="0%" stop-color="#fde68a" stop-opacity="0.6" />
                    <stop offset="100%" stop-color="#fbbf24" stop-opacity="0" />
                </radialGradient>
                <!-- Gradien bangunan -->
                <linearGradient id="g-building" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#1e3a6e" />
                    <stop offset="100%" stop-color="#0d1f3c" />
                </linearGradient>
                <!-- Kubah -->
                <linearGradient id="g-dome" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#2563a8" />
                    <stop offset="100%" stop-color="#1a3a6e" />
                </linearGradient>
                <!-- Ribbon bawah -->
                <linearGradient id="g-ribbon" x1="0" y1="0" x2="1" y2="0">
                    <stop offset="0%" stop-color="#1e40af" />
                    <stop offset="50%" stop-color="#0ea5e9" />
                    <stop offset="100%" stop-color="#1e40af" />
                </linearGradient>
                <!-- Tanah -->
                <linearGradient id="g-ground" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#0d2244" />
                    <stop offset="100%" stop-color="#060e1e" />
                </linearGradient>
            </defs>

            <!-- Langit -->
            <rect width="1440" height="900" fill="url(#g-sky)" />

            <!-- Bulan + cahaya -->
            <ellipse cx="1220" cy="130" rx="180" ry="180" fill="url(#g-moon)" opacity="0.45" />
            <circle cx="1220" cy="130" r="64" fill="#fffbe6" opacity="0.95" />
            <circle cx="1220" cy="130" r="54" fill="#fef9c3" />
            <circle cx="1195" cy="112" r="14" fill="#fffbe6" opacity="0.25" />
            <circle cx="1235" cy="148" r="9" fill="#fffbe6" opacity="0.2" />

            <!-- Bintang -->
            <circle cx="90" cy="70" r="2.5" fill="#e0e7ff" class="kip-s1" />
            <circle cx="210" cy="45" r="1.8" fill="#bfdbfe" class="kip-s2" />
            <circle cx="360" cy="90" r="3" fill="#e0e7ff" class="kip-s3" />
            <circle cx="510" cy="35" r="2" fill="#fef9c3" class="kip-s4" />
            <circle cx="700" cy="58" r="1.8" fill="#bfdbfe" class="kip-s5" />
            <circle cx="820" cy="92" r="3" fill="#e0e7ff" class="kip-s6" />
            <circle cx="960" cy="48" r="2" fill="#fef9c3" class="kip-s7" />
            <circle cx="1080" cy="75" r="2.5" fill="#bfdbfe" class="kip-s8" />
            <circle cx="280" cy="130" r="1.5" fill="#e0e7ff" opacity="0.5" />
            <circle cx="640" cy="100" r="2" fill="#bfdbfe" opacity="0.5" />
            <circle cx="1350" cy="80" r="1.8" fill="#fef9c3" opacity="0.5" />

            <!-- Awan tipis -->
            <g class="kip-cloud1" opacity="0.1">
                <ellipse cx="200" cy="168" rx="100" ry="24" fill="#93c5fd" />
                <ellipse cx="170" cy="156" rx="56" ry="20" fill="#bfdbfe" />
                <ellipse cx="235" cy="160" rx="44" ry="18" fill="#bfdbfe" />
            </g>
            <g class="kip-cloud2" opacity="0.08">
                <ellipse cx="900" cy="142" rx="120" ry="28" fill="#93c5fd" />
                <ellipse cx="865" cy="130" rx="60" ry="22" fill="#bfdbfe" />
                <ellipse cx="940" cy="134" rx="50" ry="20" fill="#bfdbfe" />
            </g>
            <g class="kip-cloud3" opacity="0.09">
                <ellipse cx="600" cy="195" rx="90" ry="22" fill="#93c5fd" />
                <ellipse cx="572" cy="184" rx="48" ry="18" fill="#bfdbfe" />
                <ellipse cx="628" cy="187" rx="40" ry="16" fill="#bfdbfe" />
            </g>

            <!-- Silhouette kota (belakang) -->
            <rect x="0" y="600" width="1440" height="300" fill="url(#g-ground)" />
            <rect x="0" y="540" width="1440" height="70" fill="#071325" opacity="0.85" />

            <!-- ============================================
                 GEDUNG UTAMA (Tengah) — Gedung Rektorat
            ============================================ -->
            <rect x="560" y="440" width="320" height="160" fill="url(#g-building)" />
            <!-- Kolom pillar -->
            <rect x="575" y="440" width="14" height="160" fill="#1e3a6e" opacity="0.5" />
            <rect x="605" y="440" width="14" height="160" fill="#1e3a6e" opacity="0.5" />
            <rect x="635" y="440" width="14" height="160" fill="#1e3a6e" opacity="0.5" />
            <rect x="665" y="440" width="14" height="160" fill="#1e3a6e" opacity="0.5" />
            <rect x="695" y="440" width="14" height="160" fill="#1e3a6e" opacity="0.5" />
            <rect x="725" y="440" width="14" height="160" fill="#1e3a6e" opacity="0.5" />
            <rect x="755" y="440" width="14" height="160" fill="#1e3a6e" opacity="0.5" />
            <rect x="785" y="440" width="14" height="160" fill="#1e3a6e" opacity="0.5" />
            <rect x="815" y="440" width="14" height="160" fill="#1e3a6e" opacity="0.5" />
            <rect x="845" y="440" width="14" height="160" fill="#1e3a6e" opacity="0.5" />
            <!-- Atap segitiga -->
            <polygon points="540,440 720,355 900,440" fill="#142545" />
            <!-- Menara kiri -->
            <rect x="570" y="370" width="12" height="70" fill="#1e3a6e" />
            <rect x="610" y="350" width="12" height="90" fill="#1e3a6e" />
            <!-- Menara kanan -->
            <rect x="855" y="375" width="12" height="65" fill="#1e3a6e" />
            <rect x="820" y="355" width="12" height="85" fill="#1e3a6e" />
            <!-- Tiang bendera tengah -->
            <rect x="717" y="310" width="6" height="130" fill="#1e3a6e" />
            <rect x="716" y="304" width="6" height="12" fill="#dc2626" opacity="0.85" />
            <!-- Kubah -->
            <ellipse cx="720" cy="378" rx="70" ry="32" fill="url(#g-dome)" />
            <ellipse cx="720" cy="374" rx="50" ry="22" fill="#2563a8" opacity="0.8" />
            <!-- Pintu -->
            <rect x="690" y="540" width="60" height="60" fill="#0f2a4e" />
            <!-- Jendela baris atas -->
            <rect x="580" y="460" width="20" height="30" fill="#1e4080" rx="2" />
            <rect x="615" y="460" width="20" height="30" fill="#1a4080" rx="2" />
            <rect x="650" y="460" width="20" height="30" fill="#1e4080" rx="2" />
            <rect x="755" y="460" width="20" height="30" fill="#1e4080" rx="2" />
            <rect x="790" y="460" width="20" height="30" fill="#1a4080" rx="2" />
            <rect x="825" y="460" width="20" height="30" fill="#1e4080" rx="2" />
            <!-- Jendela baris bawah -->
            <rect x="580" y="504" width="20" height="28" fill="#1a4080" rx="2" />
            <rect x="615" y="504" width="20" height="28" fill="#1e4080" rx="2" />
            <rect x="650" y="504" width="20" height="28" fill="#1a4080" rx="2" />
            <rect x="755" y="504" width="20" height="28" fill="#1a4080" rx="2" />
            <rect x="790" y="504" width="20" height="28" fill="#1e4080" rx="2" />
            <rect x="825" y="504" width="20" height="28" fill="#1a4080" rx="2" />

            <!-- ============================================
                 GEDUNG KIRI — Gedung Kuliah / Aula
            ============================================ -->
            <rect x="260" y="470" width="260" height="130" fill="url(#g-building)" />
            <polygon points="240,470 390,400 520,470" fill="#142545" />
            <!-- Kolom -->
            <rect x="275" y="470" width="10" height="130" fill="#1e3a6e" opacity="0.4" />
            <rect x="300" y="470" width="10" height="130" fill="#1e3a6e" opacity="0.4" />
            <rect x="325" y="470" width="10" height="130" fill="#1e3a6e" opacity="0.4" />
            <rect x="350" y="470" width="10" height="130" fill="#1e3a6e" opacity="0.4" />
            <rect x="375" y="470" width="10" height="130" fill="#1e3a6e" opacity="0.4" />
            <rect x="400" y="470" width="10" height="130" fill="#1e3a6e" opacity="0.4" />
            <rect x="425" y="470" width="10" height="130" fill="#1e3a6e" opacity="0.4" />
            <rect x="450" y="470" width="10" height="130" fill="#1e3a6e" opacity="0.4" />
            <rect x="475" y="470" width="10" height="130" fill="#1e3a6e" opacity="0.4" />
            <!-- Kubah kecil -->
            <ellipse cx="390" cy="460" rx="60" ry="22" fill="url(#g-dome)" />
            <!-- Jendela -->
            <rect x="272" y="490" width="18" height="26" fill="#1a4080" rx="2" />
            <rect x="302" y="490" width="18" height="26" fill="#1a4080" rx="2" />
            <rect x="332" y="490" width="18" height="26" fill="#1a4080" rx="2" />
            <rect x="438" y="490" width="18" height="26" fill="#1a4080" rx="2" />
            <rect x="468" y="490" width="18" height="26" fill="#1a4080" rx="2" />
            <rect x="498" y="490" width="18" height="26" fill="#1a4080" rx="2" />
            <!-- Pintu kiri -->
            <rect x="372" y="548" width="36" height="52" fill="#0f2a4e" />

            <!-- ============================================
                 GEDUNG KANAN — Perpustakaan
            ============================================ -->
            <rect x="930" y="468" width="250" height="132" fill="url(#g-building)" />
            <polygon points="910,468 1055,392 1200,468" fill="#142545" />
            <rect x="945" y="468" width="10" height="132" fill="#1e3a6e" opacity="0.35" />
            <rect x="970" y="468" width="10" height="132" fill="#1e3a6e" opacity="0.35" />
            <rect x="995" y="468" width="10" height="132" fill="#1e3a6e" opacity="0.35" />
            <rect x="1020" y="468" width="10" height="132" fill="#1e3a6e" opacity="0.35" />
            <rect x="1045" y="468" width="10" height="132" fill="#1e3a6e" opacity="0.35" />
            <rect x="1070" y="468" width="10" height="132" fill="#1e3a6e" opacity="0.35" />
            <rect x="1095" y="468" width="10" height="132" fill="#1e3a6e" opacity="0.35" />
            <rect x="1120" y="468" width="10" height="132" fill="#1e3a6e" opacity="0.35" />
            <rect x="1145" y="468" width="10" height="132" fill="#1e3a6e" opacity="0.35" />
            <rect x="1163" y="468" width="10" height="132" fill="#1e3a6e" opacity="0.35" />
            <ellipse cx="1055" cy="456" rx="60" ry="22" fill="url(#g-dome)" />
            <rect x="948" y="488" width="18" height="26" fill="#1a4080" rx="2" />
            <rect x="978" y="488" width="18" height="26" fill="#1a4080" rx="2" />
            <rect x="1008" y="488" width="18" height="26" fill="#1a4080" rx="2" />
            <rect x="1110" y="488" width="18" height="26" fill="#1a4080" rx="2" />
            <rect x="1140" y="488" width="18" height="26" fill="#1a4080" rx="2" />
            <rect x="1168" y="488" width="18" height="26" fill="#1a4080" rx="2" />
            <rect x="1037" y="546" width="36" height="54" fill="#0f2a4e" />

            <!-- Gedung kecil paling kiri -->
            <rect x="60" y="500" width="168" height="100" fill="#0d2040" />
            <polygon points="48,500 144,460 240,500" fill="#112038" />
            <rect x="75" y="500" width="9" height="100" fill="#1e3a6e" opacity="0.3" />
            <rect x="96" y="500" width="9" height="100" fill="#1e3a6e" opacity="0.3" />
            <rect x="117" y="500" width="9" height="100" fill="#1e3a6e" opacity="0.3" />
            <rect x="138" y="500" width="9" height="100" fill="#1e3a6e" opacity="0.3" />
            <rect x="159" y="500" width="9" height="100" fill="#1e3a6e" opacity="0.3" />
            <rect x="180" y="500" width="9" height="100" fill="#1e3a6e" opacity="0.3" />
            <rect x="201" y="500" width="9" height="100" fill="#1e3a6e" opacity="0.3" />
            <rect x="103" y="530" width="22" height="70" fill="#112038" />

            <!-- Gedung kecil paling kanan -->
            <rect x="1212" y="495" width="180" height="105" fill="#0d2040" />
            <polygon points="1200,495 1302,452 1404,495" fill="#112038" />
            <rect x="1226" y="495" width="9" height="105" fill="#1e3a6e" opacity="0.3" />
            <rect x="1248" y="495" width="9" height="105" fill="#1e3a6e" opacity="0.3" />
            <rect x="1270" y="495" width="9" height="105" fill="#1e3a6e" opacity="0.3" />
            <rect x="1292" y="495" width="9" height="105" fill="#1e3a6e" opacity="0.3" />
            <rect x="1314" y="495" width="9" height="105" fill="#1e3a6e" opacity="0.3" />
            <rect x="1336" y="495" width="9" height="105" fill="#1e3a6e" opacity="0.3" />
            <rect x="1358" y="495" width="9" height="105" fill="#1e3a6e" opacity="0.3" />
            <rect x="1285" y="524" width="22" height="76" fill="#112038" />

            <!-- ============================================
                 JALAN & TROTOAR
            ============================================ -->
            <rect x="0" y="600" width="1440" height="15" fill="#0b1e3d" />
            <line x1="0" y1="608" x2="1440" y2="608" stroke="#1e3a6e"
                stroke-width="2.5" />
            <!-- Garis putus-putus jalan bergerak -->
            <line x1="0" y1="608" x2="1440" y2="608" stroke="#fbbf24" stroke-width="1.2"
                stroke-dasharray="28 28" class="kip-road" opacity="0.3" />

            <!-- Cahaya lampu taman kiri -->
            <ellipse cx="320" cy="600" rx="80" ry="12" fill="url(#g-lamp1)"
                opacity="0.8" />
            <!-- Sinar lampu kiri -->
            <polygon class="kip-beam1" points="312,558 328,558 368,602 272,602" fill="#fde68a" opacity="0.08" />
            <!-- Tiang lampu kiri -->
            <line x1="320" y1="558" x2="320" y2="605" stroke="#334155"
                stroke-width="3.5" />
            <circle cx="320" cy="554" r="9" fill="#fbbf24" class="kip-orb1" />

            <!-- Cahaya lampu taman kanan -->
            <ellipse cx="1120" cy="600" rx="80" ry="12" fill="url(#g-lamp2)"
                opacity="0.8" />
            <!-- Sinar lampu kanan -->
            <polygon class="kip-beam2" points="1112,558 1128,558 1168,602 1072,602" fill="#fde68a" opacity="0.08" />
            <!-- Tiang lampu kanan -->
            <line x1="1120" y1="558" x2="1120" y2="605" stroke="#334155"
                stroke-width="3.5" />
            <circle cx="1120" cy="554" r="9" fill="#fbbf24" class="kip-orb2" />

            <!-- Pohon silhouette kiri -->
            <ellipse cx="195" cy="572" rx="28" ry="38" fill="#071a2e" opacity="0.9" />
            <ellipse cx="220" cy="568" rx="22" ry="30" fill="#061628" opacity="0.9" />
            <rect x="210" y="590" width="6" height="18" fill="#050f1e" />
            <rect x="188" y="585" width="6" height="22" fill="#050f1e" />

            <!-- Pohon silhouette kanan -->
            <ellipse cx="1244" cy="572" rx="28" ry="38" fill="#071a2e" opacity="0.9" />
            <ellipse cx="1220" cy="568" rx="22" ry="30" fill="#061628" opacity="0.9" />
            <rect x="1238" y="590" width="6" height="18" fill="#050f1e" />
            <rect x="1216" y="585" width="6" height="22" fill="#050f1e" />

            <!-- ============================================
                 TANAH / HALAMAN KAMPUS
            ============================================ -->
            <rect x="0" y="615" width="1440" height="285" fill="#060d1c" />

            <!-- ============================================
                 PARTIKEL MENGAMBANG (beasiswa, cahaya harapan)
            ============================================ -->
            <circle cx="180" cy="590" r="4.5" fill="#60a5fa" class="kip-p1" opacity="0.75" />
            <circle cx="400" cy="610" r="3.5" fill="#a78bfa" class="kip-p2" opacity="0.65" />
            <circle cx="680" cy="596" r="5" fill="#fbbf24" class="kip-p3" opacity="0.7" />
            <circle cx="920" cy="605" r="3" fill="#34d399" class="kip-p4" opacity="0.7" />
            <circle cx="1150" cy="590" r="4.5" fill="#60a5fa" class="kip-p5" opacity="0.65" />
            <circle cx="1330" cy="610" r="3.5" fill="#fbbf24" class="kip-p6" opacity="0.7" />
            <circle cx="290" cy="603" r="3" fill="#f472b6" class="kip-p7" opacity="0.55" />
            <circle cx="1050" cy="598" r="4" fill="#a78bfa" class="kip-p8" opacity="0.65" />

            <!-- Orb aksen -->
            <circle cx="130" cy="572" r="5" fill="#fbbf24" class="kip-orb1" opacity="0.65" />
            <circle cx="720" cy="560" r="7" fill="#60a5fa" class="kip-orb3" opacity="0.6" />
            <circle cx="1310" cy="568" r="5" fill="#34d399" class="kip-orb2" opacity="0.55" />

            <!-- Ribbon bawah -->
            <rect x="0" y="895" width="1440" height="5" fill="url(#g-ribbon)" opacity="0.9" />
        </svg>
        <!-- END SVG BACKGROUND -->

        <!-- ===================================================
             SLOT KONTEN (form login/register disuntikkan di sini)
        =================================================== -->
        <div class="kip-card-container">
            {{ $slot }}
        </div>

        <!-- ===================================================
             BRANDING BAWAH
        =================================================== -->
        <div
            class="kip-bottom-brand flex flex-col md:flex-row items-center justify-between gap-y-2 gap-x-4 py-4 text-center md:text-left">
            <span class="text-xs sm:text-sm lg:text-base font-medium text-slate-500 tracking-tight">
                © {{ date('Y') }} <span class="font-bold text-slate-700 bg-clip-text">Sistem Penerimaan KIP
                    Kuliah</span>. All rights reserved - Designed by | r1z4ld1 👨‍💻
            </span>

        </div>

        <!-- Ribbon dekoratif bawah -->
        <div class="kip-ribbon"></div>

    </div>
    <!-- END WRAPPER -->

</body>

</html>
