<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use NewChatMessage as GlobalNewChat/Message;

class ChatController extends Controller {
    public function index() {
        return Chat::where('buyer_id', Auth::id())
            ->orWhere('seller_id', Auth::id())
            ->with(['buyer', 'seller'])
            ->get();
    }

   
    public function getBuyerChats($buyer_id)
    {
        $chats = Chat::where('buyer_id', $buyer_id)->get();

        if ($chats->isEmpty()) {
            return response()->json(['message' => 'No active chats found'], 404);
        }

        return response()->json($chats, 200);
    }
    
}
