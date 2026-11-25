# Laravel Pusher Realtime


Laravel 13 broadcasting examples for Pusher-compatible private channels. `OrderUpdated` queues broadcasts, publishes a stable event name, and exposes a minimal payload.


Configure `BROADCAST_CONNECTION=pusher` and the standard `PUSHER_APP_*` environment variables. Authorize `orders.{orderId}` in `routes/channels.php` so only permitted users can subscribe.


```bash
composer install
composer test
```

## Add this to an existing Laravel project

1. Install the Pusher server SDK with `composer require pusher/pusher-php-server` if it is not already present.
2. Configure `BROADCAST_CONNECTION=pusher`, `PUSHER_APP_ID`, `PUSHER_APP_KEY`, `PUSHER_APP_SECRET`, and `PUSHER_APP_CLUSTER` in `.env`.
3. Copy `src/OrderUpdated.php` to `app/Events/OrderUpdated.php` and change its namespace to `App\Events`.
4. Authorize the private order channel in `routes/channels.php` using your actual ownership or permission rule.

```php
Broadcast::channel('orders.{orderId}', fn ($user, int $orderId) =>
    $user->orders()->whereKey($orderId)->exists()
);
```

5. Dispatch `OrderUpdated` after the order status transaction commits. The event broadcasts as `.order.updated` on `private-orders.{orderId}`.
6. Install and configure Laravel Echo with `pusher-js` in the frontend, authenticate the user, subscribe to the private channel, and listen for `.order.updated`.
7. Start a queue worker because broadcasts implementing `ShouldBroadcast` are queued. Use `php artisan queue:work` locally and a supervised worker in production.
8. Copy `tests/OrderUpdatedTest.php` into your project, update its namespace and imports, and run `php artisan test`.
9. Verify that an authorized user receives the event and an unrelated user receives a channel authorization failure.
