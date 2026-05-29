<?php

namespace Tests\Feature;

use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\PesertaMagang;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OperatorTest extends TestCase
{
    use RefreshDatabase;

    protected User $operatorUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
        $this->operatorUser = User::where('username', 'operator')->first();
    }

    public function test_operator_dashboard_loads()
    {
        $this->actingAs($this->operatorUser);

        $response = $this->get('/dashboard/operator');
        $response->assertStatus(200);
    }

    public function test_operator_monitoring_loads()
    {
        $this->actingAs($this->operatorUser);

        $response = $this->get('/operator/monitoring');
        $response->assertStatus(200);
    }

    public function test_operator_dosen_pembimbing_loads()
    {
        $this->actingAs($this->operatorUser);

        $response = $this->get('/operator/dosen-pembimbing');
        $response->assertStatus(200);
    }

    public function test_operator_cannot_access_admin_routes()
    {
        $this->actingAs($this->operatorUser);

        $response = $this->get('/dashboard/admin');
        $response->assertRedirect();
    }

    public function test_operator_cannot_access_mahasiswa_routes()
    {
        $this->actingAs($this->operatorUser);

        $response = $this->get('/mahasiswa/dashboard');
        $response->assertRedirect();
    }

    // ─────────── Toggle Periode Tests ───────────

    public function test_operator_can_toggle_periode_open_to_closed()
    {
        Setting::set('is_periode_open', '1');
        $this->actingAs($this->operatorUser);

        $response = $this->post('/operator/periode/toggle');

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertEquals('0', Setting::get('is_periode_open'));
    }

    public function test_operator_can_toggle_periode_closed_to_open()
    {
        Setting::set('is_periode_open', '0');
        $this->actingAs($this->operatorUser);

        $response = $this->post('/operator/periode/toggle');

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertEquals('1', Setting::get('is_periode_open'));
    }

    public function test_operator_can_toggle_periode_multiple_times()
    {
        $this->actingAs($this->operatorUser);

        Setting::set('is_periode_open', '1');
        $this->post('/operator/periode/toggle');
        $this->assertEquals('0', Setting::get('is_periode_open'));

        $this->post('/operator/periode/toggle');
        $this->assertEquals('1', Setting::get('is_periode_open'));

        $this->post('/operator/periode/toggle');
        $this->assertEquals('0', Setting::get('is_periode_open'));
    }

    // ─────────── Assign Dosen Pembimbing Tests ───────────

    public function test_operator_can_assign_dosen_pembimbing()
    {
        list($magang, $dosen) = $this->createPendingMagang();
        $this->actingAs($this->operatorUser);

        $response = $this->post("/operator/dosen-pembimbing/{$magang->id}/assign", [
            'dosen_id' => $dosen->id,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $magang->refresh();
        $this->assertEquals('Aktif', $magang->status_magang);
        $this->assertEquals($dosen->id, $magang->dosen_pembimbing_id);
        $this->assertStringStartsWith('SIDUL-' . now()->year . '-', $magang->kode_magang);
    }

    public function test_operator_assign_dosen_generates_incrementing_kode()
    {
        list($magang1, $dosen) = $this->createPendingMagang();
        $this->actingAs($this->operatorUser);

        $this->post("/operator/dosen-pembimbing/{$magang1->id}/assign", ['dosen_id' => $dosen->id]);
        list($magang2,) = $this->createPendingMagang();
        $this->post("/operator/dosen-pembimbing/{$magang2->id}/assign", ['dosen_id' => $dosen->id]);

        $magang1->refresh();
        $magang2->refresh();

        $this->assertNotEquals($magang1->kode_magang, $magang2->kode_magang);
        $this->assertStringStartsWith('SIDUL-' . now()->year . '-', $magang2->kode_magang);
    }

    public function test_operator_assign_dosen_validasi_dosen_id_required()
    {
        list($magang,) = $this->createPendingMagang();
        $this->actingAs($this->operatorUser);

        $response = $this->post("/operator/dosen-pembimbing/{$magang->id}/assign", []);

        $response->assertSessionHasErrors('dosen_id');
    }

    public function test_operator_assign_dosen_validasi_dosen_id_must_exist()
    {
        list($magang,) = $this->createPendingMagang();
        $this->actingAs($this->operatorUser);

        $response = $this->post("/operator/dosen-pembimbing/{$magang->id}/assign", [
            'dosen_id' => 99999,
        ]);

        $response->assertSessionHasErrors('dosen_id');
    }

    // ─────────── Monitoring Search Tests ───────────

    public function test_operator_monitoring_search_by_perusahaan()
    {
        $magang = $this->createMagangWithData('PT Dicari');
        $this->actingAs($this->operatorUser);

        $response = $this->call('GET', '/operator/monitoring', ['search' => 'Dicari']);

        $response->assertStatus(200);
        $response->assertSee('PT Dicari');
    }

    public function test_operator_monitoring_search_by_nim()
    {
        $magang = $this->createMagangWithData('PT Search NIM');
        $this->actingAs($this->operatorUser);

        $response = $this->call('GET', '/operator/monitoring', ['search' => '23.01.5029']);

        $response->assertStatus(200);
        $response->assertSee('PT Search NIM');
    }

    public function test_operator_monitoring_filter_by_status()
    {
        $this->createMagangWithData('PT Filter Pending', 'Pending');
        $this->createMagangWithData('PT Filter Aktif', 'Aktif');
        $this->actingAs($this->operatorUser);

        $responsePending = $this->call('GET', '/operator/monitoring', ['status' => 'Pending']);
        $responsePending->assertStatus(200);
        $responsePending->assertSee('PT Filter Pending');
        $responsePending->assertDontSee('PT Filter Aktif');

        $responseAktif = $this->call('GET', '/operator/monitoring', ['status' => 'Aktif']);
        $responseAktif->assertStatus(200);
        $responseAktif->assertSee('PT Filter Aktif');
        $responseAktif->assertDontSee('PT Filter Pending');
    }

    public function test_operator_monitoring_search_no_results()
    {
        $this->actingAs($this->operatorUser);

        $response = $this->call('GET', '/operator/monitoring', ['search' => 'TidakAda']);
        $response->assertStatus(200);
        $response->assertDontSee('TidakAda');
    }

    // ─────────── Delete Magang Tests ───────────

    public function test_operator_can_delete_magang()
    {
        list($magang,) = $this->createPendingMagang();
        $this->actingAs($this->operatorUser);

        $response = $this->delete("/operator/magang/{$magang->id}");

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('magangs', ['id' => $magang->id]);
    }

    // ─────────── Laporan Page Tests ───────────

    public function test_operator_laporan_page_loads()
    {
        $this->actingAs($this->operatorUser);

        $response = $this->get('/operator/laporan');
        $response->assertStatus(200);
    }

    // ─────────── Helper ───────────

    private function createMagangWithData(string $perusahaan, string $status = 'Pending'): Magang
    {
        $mahasiswa = Mahasiswa::where('nim', '23.01.5029')->first();
        $mahasiswa->update(['status_magang' => 'Approve']);

        $magang = Magang::create([
            'kode_magang'       => 'MGN-' . strtoupper(bin2hex(random_bytes(3))),
            'tipe_magang'       => 'individu',
            'konsentrasi'       => 'Web Development',
            'perusahaan'        => $perusahaan,
            'alamat'            => 'Jl. Test No. 1',
            'tanggal_mulai'     => now()->toDateString(),
            'tanggal_selesai'   => now()->addMonths(3)->toDateString(),
            'status_magang'     => $status,
        ]);

        PesertaMagang::create([
            'mahasiswa_id' => $mahasiswa->id,
            'magang_id'    => $magang->id,
            'is_ketua'     => true,
        ]);

        return $magang;
    }

    private function createPendingMagang(): array
    {
        $mahasiswa = Mahasiswa::where('nim', '23.01.5029')->first();
        $mahasiswa->update(['status_magang' => 'Approve']);

        $magang = Magang::create([
            'kode_magang'       => 'MGN-' . strtoupper(bin2hex(random_bytes(3))),
            'tipe_magang'       => 'individu',
            'konsentrasi'       => 'Web Development',
            'perusahaan'        => 'PT Test',
            'alamat'            => 'Jl. Test No. 1',
            'tanggal_mulai'     => now()->toDateString(),
            'tanggal_selesai'   => now()->addMonths(3)->toDateString(),
            'status_magang'     => 'Pending',
        ]);

        PesertaMagang::create([
            'mahasiswa_id' => $mahasiswa->id,
            'magang_id'    => $magang->id,
            'is_ketua'     => true,
        ]);

        $dosen = User::where('username', '19876001')->first()->dosen;

        return [$magang, $dosen];
    }
}
