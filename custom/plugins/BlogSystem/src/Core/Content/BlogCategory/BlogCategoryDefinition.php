<?php declare(strict_types=1);

namespace BlogSystem\Core\Content\BlogCategory;

use BlogSystem\Core\Content\BlogCategory\Aggregate\BlogCategoryTranslation\BlogCategoryTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslatedField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\TranslationsAssociationField;
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

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([

            (new IdField('id', 'id'))->addFlags(
                new PrimaryKey(),
                new Required()
            ),

            new TranslatedField('name'),

            new TranslationsAssociationField(
                BlogCategoryTranslationDefinition::class,
                'blog_category_id'
            ),
        ]);
    }
}
