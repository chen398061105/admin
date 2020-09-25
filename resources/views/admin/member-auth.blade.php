@include('common.products_header')
<body>

<div class="wrap-container">
    <form class="layui-form" style="width: 90%;padding-top: 20px;">
        <div class="layui-form-item">
            <label class="layui-form-label">设置角色：</label>
                <input type="hidden" name="user_id" value="{{$user['id']}}">
            <div class="layui-input-block">
                @foreach($roles as $role)
                    @if(in_array($role['id'],$own_roleids))
                        <input type="checkbox" name="role_id" value="{{$role['id']}}" title="{{$role['role_name']}}" checked>
                        @else
                        <input type="checkbox" name="role_id" value="{{$role['id']}}" title="{{$role['role_name']}}">
                    @endif
                 @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
<script>
    layui.use(['form', 'jquery', 'laypage', 'layer'], function () {
        var form = layui.form(),
            $ = layui.jquery;
        form.render();
        var layer = layui.layer;
        form.on('submit(formDemo)', function (data) {
            var checkboxValue="";
            $("input:checkbox[name='role_id']:checked").each(function() { // 遍历name=standard的多选框
                if(checkboxValue==0){
                    checkboxValue = $(this).val();
                    return true;
                }
                checkboxValue += ',' + $(this).val();
                data.field.role_id = checkboxValue;
            });
                //发异步，把数据提交给php
            $.ajax({
                type: 'POST',
                url: '/users/doAuth',
                traditional:true,//是否使用传统的方式浅层序列化,若有数组参数或对象参数需要设置true!!!!!!
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data.field,
                success: function (data) {
                    // 弹层提示修改成功，并刷新父页面
                    if (data.status != 0) {
                        layer.msg(data.msg, {shift: 6, icon: 5,time:2000});
                    } else {
                        layer.msg(data.msg, {icon: 6});
                        var index = parent.layer.getFrameIndex(window.name);
                        setTimeout('parent.layer.close(' + index + ')', 2000);
                    }
                },
            });
            return false;
        });
    });
</script>
