@extends('layout.master')

@section('title')
Proposal
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Penjadwalan</a></li>
      <li class="breadcrumb-item active" aria-current="page">Pengajuan Seminar Proposal</li>
    </ol>
</nav>
<div class="row">
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card mb-4">
        <h5 class="card-header">Form Pengajuan</h5>
        <div class="card-body">
            <form action="{{ route('update_status', ['id_tema' => $data->id_tema]) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Mahasiswa</label>
                    <input class="form-control" type="text" id="name" name="nama" value="{{ $data->name }}" readonly />
                </div>

                <div class="mb-3">
                    <label for="npm" class="form-label">NPM Mahasiswa</label>
                    <input class="form-control" type="text" id="npm" value="{{ $data->kode_unik }}" name="npm" placeholder="13.2019.1.00819" readonly />
                </div>

                <div class="mb-3">
                    <label for="tbi" class="form-label">Topik Bidang Ilmu</label>
                    <input class="form-control" type="text" id="tbi" value="{{ $data->topik_bidang_ilmu }}" name="tbi" readonly />
                </div>

                <div class="mb-3">
                    <label for="dosen_pembimbing_utama" class="form-label">Dosen Pembimbing Utama</label>
                    <input class="form-control" type="text" id="dosen_pembimbing_utama" value="{{ $data->nama_dosen }}" name="dosen_pembimbing_utama" readonly />
                </div>

                <div class="mb-3">
                    <label for="dosen_pembimbing_ii" class="form-label">Dosen Pembimbing II</label>
                    <select class="form-select" id="select1" name="dosen_pembimbing_ii" aria-label="Default select example">
                        <option value="" selected disabled>Open this select menu</option>
                        <option value="Tidak Ada">Tidak Ada</option>
                        @foreach($dosen2 as $datas)
                            @if($datas->name != $data->nama_dosen) <!-- Tambahkan kondisi untuk memeriksa kesamaan dengan Dosen Pembimbing Utama -->
                                <option value="{{ $datas->name }}">{{ $datas->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>


                <input type="hidden" name="tema_id" value="{{ $data->id_tema }}" />
                <input type="hidden" name="bidang_ilmu_id" value="{{ $data->bidang_ilmu_id }}" />
                <input type="hidden" name="user_id" value="{{ $data->user_id }}" />

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>

                    <div style="display: flex; justify-content: flex-end;">
                        @if ($data->status === 'pending')
                            <button type="submit" class="btn btn-primary" name="action" value="terima">Terima</button>
                            <button type="submit" class="btn btn-primary" name="action" value="tolak">Tolak</button>
                        @elseif ($data->status === 'terima')
                            <p>Data ini telah diterima.</p>
                        @elseif ($data->status === 'tolak')
                            <p>Data ini telah ditolak.</p>
                        @endif
                    </div>
                </div>
            </form>
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

      // Clear existing options in select2 and select3
      select2.innerHTML = '<option value="" selected disabled>Open this select menu</option>';
      select3.innerHTML = '<option value="" selected disabled>Open this select menu</option>';

      // Get the selected option from select1
      var selectedOption = select1.options[select1.selectedIndex];

      // Clone the options from select1 to select2 and select3, excluding the selected option
      for (var i = 0; i < select1.options.length; i++) {
          if (select1.options[i] !== selectedOption) {
              var option2 = document.createElement("option");
              option2.value = select1.options[i].value;
              option2.text = select1.options[i].text;
              select2.add(option2);

              var option3 = document.createElement("option");
              option3.value = select1.options[i].value;
              option3.text = select1.options[i].text;
              select3.add(option3);
          }
      }
    }
    </script>


<script>
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
              document.getElementById('cetakForm').submit();
          }
      });
  }
  </script>