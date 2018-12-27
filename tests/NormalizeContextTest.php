<?php declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use PHPUnit\Framework\TestCase;
use function WyriHaximus\PSR3\normalizeContext;

/**
 * @internal
 */
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
                'stdout' => \STDOUT,
            ],
            [
                'stdout' => '[resource] (stream)',
            ],
        ];

        yield [
            [
                [
                    'stdout' => \STDOUT,
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
                    'json_serializable' => new class() implements \JsonSerializable {
                        public function jsonSerialize()
                        {
                            return [
                                'foo' => 'bar',
                            ];
                        }
                    },
                ],
            ],
            [
                [
                    'json_serializable' => [
                        'foo' => 'bar',
                    ],
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
        self::assertSame($expectedOutput, normalizeContext($context));
    }
}
