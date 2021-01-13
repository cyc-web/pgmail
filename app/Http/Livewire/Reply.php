<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Reply extends Component
{
    public $users;
    public $subject;
    public $description;
    public $person = [];
    public $owner;
    public $image;
    public $phone;

    protected $listeners = ['fileUpload' => 'handleFileUpload'];

    public function handleFileUpload($image)
    {
        $this->image = $image;
    }
    public function storeImage()
    {
        if (!$this->image) {
            return null;
        }
        $img = Image::make($this->image)->encode('jpg');
        $name = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;
    }

    public function reply()
    {
         $this->validate([
            'description' => 'required',
        ]);
       $image = $this->storeImage();
        $message = AppMessage::create([
            'user_id' => Auth::user()->id,
            'owner' => $this->owner,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'description' => $this->description,
            'attachment' => $image
        ]);
        if ($message) {
            foreach ($this->person as $user) {
                $recipent = Recipent::create(['user_id'=>$user, 'message_id'=>$message->id]);
            }
            session()->flash('message', 'Message sent successfully');
           return redirect(route('inbox'));
           
        }else{
            session()->flash('message', 'Unable to send message');
        }
    }

    public function render()
    {
        return view('livewire.reply');
    }
}
