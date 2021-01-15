<?php

namespace App\Http\Livewire;

use App\Feedback;
use App\Message;
use App\Recipent;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Incoming extends Component
{
    use WithPagination;


    public $search;

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

    


    public function remove($messageId)
    {
        Recipent::where(['message_id' => $messageId, 'user_id' => Auth::user()->id])->delete();
       return $this->mount();

    }

    public function submit()
    {
        dd($this->search);
    }

    public function edit()
    {
    }
    public function render()
    {
        return view('livewire.incoming', ['users'=> Feedback::latest()->paginate(2)]);
    }
}
