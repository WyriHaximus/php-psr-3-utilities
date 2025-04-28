<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WyriHaximus\PSR3\Utils;

use function WyriHaximus\PSR3\processPlaceHolders;

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
        /** @phpstan-ignore function.deprecated */
        self::assertSame($expectedOutput, processPlaceHolders($message, $context));
    }

    /** @param array<string, mixed> $context */
    #[Test]
    #[DataProvider('provideForTestProcessPlaceHolders')]
    public function processPlaceHoldersUtils(string $message, array $context, string $expectedOutput): void
    {
        self::assertSame($expectedOutput, Utils::processPlaceHolders($message, $context));
    }
}
