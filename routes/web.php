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
use App\Http\Controllers\PenjadwalanKoordinatorController;
use App\Http\Controllers\DosenBimbinganSkripsiController;
use App\Http\Controllers\HistoryBimbinganSkripsiController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\KajurController;
use App\Http\Controllers\KajurDataMahasiswaController;
use App\Http\Controllers\KajurDataDosenController;
use App\Http\Controllers\KajurDataBidangIlmuController;
use App\Http\Controllers\DataPenggunaController;
use App\Http\Controllers\KoordinatorLaporanTahunanController;
use App\Http\Controllers\SuratSurveyController;
use App\Http\Controllers\MataKuliahPendukungController;
use App\Http\Controllers\DosenBidangIlmuController;
use App\Http\Controllers\HistoryRevisiSkripsiController;
use App\Http\Controllers\HistoryRevisiProposalController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KajurJadwalController;
use App\Http\Controllers\KajurSeminarController;
use App\Http\Controllers\KajurSidangController;
use App\Http\Controllers\YudisiumController;
use App\Http\Controllers\KoordinatorYudisiumController;

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
    return redirect('login');
});

// Auth::routes();

// Route::controller
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')
        ->name('login')
        ->middleware('guest');
    Route::post('/login', 'login')->name('auth');
    Route::post('/auth-logout', 'logout')->name('auth-logout');
    // Route::get('/reset-auth-logout', 'password_reset_logout')->name('reset-auth-logout');
});


Route::get('/register', [RegisterController::class, 'showRegisterForm'])
    ->name('register-form')
    ->middleware('guest');

Route::post('/register', [RegisterController::class, 'register'])->name('register');


// Route::group(['middleware' => 'auth:ketuajurusan'], function() {
    Route::controller(HistoryController::class)->group(function () {
        Route::get('/notifications', 'notifications')->name('notifications');
    });
    Route::controller(KajurController::class)->group(function () {
        Route::get('/ketua_jurusan', 'index')->name('dashboard:kajur');
    });
    Route::controller(KajurDataMahasiswaController::class)->group(function () {
        Route::get('/ketua_jurusan/data_mahasiswa', 'index')->name('data-mhs');
    });
    Route::controller(KajurDataDosenController::class)->group(function () {
        Route::get('/ketua_jurusan/data_dosen', 'index')->name('data-dsn');
        Route::get('/ketua_jurusan/data_dosen/detail{id}', 'detail')->name('data-dsn-detail');
    });
    Route::controller(KajurDataBidangIlmuController::class)->group(function () {
        Route::get('/ketua_jurusan/data_bidang_ilmu', 'index')->name('data-bi');
    });
    Route::controller(KajurJadwalController::class)->group(function () {
        Route::get('/ketua_jurusan/jadwal', 'index')->name('data-jadwal');
    });
    Route::controller(KajurSeminarController::class)->group(function () {
        Route::get('/ketua_jurusan/seminar', 'index')->name('data-seminar');
        Route::get('/ketua_jurusan/seminar/detail/{id}', 'detail')->name('data-seminar.detail');
    });
    Route::controller(KajurSidangController::class)->group(function () {
        Route::get('/ketua_jurusan/sidang', 'index')->name('data-sidang');
        Route::get('/ketua_jurusan/sidang/detail/{id}', 'detail')->name('data-sidang.detail');
    });

// });


