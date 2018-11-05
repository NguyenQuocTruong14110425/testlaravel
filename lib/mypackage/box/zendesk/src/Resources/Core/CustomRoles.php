<?php

namespace Box\Zendesk\Resources\Core;

use Box\Zendesk\Resources\ResourceAbstract;
use Box\Zendesk\Traits\Resource\FindAll;

/**
 * Class CustomRoles
 * https://developer.zendesk.com/rest_api/docs/core/custom_roles
 */
class CustomRoles extends ResourceAbstract
{
    use FindAll;
}
