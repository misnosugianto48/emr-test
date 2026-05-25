@extends('adminlte::page')

@section('title', 'Pendaftaran Pasien Baru')

@section('content_header')
    <h1><i class="fas fa-user-plus mr-2"></i> Pendaftaran Pasien Baru</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card card-primary card-outline shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Form Data Pasien</h3>
                </div>
                <form action="{{ route('patients.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama lengkap pasien" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="birth_date">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}" required>
                                @error('birth_date')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone_number">No. HP / WhatsApp</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" name="phone_number" id="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" placeholder="Contoh: 08123456789">
                            </div>
                            @error('phone_number')
                                <span class="invalid-feedback text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Alamat Lengkap</label>
                            <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                            @error('address')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <button type="submit" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-save mr-1"></i> Simpan Data Pasien
                        </button>
                        <a href="{{ route('patients.index') }}" class="btn btn-default btn-lg ml-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
