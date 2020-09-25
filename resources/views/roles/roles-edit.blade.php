@section('content')
    <div class="layui-form-item">
        <label for="L_username" class="layui-form-label">
            <span class="x-red">*</span>新账户名：</label>
        <div class="layui-input-inline">
            <input type="text" id="L_username" value="{{$role['role_name']}}" name="role_name" required=""
                   lay-verify="nikename" autocomplete="off" class="layui-input"></div>
        <div class="layui-form-mid layui-word-aux">5到16个字符</div>
    </div>

@endsection
@section('id',$role['id'])
@section('js')
    <script>
        layui.use(['form', 'jquery', 'laypage', 'layer'], function () {
            var form = layui.form(),
                $ = layui.jquery;
            form.render();
            var layer = layui.layer;
            //自定义验证规则
            form.verify({
                nikename: function(value) {
                    if (value.length < 5) {
                        return '角色名长度3-10个字符';
                    }
                },
            });

            form.on('submit(formDemo)', function (data) {
                var role_id = $("input[name='id']").val();
                //发异步，把数据提交给php
                $.ajax({
                    type: 'put',
                    url: '/roles/'+role_id,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data.field,
                    success: function (data) {
                        // 弹层提示修改成功，并刷新父页面
                        if (data.status == 0) {
                            layer.msg(data.msg, {icon: 6});
                            var index = parent.layer.getFrameIndex(window.name);
                            setTimeout('parent.layer.close(' + index + ')', 2000);
                        } else {
                            layer.msg(res.msg, {shift: 6, icon: 5});
                        }
                    },
                });
                return false;
            });
        });
    </script>
@endsection
    @extends('common.edit')