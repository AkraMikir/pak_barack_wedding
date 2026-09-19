<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin RSVP & Manajemen Tamu Undangan</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            background-color: #F8FAF7;
        }
        .crop-container {
            width: 100%;
            max-width: 300px;
            height: 300px;
            overflow: hidden;
            background-color: #1c1917;
            position: relative;
            border-radius: 0.75rem;
        }
        .crop-container img {
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>
<body class="text-stone-800 p-4 md:p-8">

<div class="max-w-7xl mx-auto space-y-6">

    {{-- Top Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl shadow-xs border border-stone-200">
        <div>
            <h1 class="text-2xl font-bold text-stone-900 tracking-tight">Manajemen Tamu & RSVP</h1>
            <p class="text-sm text-stone-500 mt-1">Kelola daftar tamu, link personal undangan, dan status konfirmasi kehadiran.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('invitation.index') }}" target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-stone-700 bg-stone-100 hover:bg-stone-200 rounded-lg transition-colors border border-stone-300">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
                Lihat Web Undangan
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                        class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-rose-700 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors border border-rose-200 cursor-pointer">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 font-bold">&times;</button>
        </div>
    @endif

    {{-- Metrics Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
        {{-- Total Tamu --}}
        <div class="bg-white p-5 rounded-xl border border-stone-200 shadow-2xs">
            <p class="text-xs uppercase font-bold tracking-wider text-stone-400">Total Tamu</p>
            <p class="text-2xl font-extrabold text-stone-900 mt-2">{{ $metrics['total_guests'] }}</p>
            <p class="text-[11px] text-stone-500 mt-1">Undangan dibuat</p>
        </div>

        {{-- Dibuka --}}
        <div class="bg-white p-5 rounded-xl border border-stone-200 shadow-2xs">
            <p class="text-xs uppercase font-bold tracking-wider text-stone-400">Sudah Dibuka</p>
            <p class="text-2xl font-extrabold text-indigo-600 mt-2">{{ $metrics['total_opened'] }}</p>
            <p class="text-[11px] text-stone-500 mt-1">
                {{ $metrics['total_guests'] > 0 ? round(($metrics['total_opened'] / $metrics['total_guests']) * 100) : 0 }}% dari total
            </p>
        </div>

        {{-- Hadir --}}
        <div class="bg-white p-5 rounded-xl border border-stone-200 shadow-2xs">
            <p class="text-xs uppercase font-bold tracking-wider text-emerald-600">Konfirmasi Hadir</p>
            <p class="text-2xl font-extrabold text-emerald-700 mt-2">{{ $metrics['total_attending'] }}</p>
            <p class="text-[11px] text-emerald-600 font-medium mt-1">{{ $metrics['total_pax'] }} Total Pax / Rombongan</p>
        </div>

        {{-- Tidak Hadir --}}
        <div class="bg-white p-5 rounded-xl border border-stone-200 shadow-2xs">
            <p class="text-xs uppercase font-bold tracking-wider text-rose-500">Tidak Hadir</p>
            <p class="text-2xl font-extrabold text-rose-600 mt-2">{{ $metrics['total_declined'] }}</p>
            <p class="text-[11px] text-stone-500 mt-1">Tamu berhalangan</p>
        </div>

        {{-- Belum Konfirmasi --}}
        <div class="bg-white p-5 rounded-xl border border-stone-200 shadow-2xs col-span-2 md:col-span-1">
            <p class="text-xs uppercase font-bold tracking-wider text-amber-500">Belum Respon</p>
            <p class="text-2xl font-extrabold text-amber-600 mt-2">{{ $metrics['total_unconfirmed'] }}</p>
            <p class="text-[11px] text-stone-500 mt-1">Menunggu respon</p>
        </div>
    </div>

    {{-- Quick Add Guest Form --}}
    <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-xs">
        <h2 class="text-base font-bold text-stone-900 mb-4 flex items-center gap-2">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#84683A" stroke-width="2">
                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="8.5" cy="7" r="4"></circle>
                <line x1="20" y1="8" x2="20" y2="14"></line>
                <line x1="23" y1="11" x2="17" y2="11"></line>
            </svg>
            Tambah Tamu Undangan
        </h2>

        <form action="{{ route('admin.guests.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            @csrf
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-600 mb-1.5">Nama Tamu *</label>
                <input type="text" name="name" required placeholder="Contoh: Budi Santoso"
                       class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-lg text-sm text-stone-900 focus:outline-none focus:ring-2 focus:ring-amber-700/20 focus:border-amber-700">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-600 mb-1.5">Kategori Tamu</label>
                <select name="category"
                        class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-lg text-sm text-stone-900 focus:outline-none focus:ring-2 focus:ring-amber-700/20 focus:border-amber-700">
                    <option value="">-- Tanpa Kategori --</option>
                    <option value="VIP">VIP</option>
                    <option value="Keluarga">Keluarga</option>
                    <option value="Teman">Teman</option>
                    <option value="Rekan Kerja">Rekan Kerja</option>
                    <option value="Tetangga">Tetangga</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-600 mb-1.5">WhatsApp *</label>
                <input type="text" name="phone_number" required value="{{ old('phone_number') }}" placeholder="Contoh: 081234567890"
                       class="w-full px-3.5 py-2.5 bg-stone-50 border @error('phone_number') border-rose-500 @else border-stone-300 @enderror rounded-lg text-sm text-stone-900 focus:outline-none focus:ring-2 focus:ring-amber-700/20 focus:border-amber-700">
                @error('phone_number')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-3">
                <label class="block text-xs font-semibold uppercase tracking-wider text-stone-600 mb-1.5">Teks Turut Mengundang *</label>
                <input type="text" name="custom_turut_mengundang" required
                       placeholder="Keluarga Besar ******* / Bro ******* Team *******"
                       class="w-full px-3.5 py-2.5 bg-stone-50 border border-stone-300 rounded-lg text-sm text-stone-900 focus:outline-none focus:ring-2 focus:ring-amber-700/20 focus:border-amber-700">
                <p class="text-[11px] text-stone-400 mt-1">Akan ditampilkan di bagian Turut Mengundang saat tamu ini membuka undangannya.</p>
            </div>

            <div class="md:col-span-3">
                <button type="submit"
                        class="w-full md:w-auto px-6 py-2.5 bg-stone-900 hover:bg-stone-800 text-amber-100 font-semibold text-sm rounded-lg transition-all shadow-xs flex items-center justify-center gap-2">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Simpan Tamu
                </button>
            </div>
        </form>
    </div>

    {{-- Pengaturan Foto Mempelai --}}
    <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-xs">
        <h2 class="text-base font-bold text-stone-900 mb-1 flex items-center gap-2">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#84683A" stroke-width="2">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                <polyline points="21 15 16 10 5 21"></polyline>
            </svg>
            Foto Pasangan Mempelai
        </h2>
        <p class="text-xs text-stone-500 mb-4">Unggah foto mempelai wanita dan pria untuk ditampilkan di halaman depan undangan (format: JPG, PNG, WEBP, maks 5MB).</p>

        <form action="{{ route('admin.settings.photos') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
            @csrf

            {{-- Mempelai Wanita --}}
            <div class="p-4 rounded-xl border border-stone-200 bg-stone-50/50 flex flex-col gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-24 border border-stone-300 overflow-hidden bg-stone-200 flex-shrink-0 flex items-center justify-center shadow-2xs"
                         style="border-top-left-radius: 2rem; border-top-right-radius: 0; border-bottom-left-radius: 0; border-bottom-right-radius: 0;">
                        @if(!empty($fotoWanita))
                            <img src="{{ asset('storage/' . $fotoWanita) }}" class="w-full h-full object-cover" alt="Wanita">
                        @else
                            <span class="text-[10px] text-stone-400 text-center font-bold">Wanita</span>
                        @endif
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1">Foto Mempelai Wanita (Astri)</label>
                        <input type="file" id="input_foto_wanita" name="foto_wanita" accept="image/*"
                               class="w-full text-xs text-stone-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-stone-200 file:text-stone-700 hover:file:bg-stone-300 cursor-pointer">
                    </div>
                </div>
                {{-- Cropper Container & Controls --}}
                <div id="crop_wrap_wanita" class="hidden flex flex-col items-center gap-2 mt-2">
                    <div class="crop-container" id="container_wanita">
                        <img id="preview_wanita" src="" alt="Preview">
                    </div>
                    <div id="actions_wanita" class="hidden flex gap-2 w-full max-w-[300px]">
                        <button type="button" id="btn_reset_wanita" class="flex-1 py-1.5 px-3 bg-stone-200 hover:bg-stone-300 text-stone-700 text-xs font-semibold rounded-md transition-colors">Reset</button>
                        <button type="button" id="btn_crop_wanita" class="flex-1 py-1.5 px-3 bg-amber-700 hover:bg-amber-800 text-white text-xs font-semibold rounded-md transition-colors">Crop &amp; Upload</button>
                    </div>
                </div>
            </div>

            {{-- Mempelai Pria --}}
            <div class="p-4 rounded-xl border border-stone-200 bg-stone-50/50 flex flex-col gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-24 border border-stone-300 overflow-hidden bg-stone-200 flex-shrink-0 flex items-center justify-center shadow-2xs"
                         style="border-top-right-radius: 2rem; border-top-left-radius: 0; border-bottom-left-radius: 0; border-bottom-right-radius: 0;">
                        @if(!empty($fotoPria))
                            <img src="{{ asset('storage/' . $fotoPria) }}" class="w-full h-full object-cover" alt="Pria">
                        @else
                            <span class="text-[10px] text-stone-400 text-center font-bold">Pria</span>
                        @endif
                    </div>
                    <div class="flex-1">
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1">Foto Mempelai Pria (Ridho)</label>
                        <input type="file" id="input_foto_pria" name="foto_pria" accept="image/*"
                               class="w-full text-xs text-stone-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-stone-200 file:text-stone-700 hover:file:bg-stone-300 cursor-pointer">
                    </div>
                </div>
                {{-- Cropper Container & Controls --}}
                <div id="crop_wrap_pria" class="hidden flex flex-col items-center gap-2 mt-2">
                    <div class="crop-container" id="container_pria">
                        <img id="preview_pria" src="" alt="Preview">
                    </div>
                    <div id="actions_pria" class="hidden flex gap-2 w-full max-w-[300px]">
                        <button type="button" id="btn_reset_pria" class="flex-1 py-1.5 px-3 bg-stone-200 hover:bg-stone-300 text-stone-700 text-xs font-semibold rounded-md transition-colors">Reset</button>
                        <button type="button" id="btn_crop_pria" class="flex-1 py-1.5 px-3 bg-amber-700 hover:bg-amber-800 text-white text-xs font-semibold rounded-md transition-colors">Crop &amp; Upload</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Pengaturan Tanggal Acara & Countdown --}}
    <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-2xs">
        <h2 class="text-sm font-bold uppercase tracking-wider text-stone-800 mb-1 flex items-center gap-2">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-amber-700">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            Pengaturan Tanggal Acara &amp; Countdown
        </h2>
        <p class="text-xs text-stone-500 mb-4">Tentukan tanggal dan waktu akad/resepsi pernikahan. Tanggal ini akan otomatis menjadi target hitung mundur (countdown), teks tanggal acara, dan tombol simpan ke kalender tamu.</p>

        <form action="{{ route('admin.settings.countdown') }}" method="POST" class="flex flex-col sm:flex-row items-start sm:items-end gap-4">
            @csrf
            <div class="w-full sm:w-80">
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1">Tanggal &amp; Waktu Acara</label>
                <input type="datetime-local" name="wedding_date" required
                       value="{{ old('wedding_date', $weddingDate) }}"
                       class="w-full px-3 py-2 border border-stone-300 rounded-lg text-xs focus:ring-2 focus:ring-amber-500 focus:outline-none">
            </div>
            <button type="submit"
                    class="px-5 py-2.5 bg-stone-800 hover:bg-stone-700 text-amber-100 font-semibold text-xs rounded-lg transition-all shadow-xs flex items-center gap-2">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    <polyline points="7 3 7 8 15 8"></polyline>
                </svg>
                Simpan Tanggal Acara
            </button>
        </form>
    </div>

    {{-- Manajemen Galeri Foto Pre-Wedding --}}
    <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-2xs">
        <h2 class="text-sm font-bold uppercase tracking-wider text-stone-800 mb-1 flex items-center gap-2">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-amber-700">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                <polyline points="21 15 16 10 5 21"></polyline>
            </svg>
            Galeri Pre-Wedding (Momen Bersama)
        </h2>
        <p class="text-xs text-stone-500 mb-4">Unggah foto momen bersama / pre-wedding beserta judul keterangan (misal: "BUSANA ADAT KERATON"). Foto akan tampil di slider galeri berbingkai elegan pada halaman undangan.</p>

        {{-- Form Upload Galeri --}}
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="bg-stone-50 p-4 rounded-xl border border-stone-200 mb-6 flex flex-col gap-4">
            @csrf
            <div class="flex flex-col md:flex-row items-end gap-4">
                <div class="w-full md:w-1/2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1">Pilih Foto (Maks 5MB)</label>
                    <input type="file" id="input_gallery_image" name="image" accept="image/*" required
                           class="w-full text-xs text-stone-500 file:mr-3 file:py-2 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-stone-200 file:text-stone-700 hover:file:bg-stone-300 cursor-pointer">
                </div>
                <div class="w-full md:w-1/2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-700 mb-1">Judul / Keterangan Foto</label>
                    <input type="text" name="title" placeholder="Contoh: BUSANA ADAT KERATON"
                           class="w-full px-3 py-2 border border-stone-300 rounded-lg text-xs focus:ring-2 focus:ring-amber-500 focus:outline-none">
                </div>
                <button type="submit"
                        class="w-full md:w-auto px-5 py-2.5 bg-stone-800 hover:bg-stone-700 text-amber-100 font-semibold text-xs rounded-lg transition-all shadow-xs flex items-center justify-center gap-2 whitespace-nowrap">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Tambah Foto Galeri
                </button>
            </div>
            {{-- Cropper Container & Controls --}}
            <div id="crop_wrap_gallery" class="hidden flex flex-col items-center gap-2 mt-2">
                <div class="crop-container" id="container_gallery">
                    <img id="preview_gallery" src="" alt="Preview">
                </div>
                <div id="actions_gallery" class="hidden flex gap-2 w-full max-w-[300px]">
                    <button type="button" id="btn_reset_gallery" class="w-full py-1.5 px-3 bg-stone-200 hover:bg-stone-300 text-stone-700 text-xs font-semibold rounded-md transition-colors">Reset Crop Box</button>
                </div>
            </div>
        </form>

        {{-- Grid Foto Galeri Tersimpan --}}
        <div>
            <h3 class="text-xs font-bold uppercase tracking-wider text-stone-600 mb-3">Foto Tersimpan ({{ $galleries->count() }})</h3>
            @if($galleries->isEmpty())
                <p class="text-xs text-stone-400 italic py-3">Belum ada foto galeri yang diunggah. Tampilan undangan akan menggunakan foto dokumentasi bawaan.</p>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                    @foreach($galleries as $item)
                        <div class="relative group rounded-xl border border-stone-200 overflow-hidden bg-stone-100 flex flex-col">
                            <div class="aspect-square w-full overflow-hidden bg-stone-200">
                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                            </div>
                            <div class="p-2 flex-1 flex flex-col justify-between">
                                <p class="text-[10px] font-bold text-stone-700 uppercase tracking-wide truncate" title="{{ $item->title }}">
                                    {{ $item->title ?: 'Tanpa Judul' }}
                                </p>
                                <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST" class="mt-2 text-right"
                                      onsubmit="return confirm('Hapus foto ini dari galeri?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[10px] text-red-600 hover:text-red-800 font-semibold">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Filter & Search Bar --}}
    <div class="bg-white p-4 rounded-xl border border-stone-200 shadow-2xs flex flex-col md:flex-row md:items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.guests.index') }}" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <div class="relative flex-1 md:w-64">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama tamu..."
                       class="w-full pl-9 pr-4 py-2 text-sm bg-stone-50 border border-stone-300 rounded-lg text-stone-800 focus:outline-none focus:border-stone-500">
                <svg class="absolute left-3 top-2.5 text-stone-400" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>

            <select name="status" onchange="this.form.submit()"
                    class="py-2 px-3 text-sm bg-stone-50 border border-stone-300 rounded-lg text-stone-700 focus:outline-none">
                <option value="" {{ empty($status) ? 'selected' : '' }}>Semua Status</option>
                <option value="hadir" {{ $status === 'hadir' ? 'selected' : '' }}>Konfirmasi Hadir</option>
                <option value="tidak" {{ $status === 'tidak' ? 'selected' : '' }}>Tidak Hadir</option>
                <option value="belum" {{ $status === 'belum' ? 'selected' : '' }}>Belum Respon</option>
            </select>

            <button type="submit" class="px-4 py-2 bg-stone-100 hover:bg-stone-200 text-stone-700 text-sm font-semibold rounded-lg border border-stone-300 transition-colors">
                Cari
            </button>

            @if(!empty($search) || !empty($status))
                <a href="{{ route('admin.guests.index') }}" class="text-xs text-rose-600 hover:underline font-medium">
                    Reset Filter
                </a>
            @endif
        </form>

        <p class="text-xs text-stone-500">
            Menampilkan <span class="font-bold text-stone-800">{{ $guests->total() }}</span> tamu
        </p>
    </div>

    {{-- Guests Table --}}
    <div class="bg-white rounded-2xl border border-stone-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-stone-50 text-stone-500 text-xs uppercase tracking-wider border-b border-stone-200">
                    <tr>
                        <th class="py-3.5 px-4 font-semibold">Tamu</th>
                        <th class="py-3.5 px-4 font-semibold">Status Buka</th>
                        <th class="py-3.5 px-4 font-semibold">Konfirmasi RSVP</th>
                        <th class="py-3.5 px-4 font-semibold">Ucapan</th>
                        <th class="py-3.5 px-4 font-semibold text-right">Aksi & Share</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($guests as $guest)
                        @php
                            $invitationUrl = route('invitation.guest', $guest->slug);
                            $waNumber = preg_replace('/[^0-9]/', '', $guest->phone_number ?? '');
                            if (str_starts_with($waNumber, '0')) {
                                $waNumber = '62' . substr($waNumber, 1);
                            }
                            $messageText = "_Assalamualaikum Warahmatullahi Wabarakatuh_\n\n"
                                . "Tanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i *{$guest->name}* untuk menghadiri acara kami.\n\n"
                                . "*Berikut link undangan kami*, untuk info lengkap dari acara bisa kunjungi :\n\n"
                                . "{$invitationUrl}\n\n"
                                . "Merupakan suatu kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan untuk hadir dan memberikan doa restu.\n\n"
                                . "*Mohon maaf perihal undangan hanya di bagikan melalui pesan ini.*\n\n"
                                . "Dan agar selalu menjaga kesehatan bersama serta datang pada waktu yang telah ditentukan.*\n\n"
                                . "Terima kasih banyak atas perhatiannya.\n\n"
                                . "_Wassalamualaikum Warahmatullahi Wabarakatuh_";
                            $waMessage = rawurlencode($messageText);
                            $waShareUrl = $waNumber ? "https://api.whatsapp.com/send?phone={$waNumber}&text={$waMessage}" : "https://api.whatsapp.com/send?text={$waMessage}";
                        @endphp
                        <tr class="hover:bg-stone-50/70 transition-colors">
                            {{-- Nama & Kategori --}}
                            <td class="py-4 px-4">
                                <div class="font-bold text-stone-900">{{ $guest->name }}</div>
                                <div class="flex items-center gap-2 mt-1">
                                    @if($guest->category)
                                        <span class="inline-block text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-amber-50 text-amber-800 border border-amber-200/60">
                                            {{ $guest->category }}
                                        </span>
                                    @endif
                                    @if($guest->phone_number)
                                        <span class="text-xs text-stone-400 font-mono">{{ $guest->phone_number }}</span>
                                    @endif
                                </div>
                                @if($guest->custom_turut_mengundang)
                                    <div class="text-[11px] text-amber-900/80 mt-1 font-medium bg-amber-50/70 border border-amber-200/50 rounded px-2 py-0.5 inline-block">
                                        <span class="text-stone-400 font-normal">Turut mengundang:</span> {{ $guest->custom_turut_mengundang }}
                                    </div>
                                @endif
                            </td>

                            {{-- Status Buka --}}
                            <td class="py-4 px-4">
                                @if($guest->opened_at)
                                    <span class="inline-flex items-center gap-1 text-xs font-medium text-emerald-700 bg-emerald-50 px-2 py-1 rounded-md border border-emerald-200">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        {{ $guest->opened_at->format('d M H:i') }}
                                    </span>
                                @else
                                    <span class="text-xs text-stone-400 italic">Belum dibuka</span>
                                @endif
                            </td>

                            {{-- Status RSVP --}}
                            <td class="py-4 px-4">
                                @if($guest->rsvp)
                                    @if($guest->rsvp->status_hadir === 'Hadir')
                                        <span class="inline-flex items-center gap-1 text-xs font-bold text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-full">
                                            ✓ Hadir ({{ $guest->rsvp->jumlah_rombongan ?? 1 }} pax)
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-xs font-bold text-rose-700 bg-rose-50 px-2.5 py-1 rounded-full border border-rose-200">
                                            ✕ Tidak Hadir
                                        </span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center text-xs font-medium text-stone-500 bg-stone-100 px-2.5 py-0.5 rounded-full">
                                        Belum Respon
                                    </span>
                                @endif
                            </td>

                            {{-- Ucapan --}}
                            <td class="py-4 px-4 max-w-xs">
                                @if($guest->rsvp && $guest->rsvp->wishes)
                                    <p class="text-xs text-stone-600 italic line-clamp-2" title="{{ $guest->rsvp->wishes }}">
                                        "{{ $guest->rsvp->wishes }}"
                                    </p>
                                @else
                                    <span class="text-xs text-stone-300">-</span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="py-4 px-4 text-right">
                                <div class="inline-flex items-center gap-1.5">
                                    {{-- Salin Link --}}
                                    <button onclick="copyUrl('{{ $invitationUrl }}', this)"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-md border border-stone-200 transition-all">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                        </svg>
                                        <span>Salin</span>
                                    </button>

                                    {{-- WhatsApp Share --}}
                                    <a href="{{ $waShareUrl }}" target="_blank"
                                       class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium bg-emerald-600 hover:bg-emerald-700 text-white rounded-md transition-all shadow-2xs">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M17.472 14.382c-.301-.15-1.78-.878-2.056-.978-.276-.1-.476-.15-.676.15-.2.301-.776.978-.952 1.179-.175.2-.351.226-.652.075-.3-.15-1.268-.467-2.416-1.491-.893-.797-1.496-1.782-1.672-2.083-.175-.301-.019-.464.132-.614.136-.135.301-.351.452-.527.15-.175.2-.301.301-.501.1-.2.05-.376-.025-.526-.075-.15-.677-1.633-.928-2.235-.245-.586-.494-.506-.677-.516h-.578c-.2 0-.526.075-.802.376-.276.301-1.053 1.028-1.053 2.508 0 1.48 1.078 2.909 1.229 3.11.15.2 2.12 3.238 5.137 4.542.718.311 1.278.497 1.715.636.721.23 1.377.197 1.896.12.577-.087 1.78-.727 2.03-1.429.251-.702.251-1.304.176-1.429-.076-.125-.276-.2-.577-.35z"/>
                                        </svg>
                                        <span>WA</span>
                                    </a>

                                    {{-- Hapus --}}
                                    <form action="{{ route('admin.guests.destroy', $guest) }}" method="POST"
                                          onsubmit="return confirm('Hapus data tamu {{ $guest->name }}?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-stone-400 hover:text-rose-600 transition-colors" title="Hapus">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-stone-400 italic">
                                Belum ada data tamu. Gunakan formulir di atas untuk menambahkan tamu undangan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($guests->hasPages())
            <div class="p-4 border-t border-stone-200 bg-stone-50">
                {{ $guests->links() }}
            </div>
        @endif
    </div>

