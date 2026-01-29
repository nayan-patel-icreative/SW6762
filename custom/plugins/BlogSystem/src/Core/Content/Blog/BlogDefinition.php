<?php declare(strict_types=1);

namespace BlogSystem\Core\Content\Blog;

use BlogSystem\Core\Content\Blog\Aggregate\BlogCategoryMapping\BlogCategoryMappingDefinition;
use BlogSystem\Core\Content\Blog\Aggregate\BlogProductMapping\BlogProductMappingDefinition;
use BlogSystem\Core\Content\Blog\Aggregate\BlogTagMapping\BlogTagMappingDefinition;
use BlogSystem\Core\Content\Blog\Aggregate\BlogTranslation\BlogTranslationDefinition;
use BlogSystem\Core\Content\BlogCategory\BlogCategoryDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\System\Tag\TagDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\DateTimeField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;

class BlogDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'blog';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([

            (new IdField('id', 'id'))->addFlags(
                new PrimaryKey(),
                new Required()
            ),

            (new BoolField('active', 'active'))->addFlags(new Required()),

            (new DateTimeField('release_date', 'releaseDate')),

            (new StringField('author', 'author'))->addFlags(new Required()),

            (new StringField('slug', 'slug'))->addFlags(
                new Required()
            ),

            new TranslatedField('name'),
            new TranslatedField('description'),
            new TranslatedField('teaser'),

            new TranslationsAssociationField(
                BlogTranslationDefinition::class,
                'blog_id'
            ),

            new ManyToManyAssociationField(
                'categories',
                BlogCategoryDefinition::class,
                BlogCategoryMappingDefinition::class,
                'blog_id',
                'blog_category_id'
            ),

            new ManyToManyAssociationField(
                'products',
                ProductDefinition::class,
                BlogProductMappingDefinition::class,
                'blog_id',
                'product_id'
            ),

            new ManyToManyAssociationField(
                'tags',
                TagDefinition::class,
                BlogTagMappingDefinition::class,
                'blog_id',
                'tag_id'
            ),
        ]);
    }
}
