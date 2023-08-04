<?php
declare(strict_types=1);

namespace Products;

use Assert\Assert;

final class Money
{
    public readonly string $string;

    private function __construct(public readonly int $integer)
    {
        Assert::that($this->integer)->greaterOrEqualThan(0);
    }

    public static function fromString(float|string $string): self
    {
        Assert::that($string)->numeric();

        $instance = new self((int)($string * 100));
        $instance->string = (string)$string;
        return $instance;
    }
}
