<?php

namespace Tests;

use JawadAhmed\PusherRealtime\OrderUpdated;
use PHPUnit\Framework\TestCase;

final class OrderUpdatedTest extends TestCase
{
    public function test_it_uses_a_private_order_channel(): void
    {
        $event = new OrderUpdated(42, 'shipped');
        self::assertSame('private-orders.42', $event->broadcastOn()[0]->name);
        self::assertSame('order.updated', $event->broadcastAs());
        self::assertSame(['order_id' => 42, 'status' => 'shipped'], $event->broadcastWith());
    }
}
