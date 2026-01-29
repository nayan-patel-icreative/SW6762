<?php declare(strict_types=1);

namespace StoreLocator\Core\Content\Store\Aggregate\StoreTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\System\Language\LanguageEntity;
use StoreLocator\Core\Content\Store\StoreEntity;

class StoreTranslationEntity extends Entity
{
    use EntityIdTrait;

    protected string $storeLocatorId;

    protected string $languageId;

    protected string $name;

    protected string $city;

    protected ?StoreEntity $storeLocator = null;

    protected ?LanguageEntity $language = null;

    // Store
    public function getStoreLocatorId(): string
    {
        return $this->storeLocatorId;
    }

    public function setStoreLocatorId(string $storeLocatorId): void
    {
        $this->storeLocatorId = $storeLocatorId;
    }

    // Language
    public function getLanguageId(): string
    {
        return $this->languageId;
    }

    public function setLanguageId(string $languageId): void
    {
        $this->languageId = $languageId;
    }

    // Name
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    // City
    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getLanguage(): ?LanguageEntity
    {
        return $this->language;
    }

    public function setLanguage(?LanguageEntity $language): void
    {
        $this->language = $language;
    }

    public function getStoreLocator(): ?StoreEntity
    {
        return $this->storeLocator;
    }

    public function setStoreLocator(?StoreEntity $storeLocator): void
    {
        $this->storeLocator = $storeLocator;
    }
}
