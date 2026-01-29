<?php declare(strict_types=1);

namespace BlogSystem\Core\Content\Blog\Aggregate\BlogCategoryMapping;

use BlogSystem\Core\Content\Blog\BlogDefinition;
use BlogSystem\Core\Content\BlogCategory\BlogCategoryDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class BlogCategoryMappingDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'blog_blog_category';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([

            (new FkField(
                'blog_id',
                'blogId',
                BlogDefinition::class
            ))->addFlags(new PrimaryKey(), new Required()),

            (new FkField(
                'blog_category_id',
                'blogCategoryId',
                BlogCategoryDefinition::class
            ))->addFlags(new PrimaryKey(), new Required()),
        ]);
    }
}
