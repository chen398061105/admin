@include('common.products_header')
<body>

<div class="wrap-container">

    <form class="layui-form" style="width: 90%;padding-top: 20px;">

        {{ csrf_field() }}
        @if(!empty($errors))
            <div class=" ">
                <ul>
                    @if(is_object($errors))
                        @foreach($errors->all() as $error)
                            <li style="color: red;font-size: 18px">{{ $error }}</li>
                        @endforeach
                    @else
                        <li style="color: red">{{ $errors }}</li>
                    @endif
                </ul>
            </div>
        @endif
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>设置账户</label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" name="username" required="" lay-verify="nikename" autocomplete="off" class="layui-input"></div>
            <div class="layui-form-mid layui-word-aux">账户名长度长度在2-12之间</div>
        </div>
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                <span class="x-red">*</span>设置密码</label>
            <div class="layui-input-inline">
                <input type="password" id="L_pass" name="password" required="" lay-verify="pass" autocomplete="off" class="layui-input"></div>
            <div class="layui-form-mid layui-word-aux">6到16个字符</div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
                <span class="x-red">*</span>确认密码</label>
            <div class="layui-input-inline">
                <input type="password" id="L_repass" name="repass" required="" lay-verify="repass" autocomplete="off" class="layui-input"></div>
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
                if (value.length < 2 || value.length > 12) {
                    return '账户名长度长度在2-12之间';
                }
            },
            pass: [/(.+){6,12}$/, '密码必须6到12位'],
            repass: function(value) {
                if ($('#L_pass').val() != $('#L_repass').val()) {
                    return '两次密码不一致';
                }
            }
        });
        form.on('submit(formDemo)', function (data) {
            // var cate_id = $("input[name='id']").val();
            //发异步，把数据提交给php
            $.ajax({
                type: 'POST',
                url: '/users',
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
