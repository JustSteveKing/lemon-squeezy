# LemonSqueezy

An unofficial PHP SDK for working with the LemonSqueezy API.

[Livestream](https://kdta.io/building-an-sdk-for_3)

```php
$client = \JustSteveKing\LemonSqueezy\LemonClient::squeeze(
    config: [
        'apiKey' => '1234-1234-1234-1234',
    ],
);

// Get all Stores
$client->stores()->all();

// Get a specific Store
$client->stores()->find(
    id: 1,
);

// Get all Customers
$client->customers()->all();

// Get a specific Customer
$client->customers()->find(
    id: 1,
);
```
