<?php declare(strict_types=1);

namespace StoreLocator\Core\Extensions;

use Shopware\Core\System\StateMachine\Aggregation\StateMachineState\StateMachineStateDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\OneToManyAssociationField;
use StoreLocator\Core\Content\Store\StoreDefinition;

class StateMachineStateExtension extends EntityExtension
{
    public function getEntityName(): string
    {
        return StateMachineStateDefinition::ENTITY_NAME;
    }

    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new OneToManyAssociationField('stores', StoreDefinition::class, 'state_id')
        );
    }

    public function getDefinitionClass(): string
    {
        return StateMachineStateDefinition::class;
    }
}