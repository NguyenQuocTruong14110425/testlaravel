<?php

namespace Box\Zendesk\Resources\Core;

use Box\Zendesk\Resources\ResourceAbstract;
use Box\Zendesk\Traits\Resource\Find;
use Box\Zendesk\Traits\Resource\FindAll;

/**
 * Class AppInstallationLocations
 * https://developer.zendesk.com/rest_api/docs/core/app_location_installations
 */
class AppInstallationLocations extends ResourceAbstract
{
    use FindAll;
    use Find;

    /**
     * {@inheritdoc}
     */
    protected $resourceName = 'apps/location_installations';

    /**
     *
     */
    protected function setUpRoutes()
    {
        parent::setUpRoutes();

        $this->setRoute('reorder', "{$this->resourceName}/reorder.json");
    }

    /**
     * Creates or updates the relevant Location Installation record with the installation order specified
     *
     * @param array $params
     *
     * @return \stdClass | null
     * @throws \Box\Zendesk\Exceptions\RouteException
     */
    public function reorder(array $params)
    {
        return $this->client->post($this->getRoute(__FUNCTION__), $params);
    }
}
