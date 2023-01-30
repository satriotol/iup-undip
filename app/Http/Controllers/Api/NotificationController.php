<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kutia\Larafirebase\Facades\Larafirebase;

class NotificationController extends Controller
{
    public function notification(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required'
        ]);
        try {
            $fcmTokens = User::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
            //Notification::send(null,new SendPushNotification($request->title,$request->message,$fcmTokens));

            /* or */

            //auth()->user()->notify(new SendPushNotification($title,$message,$fcmTokens));

            /* or */

            Larafirebase::withTitle('$request->title')
                ->withBody('$request->message')
                ->sendMessage($fcmTokens);
            return ResponseFormatter::success('', 'success');
        } catch (\Exception $e) {
            report($e);
            return ResponseFormatter::error($e, 'success');
            // return redirect()->back()->with('error', 'Something goes wrong while sending notification.');
        }
    }
}
