<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;


class Profile extends Component
{
    use WithFileUploads;
    public $showPassword = false;
    public $password, $password_confirmation, $image;
    protected $listeners = ['refreshProfile' => '$refresh'];

    public function toggleOn()
    {
        $this->showPassword = true;
    }

    public function toggleOff()
    {
        $this->showPassword = false;
    }

    public function update()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-form');
        $this->image = '';
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function updateProfile(User $user)
    {
        $this->validate([
            'password' => 'nullable|min:6|confirmed'
        ]);


            DB::beginTransaction();
            if($user){
                if($this->password)
                {
                    $user->password = $this->password;
                    $user->update(['password' => $this->password]);
                }elseif($this->image){
                    $user->updateProfile($this->image);
                }

                DB::commit();
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'success',
                    'title' => 'Your profile was updated successfully.',
                    'text' => '',
                    ]);
                $this->password = null;
                $this->password_confirmation = null;
                $this->image = '';
                $this->dispatchBrowserEvent('hide-form');
                $this->emit('refreshProfile', 'refreshNotification');
                return redirect()->back();
            }else{
                DB::rollBack();
                return redirect()->back();
            }

    }

    public function render()
    {
        $user = User::find(auth()->id());

        return view('livewire.users.profile', compact('user'))->extends('layouts.master');
    }
}
