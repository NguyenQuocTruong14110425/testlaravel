<?php

namespace Box\Zendesk\Resources\Core;

use Box\Zendesk\Resources\ResourceAbstract;
use Box\Zendesk\Traits\Resource\Create;
use Box\Zendesk\Traits\Resource\Delete;
use Box\Zendesk\Traits\Resource\FindAll;

/**
 * Class Bookmarks
 */
class Bookmarks extends ResourceAbstract
{
    use FindAll;
    use Create;
    use Delete;
}
