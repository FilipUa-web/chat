<?php

namespace App\Http\Controllers;

use App\Message;
use App\Rooms;
use Illuminate\Http\Request;
use App\Events\NewmessageAdded;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showRoom($id){

        $message = Message::where('room_id', $id)->get();
        $rooms = Rooms::all();
        return view('chat', compact('message','id','rooms'));
    }

    public function postMessage(Request $request){

        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => request()->get('message'),
            'room_id' => request()->get('room_id'),
        ]);
//        dd(Auth::user()->id);
//          $request->user_id = Auth::user()->id;
//        $message = Message::create($request->all());
        event(
          new NewmessageAdded($message ,$user)
        );
        return redirect()->back();
    }
}
