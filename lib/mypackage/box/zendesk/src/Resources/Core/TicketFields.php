<?php
namespace Box\Zendesk\Resources\Core;

use Box\Zendesk\Resources\ResourceAbstract;
use Box\Zendesk\Traits\Resource\Defaults;
use Box\Zendesk\Traits\Utility\InstantiatorTrait;

/**
 * The TicketFields class exposes field management methods for tickets
 */
class TicketFields extends ResourceAbstract
{
    use InstantiatorTrait;

    use Defaults;

    protected $resourceName = 'ticket_fields';

    /**
     * {@inheritdoc}
     */
    public static function getValidSubResources()
    {
        return [
            'options' => TicketFieldsOptions::class,
        ];
    }
}
