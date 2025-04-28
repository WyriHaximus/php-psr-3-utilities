<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Log\InvalidArgumentException;
use WyriHaximus\PSR3\Utils;

use function WyriHaximus\PSR3\checkCorrectLogLevel;

use const WyriHaximus\PSR3\LOG_LEVELS;

final class CheckCorrectLogLevelTest extends TestCase
{
    /** @return iterable<array<string>> */
    public static function provideCorrectLogLevels(): iterable
    {
        foreach (LOG_LEVELS as $logLevel) {
            yield [$logLevel];
        }
    }

    #[Test]
    #[DataProvider('provideCorrectLogLevels')]
    public function correctLogLevel(string $logLevel): void
    {
        /** @phpstan-ignore function.deprecated */
        self::assertTrue(checkCorrectLogLevel($logLevel));
    }

    #[Test]
    #[DataProvider('provideCorrectLogLevels')]
    public function correctLogLevelUtils(string $logLevel): void
    {
        self::assertTrue(Utils::checkCorrectLogLevel($logLevel));
    }

    /** @return iterable<array<string>> */
    public static function provideInCorrectLogLevels(): iterable
    {
        yield ['yes'];

        yield ['null'];

        yield ['meltdown'];
    }

    #[Test]
    #[DataProvider('provideInCorrectLogLevels')]
    public function incorrectLogLevel(string $logLevel): void
    {
        self::expectException(InvalidArgumentException::class);

        /** @phpstan-ignore function.deprecated */
        checkCorrectLogLevel($logLevel);
    }

    #[Test]
    #[DataProvider('provideInCorrectLogLevels')]
    public function incorrectLogLevelUtils(string $logLevel): void
    {
        self::expectException(InvalidArgumentException::class);

        Utils::checkCorrectLogLevel($logLevel);
    }
}
