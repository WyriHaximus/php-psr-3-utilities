<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Test;
use Psr\Log\InvalidArgumentException;
use WyriHaximus\PSR3\Utils;
use WyriHaximus\TestUtilities\TestCase;

#[CoversMethod(Utils::class, 'checkCorrectLogLevel')]
#[CoversMethod(Utils::class, 'formatValue')]
#[CoversMethod(Utils::class, 'normalizeContext')]
#[CoversMethod(Utils::class, 'processPlaceHolders')]
#[CoversClass(Utils::class)]
final class UtilsTest extends TestCase
{
    #[Test]
    #[DataProviderExternal(DataProvider::class, 'correctLogLevels')]
    public function correctLogLevelUtils(string $logLevel): void
    {
        self::assertTrue(Utils::checkCorrectLogLevel($logLevel));
    }

    #[Test]
    #[DataProviderExternal(DataProvider::class, 'inCorrectLogLevels')]
    public function incorrectLogLevelUtils(string $logLevel): void
    {
        self::expectException(InvalidArgumentException::class);

        Utils::checkCorrectLogLevel($logLevel);
    }

    #[Test]
    #[DataProviderExternal(DataProvider::class, 'values')]
    public function formatValueUtils(mixed $value, string $expectedValue): void
    {
        self::assertSame($expectedValue, Utils::formatValue($value));
    }

    /**
     * @param array<string, mixed> $context
     * @param array<string, mixed> $expectedOutput
     */
    #[Test]
    #[DataProviderExternal(DataProvider::class, 'contexts')]
    public function normalizeContextUtils(array $context, array $expectedOutput): void
    {
        self::assertSame($expectedOutput, Utils::normalizeContext($context));
    }

    /** @param array<string, mixed> $context */
    #[Test]
    #[DataProviderExternal(DataProvider::class, 'processPlaceHolders')]
    public function processPlaceHoldersUtils(string $message, array $context, string $expectedOutput): void
    {
        self::assertSame($expectedOutput, Utils::processPlaceHolders($message, $context));
    }
}
