@extends('layouts.app')

@section('title', 'Tambah Pasien')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="bi bi-person-plus"></i> Tambah Pasien Baru</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('patients.store') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="rm_number" class="form-label">
                            <i class="bi bi-card-heading"></i> Nomor Rekam Medis <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('rm_number') is-invalid @enderror" 
                               id="rm_number" 
                               name="rm_number" 
                               value="{{ old('rm_number') }}"
                               placeholder="Masukkan nomor RM"
                               required>
                        @error('rm_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">
                                    <i class="bi bi-person"></i> Nama Depan <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('first_name') is-invalid @enderror" 
                                       id="first_name" 
                                       name="first_name" 
                                       value="{{ old('first_name') }}"
                                       placeholder="Nama depan"
                                       required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">
                                    <i class="bi bi-person"></i> Nama Belakang <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('last_name') is-invalid @enderror" 
                                       id="last_name" 
                                       name="last_name" 
                                       value="{{ old('last_name') }}"
                                       placeholder="Nama belakang"
                                       required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-gender-ambiguous"></i> Jenis Kelamin <span class="text-danger">*</span>
                        </label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" 
                                           type="radio" 
                                           name="gender" 
                                           id="male" 
                                           value="male"
                                           {{ old('gender') == 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">
                                        <i class="bi bi-person"></i> Laki-laki
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" 
                                           type="radio" 
                                           name="gender" 
                                           id="female" 
                                           value="female"
                                           {{ old('gender') == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">
                                        <i class="bi bi-person-dress"></i> Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('gender')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Pasien
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection