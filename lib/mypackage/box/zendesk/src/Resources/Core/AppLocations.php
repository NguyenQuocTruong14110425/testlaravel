<?php

namespace Box\Zendesk\Resources\Core;

use Box\Zendesk\Resources\ResourceAbstract;
use Box\Zendesk\Traits\Resource\Find;
use Box\Zendesk\Traits\Resource\FindAll;

/**
 * The AppLocations class exposes methods seen at
 * https://developer.zendesk.com/rest_api/docs/core/app_locations
 */
class AppLocations extends ResourceAbstract
{
    use Find;
    use FindAll;

    /**
     * {@inheritdoc}
     */
    protected $objectName = 'location';
    /**
     * {@inheritdoc}
     */
    protected $objectNamePlural = 'locations';

    /**
     * @var string
     */
    protected $resourceName = 'apps/locations';
}
