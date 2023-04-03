<?php

class OrderWriter
{
    const OUTPUT_FILE = 'out.csv';
    const CSV_HEADER = 'order_id,order_datetime,total_order_value,average_unit_price,distinct_unit_count,total_units_count,customer_state';

    public function writeOutput($output)
    {
        $fp = fopen(self::OUTPUT_FILE, 'w');
        fputcsv($fp, explode(',', self::CSV_HEADER));
        foreach ($output as $row) {
            fputcsv($fp, $row);
        }
        fclose($fp);
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.basename(self::OUTPUT_FILE).'";');
        readfile(self::OUTPUT_FILE);
    }
}
