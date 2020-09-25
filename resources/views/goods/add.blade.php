@include('common.products_header')
<body>
<div class="wrap-container">
    <form class="layui-form" style="width: 90%;padding-top: 20px;">
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label class="layui-form-label">発注NO：</label>
            <div class="layui-input-block">
                <input type="text" value="" name="order_no" required lay-verify="required|order_no" placeholder="不能为空"
                       class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">発注日：</label>
            <div class="layui-input-block">
                <input class="layui-input" name="order_date" required lay-verify="required|order_date"
                       placeholder="不能为空" value="" onclick="layui.laydate({elem: this, festival: true})">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">カテゴリ：</label>
            <div class="layui-input-block">
                <input type="radio" name="category" value="0" title="服装" checked>
                <input type="radio" name="category" value="1" title="其他">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">商品名：</label>
            <div class="layui-input-block">
                <input type="text" value="" name="name" required lay-verify="required|name" placeholder="不能为空"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">発注者：</label>
            <div class="layui-input-block">
                <input type="text" value="" name="order_name" required lay-verify="required|order_name" placeholder="不能为空"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">伝票番号：</label>
            <div class="layui-input-block">
                <input type="text" value="" name="order_number" required lay-verify="required|order_number"
                       placeholder="不能为空" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状態：</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="0" title="发送完了">
                <input type="radio" name="status" value="1" title="准备中">
                <input type="radio" name="status" value="2" title="未准备" checked>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">発送日：</label>
            <div class="layui-input-block">
                <input class="layui-input" name="send_date"
                       placeholder="不能为空" value="" onclick="layui.laydate({elem: this, festival: true})">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">備考：</label>
            <div class="layui-input-block">
                <input type="text" value="" name="info"
                       placeholder="不能为空" autocomplete="off" class="layui-input">
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
    layui.use(['form','jquery','laypage', 'layer'], function() {
        var form = layui.form(),
            $ = layui.jquery;
        form.render();
        var layer = layui.layer;

        form.on('submit(formDemo)', function(data) {
            // var cate_id = $("input[name='id']").val();
            //发异步，把数据提交给php
            $.ajax({
                type: 'POST',
                url: '/products',
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
                        layer.msg(res.msg,{shift: 6,icon:5});
                    }
                },
            });
            return false;
        });
    });
</script>
