<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CustomerExport;
use App\Imports\ProductsImport;
use App\Models\Products;
use  PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\Type;

class PrintController extends CommonController
{
    //批量导出文件

    public function exports(Request $request)
    {
        if (session('name') || session('order_no')) {
            $data = ($request->session()->get('data')->toArray())['data'];
        } else {
            $data = Products::all()->toArray();
        }
        if (empty($data)) {
            flash()->overlay('数据不存在，无法打印！');
            return back();
        }

        $input = $request->except('_token');

        if (!isset($input['type']) || empty($input['type'])) {
            $input['type'] = 'xls';
        }

        if (!isset($input['file']) || empty($input['file'])) {
            $input['file'] = date('Y-m-d') ;
        } else {
            $input['file'] = date('Y-m-d') . '_' . $input['file'] ;
        }
        $file = $input['file'];
        $type = $input['type'];

        switch ($type) {
            case 'csv':
                return (new CustomerExport($data))->download($file . '.' . $type, \Maatwebsite\Excel\Excel::CSV);
            case 'xls':
                return (new CustomerExport($data))->download($file . '.' . $type, \Maatwebsite\Excel\Excel::XLS);
            case 'xlsx':
                return (new CustomerExport($data))->download($file . '.' . $type, \Maatwebsite\Excel\Excel::XLSX);
            case 'pdf':
                $pdf = app('dompdf.wrapper');
                $pdf->loadView('pdf.data',compact('data'))->setPaper('a4', 'landscape');
                return $pdf->download($file.'.pdf');
            default:
                flash()->overlay('打印失败，请联系管理员！');
                return False;
        }
    }

//    //单独导出文件，后续改为导出个别商品的详细表
//    public function export_pdf(Request $request)
//    {
//        if (session('name') || session('order_no')) {
//            $data = ($request->session()->get('data')->toArray())['data'];
//        } else {
//            $data = Products::all()->toArray();
//        }
//        $pdf = app('dompdf.wrapper');
//        $pdf->loadView('goods.data',compact('data'));
//
//      return $pdf->download();
//    }

    //批量导入文件
    public function import(Request $request)
    {
        $allowExt   = ["csv", "xls", "xlsx"];//文件导入格式
        $file_path ='uploads/' .date('Y-m-d');
        $input = $request->except('_token');
        // 进行表单验证
//        $validator = Validator::make('需要验证的表单数据','验证规则数组','错误提示信息数组')；
        $rule = [
            'file' => 'required',
        ];
        $message = [
            'file.required' => '文件不能为空',
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($input,$rule,$message);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //获取文件后缀名
        $arr_filename = (pathinfo($_FILES['file']['name']));
        if (!isset($arr_filename['extension'])) {
            $arr_filename['extension'] = 'xls';
        }
        if (!in_array($arr_filename['extension'], $allowExt)) {
            return redirect()->back()->withErrors('文件格式不符合要求！');
        }
        //判断是否存在文件目录
        if (!file_exists($file_path)) {
            //如果不存在则创建读写权限的可多级的目录
            if (!mkdir($file_path, 0777, true)) {
                return redirect()->back()->withErrors('文件保存失败，请检查权限！');
            }
        }
       //移动文件，重命名
        $new_filename =  "pro_" . str_replace('.', '', uniqid(mt_rand(10000, 99999), true));
        if ($arr_filename['extension'] != '') {
            $new_filename .= "." . $arr_filename['extension'];
        }
        //保存
        $file_path = rtrim($file_path, '/') . '/';

        if (!move_uploaded_file($_FILES['file']['tmp_name'], $file_path . $new_filename)) {
            return redirect()->back()->withErrors('文件保存失败，请检查权限！');
        }
        $file = $file_path.$new_filename;

         Excel::import(new ProductsImport, $file);

        return back()->with('success','操作成功,如果不继续提交请关闭窗口！');
    }




}
