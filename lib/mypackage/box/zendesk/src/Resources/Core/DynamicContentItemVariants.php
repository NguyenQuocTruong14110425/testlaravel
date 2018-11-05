<?php

namespace Box\Zendesk\Resources\Core;

use Box\Zendesk\Resources\ResourceAbstract;
use Box\Zendesk\Traits\Resource\Create;
use Box\Zendesk\Traits\Resource\CreateMany;
use Box\Zendesk\Traits\Resource\Delete;
use Box\Zendesk\Traits\Resource\Find;
use Box\Zendesk\Traits\Resource\FindAll;
use Box\Zendesk\Traits\Resource\UpdateMany;

/**
 * Class DynamicContentItemVariants
 */
class DynamicContentItemVariants extends ResourceAbstract
{
    use Create;
    use Delete;
    use Find;
    use FindAll;

    use CreateMany;
    use UpdateMany;

    /**
     * {@inheritdoc}
     */
    protected $objectName = 'item';
    /**
     * {@inheritdoc}
     */
    protected $objectNamePlural = 'items';

    /**
     * {@inheritdoc}
     */
    protected function setUpRoutes()
    {
        $this->setRoutes(
            [
                'findAll'    => 'dynamic_content/items/{item_id}/variants.json',
                'find'       => 'dynamic_content/items/{item_id}/variants/{id}.json',
                'create'     => 'dynamic_content/items/{item_id}/variants.json',
                'delete'     => 'dynamic_content/items/{item_id}/variants.json',
                'createMany' => 'dynamic_content/items/{item_id}/variants/create_many.json',
                'updateMany' => 'dynamic_content/items/{item_id}/variants/update_many.json',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getRoute($name, array $params = [])
    {
        $params = $this->addChainedParametersToParams($params, ['item_id' => DynamicContentItems::class]);

        return parent::getRoute($name, $params);
    }
}
