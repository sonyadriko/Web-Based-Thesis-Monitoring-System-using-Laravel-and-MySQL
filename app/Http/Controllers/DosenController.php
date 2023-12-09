<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $mahasiswaCount = DB::table('bimbingan_proposal')
        ->where(function ($query) {
            $user = Auth::user()->name;
            $query->where('dosen_pembimbing_utama', $user)
                  ->orWhere('dosen_pembimbing_ii', $user);
        })
        ->count();
        $BICount = DB::table('detail_bidang_ilmu')->where('users_id', Auth::user()->id)->count();
        $s1 = DB::table('seminar_proposal')->where(function($query2) {
            $user2 = Auth::user()->id;
            $query2->where('dosen_penguji_1', $user2)
                    ->orWhere('dosen_penguji_2', $user2);
        })
        ->count();
        $s2 = DB::table('sidang_skripsi')->where(function($query2) {
            $user2 = Auth::user()->id;
            $query2->where('dosen_penguji_1', $user2)
                    ->orWhere('dosen_penguji_2', $user2);
        })
        ->count();
        $s3 = $s1+$s2;
        return view('dosen.index', compact('mahasiswaCount', 'BICount', 's3'));

    }

}
