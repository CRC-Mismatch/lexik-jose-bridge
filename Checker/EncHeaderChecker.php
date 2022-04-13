<?php

declare(strict_types=1);

namespace SpomkyLabs\LexikJoseBundle\Checker;

use function is_string;
use Jose\Component\Checker\HeaderChecker;
use Jose\Component\Checker\InvalidHeaderException;

final class EncHeaderChecker implements HeaderChecker
{
    public function __construct(private readonly string $algorithm)
    {
    }

    public function checkHeader(mixed $algorithm): void
    {
        if (! is_string($algorithm)) {
            throw new InvalidHeaderException('The value of the header "enc" is not valid', 'enc', $algorithm);
        }

        if ($this->algorithm !== $algorithm) {
            throw new InvalidHeaderException(sprintf(
                'The algorithm "%s" is not known.',
                $algorithm
            ), 'enc', $algorithm);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supportedHeader(): string
    {
        return 'enc';
    }

    /**
     * {@inheritdoc}
     */
    public function protectedHeaderOnly(): bool
    {
        return true;
    }
}
