{{-- @extends('layouts.main')

@section('title', 'Liste des Tickets')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Liste des Tickets</h4>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nouveau Ticket
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Référence</th>
                        <th>Sujet</th>
                        <th>Statut</th>
                        <th>Priorité</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                        <tr>
                            <td><strong>{{ $ticket->reference }}</strong></td>
                            <td>{{ $ticket->subject }}</td>
                            <td>
                                @if ($ticket->status == 'New')
                                    <span class="badge bg-primary">Nouveau</span>
                                @elseif($ticket->status == 'Open')
                                    <span class="badge bg-info text-dark">Ouvert</span>
                                @elseif($ticket->status == 'In Progress')
                                    <span class="badge bg-warning text-dark">En cours</span>
                                @elseif($ticket->status == 'Resolved')
                                    <span class="badge bg-success">Résolu</span>
                                @else
                                    <span class="badge bg-secondary">{{ $ticket->status }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($ticket->priority == 'Urgent')
                                    <span class="badge bg-danger">Urgent</span>
                                @elseif($ticket->priority == 'High')
                                    <span class="badge bg-warning text-dark">Haute</span>
                                @elseif($ticket->priority == 'Medium')
                                    <span class="badge bg-primary">Moyenne</span>
                                @else
                                    <span class="badge bg-secondary">Basse</span>
                                @endif
                            </td>
                            <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="/" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Détails
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Aucun ticket trouvé pour le moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection --}}
