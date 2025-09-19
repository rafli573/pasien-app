@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people"></i> Data Pasien</h2>
    <a href="{{ route('patients.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Pasien
    </a>
</div>

{{-- Form Pencarian --}}
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('patients.index') }}">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" name="search" class="form-control"
                           placeholder="Cari nama atau nomor RM..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Debug Info --}}
@if(config('app.debug'))
<div class="alert alert-info">
    <strong>Debug:</strong> 
    Patients type: {{ gettype($patients) }} | 
    @if(is_array($patients))
        Keys: {{ implode(', ', array_keys($patients)) }}
    @endif
</div>
@endif

{{-- Tabel Pasien --}}
<div class="card">
    <div class="card-body">
        @php
            // Flexible data handling
            $patientsData = [];
            if (is_array($patients)) {
                if (isset($patients['data']) && is_array($patients['data'])) {
                    $patientsData = $patients['data'];
                } else {
                    $patientsData = $patients;
                }
            }
        @endphp

        @if(count($patientsData) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nomor RM</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patientsData as $i => $patient)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $patient['rm_number'] ?? '-' }}</span>
                            </td>
                            <td>{{ ($patient['first_name'] ?? '') }} {{ ($patient['last_name'] ?? '') }}</td>
                            <td>
                                @if(($patient['gender'] ?? '') === 'male')
                                    <span class="badge bg-info"><i class="bi bi-person"></i> Laki-laki</span>
                                @elseif(($patient['gender'] ?? '') === 'female')
                                    <span class="badge bg-warning"><i class="bi bi-person-dress"></i> Perempuan</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                @if(isset($patient['id']))
                                <div class="btn-group" role="group">
                                    <a href="{{ route('patients.edit', $patient['id']) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('patients.destroy', $patient['id']) }}"
                                          style="display:inline"
                                          onsubmit="return confirm('Yakin ingin menghapus pasien ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                                @else
                                    <span class="text-muted">No ID</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Info jumlah data --}}
            <div class="mt-3">
                <small class="text-muted">
                    Menampilkan {{ count($patientsData) }} data pasien
                </small>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox display-1 text-muted"></i>
                <h5 class="mt-3 text-muted">Tidak ada data pasien</h5>
                <p class="text-muted">
                    @if(request('search'))
                        Tidak ditemukan hasil untuk "{{ request('search') }}"
                    @else
                        Silakan tambah pasien baru untuk mulai mengelola data.
                    @endif
                </p>
                <div>
                    @if(request('search'))
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary me-2">
                            <i class="bi bi-arrow-left"></i> Lihat Semua Data
                        </a>
                    @endif
                    <a href="{{ route('patients.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Pasien
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Raw data untuk debugging --}}
@if(config('app.debug'))
<div class="mt-4">
    <div class="card">
        <div class="card-header">
            <small>Debug: Raw API Response</small>
        </div>
        <div class="card-body">
            <pre style="max-height: 300px; overflow-y: auto;">{{ print_r($patients, true) }}</pre>
        </div>
    </div>
</div>
@endif
@endsection