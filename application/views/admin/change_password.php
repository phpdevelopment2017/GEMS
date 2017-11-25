<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Gujarati-Samaj|Chang password</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/admin/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>adminLTE/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>js/admin/plugins/iCheck/square/blue.css">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <b>Gujarati-Samaj</b>
            </div>
            <div class="login-box-body">
                <form method="post" action="<?php echo base_url(); ?>admin/login/check_change_password" autocomplete="off">
                    <?php if ($message != '') { ?>
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $message; ?>
                        </div>
                    <?php } ?>
                    <div class="form-group has-feedback">
                        <input type="password" name="current_password" class="form-control" placeholder="Current Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="new_password" class="form-control" placeholder="New Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="confirm_new_password" class="form-control" placeholder="Confirm New Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Change Password</button>
                        </div>
                        <div class="col-xs-4 pull-right">
                            <a class="btn btn-primary btn-block btn-flat" href="<?php echo base_url(); ?>admin">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div style="text-align: center;">
            <strong>Copyright &copy; 2017 Gujarati-Samaj. All Rights Reserved.</strong>
        </div>
        <!-- jQuery 2.2.3 -->
        <script src="<?php echo base_url(); ?>js/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url(); ?>js/admin/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url(); ?>js/admin/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>
