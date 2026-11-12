@extends('layouts.main')

@section('title', 'Détails du Ticket')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('tickets.index') }}" class="text-decoration-none text-muted">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-3">
                    <h4 class="mb-0 fw-bold" style="color: red;">
                        {{ $ticket->subject }}
                    </h4>
                </div>
                <div class="card-body pt-0">
                    <h6 class="fw-bold mt-3">Description</h6>
                    <div class="bg-white p-3 rounded border mb-0" style="min-height: 100px;">
                        {{ $ticket->description }}
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <h6 class="fw-bold mb-3">Pièces jointes</h6>

                        @if ($ticket->attachments->count() > 0)
                            <ul class="list-group mb-3">
                                @foreach ($ticket->attachments as $file)
                                    <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                        <div>
                                            <i class="bi bi-file-earmark-text me-2 text-primary"></i>
                                            {{ basename($file->file_path) }}
                                        </div>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Voir
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted small fst-italic mb-3">Aucune pièce jointe pour le moment.</p>
                        @endif

                        @if (Auth::user()->role == 'employee')
                            <form action="{{ route('tickets.add-attachment', $ticket->id) }}" method="POST"
                                enctype="multipart/form-data" class="mt-2">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="file" name="attachment" class="form-control" required>
                                    <button type="submit" class="btn text-white" style="background-color: #5a6853;">
                                        <i class="bi bi-upload me-1"></i> Ajouter
                                    </button>
                                </div>
                                <small class="text-muted" style="font-size: 0.75rem;">Max 2Mo (PDF, JPG, PNG).</small>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0 pt-3">
                    <h6 class="mb-3 fw-bold">
                        Conversation
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-4" style="max-height: 400px; overflow-y: auto;">
                        @forelse($ticket->messages as $msg)
                            <div
                                class="mb-3 d-flex {{ $msg->user_id == Auth::id() ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="p-3 rounded shadow-sm"
                                    style="max-width: 75%; background-color: {{ $msg->user_id == Auth::id() ? '#5a6853' : '#e6e3db' }}; color: {{ $msg->user_id == Auth::id() ? 'white' : '#333' }};">
                                    <div class="d-flex justify-content-between mb-1" style="font-size: 0.8rem;">
                                        <strong>{{ $msg->user->first_name }} {{ $msg->user->last_name }}</strong>
                                        <small
                                            class="ms-3 {{ $msg->user_id == Auth::id() ? 'text-white-50' : 'text-muted' }}">
                                            {{ $msg->created_at->format('H:i') }}
                                        </small>
                                    </div>
                                    <p class="mb-0" style="font-size: 0.95rem;">{{ $msg->message }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center fst-italic">Aucun message pour le moment. Commencez la
                                conversation !</p>
                        @endforelse
                    </div>

                    <form action="{{ route('tickets.add-message', $ticket->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="message" class="form-control" placeholder="Écrivez votre message..."
                                required autocomplete="off">
                            <button type="submit" class="btn text-white" style="background-color: #5a6853;">
                                <i class="bi bi-send me-1"></i> Envoyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0 pt-3">
                    <h6 class="fw-bold mb-3">Historique du
                        ticket</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($ticket->histories as $history)
                            <li class="list-group-item px-0 bg-transparent">
                                <div class="d-flex">
                                    <div class="me-3 text-secondary"><i class="bi bi-circle-fill"
                                            style="font-size: 0.5rem; vertical-align: middle;"></i></div>
                                    <div>
                                        <strong>{{ $history->user->first_name }}</strong> {{ $history->action }}
                                        <br><small class="text-muted">{{ $history->created_at->diffForHumans() }}
                                            ({{ $history->created_at->format('d/m/Y H:i') }})
                                        </small>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item px-0 bg-transparent text-muted">Aucun historique.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0 pt-3">
                    <h5 class="mb-0 fw-bold">Détails :</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-5 text-muted">Demandeur</div>
                        <div class="col-7 fw-bold">{{ $ticket->requester->first_name }}
                            {{ $ticket->requester->last_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted">Département</div>
                        <div class="col-7">{{ $ticket->requester->department->name ?? 'Non assigné' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted">Créé le</div>
                        <div class="col-7">{{ $ticket->created_at->format('d/m/Y à H:i') }}</div>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0 pt-3">
                    <h5 class="mb-0 fw-bold">Traitement :</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-5 text-muted">Priorité</div>
                        <div class="col-7">
                            @if ($ticket->priority == 'Urgent')
                                Urgente
                            @elseif($ticket->priority == 'High')
                                Haute
                            @elseif($ticket->priority == 'Medium')
                                Moyenne
                            @elseif($ticket->priority == 'Low')
                                Basse
                            @endif
                        </div>
                        <div class="col-5 text-muted">Status</div>
                        <div class="col-7">
                            @if ($ticket->status == 'New')
                                Nouveau
                            @elseif($ticket->status == 'Proccessing')
                                En cours
                            @elseif($ticket->status == 'Solved')
                                Résolu
                            @elseif($ticket->status == 'Late')
                                En retard
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0 pt-3">
                    <h5 class="mb-0 fw-bold">Actions :
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div>
                            @if (Auth::user()->role === 'admin')
                                @if ($ticket->status == 'Solved')
                                    <div class="alert alert-success mb-0 text-center">
                                        <i class="bi bi-check-circle-fill me-2"></i> Ce ticket est résolu.
                                    </div>
                                @else
                                    @if ($ticket->assigned_to != Auth::id())
                                        <form action="{{ route('tickets.assign', $ticket) }}" method="POST"
                                            class="mb-2">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn w-100 text-white"
                                                style="background-color: #5a6853;">
                                                M'assigner ce ticket
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('tickets.resolve', $ticket) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success w-100">
                                            Marquer comme Résolu
                                        </button>
                                    </form>
                                @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
