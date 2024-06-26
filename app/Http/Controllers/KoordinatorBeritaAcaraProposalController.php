<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BeritaAcaraProposal as BeritaAcaraProposal;
use App\Models\RevisiSeminarProposal as RevisiSeminarProposal;


class KoordinatorBeritaAcaraProposalController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkKoordinator');
    }
    public function index()
    {
        $ba = DB::table('berita_acara_proposal')
        ->join('users', 'users.id', 'berita_acara_proposal.users_id')
        ->join('seminar_proposal', 'seminar_proposal.id_seminar_proposal', 'berita_acara_proposal.seminar_proposal_id')
        ->join('ruangan', 'ruangan.id_ruangan', 'seminar_proposal.ruangan')
        ->latest('berita_acara_proposal.created_at')
        ->get();

    return view('koordinator/berita_acara/seminar.index', compact('ba'));
    }

    public function detail($id)
    {
        $data = [
            'data' => DB::table('berita_acara_proposal')
                ->join('users', 'users.id', 'berita_acara_proposal.users_id')
                ->join('seminar_proposal', 'seminar_proposal.id_seminar_proposal', 'berita_acara_proposal.seminar_proposal_id')
                ->join('users as penguji1', 'penguji1.id', 'seminar_proposal.dosen_penguji_1')
                ->join('users as penguji2', 'penguji2.id', 'seminar_proposal.dosen_penguji_2')
                ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
                ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
                ->join('ruangan', 'ruangan.id_ruangan', 'seminar_proposal.ruangan')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                ->where('id_berita_acara_p', '=', $id)
                ->select('berita_acara_proposal.*', 'users.*', 'seminar_proposal.*', 'bidang_ilmu.*', 'bimbingan_proposal.*', 'ruangan.nama_ruangan','penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2', 'pengajuan_judul.judul')
                ->first(),
        ];

        $bad = [
            'bad' => DB::table('detail_berita_acara_proposal')
                    ->join('users', 'users.id', 'detail_berita_acara_proposal.users_id')
                    ->where('berita_acara_proposal_id', $id)
                    ->get(),
        ];
        // var_dump($bad);


        return view('koordinator/berita_acara/seminar.detail', $data, $bad);

    }
    public function cetakrevisi(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'berita_acara_proposal_id' => 'required|integer',
            ]);

            // Periksa apakah SeminarProposal dengan ID yang diberikan ada
            $data = BeritaAcaraProposal::findOrFail($id);

            // Update data SeminarProposal
            $data->cetak_revisi = 'sudah';
            $data->save();

            // Simpan data BeritaAcaraProposal
            $ba = new RevisiSeminarProposal();
            $ba->berita_acara_proposal_id = $request->input('berita_acara_proposal_id');
            $ba->save();

            return redirect()->back()->with('success', 'Data updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }
}
