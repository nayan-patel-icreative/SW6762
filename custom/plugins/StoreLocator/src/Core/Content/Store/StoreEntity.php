<?php declare(strict_types=1);

namespace StoreLocator\Core\Content\Store;

use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\System\Country\CountryEntity;
use Shopware\Core\System\StateMachine\Aggregation\StateMachineState\StateMachineStateEntity;
use StoreLocator\Core\Content\Store\Aggregate\StoreTranslation\StoreTranslationCollection;

class StoreEntity extends Entity
{
    use EntityIdTrait;

    protected bool $active = false;

    protected ?string $countryId = null;
    protected ?string $stateId = null;
    protected ?string $mediaId = null;
    protected ?string $productId = null;
    protected ?string $name = null;
    protected ?string $city = null;

    protected ?CountryEntity $country = null;
    protected ?StateMachineStateEntity $state = null;
    protected ?ProductEntity $product = null;
    protected ?MediaEntity $image = null;

    protected StoreTranslationCollection $translations;

    public function getTranslations(): ?StoreTranslationCollection
    {
        return $this->translations;
    }

    public function setTranslations(StoreTranslationCollection $translations): void
    {
        $this->translations = $translations;
    }

    // Optional helpers
    public function getName(): ?string
    {
        return $this->name ?? ($this->getTranslated()['name'] ?? null);
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getCity(): ?string
    {
        return $this->city ?? ($this->getTranslated()['city'] ?? null);
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }


    // Active
    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    // Country
    public function getCountryId(): ?string
    {
        return $this->countryId;
    }

    public function setCountryId(?string $countryId): void
    {
        $this->countryId = $countryId;
    }

    public function getCountry(): ?CountryEntity
    {
        return $this->country;
    }

    public function setCountry(?CountryEntity $country): void
    {
        $this->country = $country;
    }

    // State
    public function getStateId(): ?string
    {
        return $this->stateId;
    }

    public function setStateId(?string $stateId): void
    {
        $this->stateId = $stateId;
    }

    public function getState(): ?StateMachineStateEntity
    {
        return $this->state;
    }

    public function setState(?StateMachineStateEntity $state): void
    {
        $this->state = $state;
    }

    // Product
    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function setProductId(?string $productId): void
    {
        $this->productId = $productId;
    }

    public function getProduct(): ?ProductEntity
    {
        return $this->product;
    }

    public function setProduct(?ProductEntity $product): void
    {
        $this->product = $product;
    }

    // Image
    public function getMediaId(): ?string
    {
        return $this->mediaId;
    }

    public function setMediaId(?string $mediaId): void
    {
        $this->mediaId = $mediaId;
    }

    public function getImage(): ?MediaEntity
    {
        return $this->image;
    }

    public function setImage(?MediaEntity $image): void
    {
        $this->image = $image;
    }
}
