<?php

namespace Box\Zendesk\Resources\Voice;

use Box\Zendesk\Traits\Resource\ResourceName;

/**
 * Abstract class for Voice resources
 */
abstract class ResourceAbstract extends \Box\Zendesk\Resources\ResourceAbstract
{
    use ResourceName;

    /**
     * @var $prefix
     **/
    protected $prefix = 'channels/voice/';
}
