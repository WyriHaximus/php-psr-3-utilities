<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\TestCase;

use function WyriHaximus\PSR3\processPlaceHolders;

/**
 * @internal
 */
final class ProcessPlaceHoldersTest extends TestCase
{
    /**
     * @return iterable<array<int, array<string, string>|string>>
     */
    public function provideForTestProcessPlaceHolders(): iterable
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

    /**
     * @param array<array<mixed>> $context
     *
     * @dataProvider provideForTestProcessPlaceHolders
     */
    public function testProcessPlaceHolders(string $message, array $context, string $expectedOutput): void
    {
        self::assertSame($expectedOutput, processPlaceHolders($message, $context));
    }
}
