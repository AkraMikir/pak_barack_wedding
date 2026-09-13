<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Rsvp;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GuestController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $query = Guest::with('rsvp')->latest();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($status === 'hadir') {
            $query->whereHas('rsvp', fn ($q) => $q->where('status_hadir', 'Hadir'));
        } elseif ($status === 'tidak') {
            $query->whereHas('rsvp', fn ($q) => $q->where('status_hadir', 'Tidak'));
        } elseif ($status === 'belum') {
            $query->whereDoesntHave('rsvp');
        }

        $guests = $query->paginate(25)->withQueryString();

        $metrics = [
            'total_guests' => Guest::count(),
            'total_opened' => Guest::whereNotNull('opened_at')->count(),
            'total_attending' => Rsvp::where('status_hadir', 'Hadir')->count(),
            'total_pax' => (int) Rsvp::where('status_hadir', 'Hadir')->sum('jumlah_rombongan'),
            'total_declined' => Rsvp::where('status_hadir', 'Tidak')->count(),
            'total_unconfirmed' => Guest::doesntHave('rsvp')->count(),
        ];

        $fotoWanita = Setting::get('foto_mempelai_wanita');
        $fotoPria = Setting::get('foto_mempelai_pria');
        $weddingDate = Setting::get('wedding_date', '2026-10-23T08:00');

        return view('admin.guests.index', compact('guests', 'metrics', 'search', 'status', 'fotoWanita', 'fotoPria', 'weddingDate'));
    }

    public function updateCountdown(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'wedding_date' => ['required', 'string'],
        ]);

        Setting::set('wedding_date', $validated['wedding_date']);

        return redirect()->route('admin.guests.index')->with('success', 'Tanggal acara & countdown berhasil diperbarui.');
    }

    public function updatePhotos(Request $request): RedirectResponse
    {
        $request->validate([
            'foto_wanita' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'foto_pria' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        if ($request->hasFile('foto_wanita')) {
            $pathWanita = $request->file('foto_wanita')->store('mempelai', 'public');
            Setting::set('foto_mempelai_wanita', $pathWanita);
        }

        if ($request->hasFile('foto_pria')) {
            $pathPria = $request->file('foto_pria')->store('mempelai', 'public');
            Setting::set('foto_mempelai_pria', $pathPria);
        }

        return redirect()->route('admin.guests.index')->with('success', 'Foto pasangan mempelai berhasil diperbarui.');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:50'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'custom_turut_mengundang' => ['required', 'string', 'max:500'],
        ]);

        $baseSlug = Str::slug($validated['name']);
        if (empty($baseSlug)) {
            $baseSlug = 'tamu';
        }

        $slug = $baseSlug;
        $counter = 1;
        while (Guest::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }
        $validated['slug'] = $slug;

        Guest::create($validated);

        return redirect()->route('admin.guests.index')->with('success', 'Tamu berhasil ditambahkan.');
    }

    public function destroy(Guest $guest): RedirectResponse
    {
        $guest->delete();

        return redirect()->route('admin.guests.index')->with('success', 'Data tamu berhasil dihapus.');
    }
}
