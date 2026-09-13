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
</head>

<body class="overflow-x-hidden overflow-hidden" style="background-color:#FFFCF7;" @if(isset($guest) && $guest) data-guest-id="{{ $guest->id }}" @endif>

{{-- ════════════════════════════════════════════════════
     COVER OVERLAY (Section 1 – Hero)
     Ditampilkan fullscreen sebelum tamu klik "Buka Undangan"
     ════════════════════════════════════════════════════ --}}
<div id="cover-overlay" class="fixed inset-0 z-50 flex flex-col items-center justify-center overflow-hidden" style="background-color:#FFFCF7;">

    {{-- Ornamen atas --}}
    <div class="absolute top-0 left-0 right-0 pointer-events-none overflow-hidden" style="height:120px;">
        <img src="https://www.figma.com/img/{{ '17574254db87dd33f07e2310e520ff806a71cb39' }}"
             onerror="this.style.display='none'"
             class="w-full h-full object-cover opacity-80" alt="ornamen">
    </div>

    {{-- Konten utama cover --}}
    <div class="relative z-10 flex flex-col items-center px-8 text-center" style="padding-top:2rem;">

        {{-- Halo light blur --}}
        <div class="absolute pointer-events-none" style="width:288px;height:288px;background:rgba(212,181,128,0.22);filter:blur(32px);border-radius:9999px;top:50%;left:50%;transform:translate(-50%,-60%);z-index:0;"></div>

        {{-- Wayang kayon illustration (ornamen tengah) --}}
        <div class="relative z-10 mb-2" style="width:120px;height:140px;">
            <img src="https://www.figma.com/img/{{ '2d338c3f7f73313cae1efa6bc89ef5bcb655b379' }}"
                 onerror="this.style.display='none'"
                 class="w-full h-full object-contain" alt="kayon">
        </div>

        {{-- "The Wedding of" --}}
        <p class="relative z-10 mb-1" style="font-family:'Alex Brush',cursive;font-size:24px;color:#A17839;line-height:32px;">
            The Wedding of
        </p>

        {{-- Nama besar --}}
        <h1 class="relative z-10 mb-1" style="font-family:'Great Vibes',cursive;font-size:58px;line-height:1.25;color:#3A2517;letter-spacing:0.025em;">
            Astri &amp; Ridho
        </h1>

        {{-- Divider emas --}}
        <div class="gold-divider relative z-10 my-3" style="width:160px;"></div>

        {{-- Nama lengkap --}}
        <p class="relative z-10 tracking-widest uppercase mb-4" style="font-family:'Cinzel',serif;font-size:11px;color:#6B4D38;letter-spacing:0.2em;">
            SULASTRI &amp; RIDHO IRIANO SUDARMAZENA
        </p>

        {{-- Card tamu undangan --}}
        <div class="relative z-10 w-full rounded-2xl mb-4 text-center"
             style="background:rgba(240,228,206,0.45);border:1px solid rgba(161,120,57,0.35);backdrop-filter:blur(2px);padding:20px 16px;border-top:none;border-bottom:none;">
            <p class="uppercase tracking-widest text-center mb-1"
               style="font-family:'Cinzel',serif;font-size:10px;color:#6B4D38;letter-spacing:0.22em;">
                KEPADA YTH. BAPAK/IBU/SAUDARA/I:
            </p>
            <p class="text-center font-bold"
               style="font-family:'Playfair Display',serif;font-size:20px;color:#3A2517;">
                {{ isset($guest) && $guest ? $guest->name : request()->query('to', 'Tamu Undangan') }}
            </p>
            <p class="text-center italic mt-1"
               style="font-family:'Playfair Display',serif;font-size:10px;color:rgba(107,77,56,0.65);">
                *Mohon maaf apabila ada kesalahan penulisan nama/gelar
            </p>
        </div>

        {{-- CTA Button --}}
        <button data-buka-undangan
            class="relative z-10 flex items-center gap-2 px-8 py-3 rounded-full uppercase tracking-widest transition-opacity hover:opacity-80 active:scale-95"
            style="background:#3A2517;border:1px solid #A17839;font-family:'Cinzel',serif;font-size:12px;color:#FAF0DF;letter-spacing:0.2em;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
            BUKA UNDANGAN
        </button>
    </div>

    {{-- Ornamen bawah --}}
    <div class="absolute bottom-0 left-0 right-0 pointer-events-none overflow-hidden" style="height:100px;">
        <img src="https://www.figma.com/img/{{ '17574254db87dd33f07e2310e520ff806a71cb39' }}"
             onerror="this.style.display='none'"
             class="w-full h-full object-cover opacity-80" alt="ornamen">
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
    <section id="section-countdown" data-scroll-section class="py-4"
             style="background:rgba(243,236,224,0.3);border-top:1px solid rgba(223,211,189,0.5);border-bottom:1px solid rgba(223,211,189,0.5);">

        {{-- Ornamen batik top --}}
        <div class="pointer-events-none overflow-hidden" style="height:60px;" data-scroll data-scroll-speed="-1">
            <img src="https://www.figma.com/img/{{ '17574254db87dd33f07e2310e520ff806a71cb39' }}"
                 onerror="this.style.display='none'"
                 class="w-full h-full object-cover opacity-60" alt="">
        </div>

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

        <div class="px-6 py-10 text-center">
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
    <section id="section-galeri" data-scroll-section class="py-12"
             style="background:rgba(247,240,229,0.5);border-top:1px solid rgba(223,211,189,0.5);">

        {{-- Ornamen atas --}}
        <div class="pointer-events-none overflow-hidden" style="height:50px;" data-scroll data-scroll-speed="-1">
            <img src="https://www.figma.com/img/{{ '5fc4f6487203810719709f905c982c4822ceb697' }}"
                 onerror="this.style.display='none'"
                 class="w-full h-full object-cover opacity-60" alt="">
        </div>

        <div class="px-6 pt-6">
            <p data-scroll class="reveal-up uppercase tracking-widest text-center mb-1"
               style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.25em;">
                GALERI
            </p>
            <h2 data-scroll class="reveal-up delay-100 font-bold text-center mb-6"
                style="font-family:'Playfair Display',serif;font-size:24px;color:#362B24;">
                Momen Bersama
            </h2>
        </div>

        {{-- Film strip carousel --}}
        <div data-scroll class="reveal-up delay-200 px-4">
            <div class="carousel-wrapper">
                @php
                    $prewedImages = [
                        '7cc24d15e7d17075dbc79500643b0ea0c8f551e9',
                        'fb8b3a23fadbeae1dd904f39dbeeea4db3431a06',
                        '138b61d8fab9782bac99e00e69b36f0210f19106',
                        '02aaab813776e7523d5a92b2323f88b6dc00cc52',
                        '16a91c562f8c912e3f5562885f43967aae831f63',
                        '459081e23ab25b2ba25bfd0d8c5afc1afd4f9971',
                    ];
                @endphp

                @foreach($prewedImages as $i => $ref)
                    <div class="carousel-item">
                        <img src="https://www.figma.com/img/{{ $ref }}"
                             onerror="this.style.background='rgba(161,120,57,0.15)';this.style.minHeight='260px';"
                             loading="lazy"
                             alt="Pre-wedding {{ $i + 1 }}">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Ornamen bawah --}}
        <div class="pointer-events-none overflow-hidden mt-4" style="height:50px;">
            <img src="https://www.figma.com/img/{{ '5fc4f6487203810719709f905c982c4822ceb697' }}"
                 onerror="this.style.display='none'"
                 class="w-full h-full object-cover opacity-60" alt="">
        </div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 6: FORM RSVP
         ──────────────────────────────────────────────── --}}
    <section id="section-rsvp" data-scroll-section class="px-6 py-10"
             style="background-color:#FFFCF7;border-top:1px solid rgba(223,211,189,0.5);">

        <p data-scroll class="reveal-up uppercase tracking-widest text-center mb-1"
           style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.25em;">
            KONFIRMASI KEHADIRAN
        </p>
        <h2 data-scroll class="reveal-up delay-100 font-bold text-center mb-2"
            style="font-family:'Playfair Display',serif;font-size:24px;color:#362B24;">
            Konfirmasi RSVP
        </h2>
        <p data-scroll class="reveal-up delay-200 text-center text-sm mb-8"
           style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">
            Kehadiranmu adalah kebahagiaan kami
        </p>

        <form id="rsvp-form" data-scroll class="reveal-up delay-300 flex flex-col gap-4" novalidate>
            @csrf
            @if(isset($guest) && $guest)
                <input type="hidden" name="guest_id" value="{{ $guest->id }}">
            @endif

            {{-- Nama Tamu --}}
            <div>
                <label class="block mb-1 uppercase tracking-wider text-xs"
                       style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.1em;">
                    Nama
                </label>
                <input type="text" name="guest_name"
                       value="{{ isset($guest) && $guest ? $guest->name : request()->query('to') }}"
                       placeholder="Nama lengkap Anda"
                       class="form-input"
                       {{ isset($guest) && $guest ? 'readonly' : '' }}
                       required>
            </div>

            {{-- Status Kehadiran --}}
            <div>
                <label class="block mb-2 uppercase tracking-wider text-xs"
                       style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.1em;">
                    Kehadiran
                </label>
                <div class="flex gap-3">
                    <label class="radio-option">
                        <input type="radio" name="status_hadir" value="Hadir" {{ (!isset($guest) || !$guest->rsvp || $guest->rsvp->status_hadir === 'Hadir') ? 'checked' : '' }} class="sr-only">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#84683A" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        <span style="font-family:'Cinzel',serif;font-size:11px;color:#362B24;">Hadir</span>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="status_hadir" value="Tidak" {{ (isset($guest) && $guest->rsvp && $guest->rsvp->status_hadir === 'Tidak') ? 'checked' : '' }} class="sr-only">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#84683A" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                        <span style="font-family:'Cinzel',serif;font-size:11px;color:#362B24;">Tidak Hadir</span>
                    </label>
                </div>
            </div>

            {{-- Jumlah Rombongan --}}
            <div id="field-rombongan" style="{{ (isset($guest) && $guest->rsvp && $guest->rsvp->status_hadir === 'Tidak') ? 'display:none;' : '' }}">
                <label class="block mb-1 uppercase tracking-wider text-xs"
                       style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.1em;">
                    Jumlah Rombongan
                </label>
                <input type="number" name="jumlah_rombongan"
                       min="1" max="50" value="{{ isset($guest) && $guest->rsvp && $guest->rsvp->jumlah_rombongan ? $guest->rsvp->jumlah_rombongan : 1 }}"
                       class="form-input" style="max-width:120px;">
            </div>

            {{-- Ucapan --}}
            <div>
                <label class="block mb-1 uppercase tracking-wider text-xs"
                       style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.1em;">
                    Ucapan &amp; Doa (opsional)
                </label>
                <textarea name="wishes" rows="3"
                          placeholder="Tulis ucapan dan doa terbaik Anda..."
                          class="form-input resize-none">{{ isset($guest) && $guest->rsvp ? $guest->rsvp->wishes : '' }}</textarea>
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="w-full py-3 rounded-full uppercase tracking-widest font-semibold hover:opacity-80 active:scale-95 transition-all"
                    style="background:#3A2517;color:#FAF0DF;font-family:'Cinzel',serif;font-size:12px;letter-spacing:0.2em;">
                KIRIM KONFIRMASI
            </button>
        </form>

        <div id="rsvp-message" class="mt-4" style="display:none;"></div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 7: BUKU TAMU
         ──────────────────────────────────────────────── --}}
    <section id="section-bukutamu" data-scroll-section class="px-6 py-10"
             style="background-color:#FFFCF7;border-top:1px solid rgba(223,211,189,0.5);">

        {{-- Ornamen --}}
        <div class="pointer-events-none overflow-hidden mb-2" style="height:50px;" data-scroll data-scroll-speed="-0.5">
            <img src="https://www.figma.com/img/{{ '2d338c3f7f73313cae1efa6bc89ef5bcb655b379' }}"
                 onerror="this.style.display='none'"
                 class="w-full h-full object-cover opacity-30" alt="">
        </div>

        <p data-scroll class="reveal-up uppercase tracking-widest text-center mb-1"
           style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.25em;">
            DOA &amp; UCAPAN
        </p>
        <h2 data-scroll class="reveal-up delay-100 font-bold text-center mb-6"
            style="font-family:'Playfair Display',serif;font-size:24px;color:#362B24;">
            Buku Tamu
        </h2>

        <div data-scroll class="reveal-up delay-200 wishes-feed" id="wishes-feed">
            <p class="text-center text-sm py-6 italic" style="color:rgba(107,77,56,0.5);">
                Memuat ucapan...
            </p>
        </div>
    </section>

    {{-- ────────────────────────────────────────────────
         SECTION 8: AMPLOP DIGITAL
         ──────────────────────────────────────────────── --}}
    <section id="section-amplop" data-scroll-section class="px-6 py-10"
             style="background:rgba(243,236,224,0.2);border-top:1px solid rgba(223,211,189,0.5);">

        {{-- Ornamen dekorasi --}}
        <div class="pointer-events-none overflow-hidden mb-2" style="height:57px;">
            <img src="https://www.figma.com/img/{{ '5fc4f6487203810719709f905c982c4822ceb697' }}"
                 onerror="this.style.display='none'"
                 class="w-full h-full object-cover opacity-60" alt="">
        </div>

        <p data-scroll class="reveal-up uppercase tracking-widest text-center mb-1"
           style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.25em;">
            UNTUK HADIAH NIKAH
        </p>
        <h2 data-scroll class="reveal-up delay-100 font-bold text-center mb-2"
            style="font-family:'Playfair Display',serif;font-size:24px;color:#362B24;">
            Amplop Digital
        </h2>
        <p data-scroll class="reveal-up delay-200 text-center text-sm mb-8"
           style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">
            Doa restu Anda adalah hadiah terindah bagi kami.<br>
            Namun jika ingin memberikan hadiah, berikut informasinya:
        </p>

        {{-- Rekening 1: Ridho --}}
        <div data-scroll class="reveal-up delay-300 rounded-xl p-5 mb-4"
             style="background:rgba(250,245,236,0.8);border:1px solid rgba(161,120,57,0.35);">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm"
                         style="background:#84683A;color:#FAF0DF;font-family:'Cinzel',serif;">
                        BCA
                    </div>
                    <div>
                        <p class="font-bold text-xs uppercase tracking-wide"
                           style="font-family:'Cinzel',serif;color:#362B24;">Bank BCA</p>
                        <p class="text-xs" style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">
                            RIDHO IRIANO SUDARMAZENA
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between gap-3">
                <p class="font-bold tracking-wider text-lg" style="font-family:'Playfair Display',serif;color:#3A2517;">
                    6755209451
                </p>
                <button data-copy="6755209451"
                        class="px-4 py-1.5 rounded-full text-xs uppercase tracking-wide hover:opacity-80 transition-all active:scale-95"
                        style="border:1px solid #84683A;font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.1em;white-space:nowrap;">
                    Salin
                </button>
            </div>
        </div>

        {{-- Rekening 2: Sulastri --}}
        <div data-scroll class="reveal-up delay-400 rounded-xl p-5 mb-6"
             style="background:rgba(250,245,236,0.8);border:1px solid rgba(161,120,57,0.35);">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm"
                         style="background:#84683A;color:#FAF0DF;font-family:'Cinzel',serif;">
                        BCA
                    </div>
                    <div>
                        <p class="font-bold text-xs uppercase tracking-wide"
                           style="font-family:'Cinzel',serif;color:#362B24;">Bank BCA</p>
                        <p class="text-xs" style="font-family:'Plus Jakarta Sans',sans-serif;color:#6E5B4F;">
                            SULASTRI
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between gap-3">
                <p class="font-bold tracking-wider text-lg" style="font-family:'Playfair Display',serif;color:#3A2517;">
                    7392034636
                </p>
                <button data-copy="7392034636"
                        class="px-4 py-1.5 rounded-full text-xs uppercase tracking-wide hover:opacity-80 transition-all active:scale-95"
                        style="border:1px solid #84683A;font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.1em;white-space:nowrap;">
                    Salin
                </button>
            </div>
        </div>

        {{-- Kado Fisik --}}
        <div data-scroll class="reveal-up delay-500 rounded-xl p-5"
             style="background:rgba(250,245,236,0.5);border:1px solid rgba(161,120,57,0.25);">
            <p class="uppercase tracking-widest mb-2"
               style="font-family:'Cinzel',serif;font-size:10px;color:#84683A;letter-spacing:0.15em;">
                PENGIRIMAN KADO FISIK
            </p>
            <p class="text-sm leading-relaxed" style="font-family:'Plus Jakarta Sans',sans-serif;color:#4A3B32;">
                Jln. Lombok RT 05 RW 01, Ds. Mergawati,<br>
                Kec. Kroya, Kab. Cilacap<br>
                <span class="font-semibold">a.n. SULASTRI / Keluarga Bpk. Yasmudin</span>
            </p>
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
    <nav class="fixed bottom-0 left-1/2 -translate-x-1/2 z-40 flex items-center justify-around"
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
