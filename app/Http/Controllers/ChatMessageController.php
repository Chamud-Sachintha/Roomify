<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function showMessagesPage()
    {
        return view('app.admin.messages')->with(['user' => $this->user, 'breadcrumb' => 'Message Inbox']);
    }
}
