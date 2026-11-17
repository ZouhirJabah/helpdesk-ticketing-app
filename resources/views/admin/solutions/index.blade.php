@extends('layouts.main')

@section('title', 'Solutions')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold">
            <i class="bi bi-folder text-secondary me-2"></i> Liste ({{ $solutions->count() }})
        </h5>
        <form action="{{ route('admin.solutions.index') }}" method="GET" class="d-flex justify-content-center mx-4 w-50">
            <div class="input-group shadow-sm rounded-pill"
                style="background-color: rgba(255, 255, 255, 0.5); border: 1px solid rgba(90, 104, 83, 0.2); overflow: hidden;">

                <span class="input-group-text bg-transparent border-0 ps-3 pe-2">
                    <i class="bi bi-search text-secondary"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="form-control border-0 bg-transparent shadow-none" placeholder="Rechercher par titre"
                    style="font-size: 0.95rem;">

                <button type="submit" class="btn border-0 px-3" style="background-color: #5a6853; color: white;">
                    <i class="bi bi-funnel-fill"></i>
                </button>
            </div>
        </form>
        <a href="{{ route('admin.solutions.create') }}" class="btn btn-primary"
            style="background-color: #5a6853; border-color: #5a6853;">Ajouter Solution
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-12">
            @forelse ($solutions as $solution)
                <div class="card border-0 shadow-sm mb-4">
                    <div
                        class="card-header bg-white border-bottom-0 pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold" style="color: red;">
                            <i class="bi bi-exclamation-octagon-fill me-2"></i>{{ $solution->title }}
                        </h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.solutions.edit', $solution->id) }}"
                                class="btn btn-sm btn-outline-warning" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger" title="Supprimer"
                                data-bs-toggle="modal" data-bs-target="#deleteModal" data-sol-id="{{ $solution->id }}"
                                data-sol-title="{{ $solution->title }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-secondary mb-2"><i class="bi bi-body-text"></i> Description :
                                </h6>
                                <div class="bg-light p-3 rounded border h-100" style="min-height: 100px;">
                                    {{ $solution->description }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-success mb-2"><i class="bi bi-check-circle-fill"></i> Solution :
                                </h6>
                                <div class="bg-light p-3 rounded border h-100" style="min-height: 100px;">
                                    {{ $solution->solution }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-5">
                    <i class="bi bi-folder-x fs-1 d-block mb-3"></i>
                    Aucune solution enregistrée pour le moment.
                </div>
            @endforelse
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
                    <p class="mb-1">Voulez-vous vraiment supprimer <br><strong id="solTitle"></strong> ?</p>
                    <small class="text-muted">Cette action est irréversible.</small>
                </div>
                <div class="modal-footer border-0 justify-content-center py-2">
                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Annuler</button>
                    <form id="deleteForm" action="" method="POST" class="d-inline m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash me-1"></i> Supprimer
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
                var solId = button.getAttribute('data-sol-id');
                var solTitle = button.getAttribute('data-sol-title');

                deleteModal.querySelector('#solTitle').textContent = solTitle;
                deleteModal.querySelector('#deleteForm').action = '/admin/solutions/' + solId;
            });
        });
    </script>
@endsection
