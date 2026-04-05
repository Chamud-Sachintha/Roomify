<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
{
    private $user;
    private $UserModel;
    private $ChatMessageModel;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->UserModel = new User();
        $this->ChatMessageModel = new ChatMessage();
    }

    public function showMessagesPage()
    {
        $all_users = $this->UserModel->where('id', '!=', $this->user->id)->get();

        return view('app.admin.messages')->with(['user' => $this->user, 'breadcrumb' => 'Message Inbox', 'all_users' => $all_users]);
    }

    public function showClientAdminMessagePage() {
        $all_users = $this->UserModel->getAdminusers();

        return view('app.admin-messages')->with(['user' => $this->user, 'breadcrumb' => 'Message Inbox', 'all_users' => $all_users]);
    }

    public function sendChatMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $message = $this->ChatMessageModel->saveChatMessage($this->user->id, $request->input('receiver_id'), $request->input('message'));

        // Broadcast the message to the receiver
        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message sent successfully']);
    }

    public function markAsRead(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
        ]);

        $this->ChatMessageModel->where('sender_id', $request->input('sender_id'))
            ->where('receiver_id', $request->input('receiver_id'))
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

        return response()->json(['status' => 'Messages marked as read']);
    }

    public function getChatHistory(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
        ]);

        $chatHistory = $this->ChatMessageModel->where(function ($query) use ($request) {
            $query->where('sender_id', $request->input('sender_id'))
                ->where('receiver_id', $request->input('receiver_id'));
        })->orWhere(function ($query) use ($request) {
            $query->where('sender_id', $request->input('receiver_id'))
                ->where('receiver_id', $request->input('sender_id'));
        })->orderBy('created_at', 'asc')->get();

        return response()->json(['chat_history' => $chatHistory]);

    }
}
