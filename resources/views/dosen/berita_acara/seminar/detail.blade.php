@extends('layout.master')

@section('title')
Detail Berita Acara Proposal
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Berita Acara</a></li>
      <li class="breadcrumb-item active" aria-current="page">BA Seminar Proposal</li>
    </ol>
</nav>
<div class="row">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card mb-3">
            <h5 class="card-header">Berita Acara Seminar Proposal</h5>
            {{-- <p class="card-header">Dosen penguji dapat mengisi berita acara seminar proposal dibawah ini</p> --}}
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">NPM </label>
                            <p><span>{{ $data->kode_unik }}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">No. Ujian </label>
                            <p><span>{{ $data->id_berita_acara_p }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Nama </label>
                            <p><span>{{ $data->name }}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Tanggal</label>
                            @php
                            $dateFromDatabase = $data->tanggal;
                            $formattedDate = date('d F Y', strtotime($dateFromDatabase));
                            @endphp
                            <p><span>{{ $formattedDate }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Judul </label>
                            <p><span>{{ $data->judul }}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Ruang, Waktu </label>
                            <p><span>{{$data->nama_ruangan}}, {{$data->jam}}</span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Dosen Pembimbing 1 </label>
                            <p><span>{{ $data->dosen_pembimbing_utama }}</span></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Dosen Pembimbing 2 </label>
                            <p><span>{{$data->dosen_pembimbing_ii}}</span></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: bold">Dosen Penguji </label>
                            <p><span>{{$data->nama_penguji_1}}<br/>
                                {{$data->nama_penguji_2}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header">Review Dosen Pembimbing</h5>
            <form action="{{route('berita-acara-proposal.store')}}" method="POST" id="reviewForm">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="revisi" class="form-label">Revisi</label>
                        <textarea class="form-control" id="revisi" name="revisi" rows="3" placeholder="Masukan Revisi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai Ujian</label>
                        <input
                        type="number"
                        class="form-control"
                        name="nilai"
                        max="100"
                        id="nilai"
                        placeholder="Masukan Nilai Ujian..."
                        aria-describedby="defaultFormControlHelp"
                        />
                    </div>
                    <input type="hidden" name="berita_acara_proposal_id" value="{{$data->id_berita_acara_p}}"/>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
