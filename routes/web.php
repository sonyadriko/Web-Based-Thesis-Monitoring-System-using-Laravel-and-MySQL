<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\PengajuanJudulController;
use App\Http\Controllers\BidangIlmuController;
use App\Http\Controllers\KoordinatorJudulController;
use App\Http\Controllers\KoordinatorSeminarController;
use App\Http\Controllers\PembagianDosenController;
use App\Http\Controllers\BimbinganProposalController;
use App\Http\Controllers\DosenBimbinganProposalController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KoordinatorSuratTugasController;
use App\Http\Controllers\BeritaAcaraProposalController;
use App\Http\Controllers\SeminarProposalController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KoordinatorBeritaAcaraProposalController;
use App\Http\Controllers\RevisiSeminarProposalController;
use App\Http\Controllers\HistoryBimbinganController;
use App\Http\Controllers\BimbinganSkripsiController;
use App\Http\Controllers\DosenRevisiSeminarProposal;
use App\Http\Controllers\SidangSkripsiController;
use App\Http\Controllers\KoordinatorSidangSkripsiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\KoordinatorBeritaAcaraSkripsiController;
use App\Http\Controllers\BeritaAcaraSkripsiController;
use App\Http\Controllers\RevisiSidangSkripsiController;
use App\Http\Controllers\DosenRevisiSidangSkripsiController;










/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::controller
Route::controller(LoginController::class)->group(function () {
    Route::get('/auth-login', 'showLoginForm')
        ->name('auth-login')
        ->middleware('guest');
    Route::post('/auth-login', 'login')->name('auth');
    Route::get('/auth-logout', 'logout')->name('auth-logout');
    // Route::get('/reset-auth-logout', 'password_reset_logout')->name('reset-auth-logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')
    ->name('register')
    ->middleware('guest');
    // Route::post('/register', 'create')->name('regist');

});


Route::group(['middleware' => 'auth:dosen'], function() {

    Route::controller(DosenController::class)->group(function () {
        Route::get('/dosen', 'index')->name('dashboard:dosen');
    });


    Route::controller(BidangIlmuController::class)->group(function () {
        Route::get('/dosen/bidang_ilmu', 'index')->name('bidang-ilmu.index');
        Route::get('/dosen/bidang_ilmu/create', 'create')->name('bidang-ilmu.create');
        Route::post('/dosen/bidang_ilmu/create', 'store')->name('bidang-ilmu.submit');
    });

    Route::group(['prefix' => 'dosen/bimbingan_proposal'], function () {
        Route::get('/', [DosenBimbinganProposalController::class, 'index'])->name('bimbingan-dosen.index');
        Route::get('/detail/{id}', [DosenBimbinganProposalController::class, 'detail'])->name('bimbingan-dosen.detail');
        Route::post('/updaterevisi/{id}', [DosenBimbinganProposalController::class, 'updaterevisi'])->name('bimbingan-dosen.addrevisi');
        Route::post('/accrevisi/{id}', [DosenBimbinganProposalController::class, 'accrevisi'])->name('bimbingan-dosen.accrevisi');
        Route::post('/accproposal/{id}', [DosenBimbinganProposalController::class, 'accproposal'])->name('bimbingan-dosen.accproposal');
    });
    Route::group(['prefix' => 'dosen/berita_acara_proposal'], function () {
        Route::get('/', [BeritaAcaraProposalController::class, 'index'])->name('berita-acara-proposal.index');
        Route::get('/detail/{id}', [BeritaAcaraProposalController::class, 'detail'])->name('berita-acara-proposal.detail');
        Route::post('/detail/store', [BeritaAcaraProposalController::class, 'store'])->name('berita-acara-proposal.store');
    });

    Route::group(['prefix' => 'dosen/berita_acara_skripsi'], function () {
        Route::get('/', [BeritaAcaraSkripsiController::class, 'index'])->name('berita-acara-skripsi.index');
        Route::get('/detail/{id}', [BeritaAcaraSkripsiController::class, 'detail'])->name('berita-acara-skripsi.detail');
        Route::post('/detail/store', [BeritaAcaraSkripsiController::class, 'store'])->name('berita-acara-skripsi.store');
    });

    Route::group(['prefix' => 'dosen/revisi_sidang_skripsi'], function () {
        Route::get('/', [DosenRevisiSidangSkripsiController::class, 'index'])->name('dosen-revisi-semhas.index');
        Route::get('/detail/{id}', [DosenRevisiSidangSkripsiController::class, 'detail'])->name('dosen-revisi-semhas.detail');

        // Route::get('/detail/{id}', [BeritaAcaraProposalController::class, 'detail'])->name('berita-acara-proposal.detail');
        // Route::post('/detail/store', [BeritaAcaraProposalController::class, 'store'])->name('berita-acara-proposal.store');
    });

    Route::group(['prefix' => 'dosen/revisi_seminar_proposal'], function () {
        Route::get('/', [DosenRevisiSeminarProposal::class, 'index'])->name('dosen-revisi-sempro.index');
        Route::get('/detail/{id}', [DosenRevisiSeminarProposal::class, 'detail'])->name('dosen-revisi-sempro.detail');

        // Route::get('/detail/{id}', [BeritaAcaraProposalController::class, 'detail'])->name('berita-acara-proposal.detail');
        // Route::post('/detail/store', [BeritaAcaraProposalController::class, 'store'])->name('berita-acara-proposal.store');
    });
});

