<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>

        @font-face {
            font-family: ipag;
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/ipag.ttf') }}') format('truetype');
        }
        body {
            font-family: ipag !important;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        td ,th{
            border:1px solid #000;
            word-break:break-all;
            word-wrap:break-word;
        }

    </style>
</head>
<body>
<div>
    <div class="layui-card-body ">
        <div>
            <p style="color: #00a0e9;text-align: center;font-size: 20px">商品一覧</p>
            <div class="layui-input-inline" >
                <span style="text-align: right">
                    @if(session('name')||session('order_no'))
                        <span style="color: red"> {{count($data)}} 件 </span>
                    @else
                        <span style="color: red">共有{{$num}} 件</span>
                    @endif
                </span>
            </div>
        </div>
        <table class="layui-table layui-form">
            <thead>
            <tr>
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
            </tr>
            </thead>
            <tbody>
            @foreach($data as $list)
                <tr>
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
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>