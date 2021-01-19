<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $user;
    public $surname;
    public $othername;
    public $title;
    public $telephone;
    public $passport;
    public $name;

    public $filename;
    public $image;

 

    public function updateUser()
    {
       
        if($this->image) {
            
            $path =date("Ymd_His") . '-' . $this->image->getClientOriginalName();
            if (auth::user()->passport) {
                
                Storage::delete('/public/profile/' . auth::user()->passport);
            }
            $this->image->storeAs('public/profile', $path);
            $this->filename = $path;
        }else{
            $this->filename = NULL;
        }
        $update = User::find(Auth::user()->id)->update([
            'title' => $this->title,
            'name' => $this->surname,
            'othername' => $this->othername,
            'telephone' => $this->telephone,
            'passport'  => $this->filename,
        ]);
        if ($update) {
          
            session()->flash('message', 'Profile Updated successfully');
            return $this->mount();
           
        }else{
            session()->flash('message', 'Unable to update profile');
        }
    }
   
    public function mount()
    {
        $this->user = User::where('id', Auth::user()->id)->first();
        $this->surname = $this->user->name;
        $this->othername = $this->user->othername;
        $this->title = $this->user->title;
        $this->telephone = $this->user->telephone;
        $this->passport = $this->user->passport;
    }
    public function render()
    {
        return view('livewire.profile');
    }
}
