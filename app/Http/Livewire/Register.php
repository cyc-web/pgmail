<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public $form =[
        'title' => '',
        'name' => '',
        'othername' => '',
        'unit' => '',
        'email' => '',
        'telephone' => '',
        'password' => '',
        'password_confirmation' => '',
    ];
    public function submit()
    {
        $this->validate([
            'form.title' => 'required',
            'form.name' => 'required',
            'form.othername' => 'required',
            'form.unit' => 'required',
            'form.email' => 'required',
            'form.telephone' => 'required',
            'form.password' => 'required|confirmed',
        ]);
        $user = User::create($this->form);
        Auth::login($user);
        return redirect(route('inbox'));
    }
    public function render()
    {
        return view('livewire.register');
    }
}
