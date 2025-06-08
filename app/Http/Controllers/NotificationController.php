<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
{
    $notifications = Notification::orderBy('created_at', 'desc')->take(5)->get();
    $unreadCount = Notification::where('viewed', false)->count();

    return view('dashboard', compact('notifications', 'unreadCount'));
}
}
