<?php declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\TestCase;
use function WyriHaximus\PSR3\normalizeContext;

final class NormalizeContextTest extends TestCase
{
    public function provideContexts()
    {
        yield [
            [],
            [],
        ];

        yield [
            [
                [],
            ],
            [
                [],
            ],
        ];

        yield [
            [
                'stdout' => STDOUT,
            ],
            [
                'stdout' => '[resource] (stream)',
            ],
        ];

        yield [
            [
                [
                    'stdout' => STDOUT,
                ],
            ],
            [
                [
                    'stdout' => '[resource] (stream)',
                ],
            ],
        ];
    }

    /**
     * @dataProvider provideContexts
     */
    public function testNormalizeContext(array $context, array $expectedOutput)
    {
        self::assertSame($expectedOutput, normalizeContext($context));
    }
}
