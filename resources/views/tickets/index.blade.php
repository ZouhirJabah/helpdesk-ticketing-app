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
        <a href="{{ route('tickets.create') }}" class="btn btn-primary"
            style="background-color: #5a6853; border-color: #5a6853;">
            <i class="bi bi-plus-lg me-2"></i> Nouveau Ticket
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
                        <th>employe</th>
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
                                @else
                                    {{ $ticket->priority }}
                                @endif
                            </td>
                            <td>
                                {{ $ticket->requester->first_name }} {{ $ticket->requester->last_name }}
                            </td>
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
