@extends('adminlte::page')

@section('title', 'Data Pasien')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-user-injured mr-2"></i> Data Pasien</h1>
        <a href="{{ route('patients.create') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-plus-circle mr-1"></i> Pasien Baru
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Daftar Pasien Terdaftar</h3>
            <div class="card-tools">
                <form action="{{ route('patients.index') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" name="search" class="form-control float-right" placeholder="Cari Nama / No HP..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" width="50">No</th>
                            <th>Nama Pasien</th>
                            <th>No. RM / Tgl Lahir</th>
                            <th>Gender</th>
                            <th>Kontak & Alamat</th>
                            <th class="text-center" width="250">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $index => $patient)
                            <tr>
                                <td class="text-center">{{ $patients->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $patient->name }}</strong>
                                </td>
                                <td>
                                    <span class="text-muted"><i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($patient->birth_date)->format('d M Y') }}</span><br>
                                    <small>{{ \Carbon\Carbon::parse($patient->birth_date)->age }} thn</small>
                                </td>
                                <td>
                                    @if($patient->gender == 'male')
                                        <span class="badge badge-info"><i class="fas fa-mars mr-1"></i> Laki-laki</span>
                                    @else
                                        <span class="badge badge-danger"><i class="fas fa-venus mr-1"></i> Perempuan</span>
                                    @endif
                                </td>
                                <td>
                                    <div><i class="fas fa-phone-alt text-muted mr-1"></i> {{ $patient->phone_number ?? '-' }}</div>
                                    <div class="small text-muted"><i class="fas fa-map-marker-alt mr-1"></i> {{ Str::limit($patient->address, 30) }}</div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('visits.create', ['patient_id' => $patient->id]) }}" class="btn btn-sm btn-success mb-1" title="Daftar Kunjungan">
                                        <i class="fas fa-stethoscope"></i> Kunjungan
                                    </a>
                                    <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-sm btn-warning mb-1" title="Edit Data">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i><br>
                                    Tidak ada data pasien yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            {{ $patients->links('pagination::bootstrap-4') }}
        </div>
    </div>
@stop

@section('css')
<style>
    .table td, .table th { vertical-align: middle; }
</style>
@stop
