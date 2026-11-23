# Laravel Pusher Realtime

Laravel 13 broadcasting examples for Pusher-compatible private channels. `OrderUpdated` queues broadcasts, publishes a stable event name, and exposes a minimal payload.

Configure `BROADCAST_CONNECTION=pusher` and the standard `PUSHER_APP_*` environment variables. Authorize `orders.{orderId}` in `routes/channels.php` so only permitted users can subscribe.

```bash
composer install
composer test
```
