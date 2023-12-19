<?php

declare(strict_types=1);

namespace JustSteveKing\LemonSqueezy\Resources;

use JustSteveKing\LemonSqueezy\Contracts\DataObjectContract;
use JustSteveKing\LemonSqueezy\DataObjects\Customer;
use JustSteveKing\LemonSqueezy\Exceptions\Stores\FailedToFetchAllCustomers;
use JustSteveKing\LemonSqueezy\Resources\Concerns\CanSqueezeLemons;
use JustSteveKing\Tools\Http\Enums\Method;

use Throwable;

final class CustomerResource extends AbstractResource
{
    use CanSqueezeLemons;

    public function resourcePath(): string
    {
        return '/customers';
    }

    public function createDataObject(array $data): DataObjectContract
    {
        return Customer::fromResponse(
            data: $data['data'],
        );
    }

    public function exception(Throwable $exception): Throwable
    {
        new FailedToFetchAllCustomers(
            message: 'Failed to fetch store from the LemonSqueezy API.',
            code: $exception->getCode(),
            previous: $exception,
        );
    }
}
