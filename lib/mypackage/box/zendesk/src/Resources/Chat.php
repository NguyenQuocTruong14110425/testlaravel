<?php

namespace Box\Zendesk\Resources;

use Box\Zendesk\HttpClient;
use Box\Zendesk\Resources\Chat\Apps;
use Box\Zendesk\Resources\Chat\Integrations;
use Box\Zendesk\Traits\Utility\ChainedParametersTrait;
use Box\Zendesk\Traits\Utility\InstantiatorTrait;

/**
 * This class serves as a container to allow calls to $this->client->chat
 *
 * @method Apps apps()
 */
class Chat
{
    use ChainedParametersTrait;
    use InstantiatorTrait;

    public $client;

    /**
     * Sets the client to be used
     *
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritDoc}
     */
    public static function getValidSubResources()
    {
        return [
            'apps' => Apps::class,
            'integrations' => Integrations::class,
        ];
    }
}
