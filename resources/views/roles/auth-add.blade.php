@include('common.products_header')
<body>

<div class="wrap-container">
    <form class="layui-form" style="width: 90%;padding-top: 20px;">
{{--        {{ csrf_field() }}--}}
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>角色名称</label>
            <div class="layui-input-inline">
                <input type="hidden" name="role_id" value="{{$role['id']}}">
                <input type="text" id="L_username" name="role_name" required="" lay-verify="nikename" autocomplete="off" value="{{$role['role_name']}}" class="layui-input"></div>
            <div class="layui-form-mid layui-word-aux">角色名长度在2-12之间</div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">设置权限：</label>
            <div class="layui-input-block">
                @foreach($perms as $perm)
                    @if(in_array($perm['id'],$own_perm))
                        <input type="checkbox" name="permission_id" value="{{$perm['id']}}" title="{{$perm['title']}}" checked>
                        @else
                        <input type="checkbox" name="permission_id" value="{{$perm['id']}}" title="{{$perm['title']}}">
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
      //自定义验证规则
        form.verify({
            nikename: function(value) {
                if (value.length < 2 || value.length >12) {
                    return '角色名长度在2-12之间！';
                }
            },
        });

        form.on('submit(formDemo)', function (data) {

            var checkboxValue="";
            $("input:checkbox[name='permission_id']:checked").each(function() { // 遍历name=standard的多选框
                if(checkboxValue==0){
                    checkboxValue = $(this).val();
                    return true;
                }
                checkboxValue += ',' + $(this).val();
                data.field.permission_id = checkboxValue;
            });
                //发异步，把数据提交给php
            $.ajax({
                type: 'POST',
                url: '/roles/doAuth',
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
