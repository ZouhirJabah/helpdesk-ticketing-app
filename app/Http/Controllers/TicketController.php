<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $tickets = Ticket::latest()->get();
        } else {
            $tickets = Ticket::where('user_id', Auth::id())->latest()->get();
        }
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
        ]);

        $reference = 'Ticket-' . date('Y') . '-' . strtoupper(Str::random(4));

        Ticket::create([
            'reference' => $reference,
            'subject' => $request->subject,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'New',
            'user_id' => Auth::id(),
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

        $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $ticket->update([
            'assigned_to' => $request->assigned_to,
            'status' => 'Open',
        ]);

        return back()->with('success', 'Ticket assigné avec succès !');
    }
}
