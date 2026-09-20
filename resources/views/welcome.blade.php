<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Undangan Pernikahan Astri & Ridho – 23 Oktober 2026</title>
    <meta name="description" content="Dengan memohon rahmat & ridho Allah SWT, kami mengundang Anda untuk hadir di pernikahan Sulastri & Ridho Iriano Sudarmazena.">

    {{-- Preconnect fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Sembunyikan browser scrollbar agar tidak ada pergeseran layout */
        html, body {
            scrollbar-width: none !important;
            -ms-overflow-style: none !important;
        }
        html::-webkit-scrollbar,
        body::-webkit-scrollbar,
        *::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        @media (min-width: 768px) {
            /* Paksa cover overlay hanya 390px di sisi kanan, overflow terpotong */
            #cover-overlay {
                left: auto !important;
                right: 0 !important;
                width: 390px !important;
                overflow: hidden !important;
                align-items: center !important;
                box-shadow: -4px 0 25px rgba(0, 0, 0, 0.08);
            }
            /* Reset ornamen header — sudah relatif terhadap overlay 390px */
            #cover-header-ornament {
                left: 0 !important;
                right: 0 !important;
                width: 100% !important;
            }
            /* Main scroll content: 390px flush kanan */
            #main-content {
                max-width: 390px !important;
                margin-right: 0 !important;
                margin-left: auto !important;
                box-shadow: -4px 0 25px rgba(0, 0, 0, 0.08);
                position: relative !important;
                z-index: 40 !important;
                background-color: #FFFCF7 !important;
            }
            /* Border bunga pembatas di tumpukan paling atas (di atas cover & main content) */
            #desktop-seam-border {
                z-index: 100 !important;
            }
        }

        /* ── Desktop Delman Infinite Walk Loop ──────────────── */
        @keyframes delmanWalkLoop {
            0% {
                transform: translateX(0);
                opacity: 1;
            }
            12% {
                transform: translateX(0);
                opacity: 1;
            }
            76% {
                transform: translateX(calc(50vw + 500px));
                opacity: 1;
            }
            76.01% {
                transform: translateX(calc(50vw + 500px));
                opacity: 0;
            }
            76.5% {
                transform: translateX(0);
                opacity: 0;
            }
            84% {
                transform: translateX(0);
                opacity: 1;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes carriageTrot {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-2.5px);
            }
        }

        .anim-delman-loop {
            animation: delmanWalkLoop 14s cubic-bezier(0.28, 0, 0.22, 1) infinite;
        }

        .anim-carriage-trot {
            animation: carriageTrot 0.7s ease-in-out infinite;
        }
    </style>
</head>

<body class="overflow-x-hidden overflow-hidden" style="background-color:#FFFCF7;" @if(isset($guest) && $guest) data-guest-id="{{ $guest->id }}" @endif>

{{-- ════════════════════════════════════════════════════
     LOADING SCREEN OVERLAY (Delay 2 Detik)
     ════════════════════════════════════════════════════ --}}
<div id="loading-screen" class="fixed inset-0 z-[9999] flex flex-col items-center justify-center transition-opacity duration-700 pointer-events-auto"
     style="background-color: #FFFCF7; background-image: url('{{ asset('assets-website/batik_background.svg') }}'); background-repeat: repeat; background-size: 320px auto;">
    
    {{-- Glow Halo Background --}}
    <div class="absolute pointer-events-none"
         style="width: 320px; height: 320px; border-radius: 9999px; background: radial-gradient(circle, rgba(218, 191, 143, 0.45) 0%, rgba(255,252,247,0) 70%); filter: blur(24px);"></div>

    <div class="relative z-10 flex flex-col items-center text-center px-6">
        {{-- Elegant Spinning Ring / Floral Pulse --}}
        <div class="relative w-20 h-20 mb-6 flex items-center justify-center">
            {{-- Outer Spinning Border --}}
            <div class="absolute inset-0 rounded-full border-2 border-t-[#84683A] border-r-transparent border-b-[#DABF8F] border-l-transparent animate-spin" style="animation-duration: 2s;"></div>
            {{-- Inner Pulsing Ring --}}
            <div class="w-14 h-14 rounded-full border border-[#84683A]/30 flex items-center justify-center bg-[#FFFCF7]/90 shadow-xs">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#84683A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="animate-pulse">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
            </div>
        </div>

        {{-- Subtitle Header --}}
        <p class="uppercase tracking-[0.25em] text-[10px] text-[#84683A] font-bold mb-1" style="font-family:'Cinzel',serif;">
            WEDDING INVITATION
        </p>

        {{-- Nama Mempelai --}}
        <h1 class="text-4xl sm:text-5xl text-[#362B24] mb-3" style="font-family:'Great Vibes',cursive; text-shadow: 0 1px 2px rgba(255,255,255,0.8);">
            Astri &amp; Ridho
        </h1>

        {{-- Animated Loading Text & Dots --}}
        <div class="flex items-center gap-1.5 text-xs text-[#6B4D38] font-medium" style="font-family:'Playfair Display',serif; font-style: italic;">
            <span>Memuat Undangan</span>
            <span class="inline-flex gap-0.5">
                <span class="animate-bounce" style="animation-delay: 0s;">.</span>
                <span class="animate-bounce" style="animation-delay: 0.15s;">.</span>
                <span class="animate-bounce" style="animation-delay: 0.3s;">.</span>
            </span>
        </div>
    </div>
</div>


{{-- ════════════════════════════════════════════════════
     DESKTOP LEFT PANEL (Sampul / Cover Panel Kiri)
     Aktif hanya pada tampilan desktop (≥ 768px)
     ════════════════════════════════════════════════════ --}}
