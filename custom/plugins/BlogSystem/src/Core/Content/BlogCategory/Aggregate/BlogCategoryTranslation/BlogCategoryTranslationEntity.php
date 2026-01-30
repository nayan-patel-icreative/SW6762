<?php declare(strict_types=1);

namespace BlogSystem\Core\Content\BlogCategory\Aggregate\BlogCategoryTranslation;

use BlogSystem\Core\Content\BlogCategory\BlogCategoryEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\System\Language\LanguageEntity;

class BlogCategoryTranslationEntity extends Entity
{
    use EntityIdTrait;

    protected string $blogCategoryId;

    protected string $languageId;

    protected ?string $name = null;

    protected ?BlogCategoryEntity $blogCategory = null;

    protected ?LanguageEntity $language = null;

    public function getBlogCategoryId(): string
    {
        return $this->blogCategoryId;
    }

    public function setBlogCategoryId(string $blogCategoryId): void
    {
        $this->blogCategoryId = $blogCategoryId;
    }

    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    public function setLanguageId(string $languageId): void
    {
        $this->languageId = $languageId;
    }

    public function getBlogCategory(): ?BlogCategoryEntity
    {
        return $this->blogCategory;
    }

    public function setBlogCategory(?BlogCategoryEntity $blogCategory): void
    {
        $this->blogCategory = $blogCategory;
    }

    public function getLanguage(): ?LanguageEntity
    {
        return $this->language;
    }

    public function setLanguage(?LanguageEntity $language): void
    {
        $this->language = $language;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
