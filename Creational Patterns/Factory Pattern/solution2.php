<?php

interface Notification
{
    public function send();
}

class EmailNotification implements Notification
{
    public function send()
    {
        echo "Sending email notification\n";
    }
}

class SMSNotification implements Notification
{
    public function send()
    {
        echo "Sending SMS notification\n";
    }
}

class NotificationFactory
{
    public static function createNotification($type)
    {
        if (strcasecmp($type, "email") == 0) {
            return new EmailNotification();
        } else if (strcasecmp($type, "sms") == 0) {
            return new SMSNotification();
        }
        return null;
    }
}

// Main
$email = NotificationFactory::createNotification("email");
$sms = NotificationFactory::createNotification("sms");

$email->send();
$sms->send();

?>
