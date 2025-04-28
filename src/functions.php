<?php

declare(strict_types=1);

namespace WyriHaximus\PSR3;

/**
 * Logging levels PSR-3 LogLevel enum.
 */
const LOG_LEVELS = Utils::LOG_LEVELS;

/**
 * Functions in this file are a continuation of the code from this
 * https://github.com/Seldaek/monolog/blob/6e6586257d9fb231bf039563632e626cdef594e5/src/Monolog/Processor/PsrLogMessageProcessor.php file.
 */

/**
 * @deprecated Use Utils::processPlaceHolders instead
 *
 * @param  array<string, mixed> $context
 */
function processPlaceHolders(string $message, array $context): string
{
    return Utils::processPlaceHolders($message, $context);
}

/** @deprecated Use Utils::formatValue instead */
function formatValue(mixed $value): string
{
    return Utils::formatValue($value);
}

/**
 * @deprecated Use Utils::normalizeContext instead
 *
 * @param  array<string, mixed> $context
 *
 * @return  array<string, mixed>
 */
function normalizeContext(array $context): array
{
    return Utils::normalizeContext($context);
}

/** @deprecated Use Utils::checkCorrectLogLevel instead */
function checkCorrectLogLevel(string $level): bool
{
    return Utils::checkCorrectLogLevel($level);
}
