<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
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
        Auth::attempt($this->form);
        return redirect(route('inbox'));
    }
    public function render()
    {
        return view('livewire.home');
    }
}
