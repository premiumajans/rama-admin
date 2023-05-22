<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index(Request $request)
    {
        $content = Content::find($request->content_id);
        if (!Mail::where('email', $request->email)->exists()) {
            $mail = new Mail();
            $mail->email = $request->email;
            $mail->save();
        }
        return response()->json([
            'status' => 'success',
            'pdf' => asset($content->pdf),
        ]);
    }
}
