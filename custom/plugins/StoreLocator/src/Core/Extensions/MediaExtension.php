<?php declare(strict_types=1);

namespace StoreLocator\Core\Extensions;

use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use StoreLocator\Core\Content\Store\StoreDefinition;

class MediaExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new OneToOneAssociationField('store', 'id', 'media_id', StoreDefinition::class, false)
        );
    }

    public function getDefinitionClass(): string
    {
        return MediaDefinition::class;
    }

    public function getEntityName(): string
    {
        return MediaDefinition::ENTITY_NAME;
    }
}