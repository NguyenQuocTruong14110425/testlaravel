<?php

namespace Box\Zendesk\Resources\Core;

use Box\Zendesk\Resources\ResourceAbstract;
use Box\Zendesk\Traits\Resource\Find;
use Box\Zendesk\Traits\Resource\FindMany;

/**
 * Class JobStatuses
 */
class JobStatuses extends ResourceAbstract
{
    use Find;

    use FindMany;

    /**
     * {@inheritdoc}
     */
    protected $objectName = 'job_status';
    /**
     * {@inheritdoc}
     */
    protected $objectNamePlural = 'job_statuses';
}
