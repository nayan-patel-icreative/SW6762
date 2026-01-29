<?php declare(strict_types=1);

namespace StoreLocator\Core\Extensions;

use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\System\Language\LanguageDefinition;
use StoreLocator\Core\Content\Store\Aggregate\StoreTranslation\StoreTranslationDefinition;

class LanguageExtension extends EntityExtension
{
    public function getEntityName(): string
    {
        return LanguageDefinition::ENTITY_NAME;
    }

    public function getDefinitionClass(): string
    {
        return LanguageDefinition::class;
    }

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new OneToManyAssociationField(
                'storeTranslations',
                StoreTranslationDefinition::class,
                'language_id'
            )
        );
    }
}
