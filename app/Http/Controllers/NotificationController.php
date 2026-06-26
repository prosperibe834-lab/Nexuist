<?php

namespace App\Http\Controllers;

use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = UserNotification::where('user_id', $user->id);

        if ($request->filled('filter') && in_array($request->query('filter'), ['read', 'unread'])) {
            $query->where('status', $request->query('filter'));
        }

        if ($request->filled('search')) {
            $search = trim($request->query('search'));
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('message', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%");
            });
        }

        $notifications = $query->orderBy('created_at', 'desc')->get();
        $unreadCount = UserNotification::where('user_id', $user->id)
            ->where('status', 'unread')
            ->count();

        return view('notification', compact('notifications', 'unreadCount'));
    }

    public function toggleRead(Request $request, $id)
    {
        $user = Auth::user();
        $notification = UserNotification::where('user_id', $user->id)->findOrFail($id);
        $status = $request->input('status');

        if (!in_array($status, ['read', 'unread'])) {
            $status = $notification->status === 'unread' ? 'read' : 'unread';
        }

        $notification->status = $status;
        $notification->save();

        $unreadCount = UserNotification::where('user_id', $user->id)
            ->where('status', 'unread')
            ->count();

        return response()->json([
            'success' => true,
            'status' => $notification->status,
            'unreadCount' => $unreadCount,
            'message' => 'Notification status updated.',
        ]);
    }

    public function markAllRead(Request $request)
    {
        $user = Auth::user();
        UserNotification::where('user_id', $user->id)
            ->where('status', 'unread')
            ->update(['status' => 'read']);

        return response()->json([
            'success' => true,
            'unreadCount' => 0,
            'message' => 'All notifications marked as read.',
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $user = Auth::user();
        $notification = UserNotification::where('user_id', $user->id)->findOrFail($id);
        $notification->delete();

        $remainingCount = UserNotification::where('user_id', $user->id)->count();
        $unreadCount = UserNotification::where('user_id', $user->id)
            ->where('status', 'unread')
            ->count();

        return response()->json([
            'success' => true,
            'remainingCount' => $remainingCount,
            'unreadCount' => $unreadCount,
            'message' => 'Notification deleted.',
        ]);
    }
}
