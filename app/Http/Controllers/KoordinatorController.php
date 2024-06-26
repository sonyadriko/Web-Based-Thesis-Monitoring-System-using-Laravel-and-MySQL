<?php


namespace App\Http\Controllers;

// use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KoordinatorController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkKoordinator');
    }

    //
    public function index()
    {
        $mahasiswaCount = DB::table('users')->where('role_id', '1')->where('status', 'aktif')->count();
        $dosenCount = DB::table('users')->where('role_id', '2')->count();
        $pengajuanCount = DB::table('pengajuan_judul')->where('status', 'pending')->count();
        $newUserCount = DB::table('users')->where('status', 'pending')->count();


        return view('koordinator.index', compact('mahasiswaCount', 'dosenCount', 'pengajuanCount', 'newUserCount'));
    }
}
