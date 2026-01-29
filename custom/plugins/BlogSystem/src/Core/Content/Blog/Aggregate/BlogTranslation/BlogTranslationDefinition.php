<?php declare(strict_types=1);

namespace BlogSystem\Core\Content\Blog\Aggregate\BlogTranslation;

use BlogSystem\Core\Content\Blog\BlogDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\System\Language\LanguageDefinition;

class BlogTranslationDefinition extends EntityTranslationDefinition
{
    public const ENTITY_NAME = 'blog_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getParentDefinitionClass(): string
    {
        return BlogDefinition::class;
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
                'language_id',
                'languageId',
                LanguageDefinition::class
            ))->addFlags(new PrimaryKey(), new Required()),

            (new StringField('name', 'name'))->addFlags(new Required()),
            (new LongTextField('description', 'description')),
        ]);
    }
}
