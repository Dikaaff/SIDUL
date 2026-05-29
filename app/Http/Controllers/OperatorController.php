<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Services\OperatorService;
use App\Services\PeriodeService;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    # fungsi constructor untuk menginisialisasi service
    public function __construct(
        protected OperatorService $operatorService
    ) {}

    # fungsi untuk menampilkan dashboard operator
    public function dashboard()
    {
        $data = $this->operatorService->getDashboardStats();
        return view('operator.dashboard', $data);
    }

    # fungsi untuk membuka atau menutup periode pendaftaran
    public function togglePeriode()
    {
        try {
            $newStatus = PeriodeService::toggle();
            $msg = $newStatus == '1'
                ? 'Periode pendaftaran magang kini TELAH DIBUKA.'
                : 'Periode pendaftaran magang kini TELAH DITUTUP.';
            return back()->with('success', $msg);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status periode. ' . $e->getMessage());
        }
    }

    # fungsi untuk menampilkan halaman penugasan dosen pembimbing
    public function dosenPembimbing()
    {
        return view('operator.dosen_pembimbing', [
            'belumAssign' => $this->operatorService->getBelumAssign(),
            'sudahAssign' => $this->operatorService->getSudahAssign(),
            'dosens'      => $this->operatorService->getDosens(),
        ]);
    }

    # fungsi untuk menugaskan dosen pembimbing ke magang
    public function assignDosen(Request $request, Magang $magang)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        $kode = $this->operatorService->assignDosen($magang, $request->dosen_id);

        return back()->with('success', "Mahasiswa disetujui! ID Magang {$kode} diterbitkan.");
    }

    # fungsi untuk menampilkan halaman monitoring magang
    public function monitoring(Request $request)
    {
        $magangs = $this->operatorService->monitoring($request->only(['search', 'status']));
        return view('operator.monitoring', compact('magangs'));
    }

    # fungsi untuk menampilkan halaman laporan magang
    public function laporan()
    {
        $magangs = $this->operatorService->getLaporanMagang();
        return view('operator.laporan', compact('magangs'));
    }

    # fungsi untuk menghapus data magang
    public function destroy(Magang $magang)
    {
        $magang->delete();
        return back()->with('success', 'Data magang berhasil dihapus dari sistem.');
    }
}
