<?php

namespace App\Http\Livewire;

use App\Message as AppMessage;
use App\Recipent;
use App\Response as AppResponse;
use App\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Edit extends Component
{
    public $results;
    public $name;
    public $messages;
    public $description;
    public $photos =[];
    public $othername;
    public $messageId;
    public $newId;
    public $role_id;
    
   
   
   
    public function addNew()
    {
        # code...
        $this->validate([
            'role_id' => 'required'
        ]);
            
        if ($this->role_id === 'activate') {
            User::withTrashed()->where('id', $this->messages->id)->update(['deleted_at' => NULL]);
            session()->flash('message', 'User re-activated successfully');
           return redirect(route('incoming'));
        }else{
            User::where('id', $this->messages->id)->update(['role_id' => $this->role_id]);
            session()->flash('message', 'User activated successfully');
           return redirect(route('incoming'));
        }
        

            

    }
     public function mount($id)
    {
        $this->messages = User::withTrashed()->where('id', $id)->first();  
        $this->name = $this->messages->name;
        $this->othername = $this->messages->othername;   
        $this->messageId = $this->messages->id;  
        
         
    }
   
    public function render()
    {
        return view('livewire.edit');
    }
}
