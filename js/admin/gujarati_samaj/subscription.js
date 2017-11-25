var subscriptionListTemplate = Handlebars.compile($('#subscription_list_template').html());
var subscriptionTableTemplate = Handlebars.compile($('#subscription_table_template').html());
var subscriptionActionButtonTemplate = Handlebars.compile($('#subscription_action_button_template').html());

var Subscription = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};

Subscription.Router = Backbone.Router.extend({
    routes: {
        '': 'renderList',
        'subscription/list': 'renderList'
    },
    renderList: function () {
        Subscription.listview.listPage();
    }
});
Subscription.listView = Backbone.View.extend({
    el: 'div#main_container',
    events: {
    },
    listPage: function () {
        this.$el.html(subscriptionListTemplate);
        $('#subscription_datatable_container').html(subscriptionTableTemplate);
        this.loadAllSubscriptions();
    },
    loadAllSubscriptions: function () {
        var subscriptionActionBtnRender = function (data, type, full, meta) {
            return subscriptionActionButtonTemplate({'delete_template': deleteTemplate, 'subscription_id': data});
        };
        subscriptionDatatable = $('#subscription_datatable').DataTable({
            ajax: {
                url: 'admin/subscription/get_all_subscription',
                type: "post"
            },
            bAutoWidth: false,
            columns: [
                {data: 'subscription_email'},
                {data: 'subscription_time', 'render': dateTimeRenderer},
                {data: 'subscription_id', 'render': subscriptionActionBtnRender, 'orderable': false}
            ]
        });
        $('#subscription_datatable tbody').on('click', 'tr', function () {
            currentActiveRowForSubscription = this;
        });
    },
    askForSubscriptionGroup: function (subscriptionId) {
        var noEvent = "$(this).closest('.stack-bar-bottom').hide();";
        var yesEvent = 'Subscription.listview.deleteSubscription(' + subscriptionId + ')';
        showConfirmation('warning', yesEvent, noEvent, true);
    },
    deleteSubscription: function (subscriptionId) {
        if (!subscriptionId) {
            showError('Please select proper Subscription');
            return false;
        }
        $('#subscription_delete_btn_' + subscriptionId).html(spinnerTemplate);
        $.ajax({
            type: 'POST',
            url: 'admin/subscription/delete_subscription_by_id',
            data: {"subscription_id": subscriptionId},
            success: function (response) {
                var parseData = JSON.parse(response);
                $('.stack-bar-bottom').hide();
                $('#subscription_delete_btn_' + subscriptionId).html(deleteTemplate);
                if (parseData.success == false) {
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                subscriptionDatatable.row(currentActiveRowForSubscription)
                        .remove().draw(false);
            }
        });
    }
});