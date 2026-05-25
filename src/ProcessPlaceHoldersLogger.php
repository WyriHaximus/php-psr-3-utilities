<?php

declare(strict_types=1);

namespace WyriHaximus\PSR3;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Stringable;

/** @api */
final readonly class ProcessPlaceHoldersLogger implements LoggerInterface
{
    use LoggerTrait;

    public function __construct(private LoggerInterface $logger)
    {
    }

    /**
     * @inheritdoc
     * @phpstan-ignore typeCoverage.paramTypeCoverage
     */
    public function log($level, Stringable|string $message, array $context = []): void
    {
        /** @phpstan-ignore psr3.interpolated,argument.type */
        $this->logger->log($level, Utils::processPlaceHolders((string) $message, $context), $context);
    }
}
