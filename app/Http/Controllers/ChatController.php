<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $currentUser = auth()->user(); // Mendapatkan pengguna yang sedang login

        // Filter pengguna lain dengan role yang berbeda
        $users = User::where('id', '!=', $currentUser->id) // Hindari menampilkan pengguna yang sama
                ->where('role', '!=', $currentUser->role) // Filter berdasarkan role
                ->get();
        return view('chat.index', compact('users'));
    }

    // public function fetchMessages($id)
    // {
    //     // Fetch messages between current user and selected user
    //     $messages = Chat::with(['sender', 'receiver'])
    //         ->betweenUsers(auth()->id(), $id)
    //         ->get()
    //         ->map(function ($message) {
    //             return [
    //                 'id' => $message->id,
    //                 'sender_name' => $message->sender->name,
    //                 'is_current_user' => $message->sender_id === auth()->id(),
    //                 'message' => $message->message,
    //                 'image_url' => $message->image_url,
    //                 'created_at' => $message->created_at->diffForHumans()
    //             ];
    //         });

    //     return response()->json($messages);
    // }

    // public function fetchMessages($id)
    // {
    //     $messages = Chat::where(function ($query) use ($id) {
    //         $query->where('sender_id', auth()->id())
    //             ->where('receiver_id', $id);
    //     })->orWhere(function ($query) use ($id) {
    //         $query->where('sender_id', $id)
    //             ->where('receiver_id', auth()->id());
    //     })->orderBy('created_at', 'asc')->get();

    //     return response()->json($messages);
    // }

    public function checkUnreadMessages()
    {
        $userId = auth()->id();

        // Total unread messages count
        $totalUnreadMessages = Chat::where('receiver_id', $userId)
            ->whereNull('read_at')
            ->count();

        // Unread messages per user
        $userUnreadCounts = Chat::where('receiver_id', $userId)
            ->whereNull('read_at')
            ->select('sender_id', DB::raw('COUNT(*) as unread_count'))
            ->groupBy('sender_id')
            ->get();

        return response()->json([
            'unread_messages' => $totalUnreadMessages,
            'user_unread_counts' => $userUnreadCounts
        ]);
    }

    public function markAsRead(Request $request)
    {
        $userId = auth()->id();
        $senderId = $request->input('sender_id');

        Chat::where('receiver_id', $userId)
            ->where('sender_id', $senderId)
            ->where('read_at', null)
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    public function fetchMessages($id, Request $request)
    {
        $query = Chat::where(function ($query) use ($id) {
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender_id', $id)
                ->where('receiver_id', auth()->id());
        });

        if ($request->has('after')) {
            $query->where('created_at', '>', $request->after);
        }

        return response()->json($query->orderBy('created_at', 'asc')->get());
    }


    // public function fetchMessages($id, Request $request)
    // {
    //     $query = Chat::where(function ($query) use ($id) {
    //         $query->where('sender_id', auth()->id())
    //             ->where('receiver_id', $id);
    //     })->orWhere(function ($query) use ($id) {
    //         $query->where('sender_id', $id)
    //             ->where('receiver_id', auth()->id());
    //     });

    //     // If an 'after' parameter is provided, only fetch messages after that ID
    //     if ($request->has('after')) {
    //         $query->where('id', '>', $request->after);
    //     }

    //     return response()->json($query->orderBy('created_at', 'asc')->get());
    // }

    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $data['sender_id'] = auth()->id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('chat_images', 'public');
        }

        // Create message
        $message = Chat::create([
            'sender_id' => $data['sender_id'],
            'receiver_id' => $data['receiver_id'],
            'message' => $request->input('message'),
            'image_path' => $data['image_path'] ?? null
        ]);

        // Return full message details
        return response()->json([
            'id' => $message->id,
            'sender_name' => auth()->user()->name,
            'is_current_user' => true,
            'message' => $message->message,
            'image_url' => $message->image_url,
            'created_at' => $message->created_at->diffForHumans()
        ]);
    }
}
