<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\TestCase;
use stdClass;

use function WyriHaximus\PSR3\formatValue;

use const STDOUT;

/**
 * @internal
 */
final class FormatValueTest extends TestCase
{
    /**
     * @return iterable<array<int, mixed>>
     */
    public function provideValues(): iterable
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
            new class () {
                public function __toString(): string
                {
                    return 'foo.bar';
                }
            },
            'foo.bar',
        ];

        yield [
            new stdClass(),
            '[object stdClass]',
        ];

        yield [
            STDOUT,
            '[resource]',
        ];
    }

    /**
     * @dataProvider provideValues
     */
    public function testFormatValue(mixed $value, string $expectedValue): void
    {
        self::assertSame($expectedValue, formatValue($value));
    }
}
