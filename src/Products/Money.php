<?php
declare(strict_types=1);

namespace Products;

use Assert\Assert;

final class Money
{
    public function __construct(public readonly int $amountInCents)
    {
        Assert::that($this->amountInCents)->greaterOrEqualThan(0);
    }
}
