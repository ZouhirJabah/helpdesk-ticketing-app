@extends('layouts.main')

@section('title', 'Créer un Ticket')

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
        <a href="{{ route('tickets.index') }}" class="text-decoration-none text-muted">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-4" style="color: #5a6853;">
                Ouvrir un nouveau ticket
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

            <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="inner-card">
                    <div class="inner-card-header">
                        Détails du problème
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Sujet du problème</label>
                                <input type="text" name="subject" class="form-control" value="{{ old('subject') }}"
                                    required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Priorité </label>
                                <select name="priority" class="form-select" required>
                                    <option value="Low">Basse</option>
                                    <option value="Medium" selected>Moyenne</option>
                                    <option value="High">Haute</option>
                                    <option value="Urgent">Urgente</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Pièce jointe</label>
                                <input type="file" name="attachment" class="form-control">
                                <small class="text-muted">Format accepté : PDF, JPG, PNG (Max 2Mo).</small>
                            </div>

                            <div class="col-12 mb-0">
                                <label class="form-label">Description détaillée</label>
                                <textarea name="description" class="form-control" rows="5" required
                                    placeholder="Décrivez votre problème en détail...">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('tickets.index') }}" class="btn btn-light me-2 border">Annuler</a>
                    <button type="submit" class="btn btn-primary px-4"
                        style="background-color: #5a6853; border-color: #5a6853;">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
