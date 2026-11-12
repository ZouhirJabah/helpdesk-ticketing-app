@extends('layouts.main')

@section('title', 'Gestion des Tickets')

@section('content')
    <style>
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
            background-color: rgba(90, 104, 83, 0.05) !important;
            transition: all 0.2s ease;
        }

        .table-custom td {
            border-color: rgba(0, 0, 0, 0.05) !important;
            background-color: transparent !important;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold">
            <i class="bi bi-ticket-detailed text-secondary me-2"></i>
            @if (Auth::user()->role === 'admin')
                Liste
            @else
                Liste
            @endif
            ({{ $tickets->count() }})
        </h5>
        <form action="{{ route('tickets.index') }}" method="GET" class="d-flex justify-content-center mx-4 w-50">
            <form action="{{ route('tickets.index') }}" method="GET" class="d-flex justify-content-center mx-4 w-50">
                <div class="input-group shadow-sm rounded-pill"
                    style="background-color: rgba(255, 255, 255, 0.5); border: 1px solid rgba(90, 104, 83, 0.2); overflow: hidden;">

                    <span class="input-group-text bg-transparent border-0 ps-3 pe-2">
                        <i class="bi bi-search text-secondary"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-control border-0 bg-transparent shadow-none" placeholder="Rechercher par référence..."
                        style="font-size: 0.95rem;">

                    <div class="vr my-2 text-muted opacity-25"></div>

                    <select name="priority" class="form-select border-0 bg-transparent shadow-none"
                        style="max-width: 160px; font-size: 0.95rem; cursor: pointer;">
                        <option value="">Toutes</option>
                        <option value="Low" {{ request('priority') == 'Low' ? 'selected' : '' }}>Basse</option>
                        <option value="Medium" {{ request('priority') == 'Medium' ? 'selected' : '' }}>Moyenne</option>
                        <option value="High" {{ request('priority') == 'High' ? 'selected' : '' }}>Haute</option>
                        <option value="Urgent" {{ request('priority') == 'Urgent' ? 'selected' : '' }}>Urgente</option>
                    </select>

                    <button type="submit" class="btn border-0 px-3" style="background-color: #5a6853; color: white;">
                        <i class="bi bi-funnel-fill"></i>
                    </button>
                </div>
            </form>
        </form>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary"
            style="background-color: #5a6853; border-color: #5a6853;">
            Ajouter Ticket
        </a>
        <a href="{{ route('tickets.archives') }}" class="btn btn-primary"
            style="background-color: #5a6853; border-color:#5a6853">
            Tickets Résolus
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div style="background-color: transparent;">
        <div class="card-body p-0">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Référence</th>
                        <th>Sujet</th>
                        <th>Statut</th>
                        <th>Priorité</th>
                        @if (Auth::user()->role === 'admin')
                            <th>employe</th>
                        @endif
                        <th class="pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                        <tr>
                            <td class="ps-4"><strong>{{ $ticket->reference }}</strong></td>
                            <td>{{ $ticket->subject }}</td>
                            <td>
                                @if ($ticket->status == 'New')
                                    Nouveau
                                @elseif($ticket->status == 'Proccessing')
                                    En cours
                                @elseif($ticket->status == 'Solved')
                                    Résolu
                                @elseif($ticket->status == 'Late')
                                    En retard
                                @else
                                    <span class="badge bg-secondary">{{ $ticket->status }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($ticket->priority == 'Urgent')
                                    Urgente
                                @elseif($ticket->priority == 'High')
                                    Haute
                                @elseif($ticket->priority == 'Medium')
                                    Moyenne
                                @elseif($ticket->priority == 'Low')
                                    Basse
                                @else
                                    {{ $ticket->priority }}
                                @endif
                            </td>
                            @if (Auth::user()->role === 'admin')
                                <td>
                                    {{ $ticket->requester->first_name }} {{ $ticket->requester->last_name }}
                                </td>
                            @endif
                            <td class="text-center pe-3">
                                <div class="d-flex justify-content-center gap-2"> <a
                                        href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm" title="Voir">
                                        <i class="bi bi-eye text-primary"></i>
                                    </a></div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Aucun ticket trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