Route::group(['middleware' => 'auth:koordinator'], function() {

    Route::controller(KoordinatorController::class)->group(function () {
        Route::get('/koordinator', 'index')->name('dashboard:koordinator');
    });

    Route::group(['prefix' => 'koordinator/berita_acara_proposal'], function () {
        Route::get('/', [KoordinatorBeritaAcaraProposalController::class, 'index'])->name('koor-berita-acara-proposal.index');
        Route::get('/detail/{id}', [KoordinatorBeritaAcaraProposalController::class, 'detail'])->name('koor-berita-acara-proposal.detail');

    });


    Route::group(['prefix' => 'koordinator/berita_acara_skripsi'], function () {
        Route::get('/', [KoordinatorBeritaAcaraSkripsiController::class, 'index'])->name('koor-berita-acara-skripsi.index');
        Route::get('/detail/{id}', [KoordinatorBeritaAcaraSkripsiController::class, 'detail'])->name('koor-berita-acara-skripsi.detail');

    });


    Route::group(['prefix' => 'koordinator/pengajuan_judul'], function () {
        Route::get('/', [KoordinatorJudulController::class, 'index'])->name('pengajuan-judul.index');
        Route::get('/detail/{id}', [KoordinatorJudulController::class, 'detail']);
        Route::post('/update-status/{id_tema}', [KoordinatorJudulController::class, 'updatestatus2'])->name('update_status');
    });

    Route::group(['prefix' => 'koordinator/ruangan'], function () {
        Route::get('/', [RuanganController::class, 'index'])->name('ruangan.index');
        Route::get('/create', [RuanganController::class, 'create'])->name('ruangan.create');
        Route::post('/store', [RuanganController::class, 'store'])->name('ruangan.store');
        Route::get('/edit/{id}', [RuanganController::class, 'edit']);
        Route::post('/edit/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
        Route::delete('/delete/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');
    });


    Route::group(['prefix' => 'koordinator/jadwal_seminar_proposal'], function () {
        Route::get('/', [KoordinatorSeminarController::class, 'index'])->name('jadwal-seminar-proposal.index');
        Route::get('/detail/{id}', [KoordinatorSeminarController::class, 'detail']);
        Route::post('/update-status/{id}', [KoordinatorSeminarController::class, 'updatejadwal'])->name('jadwal-seminar-proposal-update');
        Route::post('/cetak-berita-acara/{id}', [KoordinatorSeminarController::class, 'createberitaacara'])->name('cetak-berita-acara');
    });

    Route::group(['prefix' => 'koordinator/jadwal_sidang_skripsi'], function () {
        Route::get('/', [KoordinatorSidangSkripsiController::class, 'index'])->name('jadwal-sidang-skripsi.index');
        Route::get('/detail/{id}', [KoordinatorSidangSkripsiController::class, 'detail']);
        Route::post('/detail/{id}', [KoordinatorSidangSkripsiController::class, 'update'])->name('jadwal-sidang-skripsi-update');
        Route::post('/cetak-berita-acara/{id}', [KoordinatorSidangSkripsiController::class, 'createberitaacara'])->name('cetak-berita-acara-s');

        // Route::post('/cetak-berita-acara/{id}', [KoordinatorSidangSkripsiController::class, 'createberitaacarask'])->name('cetak-berita-acara-sk');
    });

    Route::group(['prefix' => 'koordinator/surat_tugas'], function () {
        Route::get('/', [KoordinatorSuratTugasController::class, 'index'])->name('koor-surat-tugas.index');
        Route::get('/detail/{id}', [KoordinatorSuratTugasController::class, 'detail'])->name('koor-surat-tugas.detail');
        Route::post('/update/{id}', [KoordinatorSuratTugasController::class, 'update'])->name('koor-surat-tugas.update');
    });

    Route::controller(PembagianDosenController::class)->group(function ()
    {
        Route::get('/koordinator/pembagian_dosen', 'index')->name('pembagian-dosen.create');
        Route::get('/koordinator/pembagian_dosen/edit/{id}', 'edit');
        Route::post('/koordinator/pembagian_dosen/store', 'store')->name('pembagian-dosen.store');
    });


});

Route::group(['middleware' => 'auth:mahasiswa,dosen,koordinator,ketuajurusan'], function () {

    Route::get('storage-files/{file}', 'StorageFileController@show')->name('storage-files.show');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


    Route::get('/proposal', function () {
        return view('mahasiswa/proposal/index');
    })->name('proposal');

    Route::get('/skripsi', function () {
        return view('mahasiswa/skripsi/index');
    })->name('skripsi');

    Route::group(['prefix' => 'mahasiswa/history_bimbingan_proposal'], function () {
        Route::get('/', [HistoryBimbinganController::class, 'index'])->name('his-bim-mhs.index');
    });


    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::get('/profile/edit/{id}', 'edit');
        Route::post('/profile/update/{id}', 'store')->name('update-profile.store');

    });

    Route::controller(PengajuanJudulController::class)->group(function () {
        Route::get('/pengajuan_judul', 'create')->name('pengajuan-judul.create');
        Route::post('/pengajuan_judul', 'store')->name('pengajuan-judul.submit');
    });


    Route::controller(SeminarProposalController::class)->group(function ()
    {
        Route::get('/proposal/seminar_proposal', 'create')->name('seminar-proposal.create');
        Route::post('/proposal/seminar_proposal', 'store')->name('seminar-proposal.submit');

    });


    Route::controller(BimbinganProposalController::class)->group(function (){
        Route::get('/bimbingan_proposal', 'index')->name('bimbingan-mhs.index');
        Route::post('/bimbingan_proposal', 'store')->name('bimbingan-mhs.store');
    });

    // Route::controller(BimbinganSkripsiController::class)->group(function (){
    //     Route::get('/skripsi/bimbingan', 'index')->name('bimbingans-mhs.index');
    //     Route::post('/skripsi/bimbingan', 'store')->name('bimbingans-mhs.store');
    // });

    Route::group(['prefix' => 'skripsi/bimbingan'], function() {
        Route::get('/', [BimbinganSkripsiController::class, 'index'])->name('bimbingans-mhs.index');
        Route::post('/store', [BimbinganSkripsiController::class, 'store'])->name('bimbingans-mhs.store');
    });

    Route::group(['prefix' => 'proposal/revisi_seminar_proposal'], function () {
        Route::get('/', [RevisiSeminarProposalController::class, 'index'])->name('revisi_sp.index');
        Route::post('/store', [RevisiSeminarProposalController::class, 'store'])->name('revisi_sp.store');
    });

    Route::group(['prefix' => 'skripsi/revisi_sidang_skripsi'], function () {
        Route::get('/', [RevisiSidangSkripsiController::class, 'index'])->name('revisi_sk.index');
        Route::post('/store', [RevisiSidangSkripsiController::class, 'store'])->name('revisi_sk.store');
    });
    Route::group(['prefix' => 'skripsi/sidang_skripsi'], function () {
        Route::get('/', [SidangSkripsiController::class, 'index'])->name('sidang_skripsi.index');
        Route::post('/store', [SidangSkripsiController::class, 'store'])->name('sidang_skripsi.store');
    });

    Route::controller(SuratTugasController::class)->group(function (){
        Route::get('/proposal/surat_tugas', 'index')->name('pengajuan-st.index');
        Route::post('/proposal/surat_tugas', 'store')->name('pengajuan-st.store');
    });




});

