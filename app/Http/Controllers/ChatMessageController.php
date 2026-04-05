<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
{
    private $user;
    private $UserModel;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->UserModel = new User();
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

        // dd($request->all());

        // $message = new \App\Models\ChatMessage();
        // $message->sender_id = $this->user->id;
        // $message->receiver_id = $request->input('receiver_id');
        // $message->message = $request->input('message');
        // $message->save();

        $messageData = [
            'sender_id' => $this->user->id,
            'receiver_id' => $request->input('receiver_id'),
            'message' => $request->input('message'),
        ];

        // Broadcast the message to the receiver
        broadcast(new MessageSent($messageData))->toOthers();

        return response()->json(['status' => 'Message sent successfully']);
    }
}
