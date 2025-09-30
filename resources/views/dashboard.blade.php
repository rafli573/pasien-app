@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h3 class="mb-3">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </h3>
                <p class="text-muted">
                    Selamat datang, <strong>{{ Auth::user()->name }}</strong> <br>
                    Anda sedang berada di <b>Sistem Pasien</b>.
                </p>

                <hr>

                <div class="row text-center">
                    <div class="col-md-4 mb-3">
                        <div class="card bg-primary text-white shadow-sm h-100">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <i class="bi bi-people display-5"></i>
                                <h5 class="mt-2">Data Pasien</h5>
                                <a href="{{ route('patients.index') }}" class="btn btn-light btn-sm mt-2">
                                    Lihat Data
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card bg-success text-white shadow-sm h-100">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <i class="bi bi-plus-circle display-5"></i>
                                <h5 class="mt-2">Tambah Pasien</h5>
                                <a href="{{ route('patients.create') }}" class="btn btn-light btn-sm mt-2">
                                    Tambah Baru
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card bg-secondary text-white shadow-sm h-100">
                            <div class="card-body d-flex flex-column justify-content-center">
                                <i class="bi bi-person-circle display-5"></i>
                                <h5 class="mt-2">Profil</h5>
                                <a href="{{ route('profile.edit') }}" class="btn btn-light btn-sm mt-2">
                                    Kelola Profil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
