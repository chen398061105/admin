<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Events\AfterSheet;

class BaseExport implements WithEvents, WithStrictNullComparison, ShouldAutoSize
{
    /**
     * 注册事件
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                //设置作者
                $event->writer->setCreator('寞小陌');//writer属性现在好像有点问题。。。
                //设置列宽
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(50);
                //设置区域单元格垂直居中
                $event->sheet->getDelegate()->getStyle('A1:Z1265')->getAlignment()->setVertical('center');
                //设置区域单元格水平居中
                $event->sheet->getDelegate()->getStyle('A1:Z1265')->getAlignment()->setHorizontal('center');
                //设置区域单元格字体、颜色、背景等，其他设置请查看 applyFromArray 方法，提供了注释
                $event->sheet->getDelegate()->getStyle('A1:Z1')->applyFromArray([
                    'font' => [
                        'name' => 'Arial',
                        'bold' => true,
                        'italic' => false,
                        'strikethrough' => false,
                        'color' => [
                            'rgb' => 'FFFFFF'
                        ]
                    ],
                    'fill' => [
                        'fillType' => 'linear', //线性填充，类似渐变
                        'rotation' => 45, //渐变角度
                        'startColor' => [
                            'rgb' => '54AE54' //初始颜色
                        ],
                        //结束颜色，如果需要单一背景色，请和初始颜色保持一致
                        'endColor' => [
                            'argb' => '54AE54'
                        ]
                    ]
                ]);
                $event->sheet->getDelegate()->mergeCells('A1:B1');
        }];
    }
}