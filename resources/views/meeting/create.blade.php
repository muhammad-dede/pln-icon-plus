@extends('layouts.main')

@section('title', 'Pemesanan Meeting')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-10">
                    <form id="form_submit" action="{{ route('meeting.store') }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="card">
                            <div class="card-status-top bg-primary"></div>
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="card-title mb-1">
                                            Pemesanan Meeting
                                        </h3>
                                        <div class="text-muted">
                                            Input dengan tanda <strong class="text-danger">*</strong> wajib diisi!
                                        </div>
                                    </div>
                                </div>
                                <div class="card-actions">
                                    <a class="btn-link text-warning mx-2" href="{{ route('meeting.index') }}">
                                        Kembali
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3 row">
                                    <div class="form-label col-md-3 col-12 col-form-label required">
                                        Unit
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="text" name="unit"
                                            class="form-control @error('unit') is-invalid @enderror"
                                            value="{{ old('unit') }}" />
                                        @error('unit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="form-label col-md-3 col-12 col-form-label required">
                                        Ruang Meeting
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <select name="id_ruang_meeting"
                                            class="form-select @error('id_ruang_meeting') is-invalid @enderror">
                                            <option selected disabled></option>
                                            @foreach (ruangMeeting() as $item)
                                                <option value="{{ $item->id }}" @selected(old('id_ruang_meeting') == $item->id)>
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_ruang_meeting')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="form-label col-md-3 col-12 col-form-label required">
                                        Tanggal Meeting
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="date" name="tanggal_meeting"
                                            class="form-control @error('tanggal_meeting') is-invalid @enderror"
                                            value="{{ old('tanggal_meeting') }}" />
                                        @error('tanggal_meeting')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="form-label col-md-3 col-12 col-form-label required">
                                        Waktu Meeting
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <select name="id_waktu_meeting"
                                            class="form-select @error('id_waktu_meeting') is-invalid @enderror">
                                            <option selected disabled></option>
                                            @foreach (waktuMeeting() as $item)
                                                <option value="{{ $item->id }}" @selected(old('id_waktu_meeting') == $item->id)>
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_waktu_meeting')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3 row">
                                    <div class="form-label col-md-3 col-12 col-form-label required">
                                        Jumlah Peserta
                                    </div>
                                    <div class="col-md-9 col-12">
                                        <input type="number" name="jumlah_peserta"
                                            class="form-control @error('jumlah_peserta') is-invalid @enderror"
                                            value="{{ old('jumlah_peserta') }}" />
                                        @error('jumlah_peserta')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary ms-auto">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
