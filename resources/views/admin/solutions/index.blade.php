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
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3">
                        <h4 class="mb-0 fw-bold" style="color: #5a6853;">{{ $solution->title }}
                        </h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-danger mb-2">Description :
                                </h6>
                                <div class="bg-light p-3 rounded border h-100" style="min-height: 100px;">
                                    {{ $solution->description }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="fw-bold text-success mb-2">Solution :
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
@endsection
