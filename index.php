<?php
require_once 'OrderFetcher.php';
require_once 'OrderProcessor.php';
require_once 'OrderWriter.php';

$orderFetcher = new OrderFetcher();
$orders = $orderFetcher->fetchOrders();

$orderProcessor = new OrderProcessor($orders);
$output = $orderProcessor->process();

$orderWriter = new OrderWriter();
$orderWriter->writeOutput($output);