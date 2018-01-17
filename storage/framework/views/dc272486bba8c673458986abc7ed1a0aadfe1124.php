<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <?php echo HTML::style('resources/assets/bootstrap/css/bootstrap.min.css'); ?>

  <?php echo HTML::style('resources/assets/font-awesome-4.6.3/css/font-awesome.min.css'); ?>

  <?php echo HTML::style('resources/assets/dist/css/Admin.min.css'); ?>

  <?php echo HTML::style('resources/assets/plugins/iCheck/square/blue.css'); ?>

  <?php echo HTML::style('resources/assets/css/admin/shopist.css'); ?>

</head>
<body class="hold-transition register-page">
  <?php echo $__env->yieldContent('content'); ?>
  
  <?php echo HTML::script('resources/assets/jquery/jquery-1.10.2.js'); ?>

  <?php echo HTML::script('resources/assets/bootstrap/js/bootstrap.min.js'); ?>

  <?php echo HTML::script('resources/assets/plugins/iCheck/icheck.min.js'); ?>

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