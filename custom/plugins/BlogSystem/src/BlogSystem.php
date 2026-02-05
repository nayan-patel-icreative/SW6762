<?php declare(strict_types=1);

namespace BlogSystem;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;

class BlogSystem extends Plugin
{
    public function getAdministrationEntryPath(): string
    {
        return 'Resources/app/administration/src/main.js';
    }

    public function uninstall(UninstallContext $uninstallContext): void
    {
        parent::uninstall($uninstallContext);

        if ($uninstallContext->keepUserData()) {
            return;
        }

        $connection = $this->container->get(Connection::class);

        $connection->executeStatement('DROP TABLE IF EXISTS `blog_product`');
        $connection->executeStatement('DROP TABLE IF EXISTS `blog_translation`');
        $connection->executeStatement('DROP TABLE IF EXISTS `blog`');
        $connection->executeStatement('DROP TABLE IF EXISTS `blog_category_translation`');
        $connection->executeStatement('DROP TABLE IF EXISTS `blog_category`');
    }
}
