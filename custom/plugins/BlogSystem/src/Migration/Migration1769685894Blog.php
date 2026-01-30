<?php declare(strict_types=1);

namespace BlogSystem\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1769685894Blog extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1769685894;
    }

    public function update(Connection $connection): void
    {
        // Check if table exists
        $tableExists = $connection->fetchOne(
            'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = \'blog\''
        );

        if (!$tableExists) {
            // Create table
            $connection->executeStatement(
                'CREATE TABLE blog (id BINARY(16) NOT NULL, active TINYINT(1) DEFAULT 0 NOT NULL, release_date DATETIME DEFAULT NULL, author VARCHAR(255) NOT NULL, blog_category_id BINARY(16) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4'
            );

            // Add foreign key constraint
            $connection->executeStatement(
                'ALTER TABLE blog ADD CONSTRAINT fk_blog_blog_category_id FOREIGN KEY (blog_category_id) REFERENCES blog_category (id) ON UPDATE CASCADE ON DELETE SET NULL'
            );
        }
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
