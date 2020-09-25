@include('common.public.topheader')
<body>
<div class="x-nav">
            <span class="layui-breadcrumb">
                <a href="{{url('products')}}">返回当页</a>
                <a>
                    <cite>商品列表</cite></a>
            </span>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5" action="{{ url('products') }}" method="get">
                        <div class="layui-inline">
                            <input type="text" value="{{ $request->input('name')}}" name="name"
                                   placeholder="请输入商品名关键字" autocomplete="off"
                                   class="layui-input">
                        </div>
                        <div class="layui-inline">
                            <input type="text"  value="{{ $request->input('order_no')}}" name="order_no"
                                   placeholder="请输入发注单号关键字" autocomplete="off"
                                   class="layui-input">
                        </div>
                        <div class="layui-input-inline layui-show-xs-block">
                            <button class="layui-btn" lay-submit="" lay-filter="sreach">
                                <i class="layui-icon">&#xe615;</i></button>
                            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:0px;float:right" onclick="location.reload()" title="刷新">
                                <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
                            </a>
                        </div>
                    </form>
                </div>

                <div class="layui-card-header layui-input-inline" >
                    <a id="delAll" type="button" class="layui-btn layui-btn-small layui-btn-danger " onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</a>
                    <a id="" type="button" class="layui-btn layui-btn-small layui-btn-normal " onclick="xadmin.open('打印数据','{{url('/confirm/output')}}',600,400)"><i class="layui-icon">&#xe61e;</i>打印数据</a>
{{--                    <a id="" type="button" class="layui-btn layui-btn-small layui-btn-normal " onclick="xadmin.open('打印数据','{{url('/test')}}',600,400)"><i class="layui-icon">&#xe61e;</i>打印数据</a>--}}
                    <button class="layui-btn" onclick="xadmin.open('导入数据','{{url('/confirm/input')}}',600,400)">
                        <i class="layui-icon"></i>导入数据</button>
                    <button class="layui-btn" onclick="xadmin.open('添加商品','{{url('products/create')}}',800,600)">
                        <i class="layui-icon"></i>添加商品</button>
                </div>
                <div class="layui-input-inline" >
                    <fieldset class="layui-elem-field layui-field-title" style="margin-left: 1100px;">
                        @if(session('name')||session('order_no'))
                            <span style="color: red">检索结果 - {{$data->total() }} / {{$num}} 条</span>
                        @else
                            <span style="color: blue">共有 - {{$num}} 条</span>
                        @endif
                    </fieldset>
                </div>

                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th><input type="checkbox" lay-skin="primary" lay-filter="checkall"></th>
                            <th>ID</th>
                            <th>発注NO</th>
                            <th>発注日</th>
                            <th>カテゴリ</th>
                            <th>商品名</th>
                            <th>発注者</th>
                            <th>伝票番号</th>
                            <th>状態</th>
                            <th>発送日</th>
                            <th>備考</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>
                                <input type="checkbox" class="ck" lay-skin="primary"  name="item[]" onclick="checkAll(this)" value="{{ $list['id'] }}">
                            </td>
                            <td>{{$list['id']}}</td>
                            <td>{{$list['order_no']}}</td>
                            <td>{{$list['order_date']}}</td>
                            <td>
                                @if($list['category'] == '0')
                                    <span style="color: green">服装</span>
                                @else
                                    <span style="color: red">その他</span>
                                @endif
                            </td>
                            <td>{{$list['name']}}</td>
                            <td>{{$list['order_name']}}</td>
                            <td>{{$list['order_number']}}</td>
                            <td>
                                @if($list['status'] == '0')
                                    <span style="color: green">準備完了</span>
                                @elseif($list['status'] == '1')
                                    <span style="color: deepskyblue">準備中</span>
                                @else
                                    <span style="color: red">未準備</span>
                                @endif
                            </td>
                            <td>{{$list['send_date']}}</td>
                            <td>{{$list['info']}}</td>
                            <td class="td-manage">
                                <button type="button"class="layui-btn layui-btn-small layui-btn-normal " onclick="xadmin.open('詳細','{{url('product/'.$list['id'])}}',800,600)" ><i class="layui-icon">&#xe60b;</i> 詳細</button>
                                <button class="layui-btn layui-btn layui-btn-xs"  onclick="xadmin.open('編集','{{url('/products/'. $list['id'] .'/edit')}}')" ><i class="layui-icon">&#xe642;</i>編集</button>
                                <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="products_del(this,'{{$list['id']}}')" href="javascript:;" ><i class="layui-icon">&#xe640;</i>削除</button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="layui-card-body ">
                    <div class="page">
                        <div>
                            {{ $data->appends($request->all())->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div></div>
</body>
<script>
    layui.use(['laydate', 'form'],
        function() {
            var laydate = layui.laydate;
            var  form = layui.form;
            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });

            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });
            //监听全选
            form.on('checkbox(checkall)',function (data) {
                if (data.elem.checked){
                    $('tbody input').prop('checked',true);
                } else {
                    $('tbody input').prop('checked',false);
                }
                form.render('checkbox')
            })

        });
    /*删除*/
    function products_del(obj, id) {
        layer.confirm('您确认要删除吗？', function (index) {
            //发异步删除数据
            $.post('{{ url('/products/') }}/' + id, {
                '_method': 'delete',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status == 0) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 6, time: 2000});
                } else {
                    // $(obj).parents("tr").remove();
                    layer.msg('删除失败!', {icon: 5, time: 2000});
                }
            })

        });
    }
    // 全选
    var ck = $('.ck');
    // 批量删除
    function delAll() {
        var items = [];
        for (var i = 0; i < ck.length; i++) {
            if (ck[i].checked) {
                items.push(ck[i].value);    // 将id都放进数组
            }
        }
        if (items == null || items.length == 0)    // 当没选的时候，不做任何操作
        {
            layer.msg('请选择一个再删除!', {icon: 5, time: 2000});
            return false;
        }
        layer.confirm('您确定要删除我们吗？', {
            btn: ['确定', '取消'],
        }, function () {
            $.post("{{ url('/delAll') }}"+"/order", {
                "_token": "{{ csrf_token() }}",
                "keys": items
            }, function (data) {
                if (data.status == 0) {
                    layer.msg(data.msg, {icon: 6, time: 3000});
                    $(".layui-form-checked").not('.header').parents('tr').remove();
                } else {
                    layer.msg(data.msg, {icon: 5, time: 3000});
                }
            });
        }, function () {
        })
    }
</script>

</html>