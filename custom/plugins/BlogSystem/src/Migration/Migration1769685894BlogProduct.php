<?php declare(strict_types=1);

namespace BlogSystem\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1769685894BlogProduct extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1769685894;
    }

    public function update(Connection $connection): void
    {
        // Check if table exists
        $tableExists = $connection->fetchOne(
            'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = \'blog_product\''
        );

        if (!$tableExists) {
            // Create table
            $connection->executeStatement(
                'CREATE TABLE blog_product (blog_id BINARY(16) NOT NULL, product_id BINARY(16) NOT NULL, product_version_id BINARY(16) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY (blog_id, product_id, product_version_id)) DEFAULT CHARACTER SET utf8mb4'
            );

            // Add foreign key constraints
            $connection->executeStatement(
                'ALTER TABLE blog_product ADD CONSTRAINT fk.blog_product.blog_id FOREIGN KEY (blog_id) REFERENCES blog (id) ON DELETE CASCADE ON UPDATE CASCADE'
            );

            $connection->executeStatement(
                'ALTER TABLE blog_product ADD CONSTRAINT fk.blog_product.product_id FOREIGN KEY (product_id, product_version_id) REFERENCES product (id, version_id) ON DELETE CASCADE ON UPDATE CASCADE'
            );
        }
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
