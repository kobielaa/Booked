<?php

require_once(ROOT_DIR . 'lib/Email/namespace.php');
require_once(ROOT_DIR . 'lib/external/phpmailer/class.phpmailer.php');



class EmailService implements IEmailService

{

    /**

     * @var PHPMailer

     */

    private $phpMailer;

    public function __construct($phpMailer = null)

    {

        $this->phpMailer = $phpMailer;

        if (is_null($phpMailer))

        {
            $this->phpMailer = new PHPMailer();

            // $mail->ContentType = 'text/calendar';
            // $this->phpMailer->Subject = "Outlooked Event";
            // $this->phpMailer->addCustomHeader('MIME-version',"1.0");
            // $this->phpMailer->addCustomHeader('Content-type',"text/calendar; method=REQUEST; charset=UTF-8");
            // $this->phpMailer->addCustomHeader('Content-Transfer-Encoding',"7bit");
            // $this->phpMailer->addCustomHeader('X-Mailer',"Microsoft Office Outlook 12.0");
            // $this->phpMailer->addCustomHeader("Content-class: urn:content-classes:calendarmessage");

            $this->phpMailer->IsHTML(false);
            // $this->phpMailer->ContentType = 'text/calendar';
            // $this->phpMailer->ContentType = "text/calendar; method=REQUEST; charset=\"UTF-8\"; component=VEVENT; name=\"meeting.ics\"";
            // $this->phpMailer->addCustomHeader('MIME-version', "1.0\n");
            // $this->phpMailer->addCustomHeader('Content-type', "text/calendar; method=REQUEST; charset=UTF-8; component=VEVENT; name=\"meeting.ics\"");
            // $this->phpMailer->addCustomHeader('Content-Type','multipart/alternative; boundary="'.$mime_boundary.'"\n');
            // $this->phpMailer->addCustomHeader('Content-Transfer-Encoding', "7bit");
            // $this->phpMailer->addCustomHeader('X-Mailer', "Microsoft Outlook 15.0");
            // $this->phpMailer->addCustomHeader("Content-class: urn:content-classes:calendarmessage\n");
            // $this->phpMailer->addCustomHeader("Content-Disposition: inline; filename=calendar.ics");

            $this->phpMailer->Mailer = $this->Config('mailer');
            $this->phpMailer->Host = $this->Config('smtp.host');
            $this->phpMailer->Port = $this->Config('smtp.port', new IntConverter());
            $this->phpMailer->SMTPSecure = $this->Config('smtp.secure');
            $this->phpMailer->SMTPAuth = $this->Config('smtp.auth', new BooleanConverter());
            $this->phpMailer->Username = $this->Config('smtp.username');
            $this->phpMailer->Password = $this->Config('smtp.password');
            $this->phpMailer->Sendmail = $this->Config('sendmail.path');
            $this->phpMailer->SMTPDebug = $this->Config('smtp.debug', new BooleanConverter());
        }

    }

