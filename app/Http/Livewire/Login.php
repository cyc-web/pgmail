<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $form =[
        'email' => '',
        'password' => ''
    ];
    public function submit()
    {
       $this->validate([
            'form.email' => 'required',
            'form.password' => 'required',
        ]);
        if (Auth::attempt($this->form)) {
            # code...
            return redirect(route('inbox'));
        }else{
            $this->form['password'] ='';
            session()->flash('message', 'Invalid email/password');
        }
        
    }
    public function render()
    {
        return view('livewire.login');
    }
}
