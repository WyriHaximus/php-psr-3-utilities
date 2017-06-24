<?php declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\TestCase;
use Psr\Log\InvalidArgumentException;
use const WyriHaximus\PSR3\LOG_LEVELS;
use function WyriHaximus\PSR3\checkCorrectLogLevel;

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
    public function testCorrectLogLevel($logLevel)
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
    public function testIncorrectLogLevel($logLevel)
    {
        self::expectException(InvalidArgumentException::class);
        checkCorrectLogLevel($logLevel);
    }
}
