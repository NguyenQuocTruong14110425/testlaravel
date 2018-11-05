<?php

namespace Box\Zendesk\Resources;

use Box\Zendesk\HttpClient;
use Box\Zendesk\Resources\HelpCenter\Categories;
use Box\Zendesk\Resources\HelpCenter\Sections;
use Box\Zendesk\Resources\HelpCenter\Articles;
use Box\Zendesk\Traits\Utility\ChainedParametersTrait;
use Box\Zendesk\Traits\Utility\InstantiatorTrait;

/**
 * This class serves as a container to allow $this->client->helpCenter
 *
 * @method Categories categories()
 * @method Articles articles()
 */
class HelpCenter
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
     * @inheritdoc
     * @return array
     */
    public static function getValidSubResources()
    {
        return [
            'categories'    => Categories::class,
            'sections'      => Sections::class,
            'articles'      => Articles::class,
        ];
    }
}
