<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{


    public function createChat(Request $request)
{
    $request->validate([
        'buyer_id' => 'required',
        'seller_id' => 'required',
    ]);

    // Create or get existing chat
    $chat = Chat::firstOrCreate(
        [
            'buyer_id' => $request->buyer_id, 
            'seller_id' => $request->seller_id
        ]
    );

    return response()->json($chat, 201);  // Ensure correct response
}

    public function getMessages($chat_id) {
        return Chat::where('id', $chat_id)->with('messages')->get();
    }

    public function sendMessage(Request $request) {
        $validator = Validator::make($request->all(), [
            'chat_id' => 'required',
            'sender_id' => 'required',
            'message' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $message = Message::create([
            'chat_id' => $request->chat_id,
            'sender_id' => $request->sender_id,
            'message' => $request->message
        ]);
    
        broadcast(new NewChatMessage($message))->toOthers();
    
        return response()->json($message, 201);
    }
    
}
