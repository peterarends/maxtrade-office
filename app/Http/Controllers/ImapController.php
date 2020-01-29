<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\IMAP\Client;
use \Html2Text\Html2Text;

class ImapController extends Controller
{
    public function index(Request $request)
    {
        $oClient = new Client([
            'host'          => 'avalonbg.com',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => false,
            'username'      => 'home@avalonbg.com',
            'password'      => '1Ivan@Ivanov9',
            'protocol'      => 'imap'
        ]);

        //Connect to the IMAP Server
        $oClient->connect();

        //Get Inbox Mailboxes
        $aFolder = $oClient->getFolders();

        $imaps = [];
        foreach ($aFolder as $oFolder) {
            //Get all messages
            $aMessage = $oFolder->messages()->all()->get();
            foreach ($aMessage as $oMessage) {
                if ($oMessage->hasHTMLBody()) {
                    $html2TextConverter = new Html2Text($oMessage->getHTMLBody());
                    $html = $html2TextConverter->getText();
                } else {
                    $html = $oMessage->getTextBody();
                }

                $imap = [
                    "id" => $oMessage->getUid(),
                    "fromName" => $oMessage->getFrom()[0]->personal ? $oMessage->getFrom()[0]->personal : "",
                    "fromAddress" => $oMessage->getFrom()[0]->mail ? $oMessage->getFrom()[0]->mail : "",
                    "toString" => "",
                    "subject" => $oMessage->getSubject(),
                    "date" => $oMessage->getDate(),
                    "html" => $html
                ];
                $imaps[] = $imap;
            }
        }

        /** Return collection of Imaps as resource */
        return json_encode($imaps);
    }

    public function destroy($id)
    {
        $oClient = new Client([
            'host'          => 'avalonbg.com',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => false,
            'username'      => 'home@avalonbg.com',
            'password'      => '1Ivan@Ivanov9',
            'protocol'      => 'imap'
        ]);

        //Connect to the IMAP Server
        $oClient->connect();

        //Get Inbox Mailboxes
        $aFolder = $oClient->getFolders();

        foreach ($aFolder as $oFolder) {
            $oMessage = $oFolder->getMessage($id);
            if (!empty($oMessage)) {
                $oMessage->delete();
            }
        }
    }
}
