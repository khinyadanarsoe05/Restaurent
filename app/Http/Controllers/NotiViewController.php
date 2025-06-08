<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotiViewController extends Controller
{   public function view($id){
    $noti = Notification::findOrFail($id);
    $noti->viewed = true;
    $noti->save();

}
}
