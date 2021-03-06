<?php

namespace Box\Zendesk\Resources\Core;

use Box\Zendesk\Resources\ResourceAbstract;
use Box\Zendesk\Traits\Resource\Defaults;

/**
 * The Automations class exposes methods seen at http://developer.zendesk.com/documentation/rest_api/automations.html
 *
 * @package Box\Zendesk
 */
class Automations extends ResourceAbstract
{
    use Defaults;

    /**
     * {@inheritdoc}
     */
    protected function setUpRoutes()
    {
        $this->setRoute('findActive', "{$this->resourceName}/active.json");
    }

    /**
     * List all active Automations
     *
     * @param array $params
     *
     * @throws \Exception
     * @return \stdClass | null
     */
    public function findActive(array $params = [])
    {
        return $this->client->get($this->getRoute(__FUNCTION__), $params);
    }
}
