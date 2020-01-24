<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpImap\Mailbox;
use PhpImap\Exceptions\ConnectionException;

class ImapController extends Controller
{
    public function index(Request $request)
    {
        $mailbox = new Mailbox(
            '{imap.gmail.com:993/imap/ssl}INBOX', // IMAP server and mailbox folder
            'ilko.iv@gmail.com', // Username for the before configured mailbox
            '1Ivan@Ivanov9', // Password for the before configured username
            __DIR__, // Directory, where attachments will be saved (optional)
            'UTF-8' // Server encoding (optional)
        );

        try {
            // Get all emails (messages)
            // PHP.net imap_search criteria: http://php.net/manual/en/function.imap-search.php
            $mailsIds = $mailbox->searchMailbox('ALL');
        } catch (ConnectionException $ex) {
            echo "IMAP connection failed: " . $ex;
            die();
        }

        // If $mailsIds is empty, no emails could be found
        if (!$mailsIds) {
            die('Mailbox is empty');
        }

        // Get the first message
        // If '__DIR__' was defined in the first line, it will automatically
        // save all attachments to the specified directory
        $email = $mailbox->getMail($mailsIds[0]);

        /** Get Contacts */
        if ($email->textHtml) {
            $textHtml = $email->textHtml;
        } else {
            $textHtml = $email->textPlain;
        }
        $imaps = [
            [
                "id" => $email->id,
                "fromName" => isset($email->fromName) ? $email->fromName : $email->fromAddress,
                "fromAddress" => $email->fromAddress,
                "toString" => $email->toString,
                "subject" => $email->subject,
                "textHtml" => $textHtml
            ]
        ];

        $mailbox->disconnect();

        /** Return collection of Imaps as resource */
        return json_encode($imaps);
    }
}
