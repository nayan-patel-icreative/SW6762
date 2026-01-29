<?php declare(strict_types=1);

namespace BlogSystem\Core\Content\BlogCategory\Aggregate\BlogCategoryTranslation;

use BlogSystem\Core\Content\BlogCategory\BlogCategoryDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Language\LanguageDefinition;

class BlogCategoryTranslationDefinition extends EntityTranslationDefinition
{
    public const ENTITY_NAME = 'blog_category_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getParentDefinitionClass(): string
    {
        return BlogCategoryDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([

            (new FkField(
                'blog_category_id',
                'blogCategoryId',
                BlogCategoryDefinition::class
            ))->addFlags(new PrimaryKey(), new Required()),

            (new FkField(
                'language_id',
                'languageId',
                LanguageDefinition::class
            ))->addFlags(new PrimaryKey(), new Required()),

            (new StringField('name', 'name'))->addFlags(new Required()),
        ]);
    }
}
