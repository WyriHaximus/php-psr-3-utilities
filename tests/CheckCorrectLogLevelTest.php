<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\TestCase;
use Psr\Log\InvalidArgumentException;

use function WyriHaximus\PSR3\checkCorrectLogLevel;

use const WyriHaximus\PSR3\LOG_LEVELS;

/**
 * @internal
 */
final class CheckCorrectLogLevelTest extends TestCase
{
    /**
     * @return iterable<array<string>>
     */
    public function provideCorrectLogLevels(): iterable
    {
        foreach (LOG_LEVELS as $logLevel) {
            yield [$logLevel];
        }
    }

    /**
     * @dataProvider provideCorrectLogLevels
     */
    public function testCorrectLogLevel(string $logLevel): void
    {
        self::assertTrue(checkCorrectLogLevel($logLevel));
    }

    /**
     * @return iterable<array<string>>
     */
    public function provideInCorrectLogLevels(): iterable
    {
        yield ['yes'];

        yield ['null'];

        yield ['meltdown'];
    }

    /**
     * @dataProvider provideInCorrectLogLevels
     */
    public function testIncorrectLogLevel(string $logLevel): void
    {
        self::expectException(InvalidArgumentException::class);
        checkCorrectLogLevel($logLevel);
    }
}
