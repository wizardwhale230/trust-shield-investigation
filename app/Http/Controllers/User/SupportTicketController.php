<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::where('user_id', Auth::id())
            ->orderByDesc('updated_at')
            ->paginate(15);

        return view('user.support-tickets.index', [
            'title' => 'Support Tickets',
            'tickets' => $tickets,
        ]);
    }

    public function create()
    {
        return view('user.support-tickets.create', [
            'title' => 'New Support Ticket',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high,urgent',
            'message' => 'required|string',
        ]);

        SupportTicket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message,
            'priority' => $request->priority,
            'ticket_number' => SupportTicket::generateTicketNumber(),
        ]);

        return redirect()->route('user.support-tickets.index')
            ->with('success', 'Your support ticket has been submitted. We will respond shortly.');
    }

    public function show(SupportTicket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $replies = $ticket->replies()->with('user')->orderBy('created_at', 'asc')->get();

        return view('user.support-tickets.show', [
            'title' => 'Ticket: ' . $ticket->ticket_number,
            'ticket' => $ticket,
            'replies' => $replies,
        ]);
    }

    public function reply(Request $request, SupportTicket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string',
        ]);

        TicketReply::create([
            'support_ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
            'is_admin' => false,
        ]);

        $ticket->update([
            'last_replied_at' => now(),
            'status' => $ticket->status === 'closed' ? 'open' : $ticket->status,
        ]);

        return redirect()->route('user.support-tickets.show', $ticket)
            ->with('success', 'Reply sent successfully.');
    }
}
