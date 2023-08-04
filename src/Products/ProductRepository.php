<?php
declare(strict_types=1);

namespace Products;

interface ProductRepository
{
    /**
     * @return Product[]
     */
    public function fetchAll(): array;
}
