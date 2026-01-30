<?php declare(strict_types=1);

namespace BlogSystem\Core\Content\Blog;

use BlogSystem\Core\Content\Blog\Aggregate\BlogTranslation\BlogTranslationCollection;
use BlogSystem\Core\Content\BlogCategory\BlogCategoryEntity;
use Shopware\Core\Content\Product\ProductCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class BlogEntity extends Entity
{
    use EntityIdTrait;

    protected bool $active = false;

    protected ?\DateTime $releaseDate = null;

    protected string $author = '';

    protected ?string $blogCategoryId = null;

    protected ?BlogCategoryEntity $category = null;

    protected ?string $name = null;

    protected ?string $description = null;

    protected ?BlogTranslationCollection $translations = null;

    protected ?ProductCollection $products = null;

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getReleaseDate(): ?\DateTime
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTime $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getBlogCategoryId(): ?string
    {
        return $this->blogCategoryId;
    }

    public function setBlogCategoryId(?string $blogCategoryId): void
    {
        $this->blogCategoryId = $blogCategoryId;
    }

    public function getCategory(): ?BlogCategoryEntity
    {
        return $this->category;
    }

    public function setCategory(?BlogCategoryEntity $category): void
    {
        $this->category = $category;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getTranslations(): ?BlogTranslationCollection
    {
        return $this->translations;
    }

    public function setTranslations(BlogTranslationCollection $translations): void
    {
        $this->translations = $translations;
    }

    public function getProducts(): ?ProductCollection
    {
        return $this->products;
    }

    public function setProducts(ProductCollection $products): void
    {
        $this->products = $products;
    }
}
