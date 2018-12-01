<?php declare(strict_types=1);

namespace WyriHaximus\PSR3;

use Psr\Log\InvalidArgumentException;
use Psr\Log\LogLevel;

/**
 * Logging levels PSR-3 LogLevel enum.
 *
 * @var array $levels Logging levels
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
 * @param  string $message
 * @param  array  $context
 * @return string
 */
function processPlaceHolders(string $message, array $context): string
{
    if (false === \strpos($message, '{')) {
        return $message;
    }

    $replacements = [];
    foreach ($context as $key => $value) {
        $replacements['{'.$key.'}'] = formatValue($value);
    }

    return \strtr($message, $replacements);
}

function formatValue($value): string
{
    if (\is_null($value) || \is_scalar($value) || (\is_object($value) && \method_exists($value, '__toString'))) {
        return (string)$value;
    }

    if (\is_object($value)) {
        return '[object '.\get_class($value).']';
    }

    return '['.\gettype($value).']';
}

function normalizeContext(array $context): array
{
    foreach ($context as $index => $value) {
        if (\is_array($value)) {
            $context[$index] = normalizeContext($value);
            continue;
        }

        if (\is_resource($value)) {
            $context[$index] = \sprintf('[resource] (%s)', \get_resource_type($value));
            continue;
        }
    }

    return $context;
}

function checkCorrectLogLevel(string $level): bool
{
    $level = \strtolower($level);
    $levels = LOG_LEVELS;
    if (!isset($levels[$level])) {
        throw new \InvalidArgumentException(
            'Level "' . $level . '" is not defined, use one of: '.\implode(', ', \array_keys(LOG_LEVELS))
        );
    }

    return true;
}
