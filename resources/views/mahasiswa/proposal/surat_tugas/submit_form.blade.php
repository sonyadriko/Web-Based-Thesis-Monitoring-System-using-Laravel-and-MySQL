@extends('layout.master')

@section('title')
    Pengajuan Surat Tugas
@endsection

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-steps/jquery.steps.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <style>
        .wizard>.content {
            min-height: 50em;
            /* Menggunakan auto untuk menghilangkan batasan minimum tinggi */
        }
    </style>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">Surat Tugas Bimbingan</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Alur Pendaftaran Surat Tugas Bimbingan</h4>
                    <div id="wizard">
                        <h2>Step Pertama</h2>
                        <section>
                            <div class="row">
                                <div class="card-group">
                                    <div class="card">
                                        <img src="{{ url('img/wizard/surat_tugas/step1.webp') }}" class="card-img-top"
                                            alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Mempersiapkan File</h5>
                                            <p class="card-text text-center">File Proposal yang sudah di acc, slip asli
                                                pembayaran.</p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <img src="{{ url('img/wizard/surat_tugas/step2.webp') }}" class="card-img-top"
                                            alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Mengisi Form Surat Tugas</h5>
                                            <p class="card-text text-center">Melakukan pengisian form pengajuan surat tugas.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <img src="{{ url('img/wizard/surat_tugas/step3.webp') }}" class="card-img-top"
                                            alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Mengambil Surat Tugas</h5>
                                            <p class="card-text text-center">Melakukan pengambilan surat tugas di CSR
                                                Jurusan.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <h2>Step Kedua</h2>
                        <section>
                            <form action="{{ route('pengajuan-st.store') }}" method="POST" enctype="multipart/form-data"
                                id="yourFormId">
                                @csrf
                                <div class="mb-3">
                                    <label for="judulskripsi" class="form-label">Judul Skripsi</label>
                                    <input class="form-control" type="text" id="judulskripsi" value="{{ $datas->judul }}"
                                        name="judulskripsi" disabled />

                                </div>
                                <div class="mb-3">
                                    <label for="dospem1" class="form-label">Dosen Pembimbing 1</label>
                                    <input class="form-control" type="text" id="dospem1" name="dospem1"
                                        value="{{ $datas->dosen_pembimbing_utama }}" disabled />

                                </div>
                                <div class="mb-3">
                                    <label for="dospem2" class="form-label">Dosen Pembimbing 2</label>
                                    <input class="form-control" type="text" id="dospem2" name="dospem2"
                                        value="{{ $datas->dosen_pembimbing_ii }}" disabled />

                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Mahasiswa</label>
                                    <input class="form-control" type="text" id="name" name="nama"
                                        value="{{ Auth::user()->name }}" disabled />

                                </div>
                                <div class="mb-3">
                                    <label for="npm" class="form-label">NPM Mahasiswa</label>
                                    <input class="form-control" type="text" id="npm"
                                        value="{{ Auth::user()->kode_unik }}" name="npm" disabled />

                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_sidang_proposal" class="form-label">Tanggal Sidang Proposal
                                        Skripsi</label>
                                    {{-- <input class="form-control" type="date" name="tanggal_sidang_proposal" id="tanggal_sidang_proposal" /> --}}
                                    {{-- <input class="form-control" type="text" id="tanggal_sidang_proposal" value="{{$datas->tanggal}}" name="tanggal_sidang_proposal" disabled/> --}}
                                    <input class="form-control" type="text"
                                        value="{{ \Carbon\Carbon::parse($datas->tanggal)->format('d-m-Y') }}" disabled />
                                    <input type="hidden" id="tanggal_sidang_proposal" name="tanggal_sidang_proposal"
                                        value="{{ $datas->tanggal }}" />
                                    @error('tanggal_sidang_proposal')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="file_proposal" class="form-label">Upload File Proposal Skripsi</label>
                                    <input class="form-control" type="file" name="file_proposal" id="file_proposal" />
                                    {{-- <p class="text-danger"> File : PDF</p> --}}
                                    <p class="text-danger"> File : PDF | Size Max : 5MB.</p>
                                    @error('file_proposal')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="file_slip_pembayaran" class="form-label">Upload File Slip Pembayaran Surat
                                        Tugas</label>
                                    <input class="form-control" type="file" name="file_slip_pembayaran"
                                        id="file_slip_pembayaran" />
                                    {{-- <p class="text-danger"> File : PDF</p> --}}
                                    <p class="text-danger"> File : PDF | Size Max : 1MB.</p>
                                    @error('file_slip_pembayaran')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="bimbingan_proposal_id"
                                    value="{{ $datas->id_bimbingan_proposal }}">
                            </form>
                        </section>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>


    {{-- !-- row --> --}}
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@push('custom-scripts')
    <script>
        $(function() {
            'use strict';

            $("#wizard").steps({
                headerTag: "h2",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                onStepChanging: function(event, currentIndex, newIndex) {
                    // Validasi data di setiap langkah jika diperlukan
                    return true; // Kembalikan true jika data valid
                },
                onFinished: function(event, currentIndex) {
                    // Tampilkan konfirmasi sebelum menyimpan perubahan
                    showConfirmation();
                }
            });

            function showConfirmation() {
                // Use SweetAlert to show a simple confirmation message
                Swal.fire({
                    title: 'Konfirmasi?',
                    text: 'Apakah Anda ingin menyimpan perubahan?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user clicks "Yes," submit the form
                        saveChanges();
                    }
                });
            }


            // function saveChanges() {
            //     // Gather form data
            //     var form = $('#yourFormId')[0]; // Replace 'yourFormId' with the actual ID of your form

            //     // Standard form submission
            //     form.submit();
            // }
            function saveChanges() {
                // Gather form data
                var form = $('#yourFormId')[0]; // Ganti 'yourFormId' dengan ID sebenarnya formulir Anda
                var formData = new FormData(form);

                // Menggunakan AJAX untuk mengirim formulir
                $.ajax({
                    type: 'POST',
                    url: form.action,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Display success message
                        Swal.fire({
                            title: 'Pendaftaran Sukses!',
                            text: 'Pendaftaran surat tugas berhasil!', // Adjust to the actual response message
                            icon: 'success',
                        }).then((result) => {
                            // Redirect to /dashboard after pressing "OK"
                            if (result.isConfirmed || result.isDismissed) {
                                window.location.href = '/dashboard';
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        // Tangani kesalahan jika respons dari server mengandung kesalahan
                        var errorResponse = xhr.responseJSON;

                        if (errorResponse && errorResponse.errors) {
                            // Jika terdapat kesalahan validasi dari server, tampilkan pesan kesalahan
                            var errorMessage = Object.values(errorResponse.errors).flat().join('<br>');
                            Swal.fire({
                                title: 'Error',
                                html: errorMessage,
                                icon: 'error',
                            });
                        } else {
                            // Jika kesalahan bukan karena validasi, tampilkan pesan kesalahan umum
                            Swal.fire({
                                title: 'Error',
                                text: 'An error occurred while processing your request. Please try again.',
                                icon: 'error',
                            });
                        }
                    }
                });
            }
        });
    </script>
@endpush
