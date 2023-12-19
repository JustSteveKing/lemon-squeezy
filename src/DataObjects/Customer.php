<?php

declare(strict_types=1);

namespace JustSteveKing\LemonSqueezy\DataObjects;

use JustSteveKing\LemonSqueezy\Contracts\DataObjectContract;
use JustSteveKing\LemonSqueezy\DataObjects\Concerns\CanBeHydrated;

final readonly class Customer implements DataObjectContract
{
    use CanBeHydrated;

    /**
     * @param string|null $city
     * @param string $status_formatted
     * @param string $country_formatted
     * @param string|null $region
     * @param string $total_revenue_currency_formatted
     * @param array<string,string> $urls
     * @param string $created_at
     * @param bool $test_mode
     * @param string $email
     * @param string $status
     * @param int $total_revenue_currency
     * @param int $mrr
     * @param string $mrr_formatted
     * @param int $store_id
     * @param string $name
     * @param string $country
     * @param string $updated_at
     */
    public function __construct(
        public null|string $city,
        public string $status_formatted,
        public string $country_formatted,
        public null|string $region,
        public string $total_revenue_currency_formatted,
        public array $urls,
        public string $created_at,
        public bool $test_mode,
        public string $email,
        public string $status,
        public int $total_revenue_currency,
        public int $mrr,
        public string $mrr_formatted,
        public int $store_id,
        public string $name,
        public string $country,
        public string $updated_at,
    ) {
    }
}
