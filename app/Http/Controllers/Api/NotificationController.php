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
            if ($request->user_id) {
                $test = Larafirebase::withTitle($request->title)
                    ->withBody($request->message)
                    ->sendMessage(User::find($request->user_id)->fcm_token);
            } else {
                $test = Larafirebase::withTitle($request->title)
                    ->withBody($request->message)
                    ->sendMessage(Auth::user()->fcm_token);
            }
            //Notification::send(null,new SendPushNotification($request->title,$request->message,$fcmTokens));

            /* or */

            //auth()->user()->notify(new SendPushNotification($title,$message,$fcmTokens));

            /* or */


            return ResponseFormatter::success($test, 'success');
        } catch (\Exception $e) {
            report($e);
            return ResponseFormatter::error($e, 'success');
            // return redirect()->back()->with('error', 'Something goes wrong while sending notification.');
        }
    }
}
