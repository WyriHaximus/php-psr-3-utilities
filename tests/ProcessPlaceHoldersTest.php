<?php declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\TestCase;
use function WyriHaximus\PSR3\processPlaceHolders;

/**
 * @internal
 */
final class ProcessPlaceHoldersTest extends TestCase
{
    public function provideForTestProcessPlaceHolders()
    {
        yield [
            'foo.bar',
            [],
            'foo.bar',
        ];

        yield [
            'foo.{var}',
            [
                'var' => 'bar',
            ],
            'foo.bar',
        ];

        yield [
            'foo.{var}',
            [
                'voor' => 'bar',
            ],
            'foo.{var}',
        ];
    }

    /**
     * @param string $message
     * @param array  $context
     * @param string $expectedOutput
     *
     * @dataProvider provideForTestProcessPlaceHolders
     */
    public function testProcessPlaceHolders(string $message, array $context, string $expectedOutput): void
    {
        self::assertSame($expectedOutput, processPlaceHolders($message, $context));
    }
}
