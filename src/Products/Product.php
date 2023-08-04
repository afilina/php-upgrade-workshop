<?php
declare(strict_types=1);

namespace Products;

use Assert\Assert;

final class Product
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly Money $price,
    )
    {
        Assert::that($id)->greaterOrEqualThan(1);
    }
}
