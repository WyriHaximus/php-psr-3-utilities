<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WyriHaximus\PSR3\Utils;

use function WyriHaximus\PSR3\processPlaceHolders;

final class ProcessPlaceHoldersTest extends TestCase
{
    /** @param array<string, mixed> $context */
    #[Test]
    #[DataProviderExternal(DataProvider::class, 'processPlaceHolders')]
    public function processPlaceHolders(string $message, array $context, string $expectedOutput): void
    {
        /** @phpstan-ignore function.deprecated */
        self::assertSame($expectedOutput, processPlaceHolders($message, $context));
    }

    /** @param array<string, mixed> $context */
    #[Test]
    #[DataProviderExternal(DataProvider::class, 'processPlaceHolders')]
    public function processPlaceHoldersUtils(string $message, array $context, string $expectedOutput): void
    {
        self::assertSame($expectedOutput, Utils::processPlaceHolders($message, $context));
    }
}
