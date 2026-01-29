<?php declare(strict_types=1);

namespace BlogSystem\Core\Content\Blog\Aggregate\BlogTagMapping;

use BlogSystem\Core\Content\Blog\BlogDefinition;
use Shopware\Core\System\Tag\TagDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class BlogTagMappingDefinition extends EntityDefinition
{
    public const ENTITY_NAME = 'blog_tag';

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
                'tag_id',
                'tagId',
                TagDefinition::class
            ))->addFlags(new PrimaryKey(), new Required()),
        ]);
    }
}
