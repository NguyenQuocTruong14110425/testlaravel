<?php

namespace Box\Zendesk\Traits\Resource;

/**
 * This trait gives resources access to the default CRUD methods.
 *
 * @package Box\Zendesk\Traits\Resource
 */
trait Defaults
{
    use Find;
    use FindAll;
    use Delete;
    use Create;
    use Update;
}
