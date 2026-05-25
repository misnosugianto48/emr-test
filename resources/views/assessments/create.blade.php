@extends('adminlte::page')

@section('title', 'Isi Asesmen Rawat Jalan')

@section('content_header')
    <h1><i class="fas fa-notes-medical mr-2"></i> Asesmen Medis Pasien</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Informasi Pasien -->
            <div class="card card-info card-outline shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="text-muted mb-1">Nama Pasien</h6>
                            <strong>{{ $visit->patient->name }}</strong>
                        </div>
                        <div class="col-sm-3">
                            <h6 class="text-muted mb-1">Tanggal Lahir (Usia)</h6>
                            <strong>{{ \Carbon\Carbon::parse($visit->patient->birth_date)->format('d M Y') }} ({{ \Carbon\Carbon::parse($visit->patient->birth_date)->age }} thn)</strong>
                        </div>
                        <div class="col-sm-3">
                            <h6 class="text-muted mb-1">Poli & Dokter</h6>
                            <strong>{{ $visit->clinic }} - {{ $visit->doctor }}</strong>
                        </div>
                        <div class="col-sm-3">
                            <h6 class="text-muted mb-1">Tanggal Kunjungan</h6>
                            <strong>{{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Asesmen -->
            <form action="{{ route('assessments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="visit_id" value="{{ $visit->id }}">
                
                <div class="row">
                    <!-- Tanda-Tanda Vital -->
                    <div class="col-md-4">
                        <div class="card card-primary shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-heartbeat mr-1"></i> Tanda-Tanda Vital</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="blood_pressure">Tekanan Darah <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="blood_pressure" id="blood_pressure" class="form-control @error('blood_pressure') is-invalid @enderror" value="{{ old('blood_pressure') }}" placeholder="Contoh: 120/80" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">mmHg</span>
                                        </div>
                                    </div>
                                    @error('blood_pressure')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="temperature">Suhu Tubuh <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" step="0.1" name="temperature" id="temperature" class="form-control @error('temperature') is-invalid @enderror" value="{{ old('temperature') }}" placeholder="Contoh: 36.5" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">&deg;C</span>
                                        </div>
                                    </div>
                                    @error('temperature')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="weight">Berat Badan <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" step="0.1" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight') }}" placeholder="Contoh: 65.5" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                    @error('weight')
                                        <span class="text-danger text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pemeriksaan Medis -->
                    <div class="col-md-8">
                        <div class="card card-primary shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-stethoscope mr-1"></i> Pemeriksaan Medis</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="chief_complaint">Keluhan Utama (Anamnesis) <span class="text-danger">*</span></label>
                                    <textarea name="chief_complaint" id="chief_complaint" rows="3" class="form-control @error('chief_complaint') is-invalid @enderror" placeholder="Tuliskan keluhan utama pasien..." required>{{ old('chief_complaint') }}</textarea>
                                    @error('chief_complaint')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="initial_diagnosis">Diagnosis Awal <span class="text-danger">*</span></label>
                                    <textarea name="initial_diagnosis" id="initial_diagnosis" rows="2" class="form-control @error('initial_diagnosis') is-invalid @enderror" placeholder="Tuliskan diagnosis..." required>{{ old('initial_diagnosis') }}</textarea>
                                    @error('initial_diagnosis')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="therapy">Tindakan / Terapi <span class="text-danger">*</span></label>
                                    <textarea name="therapy" id="therapy" rows="3" class="form-control @error('therapy') is-invalid @enderror" placeholder="Tuliskan resep obat, tindakan, atau terapi lainnya..." required>{{ old('therapy') }}</textarea>
                                    @error('therapy')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="doctor_notes">Catatan Tambahan Dokter (Opsional)</label>
                                    <textarea name="doctor_notes" id="doctor_notes" rows="2" class="form-control @error('doctor_notes') is-invalid @enderror" placeholder="Catatan internal dokter...">{{ old('doctor_notes') }}</textarea>
                                    @error('doctor_notes')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer bg-light text-right">
                                <a href="{{ route('assessments.index') }}" class="btn btn-default btn-lg mr-2">Batal</a>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save mr-1"></i> Simpan Asesmen
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
