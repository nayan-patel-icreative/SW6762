<?php declare(strict_types=1);

namespace BlogSystem\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1769746928BlogSystem extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1769746928;
    }

    public function update(Connection $connection): void
    {
        // check column exists
        $columnExists = $connection->fetchOne("
            SELECT COUNT(*)
            FROM information_schema.COLUMNS
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = 'blog'
              AND COLUMN_NAME = 'blog_category_id'
        ");

        if (!$columnExists) {
            $connection->executeStatement(
                'ALTER TABLE blog 
                 ADD COLUMN blog_category_id BINARY(16) NULL'
            );
        }

        // check FK exists
        $fkExists = $connection->fetchOne("
            SELECT COUNT(*)
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE TABLE_SCHEMA = DATABASE()
              AND TABLE_NAME = 'blog'
              AND CONSTRAINT_NAME = 'fk_blog_blog_category_id'
        ");

        if (!$fkExists) {
            $connection->executeStatement(
                'ALTER TABLE blog
                 ADD CONSTRAINT fk_blog_blog_category_id
                 FOREIGN KEY (blog_category_id)
                 REFERENCES blog_category (id)
                 ON DELETE SET NULL
                 ON UPDATE CASCADE'
            );
        }
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
