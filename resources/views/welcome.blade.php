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
        @media (min-width: 768px) {
            #cover-overlay {
                align-items: flex-end !important;
            }
            #main-content {
                margin-right: 0 !important;
                margin-left: auto !important;
            }
            #cover-header-ornament {
                left: auto !important;
                right: 0 !important;
                width: 412px;
            }
            #bottom-nav {
                left: auto !important;
                right: 0 !important;
                transform: none !important;
            }
        }
    </style>
</head>

<body class="overflow-x-hidden overflow-hidden" style="background-color:#FFFCF7;" @if(isset($guest) && $guest) data-guest-id="{{ $guest->id }}" @endif>

{{-- ════════════════════════════════════════════════════
     COVER OVERLAY (Section 1 – Hero)
     Ditampilkan fullscreen sebelum tamu klik "Buka Undangan"
     ════════════════════════════════════════════════════ --}}
<div id="cover-overlay" class="fixed inset-0 z-50 flex flex-col items-center justify-center overflow-hidden" style="background-color:#FFFCF7;">

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
        /* Entrance: Menjalar masuk dari luar frame (outframe jauh) */
        @keyframes creepInTL {
            0% {
                opacity: 0;
                transform: translate(-70px, -45px) scale(0.6) rotate(-22deg);
            }
            70% {
                opacity: 1;
                transform: translate(4px, 2px) scale(1.04) rotate(2deg);
            }
            100% {
                opacity: 1;
                transform: translate(0, 0) scale(1) rotate(0deg);
            }
        }
        @keyframes creepInBL {
            0% {
                opacity: 0;
                transform: translate(-70px, 50px) scale(0.6) rotate(22deg);
            }
            70% {
                opacity: 1;
                transform: translate(4px, -2px) scale(1.04) rotate(-2deg);
            }
            100% {
                opacity: 1;
                transform: translate(0, 0) scale(1) rotate(0deg);
            }
        }
        @keyframes creepInTR {
            0% {
                opacity: 0;
                transform: translate(70px, -45px) scale(0.6) rotate(22deg);
            }
            70% {
                opacity: 1;
                transform: translate(-4px, 2px) scale(1.04) rotate(-2deg);
            }
            100% {
                opacity: 1;
                transform: translate(0, 0) scale(1) rotate(0deg);
            }
        }
        @keyframes creepInBR {
            0% {
                opacity: 0;
                transform: translate(70px, 50px) scale(0.6) rotate(-22deg);
            }
            70% {
                opacity: 1;
                transform: translate(-4px, -2px) scale(1.04) rotate(2deg);
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
                transform: rotate(3deg) translate(1.5px, -2px);
            }
            70% {
                transform: rotate(-2.5deg) translate(-1px, 1.5px);
            }
        }
        @keyframes windSwayRight {
            0%, 100% {
                transform: rotate(0deg) translate(0, 0);
            }
            35% {
                transform: rotate(-3deg) translate(-1.5px, -2px);
            }
            70% {
                transform: rotate(2.5deg) translate(1px, 1.5px);
            }
        }

        .anim-header-landing {
            animation: fadeInDownLanding 1.1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
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

    {{-- Ornamen atas --}}
    <div id="cover-header-ornament" class="absolute top-0 left-0 right-0 pointer-events-none flex justify-center z-10">
        <img src="{{ asset('assets-website/header-landing.svg') }}"
             class="w-full max-w-[412px] h-auto object-contain anim-header-landing" alt="ornamen header">
    </div>

    {{-- Konten utama cover --}}
    <div class="relative z-10 flex flex-col items-center px-6 text-center w-full max-w-[412px]" style="padding-top:4.25rem;padding-bottom:2rem;">

        {{-- Halo light blur --}}
        <div class="absolute pointer-events-none" style="width:288px;height:288px;background:rgba(212,181,128,0.22);filter:blur(32px);border-radius:9999px;top:45%;left:50%;transform:translate(-50%,-50%);z-index:0;"></div>

        {{-- Karakter ilustrasi pengantin landing & Side Assets --}}
        <div class="relative z-10 mb-2 w-full flex items-center justify-center anim-pengantin-landing" style="gap: 10px;">
            {{-- Ornamen Samping Kiri --}}
            <div class="flex-shrink-0 flex items-center justify-center" style="width: 44px;">
                <img src="{{ asset('assets-website/side-asset-pengantin-kiri.svg') }}"
                     class="w-full h-auto object-contain" alt="ornamen samping kiri">
            </div>

            {{-- Ilustrasi Pengantin --}}
            <div class="flex-shrink-0 flex justify-center" style="width: 185px;">
                <img src="{{ asset('assets-website/pengantin-landing.svg') }}"
                     class="w-full h-auto object-contain drop-shadow-sm" alt="pengantin">
            </div>

            {{-- Ornamen Samping Kanan --}}
            <div class="flex-shrink-0 flex items-center justify-center" style="width: 44px;">
                <img src="{{ asset('assets-website/side-asset-pengantin-kanan.svg') }}"
                     class="w-full h-auto object-contain" alt="ornamen samping kanan">
            </div>
        </div>

        {{-- Title Area with Floral Frame (Outframe Placement) --}}
        <div class="relative z-10 w-full flex flex-col items-center my-1 py-1" style="overflow: visible;">
            {{-- Bunga Kiri Atas (Outframe menempel tepi luar) --}}
            <div class="absolute pointer-events-none anim-creep-tl" style="top: -48px; left: -92px; width: 168px; z-index: 6;">
                <img src="{{ asset('assets-website/bunga-titlelanding-kiri-atas.svg') }}"
                     class="w-full h-auto object-contain sway-wind-left" alt="bunga kiri atas">
            </div>

            {{-- Bunga Kiri Bawah (Outframe menempel tepi luar) --}}
            <div class="absolute pointer-events-none anim-creep-bl" style="bottom: -6px; left: -136px; width: 175px; z-index: 5;">
                <img src="{{ asset('assets-website/bunga-titlelanding-kiri-bawah.svg') }}"
                     class="w-full h-auto object-contain sway-wind-bl" alt="bunga kiri bawah">
            </div>

            {{-- Bunga Kanan Atas (Outframe menempel tepi luar) --}}
            <div class="absolute pointer-events-none anim-creep-tr" style="top: -36px; right: -75px; width: 172px; z-index: 6;">
                <img src="{{ asset('assets-website/bunga-titlelanding-kanan-atas.svg') }}"
                     class="w-full h-auto object-contain sway-wind-right" alt="bunga kanan atas">
            </div>

            {{-- Bunga Kanan Bawah (Outframe menempel tepi luar) --}}
            <div class="absolute pointer-events-none anim-creep-br" style="bottom: -20px; right: -122px; width: 168px; z-index: 5;">
                <img src="{{ asset('assets-website/bunga-titlelanding-kanan-bawah.svg') }}"
                     class="w-full h-auto object-contain sway-wind-br" alt="bunga kanan bawah">
            </div>

            {{-- "The Wedding of" --}}
            <p class="relative z-10 mb-1" style="font-family:'Alex Brush',cursive;font-size:24px;color:#A17839;line-height:32px;">
                The Wedding of
            </p>

            {{-- Nama besar --}}
            <h1 class="relative z-10 mb-1" style="font-family:'Great Vibes',cursive;font-size:54px;line-height:1.2;color:#3A2517;letter-spacing:0.025em;">
                Astri &amp; Ridho
            </h1>

            {{-- Divider emas --}}
            <div class="gold-divider relative z-10 my-2.5" style="width:160px;"></div>

            {{-- Nama lengkap --}}
            <p class="relative z-10 tracking-widest uppercase mb-4" style="font-family:'Cinzel',serif;font-size:10.5px;color:#6B4D38;letter-spacing:0.2em;">
                SULASTRI &amp; RIDHO IRIANO SUDARMAZENA
            </p>
        </div>

        {{-- Card tamu undangan --}}
        <div class="relative z-10 w-full mb-4 text-center anim-fade-card"
             style="background:rgba(240,228,206,0.45);border-top:1px solid rgba(161,120,57,0.35);border-bottom:1px solid rgba(161,120,57,0.35);backdrop-filter:blur(2px);padding:24px 20px;overflow:visible;">

            {{-- Corner Ornamen Kiri Atas Tamu (Hovering di luar border) --}}
            <div class="absolute pointer-events-none anim-float-corner-tl" style="top: -18px; left: -16px; width: 84px; z-index: 2;">
                <img src="{{ asset('assets-website/corner-kiri-atas-tamu.svg') }}"
                     class="w-full h-auto object-contain drop-shadow-sm" alt="corner kiri atas tamu">
            </div>

            {{-- Corner Ornamen Kanan Bawah Tamu (Hovering di luar border) --}}
            <div class="absolute pointer-events-none anim-float-corner-br" style="bottom: -18px; right: -16px; width: 84px; z-index: 10;">
                <img src="{{ asset('assets-website/corner-kanan-bawah-tamu.svg') }}"
                     class="w-full h-auto object-contain drop-shadow-sm" alt="corner kanan bawah tamu">
            </div>

            <p class="uppercase tracking-widest text-center mb-1.5"
               style="font-family:'Cinzel',serif;font-size:10px;color:#6B4D38;letter-spacing:0.22em;">
                KEPADA YTH. BAPAK/IBU/SAUDARA/I:
            </p>
            <p class="text-center font-bold"
               style="font-family:'Playfair Display',serif;font-size:20px;color:#3A2517;">
                {{ isset($guest) && $guest ? $guest->name : request()->query('to', 'Tamu Undangan') }}
            </p>
            <p class="text-center italic mt-1.5"
               style="font-family:'Playfair Display',serif;font-size:9.5px;color:rgba(107,77,56,0.65);">
                *Mohon maaf apabila ada kesalahan penulisan nama/gelar
            </p>
        </div>

        {{-- CTA Button --}}
        <button data-buka-undangan
            class="relative z-10 flex items-center gap-2.5 px-8 py-3 rounded-full uppercase tracking-widest transition-opacity hover:opacity-80 active:scale-95 shadow-md"
            style="background:#3A2517;border:1px solid #A17839;font-family:'Cinzel',serif;font-size:11.5px;color:#FAF0DF;letter-spacing:0.2em;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
            </svg>
            BUKA UNDANGAN
        </button>
    </div>
</div>

{{-- ════════════════════════════════════════════════════
     MAIN CONTENT (Locomotive Scroll container)
     ════════════════════════════════════════════════════ --}}
<div id="main-content" data-scroll-container class="relative" style="max-width:412px;margin:0 auto;">

    {{-- ────────────────────────────────────────────────
         SECTION 2: AYAT SUCI
         ──────────────────────────────────────────────── --}}
    <section id="section-ayat" data-scroll-section class="px-6 py-10 flex flex-col items-center text-center"
             style="background-color:#FFFCF7;">

        <div data-scroll class="reveal-scale w-32 gold-divider mb-6"></div>

        <p data-scroll class="reveal-up"
           style="font-family:'Alex Brush',cursive;font-size:24px;color:#84683A;line-height:32px;">
            Maha Suci Allah
        </p>

        <div data-scroll class="reveal-up delay-200 my-2 px-4">
            <p class="italic text-center leading-relaxed"
               style="font-family:'Playfair Display',serif;font-size:15px;color:#4A3B32;line-height:1.7;">
                "Dan di antara tanda-tanda kekuasaan-Nya<br>
                ialah diciptakan-Nya untukmu pasangan hidup<br>
                dari jenismu sendiri, supaya kamu mendapat<br>
                ketenangan dan dijadikan-Nya di antaramu<br>
                kasih sayang. Sesungguhnya yang demikian itu<br>
                merupakan tanda-tanda kebesaran-Nya bagi<br>
                orang-orang yang berfikir."
            </p>
        </div>

        <p data-scroll class="reveal-up delay-300 mt-3 uppercase tracking-widest font-bold"
           style="font-family:'Cinzel',serif;font-size:12px;color:#84683A;letter-spacing:0.2em;">
            — QS. AR-RUM : 21 —
        </p>

        <div data-scroll class="reveal-scale w-32 gold-divider mt-6"></div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 3: MEMPELAI PROFILES
         ──────────────────────────────────────────────── --}}
    <section id="section-mempelai" data-scroll-section class="px-6 py-8 flex flex-col items-center text-center"
             style="background-color:#FFFCF7;">

        {{-- Header --}}
        <div class="mb-8">
            <p data-scroll class="reveal-up uppercase tracking-widest mb-1"
               style="font-family:'Cinzel',serif;font-size:11px;color:#84683A;letter-spacing:0.25em;">
                PASANGAN MEMPELAI
            </p>
            <h2 data-scroll class="reveal-up delay-100 font-bold"
                style="font-family:'Playfair Display',serif;font-size:24px;color:#362B24;line-height:32px;">
                Dua Jiwa Satu Ikatan
            </h2>
            <p data-scroll class="reveal-up delay-200 mt-1 text-sm leading-relaxed"
               style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">
                Dengan memohon rahmat &amp; ridho Allah SWT, kami<br>
                bermaksud melangsungkan syukuran pernikahan putra-<br>
                putri kami:
            </p>
        </div>

        {{-- Pasangan Mempelai Berdampingan --}}
        <div class="flex items-start justify-center gap-3 w-full">

            {{-- Mempelai Wanita --}}
            <div data-scroll class="reveal-left delay-100 flex flex-col items-center flex-1 max-w-[155px]">
                <div class="w-full overflow-hidden shadow-xs" style="height:270px;border-top-left-radius:90px;border-top-right-radius:0;border-bottom-left-radius:0;border-bottom-right-radius:0;border:1px solid rgba(161,120,57,0.4);background:rgba(161,120,57,0.08);">
                    <img src="{{ !empty($fotoWanita) ? asset('storage/' . $fotoWanita) : 'https://www.figma.com/img/7cc24d15e7d17075dbc79500643b0ea0c8f551e9' }}"
                         onerror="this.style.background='rgba(161,120,57,0.15)'"
                         class="w-full h-full object-cover object-top" alt="Sulastri">
                </div>
                <p class="mt-3" style="font-family:'Great Vibes',cursive;font-size:36px;color:#362B24;">Sulastri</p>
                <p style="font-family:'Cinzel',serif;font-size:11px;color:#84683A;letter-spacing:0.1em;">( Astri )</p>
                <div class="mt-1 text-center min-h-[55px] flex flex-col justify-start">
                    <p class="text-xs" style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">Putri dari Pasangan:</p>
                    <p class="text-xs font-medium leading-tight" style="font-family:'Plus Jakarta Sans',sans-serif;color:#4A3B32;">Bpk. Yasmudin &amp;<br>Ibu Rasiwen</p>
                </div>
            </div>

            {{-- Ampersand tengah --}}
            <div data-scroll class="reveal-fade delay-300 flex flex-col items-center justify-center flex-shrink-0 pt-10" style="width:36px;">
                <div class="gold-divider-v" style="height:70px;margin-bottom:8px;"></div>
                <p style="font-family:'Great Vibes',cursive;font-size:42px;color:#84683A;line-height:1;">&amp;</p>
                <div class="gold-divider-v" style="height:70px;margin-top:8px;"></div>
            </div>

            {{-- Mempelai Pria --}}
            <div data-scroll class="reveal-right delay-100 flex flex-col items-center flex-1 max-w-[155px]">
                <div class="w-full overflow-hidden shadow-xs" style="height:270px;border-top-right-radius:90px;border-top-left-radius:0;border-bottom-left-radius:0;border-bottom-right-radius:0;border:1px solid rgba(161,120,57,0.4);background:rgba(161,120,57,0.08);">
                    <img src="{{ !empty($fotoPria) ? asset('storage/' . $fotoPria) : 'https://www.figma.com/img/7cc24d15e7d17075dbc79500643b0ea0c8f551e9' }}"
                         onerror="this.style.background='rgba(161,120,57,0.15)'"
                         class="w-full h-full object-cover object-top" alt="Ridho">
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
            $formattedWeddingDate = $eventDate->isoFormat('dddd, D MMMM Y');
            $startUtc = $eventDate->copy()->setTimezone('UTC')->format('Ymd\THis\Z');
            $endUtc = $eventDate->copy()->addHours(6)->setTimezone('UTC')->format('Ymd\THis\Z');
            $calendarUrl = 'https://calendar.google.com/calendar/render?action=TEMPLATE&text=' . urlencode('Pernikahan Astri & Ridho') . '&dates=' . $startUtc . '/' . $endUtc . '&details=' . urlencode('Akad Nikah & Resepsi Pernikahan Sulastri & Ridho Iriano Sudarmazena') . '&location=' . urlencode('Jln. Lombok RT 05 RW 01, Ds. Mergawati, Kec. Kroya, Kab. Cilacap');
        @endphp

        <div class="px-6 pt-7 pb-8 text-center">
            <p data-scroll class="reveal-up uppercase tracking-widest mb-2 text-center"
               style="font-family:'Cinzel',serif;font-size:11px;color:#8B6C3F;letter-spacing:0.28em;">
                MENUJU HARI BAHAGIA
            </p>
            <h2 data-scroll class="reveal-up delay-100 font-bold mb-8 text-center"
                style="font-family:'Playfair Display',serif;font-size:24px;color:#2F241D;letter-spacing:0.01em;">
                {{ $formattedWeddingDate }}
            </h2>

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
                   class="inline-flex items-center gap-2.5 px-6 py-2.5 rounded-full uppercase tracking-wider hover:bg-stone-100 transition-all active:scale-95 shadow-2xs"
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
    <section id="section-acara" data-scroll-section class="px-6 py-10 flex flex-col items-center"
             style="background-color:#FFFCF7;">

        <p data-scroll class="reveal-up uppercase tracking-widest"
           style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.25em;">
            WAKTU &amp; LOKASI
        </p>
        <h2 data-scroll class="reveal-up delay-100 font-bold text-center mt-1 mb-8"
            style="font-family:'Playfair Display',serif;font-size:24px;color:#362B24;">
            Rangkaian Acara
        </h2>

        {{-- Akad Nikah --}}
        <div data-scroll class="reveal-up delay-200 w-full text-center pb-6"
             style="border-bottom:1px solid #DFD3BD;">
            <p class="uppercase tracking-widest mb-1"
               style="font-family:'Cinzel',serif;font-size:12px;color:#84683A;letter-spacing:0.2em;">IJAB QABUL</p>
            <h3 class="font-bold" style="font-family:'Playfair Display',serif;font-size:20px;color:#362B24;">Akad Nikah</h3>
            <p class="mt-1 font-semibold" style="font-family:'Cinzel',serif;font-size:12px;color:#4A3B32;">Jum'at, 23 Oktober 2026</p>
            <p class="mt-0.5 italic" style="font-family:'Playfair Display',serif;font-size:12px;color:#6E5B4F;">Pukul 08.00 WIB s/d Selesai</p>
            <p class="mt-2 text-sm leading-relaxed" style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">
                Kediaman Mempelai Wanita: Jln. Lombok RT 05 RW 01,<br>Ds. Mergawati, Kec. Kroya, Kab. Cilacap
            </p>
        </div>

        {{-- Resepsi --}}
        <div data-scroll class="reveal-up delay-300 w-full text-center pt-8 pb-6"
             style="border-bottom:1px solid #DFD3BD;">
            <p class="uppercase tracking-widest mb-1"
               style="font-family:'Cinzel',serif;font-size:12px;color:#84683A;letter-spacing:0.2em;">WALIMATUL 'URSY</p>
            <h3 class="font-bold" style="font-family:'Playfair Display',serif;font-size:20px;color:#362B24;">Resepsi Pernikahan</h3>
            <p class="mt-1 font-semibold" style="font-family:'Cinzel',serif;font-size:12px;color:#4A3B32;">Jum'at, 23 Oktober 2026</p>
            <p class="mt-0.5 italic" style="font-family:'Playfair Display',serif;font-size:12px;color:#6E5B4F;">Pukul 10.00 WIB s/d Selesai</p>
            <p class="mt-2 text-sm leading-relaxed" style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">
                Kediaman Mempelai Wanita: Jln. Lombok RT 05 RW 01,<br>Ds. Mergawati, Kec. Kroya, Kab. Cilacap
            </p>
        </div>

        {{-- Maps --}}
        <div data-scroll class="reveal-up delay-400 w-full mt-6">
            <div class="rounded-lg overflow-hidden mb-3" style="border:1px solid rgba(220,200,166,0.8);box-shadow:0 1px 2px rgba(0,0,0,0.05);">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.3!2d109.013!3d-7.633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7aa40000000001%3A0x1!2sDs.+Mergawati%2C+Kec.+Kroya%2C+Kab.+Cilacap!5e0!3m2!1sid!2sid!4v1"
                    width="100%"
                    height="160"
                    style="border:0;display:block;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
            <a href="https://maps.google.com/?q=Ds.+Mergawati+Kec.+Kroya+Kab.+Cilacap"
               target="_blank"
               class="flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-full uppercase tracking-wide hover:opacity-80 transition-opacity"
               style="border:1px solid #84683A;font-family:'Cinzel',serif;font-size:12px;color:#362B24;letter-spacing:0.05em;">
                <svg width="10" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
                </svg>
                BUKA PETUNJUK DI GOOGLE MAPS
            </a>
        </div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 5B: GALERI CAROUSEL
         ──────────────────────────────────────────────── --}}
    {{-- ────────────────────────────────────────────────
         SECTION 5B: GALERI CAROUSEL (DOKUMENTASI CINTA)
         ──────────────────────────────────────────────── --}}
    <section id="section-galeri" data-scroll-section class="py-12"
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
                ['url' => 'https://www.figma.com/img/7cc24d15e7d17075dbc79500643b0ea0c8f551e9', 'title' => 'BUSANA ADAT KERATON'],
                ['url' => 'https://www.figma.com/img/fb8b3a23fadbeae1dd904f39dbeeea4db3431a06', 'title' => 'SENYUMAN BAHAGIA'],
                ['url' => 'https://www.figma.com/img/138b61d8fab9782bac99e00e69b36f0210f19106', 'title' => 'TATAPAN PENUH MAKNA'],
                ['url' => 'https://www.figma.com/img/02aaab813776e7523d5a92b2323f88b6dc00cc52', 'title' => 'IKATAN CINTA KASIH'],
                ['url' => 'https://www.figma.com/img/16a91c562f8c912e3f5562885f43967aae831f63', 'title' => 'BERSAMA SELAMANYA'],
                ['url' => 'https://www.figma.com/img/459081e23ab25b2ba25bfd0d8c5afc1afd4f9971', 'title' => 'MENUJU SATU TUJUAN'],
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
        <div data-scroll class="reveal-up delay-200 px-5 max-w-md mx-auto">
            <div id="gallery-card" data-gallery-items='@json($galleryList)' class="bg-white rounded-3xl p-3.5 shadow-xl border border-stone-100 flex flex-col">
                {{-- Foto Aktif Utama dengan Tombol Navigasi & Caption --}}
                <div class="relative w-full overflow-hidden rounded-2xl bg-stone-100" style="aspect-ratio: 4/5;">
                    <img id="gallery-main-img"
                         src="{{ $galleryList[0]['url'] }}"
                         alt="{{ $galleryList[0]['title'] }}"
                         class="w-full h-full object-cover transition-opacity duration-300">

                    {{-- Tombol Kiri --}}
                    <button id="gallery-prev"
                            type="button"
                            aria-label="Foto Sebelumnya"
                            class="absolute left-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/80 hover:bg-white text-stone-700 shadow-md flex items-center justify-center transition-transform active:scale-90 z-10 backdrop-blur-xs">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>

                    {{-- Tombol Kanan --}}
                    <button id="gallery-next"
                            type="button"
                            aria-label="Foto Selanjutnya"
                            class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/80 hover:bg-white text-stone-700 shadow-md flex items-center justify-center transition-transform active:scale-90 z-10 backdrop-blur-xs">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>

                    {{-- Overlay Judul Foto di Bawah --}}
                    <div class="absolute bottom-0 inset-x-0 pt-16 pb-4 px-4 bg-gradient-to-t from-black/80 via-black/40 to-transparent pointer-events-none flex justify-center">
                        <p id="gallery-main-title"
                           class="text-center font-bold tracking-widest text-white text-xs sm:text-sm uppercase drop-shadow-md"
                           style="font-family:'Cinzel',serif;letter-spacing:0.18em;">
                            {{ $galleryList[0]['title'] }}
                        </p>
                    </div>
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
            <div id="gallery-thumbnails" class="flex gap-2.5 mt-4 overflow-x-auto py-2 px-1 justify-center scrollbar-none">
                @foreach($galleryList as $index => $item)
                    <button type="button"
                            data-gallery-thumb="{{ $index }}"
                            class="gallery-thumb-btn relative flex-shrink-0 w-12 h-14 sm:w-14 sm:h-16 rounded-lg overflow-hidden border-2 transition-all duration-200 {{ $index === 0 ? 'border-[#8B6C3F] scale-105 shadow-sm' : 'border-transparent opacity-60 hover:opacity-100' }}">
                        <img src="{{ $item['url'] }}" alt="thumb" class="w-full h-full object-cover">
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
    <section id="section-rsvp" data-scroll-section class="px-6 py-12"
             style="background-color:#FFFCF7;border-top:1px solid rgba(223,211,189,0.5);">

        <div class="text-center max-w-sm mx-auto mb-8">
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

        <form id="rsvp-form" data-scroll class="reveal-up delay-200 flex flex-col gap-5 max-w-sm mx-auto" novalidate>
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

        <div id="rsvp-message" class="mt-5 max-w-sm mx-auto" style="display:none;"></div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 7: BUKU TAMU (UNTAIAN DOA RESTU)
         ──────────────────────────────────────────────── --}}
    <section id="section-bukutamu" data-scroll-section class="px-6 py-12"
             style="background-color:#FFFCF7;border-top:1px solid rgba(223,211,189,0.5);">

        <div class="text-center max-w-sm mx-auto mb-8">
            <p data-scroll class="reveal-up uppercase tracking-widest mb-1.5"
               style="font-family:'Cinzel',serif;font-size:11px;color:#8B6C3F;letter-spacing:0.25em;">
                UNTAIAN DOA RESTU
            </p>
            <h2 data-scroll class="reveal-up delay-100 font-bold"
                style="font-family:'Playfair Display',serif;font-size:28px;color:#2F241D;">
                Buku Tamu
            </h2>
        </div>

        <div data-scroll class="reveal-up delay-200 wishes-feed max-w-sm mx-auto flex flex-col gap-3.5" id="wishes-feed">
            <p class="text-center text-sm py-6 italic" style="color:rgba(107,77,56,0.5);">
                Memuat ucapan...
            </p>
        </div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 8: AMPLOP DIGITAL (TANDA KASIH)
         ──────────────────────────────────────────────── --}}
    <section id="section-amplop" data-scroll-section class="px-6 py-12"
             style="background:#FAF6EE;border-top:1px solid rgba(223,211,189,0.5);">

        <div class="text-center max-w-sm mx-auto mb-8">
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

        <div class="max-w-sm mx-auto flex flex-col gap-4">
            {{-- Rekening 1: Ridho --}}
            <div data-scroll class="reveal-up delay-200 bg-[#F9F5EE] border border-[#D5C2A5] rounded-2xl p-5 shadow-xs">
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
            <div data-scroll class="reveal-up delay-300 bg-[#F9F5EE] border border-[#D5C2A5] rounded-2xl p-5 shadow-xs">
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
    <section id="section-penutup" data-scroll-section class="px-6 py-16 flex flex-col items-center text-center"
             style="background:rgba(243,236,224,0.5);border-top:1px solid #DFD3BD;">

        {{-- Ornamen atas --}}
        <div class="pointer-events-none overflow-hidden mb-6 w-full" style="height:50px;" data-scroll data-scroll-speed="-1">
            <img src="https://www.figma.com/img/{{ '17574254db87dd33f07e2310e520ff806a71cb39' }}"
                 onerror="this.style.display='none'"
                 class="w-full h-full object-cover opacity-70" alt="">
        </div>

        <p data-scroll class="reveal-up uppercase tracking-widest mb-3"
           style="font-family:'Cinzel',serif;font-size:11px;color:#84683A;letter-spacing:0.25em;">
            TURUT MENGUNDANG :
        </p>

        <div data-scroll class="reveal-up delay-100 mb-8 leading-relaxed text-center"
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

        <div data-scroll class="reveal-scale gold-divider mb-8" style="width:140px;"></div>

        <p data-scroll class="reveal-fade delay-200 italic mb-5 leading-relaxed text-center"
           style="font-family:'Playfair Display',serif;font-size:14px;color:#6E5B4F;line-height:1.6;">
            Merupakan suatu kehormatan dan kebahagiaan bagi kami<br>
            apabila Bapak/Ibu/Saudara/i berkenan hadir<br>
            untuk memberikan do'a restu.
        </p>

        <p data-scroll class="reveal-up delay-250 italic font-bold mb-8 text-center"
           style="font-family:'Playfair Display',serif;font-size:15px;color:#3A2517;">
            Wassalamu'alaikum Warahmatullahi Wabarakatuh
        </p>

        <p data-scroll class="reveal-up delay-300 uppercase tracking-widest mb-2"
           style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.25em;">
            KAMI YANG BERBAHAGIA:
        </p>

        <p data-scroll class="reveal-up delay-350 font-bold uppercase tracking-wider mb-6 leading-relaxed"
           style="font-family:'Cinzel',serif;font-size:11px;color:#3A2517;letter-spacing:0.04em;line-height:1.6;">
            KELUARGA BPK. YASMUDIN &amp; IBU RASIWEN<br>
            KELUARGA BPK. WAHYU DARMA PUTRA (ALM) &amp; IBU YENI HANDAYANI
        </p>

        <h2 data-scroll class="reveal-up delay-400 mb-1"
            style="font-family:'Great Vibes',cursive;font-size:54px;color:#3A2517;">
            Astri &amp; Ridho
        </h2>

        <p data-scroll class="reveal-up delay-450 uppercase tracking-widest"
           style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.2em;">
            23 OKTOBER 2026
        </p>

        <div data-scroll class="reveal-scale gold-divider mt-6 mb-4" style="width:128px;"></div>

        <p data-scroll class="reveal-fade delay-200 text-xs"
           style="font-family:'Plus Jakarta Sans',sans-serif;color:rgba(107,77,56,0.5);">
            Made with ❤️ for Astri &amp; Ridho
        </p>

        {{-- Ornamen bawah --}}
        <div class="pointer-events-none overflow-hidden mt-8 w-full" style="height:60px;">
            <img src="https://www.figma.com/img/{{ '17574254db87dd33f07e2310e520ff806a71cb39' }}"
                 onerror="this.style.display='none'"
                 class="w-full h-full object-cover opacity-70" alt="">
        </div>
    </section>

    {{-- ────────────────────────────────────────────────
         BOTTOM NAVIGATION
         ──────────────────────────────────────────────── --}}
    <nav id="bottom-nav" class="fixed bottom-0 left-1/2 -translate-x-1/2 z-40 flex items-center justify-around"
         style="width:100%;max-width:412px;background:rgba(250,245,236,0.95);border-top:1px solid rgba(223,211,189,0.7);backdrop-filter:blur(12px);padding:8px 0;">

        <a data-scroll-to-target="#section-mempelai" class="bottom-nav-item" href="#section-mempelai">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
            Mempelai
        </a>
        <a data-scroll-to-target="#section-acara" class="bottom-nav-item" href="#section-acara">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            Acara
        </a>
        <a data-scroll-to-target="#section-rsvp" class="bottom-nav-item" href="#section-rsvp">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
            RSVP
        </a>
        <a data-scroll-to-target="#section-amplop" class="bottom-nav-item" href="#section-amplop">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><polyline points="1,4 12,13 23,4"/>
            </svg>
            Amplop
        </a>
    </nav>

    {{-- Spacer for bottom nav --}}
    <div style="height:64px;"></div>

</div><!-- /data-scroll-container -->

{{-- Toast copy --}}
<div id="copy-toast">Nomor rekening tersalin!</div>

</body>
</html>
