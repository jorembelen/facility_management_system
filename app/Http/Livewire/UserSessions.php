<?php

namespace App\Http\Livewire;

use App\Models\UserSession;
use Livewire\Component;

class UserSessions extends Component
{
    public function render()
    {
        $sessions = UserSession::whereNotNull('user_id')->get();

        return view('livewire.user-sessions', compact('sessions'))->extends('layouts.master');
    }
}
