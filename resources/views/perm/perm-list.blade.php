@include('common.public.topheader')
<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="{{url('perms')}}">返回当页</a>
            <a>
              <cite>权限列表</cite></a>
          </span>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5" action="{{ url('perms') }}" method="get">
                        <div class="layui-inline layui-show-xs-block">
                            <input type="text" name="perm_title"  value="{{ $request->input('perm_title')}}" placeholder="请输权限名" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                            <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:0px;float:right" onclick="location.reload()" title="刷新">
                                <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i>
                            </a>
                        </div>
                        <div class="layui-card-header layui-input-inline" >
                            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
                            <button class="layui-btn layui-btn layui-btn-xs" onclick="xadmin.open('添加权限','',800,600)"><i class="layui-icon"></i>添加权限</button>
                            <p style="color: red">*权限一旦设置不要轻易删除修改，该页面功能暂时不动</p>
                        </div>
                    </form>
                </div>

                <div style="margin-left: 20px" >
                    <span >
                        @if(session('perm_title'))
                            <p style="color: red;font-size: 20px"><span >检索结果 - {{$perms->total() }} / {{$num}} 条</span></p>
                        @else
                           <p style="color: blue;font-size: 20px"><span >共有 - {{$num}} 条</span></p>
                        @endif
                    </span>
                </div>
                <div class="layui-card-body layui-table-body layui-table-main">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th style="width: 50px">
                                <input type="checkbox" lay-filter="checkall" name="" lay-skin="primary">
                            </th>
                            <th style="width: 50px">ID</th>
                            <th >权限名称</th>
                            <th >权限路由</th>
                            <th>操作</th></tr>
                        </thead>
                        <tbody>
                        @foreach($perms as $perm)
                            <tr>
                                <td>
                                    <input type="checkbox" class="ck" lay-skin="primary"  name="item[]" onclick="checkAll(this)" value="{{ $perm['id'] }}">
                                </td>
                                <td>{{ $perm['id'] }}</td>
                                <td>{{ $perm['title'] }}</td>
                                <td>{{ $perm['controllers'] }}</td>
                                <td class="td-manage">

                                    <button class="layui-btn layui-btn layui-btn-xs"  onclick="xadmin.open('修改权限','{{url('/perms/'. $perm['id'] .'/edit')}}',800,600)" ><i class="layui-icon">&#xe642;</i>修改权限</button>
                                    <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="roles_del(this,'{{$perm['id']}}')" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="layui-card-body ">
                    <div class="page">
                        <div>
                            {{ $perms->appends($request->all())->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
{{--<script>--}}
{{--    layui.use(['laydate','form'], function(){--}}
{{--        var laydate = layui.laydate;--}}
{{--        var  form = layui.form;--}}

{{--        // 监听全选--}}
{{--        form.on('checkbox(checkall)', function(data){--}}

{{--            if(data.elem.checked){--}}
{{--                $('tbody input').prop('checked',true);--}}
{{--            }else{--}}
{{--                $('tbody input').prop('checked',false);--}}
{{--            }--}}
{{--            form.render('checkbox');--}}
{{--        });--}}
{{--    });--}}
{{--    /*删除*/--}}
{{--    function roles_del(obj, id) {--}}
{{--        layer.confirm('您确认要删除吗？', function (index) {--}}
{{--            //发异步删除数据--}}
{{--            $.post('{{ url('/roles/') }}/' + id, {--}}
{{--                '_method': 'delete',--}}
{{--                '_token': "{{csrf_token()}}"--}}
{{--            }, function (data) {--}}
{{--                if (data.status == 0) {--}}
{{--                    $(obj).parents("tr").remove();--}}
{{--                    layer.msg('已删除!', {icon: 6, time: 2000});--}}
{{--                } else {--}}
{{--                    // $(obj).parents("tr").remove();--}}
{{--                    layer.msg('删除失败!', {icon: 5, time: 2000});--}}
{{--                }--}}
{{--            })--}}

{{--        });--}}
{{--    }--}}
{{--    // 全选--}}
{{--    var ck = $('.ck');--}}
{{--    // 批量删除--}}
{{--    function delAll() {--}}
{{--        var items = [];--}}
{{--        for (var i = 0; i < ck.length; i++) {--}}
{{--            if (ck[i].checked) {--}}
{{--                items.push(ck[i].value);    // 将id都放进数组--}}
{{--            }--}}
{{--        }--}}
{{--        if (items == null || items.length == 0)    // 当没选的时候，不做任何操作--}}
{{--        {--}}
{{--            layer.msg('请选择一个再删除!', {icon: 5, time: 2000});--}}
{{--            return false;--}}
{{--        }--}}
{{--        layer.confirm('您确定要删除我们吗？', {--}}
{{--            btn: ['确定', '取消'],--}}
{{--        }, function () {--}}
{{--            $.post("{{ url('/delAll/roles') }}", {--}}
{{--                "_token": "{{ csrf_token() }}",--}}
{{--                "keys": items--}}
{{--            }, function (data) {--}}
{{--                if (data.status == 0) {--}}
{{--                    layer.msg(data.msg, {icon: 6, time: 3000});--}}
{{--                    $(".layui-form-checked").not('.header').parents('tr').remove();--}}
{{--                } else {--}}
{{--                    layer.msg(data.msg, {icon: 5, time: 3000});--}}
{{--                }--}}
{{--            });--}}
{{--        }, function () {--}}
{{--        })--}}
{{--    }--}}
{{--</script>--}}
</html>