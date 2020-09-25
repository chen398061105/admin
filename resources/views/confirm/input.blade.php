@include('common.products_header')
</head>
<body>
<div class="wrap-container">
    <form class="layui-form" style="width: 90%;padding-top: 20px;" enctype="multipart/form-data" method="post"
          action="{{url('import')}}">
        {{ csrf_field() }}
        @if(!empty($errors))
            <div class=" ">
                <ul>
                    @if(is_object($errors))
                        @foreach($errors->all() as $error)
                            <li style="color: red">{{ $error }}</li>
                        @endforeach
                    @else
                        <li style="color: red">{{ $errors }}</li>
                    @endif
                </ul>
            </div>
        @endif
        @if(!empty(session('success')))
            　　
            <div class="alert alert-success" role="alert" >
                <i class="layui-icon layui-icon-face-smile" style="font-size: 20px; color: red;">&#xe60c;
                　{{session('success')}}
                </i>
            </div>
        @endif
        <div class="layui-form-item">
            <label class="layui-form-label">文件导入：</label>
            <div class="layui-input-block">
                <input type="file" name="file">
            </div>
            <div class="layui-form-mid layui-word-aux" style="color: red;font-size: 14px">只允许csv | xls | xlsx 格式上传。
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
