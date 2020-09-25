<?php

namespace App\Http\Controllers\Admin;


use App\Models\Products;
use Illuminate\Http\Request;


class ProductsController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //关键字过滤降序检索
        $data = Products::orderBy('id', 'asc')
            ->where(function ($query) use ($request) {
                //根据商品名检索
                $name = $request->get('name');
                $order_no = $request->get('order_no');
//                $this->checkInput($order_no,$name);
                if (!empty($name)) {
                    $query->where('name', 'like', '%' . $name . '%');
                }
                //根据单号检索
                if (!empty($order_no)) {
                    $query->where('order_no', 'like', '%' . $order_no . '%');
                }
            })->paginate(10);//($request->input('num') ? $request->input('num') : 10);
        session(
            [
                'data'=>$data,
                'name'=>$request->get('name'),
                'order_no'=>$request->get('order_no'),
            ]
        );
        $num = Products::count();//一共有多少数据
        return view('goods.order',compact('data','request','num'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goods.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $input = $request->except('_token','repass');
        //表单验证。。暂时不做
        // insert into db
        $res = Products::create($input);
        if($res){
            $data = [
                'status'=>0,
                'msg'=>'添加成功'
            ];
        }else{
//            return 2222;
            $data = [
                'status'=>1,
                'msg'=>'添加失败'
            ];
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Products::find($id);
//        return view('goods.edit', ['id'=>$id,'products'=>Products::all(),'data'=>$data]);
        return view('goods.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->except('id','_token');
//        使用模型修改表记录的两种方法,方法一
        $art = Products::find($id);
        $res = $art->update($input);

        if($res){
            $data = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        }else{
//            return 2222;
            $data = [
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $input = Products::find($id)->delete();
        if($input){
            $data = [
                'status'=>0,
                'msg'=>'操作成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'操作失败'
            ];
        }
        return $data;
    }
    //各商品明细
    public function info(Request $request,$id){

        return view('goods.info');
    }

}
