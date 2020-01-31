<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\IMAP\Client;
use \Html2Text\Html2Text;
use App\Mailacount;

class ImapController extends Controller
{
    public function index($id = null)
    {
        if ($id != null) {
            $mailaccounts = Mailacount::where(['user_id' => $id])->get();

            $imaps = [];

            foreach ($mailaccounts as $account) {
                $oClient = new Client([
                    'host'          => $account->host,
                    'port'          => $account->port,
                    'encryption'    => $account->encription,
                    'validate_cert' => $account->validate_sert,
                    'username'      => $account->username,
                    'password'      => $account->password,
                    'protocol'      => $account->protocol
                ]);

                //Connect to the IMAP Server
                $oClient->connect();

                //Get Inbox Mailboxes
                $aFolder = $oClient->getFolders();


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

                        $subject = "";
                        $elements = imap_mime_header_decode($oMessage->getSubject());
                        for ($i = 0; $i < count($elements); $i++) {
                            $subject .= $elements[$i]->text;
                        }

                        $imap = [
                            "id" => $oMessage->getUid(),
                            "fromName" => $oMessage->getFrom()[0]->personal ? $oMessage->getFrom()[0]->personal : "",
                            "fromAddress" => $oMessage->getFrom()[0]->mail ? $oMessage->getFrom()[0]->mail : "",
                            "toString" => "",
                            "subject" => $subject,
                            "date" => $oMessage->getDate(),
                            "html" => $html
                        ];
                        $imaps[] = $imap;
                    }
                }
            }

            /** Return collection of Imaps as resource */
            return json_encode($imaps);
        }
    }

    public function destroy($id = null, $user_id = null)
    {
        if ($id != null && $user_id != null) {
            $mailaccounts = Mailacount::where(['user_id' => $user_id])->get();

            foreach ($mailaccounts as $account) {
                $oClient = new Client([
                    'host'          => $account->host,
                    'port'          => $account->port,
                    'encryption'    => $account->encription,
                    'validate_cert' => $account->validate_sert,
                    'username'      => $account->username,
                    'password'      => $account->password,
                    'protocol'      => $account->protocol
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
    }
}
