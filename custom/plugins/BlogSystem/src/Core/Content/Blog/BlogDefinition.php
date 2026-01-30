<?php declare(strict_types=1);

namespace BlogSystem\Core\Content\Blog;

use BlogSystem\Core\Content\Blog\Aggregate\BlogTranslation\BlogTranslationDefinition;
use BlogSystem\Core\Content\Blog\Aggregate\BlogProductMapping\BlogProductMappingDefinition;
use BlogSystem\Core\Content\BlogCategory\BlogCategoryDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\CreatedAtField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\DateTimeField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\UpdatedAtField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;

class BlogDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'blog';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return BlogEntity::class;
    }

    public function getCollectionClass(): string
    {
        return BlogCollection::class;
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

            (new BoolField('active', 'active'))->addFlags(new Required()),

            (new DateTimeField('release_date', 'releaseDate')),

            (new StringField('author', 'author'))->addFlags(new Required()),

            (new FkField(
                'blog_category_id',
                'blogCategoryId',
                BlogCategoryDefinition::class
            )),

            new ManyToOneAssociationField(
                'category',
                'blog_category_id',
                BlogCategoryDefinition::class,
                'id'
            ),

            (new TranslatedField('name'))->addFlags(new Required()),
            new TranslatedField('description'),

            new TranslationsAssociationField(
                BlogTranslationDefinition::class,
                'blog_id'
            ),

            new ManyToManyAssociationField(
                'products',
                ProductDefinition::class,
                BlogProductMappingDefinition::class,
                'blog_id',
                'product_id'
            ),
        ]);
    }
}
