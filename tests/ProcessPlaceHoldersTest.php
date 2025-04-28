<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

use function WyriHaximus\PSR3\processPlaceHolders;

/** @internal */
final class ProcessPlaceHoldersTest extends TestCase
{
    /** @return iterable<array<int, array<string, string>|string>> */
    public static function provideForTestProcessPlaceHolders(): iterable
    {
        yield [
            'foo.bar',
            [],
            'foo.bar',
        ];

        yield [
            'foo.{var}',
            ['var' => 'bar'],
            'foo.bar',
        ];

        yield [
            'foo.{var}',
            ['voor' => 'bar'],
            'foo.{var}',
        ];
    }

    /** @param array<string, mixed> $context */
    #[Test]
    #[DataProvider('provideForTestProcessPlaceHolders')]
    public function processPlaceHolders(string $message, array $context, string $expectedOutput): void
    {
        self::assertSame($expectedOutput, processPlaceHolders($message, $context));
    }
}
