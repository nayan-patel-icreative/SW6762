<?php declare(strict_types=1);

namespace StoreLocator\Core\Content\Store;

use Shopware\Core\Content\Media\MediaDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Country\CountryDefinition;
use Shopware\Core\System\StateMachine\Aggregation\StateMachineState\StateMachineStateDefinition;
use StoreLocator\Core\Content\Store\Aggregate\StoreTranslation\StoreTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ReferenceVersionField;

class StoreDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'store_locator';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return StoreEntity::class;
    }

    public function getCollectionClass(): string
    {
        return StoreCollection::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([

            (new IdField('id', 'id'))->addFlags(
                new PrimaryKey(),
                new Required(),
            ),

            new TranslatedField('name'),
            new TranslatedField('city'),

            (new BoolField('active', 'active')),

            (new FkField('country_id', 'countryId', CountryDefinition::class)),

            (new FkField('state_id', 'stateId', StateMachineStateDefinition::class)),

            (new FkField('media_id', 'mediaId', MediaDefinition::class)),

            (new FkField('product_id', 'productId', ProductDefinition::class)),
            new ReferenceVersionField(ProductDefinition::class),

            new ManyToOneAssociationField(
                'country',
                'country_id',
                CountryDefinition::class,
                'id'
            ),

            new ManyToOneAssociationField(
                'state',
                'state_id',
                StateMachineStateDefinition::class,
                'id'
            ),

            new ManyToOneAssociationField(
                'product',
                'product_id',
                ProductDefinition::class,
                'id'
            ),

            new OneToOneAssociationField(
                'image',
                'media_id',
                'id',
                MediaDefinition::class,
                false
            ),

            new TranslationsAssociationField(
                StoreTranslationDefinition::class,
                'store_locator_id'
            ),
        ]);
    }
}
