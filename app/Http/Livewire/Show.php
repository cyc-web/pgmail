<?php

namespace App\Http\Livewire;

use App\Attachment;
use App\Feedback;
use App\Message as AppMessage;
use App\Recipent;
use App\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    private $results =[];
    public $messageId;
    public $messages;
    public $attachments;
    public $newId;
    public $description;
    public $subject;
    public $status;
    

    
   
  
    public function mount($id)
    {
        $this->messageId = $id;
        $this->messages = Feedback::where('id', $id)->first();
        $this->message_id = Db::table('feedbacks')->where('id', $id)->first();
        $this->msgId = $this->message_id->id;
        $this->attachments = Attachment::where('message_id', $this->msgId)->get();
        $this->status = Feedback::where('id', $id)->first();
        if ($this->status->status == 1) {
            # code...
            Db::table('feedbacks')->where('id', $id)->update(["status" => 0]);
        }else{

        }
        
        
        
         
    }
       public function sendMessage()
   {
       # code...
       $this->validate([
           'description' => 'required'
       ]);
       
       dd($this->description);
   }
  
    public function render()
    {
        return view('livewire.show');
    }
}
