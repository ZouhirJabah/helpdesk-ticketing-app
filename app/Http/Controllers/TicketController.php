<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            $query = Ticket::where('status', '!=', 'Solved');
        } else {
            $query = Ticket::where('user_id', Auth::id())->where('status', '!=', 'Solved');
        }
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('reference', 'LIKE', "%{$search}%")
                    ->orWhere('subject', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        if ($request->has('priority') && $request->priority != '') {
            $query->where('priority', $request->priority);
        }

        $tickets = $query->latest()->get();

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:Low,Medium,High,Urgent',
            'attachment' => 'nullable|file|max:2048',
        ]);

        $reference = 'Ticket-' . date('Y') . '-' . strtoupper(Str::random(4));

        $ticket = Ticket::create([
            'reference' => $reference,
            'subject' => $request->subject,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'New',
            'user_id' => Auth::id(),
        ]);

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');

            $ticket->attachments()->create([
                'file_path' => $path,
            ]);
        }
        $ticket->histories()->create([
            'user_id' => Auth::id(),
            'action' => 'a créé le ticket.',
        ]);
        return redirect()->route('tickets.index')->with('success', 'Ticket créé avec succès !');
    }

    public function show(Ticket $ticket)
    {
        $employees = \App\Models\User::where('role', 'employee')->get();
        return view('tickets.show', compact('ticket', 'employees'));
    }

    public function assign(Request $request, Ticket $ticket)
    {
        if (Auth::user()->role !== 'admin') {
            return back()->withErrors(['error' => 'Action non autorisée.']);
        }

        $ticket->update([
            'assigned_to' => Auth::id(),
            'status' => 'Proccessing',
        ]);
        $ticket->histories()->create([
            'user_id' => Auth::id(),
            'action' => 's\'est assigné le ticket.',
        ]);
        return back()->with('success', 'Le ticket vous a été assigné avec succès !');
    }
    public function resolve(Ticket $ticket)
    {
        if (Auth::user()->role !== 'admin') {
            return back()->withErrors(['error' => 'Action non autorisée.']);
        }

        $ticket->update([
            'status' => 'Solved',
        ]);

        $ticket->histories()->create([
            'user_id' => Auth::id(),
            'action' => 'a marqué le ticket comme RÉSOLU.',
        ]);

        return back()->with('success', 'Le ticket a été marqué comme résolu avec succès !');
    }


    public function addAttachment(Request $request, Ticket $ticket)
    {
        $request->validate([
            'attachment' => 'required|file|max:2048',
        ]);

        $path = $request->file('attachment')->store('attachments', 'public');

        $ticket->attachments()->create([
            'file_path' => $path,
        ]);

        $ticket->histories()->create([
            'user_id' => Auth::id(),
            'action' => 'a ajouté une pièce jointe.',
        ]);

        return back()->with('success', 'Pièce jointe ajoutée avec succès !');
    }

    public function archives(Request $request)
    {
        $query = Ticket::query();
        $query->where('status', 'Solved');
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('reference', 'LIKE', "%{$search}%")
                    ->orWhere('subject', 'LIKE', "%{$search}%");
            });
        }
        $tickets = $query->latest()->get();
        return view('tickets.archives', compact('tickets'));
    }

    public function addMessage(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $ticket->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        $ticket->histories()->create([
            'user_id' => Auth::id(),
            'action' => 'a envoyé un message.',
        ]);

        return back()->with('success', 'Message envoyé !');
    }
}
