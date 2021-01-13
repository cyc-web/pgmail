<?php

namespace App\Http\Livewire;

use App\Message as AppMessage;
use App\Recipent;
use App\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Read extends Component
{
    private $results =[];
    public $messageId;
    private $messages;
    private $user_id;
    private $emails;
    private $name;
    private $othername;
    private $status;
    private $mstatus;
    private $code;
    private $attachments;
    
   
    public function read($id)
    {
        $this->messageId = $id;
    }
    public function mount($id)
    {
        $this->messages = Recipent::where('message_id', $id)->get();
        foreach ($this->messages as $key => $value) {
            # code...
            $this->user_id = $value['user_id'];
            $this->emails = User::where('id', $this->user_id)->get();
            foreach ($this->emails as $value) {
                # code...
                $this->name = $value['name'];
                $this->othername = $value['othername'];
            }
            $this->messages[$key]->rname = $this->name;
            $this->messages[$key]->rothername = $this->othername;
        }
         $this->results =Db::table('users')->join('messages', 'users.id', '=', 'messages.user_id')->where('messages.id', $id)->get();
         $this->mstatus = Recipent::where(['message_id' => $id, 'user_id' => Auth::user()->id])->first();
         $this->status = $this->mstatus->message_status;
         if ($this->status == 1) {
            
         }elseif ($this->status == 2) {
             # code...
         }else{
            Recipent::where(['message_id' => $id, 'user_id' => Auth::user()->id])->update(['message_status' => 1]);
         }

         $this->code = Db::table('messages')->where('id', $id)->first();
         $this->attachments = Db::table('attachments')->where('message_code', $this->code->code)->get();
         
    }
   
    public function render()
    {
        return view('livewire.read', ['messages'=> $this->results, 'recipents'=> $this->messages, 'attachments' => $this->attachments]);
    }
}
