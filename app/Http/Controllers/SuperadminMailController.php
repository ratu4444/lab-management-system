<?php

namespace App\Http\Controllers;

use App\Mail\AdminNotificationMail;
use App\Mail\GlobalMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SuperadminMailController extends Controller
{
    public function showMailForm($id)
    {
        $admin = User::whereadmin()->findorfail($id);
        return view('mail.mail-form', compact('admin'));
    }

    public function sendMail(Request $request, $id)
    {
        $message = $request->message;
        $admin = User::whereadmin()->findorfail($id);
        $recipents_mail = $admin->email;

        Mail::to($recipents_mail)->send(new AdminNotificationMail($message, $admin));

        return redirect()->route('control.admin.index')->with('success', 'Mail sent successfully.');
    }
}
