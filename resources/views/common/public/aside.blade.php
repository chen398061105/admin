<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="管理员管理">&#xe726;</i>
                    <cite>管理员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('账号列表<','{{url('users')}}')">
                            <i class="iconfont">&#xe70b;</i>
                            <cite>账号管理</cite></a>
                    </li>
{{--                    <li>--}}
{{--                        <a href="javascript:;">--}}
{{--                            <i class="iconfont">&#xe70b;</i>--}}
{{--                            <cite>角色管理</cite>--}}
{{--                            <i class="iconfont nav_right">&#xe697;</i></a>--}}
{{--                        <ul class="sub-menu">--}}
                            <li>
                                <a onclick="xadmin.add_tab('角色列表','{{url('roles')}}')">
                                    <i class="iconfont">&#xe70b;</i>
                                    <cite>角色管理</cite></a>
                            </li>
{{--                        </ul>--}}
{{--                    </li>--}}

                    <li>
                        <a onclick="xadmin.add_tab('权限列表','{{url('perm')}}')">
                            <i class="iconfont">&#xe70b;</i>
                            <cite>权限管理</cite></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="商品管理">&#xe723;</i>
                    <cite>商品管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('商品列表','{{url('products')}}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>商品列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('商品详细','{{url('info')}}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>商品详细</cite></a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="分类管理">&#xe723;</i>
                    <cite>分类管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('多级分类','cate.html')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>多级分类</cite></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="系统统计">&#xe6ce;</i>
                    <cite>数据统计</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('拆线图','echarts1.html')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>拆线图</cite></a>
                    </li>

                    <li>
                        <a onclick="xadmin.add_tab('饼图','echarts4.html')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>饼图</cite></a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="其它页面">&#xe6b4;</i>
                    <cite>其它页面</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('更新日志','log.html')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>更新日志</cite></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>