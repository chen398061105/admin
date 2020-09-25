@section('content')
    <div class="layui-form-item">
        <label class="layui-form-label">发注单号：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$data['order_no'] }}" name="order_no" required  lay-verify="required|order_no" placeholder="不能为空" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">商品名：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$data['name'] }}" name="name"  required lay-verify="required|name" placeholder="不能为空" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
                <label class="layui-form-label">商品分类：</label>
                <div class="layui-input-block">
                    <input type="radio"   name="category" value="0" title="服装" {{isset($data['category'])&&$data['category']=='0'?'checked':''}}>
                    <input type="radio"   name="category" value="1" title="其他" {{isset($data['category'])}} checked>
                </div>
     </div>

    <div class="layui-form-item">
        <label class="layui-form-label">发票单号：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$data['order_number'] }}" name="order_number"  required lay-verify="required|order_number" placeholder="不能为空" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态：</label>
        <div class="layui-input-block">
            <input type="radio" name="status" value="0" title="发送完了" {{isset($data['status'])&&$data['status']=='0'?'checked':''}}>
            <input type="radio" name="status" value="1" title="准备中" {{isset($data['status'])&&$data['status']=='1'?'checked':''}}>
            <input type="radio" name="status" value="2" title="未准备" {{isset($data['status'])&&$data['status']!='2'?'':'checked'}}>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">发送时间：</label>
        <div class="layui-input-block">
            <input class="layui-input" name="send_date"  required lay-verify="required|order_number" placeholder="不能为空" value="{{$data['send_date'] }}" onclick="layui.laydate({elem: this, festival: true})">
        </div>
    </div>
@endsection
@section('id',$data['id'])
@section('js')
    <script>
        layui.use(['form','jquery','laypage', 'layer'], function() {
            var form = layui.form(),
                $ = layui.jquery;
            form.render();
            var layer = layui.layer;

            form.on('submit(formDemo)', function(data) {
                var id = $("input[name='id']").val();
                //发异步，把数据提交给php
                $.ajax({
                    type: 'put',
                    url: '/products/'+id,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data.field,
                    success: function (data) {
                        // 弹层提示修改成功，并刷新父页面
                        if (data.status == 0) {
                            layer.msg(data.msg,{icon:6});
                            var index = parent.layer.getFrameIndex(window.name);
                            setTimeout('parent.layer.close('+index+')',2000);
                        } else {
                            layer.msg(data.msg,{shift: 6,icon:5});
                        }
                    },
                });
                return false;
            });
        });
    </script>
@endsection
@extends('common.edit')