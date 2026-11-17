@extends('layouts.main')

@section('title', 'Ajouter une solution')

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
        <a href="{{ route('admin.solutions.index') }}" class="text-decoration-none text-muted">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4" style="color: #5a6853;"> <i class="bi bi-shield me-2"></i> Enregistrer une
                solution
            </h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.solutions.store') }}" method="POST">
                @csrf
                <div class="inner-card">
                    <div class="inner-card-header">Détails du Solution
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Titre du problème</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description du problème</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Solution</label>
                            <textarea name="solution" class="form-control" rows="5">{{ old('solution') }}</textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.solutions.index') }}" class="btn btn-light me-2 border">Annuler</a>
                            <button type="submit" class="btn btn-primary px-4"
                                style="background-color: #5a6853; border-color: #5a6853;">Enregistrer
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
