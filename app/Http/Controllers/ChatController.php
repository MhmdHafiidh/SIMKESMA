<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function index()
    {
        // Fetch users of different roles for chat
        $users = User::where('id', '!=', auth()->id())->get();
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

    public function fetchMessages($id)
    {
        $messages = Chat::where(function ($query) use ($id) {
            $query->where('sender_id', auth()->id())
                ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender_id', $id)
                ->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

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