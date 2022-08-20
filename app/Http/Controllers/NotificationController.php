<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications.index');
    }

}
