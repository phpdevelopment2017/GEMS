<script type="text/javascript" src="<?php echo base_url() ?>js/admin/gujarati_samaj/utility.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/admin/gujarati_samaj/dateutil.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/admin/gujarati_samaj/sponsor.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/admin/gujarati_samaj/subscription.js"></script>

<script type="text/javascript" >
    $(function () {
        Sponsor.run();
        Subscription.run();
        Backbone.history.start();
    });
</script>