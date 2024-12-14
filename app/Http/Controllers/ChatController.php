<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\Chat;
use Illuminate\Http\Request;
// use NewChatMessage as GlobalNewChat/Message;

class ChatController extends Controller {
    public function getMessages(Request $request) {
        return Chat::where('seller_id', $request->seller_id)
                   ->where('buyer_id', $request->buyer_id)
                   ->orderBy('created_at', 'asc')
                   ->get();
    }

    public function sendMessage(Request $request) {
        $chat = Chat::create([
            'buyer_id' => $request->buyer_id,
            'seller_id' => $request->seller_id,
            'message' => $request->message,
        ]);

        broadcast(new NewChatMessage($chat))->toOthers();

        return response()->json($chat, 201);
    }
}
