@extends('layouts.app')

@section('title', 'Edit Pasien')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="bi bi-person-gear"></i> Edit Data Pasien</h4>
            </div>
            <div class="card-body">
                {{-- gunakan id dari route --}}
                <form method="POST" action="{{ route('patients.update', request()->route('patient')) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="rm_number" class="form-label">
                            Nomor Rekam Medis <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="rm_number"
                               id="rm_number"
                               class="form-control @error('rm_number') is-invalid @enderror"
                               value="{{ old('rm_number', $patient['rm_number'] ?? '') }}"
                               required>
                        @error('rm_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">Nama Depan *</label>
                            <input type="text"
                                   name="first_name"
                                   id="first_name"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   value="{{ old('first_name', $patient['first_name'] ?? '') }}"
                                   required>
                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Nama Belakang *</label>
                            <input type="text"
                                   name="last_name"
                                   id="last_name"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   value="{{ old('last_name', $patient['last_name'] ?? '') }}"
                                   required>
                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Jenis Kelamin *</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male"
                                       value="male"
                                       {{ old('gender', $patient['gender'] ?? '') == 'male' ? 'checked' : '' }}>
                                <label class="form-check-label" for="male">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female"
                                       value="female"
                                       {{ old('gender', $patient['gender'] ?? '') == 'female' ? 'checked' : '' }}>
                                <label class="form-check-label" for="female">Perempuan</label>
                            </div>
                        </div>
                        @error('gender')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Update Pasien
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
