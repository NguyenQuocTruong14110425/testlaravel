<?php

namespace Box\Zendesk\Resources\Core;

use Box\Zendesk\Resources\ResourceAbstract;
use Box\Zendesk\Traits\Resource\Find;
use Box\Zendesk\Traits\Resource\FindAll;

/**
 * The Activities class exposes methods for retrieving activities
 * https://developer.zendesk.com/rest_api/docs/core/activity_stream
 */
class Activities extends ResourceAbstract
{
    use Find;
    use FindAll;
}
