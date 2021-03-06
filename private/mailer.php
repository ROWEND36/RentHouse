<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once "paths.php";
require $PRIVATE . "mail/Exception.php";
require $PRIVATE . "mail/PHPMailer.php";
require $PRIVATE . "mail/SMTP.php";
require_once $PRIVATE . "rate_limit.php";
function sendMail($title, $body, $pass)
{
    global $PRIVATE,$TEMP;
    include $PASSWORD;
    if ($pass != $email_api_key) {
        return "Outdated passkey";
    }
    //send only one email every 30mins
    if (!rateLimit($TEMP . "mail.counter", $mail_frequency)) {
        return "Rate Limit Exceeded";
    }
    //Create a new PHPMailer instance
    $mail = new PHPMailer();

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    //SMTP::DEBUG_OFF = off (for production use)
    //SMTP::DEBUG_CLIENT = client messages
    //SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    //Set the hostname of the mail server
    $mail->Host = "smtp.gmail.com";
    //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
    //if your network does not support SMTP over IPv6,
    //though this may cause issues with TLS

    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;

    //Set the encryption mechanism to use - STARTTLS or SMTPS
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = $sender_email;

    //Password to use for SMTP authentication
    $mail->Password = $email_password;

    //Set who the message is to be sent from
    $mail->setFrom($sender_email, $sender_name);

    //Set an alternative reply-to address
    //$mail->addReplyTo('replyto@example.com', 'First Last');

    //Set who the message is to be sent to
    $mail->addAddress($receiver_email, $receiver_name);

    //Set the subject line
    $mail->Subject = $title;

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML($body);
    //(file_get_contents('contents.html'), __DIR__);

    //Replace the plain text body with one created manually
    $mail->AltBody = $body;

    //Attach an image file
    //$mail->addAttachment('images/phpmailer_mini.png');

    //send the message, check for errors
    if ($mail->send()) {
        //save_mail($mail);
        return null;
    } else {
        return $mail->ErrorInfo;
    }
}
//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}