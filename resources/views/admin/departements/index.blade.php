@extends('layouts.main')

@section('title', 'Gestion des Départements')

@section('content')
    <style>
        .card-transparent {
            background-color: transparent !important;
            box-shadow: none !important;
        }

        .table-custom {
            background-color: transparent !important;
            --bs-table-bg: transparent !important;
        }

        .table-custom thead th {
            background-color: rgba(90, 104, 83, 0.1) !important;
            color: #5a6853;
            border-bottom: 2px solid #5a6853;
        }

        .table-custom tbody tr {
            background-color: transparent !important;
        }

        .table-custom tbody tr:hover {
            background-color: rgba(90, 104, 83, 0.15) !important;
            transition: all 0.2s ease;
        }

        .table-custom td {
            border-color: rgba(0, 0, 0, 0.05) !important;
        }

        .form-control:focus {
            border-color: #5a6853 !important;
            box-shadow: rgba(90, 104, 83, 0.25) !important;
        }

        .input-group:focus-within .input-group-text {
            border-color: #5a6853 !important;
            background-color: transparent !important;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold">
            <i class="bi bi-building me-2"></i></i> Liste ({{ $departements->count() }})
        </h5>
        <form action="{{ route('admin.departements.index') }}" method="GET" class="d-flex justify-content-center mx-4 w-50">
            <div class="input-group shadow-sm rounded-pill"
                style="background-color: rgba(255, 255, 255, 0.5); border: 1px solid rgba(90, 104, 83, 0.2); overflow: hidden;">

                <span class="input-group-text bg-transparent border-0 ps-3 pe-2">
                    <i class="bi bi-search text-secondary"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="form-control border-0 bg-transparent shadow-none" placeholder="Rechercher par nom..."
                    style="font-size: 0.95rem;">
                <button type="submit" class="btn border-0 px-3" style="background-color: #5a6853; color: white;">
                    <i class="bi bi-funnel-fill"></i>
                </button>
            </div>
        </form>
        <a href="{{ route('admin.departements.create') }}" class="btn btn-primary"
            style="background-color: #5a6853; border-color: #5a6853;">Ajouter
            Département
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('danger'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('primary'))
        <div class="alert alert-primary alert-dismissible fade show shadow-sm" role="alert">
            {{ session('primary') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-x-circle-fill me-2"></i> {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card-transparent">
        <div class="card-body p-0">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr class="text-center">
                        <th class="ps-3">nom</th>
                        <th>description</th>
                        <th>Employés</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departements as $dep)
                        <tr>
                            <td class="ps-3">
                                {{ $dep->name }}
                            </td>
                            <td>{{ $dep->description }}</td>
                            <td class="text-center">
                                <span class="badge rounded-pill" style="background-color: #5a6853; font-size: 0.9rem;">
                                    <i class="bi bi-people-fill me-1"></i> {{ $dep->users_count }}
                                </span>
                            </td>
                            <td class="text-center pe-3">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.departements.edit', $dep->id) }}" class="btn btn-sm"
                                        title="Modifier">
                                        <i class="bi bi-pencil text-secondary"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm" title="Supprimer" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-dep-id="{{ $dep->id }}"
                                        data-dep-name="{{ $dep->name }}">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Aucun Département trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 bg-light py-2">
                    <h6 class="modal-title fw-bold text-danger mb-0" id="deleteModalLabel">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Supprimer ?
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="font-size: 0.8rem;"></button>
                </div>
                <div class="modal-body text-center py-3">
                    <p class="mb-1">Voulez-vous vraiment supprimer <br><strong id="depName"></strong> ?</p>
                    <small class="text-muted">Cette action est irréversible.</small>
                </div>
                <div class="modal-footer border-0 justify-content-center py-2">
                    <form id="deleteForm" action="" method="POST" class="d-inline m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;

                var depId = button.getAttribute('data-dep-id');
                var depName = button.getAttribute('data-dep-name');

                var modalBodyName = deleteModal.querySelector('#depName');
                modalBodyName.textContent = depName;

                var form = deleteModal.querySelector('#deleteForm');
                form.action = '/admin/departements/' + depId;
            });
        });
    </script>
@endsection