// Route::group(['middleware' => 'auth:dosen'], function() {
    Route::controller(HistoryController::class)->group(function () {
        Route::get('/notifications', 'notifications')->name('notifications');
    });

    Route::controller(DosenController::class)->group(function () {
        Route::get('/dosen', 'index')->name('dashboard:dosen');
    });

    Route::controller(DosenBidangIlmuController::class)->group(function () {
        Route::get('/dosen/bidang_ilmu', 'index')->name('dosen-bidang-ilmu.index');
        // Route::get('/dosen/bidang_ilmu/create', 'create')->name('bidang-ilmu.create');
        // Route::post('/dosen/bidang_ilmu/create', 'store')->name('bidang-ilmu.submit');
        Route::get('/dosen/bidang_ilmu/detail/{id}', 'detail')->name('dosen-bidang-ilmu.detail');
        Route::post('/dosen/bidang_ilmu/detail/{id}', 'submitpaper')->name('dosen-bidang-ilmu.store');
    });

    Route::group(['prefix' => 'dosen/bimbingan_proposal'], function () {
        Route::get('/', [DosenBimbinganProposalController::class, 'index'])->name('bimbingan-dosen.index');
        Route::get('/detail/{id}', [DosenBimbinganProposalController::class, 'detail'])->name('bimbingan-dosen.detail');
        Route::post('/updaterevisi/{id}', [DosenBimbinganProposalController::class, 'updaterevisi'])->name('bimbingan-dosen.addrevisi');
        Route::post('/accrevisi/{id}', [DosenBimbinganProposalController::class, 'accrevisi'])->name('bimbingan-dosen.accrevisi');
        Route::post('/accproposal/{id}', [DosenBimbinganProposalController::class, 'accproposal'])->name('bimbingan-dosen.accproposal');
    });

    Route::group(['prefix' => 'dosen/bimbingan_skripsi'], function () {
        Route::get('/', [DosenBimbinganSkripsiController::class, 'index'])->name('bimbingans-dosen.index');
        Route::get('/detail/{id}', [DosenBimbinganSkripsiController::class, 'detail'])->name('bimbingans-dosen.detail');
        Route::post('/updaterevisi/{id}', [DosenBimbinganSkripsiController::class, 'updaterevisi'])->name('bimbingans-dosen.addrevisi');
        Route::post('/accrevisi/{id}', [DosenBimbinganSkripsiController::class, 'accrevisi'])->name('bimbingans-dosen.accrevisi');
        Route::post('/accproposal/{id}', [DosenBimbinganSkripsiController::class, 'accproposal'])->name('bimbingans-dosen.accproposal');
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
        Route::post('/accrevisi/{id}', [DosenRevisiSidangSkripsiController::class, 'accrevisi'])->name('dosen-revisi-semhas.acc');
        Route::post('/addrevisi/{id}', [DosenRevisiSidangSkripsiController::class, 'addrevisi'])->name('dosen-revisi-semhas.detail');
        // Route::get('/detail/{id}', [BeritaAcaraProposalController::class, 'detail'])->name('berita-acara-proposal.detail');
        // Route::post('/detail/store', [BeritaAcaraProposalController::class, 'store'])->name('berita-acara-proposal.store');
    });

    Route::group(['prefix' => 'dosen/revisi_seminar_proposal'], function () {
        Route::get('/', [DosenRevisiSeminarProposal::class, 'index'])->name('dosen-revisi-sempro.index');
        Route::get('/detail/{id}', [DosenRevisiSeminarProposal::class, 'detail'])->name('dosen-revisi-sempro.detail');
        Route::post('/accrevisi/{id}', [DosenRevisiSeminarProposal::class, 'accrevisi'])->name('dosen-revisi-sempro.acc');
        Route::post('/addrevisi/{id}', [DosenRevisiSeminarProposal::class, 'addrevisi'])->name('dosen-revisi-add.detail');
    });
// });

