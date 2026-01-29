<?php declare(strict_types=1);

namespace BlogSystem\Core\Extension;

use BlogSystem\Core\Content\Blog\Aggregate\BlogProductMapping\BlogProductMappingDefinition;
use BlogSystem\Core\Content\Blog\BlogDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ProductExtension extends EntityExtension
{
    public function getDefinitionClass(): string
    {
        return ProductDefinition::class;
    }

    public function getEntityName(): string
    {
        return 'product';
    }

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new ManyToManyAssociationField(
                'blogs',
                BlogDefinition::class,
                BlogProductMappingDefinition::class,
                'product_id',
                'blog_id'
            )
        );
    }
}
