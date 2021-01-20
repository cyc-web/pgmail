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
        $this->user = Db::table('recipents')->join('messages', 'recipents.message_id', '=','messages.id')->where('recipents.user_id', Auth::user()->id)->where('recipents.message_status', '!=', '2')->where('recipents.deleted_at', NULL)->where('messages.sender', 'like', '%'.$this->search.'%')->orderBy('messages.id', 'desc')->paginate(2);
        $this->users = $this->user;
        
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
