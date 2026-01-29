<?php declare(strict_types=1);

namespace StoreLocator\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1769597919MakeStoreTranslationFieldsNullable extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1769597919;
    }

    public function update(Connection $connection): void
    {
        $sql = <<<SQL
        ALTER TABLE `store_locator_translation` 
        MODIFY COLUMN `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NULL,
        MODIFY COLUMN `city` VARCHAR(255) COLLATE utf8mb4_unicode_ci NULL;
        SQL;

        $connection->executeStatement($sql);
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
