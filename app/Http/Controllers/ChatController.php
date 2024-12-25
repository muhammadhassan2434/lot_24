<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\Account;
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

    public function getChatId($selle_id){
        return Chat::where('seller_id',$selle_id)->get();
    }
    public function chatId(Request $request)
    {
        $buyer_id = $request->buyerId;
        $seller_id = $request->sellerId;
    
        // Query the chat based on buyer_id and seller_id
        $chat = Chat::where('buyer_id', $buyer_id)
                    ->where('seller_id', $seller_id)
                    ->first();
    
        if ($chat) {
            return response()->json(['id' => $chat->id], 200);
        } else {
            return response()->json(['message' => 'Chat not found'], 404);
        }
    }
    
   
    public function getBuyerChats($buyer_id)
    {
        $chats = Chat::where('buyer_id', $buyer_id)->get();

        if ($chats->isEmpty()) {
            return response()->json(['message' => 'No active chats found'], 404);
        }

        return response()->json($chats, 200);
    }
    


    // get account info 
    public function  getAccountInfo($id){
        return Account::find($id);
    }
}
