<?php declare(strict_types=1);

namespace HelloWorld\Core\Content\ExampleEntity;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void add(ExampleEntityEntity $entity)
 * @method void set(string $key, ExampleEntityEntity $entity)
 * @method ExampleEntityEntity[] getIterator()
 * @method ExampleEntityEntity[] getElements()
 * @method ExampleEntityEntity|null get(string $key)
 * @method ExampleEntityEntity|null first()
 * @method ExampleEntityEntity|null last()
 */
class ExampleEntityCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return ExampleEntityEntity::class;
    }
}
