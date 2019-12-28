<?php

namespace App\Http\Controllers;

use App\Events\ChatMessage;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user) {
            /** @var Message $message */
            $message = $user->messages()->create([
                'message' => $request->input('message')
            ]);

            broadcast(new ChatMessage($message->fresh()))->toOthers();
        } else {
            return response()->json(['error' => 'unauthorized']);
        }

        return response()->json(['user_id' => $user->getKey(), 'message' => $message->message]);
    }
}
