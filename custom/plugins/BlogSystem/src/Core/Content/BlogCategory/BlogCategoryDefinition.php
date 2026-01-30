<?php declare(strict_types=1);

namespace BlogSystem\Core\Content\BlogCategory;

use BlogSystem\Core\Content\BlogCategory\Aggregate\BlogCategoryTranslation\BlogCategoryTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\CreatedAtField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\UpdatedAtField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;

class BlogCategoryDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'blog_category';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return BlogCategoryEntity::class;
    }

    public function getCollectionClass(): string
    {
        return BlogCategoryCollection::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([

            (new IdField('id', 'id'))->addFlags(
                new PrimaryKey(),
                new Required()
            ),

            new CreatedAtField(),
            new UpdatedAtField(),

            (new TranslatedField('name'))->addFlags(new Required()),

            new TranslationsAssociationField(
                BlogCategoryTranslationDefinition::class,
                'blog_category_id'
            ),
        ]);
    }
}
