<?php

namespace Twig;

use Products\Money;
use Twig\Extension\AbstractExtension;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('format_price', [$this, 'formatPrice']),
        ];
    }

    public function formatPrice(Money $money): string
    {
        return '$' . number_format($money->amountInCents / 100, 2, '.', ',');
    }
}
