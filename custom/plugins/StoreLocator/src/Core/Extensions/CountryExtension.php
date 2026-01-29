<?php declare(strict_types=1);

namespace StoreLocator\Core\Extensions;

use Shopware\Core\System\Country\CountryDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use StoreLocator\Core\Content\Store\StoreDefinition;

class CountryExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new OneToManyAssociationField('stores', StoreDefinition::class, 'country_id')
        );
    }

    public function getDefinitionClass(): string
    {
        return CountryDefinition::class;
    }

    public function getEntityName(): string
    {
        return 'country';
    }
}