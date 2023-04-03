<?php

class OrderProcessor
{
    private $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function process()
    {
        $output = array();
        foreach ($this->orders as $order) {
             $total_order_value = 0;
            foreach ($order['items'] as $item) {
                $total_order_value += $item['unit_price'] * $item['quantity'];
            }
            if ($total_order_value == 0) {
                continue; // skip orders with 0 total order value
            }
            $output_row = array();
            $output_row[] = $order['order_id'];
            $output_row[] = $order['order_date'];
            // $total_order_value = 0;
            $total_units_count = 0;
            $distinct_unit_count = 0;
            $unit_prices = array();
            foreach ($order['items'] as $item) {
                // $total_order_value += $item['unit_price'];
                $total_units_count += $item['quantity'];
                if (!in_array($item['unit_price'], $unit_prices)) {
                    $distinct_unit_count++;
                    $unit_prices[] = $item['unit_price'];
                }
            }
            $average_unit_price = $total_order_value / $total_units_count;
            $customer_state = $order['customer']['shipping_address']['state'];
            $output_row[] = $total_order_value;
            $output_row[] = $average_unit_price;
            $output_row[] = $distinct_unit_count;
            $output_row[] = $total_units_count;
            $output_row[] = $customer_state;
            $output[] = $output_row;
        }
        return $output;
    }
}
