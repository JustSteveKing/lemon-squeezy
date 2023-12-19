<?php

declare(strict_types=1);

namespace JustSteveKing\LemonSqueezy\DataObjects\Concerns;

use League\ObjectMapper\ObjectMapperUsingReflection;

trait CanBeHydrated
{
    /**
     * @param array<string,mixed> $data
     * @return self
     */
    public static function fromResponse(array $data): self
    {
        return (new ObjectMapperUsingReflection())->hydrateObject(
            className: self::class,
            payload: $data,
        );
    }
}
