<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PSR3;

use JsonSerializable;
use stdClass;

use const STDOUT;
use const WyriHaximus\PSR3\LOG_LEVELS;

final class DataProvider
{
    /** @return iterable<array<string>> */
    public static function correctLogLevels(): iterable
    {
        foreach (LOG_LEVELS as $logLevel) {
            yield [$logLevel];
        }
    }

    /** @return iterable<array<string>> */
    public static function inCorrectLogLevels(): iterable
    {
        yield ['yes'];
        yield ['null'];
        yield ['meltdown'];
    }

    /** @return iterable<array<int, mixed>> */
    public static function values(): iterable
    {
        yield [
            null,
            '',
        ];

        yield [
            1337,
            '1337',
        ];

        yield [
            'string',
            'string',
        ];

        yield [
            1.337,
            '1.337',
        ];

        yield [
            new class () {
                public function __toString(): string
                {
                    return 'foo.bar';
                }
            },
            'foo.bar',
        ];

        yield [
            new stdClass(),
            '[object stdClass]',
        ];

        yield [
            STDOUT,
            '[resource]',
        ];
    }

    /** @return iterable<array<mixed>> */
    public static function contexts(): iterable
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

    /** @return iterable<array<int, array<string, string>|string>> */
    public static function processPlaceHolders(): iterable
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
}
