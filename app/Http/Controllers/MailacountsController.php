<?php

namespace App\Http\Controllers;

use App\Mailacount;
use Illuminate\Http\Request;
use App\Http\Resources\Mailacount as MailacountResource;

class MailacountsController extends Controller
{
    public function index(Request $request)
    {
        /** Get Mailacounts */
        $mailacounts = Mailacount::where(['user_id' => $request->id])
            ->get();

        /** Return collection of Mailacounts as resource */
        return MailacountResource::collection($mailacounts);
    }
}
