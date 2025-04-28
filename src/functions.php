<?php

declare(strict_types=1);

namespace WyriHaximus\PSR3;

use DateTimeInterface;
use JsonSerializable;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LogLevel;

use function array_key_exists;
use function array_keys;
use function get_resource_type;
use function gettype;
use function implode;
use function is_array;
use function is_object;
use function is_resource;
use function is_scalar;
use function method_exists;
use function sprintf;
use function strpos;
use function strtolower;
use function strtr;

/**
 * Logging levels PSR-3 LogLevel enum.
 */
const LOG_LEVELS = [
    LogLevel::DEBUG     => 'DEBUG',
    LogLevel::INFO      => 'INFO',
    LogLevel::NOTICE    => 'NOTICE',
    LogLevel::WARNING   => 'WARNING',
    LogLevel::ERROR     => 'ERROR',
    LogLevel::CRITICAL  => 'CRITICAL',
    LogLevel::ALERT     => 'ALERT',
    LogLevel::EMERGENCY => 'EMERGENCY',
];

/**
 * Functions in this file are a continuation of the code from this
 * https://github.com/Seldaek/monolog/blob/6e6586257d9fb231bf039563632e626cdef594e5/src/Monolog/Processor/PsrLogMessageProcessor.php file.
 */

/**
 * @param  array<string, mixed> $context
 */
function processPlaceHolders(string $message, array $context): string
{
    if (strpos($message, '{') === false) {
        return $message;
    }

    $replacements = [];
    foreach ($context as $key => $value) {
        $replacements['{' . $key . '}'] = formatValue($value);
    }

    return strtr($message, $replacements);
}

function formatValue(mixed $value): string
{
    if ($value === null || is_scalar($value) || (is_object($value) && method_exists($value, '__toString'))) {
        return (string) $value;
    }

    if (is_object($value)) {
        return '[object ' . $value::class . ']';
    }

    return '[' . gettype($value) . ']';
}

/**
 * @param  array<string, mixed> $context
 *
 * @return  array<string, mixed>
 */
function normalizeContext(array $context): array
{
    foreach ($context as $index => $value) {
        if ($value instanceof JsonSerializable) {
            $value = $value->jsonSerialize();
        }

        if ($value instanceof DateTimeInterface) {
            $value = (array) $value;
        }

        if (is_array($value)) {
            $context[$index] = normalizeContext($value);
            continue;
        }

        if (is_resource($value)) {
            $context[$index] = sprintf('[resource] (%s)', get_resource_type($value));
            continue;
        }

        $context[$index] = formatValue($value);
    }

    return $context;
}

function checkCorrectLogLevel(string $level): bool
{
    $level = strtolower($level);
    if (! array_key_exists($level, LOG_LEVELS)) {
        throw new InvalidArgumentException(
            'Level "' . $level . '" is not defined, use one of: ' . implode(', ', array_keys(LOG_LEVELS))
        );
    }

    return true;
}
