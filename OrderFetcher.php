<?php

class OrderFetcher
{
    const API_URL = 'https://1nk.com.au/blitzscale/code-challenge/orders.jsonl';

    public function fetchOrders()
    {
        $queue = new SplQueue();
        $data = file(self::API_URL, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($data as $line) {
            $queue->enqueue(json_decode($line, true));
        }
        $orders = array();
        while (!$queue->isEmpty()) {
            $orders[] = $queue->dequeue();
        }
        return $orders;
    }
}
