<?php

namespace App\Http\Livewire;

use App\Message;
use App\Recipent;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Archive extends Component
{
   private $messageId;
    private $users;
    private $user;
    private $messages;
    private $senderId;
    private $senderName;
    private $sender_name;
    private $sender_othername;
    private $subject;
    private $owner;


   public function getMessageId()
    {
        # code...
        $this->messageId = Recipent::where('user_id', Auth::user()->id)->get();
        
    }
    public function getSender($messageId)
    {
        # code...
        $this->messageId = Message::where('id', $messageId);
    }

    

    public function mount()
    {
        $this->user = Recipent::where('user_id', Auth::user()->id)->where('message_status', 2)->get();
        $this->users = $this->user;
        foreach ($this->users as $key => $value) {
            # code...
            $this->messageId = $value['message_id'];
        
        $this->messages = Message::where('id', $this->messageId)->get();
        foreach ($this->messages as $value) {
            $this->senderId = $value['user_id'];
            $this->subject = $value['subject'];
            $this->owner = $value['owner'];
        }

         $this->senderName = User::where('id', $this->senderId)->get();
        foreach ($this->senderName as $value) {
            $this->sender_name = $value['name'];
            $this->sender_othername = $value['othername'];
        }

        $this->users[$key]->name = $this->sender_name;
        $this->users[$key]->othername = $this->sender_othername;
        $this->users[$key]->subject = $this->subject;
        $this->users[$key]->owner = $this->owner;
        $this->users[$key]->id = $this->messageId;
        } 
        //  $this->users = DB::table('recipents')
        //  ->join('users', 'users.id', '=', 'recipents.user_id')
        //  ->join('messages', 'messages.user_id', '=', 'messages.user_id')
        //  ->where('recipents.user_id', Auth::user()->id)->get();
    }
    public function remove($messageId)
    {
        Recipent::where(['message_id' => $messageId, 'user_id' => Auth::user()->id])->delete();
       return $this->mount();

    }
    public function render()
    {
        return view('livewire.archive', ['users'=> $this->users]);
    }
}
