<?php declare(strict_types=1);

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
    public function provideCorrectLogLevels()
    {
        foreach (LOG_LEVELS as $logLevel) {
            yield [$logLevel];
        }
    }

    /**
     * @dataProvider provideCorrectLogLevels
     * @param mixed $logLevel
     */
    public function testCorrectLogLevel($logLevel): void
    {
        self::assertTrue(checkCorrectLogLevel($logLevel));
    }

    public function provideInCorrectLogLevels()
    {
        yield [
            'yes',
        ];

        yield [
            'null',
        ];

        yield [
            'meltdown',
        ];
    }

    /**
     * @dataProvider provideInCorrectLogLevels
     * @param mixed $logLevel
     */
    public function testIncorrectLogLevel($logLevel): void
    {
        self::expectException(InvalidArgumentException::class);
        checkCorrectLogLevel($logLevel);
    }
}
