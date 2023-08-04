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
            Money::fromString($row['price']),
        ), $rows);
    }

    public function update(Product $product): void
    {
        $this->connection->update('products', [
            'name' => $product->name,
            'price' => $product->price->string,
        ], [
            'id' => $product->id,
        ]);
    }
}
