@extends('layouts.main')

@section('title', 'Modifier une solution')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.solutions.index') }}" class="text-decoration-none text-muted">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4" style="color: #5a6853;">Modifier la solution
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

            <form action="{{ route('admin.solutions.update', $solution->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Titre</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $solution->title) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Description du problème</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $solution->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Solution</label>
                    <textarea name="solution" class="form-control" rows="5">{{ old('solution', $solution->solution) }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.solutions.index') }}" class="btn btn-light me-2 border">Annuler</a>
                    <button type="submit" class="btn btn-primary px-4"
                        style="background-color: #5a6853; border-color: #5a6853;">Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
