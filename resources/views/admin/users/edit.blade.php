@extends('layouts.main')

@section('title', 'Modifier l\'Employé')

@section('content')
    <style>
        .form-label {
            color: #5a6853;
            font-weight: 600;
        }

        .form-control:focus,
        .form-select:focus {
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
        <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-muted">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="inner-card">
                    <div class="inner-card-header">
                        <i class="bi bi-person-vcard me-2"></i> 1. Informations Personnelles
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom</label>
                                <input type="text" name="last_name" class="form-control"
                                    value="{{ old('last_name', $user->last_name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prénom</label>
                                <input type="text" name="first_name" class="form-control"
                                    value="{{ old('first_name', $user->first_name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Genre</label>
                                <select name="gender" class="form-select" required>
                                    <option value="">-- Choisir Genre</option>
                                    <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>
                                        Homme</option>
                                    <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>
                                        Femme</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Téléphone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $user->phone) }}">
                            </div>
                            <div class="col-12 mb-0">
                                <label class="form-label">Adresse (Optionnel)</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ old('address', $user->address) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="inner-card">
                    <div class="inner-card-header">
                        <i class="bi bi-briefcase me-2"></i> 2. Informations Professionnelles
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email professionnel</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Département</label>
                                <select name="department_id" class="form-select" required>
                                    <option value="">-- Choisir un département</option>
                                    @foreach ($departments as $dept)
                                        <option value="{{ $dept->id }}"
                                            {{ old('department_id', $user->department_id) == $dept->id ? 'selected' : '' }}>
                                            {{ $dept->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-0">
                                <label class="form-label">Nouveau mot de passe (Optionnel)</label>
                                <input type="password" name="password" class="form-control">
                                <small class="text-muted">Laisser vide pour conserver l'ancien mot de passe.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-light me-2 border">Annuler</a>
                    <button type="submit" class="btn btn-primary px-4"
                        style="background-color: #5a6853; border-color: #5a6853;">
                        <i class="bi bi-check-lg me-1"></i> Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
