<?php

declare(strict_types=1);

namespace JustSteveKing\LemonSqueezy;

final readonly class LemonClient
{
    public function __construct(
        public Config $config,
    ) {}
}
