<?php
declare(strict_types=1);

namespace Config;

use Assert\Assert;

final class ViewGlobals
{
    public function __construct(
        public readonly string $hostname
    )
    {
        Assert::that($hostname)->notBlank();
    }
}
