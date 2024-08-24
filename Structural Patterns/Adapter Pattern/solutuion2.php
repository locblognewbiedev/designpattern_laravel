Bối cảnh:
Bạn có một ứng dụng và sử dụng một thư viện logging cũ (OldLogger).
 Bạn muốn chuyển sang một thư viện logging mới (NewLogger).

<?php

class OldLogger
{
    public function writeLog($message)
    {
        echo "Old Logger: $message\n";
    }
}
class NewLogger
{
    public function log($message)
    {
        echo "New Logger: $message\n";
    }
}
interface LoggerInterface
{
    public function log($message);
}

class OldLoggerAdapter implements LoggerInterface
{
    private $oldLogger;

    public function __construct(OldLogger $oldLogger)
    {
        $this->oldLogger = $oldLogger;
    }

    public function log($message)
    {
        $this->oldLogger->writeLog($message);
    }
}

class NewLoggerAdapter implements LoggerInterface
{
    private $newLogger;

    public function __construct(NewLogger $newLogger)
    {
        $this->newLogger = $newLogger;
    }

    public function log($message)
    {
        $this->newLogger->log($message);
    }
}
function logMessage(LoggerInterface $logger, $message)
{
    $logger->log($message);
}

$oldLogger = new OldLoggerAdapter(new OldLogger());
$newLogger = new NewLoggerAdapter(new NewLogger());

logMessage($oldLogger, "This is an old log message.");
logMessage($newLogger, "This is a new log message.");
