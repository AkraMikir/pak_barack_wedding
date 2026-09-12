<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RsvpController extends Controller
{
    /**
     * Store a new RSVP submission.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'guest_name' => ['required', 'string', 'max:255'],
            'status_hadir' => ['required', 'in:Hadir,Tidak'],
            'jumlah_rombongan' => ['nullable', 'integer', 'min:1', 'max:50'],
            'wishes' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validated['status_hadir'] === 'Tidak') {
            $validated['jumlah_rombongan'] = null;
        }

        $rsvp = Rsvp::create($validated);

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
