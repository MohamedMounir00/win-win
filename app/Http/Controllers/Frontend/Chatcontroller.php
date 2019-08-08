<?php

namespace App\Http\Controllers\Frontend;

use App\Chat;
use App\Conversation;
use App\Http\Resources\Frontend\ChatCollection;
use App\Http\Resources\Frontend\ConversationCollection;
use App\User;
use http\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Chatcontroller extends Controller
{
    //

    public function __construct()
    {


        $this->middleware('NotActive');
        $this->middleware('auth');

    }
        ///get all message  in view chat
    public function fetchMessages(Request $request)
    {
        $id= $request->id;
      if (auth()->user()->id!=$id)
       {

            return view('frontend.pages.chat',compact('id'));
    }
      else
      return redirect()->route('get_profile_view',$id);


    }

    public  function send_message(Request $request)
    {
        $text = trim($request->message);

        $sender_id=auth()->user()->id;
        $receiver_id=$request->receiver_id;
        $ids = [$sender_id, $receiver_id];
        $conversation=Conversation::whereIn('sender_id',$ids)->whereIn('receiver_id',$ids)->first();
        if ($conversation)
        {
           $message= Chat::create([
                'sender_id'=>$sender_id,
                'receiver_id'=>$receiver_id,
                'conversation_id'=>$conversation->id,
                'message'=>$text,
            ]);
            $conversation->update(['updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
            return new ChatCollection($message);
        }
        else{
            $new_conversation=Conversation::create([
                'sender_id'=>$sender_id,
                'receiver_id'=>$receiver_id,
            ]);

            $message= Chat::create([
                'sender_id'=>$sender_id,
                'receiver_id'=>$receiver_id,
                'conversation_id'=>$new_conversation->id,
                'message'=>$text,
            ]);
            return new ChatCollection($message);

        }


    }

    // get message By conversation_id
    public function get_message(Request $request)
    {
        $auth=auth()->user()->id;

        $offset=$request->offset_id;
        $conversation_id=$request->conversation_id;
      $collection = Chat::where('conversation_id',$conversation_id)->where('receiver_id',$auth)->where('seen',false)->update(array('seen' => true));
      //  $collection;
        $message= Chat::where('conversation_id',$conversation_id)->where(function ($query) use ($auth) {
            $query->where('sender_id',$auth)->Orwhere('receiver_id',$auth);
        })->orderByDesc('created_at')->skip($offset)->take(10)->get()->sortBy('created_at');
        return  ChatCollection::collection($message);

    }

    //get all conversation
    public function  get_conversation(Request $request)
    {
        $offset=$request->offset_id;

       $auth=auth()->user()->id;

        $conversation=Conversation::where(function ($query) use ($auth) {
            $query->where('sender_id',$auth)->Orwhere('receiver_id',$auth);
        })->orderByDesc('updated_at')->skip($offset)->take(10)->get();

        return ConversationCollection::collection($conversation);

    }

    public function  get_conversationunseen(Request $request)
    {
        $offset=$request->offset_id;

        $auth=auth()->user()->id;
        $message= Chat::where('receiver_id',$auth)->where('seen',false)->skip($offset)->take(10)->get();
        return  ChatCollection::collection($message);

    }

}
