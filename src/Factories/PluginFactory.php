<?php

declare(strict_types=1);

namespace JustSteveKing\LemonSqueezy\Factories;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Message\Authentication\Bearer;
use JustSteveKing\LemonSqueezy\LemonClient;

final class PluginFactory
{
    /**
     * @param string $token
     * @return array<int,Plugin>
     */
    public static function default(string $token): array
    {
        return [
            new AuthenticationPlugin(
                authentication: new Bearer(
                    token: $token,
                ),
            ),
            new HeaderDefaultsPlugin(
                headers: [
                    'Accept' => 'application/vnd.api+json',
                    'Content-Type' => 'application/vnd.api+json',
                    'User-Agent' => 'LemonSqueezy_PHP_client;' . LemonClient::VERSION,
                ],
            ),
        ];
    }
}
