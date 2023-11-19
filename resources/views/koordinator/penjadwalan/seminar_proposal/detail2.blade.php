@extends('layouts/template')

@section('title')
Proposal
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Penjadwalan Seminar Proposal</h5>
        @if (is_null($data)||is_null($data->dosen_penguji_1)||is_null($data->dosen_penguji_2))
        <div class="card-body">
            <form action="{{ route('jadwal-seminar-proposal-update', ['id' => $data->id_seminar_proposal]) }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" class="form-control" id="npm" name="npm" value="{{$data->kode_unik}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                <label for="name" class="form-label">Nama Mahasiswa</label>
                <input type="text" name="name" class="form-control" id="name" value="{{$data->name}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                <label for="bidang_ilmu" class="form-label">Judul yang diajukan</label>
                <input type="text" class="form-control" id="bidang_ilmu" name="bidang_ilmu" value="{{$data->topik_bidang_ilmu}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                <label for="dospem_utama" class="form-label">Dosen Pembimbing 1</label>
                <input type="text" class="form-control" id="dospem_utama" name="dospem_utama" value="{{$data->dosen_pembimbing_utama}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                <label for="dospem_2" class="form-label">Dosen Pembimbing 2</label>
                <input type="text" class="form-control" name="dospem_2" id="dospem_2" value="{{$data->dosen_pembimbing_ii}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
            <div class="mb-3">
              <label for="defaultFormControlInput" class="form-label">File Proposal</label>
              <iframe src="{{ route('storage-files.show', ['file' => 'path/to/your/file.pdf']) }}" width="100%" height="500px"></iframe>
            </div>
            <div class="mb-3">
              <label for="select1" class="form-label">Ketua Seminar/Dosen Penguji 1</label>
              <select class="form-select" id="select1" name="dosen_penguji_1" aria-label="Default select example" onchange="updateSelectOptions()">
                <option value="" selected disabled>Open this select menu</option>

                  @foreach($baru as $datas)
                      <option value="{{$datas->id}}">{{$datas->name}}</option>
                  @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="select2" class="form-label">Dosen Penguji 2</label>
              <select class="form-select" id="select2" name="dosen_penguji_2" aria-label="Default select example">
                <option value="" selected disabled>Open this select menu</option>
              </select>
            </div>
            <div class="row mb-3">
              <div class="col-md-2">
                <label for="ruanganSeminar" class="form-label">Ruangan Seminar</label>
              </div>
              <div class="col">
                <input type="text" class="form-control" name="ruangan_seminar" id="ruanganSeminar" placeholder="A-204" aria-describedby="ruanganSeminarHelp"/>
              </div>
              <div class="col-md-2">
                <label for="html5-date-input" class="form-label">Date</label>
              </div>
              <div class="col">
                <input class="form-control" name="date" type="date" value="2021-06-18" id="html5-date-input" />
              </div>
              
              <div class="col-md-2">
                <label for="html5-time-input" class="form-label">Time</label>
              </div>
              <div class="col">
                <input class="form-control" name="time" type="time" value="12:30:00" id="html5-time-input" />
              </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
              <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
      @else
      <div class="card-body">
        {{-- <form action="{{ route('cetak-berita-acara', ['id' => $data->id_seminar_proposal])}}" method="POST"> --}}
        <form action="{{ route('cetak-berita-acara', ['id' => $data->id_seminar_proposal]) }}" method="POST" id="cetakForm">

          @csrf
          <div class="mb-3">
            <label for="npm" class="form-label">NPM</label>
            <input type="text" class="form-control" id="npm" name="npm" value="{{$data->kode_unik}}" aria-describedby="defaultFormControlHelp" readonly />
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Nama Mahasiswa</label>
            <input type="text" name="name" class="form-control" id="name" value="{{$data->name}}" aria-describedby="defaultFormControlHelp" readonly />
          </div>
          <div class="mb-3">
            <label for="bidang_ilmu" class="form-label">Judul yang diajukan</label>
            <input type="text" class="form-control" id="bidang_ilmu" name="bidang_ilmu" value="{{$data->topik_bidang_ilmu}}" aria-describedby="defaultFormControlHelp" readonly />
          </div>
          <div class="mb-3">
            <label for="dospem_utama" class="form-label">Dosen Pembimbing 1</label>
            <input type="text" class="form-control" id="dospem_utama" name="dospem_utama" value="{{$data->dosen_pembimbing_utama}}" aria-describedby="defaultFormControlHelp" readonly />
          </div>
          <div class="mb-3">
            <label for="dospem_2" class="form-label">Dosen Pembimbing 2</label>
            <input type="text" class="form-control" name="dospem_2" id="dospem_2" value="{{$data->dosen_pembimbing_ii}}" aria-describedby="defaultFormControlHelp" readonly />
          </div>
          <div class="mb-3">
            <label for="defaultFormControlInput" class="form-label">File Proposal</label>
            <iframe src="{{ route('storage-files.show', ['file' => 'path/to/your/file.pdf']) }}" width="100%" height="500px"></iframe>
          </div>
          <div class="mb-3">
            <label for="dosen_penguji_1" class="form-label">Ketua Seminar/Dosen Penguji 1</label>
            <input type="text" class="form-control" id="dosen_penguji_1" name="dosen_penguji_1" value="{{$data->dosen_penguji_1}}" readonly />
          </div>
          <div class="mb-3">
            <label for="dosen_penguji_2" class="form-label">Dosen Penguji 2</label>
            <input type="text" class="form-control" id="dosen_penguji_2" name="dosen_penguji_2" value="{{$data->dosen_penguji_2}}" readonly />
          </div>
          <div class="row mb-3">
            <div class="col-md-2">
              <label for="ruanganSeminar" class="form-label">Ruangan Seminar</label>
            </div>
            <div class="col">
              <input type="text" class="form-control" name="ruangan_seminar" id="ruanganSeminar" value="{{$data->ruangan}}" placeholder="A-204" aria-describedby="ruanganSeminarHelp" readonly/>
            </div>
            <div class="col-md-2">
              <label for="html5-date-input" class="form-label">Date</label>
            </div>
            <div class="col">
              <input class="form-control" name="date" type="date" value="{{$data->tanggal}}" id="html5-date-input" readonly/>
            </div>
            
            <div class="col-md-2">
              <label for="html5-time-input" class="form-label">Time</label>
            </div>
            <div class="col">
              <input class="form-control" name="time" type="time" value="{{$data->jam}}" id="html5-time-input" readonly />
            </div>
          </div>
          <input type="hidden" name="user_id" value="{{$data->users_id}}" />
          <input type="hidden" name="seminar_proposal_id" value="{{$data->id_seminar_proposal}}" />
         
          <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
            @if(is_null($data)|| is_null($data->cetak))
            <button type="button" class="btn btn-primary" onclick="showConfirmation()">Cetak</button>

            @endif
          </div>
         
      </form>
    </div>
      @endif
    </div>
</div>


@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
function updateSelectOptions() {
  var select1 = document.getElementById("select1");
  var select2 = document.getElementById("select2");

  // Clear existing options in select2
  select2.innerHTML = '<option value="" selected disabled>Open this select menu</option>';

  // Get the selected option from select1
  var selectedOption = select1.options[select1.selectedIndex];

  // Clone the options from select1 to select2, excluding the selected option
  for (var i = 0; i < select1.options.length; i++) {
      if (select1.options[i] !== selectedOption) {
          var option = document.createElement("option");
          option.value = select1.options[i].value;
          option.text = select1.options[i].text;
          select2.add(option);
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
  