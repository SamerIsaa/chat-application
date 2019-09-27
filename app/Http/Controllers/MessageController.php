<?php

namespace App\Http\Controllers;


use App\Events\MessageSented;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Validator;
class MessageController extends Controller
{


    public function getMessages(Request $request)
    {

        $request['sender_id'] > $request['reciver_id'] ?
                            $conversion_id = $request['reciver_id'] . $request['sender_id']
                        :   $conversion_id = $request['sender_id'] .  $request['reciver_id'] ;

        $messages = Message::where('conversion_id' , $conversion_id)->get();
        $html = view('messageInstance' , compact('messages'))->render();

       Message::where('conversion_id' , $conversion_id)->update(['readed_at' => now()]);

        return response()->json([
            'status'    => 'success' ,
            'data'      => $html
        ]);

    }

    public function sendMessages(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,[
            'sender_id' => 'required|exists:users,id',
            'reciver_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()){
            return response()->json([
                'status'    => 'error' ,
                'data'      => 'Please Select Reciver User'
            ]);
        }

        $request['sender_id'] > $request['reciver_id'] ?
            $conversion_id = $request['reciver_id'] . $request['sender_id']
            :   $conversion_id = $request['sender_id'] .  $request['reciver_id'] ;
        $data['conversion_id'] = $conversion_id;


        $message = Message::create($data);
        $message['created_at'] = $message->created_at->format('Y-m-d');
        broadcast(new MessageSented($message ))->toOthers();

        $messages = array($message);
        $html = view('messageInstance' , compact('messages'))->render();


        return response()->json([
            'status'    => 'success' ,
            'data'      => $html
        ]);
    }

    public function readMessages(Request $request)
    {

    }
}
