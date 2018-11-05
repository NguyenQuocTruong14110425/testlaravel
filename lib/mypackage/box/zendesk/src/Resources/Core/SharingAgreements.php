<?php

namespace Box\Zendesk\Resources\Core;

use Box\Zendesk\Resources\ResourceAbstract;
use Box\Zendesk\Traits\Resource\FindAll;

/**
 * The SharingAgreements class
 * https://developer.zendesk.com/rest_api/docs/core/sharing_agreements
 */
class SharingAgreements extends ResourceAbstract
{
    use FindAll;
}
