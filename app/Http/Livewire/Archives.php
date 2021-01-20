<?php

namespace App\Http\Livewire;

use App\Message;
use App\Recipent;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Archives extends Component
{
    use WithPagination;
   public $messageId;
    private $users;
    private $user;
    public $messages;
    public $senderId;
    public $senderName;
    public $sender_name;
    public $sender_othername;
    public $subject;
    public $owner;
    public $search;


    

    public function mount()
    {
         $this->user = Db::table('recipents')->join('messages', 'recipents.message_id', '=','messages.id')->where(['recipents.user_id' => Auth::user()->id, 'recipents.message_status' => 2])->where('recipents.deleted_at', NULL)->where('messages.sender', 'like', '%'.$this->search.'%')->orderBy('messages.id', 'desc')->paginate(2);
        $this->users = $this->user;
        
        return $this->users;
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
        return view('livewire.archives', ['users'=> $this->mount()]);
    }
}