// Route::group(['middleware' => 'auth:koordinator'], function() {
    Route::controller(HistoryController::class)->group(function () {
        Route::get('/notifications', 'notifications')->name('notifications');
    });

    Route::controller(KoordinatorController::class)->group(function () {
        Route::get('/koordinator', 'index')->name('dashboard:koordinator');
    });

    Route::group(['prefix' => 'koordinator/mata_kuliah_pendukung'], function () {
        Route::get('/', [MataKuliahPendukungController::class, 'index'])->name('mata-kuliah.index');
        Route::get('/create', [MataKuliahPendukungController::class, 'create'])->name('mata-kuliah.create');
        Route::post('/create', [MataKuliahPendukungController::class, 'store'])->name('mata-kuliah.store');
        // Route::post('/detail/{id}', [MataKuliahPendukungController::class, 'detail'])->name('mata-kuliah.detail');
    });

    Route::controller(KoordinatorLaporanTahunanController::class)->group(function () {
        Route::get('/koordinator/laporan_tahunan', 'index')->name('lap-tahunan.index');
    });


    Route::controller(BidangIlmuController::class)->group(function () {
        Route::get('/koordinator/bidang_ilmu', 'index')->name('bidang-ilmu.index');
        Route::get('/koordinator/bidang_ilmu/create', 'create')->name('bidang-ilmu.create');
        Route::post('/koordinator/bidang_ilmu/create', 'store')->name('bidang-ilmu.submit');
        Route::get('/koordinator/bidang_ilmu/detail/{id}', 'detail')->name('bidang-ilmu.detail');
    });

    Route::controller(DataPenggunaController::class)->group(function () {
        Route::get('/koordinator/data_pengguna', 'index')->name('data-pengguna.index');
        Route::get('/koordinator/data_pengguna/mahasiswa', 'mhs')->name('data-pengguna-mhs.index');
        Route::get('/koordinator/data_pengguna/dosen', 'dosen')->name('data-pengguna-dosen.index');
        Route::get('/koordinator/data_pengguna/ketua_jurusan', 'kajur')->name('data-pengguna-kajur.index');
        Route::get('/koordinator/data_pengguna/pengguna_baru', 'newuser')->name('data-pengguna-penggunabaru.index');
        Route::post('/koordinator/data_pengguna/pengguna_baru/terima/{id}', 'terima')->name('terima-pengguna');
        Route::post('/koordinator/data_pengguna/pengguna_baru/tolak/{id}', 'tolak')->name('tolak-pengguna');
    });

    Route::controller(PenjadwalanKoordinatorController::class)->group(function () {
        Route::get('/koordinator/penjadwalan', 'index')->name('penjadwalan-koordinator.index');
    });

    Route::group(['prefix' => 'koordinator/berita_acara_proposal'], function () {
        Route::get('/', [KoordinatorBeritaAcaraProposalController::class, 'index'])->name('koor-berita-acara-proposal.index');
        Route::get('/detail/{id}', [KoordinatorBeritaAcaraProposalController::class, 'detail'])->name('koor-berita-acara-proposal.detail');
        Route::post('/cetak-revisi/{id}', [KoordinatorBeritaAcaraProposalController::class, 'cetakrevisi'])->name('koor-berita-acara-cetak.detail');

    });


    Route::group(['prefix' => 'koordinator/berita_acara_skripsi'], function () {
        Route::get('/', [KoordinatorBeritaAcaraSkripsiController::class, 'index'])->name('koor-berita-acara-skripsi.index');
        Route::get('/detail/{id}', [KoordinatorBeritaAcaraSkripsiController::class, 'detail'])->name('koor-berita-acara-skripsi.detail');
        Route::post('/cetak-revisi/{id}', [KoordinatorBeritaAcaraSkripsiController::class, 'cetakrevisi'])->name('koor-berita-acara-s-cetak.detail');
    });


    Route::group(['prefix' => 'koordinator/pengajuan_judul'], function () {
        Route::get('/', [KoordinatorJudulController::class, 'index'])->name('pengajuan-judul.index');
        Route::get('/detail/{id}', [KoordinatorJudulController::class, 'detail']);
        Route::post('/update-status/{id}', [KoordinatorJudulController::class, 'updatestatus2'])->name('update_status');
        Route::post('/tolak/{id}', [KoordinatorJudulController::class, 'tolakpengajuan'])->name('pengajuan-judul-tolak');
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
        Route::post('/tolak/{id}', [KoordinatorSeminarController::class, 'tolakjadwal'])->name('jadwal-seminar-proposal-tolak');
        Route::post('/cetak-berita-acara/{id}', [KoordinatorSeminarController::class, 'createberitaacara'])->name('cetak-berita-acara');
    });

    Route::group(['prefix' => 'koordinator/jadwal_sidang_skripsi'], function () {
        Route::get('/', [KoordinatorSidangSkripsiController::class, 'index'])->name('jadwal-sidang-skripsi.index');
        Route::get('/detail/{id}', [KoordinatorSidangSkripsiController::class, 'detail']);
        Route::post('/detail/{id}', [KoordinatorSidangSkripsiController::class, 'update'])->name('jadwal-sidang-skripsi-update');
        Route::post('/tolak/{id}', [KoordinatorSidangSkripsiController::class, 'tolakjadwal'])->name('jadwal-sidang-skripsi-tolak');
        Route::post('/cetak-berita-acara/{id}', [KoordinatorSidangSkripsiController::class, 'createberitaacara'])->name('cetak-berita-acara-s');

        // Route::post('/cetak-berita-acara/{id}', [KoordinatorSidangSkripsiController::class, 'createberitaacarask'])->name('cetak-berita-acara-sk');
    });

    Route::group(['prefix' => 'koordinator/surat_tugas'], function () {
        Route::get('/', [KoordinatorSuratTugasController::class, 'index'])->name('koor-surat-tugas.index');
        Route::get('/detail/{id}', [KoordinatorSuratTugasController::class, 'detail'])->name('koor-surat-tugas.detail');
        Route::post('/update/{id}', [KoordinatorSuratTugasController::class, 'update'])->name('koor-surat-tugas.update');
        Route::post('/tolak/{id}', [KoordinatorSuratTugasController::class, 'tolaksurat'])->name('koor-surat-tugas-tolak');

    });

    Route::group(['prefix' => 'koordinator/yudisium'], function () {
        Route::get('/', [KoordinatorYudisiumController::class, 'index'])->name('koor-yudisium.index');
        Route::get('/detail/{id}', [KoordinatorYudisiumController::class, 'detail'])->name('koor-yudisium.detail');
        // Route::[pst]('/detail/{id}', [KoordinatorYudisiumController::class, 'detail'])->name('koor-yudisium.detail');
        Route::post('/update/{id}', [KoordinatorYudisiumController::class, 'update'])->name('koor-yudisium.update');
        Route::post('/tolak/{id}', [KoordinatorYudisiumController::class, 'tolak'])->name('koor-yudisium-tolak');

    });

    Route::controller(PembagianDosenController::class)->group(function ()
    {
        Route::get('/koordinator/pembagian_dosen', 'index')->name('pembagian-dosen.create');
        Route::get('/koordinator/pembagian_dosen/edit/{id}', 'edit');
        Route::post('/koordinator/pembagian_dosen/store', 'store')->name('pembagian-dosen.store');
    });



