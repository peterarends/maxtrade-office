<?php

namespace App\Http\Controllers;

use App\Mailacount;
use Illuminate\Http\Request;
use App\Http\Resources\Mailacount as MailacountResource;

use function GuzzleHttp\json_decode;

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

    public function updateMailacounts(Request $request)
    {
        $mailacounts = $request->input('mailacounts');
        foreach ($mailacounts as $macount) {
            $mailacount = Mailacount::findOrFail($macount["id"]);
            $mailacount->user_id = $macount["user_id"];
            $mailacount->host = $macount["host"];
            $mailacount->port = $macount["port"];
            $mailacount->encryption = $macount["encryption"];
            $mailacount->validate_cert = $macount["validate_cert"];
            $mailacount->username = $macount["username"];
            $mailacount->password = $macount["password"];
            $mailacount->protocol = $macount["protocol"];
            $mailacount->save();
        }

        return json_encode(["result" => "success"]);
    }
}
