@extends('layouts.main')

@section('title', 'Mon Espace')

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
        }

        .table-custom td {
            border-color: rgba(0, 0, 0, 0.05) !important;
        }
    </style>

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('tickets.create') }}" class="btn btn-primary"
            style="background-color: #5a6853; border-color: #5a6853;">
            Créer un ticket
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="background-color: #8b7d6b; color: white;">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h6 class="fw-bold mb-1 text-white">Total de mes tickets</h6>
                        <h2 class="fw-bold mb-0 text-white">{{ $totalTickets }}</h2>
                    </div>
                    <i class="bi bi-ticket-detailed" style="font-size: 2.5rem; opacity: 0.6;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="background-color: #c25e00; color: white;">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h6 class="fw-bold mb-1 text-white">Tickets en cours</h6>
                        <h2 class="fw-bold mb-0 text-white">{{ $openTickets }}</h2>
                    </div>
                    <i class="bi bi-hourglass-split" style="font-size: 2.5rem; opacity: 0.6;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="background-color: #557a5a; color: white;">
                <div class="card-body d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h6 class="fw-bold mb-1 text-white">Tickets résolus</h6>
                        <h2 class="fw-bold mb-0 text-white">{{ $solvedTickets }}</h2>
                    </div>
                    <i class="bi bi-check-circle" style="font-size: 2.5rem; opacity: 0.6;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom-0 pt-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold" style="color: #000;">
                <i class="bi bi-clock-history me-2"></i> Mes derniers tickets
            </h5>
            <a href="{{ route('tickets.index') }}" class="btn btn-sm btn-outline-secondary">Voir tout</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-custom table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Référence</th>
                        <th>Sujet</th>
                        <th>Priorité</th>
                        <th>Statut</th>
                        <th class="pe-4 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTickets as $ticket)
                        <tr>
                            <td class="ps-4"><strong>{{ $ticket->reference }}</strong></td>
                            <td>{{ Str::limit($ticket->subject, 40) }}</td>
                            <td>
                                @if ($ticket->priority == 'Urgent')
                                    Urgente
                                @elseif($ticket->priority == 'High')
                                    Haute
                                @elseif($ticket->priority == 'Medium')
                                    Moyenne
                                @elseif($ticket->priority == 'Low')
                                    Basse
                                @endif
                            </td>
                            <td>
                                @if ($ticket->status == 'New')
                                    Nouveau
                                @elseif($ticket->status == 'Proccessing')
                                    En cours
                                @elseif($ticket->status == 'Solved')
                                    Résolu
                                @elseif($ticket->status == 'Late')
                                    En retard
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm">
                                    <i class="bi bi-eye text-primary fs-5"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Vous n'avez pas encore créé de ticket.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
