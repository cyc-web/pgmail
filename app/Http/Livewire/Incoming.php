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
    public function mount()
    {
        if (Auth::user()->role_id === 1) {
         
         $this->user = User::withTrashed()->where('id', '!=', auth::user()->id)->where('role_id', '!=', 1)->where('name', 'like', '%'.$this->search.'%')->paginate(1);
        }else{
            $this->user = User::withTrashed()->where('id', '!=', auth::user()->id)->where('role_id', '!=', 1)->where('unit', '=', auth::user()->unit)->where('name', 'like', '%'.$this->search.'%')->paginate(1);
        }
         return $this->user;

    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
       
        return view('livewire.incoming', ['users'=> $this->mount()]);
    }
}
