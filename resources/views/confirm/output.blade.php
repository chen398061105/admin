@include('common.products_header')
<body>
<div class="wrap-container">
    <form class="layui-form" style="width: 90%;padding-top: 20px;" action="{{url('export')}}" method="post">
{{csrf_field()}}
        <fieldset class="layui-elem-field layui-field-title">
            <legend style="color: red;text-align: center">注意事项</legend>
            <div class="layui-field-box" style="color: red;text-align: center">
                *没有检索直接打印是打印所有数据
                *检索后再打印是打印检索后的数据
            </div>
        </fieldset>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red"></span>新文件名：</label>
            <div class="layui-input-inline">
                <input type="text" name="file" placeholder="不填则以当前时间命名"  autocomplete="off" class="layui-input"></div>
        </div>
        <div class="layui-form-item ">
            <label class="layui-form-label ">打印格式：</label>
            <div class="layui-input-block ">
                @foreach($types as $type)
                <input type="radio" name="type"  value="{{$type['type']}}" title="{{$type['type']}}">
               @endforeach
            </div>
                    <div class="layui-form-mid layui-word-aux " style="color: red">*不选的话默认xls下载</div>

        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                <button type="button" class="layui-btn layui-btn-primary" onclick="javascript:history.go(-1);">取消</button>&nbsp;&nbsp;
            </div>
        </div>
    </form>
</div>
</body>
</html>


