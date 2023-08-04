<?php
declare(strict_types=1);

namespace Products;

use Doctrine\DBAL\Connection;

class DoctrineProductRepository implements ProductRepository
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function fetchAll(): array
    {
        $rows = $this->connection
            ->executeQuery('SELECT * FROM products')
            ->fetchAllAssociative();

        return array_map(fn(array $row) => new Product(
            $row['id'],
            $row['name'],
            new Money((int)($row['price'] * 100)),
        ), $rows);
    }
}
