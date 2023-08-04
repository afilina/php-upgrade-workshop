<?php

namespace Twig;

use Twig\Extension\AbstractExtension;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('format_price', [$this, 'formatPrice']),
        ];
    }

    public function formatPrice($number)
    {
        return '$' . number_format($number, 2, '.', ',');
    }
}
