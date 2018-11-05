<?php

namespace Box\Zendesk\Resources\Core;

use Box\Zendesk\Resources\ResourceAbstract;
use Box\Zendesk\Traits\Resource\Defaults;
use Box\Zendesk\Traits\Utility\InstantiatorTrait;

/**
 * Class DynamicContentItems
 *
 * @method DynamicContentItemVariants variants()
 */
class DynamicContentItems extends ResourceAbstract
{
    use InstantiatorTrait;

    use Defaults;

    /**
     * {@inheritdoc}
     */
    protected $objectName = 'item';
    /**
     * {@inheritdoc}
     */
    protected $objectNamePlural = 'items';

    /**
     * @var string
     */
    protected $resourceName = 'dynamic_content/items';

    /**
     * {@inheritdoc}
     */
    public static function getValidSubResources()
    {
        return [
            'variants' => DynamicContentItemVariants::class,
        ];
    }
}
