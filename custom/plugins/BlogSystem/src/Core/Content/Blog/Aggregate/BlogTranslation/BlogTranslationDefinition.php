<?php declare(strict_types=1);

namespace BlogSystem\Core\Content\Blog\Aggregate\BlogTranslation;

use BlogSystem\Core\Content\Blog\BlogDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;

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
            (new StringField('name', 'name'))->addFlags(new Required()),
            new LongTextField('description', 'description'),
        ]);
    }
}
