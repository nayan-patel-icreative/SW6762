<?php declare(strict_types=1);

namespace BlogSystem\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1769747001BlogSystemTranslationNullable extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1769747001;
    }

    public function update(Connection $connection): void
    {
        $this->makeColumnNullableIfExists($connection, 'blog_translation', 'name', 'VARCHAR(255)');
        $this->makeColumnNullableIfExists($connection, 'blog_category_translation', 'name', 'VARCHAR(255)');
    }

    public function updateDestructive(Connection $connection): void
    {
    }

    private function makeColumnNullableIfExists(Connection $connection, string $table, string $column, string $type): void
    {
        $tableExists = $connection->fetchOne(
            'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = :table',
            ['table' => $table]
        );

        if (!$tableExists) {
            return;
        }

        $isNullable = $connection->fetchOne(
            'SELECT IS_NULLABLE FROM information_schema.COLUMNS WHERE table_schema = DATABASE() AND table_name = :table AND column_name = :column',
            ['table' => $table, 'column' => $column]
        );

        if ($isNullable === 'NO') {
            $connection->executeStatement(sprintf(
                'ALTER TABLE `%s` MODIFY `%s` %s DEFAULT NULL',
                $table,
                $column,
                $type
            ));
        }
    }
}
