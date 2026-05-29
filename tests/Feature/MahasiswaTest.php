<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\Logbook;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\PesertaMagang;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MahasiswaTest extends TestCase
{
    use RefreshDatabase;

    protected User $mahasiswaUser;
    protected Mahasiswa $mahasiswa;
    protected User $dosenUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);

        $this->mahasiswaUser = User::where('username', '23.01.5029')->first();
        $this->mahasiswa = $this->mahasiswaUser->mahasiswa;
        $this->dosenUser = User::where('username', '19876001')->first();

        Setting::set('is_periode_open', '1');
    }

    public function test_mahasiswa_dashboard_loads()
    {
        $this->actingAs($this->mahasiswaUser);

        $response = $this->get('/mahasiswa/dashboard');
        $response->assertStatus(200);
    }

    public function test_mahasiswa_cannot_access_dosen_routes()
    {
        $this->actingAs($this->mahasiswaUser);

        $response = $this->get('/dashboard/dosen');
        $response->assertRedirect();
    }

    public function test_mahasiswa_cannot_access_operator_routes()
    {
        $this->actingAs($this->mahasiswaUser);

        $response = $this->get('/dashboard/operator');
        $response->assertRedirect();
    }

    public function test_mahasiswa_cannot_access_admin_routes()
    {
        $this->actingAs($this->mahasiswaUser);

        $response = $this->get('/dashboard/admin');
        $response->assertRedirect();
    }

    public function test_pendaftaran_page_requires_approval()
    {
        $this->mahasiswa->update(['status_magang' => 'Pending']);
        $this->actingAs($this->mahasiswaUser);

        $response = $this->get('/mahasiswa/pendaftaran');
        $response->assertRedirect('/mahasiswa/dashboard');
    }

    public function test_pendaftaran_page_loads_when_approved()
    {
        $this->mahasiswa->update(['status_magang' => 'Approve']);
        $this->actingAs($this->mahasiswaUser);

        $response = $this->get('/mahasiswa/pendaftaran');
        $response->assertStatus(200);
    }

    public function test_logbook_page_requires_active_magang()
    {
        $this->actingAs($this->mahasiswaUser);

        $response = $this->get('/mahasiswa/logbook');
        $response->assertRedirect('/mahasiswa/dashboard');
    }

    public function test_laporan_page_requires_active_magang()
    {
        $this->actingAs($this->mahasiswaUser);

        $response = $this->get('/mahasiswa/laporan');
        $response->assertRedirect('/mahasiswa/dashboard');
    }

    // ─────────── Pendaftaran Store Tests ───────────

    private function setUpApprovedMahasiswa(): void
    {
        $this->mahasiswa->update(['status_magang' => 'Approve']);
    }

    private function createActiveMagang(): Magang
    {
        $magang = Magang::create([
            'kode_magang'       => 'MGN-TEST-001',
            'tipe_magang'       => 'individu',
            'konsentrasi'       => 'Web Development',
            'perusahaan'        => 'PT Test',
            'alamat'            => 'Jl. Test No. 1',
            'tanggal_mulai'     => now()->toDateString(),
            'tanggal_selesai'   => now()->addMonths(3)->toDateString(),
            'dosen_pembimbing_id' => $this->dosenUser->dosen->id,
            'status_magang'     => 'Aktif',
        ]);

        PesertaMagang::create([
            'mahasiswa_id' => $this->mahasiswa->id,
            'magang_id'    => $magang->id,
            'is_ketua'     => true,
        ]);

        return $magang;
    }

    public function test_store_pendaftaran_individu_success()
    {
        $this->setUpApprovedMahasiswa();
        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/pendaftaran/store', [
            'tipe_magang'     => 'individu',
            'konsentrasi'     => 'Web Development',
            'perusahaan'      => 'PT Maju Jaya',
            'alamat'          => 'Jl. Merdeka No. 1',
            'tanggal_mulai'   => now()->addDays(7)->toDateString(),
            'tanggal_selesai' => now()->addMonths(3)->toDateString(),
        ]);

        $response->assertRedirect(route('mahasiswa.dashboard'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('magangs', [
            'perusahaan'  => 'PT Maju Jaya',
            'tipe_magang' => 'individu',
            'status_magang' => 'Pending',
        ]);

        $magang = Magang::where('perusahaan', 'PT Maju Jaya')->first();
        $this->assertNotNull($magang);
        $this->assertDatabaseHas('peserta_magangs', [
            'mahasiswa_id' => $this->mahasiswa->id,
            'magang_id'    => $magang->id,
            'is_ketua'     => true,
        ]);
    }

    public function test_store_pendaftaran_kelompok_success()
    {
        $this->setUpApprovedMahasiswa();

        $anggota = Mahasiswa::where('nim', '23.01.5010')->first();
        $anggota->update(['status_magang' => 'Approve']);

        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/pendaftaran/store', [
            'tipe_magang'     => 'kelompok',
            'konsentrasi'     => 'Web Development',
            'perusahaan'      => 'PT Kelompok Sukses',
            'alamat'          => 'Jl. Bersama No. 10',
            'tanggal_mulai'   => now()->addDays(7)->toDateString(),
            'tanggal_selesai' => now()->addMonths(3)->toDateString(),
            'nim_anggota'     => ['23.01.5010'],
        ]);

        $response->assertRedirect(route('mahasiswa.dashboard'));
        $response->assertSessionHas('success');

        $magang = Magang::where('perusahaan', 'PT Kelompok Sukses')->first();
        $this->assertNotNull($magang);

        $this->assertDatabaseHas('peserta_magangs', [
            'mahasiswa_id' => $this->mahasiswa->id,
            'magang_id'    => $magang->id,
            'is_ketua'     => true,
        ]);

        $this->assertDatabaseHas('peserta_magangs', [
            'mahasiswa_id' => $anggota->id,
            'magang_id'    => $magang->id,
            'is_ketua'     => false,
        ]);
    }

    public function test_store_pendaftaran_fails_when_status_pending()
    {
        $this->mahasiswa->update(['status_magang' => 'Pending']);
        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/pendaftaran/store', [
            'tipe_magang'     => 'individu',
            'konsentrasi'     => 'Web Development',
            'perusahaan'      => 'PT Gagal',
            'alamat'          => 'Jl. Gagal No. 1',
            'tanggal_mulai'   => now()->addDays(7)->toDateString(),
            'tanggal_selesai' => now()->addMonths(3)->toDateString(),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('magangs', ['perusahaan' => 'PT Gagal']);
    }

    public function test_store_pendaftaran_fails_when_periode_closed()
    {
        $this->setUpApprovedMahasiswa();
        Setting::set('is_periode_open', '0');

        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/pendaftaran/store', [
            'tipe_magang'     => 'individu',
            'konsentrasi'     => 'Web Development',
            'perusahaan'      => 'PT Tertutup',
            'alamat'          => 'Jl. Tutup No. 1',
            'tanggal_mulai'   => now()->addDays(7)->toDateString(),
            'tanggal_selesai' => now()->addMonths(3)->toDateString(),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('magangs', ['perusahaan' => 'PT Tertutup']);
    }

    public function test_store_pendaftaran_fails_when_already_registered()
    {
        $this->setUpApprovedMahasiswa();
        $this->createActiveMagang();

        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/pendaftaran/store', [
            'tipe_magang'     => 'individu',
            'konsentrasi'     => 'Web Development',
            'perusahaan'      => 'PT Double',
            'alamat'          => 'Jl. Dua No. 1',
            'tanggal_mulai'   => now()->addDays(7)->toDateString(),
            'tanggal_selesai' => now()->addMonths(3)->toDateString(),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('magangs', ['perusahaan' => 'PT Double']);
    }

    public function test_store_pendaftaran_kelompok_nim_anggota_tidak_terdaftar()
    {
        $this->setUpApprovedMahasiswa();
        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/pendaftaran/store', [
            'tipe_magang'     => 'kelompok',
            'konsentrasi'     => 'Web Development',
            'perusahaan'      => 'PT NIM Invalid',
            'alamat'          => 'Jl. Invalid No. 1',
            'tanggal_mulai'   => now()->addDays(7)->toDateString(),
            'tanggal_selesai' => now()->addMonths(3)->toDateString(),
            'nim_anggota'     => ['99.99.9999'],
        ]);

        $response->assertSessionHasErrors('nim_anggota.0');
    }

    public function test_store_pendaftaran_kelompok_anggota_belum_approve()
    {
        $this->setUpApprovedMahasiswa();
        $this->actingAs($this->mahasiswaUser);

        $anggota = Mahasiswa::where('nim', '23.01.5010')->first();
        $anggota->update(['status_magang' => 'Pending']);

        $response = $this->post('/mahasiswa/pendaftaran/store', [
            'tipe_magang'     => 'kelompok',
            'konsentrasi'     => 'Web Development',
            'perusahaan'      => 'PT Anggota Pending',
            'alamat'          => 'Jl. Anggota No. 1',
            'tanggal_mulai'   => now()->addDays(7)->toDateString(),
            'tanggal_selesai' => now()->addMonths(3)->toDateString(),
            'nim_anggota'     => ['23.01.5010'],
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('magangs', ['perusahaan' => 'PT Anggota Pending']);
    }

    public function test_store_pendaftaran_validasi_tanggal_selesai_setelah_mulai()
    {
        $this->setUpApprovedMahasiswa();
        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/pendaftaran/store', [
            'tipe_magang'     => 'individu',
            'konsentrasi'     => 'Web Development',
            'perusahaan'      => 'PT Tanggal',
            'alamat'          => 'Jl. Tanggal No. 1',
            'tanggal_mulai'   => now()->addMonths(3)->toDateString(),
            'tanggal_selesai' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertSessionHasErrors('tanggal_selesai');
    }

    // ─────────── Logbook Store Tests ───────────

    public function test_store_logbook_success()
    {
        $this->setUpApprovedMahasiswa();
        $this->createActiveMagang();
        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/logbook', [
            'logbook' => 'Hari ini mengerjakan fitur login.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('logbooks', [
            'kegiatan' => 'Hari ini mengerjakan fitur login.',
        ]);
    }

    public function test_store_logbook_fails_without_active_magang()
    {
        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/logbook', [
            'logbook' => 'Hari ini belajar.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_store_logbook_fails_when_periode_closed()
    {
        $this->setUpApprovedMahasiswa();
        $this->createActiveMagang();
        Setting::set('is_periode_open', '0');
        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/logbook', [
            'logbook' => 'Hari ini belajar.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_store_logbook_validasi_kegiatan_required()
    {
        $this->setUpApprovedMahasiswa();
        $this->createActiveMagang();
        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/logbook', [
            'logbook' => '',
        ]);

        $response->assertSessionHasErrors('logbook');
    }

    // ─────────── Laporan Store Tests ───────────

    public function test_store_laporan_success()
    {
        $this->setUpApprovedMahasiswa();
        $magang = $this->createActiveMagang();
        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/laporan', [
            'magang_id' => $magang->id,
            'judul'     => 'Laporan Magang di PT Test',
            'bab1'      => 'Pendahuluan laporan magang.',
            'bab2'      => 'Tinjauan pustaka.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('laporans', [
            'magang_id' => $magang->id,
            'judul'     => 'Laporan Magang di PT Test',
            'status'    => 'review',
        ]);
    }

    public function test_store_laporan_fails_when_periode_closed()
    {
        $this->setUpApprovedMahasiswa();
        $magang = $this->createActiveMagang();
        Setting::set('is_periode_open', '0');
        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/laporan', [
            'magang_id' => $magang->id,
            'judul'     => 'Laporan Gagal',
            'bab1'      => 'Test.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_store_laporan_update_existing_draft()
    {
        $this->setUpApprovedMahasiswa();
        $magang = $this->createActiveMagang();

        Laporan::create([
            'magang_id' => $magang->id,
            'judul'     => 'Draft Awal',
            'bab1'      => 'Bab 1 awal',
            'status'    => 'review',
        ]);

        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/laporan', [
            'magang_id' => $magang->id,
            'judul'     => 'Draft Revisi',
            'bab1'      => 'Bab 1 revisi',
            'bab2'      => 'Bab 2 baru',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('laporans', [
            'magang_id' => $magang->id,
            'judul'     => 'Draft Revisi',
        ]);

        $this->assertEquals(1, Laporan::where('magang_id', $magang->id)->count());
    }

    public function test_store_laporan_fails_when_already_approved()
    {
        $this->setUpApprovedMahasiswa();
        $magang = $this->createActiveMagang();

        Laporan::create([
            'magang_id' => $magang->id,
            'judul'     => 'Laporan Disetujui',
            'bab1'      => 'Bab 1',
            'status'    => 'approved',
        ]);

        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/laporan', [
            'magang_id' => $magang->id,
            'judul'     => 'Laporan Edit',
            'bab1'      => 'Edit setelah approve',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    public function test_store_laporan_validasi_magang_id_required()
    {
        $this->setUpApprovedMahasiswa();
        $this->createActiveMagang();
        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/laporan', [
            'judul' => 'Laporan Tanpa Magang',
            'bab1'  => 'Test.',
        ]);

        $response->assertSessionHasErrors('magang_id');
    }

    public function test_store_laporan_validasi_judul_required()
    {
        $this->setUpApprovedMahasiswa();
        $magang = $this->createActiveMagang();
        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/laporan', [
            'magang_id' => $magang->id,
            'judul'     => '',
        ]);

        $response->assertSessionHasErrors('judul');
    }

    // ─────────── Boundary Tests ───────────

    public function test_store_pendaftaran_kelompok_dengan_nol_anggota_gagal()
    {
        $this->setUpApprovedMahasiswa();
        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/pendaftaran/store', [
            'tipe_magang'     => 'kelompok',
            'konsentrasi'     => 'Web Development',
            'perusahaan'      => 'PT Nol Anggota',
            'alamat'          => 'Jl. Nol No. 1',
            'tanggal_mulai'   => now()->addDays(7)->toDateString(),
            'tanggal_selesai' => now()->addMonths(3)->toDateString(),
            'nim_anggota'     => [],
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('magangs', ['perusahaan' => 'PT Nol Anggota']);
    }

    public function test_store_pendaftaran_kelompok_dua_anggota_sukses()
    {
        $this->setUpApprovedMahasiswa();

        $anggota1 = Mahasiswa::where('nim', '23.01.5010')->first();
        $anggota2 = Mahasiswa::where('nim', '23.01.5017')->first();
        $anggota1->update(['status_magang' => 'Approve']);
        $anggota2->update(['status_magang' => 'Approve']);

        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/pendaftaran/store', [
            'tipe_magang'     => 'kelompok',
            'konsentrasi'     => 'Web Development',
            'perusahaan'      => 'PT Tiga Orang',
            'alamat'          => 'Jl. Tiga No. 1',
            'tanggal_mulai'   => now()->addDays(7)->toDateString(),
            'tanggal_selesai' => now()->addMonths(3)->toDateString(),
            'nim_anggota'     => ['23.01.5010', '23.01.5017'],
        ]);

        $response->assertRedirect(route('mahasiswa.dashboard'));
        $response->assertSessionHas('success');

        $magang = Magang::where('perusahaan', 'PT Tiga Orang')->first();
        $this->assertNotNull($magang);
        $this->assertEquals(3, PesertaMagang::where('magang_id', $magang->id)->count());
    }

    public function test_store_pendaftaran_kelompok_tiga_anggota_gagal()
    {
        $this->setUpApprovedMahasiswa();

        $anggota1 = Mahasiswa::where('nim', '23.01.5010')->first();
        $anggota2 = Mahasiswa::where('nim', '23.01.5017')->first();
        $anggota3 = Mahasiswa::where('nim', '23.01.5039')->first();
        $anggota1->update(['status_magang' => 'Approve']);
        $anggota2->update(['status_magang' => 'Approve']);
        $anggota3->update(['status_magang' => 'Approve']);

        $this->actingAs($this->mahasiswaUser);

        $response = $this->post('/mahasiswa/pendaftaran/store', [
            'tipe_magang'     => 'kelompok',
            'konsentrasi'     => 'Web Development',
            'perusahaan'      => 'PT Empat Orang',
            'alamat'          => 'Jl. Empat No. 1',
            'tanggal_mulai'   => now()->addDays(7)->toDateString(),
            'tanggal_selesai' => now()->addMonths(3)->toDateString(),
            'nim_anggota'     => ['23.01.5010', '23.01.5017', '23.01.5039'],
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('magangs', ['perusahaan' => 'PT Empat Orang']);
    }

    // ─────────── Surat Pengantar Tests ───────────

    public function test_surat_pengantar_page_redirects_without_magang()
    {
        $this->actingAs($this->mahasiswaUser);

        $response = $this->get('/mahasiswa/surat-pengantar');
        $response->assertRedirect();
    }

    public function test_surat_pengantar_page_loads_with_magang()
    {
        $this->setUpApprovedMahasiswa();
        $this->createActiveMagang();
        $this->actingAs($this->mahasiswaUser);

        $response = $this->get('/mahasiswa/surat-pengantar');
        $response->assertStatus(200);
    }

    // ─────────── PDF Export Tests ───────────

    public function test_cetak_logbook_pdf_redirects_without_data()
    {
        $this->setUpApprovedMahasiswa();
        $magang = $this->createActiveMagang();
        $this->actingAs($this->mahasiswaUser);

        $response = $this->get('/mahasiswa/logbook/pdf');
        $response->assertRedirect();
    }

    public function test_cetak_logbook_pdf_with_data()
    {
        $this->setUpApprovedMahasiswa();
        $magang = $this->createActiveMagang();

        Logbook::create([
            'magang_id' => $magang->id,
            'tanggal'   => now()->toDateString(),
            'kegiatan'  => 'Test kegiatan logbook.',
        ]);

        $this->actingAs($this->mahasiswaUser);

        $response = $this->get('/mahasiswa/logbook/pdf');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    public function test_cetak_laporan_pdf_redirects_without_data()
    {
        $this->setUpApprovedMahasiswa();
        $this->createActiveMagang();
        $this->actingAs($this->mahasiswaUser);

        $response = $this->get('/mahasiswa/laporan/pdf');
        $response->assertRedirect();
    }

    public function test_cetak_laporan_pdf_with_data()
    {
        $this->setUpApprovedMahasiswa();
        $magang = $this->createActiveMagang();

        Laporan::create([
            'magang_id' => $magang->id,
            'judul'     => 'Laporan Test PDF',
            'bab1'      => 'Bab 1',
            'status'    => 'review',
        ]);

        $this->actingAs($this->mahasiswaUser);

        $response = $this->get('/mahasiswa/laporan/pdf');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    // ─────────── Complete State Flow Test ───────────

    public function test_complete_state_flow_from_pendaftaran_to_selesai()
    {
        // 1. Mahasiswa disetujui dosen wali (Pending → Approve)
        $this->dosenUser = User::where('username', '19876001')->first();
        $this->actingAs($this->dosenUser);
        $this->post("/dosen/rekomendasi/{$this->mahasiswa->id}/approve");
        $this->mahasiswa->refresh();
        $this->assertEquals('Approve', $this->mahasiswa->status_magang);

        // 2. Mahasiswa daftar magang (Approve → Magang Pending)
        $this->actingAs($this->mahasiswaUser);
        $this->post('/mahasiswa/pendaftaran/store', [
            'tipe_magang'     => 'individu',
            'konsentrasi'     => 'Web Development',
            'perusahaan'      => 'PT State Flow',
            'alamat'          => 'Jl. Flow No. 1',
            'tanggal_mulai'   => now()->addDays(7)->toDateString(),
            'tanggal_selesai' => now()->addMonths(3)->toDateString(),
        ]);

        $magang = Magang::where('perusahaan', 'PT State Flow')->first();
        $this->assertNotNull($magang);
        $this->assertEquals('Pending', $magang->status_magang);

        // 3. Operator assign dosen pembimbing (Pending → Aktif)
        $this->operatorUser = User::where('username', 'operator')->first();
        $this->actingAs($this->operatorUser);
        $dosen = $this->dosenUser->dosen;
        $this->post("/operator/dosen-pembimbing/{$magang->id}/assign", [
            'dosen_id' => $dosen->id,
        ]);
        $magang->refresh();
        $this->assertEquals('Aktif', $magang->status_magang);
        $this->assertStringStartsWith('SIDUL-', $magang->kode_magang);

        // 4. Mahasiswa isi logbook
        $this->mahasiswaUser->refresh();
        $this->actingAs($this->mahasiswaUser);

        $logResponse = $this->post('/mahasiswa/logbook', [
            'logbook' => 'Hari pertama magang di PT State Flow.',
        ]);
        $logResponse->assertSessionHas('success');
        $this->assertDatabaseHas('logbooks', [
            'magang_id' => $magang->id,
            'kegiatan'  => 'Hari pertama magang di PT State Flow.',
        ]);

        // 5. Mahasiswa buat laporan
        $this->post('/mahasiswa/laporan', [
            'magang_id' => $magang->id,
            'judul'     => 'Laporan Magang PT State Flow',
            'bab1'      => 'Pendahuluan',
            'bab2'      => 'Pembahasan',
        ]);
        $this->assertDatabaseHas('laporans', [
            'magang_id' => $magang->id,
            'status'    => 'review',
        ]);

        // 6. Dosen approve laporan (review → approved, Aktif → Selesai)
        $this->actingAs($this->dosenUser);
        $this->post("/dosen/laporan/{$magang->id}/approve", [
            'status'   => 'approved',
            'feedback' => 'Laporan baik. Disetujui.',
        ]);

        $laporan = Laporan::where('magang_id', $magang->id)->first();
        $magang->refresh();
        $this->assertEquals('approved', $laporan->status);
        $this->assertEquals('Selesai', $magang->status_magang);
    }
}
