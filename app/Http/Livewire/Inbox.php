<?php

namespace App\Http\Livewire;

use App\Message;
use App\Recipent;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Inbox extends Component
{
   
    
    public function render()
    {
        return view('livewire.inbox');
    }
}
