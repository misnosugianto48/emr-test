@extends('adminlte::page')

@section('title', 'Antrean & Riwayat Asesmen')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-clipboard-list mr-2"></i> Antrean & Riwayat Asesmen</h1>
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
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Daftar Kunjungan Pasien</h3>
            <div class="card-tools">
                <form action="{{ route('assessments.index') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" name="search" class="form-control float-right" placeholder="Cari Nama Pasien..." value="{{ request('search') }}">
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
                            <th>Tanggal Kunjungan</th>
                            <th>Nama Pasien</th>
                            <th>Poli & Dokter</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visits as $index => $visit)
                            <tr>
                                <td class="text-center">{{ $visits->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') }}</strong>
                                </td>
                                <td>
                                    <strong>{{ $visit->patient->name }}</strong><br>
                                    <small class="text-muted">{{ $visit->patient->phone_number }}</small>
                                </td>
                                <td>
                                    <span class="badge badge-info">{{ $visit->clinic }}</span><br>
                                    <small><i class="fas fa-user-md mr-1"></i> {{ $visit->doctor }}</small>
                                </td>
                                <td class="text-center">
                                    @if($visit->status == 'registered')
                                        <span class="badge badge-primary px-2 py-1"><i class="fas fa-clock mr-1"></i> Terdaftar</span>
                                    @elseif($visit->status == 'assessed')
                                        <span class="badge badge-success px-2 py-1"><i class="fas fa-check mr-1"></i> Sudah Asesmen</span>
                                    @elseif($visit->status == 'cancelled')
                                        <span class="badge badge-danger px-2 py-1"><i class="fas fa-times mr-1"></i> Batal</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($visit->status == 'registered')
                                        <a href="{{ route('assessments.create', $visit->id) }}" class="btn btn-sm btn-primary" title="Isi Asesmen">
                                            <i class="fas fa-stethoscope"></i> Isi Asesmen
                                        </a>
                                        
                                        <!-- Form Batal Kunjungan -->
                                        <form action="{{ route('visits.cancel', $visit->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan kunjungan ini?');">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Batal Kunjungan">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>

                                    @elseif($visit->status == 'assessed' && $visit->assessment)
                                        <a href="{{ route('assessments.edit', $visit->assessment->id) }}" class="btn btn-sm btn-warning" title="Edit Asesmen">
                                            <i class="fas fa-edit"></i> Edit Asesmen
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i><br>
                                    Tidak ada data kunjungan yang ditemukan.
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
</style>
@stop
