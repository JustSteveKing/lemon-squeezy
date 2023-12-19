<?php

declare(strict_types=1);

namespace JustSteveKing\LemonSqueezy\DataObjects;

use DateTimeImmutable;
use JustSteveKing\LemonSqueezy\Contracts\DataObjectContract;
use JustSteveKing\LemonSqueezy\DataObjects\Concerns\CanBeHydrated;

final readonly class Store implements DataObjectContract
{
    use CanBeHydrated;

    /**
     * @param string $name
     * @param string $slug
     * @param string $domain
     * @param string $url
     * @param string $avatar_url
     * @param string $plan
     * @param string $country
     * @param string $country_nicename
     * @param string $currency
     * @param int $total_sales
     * @param float|int|null $total_revenue
     * @param float|int|null $thirty_day_sales
     * @param float|int|null $thirty_day_revenue
     * @param DateTimeImmutable $created_at
     * @param DateTimeImmutable $updated_at
     */
    public function __construct(
        public string $name,
        public string $slug,
        public string $domain,
        public string $url,
        public string $avatar_url,
        public string $plan,
        public string $country,
        public string $country_nicename,
        public string $currency,
        public int $total_sales,
        public null|float|int $total_revenue,
        public null|float|int $thirty_day_sales,
        public null|float|int $thirty_day_revenue,
        public DateTimeImmutable $created_at,
        public DateTimeImmutable $updated_at,
    ) {
    }
}