<div id="desktop-left-panel" class="hidden md:block fixed top-0 left-0 bottom-0 pointer-events-none z-20" style="width: calc(100vw - 390px); overflow: hidden;">

    {{-- Latar Belakang Krem Keemasan Hangat --}}
    <div class="absolute inset-0" style="background: linear-gradient(135deg, #c5a774 0%, #dabf8f 35%, #ebdab7 70%, #f6ebe0 100%);"></div>

    {{-- Tekstur Batik Kawung Halus / Transparan --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background-image: url('{{ asset('assets-website/batik_background.svg') }}'); background-repeat: repeat; background-size: 320px auto; opacity: 1; mix-blend-mode: multiply;"></div>

    {{-- Cahaya / Halo Lembut di Tengah Panel --}}
    <div class="absolute pointer-events-none"
         style="width: 540px; height: 540px; border-radius: 9999px; background: radial-gradient(circle, rgba(255,255,255,0.45) 0%, rgba(255,255,255,0) 70%); top: 50%; left: 50%; transform: translate(-50%, -50%); filter: blur(28px);"></div>

    {{-- 3 Garis Terputus Desktop (Atas, Kiri, Bawah) Tebal 3px dengan Ujung Rounded --}}
    {{-- Garis Atas --}}
    <div class="absolute pointer-events-none rounded-full"
         style="top: 26px; left: 135px; right: 36px; height: 3px; background-color: rgba(255, 255, 255, 0.82); box-shadow: 0 1px 2px rgba(132, 104, 58, 0.25); z-index: 10;"></div>

    {{-- Garis Kiri --}}
    <div class="absolute pointer-events-none rounded-full"
         style="left: 26px; top: 135px; bottom: 135px; width: 3px; background-color: rgba(255, 255, 255, 0.82); box-shadow: 0 1px 2px rgba(132, 104, 58, 0.25); z-index: 10;"></div>

    {{-- Garis Bawah --}}
    <div class="absolute pointer-events-none rounded-full"
         style="bottom: 26px; left: 135px; right: 36px; height: 3px; background-color: rgba(255, 255, 255, 0.82); box-shadow: 0 1px 2px rgba(132, 104, 58, 0.25); z-index: 10;"></div>

    {{-- Aksen Sudut Bunga Melati Putih & Daun Tropis (Pojok Kiri Atas) --}}
    <div class="absolute pointer-events-none z-20" style="top: 14px; left: 14px; width: 115px; height: 115px;">
        <img src="{{ asset('assets-website/tepiandekstop-tight.png') }}" class="w-full h-full object-contain" alt="ornamen pojok kiri atas">
    </div>

    {{-- Aksen Sudut Bunga Melati Putih & Daun Tropis (Pojok Kiri Bawah) --}}
    <div class="absolute pointer-events-none z-20" style="bottom: 14px; left: 14px; width: 115px; height: 115px;">
        <img src="{{ asset('assets-website/tepiandekstop-tight.png') }}" class="w-full h-full object-contain" style="transform: scaleY(-1);" alt="ornamen pojok kiri bawah">
    </div>

</div>

{{-- Pembatas Vertikal Border Bunga Antara Kiri dan Kanan (Tumpukan Teratas / z-index: 100) --}}
<div id="desktop-seam-border" class="hidden md:block fixed top-0 bottom-0 pointer-events-none"
     style="right: 390px; width: 36px; transform: translateX(50%); z-index: 100; background-image: url('{{ asset('assets-website/border-bunga-vertical.png') }}'); background-repeat: repeat-y; background-size: 36px auto; filter: drop-shadow(0 0 3px rgba(0,0,0,0.15));"></div>

{{-- ════════════════════════════════════════════════════
     ELEMEN BERGERAK DESKTOP: DELMAN & TEKS (INFINITE LOOP)
     Bergerak dari tengah panel kiri dan terpotong rapi di batas
     panel kiri (overflow: hidden), tidak pernah muncul di section kanan.
     ════════════════════════════════════════════════════ --}}
<div id="desktop-delman-container" class="hidden md:flex fixed top-0 left-0 bottom-0 pointer-events-none items-center justify-center z-20" style="width: calc(100vw - 390px); overflow: hidden;">
    <div class="anim-delman-loop flex flex-col items-center text-center select-none" style="width: 380px;">
        {{-- Teks "The Wedding of" --}}
        <p class="mb-1" style="font-family:'Alex Brush',cursive; font-size:34px; color:#84683A; text-shadow: 0 1px 2px rgba(255,255,255,0.85); line-height: 1.2;">
            The Wedding of
        </p>

        {{-- Ilustrasi Delman Tradisional Jawa --}}
        <div class="relative w-full flex justify-center my-2">
            <img src="{{ asset('assets-website/delman-cropped.png') }}"
                 class="w-[320px] lg:w-[350px] h-auto object-contain anim-carriage-trot drop-shadow-md"
                 alt="Kereta Kuda Delman Astri & Ridho">
        </div>

        {{-- Teks "Astri & Ridho" --}}
        <h2 class="mt-1" style="font-family:'Great Vibes',cursive; font-size:52px; color:#362B24; text-shadow: 0 1px 2px rgba(255,255,255,0.85); line-height: 1.15;">
            Astri &amp; Ridho
        </h2>
    </div>
</div>

{{-- ════════════════════════════════════════════════════
     COVER OVERLAY (Section 1 – Hero)
     Ditampilkan fullscreen sebelum tamu klik "Buka Undangan"
     ════════════════════════════════════════════════════ --}}
<div id="cover-overlay" class="fixed inset-0 z-50 flex flex-col items-center justify-center overflow-hidden"
     style="background-color:#FFFCF7; background-image: url('{{ asset('assets-website/landing-page/background-landing.svg') }}'); background-size: cover; background-position: center;">

    <style>
        @keyframes fadeInDownLanding {
            from {
                opacity: 0;
                transform: translateY(-24px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeInUpLanding {
            from {
                opacity: 0;
                transform: translateY(28px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        /* Entrance: Menjalar masuk dari tepi */
        @keyframes creepInTL {
            0% {
                opacity: 0;
                transform: translate(-40px, -30px) scale(0.8) rotate(-10deg);
            }
            70% {
                opacity: 1;
                transform: translate(2px, 2px) scale(1.02) rotate(1deg);
            }
            100% {
                opacity: 1;
                transform: translate(0, 0) scale(1) rotate(0deg);
            }
        }
        @keyframes creepInBL {
            0% {
                opacity: 0;
                transform: translate(-40px, 30px) scale(0.8) rotate(10deg);
            }
            70% {
                opacity: 1;
                transform: translate(2px, -2px) scale(1.02) rotate(-1deg);
            }
            100% {
                opacity: 1;
                transform: translate(0, 0) scale(1) rotate(0deg);
            }
        }
        @keyframes creepInTR {
            0% {
                opacity: 0;
                transform: translate(40px, -30px) scale(0.8) rotate(10deg);
            }
            70% {
                opacity: 1;
                transform: translate(-2px, 2px) scale(1.02) rotate(-1deg);
            }
            100% {
                opacity: 1;
                transform: translate(0, 0) scale(1) rotate(0deg);
            }
        }
        @keyframes creepInBR {
            0% {
                opacity: 0;
                transform: translate(40px, 30px) scale(0.8) rotate(-10deg);
            }
            70% {
                opacity: 1;
                transform: translate(-2px, -2px) scale(1.02) rotate(1deg);
            }
            100% {
                opacity: 1;
                transform: translate(0, 0) scale(1) rotate(0deg);
            }
        }

        /* Continuous: Efek tertiup angin sepoi-sepoi */
        @keyframes windSwayLeft {
            0%, 100% {
                transform: rotate(0deg) translate(0, 0);
            }
            35% {
                transform: rotate(2.5deg) translate(1px, -1.5px);
            }
            70% {
                transform: rotate(-2deg) translate(-1px, 1px);
            }
        }
        @keyframes windSwayRight {
            0%, 100% {
                transform: rotate(0deg) translate(0, 0);
            }
            35% {
                transform: rotate(-2.5deg) translate(-1px, -1.5px);
            }
            70% {
                transform: rotate(2deg) translate(1px, 1px);
            }
        }

        /* Delay animation entrance until cover-overlay is-loaded is added by JS after loading screen */
        #cover-overlay .anim-pengantin-landing,
        #cover-overlay .anim-creep-tl,
        #cover-overlay .anim-creep-bl,
        #cover-overlay .anim-creep-tr,
        #cover-overlay .anim-creep-br,
        #cover-overlay .anim-fade-card {
            animation-play-state: paused;
        }

        #cover-overlay.is-loaded .anim-pengantin-landing,
        #cover-overlay.is-loaded .anim-creep-tl,
        #cover-overlay.is-loaded .anim-creep-bl,
        #cover-overlay.is-loaded .anim-creep-tr,
        #cover-overlay.is-loaded .anim-creep-br,
        #cover-overlay.is-loaded .anim-fade-card {
            animation-play-state: running;
        }

        .anim-pengantin-landing {
            opacity: 0;
            animation: fadeInUpLanding 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.25s forwards;
        }

        /* Container creeping entrance */
        .anim-creep-tl {
            opacity: 0;
            animation: creepInTL 1.4s cubic-bezier(0.22, 1, 0.36, 1) 0.35s forwards;
        }
        .anim-creep-bl {
            opacity: 0;
            animation: creepInBL 1.4s cubic-bezier(0.22, 1, 0.36, 1) 0.45s forwards;
        }
        .anim-creep-tr {
            opacity: 0;
            animation: creepInTR 1.4s cubic-bezier(0.22, 1, 0.36, 1) 0.4s forwards;
        }
        .anim-creep-br {
            opacity: 0;
            animation: creepInBR 1.4s cubic-bezier(0.22, 1, 0.36, 1) 0.5s forwards;
        }

        /* Inner image wind sway loop */
        .sway-wind-left {
            transform-origin: bottom left;
            animation: windSwayLeft 5.5s ease-in-out infinite 1.8s;
        }
        .sway-wind-bl {
            transform-origin: top left;
            animation: windSwayLeft 6s ease-in-out infinite 1.9s;
        }
        .sway-wind-right {
            transform-origin: bottom right;
            animation: windSwayRight 5.8s ease-in-out infinite 1.8s;
        }
        .sway-wind-br {
            transform-origin: top right;
            animation: windSwayRight 6.2s ease-in-out infinite 2s;
        }

        .anim-fade-card {
            opacity: 0;
            animation: fadeInUpLanding 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.6s forwards;
        }

        /* Floating / Hovering effect untuk corner tamu */
        @keyframes floatCornerTL {
            0%, 100% {
                transform: translate(0, 0);
            }
            50% {
                transform: translate(-2px, -3px);
            }
        }
        @keyframes floatCornerBR {
            0%, 100% {
                transform: translate(0, 0);
            }
            50% {
                transform: translate(2px, 3px);
            }
        }
        .anim-float-corner-tl {
            animation: floatCornerTL 4s ease-in-out infinite;
        }
        .anim-float-corner-br {
            animation: floatCornerBR 4s ease-in-out infinite 0.5s;
        }
    </style>

    {{-- Konten utama cover (Frame 412px) --}}
    <div class="relative z-10 flex flex-col items-center justify-between w-full max-w-[412px] h-full min-h-[100dvh] max-h-[773px] px-5 py-4 text-center overflow-hidden">

        {{-- Halo light blur --}}
        <div class="absolute pointer-events-none" style="width:288px;height:288px;background:rgba(212,181,128,0.22);filter:blur(32px);border-radius:9999px;top:45%;left:50%;transform:translate(-50%,-50%);z-index:0;"></div>

        {{-- ── FOLIAGE SUDUT KIRI ATAS ── --}}
        <div class="absolute top-0 left-0 pointer-events-none anim-creep-tl" style="z-index: 5; width: 110px; height: 180px;">
            <img src="{{ asset('assets-website/landing-page/daun-landing-kiri-atas-atas.svg') }}"
                 class="absolute top-0 left-0 w-[78px] h-auto object-contain sway-wind-left" alt="daun kiri atas">
            <img src="{{ asset('assets-website/landing-page/daun-landing-kiri-atas-bawah.svg') }}"
                 class="absolute top-[20px] left-0 w-[96px] h-auto object-contain sway-wind-left" alt="daun kiri atas bawah">
            <img src="{{ asset('assets-website/landing-page/bunga-landing-kiri-atas.svg') }}"
                 class="absolute top-[68px] left-[38px] w-[42px] h-auto object-contain sway-wind-left drop-shadow-sm" alt="bunga kiri atas">
        </div>

        {{-- ── FOLIAGE SUDUT KANAN ATAS ── --}}
        <div class="absolute top-0 right-0 pointer-events-none anim-creep-tr" style="z-index: 5; width: 125px; height: 160px;">
            <img src="{{ asset('assets-website/landing-page/daun-landing-kanan-atas-atas.svg') }}"
                 class="absolute top-0 right-0 w-[114px] h-auto object-contain sway-wind-right" alt="daun kanan atas">
            <img src="{{ asset('assets-website/landing-page/daun-landing-kanan-atas-bawah.svg') }}"
                 class="absolute top-[18px] right-0 w-[98px] h-auto object-contain sway-wind-right" alt="daun kanan atas bawah">
            <img src="{{ asset('assets-website/landing-page/bunga-landing-kanan-atas.svg') }}"
                 class="absolute top-[62px] right-[32px] w-[46px] h-auto object-contain sway-wind-right drop-shadow-sm" alt="bunga kanan atas">
        </div>

        {{-- ── ILUSTRASI PENGANTIN ── --}}
        <div class="relative z-10 w-full flex justify-center pt-2 anim-pengantin-landing">
            <div class="flex justify-center" style="width: 204px;">
                <img src="{{ asset('assets-website/landing-page/pengantin-landing-new.svg') }}"
                     class="w-full h-auto object-contain drop-shadow-sm" alt="pengantin">
            </div>
        </div>

        {{-- ── TITLE AREA (FLANKED BY MID FOLIAGE) ── --}}
        <div class="relative z-10 w-full flex flex-col items-center my-0 py-0" style="overflow: visible;">
            {{-- Foliage Samping Kiri --}}
            <div class="absolute pointer-events-none anim-creep-bl" style="top: -45px; left: -20px; width: 115px; z-index: 5;">
                <img src="{{ asset('assets-website/landing-page/daun-landing-kiri-bawah-atas.svg') }}"
                     class="absolute top-0 left-0 w-[110px] h-auto object-contain sway-wind-bl" alt="daun kiri tengah atas">
                <img src="{{ asset('assets-website/landing-page/daun-landing-kiri-bawah-bawah.svg') }}"
                     class="absolute top-[80px] left-0 w-[78px] h-auto object-contain sway-wind-bl" alt="daun kiri tengah bawah">
                <img src="{{ asset('assets-website/landing-page/bunga-landing-kiri-atas.svg') }}"
                     class="absolute top-[8px] left-[34px] w-[40px] h-auto object-contain sway-wind-left drop-shadow-sm" alt="bunga kiri tengah">
            </div>

            {{-- Foliage Samping Kanan --}}
            <div class="absolute pointer-events-none anim-creep-br" style="top: -40px; right: -20px; width: 120px; z-index: 5;">
                <img src="{{ asset('assets-website/landing-page/daun-landing-kanan-bawah-atas.svg') }}"
                     class="absolute top-0 right-0 w-[96px] h-auto object-contain sway-wind-br" alt="daun kanan tengah atas">
                <img src="{{ asset('assets-website/landing-page/daun-landing-kanan-bawah-bawah.svg') }}"
                     class="absolute top-[75px] right-0 w-[115px] h-auto object-contain sway-wind-br" alt="daun kanan tengah bawah">
                <img src="{{ asset('assets-website/landing-page/bunga-landing-kanan-atas.svg') }}"
                     class="absolute top-[22px] right-[32px] w-[46px] h-auto object-contain sway-wind-right drop-shadow-sm" alt="bunga kanan tengah">
            </div>

            {{-- "The Wedding of" --}}
            <p class="relative z-10 mb-0.5" style="font-family:'Alex Brush',cursive;font-size:24px;color:#A17839;line-height:30px;">
                The Wedding of
            </p>

            {{-- Nama besar --}}
            <h1 class="relative z-10 mb-0.5" style="font-family:'Great Vibes',cursive;font-size:50px;line-height:1.15;color:#3A2517;letter-spacing:0.025em;">
                Astri &amp; Ridho
            </h1>

            {{-- Divider emas --}}
            <div class="gold-divider relative z-10 my-2" style="width:140px;"></div>

            {{-- Nama lengkap --}}
            <p class="relative z-10 tracking-widest uppercase mb-1" style="font-family:'Cinzel',serif;font-size:10px;color:#6B4D38;letter-spacing:0.2em;">
                SULASTRI &amp; RIDHO IRIANO SUDARMAZENA
            </p>
        </div>

        {{-- ── CARD TAMU UNDANGAN ── --}}
        <div class="relative z-10 w-full text-center anim-fade-card"
             style="background:rgba(240,228,206,0.55);border-top:1px solid rgba(161,120,57,0.35);border-bottom:1px solid rgba(161,120,57,0.35);backdrop-filter:blur(2px);padding:18px 16px;overflow:visible;">

            {{-- Corner Ornamen Kiri Atas Tamu --}}
            <div class="absolute pointer-events-none anim-float-corner-tl" style="top: -14px; left: -14px; width: 84px; z-index: 15;">
                <img src="{{ asset('assets-website/landing-page/corner-kiri-atas-tamu.svg') }}"
                     class="w-full h-auto object-contain drop-shadow-sm" alt="corner kiri atas tamu">
            </div>

            {{-- Corner Ornamen Kanan Bawah Tamu --}}
            <div class="absolute pointer-events-none anim-float-corner-br" style="bottom: -14px; right: -14px; width: 84px; z-index: 15;">
                <img src="{{ asset('assets-website/landing-page/corner-kanan-bawah-tamu.svg') }}"
                     class="w-full h-auto object-contain drop-shadow-sm" alt="corner kanan bawah tamu">
            </div>

            <p class="uppercase tracking-widest text-center mb-1"
               style="font-family:'Cinzel',serif;font-size:9.5px;color:#6B4D38;letter-spacing:0.22em;">
                KEPADA YTH. BAPAK/IBU/SAUDARA/I:
            </p>
            <p class="text-center font-bold"
               style="font-family:'Playfair Display',serif;font-size:19px;color:#3A2517;">
                {{ isset($guest) && $guest ? $guest->name : request()->query('to', 'Tamu Undangan') }}
            </p>
            <p class="text-center italic mt-1"
               style="font-family:'Playfair Display',serif;font-size:9px;color:rgba(107,77,56,0.65);">
                *Mohon maaf apabila ada kesalahan penulisan nama/gelar
            </p>
        </div>

        {{-- ── CTA BUTTON ── --}}
        <div class="relative z-10 w-full flex justify-center pb-1">
            <button data-buka-undangan
                class="flex items-center gap-2.5 px-8 py-2.5 rounded-full uppercase tracking-widest transition-transform hover:scale-105 active:scale-95 shadow-md"
                style="background:#3A2517;border:1px solid #A17839;font-family:'Cinzel',serif;font-size:11px;color:#FAF0DF;letter-spacing:0.2em;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
                BUKA UNDANGAN
            </button>
        </div>
    </div>
</div>

{{-- ════════════════════════════════════════════════════
     MAIN CONTENT (Locomotive Scroll container)
     ════════════════════════════════════════════════════ --}}
<div id="main-content" data-scroll-container class="relative" style="max-width:412px;margin:0 auto;">

    {{-- ────────────────────────────────────────────────
         SECTION 2: AYAT SUCI
         ──────────────────────────────────────────────── --}}
    <section id="section-ayat" data-scroll-section class="relative w-full overflow-hidden flex flex-col items-center text-center pt-8 pb-0"
             style="background-color:#FFFCF7;">

        {{-- Background Motif Ayat Suci --}}
        <div class="absolute inset-0 pointer-events-none select-none z-0">
            <img src="{{ asset('assets-website/ayat-suci/backgrond-ayatsuci.svg') }}"
                 class="w-full h-full object-cover select-none"
                 alt="Background Ayat Suci">
        </div>

        {{-- Ornamen Atas (Header Motif Doa) --}}
        <div data-scroll class="reveal-down ornament-border-slow relative z-10 w-full flex justify-center mb-3 sm:mb-4 px-4">
            <div class="anim-float-gentle w-full flex justify-center">
                <img src="{{ asset('assets-website/ayat-suci/border-doa.svg') }}"
                     class="w-full max-w-[310px] sm:max-w-[330px] h-auto object-contain pointer-events-none select-none"
                     alt="Ornamen Ayat Suci">
            </div>
        </div>

        {{-- Teks "Maha Suci Allah" --}}
        <p data-scroll class="reveal-up delay-200 relative z-10 mb-3"
           style="font-family:'Alex Brush',cursive;font-size:30px;color:#84683A;line-height:1.2;">
            Maha Suci Allah
        </p>

        {{-- Ayat Al-Qur'an --}}
        <div data-scroll class="reveal-up delay-400 relative z-10 px-5 max-w-[360px] mb-2">
            <p class="text-center font-bold"
               style="font-family:'Playfair Display',serif;font-size:14px;color:#3A2517;line-height:1.75;">
                &ldquo;Dan di antara tanda-tanda kekuasaan-Nya<br>
                ialah diciptakan-Nya untukmu pasangan hidup<br>
                dari jenismu sendiri, supaya kamu mendapat<br>
                ketenangan dan dijadikan-Nya di antaramu<br>
                kasih sayang. Sesungguhnya yang demikian itu<br>
                merupakan tanda-tanda kebesaran-Nya bagi<br>
                orang-orang yang berfikir.&rdquo;
            </p>
        </div>

        {{-- Area Bawah: Ornamen Daun Kiri & Kanan Flanking QS. AR-RUM : 21 --}}
        <div class="relative w-full flex flex-col items-center justify-center pt-2 pb-0 min-h-[110px] z-10">
            {{-- Ornamen Daun Kiri (Tampil Lebih Lambat Lebih Awal) --}}
            <div data-scroll class="reveal-left ornament-leaf-left absolute left-0 bottom-0 pointer-events-none z-10 w-[130px] sm:w-[138px]">
                <div class="anim-sway-leaf" style="transform-origin: bottom left;">
                    <img src="{{ asset('assets-website/ayat-suci/daun-kiri-doa.svg') }}"
                         class="w-full h-auto object-contain select-none"
                         alt="Ornamen Daun Kiri">
                </div>
            </div>

            {{-- Teks Surat & Pembatas Garis Emas --}}
            <div data-scroll class="reveal-up delay-500 relative z-20 flex flex-col items-center px-4">
                <p class="uppercase tracking-widest font-bold"
                   style="font-family:'Cinzel',serif;font-size:12px;color:#84683A;letter-spacing:0.2em;">
                    — QS. AR-RUM : 21 —
                </p>
                <div class="gold-divider w-28 sm:w-32 mt-2" style="opacity: 0.85;"></div>
            </div>

            {{-- Ornamen Daun Kanan (Tampil Bergantian Setelah Daun Kiri) --}}
            <div data-scroll class="reveal-right ornament-leaf-right absolute right-0 bottom-0 pointer-events-none z-10 w-[130px] sm:w-[138px]">
                <div class="anim-sway-leaf" style="transform-origin: bottom right;">
                    <img src="{{ asset('assets-website/ayat-suci/daun-kanan-doa.svg') }}"
                         class="w-full h-auto object-contain select-none"
                         alt="Ornamen Daun Kanan">
                </div>
            </div>
        </div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 3: MEMPELAI PROFILES
         ──────────────────────────────────────────────── --}}
    <section id="section-mempelai" data-scroll-section class="relative px-6 pt-0 pb-8 flex flex-col items-center text-center overflow-hidden"
             style="background-color:#FFFCF7;">

        {{-- Background Motif Pasangan --}}
        <div class="absolute inset-0 pointer-events-none select-none z-0">
            <img src="{{ asset('assets-website/pasangan-mempelai/backgroud-pasangan.svg') }}"
                 class="w-full h-full object-cover select-none"
                 alt="Background Pasangan">
        </div>

        {{-- Header --}}
        <div class="relative z-10 mb-8">
            <p data-scroll class="reveal-up mempelai-tag uppercase tracking-widest mb-1"
               style="font-family:'Cinzel',serif;font-size:11px;color:#84683A;letter-spacing:0.25em;">
                PASANGAN MEMPELAI
            </p>
            <h2 data-scroll class="reveal-up mempelai-title font-bold"
               style="font-family:'Playfair Display',serif;font-size:24px;color:#362B24;line-height:32px;">
                Dua Jiwa Satu Ikatan
            </h2>
            <p data-scroll class="reveal-up mempelai-desc mt-1 text-sm leading-relaxed"
               style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">
                Dengan memohon rahmat &amp; ridho Allah SWT, kami<br>
                bermaksud melangsungkan syukuran pernikahan putra-putri kami:
            </p>
        </div>

        {{-- Pasangan Mempelai Berdampingan --}}
        <div class="relative z-10 flex items-start justify-center gap-3 w-full">

            {{-- Mempelai Wanita --}}
            <div data-scroll class="reveal-left mempelai-wanita flex flex-col items-center flex-1 max-w-[155px]">
                <div class="relative w-full">
                    {{-- Ornamen Payung Kiri (Melayang dengan Parallax) --}}
                    <div data-scroll data-scroll-speed="0.5" class="absolute -top-6 -left-5 z-20 pointer-events-none select-none anim-float-rot"
                         style="width:62px;height:70px;">
                        <img src="{{ asset('assets-website/pasangan-mempelai/payung-kiri-foto-mempelai.svg') }}"
                             class="w-full h-auto object-contain select-none"
                             alt="Ornamen Payung">
                    </div>

                    {{-- Frame Foto --}}
                    <div class="w-full overflow-hidden shadow-xs relative z-10" style="height:270px;border-top-left-radius:90px;border-top-right-radius:0;border-bottom-left-radius:0;border-bottom-right-radius:0;border:1px solid rgba(161,120,57,0.4);background:rgba(161,120,57,0.08);">
                        <img src="{{ !empty($fotoWanita) ? asset('storage/' . $fotoWanita) : 'https://www.figma.com/img/7cc24d15e7d17075dbc79500643b0ea0c8f551e9' }}"
                             onerror="this.style.background='rgba(161,120,57,0.15)'"
                             class="w-full h-full object-cover object-top" alt="Sulastri">
                    </div>
                </div>
                <p class="mt-3" style="font-family:'Great Vibes',cursive;font-size:36px;color:#362B24;">Sulastri</p>
                <p style="font-family:'Cinzel',serif;font-size:11px;color:#84683A;letter-spacing:0.1em;">( Astri )</p>
                <div class="mt-1 text-center min-h-[55px] flex flex-col justify-start">
                    <p class="text-xs" style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">Putri dari Pasangan:</p>
                    <p class="text-xs font-medium leading-tight" style="font-family:'Plus Jakarta Sans',sans-serif;color:#4A3B32;">Bpk. Yasmudin &amp;<br>Ibu Rasiwen</p>
                </div>
            </div>

            {{-- Ampersand tengah --}}
            <div data-scroll class="reveal-scale-in mempelai-ampersand flex flex-col items-center justify-center flex-shrink-0 pt-10" style="width:36px;">
                <div class="gold-divider-v" style="height:70px;margin-bottom:8px;"></div>
                <p style="font-family:'Great Vibes',cursive;font-size:42px;color:#84683A;line-height:1;">&amp;</p>
                <div class="gold-divider-v" style="height:70px;margin-top:8px;"></div>
            </div>

            {{-- Mempelai Pria --}}
            <div data-scroll class="reveal-right mempelai-pria flex flex-col items-center flex-1 max-w-[155px]">
                <div class="relative w-full">
                    {{-- Ornamen Keris Kanan (Melayang dengan Parallax) --}}
                    <div data-scroll data-scroll-speed="0.5" class="absolute -top-7 -right-4 z-20 pointer-events-none select-none anim-float-gentle"
                         style="width:58px;height:79px;">
                        <img src="{{ asset('assets-website/pasangan-mempelai/keris-kanan-foto-mempelai.svg') }}"
                             class="w-full h-auto object-contain select-none"
                             alt="Ornamen Keris">
                    </div>

                    {{-- Frame Foto --}}
                    <div class="w-full overflow-hidden shadow-xs relative z-10" style="height:270px;border-top-right-radius:90px;border-top-left-radius:0;border-bottom-left-radius:0;border-bottom-right-radius:0;border:1px solid rgba(161,120,57,0.4);background:rgba(161,120,57,0.08);">
                        <img src="{{ !empty($fotoPria) ? asset('storage/' . $fotoPria) : 'https://www.figma.com/img/7cc24d15e7d17075dbc79500643b0ea0c8f551e9' }}"
                             onerror="this.style.background='rgba(161,120,57,0.15)'"
                             class="w-full h-full object-cover object-top" alt="Ridho">
                    </div>
                </div>
                <p class="mt-3" style="font-family:'Great Vibes',cursive;font-size:36px;color:#362B24;">Ridho</p>
                <p style="font-family:'Cinzel',serif;font-size:11px;color:#84683A;letter-spacing:0.1em;">( Ridho )</p>
                <div class="mt-1 text-center min-h-[55px] flex flex-col justify-start">
                    <p class="text-xs" style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">Putra dari Pasangan:</p>
                    <p class="text-xs font-medium leading-tight" style="font-family:'Plus Jakarta Sans',sans-serif;color:#4A3B32;">Bpk. Wahyu Darma Putra (alm)<br>&amp; Ibu Yeni Handayani</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 4: COUNTDOWN TIMER
         ──────────────────────────────────────────────── --}}
    <section id="section-countdown" data-scroll-section
             style="background:rgba(243,236,224,0.3);border-top:1px solid rgba(223,211,189,0.5);border-bottom:1px solid rgba(223,211,189,0.5);">

        @php
            try {
                $eventDate = \Carbon\Carbon::parse($weddingDate)->locale('id');
            } catch (\Exception $e) {
                $eventDate = \Carbon\Carbon::parse('2026-10-23T08:00')->locale('id');
            }
            $formattedWeddingDate = str_replace('Jumat', "Jum'at", $eventDate->isoFormat('dddd, D MMMM Y'));
            $startUtc = $eventDate->copy()->setTimezone('UTC')->format('Ymd\THis\Z');
            $endUtc = $eventDate->copy()->addHours(6)->setTimezone('UTC')->format('Ymd\THis\Z');
            $calendarUrl = 'https://calendar.google.com/calendar/render?action=TEMPLATE&text=' . urlencode('Pernikahan Astri & Ridho') . '&dates=' . $startUtc . '/' . $endUtc . '&details=' . urlencode('Akad Nikah & Resepsi Pernikahan Sulastri & Ridho Iriano Sudarmazena') . '&location=' . urlencode('Jln. Lombok RT 05 RW 01, Ds. Mergawati, Kec. Kroya, Kab. Cilacap');
        @endphp

        <div class="px-6 pt-7 pb-3 sm:pb-4 text-center">
            {{-- Header with flanking flower ornaments --}}
            <div class="relative w-full max-w-sm mx-auto mb-8">
                {{-- Ornamen Bunga Kiri --}}
                <div data-scroll class="reveal-left delay-100 anim-sway-leaf absolute pointer-events-none select-none z-10"
                     style="top: -14px; left: -8px; width: 57px;">
                    <img src="{{ asset('assets-website/tanggal-main/bunga-kiri-tanggal.svg') }}"
                         class="w-full h-auto object-contain" alt="ornamen bunga kiri">
                </div>

                {{-- Ornamen Bunga Kanan --}}
                <div data-scroll class="reveal-right delay-100 anim-sway-leaf absolute pointer-events-none select-none z-10"
                     style="top: -16px; right: -2px; width: 55px;">
                    <img src="{{ asset('assets-website/tanggal-main/bunga-kanan-tanggal.svg') }}"
                         class="w-full h-auto object-contain" alt="ornamen bunga kanan">
                </div>

                <p data-scroll class="reveal-up uppercase tracking-widest mb-2 text-center"
                   style="font-family:'Cinzel',serif;font-size:11px;color:#8B6C3F;letter-spacing:0.28em;">
                    MENUJU HARI BAHAGIA
                </p>
                <h2 data-scroll class="reveal-up delay-100 font-bold text-center"
                    style="font-family:'Playfair Display',serif;font-size:24px;color:#2F241D;letter-spacing:0.01em;">
                    {{ $formattedWeddingDate }}
                </h2>
            </div>

            {{-- Countdown boxes --}}
            <div data-scroll data-countdown-container data-target-date="{{ $weddingDate }}" class="reveal-up delay-200 flex gap-2.5 w-full max-w-sm mx-auto mb-8">
                <div class="countdown-box rounded-xs">
                    <span id="cd-days" class="countdown-number">00</span>
                    <span class="uppercase tracking-widest mt-1" style="font-family:'Cinzel',serif;font-size:9.5px;color:#7A6855;letter-spacing:0.15em;">HARI</span>
                </div>
                <div class="countdown-box rounded-xs">
                    <span id="cd-hours" class="countdown-number">00</span>
                    <span class="uppercase tracking-widest mt-1" style="font-family:'Cinzel',serif;font-size:9.5px;color:#7A6855;letter-spacing:0.15em;">JAM</span>
                </div>
                <div class="countdown-box rounded-xs">
                    <span id="cd-mins" class="countdown-number">00</span>
                    <span class="uppercase tracking-widest mt-1" style="font-family:'Cinzel',serif;font-size:9.5px;color:#7A6855;letter-spacing:0.15em;">MENIT</span>
                </div>
                <div class="countdown-box rounded-xs">
                    <span id="cd-secs" class="countdown-number">00</span>
                    <span class="uppercase tracking-widest mt-1" style="font-family:'Cinzel',serif;font-size:9.5px;color:#7A6855;letter-spacing:0.15em;">DETIK</span>
                </div>
            </div>

            {{-- Simpan ke kalender --}}
            <div data-scroll class="reveal-up delay-300 flex justify-center">
                <a href="{{ $calendarUrl }}"
                   target="_blank"
                   class="anim-pulse-gold inline-flex items-center gap-2.5 px-6 py-2.5 rounded-full uppercase tracking-wider hover:bg-stone-100 transition-all active:scale-95 shadow-2xs"
                   style="border:1.5px solid #84683A;background-color:#FAF6EE;font-family:'Cinzel',serif;font-size:11px;font-weight:600;color:#2F241D;letter-spacing:0.12em;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#2F241D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                        <line x1="10" y1="16" x2="14" y2="16"></line>
                        <line x1="12" y1="14" x2="12" y2="18"></line>
                    </svg>
                    SIMPAN KE KALENDER
                </a>
            </div>
        </div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 5: RANGKAIAN ACARA
         ──────────────────────────────────────────────── --}}
    <section id="section-acara" data-scroll-section class="relative px-6 pt-0 pb-10 sm:pt-1 sm:pb-12 flex flex-col items-center overflow-hidden"
             style="background-color:#FFFCF7;">

        {{-- Background Motif Batik Rangkaian Acara --}}
        <div class="absolute inset-0 pointer-events-none select-none z-0"
             style="background-image: url('{{ asset('assets-website/rangkaian-acara/batik-seamless-pattern-art-illustration-vector__1___1_ 4.svg') }}'); background-repeat: repeat; background-size: 412px auto;">
        </div>

        {{-- Ornamen Wayang & Gunungan Header Waktu & Lokasi --}}
        <div data-scroll class="reveal-scale-in relative z-10 w-full flex justify-center mt-1 mb-1.5 sm:mb-2 px-2">
            <img src="{{ asset('assets-website/rangkaian-acara/border-waktu-lokasi.svg') }}"
                 class="w-full max-w-[340px] sm:max-w-[360px] h-auto object-contain pointer-events-none select-none"
                 alt="Ornamen Waktu & Lokasi">
        </div>

        <p data-scroll class="reveal-up uppercase tracking-widest text-center relative z-10"
           style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.25em;">
            WAKTU &amp; LOKASI
        </p>
        <h2 data-scroll class="reveal-up delay-100 font-bold text-center mt-1 mb-8 relative z-10"
            style="font-family:'Playfair Display',serif;font-size:24px;color:#362B24;">
            Rangkaian Acara
        </h2>

        {{-- Akad Nikah --}}
        <div data-scroll class="reveal-up delay-200 relative z-10 w-full text-center pb-6"
             style="border-bottom:1px solid #DFD3BD;">

            {{-- Ornamen Cincin Kawin & Bantal di Kiri (Melayang dengan Parallax) --}}
            <div data-scroll data-scroll-speed="0.35" class="absolute -left-2 sm:left-0 top-0 pointer-events-none select-none z-10 anim-float-rot"
                 style="width: 86px;">
                <img src="{{ asset('assets-website/rangkaian-acara/cincin-waktu-lokasi.svg') }}"
                     class="w-full h-auto object-contain select-none drop-shadow-xs"
                     alt="Ornamen Cincin Akad Nikah">
            </div>

            {{-- Ornamen Bunga Kanan Atas (Akad Nikah - Melayang & Parallax) --}}
            <div data-scroll data-scroll-speed="0.25" class="reveal-right delay-200 absolute -right-6 pointer-events-none select-none z-10 anim-sway-leaf"
                 style="top: -26px; width: 115px; height: 240px; transform-origin: top right;">
                <img src="{{ asset('assets-website/rangkaian-acara/bunga-kanan-atas-atas.svg') }}"
                     class="absolute top-0 right-0 w-[88px] sm:w-[98px] h-auto object-contain select-none"
                     alt="Bunga Kanan Atas Atas">
                <img src="{{ asset('assets-website/rangkaian-acara/bunga-kanan-atas-bawah.svg') }}"
                     class="absolute top-[60px] sm:top-[67px] right-0 w-[104px] sm:w-[110px] h-auto object-contain select-none"
                     alt="Bunga Kanan Atas Bawah">
            </div>

            <p class="uppercase tracking-widest mb-1"
               style="font-family:'Cinzel',serif;font-size:12px;color:#84683A;letter-spacing:0.2em;">IJAB QABUL</p>
            <h3 class="font-bold" style="font-family:'Playfair Display',serif;font-size:20px;color:#362B24;">Akad Nikah</h3>
            <p class="mt-1 font-semibold" style="font-family:'Cinzel',serif;font-size:12px;color:#4A3B32;">Jum'at, 23 Oktober 2026</p>
            <p class="mt-0.5 italic" style="font-family:'Playfair Display',serif;font-size:12px;color:#6E5B4F;">Pukul 08.00 WIB s/d Selesai</p>
            <p class="mt-2 text-sm leading-relaxed" style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">
                Kediaman Mempelai Wanita:<br>Jln. Lombok RT 05 RW 01,<br>Ds. Mergawati, Kec. Kroya, Kab. Cilacap
            </p>
        </div>

        {{-- Resepsi --}}
        <div data-scroll class="reveal-up delay-300 relative z-10 w-full text-center pt-8 pb-6"
             style="border-bottom:1px solid #DFD3BD;">

            {{-- Ornamen Bunga Kiri Bawah (Resepsi - Melayang & Parallax) --}}
            <div data-scroll data-scroll-speed="0.25" class="reveal-left delay-200 absolute -left-6 pointer-events-none select-none z-10 anim-sway-leaf"
                 style="top: -8px; width: 125px; height: 240px; transform-origin: top left;">
                <img src="{{ asset('assets-website/rangkaian-acara/bunga-kiri-bawah-atas.svg') }}"
                     class="absolute top-0 left-0 w-[108px] sm:w-[118px] h-auto object-contain select-none"
                     alt="Bunga Kiri Bawah Atas">
                <img src="{{ asset('assets-website/rangkaian-acara/bunga-kiri-bawah-bawah.svg') }}"
                     class="absolute top-[34px] sm:top-[38px] left-0 w-[118px] sm:w-[128px] h-auto object-contain select-none"
                     alt="Bunga Kiri Bawah Bawah">
            </div>

            {{-- Ornamen Teko & Melati di Kanan (Melayang dengan Parallax) --}}
            <div data-scroll data-scroll-speed="0.35" class="absolute -right-2 sm:right-0 pointer-events-none select-none z-10 anim-float-gentle"
                 style="width: 72px; top: 46px;">
                <img src="{{ asset('assets-website/rangkaian-acara/teko-resepsi.svg') }}"
                     class="w-full h-auto object-contain select-none drop-shadow-xs"
                     alt="Ornamen Teko Resepsi">
            </div>

            <p class="uppercase tracking-widest mb-1"
               style="font-family:'Cinzel',serif;font-size:12px;color:#84683A;letter-spacing:0.2em;">WALIMATUL 'URSY</p>
            <h3 class="font-bold" style="font-family:'Playfair Display',serif;font-size:20px;color:#362B24;">Resepsi Pernikahan</h3>
            <p class="mt-1 font-semibold" style="font-family:'Cinzel',serif;font-size:12px;color:#4A3B32;">Jum'at, 23 Oktober 2026</p>
            <p class="mt-0.5 italic" style="font-family:'Playfair Display',serif;font-size:12px;color:#6E5B4F;">Pukul 09.00 / 10.00 WIB s/d Selesai</p>
            <p class="mt-2 text-sm leading-relaxed" style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">
                Kediaman Mempelai Wanita:<br> Jln. Lombok RT 05 RW 01,<br>Ds. Mergawati, Kec. Kroya, Kab. Cilacap
            </p>
        </div>

        {{-- Maps --}}
        <div data-scroll class="reveal-up delay-400 w-full mt-6 flex flex-col items-center">
            {{-- Peta diapit Ornamen Candi Bentar / Gapura Kiri & Kanan --}}
            <div class="relative w-full flex items-end justify-center -mx-4 sm:mx-0">
                {{-- Gapura Kiri --}}
                <div class="relative shrink-0 select-none pointer-events-none z-10 -mr-[8px]"
                     style="height: 168px;">
                    <img src="{{ asset('assets-website/maps/gapura-kiri-gmaps.svg') }}"
                         class="h-full w-auto object-contain object-bottom drop-shadow-2xs"
                         alt="Gapura Kiri">
                </div>

                {{-- Frame Google Maps --}}
                <div class="relative z-0 flex-1 max-w-[276px] overflow-hidden"
                     style="height: 168px; border: 1px solid #DFD3BD; background: #e8ece9;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31635.352397523933!2d109.26332535648756!3d-7.638003512172229!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6546d4c7defbbf%3A0x5027a76e3572370!2sMergawati%2C%20Kec.%20Kroya%2C%20Kabupaten%20Cilacap%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1789899395682!5m2!1sid!2sid"
                        width="100%"
                        height="100%"
                        style="border:0;display:block;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin">
                    </iframe>
                </div>

                {{-- Gapura Kanan --}}
                <div class="relative shrink-0 select-none pointer-events-none z-10 -ml-[8px]"
                     style="height: 168px;">
                    <img src="{{ asset('assets-website/maps/gapura-kanan-gmaps.svg') }}"
                         class="h-full w-auto object-contain object-bottom drop-shadow-2xs"
                         alt="Gapura Kanan">
                </div>
            </div>

            {{-- Tombol Buka Petunjuk di Google Maps Diapit Bunga Kiri & Kanan --}}
            <div class="relative w-full flex items-center justify-center mt-5 px-2">
                {{-- Bunga Kiri --}}
                <div class="shrink-0 select-none pointer-events-none mr-1 sm:mr-2 anim-sway-leaf" style="width: 44px; height: 38px;">
                    <img src="{{ asset('assets-website/maps/bunga-kiri-gmaps.svg') }}"
                         class="w-full h-full object-contain"
                         alt="Bunga Kiri">
                </div>

                {{-- Link Tombol --}}
                <a href="https://maps.google.com/?q=Ds.+Mergawati+Kec.+Kroya+Kab.+Cilacap"
                   target="_blank"
                   class="inline-flex items-center justify-center gap-1.5 py-1 px-1 uppercase tracking-wider hover:opacity-75 transition-opacity"
                   style="font-family:'Cinzel',serif;font-size:11.5px;font-weight:600;color:#362B24;letter-spacing:0.07em;white-space:nowrap;">
                    <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="#362B24" stroke-width="1.8">
                        <path d="M12 2C8.5 2 5.5 5 5.5 8.5c0 5.5 6.5 10.5 6.5 10.5s6.5-5 6.5-10.5C18.5 5 15.5 2 12 2z"/>
                        <circle cx="12" cy="8.5" r="2.5"/>
                        <path d="M4 21h16" stroke-linecap="round"/>
                    </svg>
                    BUKA PETUNJUK DI GOOGLE MAPS
                </a>

                {{-- Bunga Kanan --}}
                <div class="shrink-0 select-none pointer-events-none ml-1 sm:ml-2 anim-sway-leaf" style="width: 48px; height: 38px;">
                    <img src="{{ asset('assets-website/maps/bunga-kanan-gmaps.svg') }}"
                         class="w-full h-full object-contain"
                         alt="Bunga Kanan">
                </div>
            </div>
        </div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 5B: GALERI CAROUSEL
         ──────────────────────────────────────────────── --}}
    {{-- ────────────────────────────────────────────────
         SECTION 5B: GALERI CAROUSEL (DOKUMENTASI CINTA)
         ──────────────────────────────────────────────── --}}
    <section id="section-galeri" data-scroll-section class="pt-8 pb-12"
             style="background:#FAF6EE;border-top:1px solid rgba(223,211,189,0.5);">

        <div class="px-6 text-center">
            <p data-scroll class="reveal-up uppercase tracking-widest mb-1.5"
               style="font-family:'Cinzel',serif;font-size:11px;color:#8B6C3F;letter-spacing:0.25em;">
                DOKUMENTASI CINTA
            </p>
            <h2 data-scroll class="reveal-up delay-100 font-bold mb-1"
                style="font-family:'Playfair Display',serif;font-size:26px;color:#2F241D;">
                Galeri Pre-Wedding
            </h2>
            <p data-scroll class="reveal-up delay-150 mb-7"
               style="font-family:'Great Vibes',cursive;font-size:28px;color:#8B6C3F;">
                Kisah Kasih Astri &amp; Ridho
            </p>
        </div>

        @php
            $defaultItems = [
                ['url' => asset('assets-website/galery/prewed1 1.svg'), 'title' => 'BUSANA ADAT KERATON'],
                ['url' => asset('assets-website/galery/prewed2 1.svg'), 'title' => 'SENYUMAN BAHAGIA'],
                ['url' => asset('assets-website/galery/prewed3 1.svg'), 'title' => 'TATAPAN PENUH MAKNA'],
                ['url' => asset('assets-website/galery/prewed4 1.svg'), 'title' => 'IKATAN CINTA KASIH'],
                ['url' => asset('assets-website/galery/prewed5 1.svg'), 'title' => 'BERSAMA SELAMANYA'],
                ['url' => asset('assets-website/galery/prewed6 2.svg'), 'title' => 'MENUJU SATU TUJUAN'],
            ];

            $galleryList = [];
            if (isset($galleries) && $galleries->isNotEmpty()) {
                foreach ($galleries as $g) {
                    $galleryList[] = [
                        'url' => asset('storage/' . $g->image_path),
                        'title' => $g->title ?: 'MOMEN BAHAGIA',
                    ];
                }
            } else {
                $galleryList = $defaultItems;
            }
        @endphp

        {{-- Frame Utama Galeri Slider --}}
        <div data-scroll class="reveal-up delay-200 px-4 sm:px-6 max-w-[370px] mx-auto flex flex-col items-center">
            <div id="gallery-card" data-gallery-items='@json($galleryList)' class="relative w-full flex flex-col items-center">

                {{-- Frame Wrapper Berornamen (4 Corner SVG tanpa border tengah) --}}
                <div class="relative w-full">
                    {{-- Container Foto Slider dengan Shadow Lembut Mewah & Rounded-2xl --}}
                    <div class="relative w-full overflow-hidden rounded-2xl bg-stone-100"
                         style="aspect-ratio: 4/5;">
                        <img id="gallery-main-img"
                             src="{{ $galleryList[0]['url'] }}"
                             alt="{{ $galleryList[0]['title'] }}"
                             class="w-full h-full object-cover transition-opacity duration-300">

                        {{-- Tombol Kiri --}}
                        <button id="gallery-prev"
                                type="button"
                                aria-label="Foto Sebelumnya"
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-[#FAF6EE]/85 hover:bg-[#FAF6EE] text-[#2F241D] shadow-md flex items-center justify-center transition-transform active:scale-90 z-20 backdrop-blur-xs">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </button>

                        {{-- Tombol Kanan --}}
                        <button id="gallery-next"
                                type="button"
                                aria-label="Foto Selanjutnya"
                                class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-[#FAF6EE]/85 hover:bg-[#FAF6EE] text-[#2F241D] shadow-md flex items-center justify-center transition-transform active:scale-90 z-20 backdrop-blur-xs">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>

                        {{-- Overlay Judul Foto di Bawah --}}
                        <div class="absolute bottom-0 inset-x-0 pt-16 pb-3.5 px-4 pointer-events-none flex justify-center z-20">
                            <p id="gallery-main-title"
                               class="text-center font-bold tracking-widest text-white bg-black/30 rounded-full py-2 px-4 text-xs sm:text-sm uppercase drop-shadow-md"
                               style="font-family:'Cinzel',serif;letter-spacing:0.18em;">
                                {{ $galleryList[0]['title'] }}
                            </p>
                        </div>
                    </div>

                    {{-- 4 Ornamen Sudut Frame (SVG Lebih Besar, Tidak Menyatu di Tengah) --}}
                    {{-- Sudut Kiri Atas --}}
                    <img src="{{ asset('assets-website/galery/frame-kiri-atas.svg') }}"
                         class="absolute -top-3.5 -left-3.5 sm:-top-4 sm:-left-4 w-[125px] sm:w-[145px] h-auto pointer-events-none select-none z-10"
                         alt="Frame Kiri Atas">

                    {{-- Sudut Kanan Atas --}}
                    <img src="{{ asset('assets-website/galery/frame-kanan-atas.svg') }}"
                         class="absolute -top-3.5 -right-3.5 sm:-top-4 sm:-right-4 w-[125px] sm:w-[145px] h-auto pointer-events-none select-none z-10"
                         alt="Frame Kanan Atas">

                    {{-- Sudut Kiri Bawah --}}
                    <img src="{{ asset('assets-website/galery/frame-kiri-bawah.svg') }}"
                         class="absolute -bottom-3.5 -left-3.5 sm:-bottom-4 sm:-left-4 w-[125px] sm:w-[145px] h-auto pointer-events-none select-none z-10"
                         alt="Frame Kiri Bawah">

                    {{-- Sudut Kanan Bawah --}}
                    <img src="{{ asset('assets-website/galery/frame-kanan-bawah.svg') }}"
                         class="absolute -bottom-3.5 -right-3.5 sm:-bottom-4 sm:-right-4 w-[125px] sm:w-[145px] h-auto pointer-events-none select-none z-10"
                         alt="Frame Kanan Bawah">
                </div>

                {{-- Pagination Dots --}}
                <div id="gallery-dots" class="flex items-center justify-center gap-1.5 pt-4 pb-1">
                    @foreach($galleryList as $index => $item)
                        <button type="button"
                                data-gallery-index="{{ $index }}"
                                class="gallery-dot transition-all duration-300 {{ $index === 0 ? 'w-6 h-2 rounded-full bg-[#8B6C3F]' : 'w-2 h-2 rounded-full bg-[#D8C7B0] hover:bg-[#BCA990]' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            </div>

            {{-- Thumbnail Strip di Bawah Card --}}
            <div id="gallery-thumbnails" data-scroll class="reveal-up delay-300 flex gap-2 mt-3 overflow-x-auto py-2 px-1 justify-center scrollbar-none w-full">
                @foreach($galleryList as $index => $item)
                    <button type="button"
                            data-gallery-thumb="{{ $index }}"
                            class="gallery-thumb-btn relative flex-shrink-0 w-11 h-14 sm:w-12 sm:h-15 rounded-lg overflow-hidden border-2 transition-all duration-200 {{ $index === 0 ? 'border-[#8B6C3F] scale-105 shadow-sm' : 'border-transparent opacity-60 hover:opacity-100' }}">
                        <img src="{{ $item['url'] }}" alt="thumb {{ $index + 1 }}" class="w-full h-full object-cover">
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 6: FORM RSVP
         ──────────────────────────────────────────────── --}}
    {{-- ────────────────────────────────────────────────
         SECTION 6: FORM RSVP (KEHADIRAN TAMU)
         ──────────────────────────────────────────────── --}}
    <section id="section-rsvp" data-scroll-section class="relative px-6 pt-10 pb-20 overflow-hidden"
             style="background-color:#FFFCF7;border-top:1px solid rgba(223,211,189,0.5);">

        {{-- Background Motif RSVP --}}
        <div class="absolute inset-0 pointer-events-none select-none z-0">
            <img src="{{ asset('assets-website/rsvp/background-rsvp.svg') }}"
                 class="w-full h-full object-cover select-none"
                 alt="Background RSVP">
        </div>

        {{-- Ornamen Awan Kiri Atas RSVP --}}
        <div data-scroll class="reveal-left delay-100 anim-float-gentle absolute top-2 left-2 sm:top-3 sm:left-4 pointer-events-none select-none z-10 w-[115px] sm:w-[130px]">
            <img src="{{ asset('assets-website/rsvp/awan-kiri.svg') }}"
                 class="w-full h-auto object-contain" alt="ornamen awan kiri rsvp">
        </div>

        {{-- Ornamen Awan Kanan RSVP --}}
        <div data-scroll class="reveal-right delay-150 anim-float-rot absolute top-10 right-0 sm:top-12 pointer-events-none select-none z-10 w-[95px] sm:w-[115px]">
            <img src="{{ asset('assets-website/rsvp/awan-kanan.svg') }}"
                 class="w-full h-auto object-contain" alt="ornamen awan kanan rsvp">
        </div>

        {{-- Ornamen Bunga Kiri Bawah RSVP --}}
        <div data-scroll class="reveal-left delay-200 anim-sway-leaf absolute bottom-8 left-0 sm:bottom-10 pointer-events-none select-none z-20 w-[85px] sm:w-[105px]"
             style="transform-origin: bottom left;">
            <img src="{{ asset('assets-website/rsvp/bunga-kiri.svg') }}"
                 class="w-full h-auto object-contain" alt="ornamen bunga kiri rsvp">
        </div>

        {{-- Ornamen Bunga Kanan Bawah RSVP --}}
        <div data-scroll class="reveal-right delay-200 anim-sway-leaf absolute bottom-8 right-0 sm:bottom-10 pointer-events-none select-none z-20 w-[85px] sm:w-[105px]"
             style="transform-origin: bottom right;">
            <img src="{{ asset('assets-website/rsvp/bunga-kanan.svg') }}"
                 class="w-full h-auto object-contain" alt="ornamen bunga kanan rsvp">
        </div>

        <div class="relative z-10 text-center max-w-sm mx-auto mb-8">
            <p data-scroll class="reveal-up uppercase tracking-widest mb-1.5"
               style="font-family:'Cinzel',serif;font-size:11px;color:#8B6C3F;letter-spacing:0.25em;">
                KEHADIRAN TAMU
            </p>
            <h2 data-scroll class="reveal-up delay-100 font-bold mb-3"
                style="font-family:'Playfair Display',serif;font-size:26px;color:#2F241D;">
                Konfirmasi RSVP
            </h2>
            <p data-scroll class="reveal-up delay-150 text-xs sm:text-sm leading-relaxed"
               style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">
                Merupakan kehormatan bagi kami atas kehadiran dan doa restu Bapak/Ibu/Saudara/i:
            </p>
        </div>

        <form id="rsvp-form" data-scroll class="reveal-up delay-200 relative z-10 flex flex-col gap-5 max-w-sm mx-auto" novalidate>
            @csrf
            @if(isset($guest) && $guest)
                <input type="hidden" name="guest_id" value="{{ $guest->id }}">
            @endif

            {{-- Nama Lengkap --}}
            <div>
                <label class="block mb-2 uppercase tracking-wider font-semibold"
                       style="font-family:'Cinzel',serif;font-size:11px;color:#4A3B32;letter-spacing:0.12em;">
                    NAMA LENGKAP
                </label>
                <input type="text" name="guest_name"
                       value="{{ isset($guest) && $guest ? $guest->name : request()->query('to') }}"
                       placeholder="Nama Anda"
                       class="form-input"
                       {{ isset($guest) && $guest ? 'readonly' : '' }}
                       required>
            </div>

            {{-- Konfirmasi Kehadiran --}}
            <div>
                <label class="block mb-2 uppercase tracking-wider font-semibold"
                       style="font-family:'Cinzel',serif;font-size:11px;color:#4A3B32;letter-spacing:0.12em;">
                    KONFIRMASI KEHADIRAN
                </label>
                @php
                    $currentStatus = (isset($guest) && $guest->rsvp && $guest->rsvp->status_hadir) ? $guest->rsvp->status_hadir : 'Hadir';
                @endphp
                <div class="flex gap-3">
                    {{-- Hadir --}}
                    <label class="rsvp-btn-option {{ $currentStatus === 'Hadir' ? 'is-selected-hadir' : '' }}" id="label-hadir">
                        <input type="radio" name="status_hadir" value="Hadir" {{ $currentStatus === 'Hadir' ? 'checked' : '' }} class="sr-only">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <span class="font-bold text-xs uppercase tracking-wider" style="font-family:'Cinzel',serif;letter-spacing:0.08em;">HADIR</span>
                    </label>

                    {{-- Berhalangan --}}
                    <label class="rsvp-btn-option {{ $currentStatus === 'Tidak' ? 'is-selected-tidak' : '' }}" id="label-tidak">
                        <input type="radio" name="status_hadir" value="Tidak" {{ $currentStatus === 'Tidak' ? 'checked' : '' }} class="sr-only">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        <span class="font-bold text-xs uppercase tracking-wider" style="font-family:'Cinzel',serif;letter-spacing:0.08em;">BERHALANGAN</span>
                    </label>
                </div>
            </div>

            {{-- Jumlah Kehadiran --}}
            <div id="field-rombongan" style="{{ $currentStatus === 'Tidak' ? 'display:none;' : '' }}">
                <label class="block mb-2 uppercase tracking-wider font-semibold"
                       style="font-family:'Cinzel',serif;font-size:11px;color:#4A3B32;letter-spacing:0.12em;">
                    JUMLAH KEHADIRAN
                </label>
                <div class="relative">
                    <select name="jumlah_rombongan" class="form-input appearance-none cursor-pointer pr-10">
                        @php
                            $selectedPax = (isset($guest) && $guest->rsvp && $guest->rsvp->jumlah_rombongan) ? $guest->rsvp->jumlah_rombongan : 1;
                        @endphp
                        @for($p = 1; $p <= 10; $p++)
                            <option value="{{ $p }}" {{ $selectedPax == $p ? 'selected' : '' }}>{{ $p }} Orang</option>
                        @endfor
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-stone-500">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#6B594C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Untaian Doa & Pesan --}}
            <div>
                <label class="block mb-2 uppercase tracking-wider font-semibold"
                       style="font-family:'Cinzel',serif;font-size:11px;color:#4A3B32;letter-spacing:0.12em;">
                    UNTAIAN DOA &amp; PESAN
                </label>
                <textarea name="wishes" rows="3"
                          placeholder="Tuliskan doa restu untuk Astri &amp; Ridho..."
                          class="form-input resize-none">{{ isset($guest) && $guest->rsvp ? $guest->rsvp->wishes : '' }}</textarea>
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                    class="w-full py-3.5 mt-2 rounded-full uppercase tracking-widest font-semibold hover:opacity-90 active:scale-98 transition-all shadow-md flex items-center justify-center gap-2.5"
                    style="background:#362B24;color:#FAF0DF;font-family:'Cinzel',serif;font-size:12px;letter-spacing:0.18em;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
                <span>KIRIM KONFIRMASI</span>
            </button>
        </form>

        <div id="rsvp-message" class="relative z-10 mt-5 max-w-sm mx-auto" style="display:none;"></div>

        {{-- Pembatas Garis Bawah Halus --}}
        <div class="absolute bottom-0 left-0 right-0 h-[1px] pointer-events-none" style="background-color: rgba(223,211,189,0.5);"></div>

        {{-- Ornamen Delman Bawah RSVP --}}
        <div id="delman-rsvp-wrapper"
             data-scroll
             class="reveal-fade delay-200 absolute bottom-0 left-0 right-0 pointer-events-none select-none z-10"
             style="line-height: 0;">
            <div id="delman-rsvp-container"
                 style="width: 125px; will-change: transform; transition: transform 0.05s linear;">
                <img id="delman-rsvp"
                     src="{{ asset('assets-website/rsvp/batas-delman-bawah.svg') }}"
                     class="w-full h-auto object-contain block"
                     alt="ornamen delman rsvp">
            </div>
        </div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 7: BUKU TAMU (UNTAIAN DOA RESTU)
         ──────────────────────────────────────────────── --}}
    <section id="section-bukutamu" data-scroll-section class="relative px-6 py-12 overflow-hidden"
             style="background-color:#FAF6EE;border-top:1px solid rgba(223,211,189,0.5);">

        {{-- ── Ornamen Awan Sisi Buku Tamu (Melayang & Parallax) ── --}}
        {{-- Awan Atas Kanan --}}
        <div data-scroll data-scroll-speed="0.2" class="reveal-right delay-100 anim-float-gentle absolute top-0 right-0 pointer-events-none select-none z-0"
             style="width: 195px; transform-origin: top right;">
            <img src="{{ asset('assets-website/buku-tamu/awan-atas-kanan.svg') }}"
                 class="w-full h-auto object-contain select-none"
                 alt="Ornamen Awan Atas Kanan">
        </div>

        {{-- Awan Kiri Atas --}}
        <div data-scroll data-scroll-speed="-0.15" class="reveal-left delay-150 anim-float-rot absolute top-[130px] left-0 pointer-events-none select-none z-0"
             style="width: 155px; transform-origin: center left;">
            <img src="{{ asset('assets-website/buku-tamu/awan-kiri-atas.svg') }}"
                 class="w-full h-auto object-contain select-none"
                 alt="Ornamen Awan Kiri Atas">
        </div>

        {{-- Awan Bawah Kanan --}}
        <div data-scroll data-scroll-speed="0.2" class="reveal-right delay-200 anim-float-gentle absolute top-[275px] right-0 pointer-events-none select-none z-0"
             style="width: 175px; transform-origin: center right;">
            <img src="{{ asset('assets-website/buku-tamu/awan-bawah-kanan.svg') }}"
                 class="w-full h-auto object-contain select-none"
                 alt="Ornamen Awan Bawah Kanan">
        </div>

        {{-- Awan Bawah Kiri --}}
        <div data-scroll data-scroll-speed="-0.2" class="reveal-left delay-250 anim-float-rot absolute bottom-2 left-0 pointer-events-none select-none z-0"
             style="width: 95px; transform-origin: bottom left;">
            <img src="{{ asset('assets-website/buku-tamu/awan-bawah-kiri.svg') }}"
                 class="w-full h-auto object-contain select-none"
                 alt="Ornamen Awan Bawah Kiri">
        </div>


        <div class="relative z-10 text-center max-w-sm mx-auto mb-8">
            <p data-scroll class="reveal-up uppercase tracking-widest mb-1.5"
               style="font-family:'Cinzel',serif;font-size:11px;color:#8B6C3F;letter-spacing:0.25em;">
                UNTAIAN DOA RESTU
            </p>
            <h2 data-scroll class="reveal-up delay-100 font-bold"
                style="font-family:'Playfair Display',serif;font-size:28px;color:#2F241D;">
                Buku Tamu
            </h2>
        </div>

        <div data-scroll class="reveal-up delay-200 wishes-feed max-w-sm mx-auto flex flex-col gap-3 relative z-10" id="wishes-feed">
            <p class="text-center text-sm py-6 italic" style="font-family:'Playfair Display',serif;color:rgba(107,77,56,0.6);">
                Memuat ucapan...
            </p>
        </div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 8: AMPLOP DIGITAL (TANDA KASIH)
         ──────────────────────────────────────────────── --}}
    <section id="section-amplop" data-scroll-section class="relative overflow-hidden px-6 py-12"
             style="background:#FAF6EE;border-top:1px solid rgba(223,211,189,0.5);">

        {{-- ── Ornamen Sisi Amplop Digital (Melayang & Parallax) ── --}}
        {{-- Bunga Atas Kiri --}}
        <div data-scroll data-scroll-speed="0.3" class="reveal-left delay-100 anim-float-rot absolute top-0 left-0 pointer-events-none select-none z-20"
             style="width: 85px;">
            <img src="{{ asset('assets-website/amplop-digital/bunga-atas-kiri.svg') }}"
                 alt="" class="w-full h-auto object-contain">
        </div>

        {{-- Daun Atas Kanan --}}
        <div data-scroll data-scroll-speed="-0.2" class="reveal-right delay-100 anim-sway-leaf absolute top-0 right-0 pointer-events-none select-none z-20"
             style="width: 85px;">
            <img src="{{ asset('assets-website/amplop-digital/daun-atas-kanan.svg') }}"
                 alt="" class="w-full h-auto object-contain">
        </div>

        {{-- Bunga Kiri Bawah (Atas) --}}
        <div data-scroll data-scroll-speed="0.25" class="reveal-left delay-200 anim-float-gentle absolute bottom-[115px] left-0 pointer-events-none select-none z-20"
             style="width: 78px;">
            <img src="{{ asset('assets-website/amplop-digital/bunga-kiri-bawah-atas.svg') }}"
                 alt="" class="w-full h-auto object-contain">
        </div>

        {{-- Bunga Kiri Bawah (Bawah) --}}
        <div data-scroll data-scroll-speed="0.35" class="reveal-left delay-300 anim-sway-leaf absolute bottom-0 left-0 pointer-events-none select-none z-20"
             style="width: 70px;">
            <img src="{{ asset('assets-website/amplop-digital/bunga-kiri-bawah-bawah.svg') }}"
                 alt="" class="w-full h-auto object-contain">
        </div>

        {{-- Daun Bawah Kanan --}}
        <div data-scroll data-scroll-speed="0.35" class="reveal-right delay-300 anim-sway-leaf absolute bottom-0 right-0 pointer-events-none select-none z-20"
             style="width: 65px;">
            <img src="{{ asset('assets-website/amplop-digital/daun-bawah-kanan.svg') }}"
                 alt="" class="w-full h-auto object-contain">
        </div>

        <div class="relative z-10 text-center max-w-sm mx-auto mb-8">
            <p data-scroll class="reveal-up uppercase tracking-widest mb-1.5"
               style="font-family:'Cinzel',serif;font-size:11px;color:#8B6C3F;letter-spacing:0.25em;">
                TANDA KASIH
            </p>
            <h2 data-scroll class="reveal-up delay-100 font-bold mb-3"
                style="font-family:'Playfair Display',serif;font-size:28px;color:#2F241D;">
                Amplop Digital
            </h2>
            <p data-scroll class="reveal-up delay-150 text-xs sm:text-sm leading-relaxed"
               style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">
                Doa restu Anda merupakan karunia terindah bagi kami. Bagi keluarga dan kerabat yang ingin memberikan tanda kasih secara digital:
            </p>
        </div>

        <div class="relative z-10 max-w-sm mx-auto flex flex-col gap-4">
            {{-- Rekening 1: Ridho --}}
            <div data-scroll class="relative reveal-up delay-200 bg-[#F9F5EE] border border-[#D5C2A5] rounded-2xl p-5 shadow-xs">
                {{-- Corner Atas Kiri --}}
                <img src="{{ asset('assets-website/amplop-digital/corner-atas-kiri.svg') }}"
                     alt=""
                     class="absolute -top-2.5 -left-2.5 w-[65px] sm:w-[74px] pointer-events-none z-20 select-none">

                <div class="flex items-center justify-between mb-3.5">
                    <p class="font-bold text-xs uppercase tracking-wider text-[#7A5B28]"
                       style="font-family:'Cinzel',serif;letter-spacing:0.1em;">
                        BANK CENTRAL ASIA (BCA)
                    </p>
                    {{-- Icon Bank --}}
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8B6C3F" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="21" x2="21" y2="21"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                        <polyline points="5 10 12 3 19 10"></polyline>
                        <line x1="6" y1="14" x2="6" y2="18"></line>
                        <line x1="10" y1="14" x2="10" y2="18"></line>
                        <line x1="14" y1="14" x2="14" y2="18"></line>
                        <line x1="18" y1="14" x2="18" y2="18"></line>
                    </svg>
                </div>

                {{-- Box Nomor Rekening & Tombol Salin --}}
                <div class="bg-[#EFE9DC]/70 border border-[#D8C7B0] rounded-xl px-4 py-3 flex items-center justify-between gap-2 mb-3">
                    <span class="font-bold text-base sm:text-lg tracking-wider text-[#2F241D]"
                          style="font-family:'Plus Jakarta Sans',sans-serif;">
                        0461829301
                    </span>
                    <button data-copy="0461829301" data-copy-type="rekening"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-[#8B6C3F]/60 bg-white/60 hover:bg-white text-[#362B24] transition-all active:scale-95 shadow-2xs">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        <span class="text-[10px] font-bold uppercase tracking-wider" style="font-family:'Cinzel',serif;letter-spacing:0.08em;">SALIN</span>
                    </button>
                </div>

                <p class="text-xs italic text-[#6E5B4F]" style="font-family:'Plus Jakarta Sans',sans-serif;">
                    a.n. Ridho Iriano Sudarmazena
                </p>
            </div>

            {{-- Rekening 2: Sulastri --}}
            <div data-scroll class="relative reveal-up delay-300 bg-[#F9F5EE] border border-[#D5C2A5] rounded-2xl p-5 shadow-xs">
                {{-- Corner Bawah Kanan --}}
                <img src="{{ asset('assets-website/amplop-digital/corner-bawah-kanan.svg') }}"
                     alt=""
                     class="absolute -bottom-2.5 -right-2.5 w-[65px] sm:w-[74px] pointer-events-none z-20 select-none">

                <div class="flex items-center justify-between mb-3.5">
                    <p class="font-bold text-xs uppercase tracking-wider text-[#7A5B28]"
                       style="font-family:'Cinzel',serif;letter-spacing:0.1em;">
                        BANK CENTRAL ASIA (BCA)
                    </p>
                    {{-- Icon Bank --}}
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#8B6C3F" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="21" x2="21" y2="21"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                        <polyline points="5 10 12 3 19 10"></polyline>
                        <line x1="6" y1="14" x2="6" y2="18"></line>
                        <line x1="10" y1="14" x2="10" y2="18"></line>
                        <line x1="14" y1="14" x2="14" y2="18"></line>
                        <line x1="18" y1="14" x2="18" y2="18"></line>
                    </svg>
                </div>

                {{-- Box Nomor Rekening & Tombol Salin --}}
                <div class="bg-[#EFE9DC]/70 border border-[#D8C7B0] rounded-xl px-4 py-3 flex items-center justify-between gap-2 mb-3">
                    <span class="font-bold text-base sm:text-lg tracking-wider text-[#2F241D]"
                          style="font-family:'Plus Jakarta Sans',sans-serif;">
                        0462948123
                    </span>
                    <button data-copy="0462948123" data-copy-type="rekening"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-[#8B6C3F]/60 bg-white/60 hover:bg-white text-[#362B24] transition-all active:scale-95 shadow-2xs">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        <span class="text-[10px] font-bold uppercase tracking-wider" style="font-family:'Cinzel',serif;letter-spacing:0.08em;">SALIN</span>
                    </button>
                </div>

                <p class="text-xs italic text-[#6E5B4F]" style="font-family:'Plus Jakarta Sans',sans-serif;">
                    a.n. Sulastri
                </p>
            </div>

            {{-- Kado Fisik --}}
            <div data-scroll class="reveal-up delay-400 bg-[#F9F5EE] border border-[#D5C2A5] rounded-2xl p-6 shadow-xs text-center">
                <p class="font-bold text-xs uppercase tracking-widest text-[#4A3B32] mb-3"
                   style="font-family:'Cinzel',serif;letter-spacing:0.18em;">
                    KIRIM KADO FISIK
                </p>
                <p class="text-xs sm:text-sm italic leading-relaxed text-[#5C4B3E] mb-1" style="font-family:'Plus Jakarta Sans',sans-serif;">
                    Jln. Lombok RT 05 RW 01, Desa Mergawati, Kec. Kroya,
                </p>
                <p class="text-xs sm:text-sm italic leading-relaxed text-[#5C4B3E] mb-2" style="font-family:'Plus Jakarta Sans',sans-serif;">
                    Kab. Cilacap, Jawa Tengah
                </p>
                <p class="text-xs italic text-[#7A6855] mb-5" style="font-family:'Plus Jakarta Sans',sans-serif;">
                    (Penerima: Sulastri / Bpk. Yasmudin)
                </p>

                @php
                    $alamatLengkap = "Jln. Lombok RT 05 RW 01, Desa Mergawati, Kec. Kroya, Kab. Cilacap, Jawa Tengah (Penerima: Sulastri / Bpk. Yasmudin)";
                @endphp
                <button data-copy="{{ $alamatLengkap }}" data-copy-type="alamat"
                        class="inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border border-[#8B6C3F] bg-transparent hover:bg-[#EFE9DC]/60 text-[#362B24] transition-all active:scale-95 shadow-2xs mx-auto">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="3" width="15" height="13"></rect>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                    <span class="text-[11px] font-bold uppercase tracking-wider" style="font-family:'Cinzel',serif;letter-spacing:0.1em;">
                        SALIN ALAMAT KIRIM
                    </span>
                </button>
            </div>
        </div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 9: TURUT MENGUNDANG & PENUTUP
         ──────────────────────────────────────────────── --}}
    <section id="section-penutup" data-scroll-section class="relative overflow-hidden px-6 pt-12 pb-16 flex flex-col items-center text-center"
             style="background:#FAF6EE;border-top:1px solid #DFD3BD;">

        {{-- Background Pattern Atas & Bawah (Tersambung Penuh Tanpa Celah) --}}
        <div class="absolute inset-0 pointer-events-none select-none z-0 flex flex-col overflow-hidden">
            <div class="w-full h-[50.5%] overflow-hidden">
                <img src="{{ asset('assets-website/penutup/background.svg') }}"
                     alt="" class="w-full h-full object-cover object-top select-none">
            </div>
            <div class="w-full h-[50.5%] -mt-[1%] overflow-hidden">
                <img src="{{ asset('assets-website/penutup/background-bawah.svg') }}"
                     alt="" class="w-full h-full object-cover object-bottom select-none">
            </div>
        </div>

        {{-- Ornamen Daun Kanan Atas (Melayang & Parallax) --}}
        <div data-scroll data-scroll-speed="-0.2" class="reveal-right delay-100 absolute top-0 right-0 pointer-events-none select-none z-10 w-[125px] sm:w-[145px]">
            <div class="anim-sway-leaf" style="transform-origin: top right;">
                <img src="{{ asset('assets-website/penutup/daun-kanan-atas.svg') }}"
                     alt="Ornamen Daun Kanan Atas" class="w-full h-auto object-contain">
            </div>
        </div>

        {{-- Ornamen Bunga Kiri Bawah (Melayang & Parallax, menimpa sudut kiri foto) --}}
        <div data-scroll data-scroll-speed="0.25" class="reveal-left delay-200 absolute top-[150px] sm:top-[170px] left-0 pointer-events-none select-none z-20 w-[110px] sm:w-[130px]">
            <div class="anim-sway-leaf" style="transform-origin: bottom left;">
                <img src="{{ asset('assets-website/penutup/bunga-kiri-bawah.svg') }}"
                     alt="Ornamen Bunga Kiri Bawah" class="w-full h-auto object-contain">
            </div>
        </div>

        {{-- Foto Pengantin Prewed (Rounded Frame sesuai Contoh) --}}
        <div data-scroll class="reveal-up relative z-10 mb-6 max-w-[205px] sm:max-w-[225px] mx-auto">
            <div class="overflow-hidden rounded-2xl sm:rounded-[20px] shadow-[0_8px_25px_rgba(58,37,23,0.16)] border border-[#DFD3BD]/75">
                <img src="{{ asset('assets-website/penutup/prewed6 2.svg') }}"
                     alt="Foto Pengantin"
                     class="w-full h-auto object-cover select-none pointer-events-none">
            </div>
        </div>

        <p data-scroll class="reveal-up uppercase tracking-widest mb-3 relative z-10"
           style="font-family:'Cinzel',serif;font-size:11px;color:#84683A;letter-spacing:0.25em;">
            TURUT MENGUNDANG :
        </p>

        <div data-scroll class="reveal-up delay-100 mb-8 leading-relaxed text-center relative z-10"
           style="font-family:'Playfair Display',serif;font-size:15px;color:#3A2517;line-height:1.75;">
            @if(isset($guest) && $guest && $guest->custom_turut_mengundang)
                {!! nl2br(e($guest->custom_turut_mengundang)) !!}
            @else
                Sanwakyo<br>
                Kasbani<br>
                Kasmadi<br>
                Sirin <span class="italic">(penjual bekatul)</span><br>
                Demang <span class="italic">(penjual kambing)</span>
            @endif
        </div>

        <div data-scroll class="reveal-scale gold-divider mb-8 relative z-10" style="width:140px;"></div>

        <p data-scroll class="reveal-fade delay-200 italic mb-5 leading-relaxed text-center relative z-10"
           style="font-family:'Playfair Display',serif;font-size:14px;color:#6E5B4F;line-height:1.6;">
            Merupakan suatu kehormatan dan kebahagiaan bagi kami<br>
            apabila Bapak/Ibu/Saudara/i berkenan hadir<br>
            untuk memberikan do'a restu.
        </p>

        <p data-scroll class="reveal-up delay-250 italic font-bold mb-8 text-center relative z-10"
           style="font-family:'Playfair Display',serif;font-size:15px;color:#3A2517;">
            Wassalamu'alaikum Warahmatullahi Wabarakatuh
        </p>

        <p data-scroll class="reveal-up delay-300 uppercase tracking-widest mb-2 relative z-10"
           style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.25em;">
            KAMI YANG BERBAHAGIA:
        </p>

        <p data-scroll class="reveal-up delay-350 font-bold uppercase tracking-wider mb-6 leading-relaxed relative z-10"
           style="font-family:'Cinzel',serif;font-size:11px;color:#3A2517;letter-spacing:0.04em;line-height:1.6;">
            KELUARGA BPK. YASMUDIN &amp; IBU RASIWEN<br>
            KELUARGA BPK. WAHYU DARMA PUTRA (ALM) &amp; IBU YENI HANDAYANI
        </p>

        <h2 data-scroll class="reveal-up delay-400 mb-1 relative z-10"
            style="font-family:'Great Vibes',cursive;font-size:54px;color:#3A2517;">
            Astri &amp; Ridho
        </h2>

        <p data-scroll class="reveal-up delay-450 uppercase tracking-widest relative z-10"
           style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.2em;">
            23 OKTOBER 2026
        </p>

        <div data-scroll class="reveal-scale gold-divider mt-6 mb-4 relative z-10" style="width:128px;"></div>

        <p data-scroll class="reveal-fade delay-200 text-xs relative z-10"
           style="font-family:'Plus Jakarta Sans',sans-serif;color:rgba(107,77,56,0.5);">
            Made by akrdesign for Astri &amp; Ridho
        </p>
    </section>




