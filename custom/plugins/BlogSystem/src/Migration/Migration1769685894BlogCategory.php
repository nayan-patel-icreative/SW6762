<?php declare(strict_types=1);

namespace BlogSystem\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1769685894BlogCategory extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1769685894;
    }

    public function update(Connection $connection): void
    {
        // Check if table exists
        $tableExists = $connection->fetchOne(
            'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = \'blog_category\''
        );

        if (!$tableExists) {
            // Create table
            $connection->executeStatement(
                'CREATE TABLE blog_category (id BINARY(16) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4'
            );
        }
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
