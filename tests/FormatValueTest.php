<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Test;
use WyriHaximus\TestUtilities\TestCase;

use function WyriHaximus\PSR3\formatValue;

final class FormatValueTest extends TestCase
{
    #[Test]
    #[DataProviderExternal(DataProvider::class, 'values')]
    public function formatValue(mixed $value, string $expectedValue): void
    {
        /** @phpstan-ignore function.deprecated */
        self::assertSame($expectedValue, formatValue($value));
    }
}
