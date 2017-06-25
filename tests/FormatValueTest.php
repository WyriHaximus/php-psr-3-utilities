<?php declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\TestCase;
use function WyriHaximus\PSR3\formatValue;

final class FormatValueTest extends TestCase
{
    public function provideValues()
    {
        yield [
            null,
            '',
        ];

        yield [
            1337,
            '1337',
        ];

        yield [
            'string',
            'string',
        ];

        yield [
            1.337,
            '1.337',
        ];

        yield [
            new class() {
                public function __toString()
                {
                    return 'foo.bar';
                }
            },
            'foo.bar',
        ];

        yield [
            new \stdClass(),
            '[object stdClass]',
        ];

        yield [
            STDOUT,
            '[resource]',
        ];
    }

    /**
     * @param string $message
     * @param array  $context
     * @param string $expectedValue
     * @param mixed  $value
     *
     * @dataProvider provideValues
     */
    public function testFormatValue($value, $expectedValue)
    {
        self::assertSame($expectedValue, formatValue($value));
    }
}
