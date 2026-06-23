<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\SupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SupportController extends Controller
{
    // User creates a support ticket
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'subject' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'priority' => 'nullable|in:Low,Medium,High',
        ]);

        $user = Auth::user();

        $ticket = SupportTicket::create([
            'user_id' => $user ? $user->id : null,
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject ?? 'Support Request',
            'category' => $request->category ?? 'General',
            'priority' => $request->priority ?? 'Medium',
            'status' => 'Open',
            'last_message_at' => now(),
        ]);

        SupportMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user ? $user->id : null,
            'sender' => 'user',
            'message' => $request->message,
        ]);

        return response()->json(['success' => true, 'ticket' => $ticket]);
    }

    // User's tickets
    public function userTickets(Request $request)
    {
        $user = Auth::user();
        $tickets = SupportTicket::where('user_id', $user->id)->withCount('messages')->orderByDesc('updated_at')->get();
        return response()->json(['tickets' => $tickets]);
    }

    // Show single ticket with messages - JSON API for admin
    public function showJson($id)
    {
        $this->authorizeAdmin();
        $ticket = SupportTicket::with('messages')->findOrFail($id);
        return response()->json(['ticket' => $ticket]);
    }

    // Show single ticket with messages (for both user and admin)
    public function show($id)
    {
        $ticket = SupportTicket::with('messages')->findOrFail($id);
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        if (!$user->is_admin && $ticket->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        return response()->json(['ticket' => $ticket]);
    }

    // Admin: dashboard stats
    public function stats()
    {
        $this->authorizeAdmin();

        $totalTickets = SupportTicket::count();
        $openTickets = SupportTicket::where('status', 'Open')->count();
        $resolvedTickets = SupportTicket::where('status', 'Resolved')->count();
        $highPriorityTickets = SupportTicket::where('priority', 'High')->count();
        $weeklyTrend = (SupportTicket::where('created_at', '>=', now()->subDays(7))->count() / max($totalTickets, 1) * 100);
        $resolutionRate = ($totalTickets > 0) ? round(($resolvedTickets / $totalTickets) * 100, 1) : 0;

        return response()->json([
            'totalTickets' => $totalTickets,
            'openTickets' => $openTickets,
            'resolvedTickets' => $resolvedTickets,
            'highPriorityTickets' => $highPriorityTickets,
            'weeklyTrend' => round($weeklyTrend, 1),
            'resolutionRate' => $resolutionRate,
        ]);
    }

    // Admin: get all tickets as JSON API
    public function adminIndexJson()
    {
        $this->authorizeAdmin();
        $tickets = SupportTicket::with('messages')->withCount('messages')->orderByDesc('last_message_at')->get();
        return response()->json(['tickets' => $tickets]);
    }

    // Admin: list all tickets (HTML view)
    public function adminIndex()
    {
        $this->authorizeAdmin();
        $tickets = SupportTicket::withCount('messages')->orderByDesc('last_message_at')->get();

        // Fetch stats for display
        $stats = [
            'totalTickets' => SupportTicket::count(),
            'openTickets' => SupportTicket::where('status', 'Open')->count(),
            'resolvedTickets' => SupportTicket::where('status', 'Resolved')->count(),
            'highPriorityTickets' => SupportTicket::where('priority', 'High')->count(),
            'weeklyTrend' => round((SupportTicket::where('created_at', '>=', now()->subDays(7))->count() / max(SupportTicket::count(), 1) * 100), 1),
            'resolutionRate' => SupportTicket::count() > 0 ? round((SupportTicket::where('status', 'Resolved')->count() / SupportTicket::count()) * 100, 1) : 0,
        ];

        return view('AdminDashboard.AdminSupport', [
            'tickets' => $tickets,
            'stats' => $stats,
        ]);
    }

    // Admin: reply to ticket
    public function adminReply(Request $request, $id)
    {
        $this->authorizeAdmin();

        $request->validate(['message' => 'required|string']);

        $ticket = SupportTicket::findOrFail($id);

        $msg = SupportMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'sender' => 'admin',
            'message' => $request->message,
        ]);

        $ticket->last_message_at = now();
        $ticket->save();

        return response()->json(['success' => true, 'message' => $msg]);
    }

    // Admin: update status
    public function adminUpdateStatus(Request $request, $id)
    {
        $this->authorizeAdmin();
        $request->validate(['status' => 'required|in:Open,In Progress,Resolved,Closed,Escalated']);

        $ticket = SupportTicket::findOrFail($id);
        $ticket->status = $request->status;
        $ticket->save();

        return response()->json(['success' => true, 'ticket' => $ticket]);
    }

    protected function authorizeAdmin()
    {
        $user = Auth::user();
        if (!$user || !$user->is_admin) {
            abort(403, 'Unauthorized');
        }
    }
}
