@extends('layout.master')

@section('title')
    Detail Sidang Skripsi
@endsection

@section('css')
    <link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Daftar Jadwal</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sidang Skripsi</li>
        </ol>
    </nav>
    <div class="row">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <h5 class="card-header">Data Sidang Skripsi</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="npm" class="form-label" style="font-weight: bold">NPM</label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data->kode_unik }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="name" class="form-label" style="font-weight: bold">Nama
                                        Mahasiswa</label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data->name }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="npm" class="form-label" style="font-weight: bold">Judul</label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data->judul }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="bidang_ilmu" class="form-label" style="font-weight: bold">Bidang
                                        Ilmu</label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data->topik_bidang_ilmu }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="dospem_utama" class="form-label" style="font-weight: bold">Dosen Pembimbing
                                        1</label>
                                </div>
                                <div class="col-sm-9">

                                    <p><span>{{ $data->dosen_pembimbing_utama }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="dospem_2" class="form-label" style="font-weight: bold">Dosen Pembimbing
                                        2</label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data->dosen_pembimbing_ii }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label" style="font-weight: bold">File
                                        Proposal</label>
                                </div>
                                <div class="col-sm-9">

                                    <p> <a href="{{ asset($data->file_skripsi) }}" type="application/pdf"
                                            target="_blank">{{ basename($data->file_skripsi) }}</a>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label" style="font-weight: bold">File
                                        Slip
                                        Pembayaran</label>
                                </div>
                                <div class="col-sm-9">
                                    <p> <a href="{{ asset($data->file_slip_pembayaran) }}" type="application/pdf"
                                            target="_blank">{{ basename($data->file_slip_pembayaran) }}</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label" style="font-weight: bold">Ketua Seminar/Dosen
                                        Penguji 1</label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data2->nama_penguji_1 ?? 'Belum diatur' }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label class="form-label" style="font-weight: bold">Dosen Penguji 2</label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data2->nama_penguji_2 ?? 'Belum diatur' }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="dosenPenguji3" class="form-label" style="font-weight: bold">Dosen Penguji
                                        3</label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data2->nama_penguji_3 ?? 'Belum diatur' }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="ruanganSeminar" class="form-label" style="font-weight: bold">Ruangan
                                        Seminar</label>
                                </div>
                                <div class="col-sm-9">
                                    <p><span>{{ $data2->nama_ruangan ?? 'Belum diatur' }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="date" class="form-label" style="font-weight: bold">Tanggal</label>
                                </div>
                                <div class="col-sm-9">
                                    @php
                                        $formatTanggal = null;
                                        if (!is_null($data->tanggal)) {
                                            $carbonTanggal = \Carbon\Carbon::parse($data->tanggal);
                                            $formatTanggal = ucfirst(
                                                $carbonTanggal->formatLocalized('%A, %d %B %Y', strftime('%A')),
                                            );
                                        }
                                    @endphp
                                    <p><span>{{ $formatTanggal ?? 'Belum diatur' }}</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="time" class="form-label" style="font-weight: bold">Jam</label>
                                </div>
                                <div class="col-sm-9">
                                    @php
                                        $formatJam = null;
                                        if (!is_null($data->jam)) {
                                            $carbonJam = \Carbon\Carbon::parse($data->jam);
                                            $formatJam = $carbonJam->format('H:i');
                                        }
                                    @endphp
                                    <p><span>{{ $formatJam ?? 'Belum diatur' }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="users_id" value="{{ $data2->users_id }}" />
                    <input type="hidden" name="sidang_skripsi_id" value="{{ $data->id_sidang_skripsi }}" />

                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary"
                            onclick="window.history.back();">Kembali</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function updateSelectOptions() {
        var select1 = document.getElementById("select1");
        var select2 = document.getElementById("select2");
        var select3 = document.getElementById("select3");

        // Clear existing options in select2, select3, and select4
        select2.innerHTML = '<option value="" selected disabled>Pilih dosen penguji 2</option>';
        select3.innerHTML = '<option value="" selected disabled>Pilih dosen penguji 3</option>';

        // Get the selected option from select1
        var selectedOption1 = select1.options[select1.selectedIndex];

        // Clone the options from select1 to select2, excluding the selected option1
        for (var i = 0; i < select1.options.length; i++) {
            if (select1.options[i] !== selectedOption1) {
                var option2 = document.createElement("option");
                option2.value = select1.options[i].value;
                option2.text = select1.options[i].text;

                // Check if the option is already present in select2
                var isDuplicate = false;
                for (var j = 0; j < select2.options.length; j++) {
                    if (select2.options[j].value === option2.value) {
                        isDuplicate = true;
                        break;
                    }
                }

                // Add the option to select2 if not a duplicate
                if (!isDuplicate) {
                    select2.add(option2);
                }

                var option3 = document.createElement("option");
                option3.value = select1.options[i].value;
                option3.text = select1.options[i].text;

                // Check if the option is already present in select3
                isDuplicate = false;
                for (var j = 0; j < select3.options.length; j++) {
                    if (select3.options[j].value === option3.value) {
                        isDuplicate = true;
                        break;
                    }
                }

                // Add the option to select3 if not a duplicate
                if (!isDuplicate) {
                    select3.add(option3);
                }



            }
        }

        // Get the selected option from select2
        var selectedOption2 = select2.options[select2.selectedIndex];

        // Clone the options from select2 to select3, excluding the selected option2
        for (var i = 0; i < select2.options.length; i++) {
            if (select2.options[i] !== selectedOption2) {
                var option3 = document.createElement("option");
                option3.value = select2.options[i].value;
                option3.text = select2.options[i].text;

                // Check if the option is already present in select3
                var isDuplicate = false;
                for (var j = 0; j < select3.options.length; j++) {
                    if (select3.options[j].value === option3.value) {
                        isDuplicate = true;
                        break;
                    }
                }

                // Add the option to select3 if not a duplicate
                if (!isDuplicate) {
                    select3.add(option3);
                }



            }
        }
    }
</script>



<script>
    // function showConfirmation2() {
    //     Swal.fire({
    //         title: 'Apakah Anda yakin ingin submit data?',
    //         text: 'Pastikan data sudah benar sebelum submit.',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Ya, Sumbit!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             // Submit form only if "Ya" is clicked
    //             document.getElementById('submitForm').submit();
    //         }
    //     });
    // }

    function showConfirmation2() {
        Swal.fire({
            title: 'Apakah Anda yakin ingin submit data?',
            text: 'Pastikan data sudah benar sebelum submit.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Submit!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform form validation
                var formIsValid = true;

                // Validate dosen_penguji_1
                var dosenPenguji1 = document.getElementById('select1').value;
                if (!dosenPenguji1) {
                    formIsValid = false;
                    Swal.fire({
                        title: 'Error',
                        text: 'Dosen Penguji 1 harus dipilih.',
                        icon: 'error',
                    });
                    return;
                }

                // Validate dosen_penguji_2
                var dosenPenguji2 = document.getElementById('select2').value;
                if (!dosenPenguji2) {
                    formIsValid = false;
                    Swal.fire({
                        title: 'Error',
                        text: 'Dosen Penguji 2 harus dipilih.',
                        icon: 'error',
                    });
                    return;
                }

                // Validate dosen_penguji_3
                var dosenPenguji3 = document.getElementById('select3').value;
                if (!dosenPenguji3) {
                    formIsValid = false;
                    Swal.fire({
                        title: 'Error',
                        text: 'Dosen Penguji 3 harus dipilih.',
                        icon: 'error',
                    });
                    return;
                }
                // Validate ruanganSeminar
                var ruanganSeminar = document.getElementById('ruanganSeminar').value;
                if (!ruanganSeminar) {
                    formIsValid = false;
                    Swal.fire({
                        title: 'Error',
                        text: 'Ruangan Seminar harus dipilih.',
                        icon: 'error',
                    });
                    return;
                }

                // Validate date
                var date = document.getElementById('html5-date-input').value;
                if (!date) {
                    formIsValid = false;
                    Swal.fire({
                        title: 'Error',
                        text: 'Tanggal harus diisi.',
                        icon: 'error',
                    });
                    return;
                }

                // Validate time
                var time = document.getElementById('html5-time-input').value;
                if (!time) {
                    formIsValid = false;
                    Swal.fire({
                        title: 'Error',
                        text: 'Waktu harus diisi.',
                        icon: 'error',
                    });
                    return;
                }

                // Jika formulir valid, submit formulir
                if (formIsValid) {
                    // Tampilkan pesan sukses sebelum reload
                    Swal.fire({
                        title: 'Success',
                        text: 'Data berhasil disubmit.',
                        icon: 'success',
                    }).then(() => {
                        // Submit form
                        document.getElementById('submitForm').submit();
                    });
                }
            }
        });
    }

    function showConfirmation() {
        Swal.fire({
            title: 'Apakah Anda yakin ingin mencetak?',
            text: 'Pastikan data sudah benar sebelum mencetak.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Cetak!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Tampilkan pesan sukses sebelum reload
                Swal.fire({
                    title: 'Success',
                    text: 'Data berhasil dicetak.',
                    icon: 'success',
                }).then(() => {
                    // Submit form cetak
                    document.getElementById('cetakForm').submit();
                });
            }
        });
    }
</script>
