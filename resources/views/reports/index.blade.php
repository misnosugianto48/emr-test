@extends('adminlte::page')

@section('title', 'Laporan Kunjungan')

@section('content_header')
    <h1><i class="fas fa-chart-bar mr-2"></i> Laporan Kunjungan Pasien</h1>
@stop

@section('content')
    <!-- Summary Cards -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalVisitsCount }}</h3>
                    <p>Total Kunjungan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hospital-user"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $totalRegistered }}</h3>
                    <p>Menunggu Asesmen</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalAssessed }}</h3>
                    <p>Sudah Diperiksa</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalCancelled }}</h3>
                    <p>Batal / Cancelled</p>
                </div>
                <div class="icon">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="card card-outline card-secondary shadow-sm mb-4">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-filter mr-1"></i> Filter Laporan</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('reports.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="visit_date">Tanggal</label>
                        <input type="date" name="visit_date" id="visit_date" class="form-control" value="{{ request('visit_date') }}">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="patient_name">Nama Pasien</label>
                        <input type="text" name="patient_name" id="patient_name" class="form-control" placeholder="Cari nama pasien..." value="{{ request('patient_name') }}">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="doctor">Dokter</label>
                        <input type="text" name="doctor" id="doctor" class="form-control" placeholder="Cari dokter..." value="{{ request('doctor') }}">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="status">Status Kunjungan</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">-- Semua Status --</option>
                            <option value="registered" {{ request('status') == 'registered' ? 'selected' : '' }}>Terdaftar</option>
                            <option value="assessed" {{ request('status') == 'assessed' ? 'selected' : '' }}>Sudah Asesmen</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <label>&nbsp;</label>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary w-100 mr-1"><i class="fas fa-search"></i> Filter</button>
                            <a href="{{ route('reports.index') }}" class="btn btn-default" title="Reset Filter"><i class="fas fa-sync-alt"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group mb-0">
                        <label for="diagnosis">Diagnosis (Opsional)</label>
                        <input type="text" name="diagnosis" id="diagnosis" class="form-control" placeholder="Cari berdasarkan diagnosis awal..." value="{{ request('diagnosis') }}">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" width="50">No</th>
                            <th>Tanggal</th>
                            <th>Pasien</th>
                            <th>Poli & Dokter</th>
                            <th>Diagnosis Awal</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visits as $index => $visit)
                            <tr>
                                <td class="text-center">{{ $visits->firstItem() + $index }}</td>
                                <td>{{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') }}</td>
                                <td>
                                    <strong>{{ $visit->patient->name }}</strong><br>
                                    <small class="text-muted">Usia: {{ \Carbon\Carbon::parse($visit->patient->birth_date)->age }} thn</small>
                                </td>
                                <td>
                                    <span class="badge badge-info">{{ $visit->clinic }}</span><br>
                                    <small><i class="fas fa-user-md mr-1"></i> {{ $visit->doctor }}</small>
                                </td>
                                <td>
                                    @if($visit->assessment)
                                        {{ Str::limit($visit->assessment->initial_diagnosis, 50) }}
                                    @else
                                        <span class="text-muted italic">- Belum ada diagnosis -</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($visit->status == 'registered')
                                        <span class="badge badge-primary px-2 py-1">Terdaftar</span>
                                    @elseif($visit->status == 'assessed')
                                        <span class="badge badge-success px-2 py-1">Sudah Asesmen</span>
                                    @elseif($visit->status == 'cancelled')
                                        <span class="badge badge-danger px-2 py-1">Batal</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3"></i><br>
                                    Tidak ada data kunjungan yang sesuai kriteria pencarian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            {{ $visits->links('pagination::bootstrap-4') }}
        </div>
    </div>
@stop

@section('css')
<style>
    .table td, .table th { vertical-align: middle; }
    .italic { font-style: italic; }
</style>
@stop
