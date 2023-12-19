<?php

declare(strict_types=1);

namespace JustSteveKing\LemonSqueezy\Resources;

use JustSteveKing\LemonSqueezy\Contracts\DataObjectContract;
use JustSteveKing\LemonSqueezy\DataObjects\Store;
use JustSteveKing\LemonSqueezy\Exceptions\Stores\FailedToFetchAllStoresException;
use JustSteveKing\LemonSqueezy\Resources\Concerns\CanSqueezeLemons;
use JustSteveKing\Tools\Http\Enums\Method;
use Throwable;

final class StoreResource extends AbstractResource
{
    use CanSqueezeLemons;

    public function resourcePath(): string
    {
        return '/stores';
    }

    public function exception(Throwable $exception): Throwable
    {
        return new FailedToFetchAllStoresException(
            message: 'Failed to fetch all stores from the LemonSqueezy API.',
            code: $exception->getCode(),
            previous: $exception,
        );
    }

    /**
     * @param array<string,array<string,mixed>> $data
     * @return DataObjectContract
     */
    public function createDataObject(array $data): DataObjectContract
    {
        return Store::fromResponse(
            data: $data['data'],
        );
    }
}
