<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Test;
use Psr\Log\InvalidArgumentException;
use WyriHaximus\TestUtilities\TestCase;

use function WyriHaximus\PSR3\checkCorrectLogLevel;

final class CheckCorrectLogLevelTest extends TestCase
{
    #[Test]
    #[DataProviderExternal(DataProvider::class, 'correctLogLevels')]
    public function correctLogLevel(string $logLevel): void
    {
        /** @phpstan-ignore function.deprecated */
        self::assertTrue(checkCorrectLogLevel($logLevel));
    }

    #[Test]
    #[DataProviderExternal(DataProvider::class, 'inCorrectLogLevels')]
    public function incorrectLogLevel(string $logLevel): void
    {
        self::expectException(InvalidArgumentException::class);

        /** @phpstan-ignore function.deprecated */
        checkCorrectLogLevel($logLevel);
    }
}
