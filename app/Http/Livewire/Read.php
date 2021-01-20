<?php

namespace App\Http\Livewire;

use App\Attachment;
use App\Message as AppMessage;
use App\Recipent;
use App\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Read extends Component
{
    use WithFileUploads;
    public $results;
    public $messageId;
    public $sender;
    public $recipents;
    public $attachments;
    public $message;
    public $messages;
    public $userName;
    public $userOtherName;
    public $user_id;
    public $users;
    public $username;
    public $oname;
    public $subject;
    public $code;
    public $photos = [];
    public $users_id = [];
    public $status;
    public $senderId;
    public $mcode;
    public $use;
    public $uses;
    public $rname;
    public $roname;
    public $person;


    
   
    public function reply()
    {
        $this->validate([
            'message' => 'required'
        ]);
        $response = AppMessage::create([
            'sender' => auth::user()->name. ' ' .auth::user()->othername,
            'sender_id' => auth::user()->id,
            'subject' => $this->subject,
            'description' => $this->message,
            'code' => $this->code,

        ]);
        if ($response) {
            # code...
            if ($this->senderId === Auth::user()->id) {
                # code...
            }else{
                $recipent = Recipent::create(['user_id'=>$this->senderId, 'message_id'=>$response->id]);

            }
            
            if($this->photos){
                foreach ($this->photos as $photo) {
                    $path =date("Ymd_His") . '-' . $photo->getClientOriginalName();
                    $photo->storeAs('public', $path);
                    Db::table('attachments')->insert([
                        'message_code' => $this->code,
                        'message_id' => $response->id,
                        'attachment' => $path
                    ]);
                    
                
                }
            }
            session()->flash('message', 'Message replied successfully');
            return redirect(route('inbox'));

        }else{
            session()->flash('message', 'Unable to send message');
        }
    }
 
    
    
    public function mount($id)
    {
        $this->messageId = $id;
        $this->userName = auth::user()->name;
        $this->userOtherName = auth::user()->othername;

        $this->mcode = AppMessage::where('id', $this->messageId)->first();
        



        $this->results = AppMessage::where('code', $this->mcode->code)->orderBy('id', 'desc')->get();
        foreach ($this->results as $key => $value) {
            $this->use = $value['user_id'];
            $this->ids = $value['id'];
            $this->attachments = Attachment::where('message_id', $this->ids)->orderBy('id', 'desc')->get();
      
        $this->results[$key]->rname = $this->use;
        $this->results[$key]->attachments = $this->attachments;
        }
       
        
         
        $this->sender = $this->mcode->sender;
        $this->recipents =Recipent::where('message_id', $this->mcode->id)->get();
        //$this->attachments = Attachment::where('message_code', $this->mcode->code)->orderBy('id', 'desc')->get();
        foreach ($this->recipents as $key => $value) {
            $this->user_id = $value['user_id'];
            $this->users = User::where('id', $this->user_id)->get();
            foreach ($this->users as $value) {
                # code...
                $this->username = $value['name'];
                $this->oname = $value['othername'];
            }
        
        $this->recipents[$key]->fname = $this->username;
        $this->recipents[$key]->oname = $this->oname;
        }
        $this->subject = $this->mcode->subject;
        $this->code = $this->mcode->code;
        $this->senderId = $this->mcode->sender_id;
        $this->status = Recipent::where(['message_id' => $this->messageId, 'user_id' => auth::user()->id])->first();
        if ($this->status->message_status == 1) {
            Recipent::where(['message_id' => $this->messageId, 'user_id' => auth::user()->id])->update(['message_status' => 0]);
        }else{

        }

        $this->users = User::where('id', '!=', Auth::user()->id)->get();
    }
   
    public function render()
    {
        return view('livewire.read');
    }
}
