<?php declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\TestCase;
use function WyriHaximus\PSR3\normalizeContextWithFormatValue;

/**
 * @internal
 */
final class NormalizeContextWithFormatValueTest extends TestCase
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

        yield [
            [
                [
                    'stdClass' => new \StdClass(),
                ],
            ],
            [
                [
                    'stdClass' => '[object stdClass]',
                ],
            ],
        ];
    }

    /**
     * @dataProvider provideContexts
     */
    public function testNormalizeContext(array $context, array $expectedOutput): void
    {
        self::assertSame($expectedOutput, normalizeContextWithFormatValue($context));
    }
}
