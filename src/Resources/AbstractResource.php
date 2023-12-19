<?php

declare(strict_types=1);

namespace JustSteveKing\LemonSqueezy\Resources;

use JsonException;
use JustSteveKing\LemonSqueezy\Contracts\DataObjectContract;
use JustSteveKing\LemonSqueezy\DataObjects\Customer;
use JustSteveKing\LemonSqueezy\Exceptions\Stores\FailedToFetchAllCustomers;
use JustSteveKing\LemonSqueezy\Resources\Concerns\CanSqueezeLemons;
use JustSteveKing\Tools\Http\Enums\Method;
use Psr\Http\Client\ClientExceptionInterface;
use Throwable;

abstract class AbstractResource
{
    use CanSqueezeLemons;

    /**
     * @return string
     */
    abstract public function resourcePath(): string;

    /**
     * @param array<string,mixed> $data
     * @return DataObjectContract
     */
    abstract public function createDataObject(array $data): DataObjectContract;

    /**
     * @param Throwable $exception
     * @return Throwable
     */
    abstract public function exception(Throwable $exception): Throwable;

    /**
     * @return array<int,DataObjectContract>
     * @throws FailedToFetchAllCustomers
     * @throws JsonException|ClientExceptionInterface|Throwable
     */
    public function all(): array
    {
        try {
            $data = $this->decodeResponse(
                response: $this->client->send(
                    request: $this->buildRequest(
                        method: Method::GET,
                        uri: $this->resourcePath(),
                    ),
                ),
            );
        } catch (Throwable $exception) {
            throw $this->exception(
                exception: $exception,
            );
        }

        return array_map(
            callback: fn (array $customer): DataObjectContract => $this->createDataObject(
                data: $customer,
            ),
            array: $data['data'],
        );
    }

    /**
     * @param string|int $id
     * @return DataObjectContract
     * @throws Throwable
     */
    public function find(string|int $id): DataObjectContract
    {
        try {
            $data = $this->decodeResponse(
                response: $this->client->send(
                    request: $this->buildRequest(
                        method: Method::GET,
                        uri: "/{$this->resourcePath()}/{$id}",
                    ),
                ),
            );
        } catch (Throwable $exception) {
            throw $this->exception(
                exception: $exception,
            );
        }

        return $this->createDataObject(
            data: $data,
        );
    }
}
