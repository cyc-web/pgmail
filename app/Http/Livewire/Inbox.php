<?php

namespace App\Http\Livewire;

use App\Message;
use App\Recipent;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Inbox extends Component
{
    use WithPagination;
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

    public $search;


    public function searchQuery()
    {
        dd($this->search);
    }

    public function mount()
    {
        $this->user = Recipent::where('user_id', Auth::user()->id)->where('message_status', '!=', '2')->latest()->where('message_id', 'like', '%'.$this->search.'%')->paginate(2);
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
        return $this->users;
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

     public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.inbox', ['users'=> $this->mount()]);
    }
}
