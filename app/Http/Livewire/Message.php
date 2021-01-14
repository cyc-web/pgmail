<?php

namespace App\Http\Livewire;

use App\Message as AppMessage;
use App\Recipent;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\WithFileUploads;

class Message extends Component
{
    use WithFileUploads;
    public $users;
    public $subject;
    public $description;
    public $person = [];
    public $owner;
    public $photos;
    public $phone;
    public $image =[];
    public $code;
    

    public function addNewMessage()
    {
         $this->validate([
            'person' => 'required',
        ]);
      
        $message = AppMessage::create([
            'user_id' => Auth::user()->id,
            'owner' => $this->owner,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'description' => $this->description
        ]);
        if ($message) {
            foreach ($this->person as $user) {
                $recipent = Recipent::create(['user_id'=>$user, 'message_id'=>$message->id]);
            }
            
            $this->code = substr(str_shuffle($message->subject), 0, 5).rand(00000, 99999);
            Db::table('messages')->where('id', $message->id)->update(['code' => $this->code]);
            if($this->photos){
                foreach ($this->photos as $photo) {
             $path =date("Ymd_His") . '-' . $photo->getClientOriginalName();
             $photo->storeAs('public', $path);
             Db::table('attachments')->insert([
                 'message_code' => $this->code,
                 'message_id' => $message->id,
                 'attachment' => $path
             ]);
            
        
            }
            }
            
            session()->flash('message', 'Message sent successfully');
           return redirect(route('inbox'));
           
        }else{
            session()->flash('message', 'Unable to send message');
        }
    }
    

    public function mount()
    {
        # code...
        $this->users = User::where('id', '!=', Auth::user()->id)->get();
    }
    public function render()
    {
        return view('livewire.message');
    }
}
