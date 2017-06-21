<?php

namespace WyriHaximus\PSR3;

/**
 * @param string $message
 * @param array $context
 * @return string
 *
 * Method copied from: https://github.com/Seldaek/monolog/blob/6e6586257d9fb231bf039563632e626cdef594e5/src/Monolog/Processor/PsrLogMessageProcessor.php
 */
function processPlaceHolders(string $message, array $context): string
{
    if (false === strpos($message, '{')) {
        return $message;
    }

    $replacements = [];
    foreach ($context as $key => $value) {
        $replacements['{'.$key.'}'] = $this->formatValue($value);
    }

    return strtr($message, $replacements);
}

function formatValue($value)
{
    if (is_null($value) || is_scalar($value) || (is_object($value) && method_exists($value, '__toString'))) {
        return $value;
    }

    if (is_object($value)) {
        return '[object '.get_class($value).']';
    }

    return '['.gettype($value).']';
}

function normalizeContext(array $context): array
{
    foreach ($context as $index => $value) {
        if (is_array($value)) {
            $context[$index] = normalizeContext($value);
            continue;
        }

        if (is_resource($value)) {
            $context[$index] = sprintf('[resource] (%s)', get_resource_type($value));
            continue;
        }
    }

    return $context;
}