    public function Send(IEmailMessage $emailMessage)
    {   
        $reservationSeries = $emailMessage->GetReservationSeries();
        $startDate         = array_pop($reservationSeries->Instances())->StartDate()->ToUtc();
        $startDate         = str_replace(array('-',':'), '',$startDate);
        $startDate         = substr($startDate,0,8).'T'.substr($startDate,9,6);
        $endDate           = array_pop($reservationSeries->Instances())->EndDate()->ToUtc();
        $endDate           = str_replace(array('-',':'), '',$endDate);
        $endDate           = substr($endDate,0,8).'T'.substr($endDate,9,6);
        $userFName         = $reservationSeries->BookedBy()->FirstName;
        $userLName         = $reservationSeries->BookedBy()->LastName;
        $room              = $reservationSeries->Resource()->GetName();
        $title             = $reservationSeries->Title();
        $description       = $reservationSeries->Description();
        $usermail          = $emailMessage->ReplyTo()->Address();

        // $mime_boundary = "----Meeting Booking----".MD5(TIME());
        // $message = "--".$mime_boundary."\r\n";
        // $message .= "Content-Type: text/html; charset=UTF-8\n";
        // $message .= "Content-Transfer-Encoding: 8bit\n";
        // $message .= "<html>\n";
        // $message .= "<body>\n";
        // $message .= "<p>xxx</p>\n";
        // $message .= "</body>\n";
        // $message .= "</html>\n";

        // $message .= "--".$mime_boundary."\n";
        // $message .= 'Content-Type: text/calendar;name="meeting.ics";method=REQUEST'."\n";
        // $message .= "Content-Transfer-Encoding: 8bit\n";

        $ical              .= "BEGIN:VCALENDAR\r\n";
        $ical              .= "PRODID:-//Microsoft Corporation//Outlook 15.0 MIMEDIR//EN\r\n";
        $ical              .= "VERSION:2.0\r\n";
        $ical              .= "METHOD:REQUEST\r\n";
        $ical              .= "CALSCALE:GREGORIAN\r\n";
        $ical              .= "X-MS-OLK-FORCEINSPECTOROPEN:TRUE\r\n";
        // $ical              .= "BEGIN:VTIMEZONE\r\n";
        // $ical              .= "TZID:Central European Standard Time\r\n";   
        // $ical              .= "BEGIN:STANDARD\r\n";
        // $ical              .= "DTSTART:16010101T030000\r\n";//$startDate\r\n";
        // $ical              .= "RRULE:FREQ=YEARLY;BYDAY=-1SU;BYMONTH=10\r\n";
        // $ical              .= "TZOFFSETFROM:+0200\r\n";
        // $ical              .= "TZOFFSETTO:+0100\r\n";
        // $ical              .= "TZNAME: EST\r\n";     
        // $ical              .= "END:STANDARD\r\n";
        // $ical              .= "BEGIN:DAYLIGHT\r\n";
        // $ical              .= "TZNAME: EDST\r\n";             
        // $ical              .= "DTSTART:16010101T020000\r\n";//$startDate\r\n";
        // $ical              .= "RRULE:FREQ=YEARLY;BYDAY=-1SU;BYMONTH=3\r\n";
        // $ical              .= "TZOFFSETFROM:+0100\r\n";
        // $ical              .= "TZOFFSETTO:+0200\r\n";
        // $ical              .= "END:DAYLIGHT\r\n";
        // $ical              .= "END:VTIMEZONE\r\n";
            $ical              .= "BEGIN:VEVENT\r\n";
            // $ical              .= "ATTENDEE;CN=mariusz.kobiela@altimi.com;RSVP=TRUE:mailto:mariusz.kobiela@altimi.com\r\n";
            $ical              .= "ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;CN=radoslaw_zielinski@outlook.com;RSVP=TRUE:mailto:radoslaw_zielinski@outlook.com\r\n";
            $ical              .= "CLASS:PUBLIC\r\n";
            $ical              .= "CREATED:".$startDate."Z\r\n";
            $ical              .= "DESCRIPTION:$description\r\n";
            $ical              .= "DTSTART;TZID=\"Central European Standard Time\":".$startDate."\r\n";
            $ical              .= "DTEND;TZID=\"Central European Standard Time\":".$endDate."\r\n";
            $ical              .= "DTSTAMP:".$startDate."Z\r\n";
            $ical              .= "LAST-MODIFIED:".$startDate."Z\r\n";
            $ical              .= "LOCATION:$room\r\n";
            $ical              .= "ORGANIZER;CN='$userFName $userLName':mailto:$usermail\r\n";
            $ical              .= "PRIORITY:5\r\n";
            $ical              .= "SEQUENCE:0\r\n";
            $ical              .= "SUMMARY;LANGUAGE=pl:$title\r\n";
            $ical              .= "TRANSP:OPAQUE\r\n";
            $ical              .= "UID:040000008200E70074C5B7101A2E0088096500AEC18A1D9CD3010000000000000000100000001D3088C9F3DF34439E9A712DC5F0D273\r\n";
            $ical              .= 'X-ALT-DESC;FMTTYPE=text/html:<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//E
                N">\n<HTML>\n<HEAD>\n<META NAME="Generator" CONTENT="MS Exchange Server ve

                rsion rmj.rmm.rup.rpr">\n<TITLE></TITLE>\n</HEAD>\n<BODY>\n<!-- Converted 

                from text/rtf format -->\n\n<P DIR=LTR><SPAN LANG="pl"><FONT FACE="Calibri

                ">'.$description.'</FONT></SPAN><SPAN LANG="pl"></SPAN></P>\n\n</BODY>\n</HTML>'."\r\n";
            $ical               .= "X-MICROSOFT-CDO-BUSYSTATUS:TENTATIVE\r\n";
            $ical               .= "X-MICROSOFT-CDO-IMPORTANCE:1\r\n";
            $ical               .= "X-MICROSOFT-CDO-INTENDEDSTATUS:BUSY\r\n";
            $ical               .= "X-MICROSOFT-DISALLOW-COUNTER:FALSE\r\n";
            $ical               .= "X-MS-OLK-AUTOSTARTCHECK:FALSE\r\n";
            $ical               .= "X-MS-OLK-CONFTYPE:0\r\n";
            
                $ical               .= "BEGIN:VALARM\r\n";
                $ical               .= "TRIGGER:-PT15M\r\n";
                $ical               .= "ACTION:DISPLAY\r\n";
                $ical               .= "DESCRIPTION:Reminder\r\n";
                $ical               .= "END:VALARM\r\n";
            $ical               .= "END:VEVENT\r\n";
        $ical               .= "END:VCALENDAR\r\n";

        $message .= $ical;
        // $message .= "--".$mime_boundary."\n";

        $this->phpMailer->ClearAllRecipients();
        $this->phpMailer->ClearReplyTos();
        $this->phpMailer->CharSet = $emailMessage->Charset();
        $this->phpMailer->Subject = $emailMessage->Subject();
        // $this->phpMailer->Body    = $message;

        $this->phpMailer->AddStringAttachment($ical,'ical.ics','base64','text/calendar');

        $from                     = $emailMessage->From();
        $defaultFrom              = Configuration::Instance()->GetSectionKey(ConfigSection::EMAIL, ConfigKeys::DEFAULT_FROM_ADDRESS);
        $defaultName              = Configuration::Instance()->GetSectionKey(ConfigSection::EMAIL, ConfigKeys::DEFAULT_FROM_NAME);
        $address                  = empty($defaultFrom) ? $from->Address() : $defaultFrom;
        $name                     = empty($defaultName) ? $from->Name() : $defaultName;
        $this->phpMailer->SetFrom($address, $name);
        $replyTo                  = $emailMessage->ReplyTo();
        $this->phpMailer->AddReplyTo($replyTo->Address(), $replyTo->Name());
        $to                       = $this->ensureArray($emailMessage->To());
        $toAddresses              = new StringBuilder();

        foreach ($to as $address)
        {
            $toAddresses->Append($address->Address());
            $this->phpMailer->AddAddress($address->Address(), $address->Name());
        }

        $cc = $this->ensureArray($emailMessage->CC());

        foreach ($cc as $address)
        {
            $this->phpMailer->AddCC($address->Address(), $address->Name());
        }

        $bcc = $this->ensureArray($emailMessage->BCC());

        foreach ($bcc as $address)
        {
            $this->phpMailer->AddBCC($address->Address(), $address->Name());
        }

        if ($emailMessage->HasStringAttachment())
        {
            Log::Debug('Adding email attachment %s', $emailMessage->AttachmentFileName());

            $this->phpMailer->AddStringAttachment($emailMessage->AttachmentContents(), $emailMessage->AttachmentFileName());
        }

        Log::Debug('Sending %s email to: %s from: %s', get_class($emailMessage), $toAddresses->ToString(), $from->Address());

        $success = false;

        try

        {

            $success = $this->phpMailer->Send();

        }

        catch(Exception $ex)

        {

            Log::Error('Failed sending email. Exception: %s', $ex);

        }

        Log::Debug('Email send success: %d. %s', $success, $this->phpMailer->ErrorInfo);

    }

    /**

     * @param $key

     * @param IConvert|null $converter

     * @return mixed|string

     */

    private function Config($key, $converter = null)

    {

        return Configuration::Instance()->GetSectionKey('phpmailer', $key, $converter);

    }

    /**

     * @param $possibleArray array|EmailAddress[]

     * @return array|EmailAddress[]

     */

    private function ensureArray($possibleArray)

    {

        if (is_array($possibleArray))

        {

            return $possibleArray;

        }

        return array($possibleArray);

    }

}

?>

