<?php declare(strict_types=1);

namespace BlogSystem\Core\Content\BlogCategory;

use BlogSystem\Core\Content\BlogCategory\Aggregate\BlogCategoryTranslation\BlogCategoryTranslationCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class BlogCategoryEntity extends Entity
{
    use EntityIdTrait;

    protected ?string $name = null;

    protected ?BlogCategoryTranslationCollection $translations = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getTranslations(): ?BlogCategoryTranslationCollection
    {
        return $this->translations;
    }

    public function setTranslations(BlogCategoryTranslationCollection $translations): void
    {
        $this->translations = $translations;
    }
}