</div><!-- /data-scroll-container -->

{{-- ════════════════════════════════════════════════════
     BACKGROUND MUSIC & FLOATING DISC CONTROLLER
     ════════════════════════════════════════════════════ --}}
<audio id="wedding-music" loop preload="auto">
    <source src="{{ asset('music/Rizky Febian Feat. Mahalini - Bermuara [Official Lyric Video].mp3') }}" type="audio/mpeg">
</audio>

<div id="music-container"
     class="fixed top-5 right-5 z-40 transition-all duration-500 opacity-0 pointer-events-none transform -translate-y-2">
    <button id="music-toggle-btn"
            type="button"
            class="flex items-center justify-center w-10 h-10 rounded-full focus:outline-none shadow-md transition-transform hover:scale-105 active:scale-95 cursor-pointer select-none"
            aria-label="Putar atau jeda musik"
            title="Putar atau jeda musik"
            style="background: rgba(46, 29, 19, 0.88); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); border: 1px solid rgba(201, 168, 107, 0.55); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">

        {{-- Saat Memutar: Piringan Vinyl Vektor Minimalis Berputar --}}
        <svg id="music-icon-play" class="w-6 h-6 anim-disc-spin text-[#C9A86B]" viewBox="0 0 24 24" fill="none">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.2" fill="#1C110A" />
            <circle cx="12" cy="12" r="7.5" stroke="#6B4D38" stroke-width="0.8" stroke-dasharray="2 1.5" />
            <circle cx="12" cy="12" r="5.5" stroke="#6B4D38" stroke-width="0.8" />
            <circle cx="12" cy="12" r="3.2" fill="#C9A86B" />
            <circle cx="12" cy="12" r="1.1" fill="#1C110A" />
        </svg>

        {{-- Saat Jeda: Icon Segitiga Play Emas Bersih --}}
        <svg id="music-icon-pause" class="hidden w-4 h-4 text-[#C9A86B] ml-0.5" viewBox="0 0 24 24" fill="currentColor">
            <polygon points="6,4 20,12 6,20" />
        </svg>
    </button>
</div>

</body>
</html>
