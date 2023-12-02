@extends('layouts/template')

@section('title')
Bimbingan Skripsi
@endsection

<link rel="stylesheet" href="{{ asset('/css/custom.css') }}" />

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card mb-4">
        <h5 class="card-header">Review Bimbingan Skripsi</h5>
        <div class="card-body">
            <p class="revisi-rumusan-masa">
                <span class="span0-1">Revisi:<br/></span>
                <span class="span1-1">Rumusan masalah dan tujuan penelitian harus searah. <br/>Perbaiki alur tahapan penelitian (perlu diberikan informasi mengenai populasi dan sampel). <br/>
                    Kurangi penggunaan kata "setelah itu".</span>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4 mb-xl-0">
                <h5 class="card-header">File Skripsi</h5>
                <div class="card-body">
                    <form action="javascript:void(0)" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file_skripsi" class="form-label">Upload File Skripsi</label>
                            <input class="form-control" type="file" id="file_skripsi" name="file_skripsi"  />
                        </div>
                        <input type="hidden" id="bimbingan_skripsi_id" name="bimbingan_skripsi_id" value="{{ $dosens->id_bimbingan_skripsi }}" />
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <h5 class="card-header">Persetujuan Sidang</h5>
                <div class="card-body">

                        <div class="mb-3">
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="manajemen_kualitas" name="mk_pilihan[]" id="defaultCheck5"
                                {{-- {{ $persetujuanDosen1 ? 'checked' : '' }} {{ $persetujuanDosen1 ? 'disabled' : '' }}  --}}
                                />
                                <label class="form-check-label" for="defaultCheck5"> Dosen Pembimbing 1 </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="model_simulasi" name="mk_pilihan[]" id="defaultCheck6"
                                {{-- {{ $persetujuanDosen2 ? 'checked' : '' }} {{ $persetujuanDosen2 ? 'disabled' : '' }}  --}}
                                />
                                <label class="form-check-label" for="defaultCheck6"> Dosen Pembimbing 2 </label>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary"
                                {{-- {{ ($persetujuanDosen1 && $persetujuanDosen2) ? '' : 'disabled' }} --}}
                                >Daftar</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <a href="{{ route('his-bim-mhs.index') }}" class="btn btn-primary">History Bimbingan</a>

    </div>
    {{-- @endif --}}
</div>


@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- ... Bagian HTML lainnya ... -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Pastikan elemen sudah dimuat di dalam DOM
    document.addEventListener('DOMContentLoaded', function() {
        const submitBtn = document.getElementById('submitBtn');

        if (submitBtn) {
            submitBtn.addEventListener('click', function(event) {
                event.preventDefault();

                const file = document.getElementById('file_skripsi').files[0];
                const bimbinganSkripsiId = document.getElementById('bimbingan_skripsi_id').value;

                if (file && bimbinganSkripsiId) {
                    const formData = new FormData();
                    formData.append('file_skripsi', file);
                    formData.append('bimbingan_skripsi_id', bimbinganSkripsiId);
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route('bimbingans-mhs.store') }}', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'File Skripsi Successfully Submitted!',
                                text: data.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: data.message
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while submitting the file.'
                        });
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Please select a file.'
                    });
                }
            });
        } else {
            console.error('Element with ID "submitBtn" not found.');
        }
    });
</script>