<?php

declare(strict_types=1);

namespace JustSteveKing\LemonSqueezy;

use JustSteveKing\LemonSqueezy\Factories\PluginFactory;
use JustSteveKing\LemonSqueezy\Resources\CustomerResource;
use JustSteveKing\LemonSqueezy\Resources\StoreResource;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use function array_merge;

use Http\Client\Common\PluginClient;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;

readonly class LemonClient
{
    public const string VERSION = '1.0.0';

    /**
     * @param Config $config
     * @param ClientInterface $client
     */
    public function __construct(
        public Config $config,
        public ClientInterface $client,
    ) {
    }

    /**
     * @param array{apiKey:string,baseUrl:null|string} $config
     * @return LemonClient
     */
    public static function squeeze(array $config): LemonClient
    {
        $client = new PluginClient(
            client: Psr18ClientDiscovery::find(),
            plugins: PluginFactory::default(
                token: $config['apiKey'],
            ),
        );

        return new LemonClient(
            config: Config::fromArray(
                data: array_merge(
                    $config,
                    [
                        'version' => self::VERSION,
                        'baseUrl' => 'https://api.lemonsqueezy.com/v1',
                    ],
                ),
            ),
            client: $client,
        );
    }

    /**
     * @return StoreResource
     */
    public function stores(): StoreResource
    {
        return new StoreResource(
            client: $this,
        );
    }

    /**
     * @return CustomerResource
     */
    public function customers(): CustomerResource
    {
        return new CustomerResource(
            client: $this,
        );
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        return $this->client->sendRequest(
            request: $request,
        );
    }
}
