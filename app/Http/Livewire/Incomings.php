<?php

namespace App\Http\Livewire;

use App\Message;
use App\Recipent;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Incomings extends Component
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
        $this->users = Db::table('feedbacks')->orderBy('id', 'desc')->get();
       
    }
    public function archive($messageId)
    {
        Recipent::where(['message_id' => $messageId, 'user_id' => Auth::user()->id])->update(['message_status' => 2]);
        return $this->mount();

    }

    public function remove($messageId)
    {
        Recipent::where(['message_id' => $messageId, 'user_id' => Auth::user()->id])->delete();
       return $this->mount();

    }
    public function render()
    {
        return view('livewire.incomings', ['users'=> $this->users]);
    }
}
