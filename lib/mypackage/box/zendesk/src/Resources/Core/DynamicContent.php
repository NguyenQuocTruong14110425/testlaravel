<?php

namespace Box\Zendesk\Resources\Core;

use Box\Zendesk\Resources\ResourceAbstract;
use Box\Zendesk\Traits\Utility\InstantiatorTrait;

/**
 * Class DynamicContent
 *
 * @method DynamicContentItems items()
 */
class DynamicContent extends ResourceAbstract
{
    use InstantiatorTrait;

    /**
     * {@inheritdoc}
     */
    public static function getValidSubResources()
    {
        return [
            'items' => DynamicContentItems::class,
        ];
    }
}
