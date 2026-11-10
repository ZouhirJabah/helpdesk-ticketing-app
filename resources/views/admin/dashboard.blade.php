@extends('layouts.main')

@section('title', 'Admin Dashboard')
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
        background-color: rgba(90, 104, 83, 0.15) !important;
    }

    .table-custom td {
        border-color: rgba(0, 0, 0, 0.05) !important;
    }
</style>
@section('content')
    <div class="row flex-nowrap overflow-auto g-2">
        <div class="col">
            <div class="card border-0 shadow-sm h-100" style="background-color: #6d7d64; color: white;">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="fw-bold mb-1 text-white">{{ $ticketsByStatus->sum() }}</h4>
                            <h6 class="mb-0 text-white" style="font-size: 1rem;">Tickets</h6>
                        </div>
                        <div class="border-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 30px; height: 30px;">
                            <i class="bi bi-ticket-detailed text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm h-100" style="background-color: #c25e00; color: white;">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="fw-bold mb-1 text-white">{{ $ticketsByStatus['New'] ?? 0 }}</h4>
                            <h6 class="mb-0 text-white" style="font-size: 1rem;">Nouveau</h6>
                        </div>
                        <div class="border-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 30px; height: 30px;">
                            <i class="bi bi-inbox text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm h-100" style="background-color: #6e6e6e; color: white;">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="fw-bold mb-1 text-white">{{ $ticketsByStatus['Proccessing'] ?? 0 }}</h4>
                            <h6 class="mb-0 text-white" style="font-size: 1rem;">En Cours</h6>
                        </div>
                        <div class="border-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 30px; height: 30px;">
                            <i class="bi bi-hourglass-split text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm h-100" style="background-color: #a45c5c; color: white;">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="fw-bold mb-1 text-white">{{ $lateTickets }}</h4>
                            <h6 class="mb-0 text-white" style="font-size: 1rem;">En retard</h6>
                        </div>
                        <div class="border-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 30px; height: 30px;">
                            <i class="bi bi-clock text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm h-100" style="background-color: #557a5a; color: white;">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="fw-bold mb-1 text-white">{{ $ticketsByStatus['Solved'] ?? 0 }}</h4>
                            <h6 class="mb-0 text-white" style="font-size: 1rem;">Résolu</h6>
                        </div>
                        <div class="border-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 30px; height: 30px;">
                            <i class="bi bi-check-circle text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm h-100" style="background-color: #5c7c8a; color: white;">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="fw-bold mb-1 text-white">{{ $assignedTickets }}</h4>
                            <h6 class="mb-0 text-white" style="font-size: 1rem;">Assignés</h6>
                        </div>
                        <div class="border-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 30px; height: 30px;">
                            <i class="bi bi-person-check text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-0 shadow-sm h-100" style="background-color: #8b7d6b; color: white;">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="fw-bold mb-1 text-white">{{ $totalEmployees }}</h4>
                            <h6 class="mb-0 text-white" style="font-size: 1rem;">Employés</h6>
                        </div>
                        <div class="border-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 30px; height: 30px;">
                            <i class="bi bi-people text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm" style="background-color: #e6e3db !important;">
                <div class="card-header border-bottom-0" style="background-color: #e6e3db;">
                    <h5 class="mb-0">Tickets par Statut</h5>
                </div>
                <div class="card-body" style="height: 300px; background-color: #e6e3db; border-radius: 0 0 8px 8px;">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm" style="background-color: #e6e3db !important;">
                <div class="card-header border-bottom-0" style="background-color: #e6e3db;">
                    <h5 class="mb-0">Tickets par Priorité</h5>
                </div>
                <div class="card-body" style="height: 300px; background-color: #e6e3db; border-radius: 0 0 8px 8px;">
                    <canvas id="priorityChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background-color: transparent;">

                <div class="card-header border-bottom-0 pt-3 d-flex justify-content-between align-items-center"
                    style="background-color: transparent;">
                    <h5 class="mb-0 fw-bold" style="color: #5a6853;">
                        Tickets reçus Aujourd'hui
                    </h5>
                    <a href="{{ route('tickets.index') }}" class="btn btn-sm btn-outline-secondary">Voir tout</a>
                </div>

                <div class="card-body p-0">
                    <table class="table table-custom table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Référence</th>
                                <th>Sujet</th>
                                <th>Demandeur</th>
                                <th>Priorité</th>
                                <th>Statut</th>
                                <th class="pe-4 text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($todayTickets as $ticket)
                                <tr>
                                    <td class="ps-4"><strong>{{ $ticket->reference }}</strong></td>
                                    <td>{{ Str::limit($ticket->subject, 40) }}</td>
                                    <td>{{ $ticket->requester->first_name }} {{ $ticket->requester->last_name }}</td>
                                    <td>
                                        @if ($ticket->priority == 'Urgent')
                                            Urgente
                                        @elseif($ticket->priority == 'High')
                                            Haute
                                        @else
                                            {{ $ticket->priority }}
                                        @endif
                                    </td>
                                    <td>{{ $ticket->status }}</td>
                                    <td class="text-end pe-4">
                                        @if (!$ticket->assigned_to)
                                            <form action="{{ route('tickets.assign', $ticket->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-primary"
                                                    style="background-color: #5a6853; border-color: #5a6853;">
                                                    <i class="bi bi-person-plus me-1"></i> M'assigner
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle me-1"></i> Déjà assigné
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="bi bi-check-circle fs-3 d-block mb-2 text-success"></i>
                                        Aucun nouveau ticket aujourd'hui!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const statusCtx = document.getElementById('statusChart').getContext('2d');
            const statusData = @json($ticketsByStatus);

            const statusKeys = ['New', 'Proccessing', 'Solved', 'Late'];
            const statusLabels = ['Nouveau', 'En cours', 'Résolu', 'En retard'];

            const statusValues = statusKeys.map(label => statusData[label] || 0);

            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: statusLabels,
                    datasets: [{
                        data: statusValues,
                        backgroundColor: ['#c25e00', '#6e6e6e', '#557a5a', '#dc3545'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            const priorityCtx = document.getElementById('priorityChart').getContext('2d');
            const priorityData = @json($ticketsByPriority);

            const priorityKeys = ['Low', 'Medium', 'High', 'Urgent'];
            const priorityLabels = ['Basse', 'Moyenne', 'Haute', 'Urgente'];

            const priorityValues = priorityKeys.map(label => priorityData[label] || 0);

            new Chart(priorityCtx, {
                type: 'bar',
                data: {
                    labels: priorityLabels,
                    datasets: [{
                        label: 'Nombre de tickets',
                        data: priorityValues,
                        backgroundColor: ['#557a5a', '#3b82f6', '#c25e00', '#ef4444'],
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
@endpush
