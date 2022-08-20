<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use Livewire\Component;
use App\Models\ClientAppointment;

class LivewireChat extends Component
{
    public $rowId;

    public function chat($rowId)
    {
        $chats = Chat::whereclient_appointment_id($rowId)->orderBy('created_at', 'asc')->get();
    }

    public function render()
    {

        $chatss = Chat::whereclient_appointment_id($this->rowId)->orderBy('created_at', 'asc')->get();
        

        return view('livewire.livewire-chat', ['chats' => $chatss]);
    }
}
