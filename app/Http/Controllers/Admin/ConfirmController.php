<?php

namespace App\Http\Controllers\Admin;
use App\Models\Products;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf;
class ConfirmController extends CommonController
{
    public function output(){
        $types = Type::all();
        return view('confirm.output',compact('types'));
    }
    public function input(){

        return view('confirm.input');
    }

}