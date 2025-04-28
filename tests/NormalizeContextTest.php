<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use JsonSerializable;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use stdClass;
use WyriHaximus\PSR3\Utils;

use function WyriHaximus\PSR3\normalizeContext;

use const STDOUT;

final class NormalizeContextTest extends TestCase
{
    /** @return iterable<array<mixed>> */
    public static function provideContexts(): iterable
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
                         * @phpstan-ignore shipmonk.missingNativeReturnTypehint
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
     * @param array<string, mixed> $context
     * @param array<string, mixed> $expectedOutput
     */
    #[Test]
    #[DataProvider('provideContexts')]
    public function normalizeContext(array $context, array $expectedOutput): void
    {
        /** @phpstan-ignore function.deprecated */
        self::assertSame($expectedOutput, normalizeContext($context));
    }

    /**
     * @param array<string, mixed> $context
     * @param array<string, mixed> $expectedOutput
     */
    #[Test]
    #[DataProvider('provideContexts')]
    public function normalizeContextUtils(array $context, array $expectedOutput): void
    {
        self::assertSame($expectedOutput, Utils::normalizeContext($context));
    }
}
