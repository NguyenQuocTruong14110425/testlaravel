<?php

namespace Box\Zendesk\Resources\Core;

use Box\Zendesk\Resources\ResourceAbstract;
use Box\Zendesk\Traits\Resource\Find;
use Box\Zendesk\Traits\Resource\FindAll;

/**
 * The TicketMetrics class exposes metrics methods for tickets
 */
class TicketMetrics extends ResourceAbstract
{
    use FindAll;
    use Find;

    protected $resourceName = 'ticket_metrics';

    /**
     * {@inheritdoc}
     */
    protected function setUpRoutes()
    {
        $this->setRoute('findAll', "{$this->resourceName}.json");
        $this->setRoute('find', "{$this->resourceName}/{id}.json");
    }

    /**
     * {@inheritdoc}
     */
    public function getRoute($name, array $params = [])
    {
        if ('find' === $name || 'findAll' === $name) {
            $lastChained = $this->getChainedParameter(Tickets::class);

            if (! empty($lastChained)) {
                return "tickets/$lastChained/metrics.json";
            }
        }

        return parent::getRoute($name, $params);
    }
}
