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


   

    public function remove($id)
    {
        $this->role =Auth::user()->role_id;
        if ($this->role === 1 || $this->role ===2) {
            User::where('id', $id)->delete();
            session()->flash('message', 'User deleted successfully');
        }else{
            session()->flash('message', 'You have no right to delete users');
        }
        

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
       
        return view('livewire.incoming', ['users'=> User::withTrashed()->where('id', '!=', auth::user()->id)->where('role_id', '!=', 1)->paginate(2)]);
    }
}
