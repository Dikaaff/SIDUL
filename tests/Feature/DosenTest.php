<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\PesertaMagang;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DosenTest extends TestCase
{
    use RefreshDatabase;

    protected User $dosenUser;
    protected Mahasiswa $mahasiswa;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
        $this->dosenUser = User::where('username', '19876001')->first();
        $this->mahasiswa = Mahasiswa::where('nim', '23.01.5029')->first();
    }

    public function test_dosen_dashboard_loads()
    {
        $this->actingAs($this->dosenUser);

        $response = $this->get('/dashboard/dosen');
        $response->assertStatus(200);
    }

    public function test_dosen_monitoring_loads()
    {
        $this->actingAs($this->dosenUser);

        $response = $this->get('/dosen/monitoring');
        $response->assertStatus(200);
    }

    public function test_dosen_rekomendasi_loads()
    {
        $this->actingAs($this->dosenUser);

        $response = $this->get('/dosen/rekomendasi');
        $response->assertStatus(200);
    }

    public function test_dosen_cannot_access_admin_routes()
    {
        $this->actingAs($this->dosenUser);

        $response = $this->get('/dashboard/admin');
        $response->assertRedirect();
    }

    public function test_dosen_cannot_access_mahasiswa_routes()
    {
        $this->actingAs($this->dosenUser);

        $response = $this->get('/mahasiswa/dashboard');
        $response->assertRedirect();
    }

    // ─────────── Rekomendasi Tests ───────────

    public function test_dosen_can_approve_rekomendasi()
    {
        $this->mahasiswa->update(['status_magang' => 'Pending']);
        $this->actingAs($this->dosenUser);

        $response = $this->post("/dosen/rekomendasi/{$this->mahasiswa->id}/approve");

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->mahasiswa->refresh();
        $this->assertEquals('Approve', $this->mahasiswa->status_magang);
    }

    public function test_dosen_can_reject_rekomendasi()
    {
        $this->mahasiswa->update(['status_magang' => 'Pending']);
        $this->actingAs($this->dosenUser);

        $response = $this->post("/dosen/rekomendasi/{$this->mahasiswa->id}/reject");

        $response->assertRedirect();
        $response->assertSessionHas('info');

        $this->mahasiswa->refresh();
        $this->assertEquals('Rejected', $this->mahasiswa->status_magang);
    }

    public function test_dosen_rekomendasi_updates_status_from_pending()
    {
        $this->mahasiswa->update(['status_magang' => 'Pending']);
        $this->actingAs($this->dosenUser);

        $this->post("/dosen/rekomendasi/{$this->mahasiswa->id}/approve");
        $this->mahasiswa->refresh();
        $this->assertEquals('Approve', $this->mahasiswa->status_magang);

        $this->post("/dosen/rekomendasi/{$this->mahasiswa->id}/reject");
        $this->mahasiswa->refresh();
        $this->assertEquals('Rejected', $this->mahasiswa->status_magang);
    }

    // ─────────── Approve Laporan Tests ───────────

    public function test_dosen_can_approve_laporan()
    {
        $magang = $this->createMagangWithLaporan('review');
        $this->actingAs($this->dosenUser);

        $response = $this->post("/dosen/laporan/{$magang->id}/approve", [
            'status'   => 'approved',
            'feedback' => 'Laporan sudah baik, disetujui.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $magang->refresh();
        $laporan = $magang->laporan;

        $this->assertEquals('approved', $laporan->status);
        $this->assertEquals('Laporan sudah baik, disetujui.', $laporan->catatan_dosen);
        $this->assertEquals('Selesai', $magang->status_magang);
    }

    public function test_dosen_can_request_revisi_laporan()
    {
        $magang = $this->createMagangWithLaporan('review');
        $this->actingAs($this->dosenUser);

        $response = $this->post("/dosen/laporan/{$magang->id}/approve", [
            'status'   => 'revisi',
            'feedback' => 'Bab 1 perlu diperbaiki.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $magang->refresh();
        $laporan = $magang->laporan;

        $this->assertEquals('revisi', $laporan->status);
        $this->assertEquals('Bab 1 perlu diperbaiki.', $laporan->catatan_dosen);
        $this->assertNotEquals('Selesai', $magang->status_magang);
    }

    public function test_dosen_approve_laporan_validasi_status_required()
    {
        $magang = $this->createMagangWithLaporan('review');
        $this->actingAs($this->dosenUser);

        $response = $this->post("/dosen/laporan/{$magang->id}/approve", [
            'feedback' => 'Test.',
        ]);

        $response->assertSessionHasErrors('status');
    }

    public function test_dosen_approve_laporan_validasi_status_must_be_valid()
    {
        $magang = $this->createMagangWithLaporan('review');
        $this->actingAs($this->dosenUser);

        $response = $this->post("/dosen/laporan/{$magang->id}/approve", [
            'status'   => 'invalid_status',
            'feedback' => 'Test.',
        ]);

        $response->assertSessionHasErrors('status');
    }

    public function test_dosen_approve_laporan_validasi_feedback_required()
    {
        $magang = $this->createMagangWithLaporan('review');
        $this->actingAs($this->dosenUser);

        $response = $this->post("/dosen/laporan/{$magang->id}/approve", [
            'status' => 'approved',
        ]);

        $response->assertSessionHasErrors('feedback');
    }

    // ─────────── Halaman Bimbingan Tests ───────────

    public function test_dosen_logbook_page_loads_with_bimbingan()
    {
        $this->createBimbinganWithLogbook();
        $this->actingAs($this->dosenUser);

        $response = $this->get('/dosen/logbook');
        $response->assertStatus(200);
    }

    public function test_dosen_laporan_page_loads_with_bimbingan()
    {
        $this->createMagangWithLaporan('review');
        $this->actingAs($this->dosenUser);

        $response = $this->get('/dosen/laporan');
        $response->assertStatus(200);
    }

    // ─────────── Helper ───────────

    private function createBimbinganWithLogbook(): void
    {
        $mahasiswaBimbingan = Mahasiswa::where('nim', '23.01.5029')->first();
        $mahasiswaBimbingan->update(['status_magang' => 'Approve']);

        $magang = Magang::create([
            'kode_magang'         => 'MGN-LOG-TEST',
            'tipe_magang'         => 'individu',
            'konsentrasi'         => 'Web Development',
            'perusahaan'          => 'PT Bimbingan Log',
            'alamat'              => 'Jl. Log No. 1',
            'tanggal_mulai'       => now()->toDateString(),
            'tanggal_selesai'     => now()->addMonths(3)->toDateString(),
            'dosen_pembimbing_id' => $this->dosenUser->dosen->id,
            'status_magang'       => 'Aktif',
        ]);

        PesertaMagang::create([
            'mahasiswa_id' => $mahasiswaBimbingan->id,
            'magang_id'    => $magang->id,
            'is_ketua'     => true,
        ]);

        \App\Models\Logbook::create([
            'magang_id' => $magang->id,
            'tanggal'   => now()->toDateString(),
            'kegiatan'  => 'Logbook test dosen.',
        ]);
    }

    private function createMagangWithLaporan(string $statusLaporan): Magang
    {
        $mahasiswaBimbingan = Mahasiswa::where('nim', '23.01.5029')->first();
        $mahasiswaBimbingan->update(['status_magang' => 'Approve']);

        $magang = Magang::create([
            'kode_magang'       => 'MGN-DOSEN-TEST',
            'tipe_magang'       => 'individu',
            'konsentrasi'       => 'Web Development',
            'perusahaan'        => 'PT Bimbingan',
            'alamat'            => 'Jl. Bimbingan No. 1',
            'tanggal_mulai'     => now()->toDateString(),
            'tanggal_selesai'   => now()->addMonths(3)->toDateString(),
            'dosen_pembimbing_id' => $this->dosenUser->dosen->id,
            'status_magang'     => 'Aktif',
        ]);

        PesertaMagang::create([
            'mahasiswa_id' => $mahasiswaBimbingan->id,
            'magang_id'    => $magang->id,
            'is_ketua'     => true,
        ]);

        Laporan::create([
            'magang_id' => $magang->id,
            'judul'     => 'Laporan Test Dosen',
            'bab1'      => 'Bab 1 content',
            'bab2'      => 'Bab 2 content',
            'status'    => $statusLaporan,
        ]);

        return $magang;
    }
}
