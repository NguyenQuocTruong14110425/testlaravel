<?php

namespace Box\Zendesk\Resources\Embeddable;

use Box\Zendesk\Traits\Resource\ResourceName;

/**
 * Abstract class for Embeddable resources
 */
abstract class ResourceAbstract extends \Box\Zendesk\Resources\ResourceAbstract
{
    use ResourceName;

    /**
     * @var string
     **/
    protected $prefix = 'embeddable/api/';

    /**
     * @var string
     */
    protected $apiBasePath = '';
}
