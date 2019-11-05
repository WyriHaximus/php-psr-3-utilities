<?php declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use Psr\Log\AbstractLogger;
use Psr\Log\Test\LoggerInterfaceTest;
use function WyriHaximus\PSR3\checkCorrectLogLevel;
use function WyriHaximus\PSR3\processPlaceHolders;

/**
 * @internal
 */
final class LoggerTest extends LoggerInterfaceTest
{
    private $logs = [];

    public function getLogger()
    {
        return new class(function (string $message): void {
            $this->logs[] = $message;
        }) extends AbstractLogger {
            private $logLog;

            public function __construct($logLog)
            {
                $this->logLog = $logLog;
            }

            public function log($level, $message, array $context = []): void
            {
                checkCorrectLogLevel($level);

                ($this->logLog)($level . ' ' . processPlaceHolders((string)$message, $context));
            }
        };
    }

    public function getLogs()
    {
        return $this->logs;
    }
}
