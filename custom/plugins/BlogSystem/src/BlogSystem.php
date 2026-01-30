<?php declare(strict_types=1);

namespace BlogSystem;

use Shopware\Core\Framework\Plugin;

class BlogSystem extends Plugin
{
    public function getAdministrationEntryPath(): string
    {
        return 'Resources/app/administration/src/main.js';
    }
}
