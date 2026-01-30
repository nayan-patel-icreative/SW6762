<?php declare(strict_types=1);

namespace BlogSystem\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1769685894BlogTranslation extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1769685894;
    }

    public function update(Connection $connection): void
    {
        // Check if table exists
        $tableExists = $connection->fetchOne(
            'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = \'blog_translation\''
        );

        if (!$tableExists) {
            // Create table
            $connection->executeStatement(
                'CREATE TABLE blog_translation (blog_id BINARY(16) NOT NULL, language_id BINARY(16) NOT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY (blog_id, language_id)) DEFAULT CHARACTER SET utf8mb4'
            );

            // Add foreign key constraints
            $connection->executeStatement(
                'ALTER TABLE blog_translation ADD CONSTRAINT fk_blog_translation_blog_id FOREIGN KEY (blog_id) REFERENCES blog (id) ON DELETE CASCADE ON UPDATE CASCADE'
            );

            $connection->executeStatement(
                'ALTER TABLE blog_translation ADD CONSTRAINT fk_blog_translation_language_id FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE ON UPDATE CASCADE'
            );
        }
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
