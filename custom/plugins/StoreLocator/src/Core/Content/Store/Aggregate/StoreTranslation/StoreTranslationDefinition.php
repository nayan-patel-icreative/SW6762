<?php declare(strict_types=1);

namespace StoreLocator\Core\Content\Store\Aggregate\StoreTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Language\LanguageDefinition;
use StoreLocator\Core\Content\Store\StoreDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\CreatedAtField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\UpdatedAtField;

class StoreTranslationDefinition extends EntityTranslationDefinition
{
    public const ENTITY_NAME = 'store_locator_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return StoreTranslationEntity::class;
    }

    public function getParentDefinitionClass(): string
    {
        return StoreDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([

            (new FkField(
                'store_locator_id',
                'storeLocatorId',
                StoreDefinition::class
            ))->addFlags(new PrimaryKey(), new Required()),

            new ManyToOneAssociationField(
                'storeLocator',
                'store_locator_id',
                StoreDefinition::class,
                'id'
            ),

            (new FkField(
                'language_id',
                'languageId',
                LanguageDefinition::class
            ))->addFlags(new PrimaryKey(), new Required()),

            new StringField('name', 'name'),
            new StringField('city', 'city'),

            new CreatedAtField(),
            new UpdatedAtField(),
        ]);
    }
}
