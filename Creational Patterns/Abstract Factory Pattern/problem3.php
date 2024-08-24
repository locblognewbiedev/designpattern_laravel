
#Factory pattern

interface Notification {
    public function send();
}

class EmailNotification implements Notification {
    public function send() {
        echo "Sending email notification\n";
    }
}

class SMSNotification implements Notification {
    public function send() {
        echo "Sending SMS notification\n";
    }
}

abstract class NotificationFactory {
    abstract public function createNotification(): Notification;
}

class EmailNotificationFactory extends NotificationFactory {
    public function createNotification(): Notification {
        return new EmailNotification();
    }
}

class SMSNotificationFactory extends NotificationFactory {
    public function createNotification(): Notification {
        return new SMSNotification();
    }
}

// Sử dụng Factory Method Pattern
$emailFactory = new EmailNotificationFactory();
$emailNotification = $emailFactory->createNotification();
$emailNotification->send();

$smsFactory = new SMSNotificationFactory();
$smsNotification = $smsFactory->createNotification();
$smsNotification->send();



abstract factory pattern
<?php

interface Notification
{
    public function send();
}

interface NotificationHistory
{
    public function save();
}

class EmailNotification implements Notification
{
    public function send()
    {
        echo "Sending email notification\n";
    }
}

class EmailNotificationHistory implements NotificationHistory
{
    public function save()
    {
        echo "Saving email notification history\n";
    }
}

class SMSNotification implements Notification
{
    public function send()
    {
        echo "Sending SMS notification\n";
    }
}

class SMSNotificationHistory implements NotificationHistory
{
    public function save()
    {
        echo "Saving SMS notification history\n";
    }
}

interface NotificationFactory
{
    public function createNotification(): Notification;
    public function createNotificationHistory(): NotificationHistory;
}

class EmailNotificationFactory implements NotificationFactory
{
    public function createNotification(): Notification
    {
        return new EmailNotification();
    }

    public function createNotificationHistory(): NotificationHistory
    {
        return new EmailNotificationHistory();
    }
}

class SMSNotificationFactory implements NotificationFactory
{
    public function createNotification(): Notification
    {
        return new SMSNotification();
    }

    public function createNotificationHistory(): NotificationHistory
    {
        return new SMSNotificationHistory();
    }
}

// Sử dụng Abstract Factory Pattern
$emailFactory = new EmailNotificationFactory();
$emailNotification = $emailFactory->createNotification();
$emailHistory = $emailFactory->createNotificationHistory();

$emailNotification->send();
$emailHistory->save();

$smsFactory = new SMSNotificationFactory();
$smsNotification = $smsFactory->createNotification();
$smsHistory = $smsFactory->createNotificationHistory();

$smsNotification->send();
$smsHistory->save();

