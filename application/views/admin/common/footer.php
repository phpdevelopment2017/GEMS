<?php $base_url = base_url(); ?>
<script type="text/javascript">
    $('.select2').on('keypress', function () {
        $(this).focus();
    });

    $.ajaxSetup({
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            showError("An Unexpected Error has occured. Please try refreshing the page with Ctrl+F5. If Error Persists please contact support with the scenario.");
        }
    });
</script>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2017. All Rights Reserved.</strong>
</footer>
<link rel="stylesheet" href="<?php echo $base_url; ?>css/admin/gujarati_samaj.css">
</body>
</html>