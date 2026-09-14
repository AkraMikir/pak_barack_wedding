<?php

namespace Tests\Feature;

use App\Models\Gallery;
use App\Models\Guest;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GuestManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_guests_page(): void
    {
        $response = $this->get('/admin/guests');

        $response->assertStatus(200);
        $response->assertSee('Manajemen Tamu');
    }

    public function test_admin_can_create_guest(): void
    {
        $response = $this->post('/admin/guests', [
            'name' => 'Budi Santoso',
            'category' => 'VIP',
            'phone_number' => '081234567890',
            'custom_turut_mengundang' => 'Keluarga Besar *******',
        ]);

        $response->assertRedirect('/admin/guests');
        $this->assertDatabaseHas('guests', [
            'name' => 'Budi Santoso',
            'slug' => 'budi-santoso',
            'category' => 'VIP',
            'custom_turut_mengundang' => 'Keluarga Besar *******',
        ]);
    }

    public function test_invitation_displays_guest_name(): void
    {
        $guest = Guest::create([
            'name' => 'Dr. Budi Santoso, M.Kom',
            'slug' => 'budi-santoso',
            'category' => 'VIP',
        ]);

        $response = $this->get('/to/'.$guest->slug);

        $response->assertStatus(200);
        $response->assertSee('Dr. Budi Santoso, M.Kom');
        $response->assertDontSee('VIP');
    }

    public function test_guest_can_mark_invitation_opened(): void
    {
        $guest = Guest::create([
            'name' => 'Siti Aminah',
            'slug' => 'siti-aminah',
        ]);

        $this->assertNull($guest->opened_at);

        $response = $this->postJson('/guest/'.$guest->id.'/open');

        $response->assertStatus(200);
        $this->assertNotNull($guest->fresh()->opened_at);
    }

    public function test_guest_can_submit_rsvp_linked_to_guest_id(): void
    {
        $guest = Guest::create([
            'name' => 'Ahmad Fauzi',
            'slug' => 'ahmad-fauzi',
        ]);

        $response = $this->postJson('/rsvp', [
            'guest_id' => $guest->id,
            'guest_name' => $guest->name,
            'status_hadir' => 'Hadir',
            'jumlah_rombongan' => 2,
            'wishes' => 'Selamat menempuh hidup baru!',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('rsvps', [
            'guest_id' => $guest->id,
            'guest_name' => 'Ahmad Fauzi',
            'status_hadir' => 'Hadir',
            'jumlah_rombongan' => 2,
        ]);
    }

    public function test_guest_can_submit_rsvp_berhalangan(): void
    {
        $guest = Guest::create([
            'name' => 'Budi Berhalangan',
            'slug' => 'budi-berhalangan',
        ]);

        $response = $this->postJson('/rsvp', [
            'guest_id' => $guest->id,
            'guest_name' => $guest->name,
            'status_hadir' => 'Tidak',
            'jumlah_rombongan' => 3, // should be set to null for Tidak
            'wishes' => 'Mohon maaf belum bisa hadir, doa terbaik untuk mempelai.',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('rsvps', [
            'guest_id' => $guest->id,
            'guest_name' => 'Budi Berhalangan',
            'status_hadir' => 'Tidak',
            'jumlah_rombongan' => null,
        ]);
    }

    public function test_guest_with_custom_turut_mengundang_shows_on_their_invitation(): void
    {
        $response = $this->post('/admin/guests', [
            'name' => 'Tamu Khusus',
            'category' => 'Rekan Kerja',
            'custom_turut_mengundang' => 'Bro ******* Team *******',
        ]);

        $response->assertRedirect('/admin/guests');

        $guest = Guest::where('name', 'Tamu Khusus')->firstOrFail();
        $this->assertEquals('Bro ******* Team *******', $guest->custom_turut_mengundang);

        $invitation = $this->get('/to/'.$guest->slug);
        $invitation->assertStatus(200);
        $invitation->assertSee('Bro ******* Team *******');
        $invitation->assertDontSee('Keluarga Besar Bapak Yasmudin & Ibu Rasiwen');
    }

    public function test_admin_can_upload_couple_photos(): void
    {
        Storage::fake('public');

        $wanitaFile = UploadedFile::fake()->image('wanita.jpg', 600, 800);
        $priaFile = UploadedFile::fake()->image('pria.jpg', 600, 800);

        $response = $this->post('/admin/settings/photos', [
            'foto_wanita' => $wanitaFile,
            'foto_pria' => $priaFile,
        ]);

        $response->assertRedirect('/admin/guests');

        $wanitaPath = Setting::get('foto_mempelai_wanita');
        $priaPath = Setting::get('foto_mempelai_pria');

        $this->assertNotNull($wanitaPath);
        $this->assertNotNull($priaPath);

        Storage::disk('public')->assertExists($wanitaPath);
        Storage::disk('public')->assertExists($priaPath);

        $invitation = $this->get('/');
        $invitation->assertStatus(200);
        $invitation->assertSee(asset('storage/'.$wanitaPath));
        $invitation->assertSee(asset('storage/'.$priaPath));
    }

    public function test_admin_can_update_countdown_and_display_dynamically(): void
    {
        $response = $this->post('/admin/settings/countdown', [
            'wedding_date' => '2026-12-31T09:00',
        ]);

        $response->assertRedirect('/admin/guests');
        $this->assertSame('2026-12-31T09:00', Setting::get('wedding_date'));

        $invitation = $this->get('/');
        $invitation->assertStatus(200);
        $invitation->assertSee('2026-12-31T09:00');
        $invitation->assertSee('Desember 2026');
        $invitation->assertSee('calendar.google.com/calendar/render');
    }

    public function test_admin_can_upload_and_delete_gallery_photos(): void
    {
        Storage::fake('public');

        $galleryFile = UploadedFile::fake()->image('prewed1.jpg', 800, 1000);

        $response = $this->post('/admin/galleries', [
            'image' => $galleryFile,
            'title' => 'BUSANA ADAT KERATON TEST',
        ]);

        $response->assertRedirect('/admin/guests');

        $gallery = Gallery::first();
        $this->assertNotNull($gallery);
        $this->assertSame('BUSANA ADAT KERATON TEST', $gallery->title);
        Storage::disk('public')->assertExists($gallery->image_path);

        $invitation = $this->get('/');
        $invitation->assertStatus(200);
        $invitation->assertSee('BUSANA ADAT KERATON TEST');
        $invitation->assertSee(asset('storage/'.$gallery->image_path));

        // Test delete
        $deleteResponse = $this->delete('/admin/galleries/'.$gallery->id);
        $deleteResponse->assertRedirect('/admin/guests');
        $this->assertDatabaseMissing('galleries', ['id' => $gallery->id]);
        Storage::disk('public')->assertMissing($gallery->image_path);
    }
}
