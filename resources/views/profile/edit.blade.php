@extends('layouts.main')

@section('title', 'Mes Paramètres')

@section('content')
    <style>
        .form-label {
            color: #5a6853;
            font-weight: 600;
        }

        .form-control:focus {
            border-color: #5a6853 !important;
            box-shadow: 0 0 0 0.25rem rgba(90, 104, 83, 0.25) !important;
        }

        .inner-card {
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid rgba(90, 104, 83, 0.1);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .inner-card-header {
            background-color: rgba(90, 104, 83, 0.05);
            color: #5a6853;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(90, 104, 83, 0.1);
        }
    </style>

    <div class="mb-4">
        <a href="@if (Auth::user()->role === 'admin') {{ route('admin.dashboard') }} @else {{ route('dashboard') }} @endif"
            class="text-decoration-none text-muted">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-x-circle-fill me-2"></i> {{ $errors->first() }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="inner-card">
                    <div class="inner-card-header">
                        <i class="bi bi-person-vcard me-2"></i> Informations Personnelles
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prénom</label>
                                <input type="text" name="first_name" class="form-control"
                                    value="{{ old('first_name', $user->first_name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom</label>
                                <input type="text" name="last_name" class="form-control"
                                    value="{{ old('last_name', $user->last_name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Téléphone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $user->phone) }}">
                            </div>
                            <div class="col-12 mb-0">
                                <label class="form-label">Adresse</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ old('address', $user->address) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="inner-card">
                    <div class="inner-card-header">
                        <i class="bi bi-shield-lock me-2"></i> Sécurité
                    </div>
                    <div class="card-body p-4">
                        <p class="text-danger small mb-3">
                            <i class="bi bi-info-circle me-1"></i> Laissez ces champs vides si vous ne souhaitez pas changer
                            votre mot de passe.
                        </p>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Mot de passe actuel</label>
                                <input type="password" name="current_password" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nouveau mot de passe</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="col-md-6 mb-0">
                                <label class="form-label">Confirmer le nouveau mot de passe</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="@if (Auth::user()->role === 'admin') {{ route('admin.dashboard') }} @else {{ route('dashboard') }} @endif"
                        class="btn btn-light me-2 border">Annuler</a>
                    <button type="submit" class="btn btn-primary px-4"
                        style="background-color: #5a6853; border-color: #5a6853;">
                        <i class="bi bi-check-lg me-1"></i> Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
