<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  {!! HTML::style('resources/assets/bootstrap/css/bootstrap.min.css') !!}
  {!! HTML::style('resources/assets/font-awesome-4.6.3/css/font-awesome.min.css') !!}
  {!! HTML::style('resources/assets/dist/css/Admin.min.css') !!}
  {!! HTML::style('resources/assets/plugins/iCheck/square/blue.css') !!}
  {!! HTML::style('resources/assets/css/admin/shopist.css') !!}
</head>
<body class="hold-transition register-page">
  @yield('content')
  
  {!! HTML::script('resources/assets/jquery/jquery-1.10.2.js') !!}
  {!! HTML::script('resources/assets/bootstrap/js/bootstrap.min.js') !!}
  {!! HTML::script('resources/assets/plugins/iCheck/icheck.min.js') !!}
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
      });
    });
  </script>
</body>
</html>