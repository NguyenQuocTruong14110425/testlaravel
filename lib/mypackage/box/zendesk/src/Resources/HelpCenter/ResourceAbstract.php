<?php

namespace Box\Zendesk\Resources\HelpCenter;

use Box\Zendesk\Traits\Resource\ResourceName;

/**
 * Abstract class for HelpCenter resources
 */
abstract class ResourceAbstract extends \Box\Zendesk\Resources\ResourceAbstract
{
    use ResourceName;

    /**
     * @var $prefix
     **/
    protected $prefix = 'help_center/';
}
