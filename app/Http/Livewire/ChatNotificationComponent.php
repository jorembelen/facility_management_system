<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChatNotificationComponent extends Component
{
    protected $listeners = ['refreshNav' => '$refresh'];

    public function render()
    {
        $chatNotifications = auth()->user()->unreadNotifications()
        ->where('type', 'App\Notifications\ChatNotification')
        ->take(5)
        ->get();

        $totalNotifications = auth()->user()->unreadNotifications()
        ->where('type', 'App\Notifications\ChatNotification')
        ->count();

        return view('livewire.chat-notification-component', compact('chatNotifications', 'totalNotifications'));
    }

    public function clear()
    {
        $notifications = auth()->user()->unreadNotifications()
            ->where('type', 'App\Notifications\ChatNotification')
            ->get();
            foreach($notifications as $notification){
                $notification->markAsRead();
            }
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Chat Notifications Cleared!',
            'text' => '',
        ]);
    }

    public function read($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);
        if($notification) {
            $notification->markAsRead();
            $this->emit('refreshNav');
        }
    }

}
