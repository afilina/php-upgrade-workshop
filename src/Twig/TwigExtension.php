<?php

namespace Twig;

use Products\Money;
use Twig\Extension\AbstractExtension;

class TwigExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('format_price', [$this, 'formatPrice']),
        ];
    }

    public function formatPrice(Money $money): string
    {
        return '$' . number_format($money->string, 2, '.', ',');
    }
}
