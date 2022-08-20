<?php

namespace App\Http\Livewire;

use App\Models\ApplicationLog;
use App\Models\Building;
use App\Models\CategoryOption;
use App\Models\Chat;
use App\Models\ClientAppointment;
use App\Models\MaintenanceLocation;
use App\Models\User;
use App\Models\UserChatView;
use App\Notifications\ChatNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class AppointmentDetails extends Component
{
    public $message, $appId, $cancellation_reason, $cancellation_comments, $appointmentInfo, $options, $photos,
    $job_description, $job_location, $locations, $totalNotifications;
    public $chatView = false;
    public $updateShow = false;
    protected $listeners = ['refreshChat' => '$refresh'];

    protected $rules = [
        'message' => 'required|max:255',
    ];

    protected $messages = [
        'message.required' => 'Please type your message.',
    ];

    public function message($appointmentId)
    {
        $this->chatView = true;
    }



    public function mount($appointmentId)
    {
        session()->put('previousRoute', url()->previous());
        $this->appointmentId = $appointmentId;
    }

    public function render()
    {
        $chats = Chat::whereclient_appointment_id($this->appointmentId)->orderBy('created_at', 'asc')->get();
        $appointment = ClientAppointment::findOrFail($this->appointmentId);
        if(auth()->user()->role == 'tenant' && $appointment->user_id != auth()->id()) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'You are not allowed to view this record!',
                'text' => '',
            ]);
            return back();
        }

        $today = now();
        $dateAllowed = $today->addDays(1);

        $jobOrders =   $appointment->jobOrder;
        if(!$jobOrders) {
            $jobOrders = null;
        }

        return view('livewire.appointment-details', compact('appointment', 'dateAllowed', 'dateAllowed', 'chats', 'jobOrders'))->extends('layouts.master');
    }


    public function close()
    {
        $this->dispatchBrowserEvent('hide-form');
    }

    public function cancel(ClientAppointment $appointment)
    {
        $this->dispatchBrowserEvent('show-cancelApp-form');
        $this->appId = $appointment->id;
    }

    public function edit(ClientAppointment $appointment)
    {
        $this->dispatchBrowserEvent('show-updateApp-form');
        $this->dispatchBrowserEvent('reApplySelect2');
        $this->updateShow = true;
        $this->options = CategoryOption::wherework_category_id($appointment->work_category_id)->get();
        $this->locations = MaintenanceLocation::wherefacility_type_id($appointment->building->type->id)->get();
        $this->appId = $appointment->id;
        $this->job_location = explode(', ', $appointment->job_location);
        $this->appointmentInfo = $appointment;
    }



    public function cancelAppointment(ClientAppointment $appointment)
    {
        $data = $this->validate([
            'cancellation_reason' => 'required',
            'cancellation_comments' => 'required_if:cancellation_reason,Others',
        ]);
        $today = Carbon::today();
        $dateAllowed = $today->addDays(1);
        if($appointment->date <= $dateAllowed && auth()->user()->isTenant())
        {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Sorry, You cannot cancel appointment within 24 hours period!',
                'text' => '',
            ]);
            $this->dispatchBrowserEvent('hide-form');
            return back();
        }

        DB::beginTransaction();
        if($appointment) {
            $data['appointment_id'] = $appointment->id;
            $appointment->cancelAppointment($data);
            ApplicationLog::create([
                'log_info' => 'Appointment ID: ' .$appointment->id .' was cancelled by ' .auth()->user()->name,
            ]);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Appointment ID: ' .$appointment->id . ' was successfully cancelled!',
                'text' => '',
            ]);
            $this->dispatchBrowserEvent('hide-form');
                }else{
                    DB::rollBack();
                }
            }

            public function chatMe($id)
            {
                $this->dispatchBrowserEvent('scrollDown');
                $this->dispatchBrowserEvent('show-chat-form');
                $chats = UserChatView::whereuser_id(auth()->id())->whereappointment_id($id)->where('read_at', NULL)->get();
                if($chats) {
                    foreach($chats as $chat){
                        $chat->update(['read_at' => now()]);
                    }
                }
            }

            public function sendMessage(ClientAppointment $appointment)
            {
                $this->validate();

                DB::beginTransaction();
                if($appointment){
                $chat = Chat::create([
                        'user_id' => auth()->id(),
                        'client_appointment_id' => $appointment->id,
                        'message' => $this->message,
                    ]);
                    $tenant = User::find($appointment->user_id);
                    $user = ClientAppointment::whereid($appointment->id)
                    ->wherebuilding_id($tenant->building->id)
                    ->pluck('user_id')
                    ->first();

                    $sender = auth()->id();

                    if($user == $sender){
                        $admin = User::whereNotIn('role', ['super_admin', 'admin', 'staff', 'tenant', 'representative', 'assigner'])
                        ->get();
                    }else{
                        $admin = User::where('badge', $user)
                        ->orWhereNotIn('badge', [$sender])
                        ->whereNotIn('role', ['super_admin', 'admin', 'staff', 'tenant', 'representative', 'assigner'])
                        ->get();
                    }




                    $url = route('appointment.info', $appointment->id);

                    $details = [
                        'body' => 'New message from '.auth()->user()->name,
                        'url' => $url,
                        'appId' => $appointment->id,
                        'sender' => $sender,
                    ];

                    // $userBadge = User::where('badge', $user)
                    // ->orWhereNotIn('badge', [$sender])
                    // ->whereNotIn('role', ['super_admin', 'admin', 'staff', 'tenant', 'representative', 'assigner'])
                    // ->get();
                    $badges = $admin->pluck('badge');
                    $count = count($badges);
                    // dd($badges);
                    Notification::send($admin, new ChatNotification($details));
                    DB::commit();

                    for ($i=0; $i < $count; $i++) {
                        $output = new UserChatView();
                        $output->chat_id = $chat->id;
                        $output->appointment_id = $appointment->id;
                        $output->user_id = $badges[$i];
                        $output->save();
                    }
                    $this->message = '';
                    $this->emit('refreshChat');
                }else{
                    DB::rollBack();
                    return redirect()->back();
                }

            }

        }
