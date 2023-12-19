<?php

declare(strict_types=1);

namespace JustSteveKing\LemonSqueezy;

final readonly class Config
{
    public function __construct(
        public string $apiKey,
        public string $version = '1.0.0',
        public string $baseUrl = 'https://api.lemonsqueezy.com/v1',
    ) {
    }

    /**
     * @param array{
     *     apiKey:string,
     *     version:string,
     *     baseUrl:string,
     * } $data
     * @return Config
     */
    public static function fromArray(array $data): Config
    {
        return new Config(
            apiKey: $data['apiKey'],
            version: $data['version'],
            baseUrl: $data['baseUrl'],
        );
    }

    /**
     * @return array{
     *      apiKey:string,
     *      version:string|null,
     *      baseUrl:string|null,
     *  }
     */
    public function toArray(): array
    {
        return [
            'apiKey' => $this->apiKey,
            'version' => $this->version,
            'baseUrl' => $this->baseUrl,
        ];
    }
}
