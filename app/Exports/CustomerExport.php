<?php

namespace App\Exports;

use App\Models\Products;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use phpDocumentor\Reflection\Types\False_;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class CustomerExport implements FromCollection,WithEvents,WithHeadings
{
    protected $data;//要导出的数据
//    protected $columnWidth = [];//设置列宽
    use Exportable;
    public function __construct($data)
    {
        $this->data =$data;

    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return collect($this->data);
    }

    //设置标题
    public function headings():array {

        return  [
            'ID',
            '発注NO',
            '発注日 ',
            'カテゴリ ',
            '商品名 ',
             '発注者 ',
             '伝票番号 ',
            '状態',
            '発送日',
            '備考',
        ];
    }


    public function registerEvents(): array
    {
        return [
            // 生成表单元后处理事件
            AfterSheet::class => function (AfterSheet $event) {
                // 合并单元格
//                $event->sheet->getDelegate()->setMergeCells(['A2:L2', 'B11:E11', 'A12:L12']);
                // 设置单元格内容居中
//                $event->sheet->getDelegate()->getStyle('A2:L2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
//                $event->sheet->getDelegate()->getStyle('A3:L3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                // 定义列宽度
                $widths = ['A' => 10, 'B' => 15, 'C' => 20, 'D' => 10, 'E' => 20, 'F' => 15, 'G' => 15, 'H' => 8, 'I' => 20,'J' => 30];
                foreach ($widths as $k => $v) {
                    // 设置列宽度
                    $event->sheet->getDelegate()->getColumnDimension($k)->setWidth($v);
                }

            },
        ];
    }

}

