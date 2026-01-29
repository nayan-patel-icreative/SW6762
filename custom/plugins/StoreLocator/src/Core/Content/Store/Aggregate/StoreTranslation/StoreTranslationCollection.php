<?php declare(strict_types=1);

namespace StoreLocator\Core\Content\Store\Aggregate\StoreTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void add(StoreTranslationEntity $entity)
 * @method void set(string $key, StoreTranslationEntity $entity)
 * @method StoreTranslationEntity[] getIterator()
 * @method StoreTranslationEntity[] getElements()
 * @method StoreTranslationEntity|null get(string $key)
 * @method StoreTranslationEntity|null first()
 * @method StoreTranslationEntity|null last()
 */
class StoreTranslationCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return StoreTranslationEntity::class;
    }
}
