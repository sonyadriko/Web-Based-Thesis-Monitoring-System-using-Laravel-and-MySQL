<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KoordinatorBeritaAcaraProposalController extends Controller
{
    public function index()
    {
        $ba = DB::table('berita_acara_proposal')
        ->join('users', 'users.id', 'berita_acara_proposal.users_id')
        ->join('seminar_proposal', 'seminar_proposal.id_seminar_proposal', 'berita_acara_proposal.seminar_proposal_id')
        ->join('ruangan', 'ruangan.id_ruangan', 'seminar_proposal.ruangan')
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
                ->join('ruangan', 'ruangan.id_ruangan', 'seminar_proposal.ruangan')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                ->where('id_berita_acara_p', '=', $id)
                ->select('berita_acara_proposal.*', 'users.*', 'seminar_proposal.*', 'bidang_ilmu.*', 'bimbingan_proposal.*', 'ruangan.nama_ruangan','penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2')
                ->first(),
        ];

        $bad = [
            'bad' => DB::table('detail_berita_acara_proposal')
                    ->join('users', 'users.id', 'detail_berita_acara_proposal.users_id')
                    ->where('berita_acara_proposal_id', $id)
                    ->get(),
        ];


        return view('koordinator/berita_acara/seminar.detail', $data, $bad);

    }
}
