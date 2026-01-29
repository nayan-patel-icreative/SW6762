<?php declare(strict_types=1);

namespace StoreLocator\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1769597920AddProductVersionColumn extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1769597920;
    }

    public function update(Connection $connection): void
    {
        $sql = <<<SQL
        ALTER TABLE `store_locator` 
        ADD COLUMN `product_version_id` BINARY(16) NULL AFTER `product_id`;
        SQL;

        $connection->executeStatement($sql);
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
