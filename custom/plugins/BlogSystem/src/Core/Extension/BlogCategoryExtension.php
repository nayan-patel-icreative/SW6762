<?php declare(strict_types=1);

namespace BlogSystem\Core\Extension;

use BlogSystem\Core\Content\Blog\BlogDefinition;
use BlogSystem\Core\Content\BlogCategory\BlogCategoryDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class BlogCategoryExtension extends EntityExtension
{
    public function getDefinitionClass(): string
    {
        return BlogCategoryDefinition::class;
    }

    public function getEntityName(): string
    {
        return 'blog_category';
    }

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new OneToManyAssociationField(
                'blogs',
                BlogDefinition::class,
                'blog_category_id'
            )
        );
    }
}
