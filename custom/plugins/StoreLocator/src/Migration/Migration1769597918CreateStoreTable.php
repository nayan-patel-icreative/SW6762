<?php declare(strict_types=1);

namespace StoreLocator\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1769597918CreateStoreTable extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1769597918;
    }

    public function update(Connection $connection): void
    {
        $sql = <<<SQL

    CREATE TABLE IF NOT EXISTS `store_locator` (
        `id`            BINARY(16)   NOT NULL,
        `active`        TINYINT(1)   NOT NULL DEFAULT 0,

        `country_id`    BINARY(16)   NULL,
        `state_id`      BINARY(16)   NULL,
        `media_id`      BINARY(16)   NULL,
        `product_id`    BINARY(16)   NULL,

        `created_at`    DATETIME(3)  NOT NULL,
        `updated_at`    DATETIME(3)  NULL,

        PRIMARY KEY (`id`),

        CONSTRAINT `fk.store_locator.country_id`
            FOREIGN KEY (`country_id`)
            REFERENCES `country` (`id`)
            ON DELETE SET NULL
            ON UPDATE CASCADE,

        CONSTRAINT `fk.store_locator.state_id`
            FOREIGN KEY (`state_id`)
            REFERENCES `state_machine_state` (`id`)
            ON DELETE SET NULL
            ON UPDATE CASCADE,

        CONSTRAINT `fk.store_locator.media_id`
            FOREIGN KEY (`media_id`)
            REFERENCES `media` (`id`)
            ON DELETE SET NULL
            ON UPDATE CASCADE,

        CONSTRAINT `fk.store_locator.product_id`
            FOREIGN KEY (`product_id`)
            REFERENCES `product` (`id`)
            ON DELETE SET NULL
            ON UPDATE CASCADE
    )
    ENGINE=InnoDB
    DEFAULT CHARSET=utf8mb4
    COLLATE=utf8mb4_unicode_ci;

    CREATE TABLE IF NOT EXISTS `store_locator_translation` (
        `store_locator_id` BINARY(16) NOT NULL,
        `language_id`      BINARY(16) NOT NULL,

        `name`            VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
        `city`            VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,

        `created_at`      DATETIME(3) NOT NULL,
        `updated_at`      DATETIME(3) NULL,

        PRIMARY KEY (`store_locator_id`, `language_id`),

        CONSTRAINT `fk.store_locator_translation.store_locator_id`
            FOREIGN KEY (`store_locator_id`)
            REFERENCES `store_locator` (`id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE,

        CONSTRAINT `fk.store_locator_translation.language_id`
            FOREIGN KEY (`language_id`)
            REFERENCES `language` (`id`)
            ON DELETE CASCADE
            ON UPDATE CASCADE
    )
    ENGINE=InnoDB
    DEFAULT CHARSET=utf8mb4
    COLLATE=utf8mb4_unicode_ci;

    SQL;

        $connection->executeStatement($sql);
    }

    public function updateDestructive(Connection $connection): void
    {
    }
}
