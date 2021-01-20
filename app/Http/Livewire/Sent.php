<?php

namespace App\Http\Livewire;

use App\Message;
use App\Recipent;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Sent extends Component
{
    private $messages;
    private $user;
    private $users;
    private $messageId;
    private $senderId;
    private $sender_name;
    private $sender_othername;

    public function mount()
    {
        $this->user = Message::where(['sender' => Auth::user()->name. ' ' .Auth::user()->othername, 'status' => 1])->latest()->paginate(2);
        $this->users = $this->user;
        foreach ($this->users as $key => $value) {
            # code...
            $this->messageId = $value['id'];
        
        $this->messages = Recipent::where('message_id', $this->messageId)->get();
        foreach ($this->messages as $value) {
            $this->senderId = $value['user_id'];
        }

         $this->senderName = User::where('id', $this->senderId)->get();
        foreach ($this->senderName as $value) {
            $this->sender_name = $value['name'];
            $this->sender_othername = $value['othername'];
        }

        $this->users[$key]->name = $this->sender_name;
        $this->users[$key]->othername = $this->sender_othername;
        $this->users[$key]->id = $this->messageId;
        }
        // $this->messages = Db::table('users')->join('recipents', 'users.id', '=', 'recipents.user_id')->join('messages', 'messages.id', '=', 'recipents.message_id')->where('messages.user_id', Auth::user()->id)->groupBy('messages.user_id')->get();
    }

    public function remove($messageId)
    {
        # code...
         Message::where(['id' => $messageId, 'user_id' => Auth::user()->id])->update(['status' => 0]);

        return $this->mount();
    }
    public function render()
    {
        return view('livewire.sent', ['messages' => $this->users]);
    }
}
