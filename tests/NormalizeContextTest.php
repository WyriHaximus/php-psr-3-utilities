<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use JsonSerializable;
use PHPUnit\Framework\TestCase;
use stdClass;

use function WyriHaximus\PSR3\normalizeContext;

use const STDOUT;

/**
 * @internal
 */
final class NormalizeContextTest extends TestCase
{
    /**
     * @return iterable<array<mixed>>
     */
    public function provideContexts(): iterable
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
            ['stdout' => STDOUT],
            ['stdout' => '[resource] (stream)'],
        ];

        yield [
            [
                ['stdout' => STDOUT],
            ],
            [
                ['stdout' => '[resource] (stream)'],
            ],
        ];

        yield [
            [
                [
                    'json_serializable' => new class () implements JsonSerializable {
                        /**
                         * @inheritDoc
                         */
                        public function jsonSerialize()
                        {
                            return ['foo' => 'bar'];
                        }
                    },
                ],
            ],
            [
                [
                    'json_serializable' => ['foo' => 'bar'],
                ],
            ],
        ];

        yield [
            [
                [
                    'stdClass' => new stdClass(),
                ],
            ],
            [
                ['stdClass' => '[object stdClass]'],
            ],
        ];
    }

    /**
     * @param array<mixed> $context
     * @param array<mixed> $expectedOutput
     *
     * @dataProvider provideContexts
     */
    public function testNormalizeContext(array $context, array $expectedOutput): void
    {
        self::assertSame($expectedOutput, normalizeContext($context));
    }
}
