<?php

namespace App\Http\Livewire;

use App\Attachment;
use App\Message;
use App\Recipent;
use App\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class View extends Component
{
    public $messageId;
    public $messages;
    public $sender;
    public $attachments;
    public $recipents;
   
   
    public function mount($id)
    {
        $this->messages = Message::where('id', $id)->first();
        $this->sender = User::where('id', $this->messages->user_id)->first();
        $this->attachments = Attachment::where('message_id', $this->messages->id)->get();
        //$this->recipents = Recipent::where('message_id', $this->messages->id)->get();
        $this->recipents = Db::table('users')->join('recipents', 'users.id', '=', 'recipents.user_id')->where('recipents.message_id', $id)->get()->toArray();
        //Recipent::where('message_id', $id)->update(['message_status' => 1]);
    }
   
    public function render()
    {
        return view('livewire.view');
    }
}
