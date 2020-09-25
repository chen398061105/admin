<?php

namespace App\Imports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        unset($row[0]);

        $order_date = date('Y-m-d ', intval(((int)$row[2] - 25569) * 3600 * 24));
        $send_date = date('Y-m-d ', intval(((int)$row[8] - 25569) * 3600 * 24));
//        dd($order_date); 无标题连表导入 2020/09/20 ok
        return new Products([
            'order_no' => $row[1],
            'order_date' => $order_date,
            'category' => $row[3],
            'name' => $row[4],
            'order_name' => $row[5],
            'order_number' => $row[6],
            'status' => $row[7],
            'send_date' =>$send_date,
            'info' => $row[9],
        ]);
    }
}
