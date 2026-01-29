<?php declare(strict_types=1);

namespace StoreLocator\Core\Content\Store;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void add(StoreEntity $entity)
 * @method void set(string $key, StoreEntity $entity)
 * @method StoreEntity[] getIterator()
 * @method StoreEntity[] getElements()
 * @method StoreEntity|null get(string $key)
 * @method StoreEntity|null first()
 * @method StoreEntity|null last()
 */
class StoreCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return StoreEntity::class;
    }
}
