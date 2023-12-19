<?php

declare(strict_types=1);

namespace JustSteveKing\LemonSqueezy\Resources\Concerns;

use Http\Discovery\Psr17FactoryDiscovery;
use JsonException;
use JustSteveKing\LemonSqueezy\LemonClient;
use JustSteveKing\Tools\Http\Enums\Method;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

use function json_decode;

trait CanSqueezeLemons
{
    public function __construct(
        protected readonly LemonClient $client,
    ) {
    }

    public function buildRequest(Method $method, string $uri): RequestInterface
    {
        return Psr17FactoryDiscovery::findRequestFactory()->createRequest(
            method: $method->value,
            uri: $uri,
        );
    }

    /**
     * @param ResponseInterface $response
     * @return array{meta:array,jsonapi:array,links:array,data:array}
     * @throws JsonException
     */
    public function decodeResponse(ResponseInterface $response): array
    {
        return json_decode(
            json: $response->getBody()->getContents(),
            associative: true,
            flags: JSON_THROW_ON_ERROR,
        );
    }
}
