@extends('adminlte::page')

@section('title', 'Pendaftaran Kunjungan')

@section('content_header')
    <h1><i class="fas fa-stethoscope mr-2"></i> Pendaftaran Kunjungan Pasien</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card card-success card-outline shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Form Kunjungan Rawat Jalan</h3>
                </div>
                <form action="{{ route('visits.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        
                        <div class="form-group mb-4">
                            <label for="patient_id">Pilih Pasien <span class="text-danger">*</span></label>
                            <select name="patient_id" id="patient_id" class="form-control form-control-lg @error('patient_id') is-invalid @enderror" required>
                                <option value="">-- Cari atau Pilih Pasien --</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ (old('patient_id', $selectedPatientId) == $patient->id) ? 'selected' : '' }}>
                                        {{ $patient->name }} - {{ \Carbon\Carbon::parse($patient->birth_date)->format('d/m/Y') }} 
                                        @if($patient->phone_number) ({{ $patient->phone_number }}) @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted mt-2">
                                Pasien tidak ditemukan? <a href="{{ route('patients.create') }}">Daftarkan Pasien Baru</a>
                            </small>
                        </div>

                        <hr>

                        <div class="row mt-4">
                            <div class="col-md-6 form-group mb-3">
                                <label for="visit_date">Tanggal Kunjungan <span class="text-danger">*</span></label>
                                <input type="date" name="visit_date" id="visit_date" class="form-control @error('visit_date') is-invalid @enderror" value="{{ old('visit_date', date('Y-m-d')) }}" required>
                                @error('visit_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="clinic">Poli Tujuan <span class="text-danger">*</span></label>
                                <select name="clinic" id="clinic" class="form-control @error('clinic') is-invalid @enderror" required>
                                    <option value="">-- Pilih Poli --</option>
                                    <option value="Poli Umum" {{ old('clinic') == 'Poli Umum' ? 'selected' : '' }}>Poli Umum</option>
                                    <option value="Poli Gigi" {{ old('clinic') == 'Poli Gigi' ? 'selected' : '' }}>Poli Gigi</option>
                                    <option value="Poli Penyakit Dalam" {{ old('clinic') == 'Poli Penyakit Dalam' ? 'selected' : '' }}>Poli Penyakit Dalam</option>
                                    <option value="Poli Anak" {{ old('clinic') == 'Poli Anak' ? 'selected' : '' }}>Poli Anak</option>
                                </select>
                                @error('clinic')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="doctor">Dokter <span class="text-danger">*</span></label>
                                <select name="doctor" id="doctor" class="form-control @error('doctor') is-invalid @enderror" required>
                                    <option value="">-- Pilih Dokter --</option>
                                    <option value="dr. Andi, Sp.PD" {{ old('doctor') == 'dr. Andi, Sp.PD' ? 'selected' : '' }}>dr. Andi, Sp.PD</option>
                                    <option value="drg. Budi" {{ old('doctor') == 'drg. Budi' ? 'selected' : '' }}>drg. Budi</option>
                                    <option value="dr. Caca, Sp.A" {{ old('doctor') == 'dr. Caca, Sp.A' ? 'selected' : '' }}>dr. Caca, Sp.A</option>
                                    <option value="dr. Doni" {{ old('doctor') == 'dr. Doni' ? 'selected' : '' }}>dr. Doni (Umum)</option>
                                </select>
                                @error('doctor')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="payment_type">Jenis Pembayaran <span class="text-danger">*</span></label>
                                <select name="payment_type" id="payment_type" class="form-control @error('payment_type') is-invalid @enderror" required>
                                    <option value="">-- Pilih Pembayaran --</option>
                                    <option value="Umum / Pribadi" {{ old('payment_type') == 'Umum / Pribadi' ? 'selected' : '' }}>Umum / Pribadi</option>
                                    <option value="BPJS Kesehatan" {{ old('payment_type') == 'BPJS Kesehatan' ? 'selected' : '' }}>BPJS Kesehatan</option>
                                    <option value="Asuransi Lainnya" {{ old('payment_type') == 'Asuransi Lainnya' ? 'selected' : '' }}>Asuransi Lainnya</option>
                                </select>
                                @error('payment_type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="card-footer bg-white">
                        <button type="submit" class="btn btn-success btn-lg px-4">
                            <i class="fas fa-check-circle mr-1"></i> Daftarkan Kunjungan
                        </button>
                        <a href="{{ route('patients.index') }}" class="btn btn-default btn-lg ml-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#patient_id').select2({
                theme: 'bootstrap4',
                placeholder: "-- Cari atau Pilih Pasien --",
                allowClear: true
            });
        });
    </script>
@stop
