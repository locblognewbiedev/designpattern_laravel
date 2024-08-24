<?php

class EmailNotification
{
    public function send()
    {
        echo "Sending email notification\n";
    }
}

class SMSNotification
{
    public function send()
    {
        echo "Sending SMS notification\n";
    }
}

// Main
$email = new EmailNotification();
$sms = new SMSNotification();

$email->send();
$sms->send();

