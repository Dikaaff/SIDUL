<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\EditRequest;
use App\Services\OperatorService;
use App\Services\PeriodeService;
use App\Services\EditRequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    # fungsi constructor untuk menginisialisasi service
    public function __construct(
        protected OperatorService $operatorService,
        protected EditRequestService $editRequestService
    ) {}

    # fungsi untuk menampilkan dashboard operator
    public function dashboard()
    {
        $data = $this->operatorService->getDashboardStats();
        $data['pendingEditCount'] = $this->editRequestService->getPendingCount();
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
            'belumAssign' => $this->operatorService->getBelumAssign(perPage: 5),
            'sudahAssign' => $this->operatorService->getSudahAssign(perPage: 5),
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
        $magangs = $this->operatorService->getLaporanMagang(perPage: 5);
        return view('operator.laporan', compact('magangs'));
    }

    # fungsi untuk menampilkan daftar permintaan edit data mahasiswa
    public function editRequests()
    {
        $permintaan = $this->editRequestService->getPendingRequestsForOperator();
        $riwayat = EditRequest::with(['mahasiswa.user', 'user', 'processor'])
            ->whereIn('status', ['approved', 'rejected'])
            ->latest()
            ->paginate(5);
        return view('operator.edit_requests', compact('permintaan', 'riwayat'));
    }

    # fungsi untuk menyetujui permintaan edit data
    public function approveEdit(Request $request, EditRequest $editRequest)
    {
        $result = $this->editRequestService->approve(
            $editRequest,
            Auth::user(),
            $request->catatan
        );

        return back()->with($result->success ? 'success' : 'error', $result->message);
    }

    # fungsi untuk menolak permintaan edit data
    public function rejectEdit(Request $request, EditRequest $editRequest)
    {
        $result = $this->editRequestService->reject(
            $editRequest,
            Auth::user(),
            $request->catatan
        );

        return back()->with($result->success ? 'success' : 'error', $result->message);
    }

    # fungsi untuk menghapus data magang
    public function destroy(Magang $magang)
    {
        $magang->delete();
        return back()->with('success', 'Data magang berhasil dihapus dari sistem.');
    }
}
