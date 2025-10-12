<?php

declare(strict_types=1);

namespace WyriHaximus\PSR3;

use Deprecated;

/**
 * Logging levels PSR-3 LogLevel enum.
 */
const LOG_LEVELS = Utils::LOG_LEVELS;

/**
 * Functions in this file are a continuation of the code from this
 * https://github.com/Seldaek/monolog/blob/6e6586257d9fb231bf039563632e626cdef594e5/src/Monolog/Processor/PsrLogMessageProcessor.php file.
 */

/** @param  array<string, mixed> $context */
#[Deprecated(message: 'Use Utils::processPlaceHolders instead')]
function processPlaceHolders(string $message, array $context): string
{
    return Utils::processPlaceHolders($message, $context);
}

#[Deprecated(message: 'Use Utils::formatValue instead')]
function formatValue(mixed $value): string
{
    return Utils::formatValue($value);
}

/**
 * @param  array<string, mixed> $context
 *
 * @return  array<string, mixed>
 */
#[Deprecated(message: 'Use Utils::normalizeContext instead')]
function normalizeContext(array $context): array
{
    return Utils::normalizeContext($context);
}

#[Deprecated(message: 'Use Utils::checkCorrectLogLevel instead')]
function checkCorrectLogLevel(string $level): true
{
    return Utils::checkCorrectLogLevel($level);
}