</div>

<div id="toast" class="fixed bottom-5 right-5 bg-stone-900 text-amber-100 text-xs font-medium px-4 py-2.5 rounded-lg shadow-lg opacity-0 transition-opacity duration-300 pointer-events-none">
    Link undangan tersalin!
</div>

<script>
function copyUrl(url, btn) {
    navigator.clipboard.writeText(url).then(() => {
        const span = btn.querySelector('span');
        const orig = span.textContent;
        span.textContent = 'OK!';
        btn.classList.add('bg-emerald-100', 'text-emerald-800');

        const toast = document.getElementById('toast');
        toast.classList.remove('opacity-0');
        setTimeout(() => {
            span.textContent = orig;
            btn.classList.remove('bg-emerald-100', 'text-emerald-800');
            toast.classList.add('opacity-0');
        }, 2000);
    }).catch(() => {
        alert('Gagal menyalin link: ' + url);
    });
}

function setupCropper(config) {
    const input = document.getElementById(config.inputId);
    const wrap = document.getElementById(config.wrapId);
    const container = document.getElementById(config.containerId);
    const preview = document.getElementById(config.previewId);
    const actions = document.getElementById(config.actionsId);
    const btnReset = document.getElementById(config.btnResetId);
    const btnCrop = config.btnCropId ? document.getElementById(config.btnCropId) : null;

    if (!input || !preview || !container) return;

    let cropper = null;
    let isCroppingSubmit = false;
    const form = input.closest('form');

    input.addEventListener('change', function (e) {
        const files = e.target.files;
        if (!files || !files.length) return;

        const file = files[0];
        const reader = new FileReader();
        reader.onload = function (event) {
            preview.src = event.target.result;
            wrap.classList.remove('hidden');
            actions.classList.remove('hidden');

            if (cropper) {
                cropper.destroy();
            }

            cropper = new Cropper(preview, {
                aspectRatio: NaN,
                viewMode: 1,
                autoCropArea: 1,
                ready() {
                    const cData = cropper.getContainerData();
                    cropper.setCropBoxData({
                        left: 0,
                        top: 0,
                        width: cData.width,
                        height: cData.height
                    });
                }
            });
        };
        reader.readAsDataURL(file);
    });

    if (btnReset) {
        btnReset.addEventListener('click', function (e) {
            e.preventDefault();
            if (!cropper) return;
            const cData = cropper.getContainerData();
            cropper.reset();
            cropper.setCropBoxData({
                left: 0,
                top: 0,
                width: cData.width,
                height: cData.height
            });
        });
    }

    function processCropAndSubmit() {
        if (!cropper || isCroppingSubmit || !form) return;

        isCroppingSubmit = true;

        const canvas = cropper.getCroppedCanvas({
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
        });

        const originalFile = input.files[0];
        const mimeType = (originalFile && originalFile.type) ? originalFile.type : 'image/jpeg';
        const quality = (mimeType === 'image/jpeg' || mimeType === 'image/webp') ? 0.98 : undefined;

        canvas.toBlob(function (blob) {
            if (!blob) {
                isCroppingSubmit = false;
                return;
            }

            const fileName = originalFile ? originalFile.name : 'photo.jpg';
            const croppedFile = new File([blob], fileName, { type: mimeType, lastModified: Date.now() });

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(croppedFile);
            input.files = dataTransfer.files;

            form.submit();
        }, mimeType, quality);
    }

    if (btnCrop) {
        btnCrop.addEventListener('click', function (e) {
            e.preventDefault();
            processCropAndSubmit();
        });
    }

    if (form) {
        form.addEventListener('submit', function (e) {
            if (cropper && !isCroppingSubmit) {
                e.preventDefault();
                processCropAndSubmit();
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    setupCropper({
        inputId: 'input_foto_wanita',
        wrapId: 'crop_wrap_wanita',
        containerId: 'container_wanita',
        previewId: 'preview_wanita',
        actionsId: 'actions_wanita',
        btnResetId: 'btn_reset_wanita',
        btnCropId: 'btn_crop_wanita'
    });

    setupCropper({
        inputId: 'input_foto_pria',
        wrapId: 'crop_wrap_pria',
        containerId: 'container_pria',
        previewId: 'preview_pria',
        actionsId: 'actions_pria',
        btnResetId: 'btn_reset_pria',
        btnCropId: 'btn_crop_pria'
    });

    setupCropper({
        inputId: 'input_gallery_image',
        wrapId: 'crop_wrap_gallery',
        containerId: 'container_gallery',
        previewId: 'preview_gallery',
        actionsId: 'actions_gallery',
        btnResetId: 'btn_reset_gallery'
    });
});
</script>

</body>
</html>
