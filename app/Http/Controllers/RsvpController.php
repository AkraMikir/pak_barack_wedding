<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Guest;
use App\Models\Rsvp;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RsvpController extends Controller
{
    /**
     * Show the invitation page for general public or specific guest.
     */
    public function showInvitation(?string $slug = null): View
    {
        $guest = null;
        if ($slug) {
            $guest = Guest::with('rsvp')->where('slug', $slug)->first();
        }

        $defaultTurutMengundang = "Keluarga Besar Bapak Yasmudin & Ibu Rasiwen\nKeluarga Besar Bapak Wahyu Darma Putra & Ibu Yeni Handayani";
        $turutMengundang = Setting::get('turut_mengundang', $defaultTurutMengundang);
        $fotoWanita = Setting::get('foto_mempelai_wanita');
        $fotoPria = Setting::get('foto_mempelai_pria');
        $weddingDate = Setting::get('wedding_date', '2026-10-23T08:00');
        $galleries = Gallery::orderBy('sort_order')->latest()->get();

        return view('welcome', compact('guest', 'turutMengundang', 'fotoWanita', 'fotoPria', 'weddingDate', 'galleries'));
    }

    /**
     * Mark that a guest has opened their invitation.
     */
    public function markOpened(Guest $guest): JsonResponse
    {
        if (is_null($guest->opened_at)) {
            $guest->update(['opened_at' => now()]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status undangan diperbarui.',
        ]);
    }

    /**
     * Store a new RSVP submission.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'guest_id' => ['nullable', 'exists:guests,id'],
            'guest_name' => ['required', 'string', 'max:255'],
            'status_hadir' => ['required', 'in:Hadir,Tidak'],
            'jumlah_rombongan' => ['nullable', 'integer', 'min:1', 'max:50'],
            'wishes' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validated['status_hadir'] === 'Tidak') {
            $validated['jumlah_rombongan'] = null;
        }

        if (! empty($validated['guest_id'])) {
            $rsvp = Rsvp::updateOrCreate(
                ['guest_id' => $validated['guest_id']],
                $validated
            );
        } else {
            $rsvp = Rsvp::create($validated);
        }

        return response()->json([
            'success' => true,
            'message' => 'RSVP berhasil dikirim. Terima kasih!',
            'data' => $rsvp,
        ], 201);
    }

    /**
     * Return paginated wishes for the guestbook feed.
     */
    public function wishes(): JsonResponse
    {
        $wishes = Rsvp::whereNotNull('wishes')
            ->where('wishes', '!=', '')
            ->latest()
            ->take(50)
            ->get(['id', 'guest_name', 'status_hadir', 'wishes', 'created_at']);

        return response()->json([
            'success' => true,
            'data' => $wishes,
        ]);
    }
}
