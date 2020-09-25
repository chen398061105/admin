<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProductsExport implements FromCollection,  WithHeadings, WithEvents
{
    protected $data;//要导出的数据
    protected $headings;//头部名
    protected $sheetName;//sheet标题
    protected $columnWidth = [];//设置列宽       key：列  value:宽
    protected $rowHeight = [];  //设置行高       key：行  value:高
    protected $mergeCells = []; //合并单元格    value:A1:K8
    protected $font = [];       //设置字体       key：A1:K8  value:Arial
    protected $fontSize = [];       //设置字体大小       key：A1:K8  value:11
    protected $bold = [];       //设置粗体       key：A1:K8  value:true
    protected $background = []; //设置背景颜色    key：A1:K8  value:#F0F0F0F
    protected $vertical = [];   //设置定位       key：A1:K8  value:center
    protected $borders = []; //设置边框颜色  key：A1:K8  value:#000000
    use Exportable;
    public function __construct( $data)
    {

        $this->data = $data;
//        $this->headings = $headings;
//        $this->sheetName = $sheetName;
//        $this->createData();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    //
//    public function headings():array
//    {
//        return $this->headings;
//    }
    public function collection()
    {
        if (!empty($this->data)){
            foreach ($this->data as $key => $value){
                $this->data[$key]['id'] = $value['id'];
                $this->data[$key]['order_no'] = $value['order_no'];
                $this->data[$key]['order_date'] = $value['order_date'];
                $this->data[$key]['category'] = $value['category'];
                $this->data[$key]['name'] = $value['name'];
                $this->data[$key]['order_name'] = $value['order_name'];
                $this->data[$key]['order_number'] = $value['order_number'];
                $this->data[$key]['status'] = $value['status'];
                $this->data[$key]['send_date'] = $value['send_date'];
                $this->data[$key]['info'] = $value['info'];
            }
        }
        return collect($this->data);
    }



    //设置标题
    public function headings():array {

        return  [
            "id" => 'ID',
            "order_no" => '发注单号',
            "order_date" => '发注日期 ',
            "category" => '商品分类 ',
            "name" => '商品名 ',
            "order_name" => '发注者 ',
            "order_number" => '发票单号 ',
            "status" => '状态',
            "send_date" => '发送日期',
            "info" => '简介',
        ];
    }
////数组转集合
//    public function collection()
//    {
//
//        return new Collection($this->data);
//    }
//
////业务代码
//    public function createData()
//    {
//        $this->data = collect($this->data)->toArray();
//    }

    //设置样式注册事件
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                //设置区域单元格垂直居中
                $event->sheet->getDelegate()->getStyle('A1:Z1265')->getAlignment()->setVertical('center');
                //设置区域单元格水平居中
                $event->sheet->getDelegate()->getStyle('A1:Z1265')->getAlignment()->setHorizontal('center');
                //设置列宽
                foreach ($this->columnWidth as $column => $width) {
                    $event->sheet->getDelegate()
                        ->getColumnDimension($column)
                        ->setWidth($width);
                }
                //设置行高，$i为数据行数
                foreach ($this->rowHeight as $row => $height) {
                    $event->sheet->getDelegate()
                        ->getRowDimension($row)
                        ->setRowHeight($height);
                }
                //设置区域单元格垂直居中
                foreach ($this->vertical as $region => $position) {
                    $event->sheet->getDelegate()
                        ->getStyle($region)
                        ->getAlignment()
                        ->setVertical($position);
                }

                //设置区域单元格字体
                foreach ($this->font as $region => $value) {
                    $event->sheet->getDelegate()
                        ->getStyle($region)
                        ->getFont()->setName($value);
                }
                //设置区域单元格字体大小
                foreach ($this->fontSize as $region => $value) {
                    $event->sheet->getDelegate()
                        ->getStyle($region)
                        ->getFont()
                        ->setSize($value);
                }
                //设置区域单元格字体粗体
                foreach ($this->bold as $region => $bool) {
                    $event->sheet->getDelegate()
                        ->getStyle($region)
                        ->getFont()
                        ->setBold($bool);
                }
                //设置区域单元格背景颜色
                foreach ($this->background as $region => $item) {
                    $event->sheet->getDelegate()->getStyle($region)->applyFromArray([
                        'fill' => [
                            'fillType' => 'linear', //线性填充，类似渐变
                            'startColor' => [
                                'rgb' => $item //初始颜色
                            ],
                            //结束颜色，如果需要单一背景色，请和初始颜色保持一致
                            'endColor' => [
                                'argb' => $item
                            ]
                        ]
                    ]);
                }
                //设置边框颜色
                foreach ($this->borders as $region => $item) {
                    $event->sheet->getDelegate()->getStyle($region)->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['argb' => $item],
                            ],
                        ],
                    ]);
                }
                //合并单元格
                $event->sheet->getDelegate()->setMergeCells($this->mergeCells);
                //设置title
                if (!empty($this->sheetName)) {
                    $event->sheet->getDelegate()->setTitle($this->sheetName);
                }
            }
        ];
    }
//
    public function setColumnWidth(array $columnwidth)
    {
        $this->columnWidth = array_change_key_case($columnwidth, CASE_UPPER);
    }

    public function setRowHeight(array $rowHeight)
    {
        $this->rowHeight = $rowHeight;
    }

    public function setFont(array $font)
    {
        $this->font = array_change_key_case($font, CASE_UPPER);
    }

    public function setBold(array $bold)
    {
        $this->bold = array_change_key_case($bold, CASE_UPPER);
    }

    public function setBackground(array $background)
    {
        $this->background = array_change_key_case($background, CASE_UPPER);
    }

    public function setMergeCells(array $mergeCells)
    {
        $this->mergeCells = array_change_key_case($mergeCells, CASE_UPPER);
    }

    public function setFontSize(array $fontSize)
    {
        $this->fontSize = array_change_key_case($fontSize, CASE_UPPER);
    }

    public function setBorders(array $borders)
    {
        $this->borders = array_change_key_case($borders, CASE_UPPER);
    }
    //转出指定的格式
    public function columnFormat(){
        return[
          "A" =>NumberFormat::FORMAT_DATE_YYYYMMDD，
        ];
    }


}
