<?php

namespace App\Http\Livewire;

use App\Feedback;
use App\Message as AppMessage;
use App\Recipent;
use App\Response as AppResponse;
use App\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Response extends Component
{
    public $results;
    public $subject;
    public $messages;
    public $description;
    public $photos =[];
    public $sender_email;
    public $messageId;
    public $newId;
    
   
   
   
    public function addNew()
    {
        # code...
        $this->validate([
            'subject' => 'required|max:255',
            'description' => 'required',
            'sender_email' => 'required'
        ]);
        
        $this->results = AppResponse::create([
            'message_id' => $this->messageId,
            'sender' => auth::user()->name. ' '. auth::user()->othername,
            'owner' => $this->sender_email,
            'subject' => $this->subject,
            'description' => $this->description
        ]);
        if ($this->results) {
            Db::table('feedbacks')->where('id', $this->newId)->update(["status" => 2]);

            session()->flash('message', 'Message sent successfully');
           return redirect(route('incoming'));
        }else{
            session()->flash('message', 'Unable to send message');

        }

    }
     public function mount($id)
    {
        $this->messages = Feedback::where('id', $id)->first();  
        $this->subject = $this->messages->subject;
        $this->sender_email = $this->messages->sender;   
        $this->messageId = $this->messages->id;  
        $this->newId = $id; 
        
         
    }
   
    public function render()
    {
        return view('livewire.response');
    }
}
