<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\ClientAppointment;
use App\Notifications\ChatNotification;
use Illuminate\Support\Facades\Notification;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chats = Chat::orderBy('created_at', 'asc')->get();
        return $chats;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Chat::create($request->all());

        $user = ClientAppointment::whereid($request->client_appointment_id)->first();
        $user = $user->user_id;

        $sender = auth()->id();
        $image = auth()->id();

        if($sender == $user)
        {
            $admin = User::where('role', 'supervisor')
                    ->orWhere('role', 'scheduler')
                    ->get();
        }else{
            if(auth()->user()->role == 'supervisor')
            {
                $admin = User::where('role', 'scheduler')
                        ->orWhere('badge', $user)
                        ->get();
                    }else{
                        $admin = User::where('role', 'supervisor')
                                      ->orWhere('id', $user)
                                      ->get();
                    }
        }

        $url = route('client-appointments.show', $request->client_appointment_id);

        $details = [
            'body' => 'New message from '.$request->user_name,
            'url' => $url,
            'sender' => $image,
        ];

        Notification::send($admin, new ChatNotification($details));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $appointment = ClientA
        // return view('livewire.livewire-chat', compact('chat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
