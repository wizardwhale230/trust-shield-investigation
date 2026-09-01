<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTicketController extends Controller
{
    public function index(Request $request)
    {
        $query = SupportTicket::with('user', 'latestReply')->orderByDesc('updated_at');

        if ($request->has('status') && in_array($request->status, ['open', 'answered', 'closed'])) {
            $query->where('status', $request->status);
        }

        $tickets = $query->paginate(20);

        return view('admin.support-tickets.index', [
            'title' => 'Support Tickets',
            'tickets' => $tickets,
            'currentStatus' => $request->status,
        ]);
    }

    public function show($id)
    {
        $ticket = SupportTicket::with('user')->findOrFail($id);
        $replies = $ticket->replies()->with('user')->orderBy('created_at', 'asc')->get();

        return view('admin.support-tickets.show', [
            'title' => 'Ticket: ' . $ticket->ticket_number,
            'ticket' => $ticket,
            'replies' => $replies,
        ]);
    }

    public function reply(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);

        $request->validate([
            'message' => 'required|string',
        ]);

        TicketReply::create([
            'support_ticket_id' => $ticket->id,
            'user_id' => Auth::guard('admin')->id(),
            'message' => $request->message,
            'is_admin' => true,
        ]);

        $ticket->update([
            'status' => 'answered',
            'last_replied_at' => now(),
        ]);

        return redirect()->route('admin.support-tickets.show', $ticket->id)
            ->with('success', 'Reply sent successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);

        $request->validate([
            'status' => 'required|in:open,answered,closed',
        ]);

        $ticket->update([
            'status' => $request->status,
            'closed_at' => $request->status === 'closed' ? now() : $ticket->closed_at,
        ]);

        return redirect()->route('admin.support-tickets.show', $ticket->id)
            ->with('success', 'Ticket status updated.');
    }
}
