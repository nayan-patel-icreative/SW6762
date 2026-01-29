<?php declare(strict_types=1);

namespace BlogSystem\Core\Extension;

use BlogSystem\Core\Content\Blog\Aggregate\BlogTranslation\BlogTranslationDefinition;
use BlogSystem\Core\Content\BlogCategory\Aggregate\BlogCategoryTranslation\BlogCategoryTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Language\LanguageDefinition;

class LanguageExtension extends EntityExtension
{
    public function getDefinitionClass(): string
    {
        return LanguageDefinition::class;
    }

    public function getEntityName(): string
    {
        return 'language';
    }

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new OneToManyAssociationField(
                'blogTranslations',
                BlogTranslationDefinition::class,
                'language_id'
            )
        );

        $collection->add(
            new OneToManyAssociationField(
                'blogCategoryTranslations',
                BlogCategoryTranslationDefinition::class,
                'language_id'
            )
        );
    }
}
