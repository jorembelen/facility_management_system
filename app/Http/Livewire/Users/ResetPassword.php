<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Component
{
    public $password, $new_confirm_password;
    public $showPassword = false;

    public function show()
    {
        $this->showPassword = true;
    }

    public function hide()
    {
        $this->showPassword = false;
    }

    public function resetPassword()
    {
       $this->validate([
            'password' => 'required|min:6',
            'new_confirm_password' => 'required|same:password'
       ],
       [
            'new_confirm_password.required' => 'Please confirm password.',
            'new_confirm_password.same' => 'Your password did not match.'
       ]
    );

       if(Hash::check($this->password, auth()->user()->password)){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Failed, Create a new password.',
                'text' => '',
                ]);
        }else{
            $user = User::findOrFail(auth()->id());
            $user->update([
                'reset' => 1,
                'password' => $this->password
            ]);
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Success, password was changed successfully.',
                'text' => '',
                ]);
            return redirect()->route('home');
        }

    }

    public function render()
    {
        return view('livewire.users.reset-password')->extends('layouts.guest');
    }
}
