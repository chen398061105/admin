<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>@yield('title') | {{ Config::get('app.name') }}</title>
    <link rel="stylesheet" type="text/css" href="/static/admin/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/static/admin/css/admin.css" />
    <script src="/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
    <script src="/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="/bs/js/bootstrap.min.js"></script>
{{--    <script type="text/javascript" src="/admin/js/xadmin.js"></script>--}}

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

@include('flash::message')
<script>
    $(document).ready(function(){
        $('#flash-overlay-modal').modal();
    });
</script>