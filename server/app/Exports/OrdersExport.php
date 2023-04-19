<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection
{
    private $orders;

    public function __construct($orders = null)
    {
        $this->orders = $orders;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if ($this->orders) {
            return $this->orders;
        }

        return Order::all();
    }
}
