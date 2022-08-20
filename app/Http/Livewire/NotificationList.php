<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class NotificationList extends Component
{
    public $amount = 5;
    public $item;
    public $user;

    protected $listeners = ['clear'];


    public function render()
    {
        $user = User::find(auth()->id());
        $notifications = $user->notifications()->take($this->amount)->get();
        $totalNotifications = $user->notifications()->count();

        return view('livewire.notification-list', compact('notifications', 'totalNotifications'));
    }

    public function load()
    {
        $this->amount += 5;
    }

    public function deleteConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Are you sure? This will remove all your notifications.',
            'text' => '',
        ]);
    }

    public function clear()
    {
        $user = User::find(auth()->id());
        $notifications = $user->notifications()->get();
        if($notifications->count() > 0){
            foreach($notifications as $notification){
                $notification->delete();
            }

                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'success',
                    'title' => 'Notification Cleared!',
                    'text' => '',
                ]);
        }else{
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'No Notification!',
                'text' => '',
            ]);
        }

        $this->emit('refreshNotification');
        return redirect()->back();
    }

}
