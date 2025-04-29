<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Test;
use WyriHaximus\TestUtilities\TestCase;

use function WyriHaximus\PSR3\normalizeContext;

final class NormalizeContextTest extends TestCase
{
    /**
     * @param array<string, mixed> $context
     * @param array<string, mixed> $expectedOutput
     */
    #[Test]
    #[DataProviderExternal(DataProvider::class, 'contexts')]
    public function normalizeContext(array $context, array $expectedOutput): void
    {
        /** @phpstan-ignore function.deprecated */
        self::assertSame($expectedOutput, normalizeContext($context));
    }
}
