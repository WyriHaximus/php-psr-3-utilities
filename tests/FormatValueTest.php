<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use stdClass;
use WyriHaximus\PSR3\Utils;

use function WyriHaximus\PSR3\formatValue;

use const STDOUT;

final class FormatValueTest extends TestCase
{
    /** @return iterable<array<int, mixed>> */
    public static function provideValues(): iterable
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

    #[Test]
    #[DataProvider('provideValues')]
    public function formatValue(mixed $value, string $expectedValue): void
    {
        /** @phpstan-ignore function.deprecated */
        self::assertSame($expectedValue, formatValue($value));
    }

    #[Test]
    #[DataProvider('provideValues')]
    public function formatValueUtils(mixed $value, string $expectedValue): void
    {
        self::assertSame($expectedValue, Utils::formatValue($value));
    }
}
