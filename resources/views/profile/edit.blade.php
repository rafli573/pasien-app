@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center mb-3 mb-md-0">
                            <div class="position-relative d-inline-block">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-4" style="width: 120px; height: 120px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-person-fill text-primary" style="font-size: 4rem;"></i>
                                </div>
                                <span class="position-absolute bottom-0 end-0 p-2 bg-success border border-white rounded-circle" 
                                      style="width: 20px; height: 20px;" title="Online"></span>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h2 class="fw-bold mb-2">{{ Auth::user()->name }}</h2>
                            <p class="text-muted mb-2">
                                <i class="bi bi-envelope-fill me-2"></i>{{ Auth::user()->email }}
                            </p>
                            <p class="text-muted mb-3">
                                <i class="bi bi-calendar-check me-2"></i>Bergabung sejak {{ Auth::user()->created_at->format('d F Y') }}
                            </p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="bi bi-pencil-square me-2"></i>Edit Profil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-person-badge-fill text-primary"></i> Informasi Pribadi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3 pb-3 border-bottom">
                        <label class="text-muted small mb-1">Nama Lengkap</label>
                        <p class="mb-0 fw-semibold">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <label class="text-muted small mb-1">Email</label>
                        <p class="mb-0 fw-semibold">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <label class="text-muted small mb-1">Status Akun</label>
                        <p class="mb-0">
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle-fill"></i> Aktif
                            </span>
                        </p>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <label class="text-muted small mb-1">Tanggal Bergabung</label>
                        <p class="mb-0 fw-semibold">{{ Auth::user()->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <label class="text-muted small mb-1">Terakhir Update</label>
                        <p class="mb-0 fw-semibold">{{ Auth::user()->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-shield-lock-fill text-success"></i> Keamanan Akun
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3 pb-3 border-bottom">
                        <label class="text-muted small mb-1">Password</label>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-0 fw-semibold">••••••••</p>
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                <i class="bi bi-key-fill"></i> Ubah
                            </button>
                        </div>
                    </div>
                    <div class="mb-3 pb-3 border-bottom">
                        <label class="text-muted small mb-1">Verifikasi Email</label>
                        <p class="mb-0">
                            @if(Auth::user()->email_verified_at)
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle-fill"></i> Terverifikasi
                                </span>
                            @else
                                <span class="badge bg-warning">
                                    <i class="bi bi-exclamation-triangle-fill"></i> Belum Terverifikasi
                                </span>
                            @endif
                        </p>
                    </div>
                    <div class="alert alert-info mb-0">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        <strong>Tips Keamanan:</strong>
                        <ul class="mb-0 mt-2 small">
                            <li>Gunakan password yang kuat dan unik</li>
                            <li>Jangan bagikan password Anda</li>
                            <li>Ubah password secara berkala</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-activity text-warning"></i> Aktivitas Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-box-arrow-in-right text-primary"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-1 fw-semibold">Login ke sistem</p>
                                <small class="text-muted">{{ now()->format('d F Y, H:i') }}</small>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-person-check text-success"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-1 fw-semibold">Profil diperbarui</p>
                                <small class="text-muted">{{ Auth::user()->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="bg-info bg-opacity-10 rounded-circle p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-person-plus text-info"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-1 fw-semibold">Akun dibuat</p>
                                <small class="text-muted">{{ Auth::user()->created_at->format('d F Y, H:i') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">
                        <i class="bi bi-pencil-square"></i> Edit Profil
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">
                        <i class="bi bi-key-fill"></i> Ubah Password
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                               id="current_password" name="current_password" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" 
                               id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection