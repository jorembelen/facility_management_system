<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NotificationComponent extends Component
{
    protected $listeners = ['refreshNotification' => '$refresh'];

    public function render()
    {
        $notifications = auth()->user()->unreadNotifications()
        ->where('type', '!=', 'App\Notifications\ChatNotification')
        ->take(5)
        ->get();

        $allNotifications = auth()->user()->unreadNotifications()
        ->where('type', '!=', 'App\Notifications\ChatNotification')
        ->count();


        return view('livewire.notification-component', compact('notifications', 'allNotifications'));
    }

    public function read($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);
        if($notification) {
            $notification->markAsRead();
            $this->emit('refreshNotification');
        }
    }


    public function readAllNotification()
    {
        $notifications = auth()->user()->unreadNotifications()
        ->where('type', '!=', 'App\Notifications\ChatNotification')
        ->get();
        foreach($notifications as $notification){
            $notification->markAsRead();
        }
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'System Notifications Cleared!',
            'text' => '',
        ]);
    }

}