// });

// Route::group(['middleware' => 'auth:mahasiswa'], function () {
    Route::controller(HistoryController::class)->group(function () {
        Route::get('/notifications', 'notifications')->name('notifications');
    });

    Route::get('storage-files/{file}', 'StorageFileController@show')->name('storage-files.show');


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


    Route::get('/proposal', function () {
        return view('mahasiswa/proposal/index');
    })->name('proposal');

    Route::get('/skripsi', function () {
        return view('mahasiswa/skripsi/index');
    })->name('skripsi');

    Route::group(['prefix' => 'history_bimbingan_proposal'], function () {
        Route::get('/', [HistoryBimbinganController::class, 'index'])->name('his-bim-mhs.index');
    });
    Route::group(['prefix' => 'history_bimbingan_skripsi'], function () {
        Route::get('/', [HistoryBimbinganSkripsiController::class, 'index'])->name('his-bims-mhs.index');
    });

    Route::group(['prefix' => 'surat_survey_perusahaan'], function () {
        Route::get('/', [SuratSurveyController::class, 'index'])->name('surat-survey.index');
        Route::post('/', [SuratSurveyController::class, 'store'])->name('surat-survey.store');
    });

    Route::group(['prefix' => 'history_revisi_skripsi'], function () {
        Route::get('/', [HistoryRevisiSkripsiController::class, 'index'])->name('his-rev-mhs.index');
    });
    Route::group(['prefix' => 'history_revisi_seminar'], function () {
        Route::get('/', [HistoryRevisiProposalController::class, 'index'])->name('his-rev-pro.index');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::get('/profile/edit/{id}', 'edit');
        Route::post('/profile/update/{id}', 'store')->name('update-profile.store');
    });

    Route::controller(PengajuanJudulController::class)->group(function () {
        // Route::get('/pengajuan_judul', 'create')->name('pengajuan-judul.create');
        Route::post('/pengajuan_judul', 'store')->name('pengajuan-judul.submit');
        Route::get('/pengajuan_judul', 'showFormPengajuan')->name('pengajuan-judul.form');
    });

    Route::controller(SeminarProposalController::class)->group(function ()
    {
        Route::get('/seminar_proposal', 'create')->name('seminar-proposal.create');
        Route::post('/seminar_proposal', 'store')->name('seminar-proposal.submit');
        Route::get('/seminar_proposal/check-status', 'checkStatus')->name('seminar-proposal.check');
        Route::get('/seminar_proposal/status/{id}', 'showStatus')->name('status.show');
        Route::get('/submit-form', 'create')->name('submit-form');
    });

    Route::controller(BimbinganProposalController::class)->group(function (){
        Route::get('/bimbingan_proposal', 'index')->name('bimbingan-mhs.index');
        Route::post('/bimbingan_proposal', 'store')->name('bimbingan-mhs.store');
    });

    Route::group(['prefix' => '/bimbingan_skripsi'], function() {
        Route::get('/', [BimbinganSkripsiController::class, 'index'])->name('bimbingans-mhs.index');
        Route::post('/store', [BimbinganSkripsiController::class, 'store'])->name('bimbingans-mhs.store');
    });

    Route::group(['prefix' => '/revisi_seminar_proposal'], function () {
        Route::get('/', [RevisiSeminarProposalController::class, 'index'])->name('revisi_sp.index');
        Route::post('/store', [RevisiSeminarProposalController::class, 'store'])->name('revisi_sp.store');
    });

    Route::group(['prefix' => '/revisi_sidang_skripsi'], function () {
        Route::get('/', [RevisiSidangSkripsiController::class, 'index'])->name('revisi_sk.index');
        Route::post('/store', [RevisiSidangSkripsiController::class, 'store'])->name('revisi_sk.store');
    });
    Route::group(['prefix' => '/sidang_skripsi'], function () {
        Route::get('/', [SidangSkripsiController::class, 'index'])->name('sidang_skripsi.index');
        Route::post('/store', [SidangSkripsiController::class, 'store'])->name('sidang_skripsi.store');
        Route::get('/check-status', [SidangSkripsiController::class, 'checkStatus'])->name('sidang-skripsi.check');
        Route::get('/status/{id}', [SidangSkripsiController::class, 'showStatus'])->name('sidang-skripsi.status');
        Route::get('/submit-form', [SidangSkripsiController::class, 'index'])->name('sidang-skripsi.store');
        // Route::get('/submit-form', 'create')->name('submit-form');
    });

    Route::controller(SuratTugasController::class)->group(function (){
        Route::get('/surat_tugas', 'index')->name('pengajuan-st.index');
        Route::post('/surat_tugas', 'store')->name('pengajuan-st.store');
        Route::get('/surat_tugas/check-status', 'checkStatus')->name('pengajuan-st.check');
        Route::get('/surat_tugas/status/{id}', 'showStatus')->name('pengajuan-st.show');
        Route::get('/submit-form', 'create')->name('pengajuan-st.submit-form');
    });

    Route::controller(FAQController::class)->group(function () {
        Route::get('/faq', 'index')->name('faq');
    });

    Route::group(['prefix' => '/yudisium'], function () {
        Route::get('/', [YudisiumController::class, 'index'])->name('yudisium.index');
        Route::post('/store', [YudisiumController::class, 'store'])->name('yudisium-store');
        Route::get('/check-status', [YudisiumController::class, 'checkStatus'])->name('yudisium.check');
        Route::get('/status/{id}', [YudisiumController::class, 'showStatus'])->name('yudisium.status');
        Route::get('/submit-form', [YudisiumController::class, 'index'])->name('yudisium.store');
        // Route::get('/submit-form', 'create')->name('submit-form');
    });

    Route::fallback(function () {
        return view('404'); // Gantilah 'errors.404' dengan nama view yang sesuai untuk halaman 404 Anda
    });

// });

