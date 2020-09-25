@section('content')
    <div class="layui-form-item">
        <label for="L_username" class="layui-form-label">
            <span class="x-red">*</span>设置账户</label>
        <div class="layui-input-inline">
            <input type="text" id="L_username" value="{{$user['username']}}" name="username" required=""
                   lay-verify="nikename" autocomplete="off" class="layui-input"></div>
        <div class="layui-form-mid layui-word-aux">5到16个字符</div>
    </div>
    <div class="layui-form-item">
        <label for="L_pass" class="layui-form-label">
            <span class="x-red">*</span>设置密码</label>
        <div class="layui-input-inline">
            <input type="password" id="L_pass" name="password" required="" lay-verify="pass" autocomplete="off" placeholder="新密码"
                   class="layui-input"></div>
        <div class="layui-form-mid layui-word-aux">6到16个字符</div>
    </div>
    <div class="layui-form-item">
        <label for="L_repass" class="layui-form-label">
            <span class="x-red">*</span>确认密码</label>
        <div class="layui-input-inline">
            <input type="password" id="L_repass" name="repass" required="" lay-verify="repass" placeholder="确认新密码"
                   autocomplete="off" class="layui-input"></div>
    </div>
@endsection
@section('id',$user['id'])
@section('js')
    <script>
        layui.use(['form', 'jquery', 'laypage', 'layer'], function () {
            var form = layui.form(),
                $ = layui.jquery;
            form.render();
            var layer = layui.layer;
            //自定义验证规则
            form.verify({
                nikename: function (value) {
                    if (value.length < 5) {
                        return '账户至少得5个字符啊';
                    }
                },
                pass: [/(.+){6,12}$/, '密码必须6到12位'],
                repass: function (value) {
                    if ($('#L_pass').val() != $('#L_repass').val()) {
                        return '两次密码不一致';
                    }
                }
            });
            form.on('submit(formDemo)', function (data) {
                var user_id = $("input[name='id']").val();
                //发异步，把数据提交给php
                $.ajax({
                    type: 'put',
                    url: '/users/'+user_id,
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