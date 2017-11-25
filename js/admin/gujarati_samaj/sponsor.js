var sponsorListTemplate = Handlebars.compile($('#sponsor_list_template').html());
var sponsorTableTemplate = Handlebars.compile($('#sponsor_table_template').html());
var sponsorActionButtonTemplate = Handlebars.compile($('#sponsor_action_button_template').html());
var sponsorFormTemplate = Handlebars.compile($('#sponsor_form_template').html());

var Sponsor = {
    run: function () {
        this.router = new this.Router();
        this.listview = new this.listView();
    }
};

Sponsor.Router = Backbone.Router.extend({
    routes: {
        'sponsor/list': 'renderList'
    },
    renderList: function () {
        Sponsor.listview.listPage();
    }
});
Sponsor.listView = Backbone.View.extend({
    el: 'div#main_container',
    listPage: function () {
        this.$el.html(sponsorListTemplate);
        $('#sponsor_datatable_container').html(sponsorTableTemplate);
        this.loadAllSponsors();
    },
    loadAllSponsors: function () {
        var sponsorshipTypeRenderer = function (data, type, full, meta) {
            return  sponsorshipTypeArray[data] ? sponsorshipTypeArray[data] : '-';
        };
        var sponsorActionBtnRender = function (data, type, full, meta) {
            return sponsorActionButtonTemplate({'delete_template': deleteTemplate, 'sponsor_id': data});
        };
        sponsorDatatable = $('#sponsor_datatable').DataTable({
            ajax: {
                url: 'admin/sponsor/get_all_sponsor',
                type: "post"
            },
            bAutoWidth: false,
            columns: [
                {data: 'sponsor_name'},
                {data: 'sponsorship_type', 'render': sponsorshipTypeRenderer},
                {data: 'email'},
                {data: 'phone_number'},
                {data: 'sponsor_id', 'render': sponsorActionBtnRender, 'orderable': false}
            ]
        });
        $('#sponsor_datatable tbody').on('click', 'tr', function () {
            currentActiveRowForSponsor = this;
        });
    },
    sponsorForm: function (isEdit, sponsorData) {
        $('#sponsor_form_container').html(sponsorFormTemplate);
        renderOptionsForTwoDimensionalArray(sponsorshipTypeArray, 'sponsorship_type');
        if (isEdit) {
            $('#sponsor_id').val(sponsorData.sponsor_id);
            $('#sponsorship_type').val(sponsorData.sponsorship_type);
            $('#sponsor_name').val(sponsorData.sponsor_name);
            $('#address').val(sponsorData.address);
            $('#phone_number').val(sponsorData.phone_number);
            $('#email').val(sponsorData.email);
            $('#website').val(sponsorData.website);
            $('#cost_per_year').val(sponsorData.cost_per_year);
        }
        var sponsorFormBtnText = isEdit ? 'Update' : 'Save';
        $('#sponsor_form_btn_text').html(sponsorFormBtnText);
        $('.select2').select2({"allowClear": true});
    },
    editSponsor: function (sponsorId) {
        if (!sponsorId) {
            showError('Please Select Proper Sponsor.');
            return false;
        }
        var that = this;
        $.ajax({
            type: 'POST',
            url: 'admin/sponsor/get_sponsor_by_id',
            data: {"sponsor_id": sponsorId},
            success: function (response) {
                var parseData = JSON.parse(response);
                if (parseData.success == false) {
                    showError(parseData.message);
                    return false;
                }
                that.sponsorForm(true, parseData.sponsor_data);
            }
        });
    },
    saveSponsor: function () {
        var that = this;
        var sponsorFormData = $('#sponsor_form').serializeFormJSON();
        if (!sponsorFormData.sponsorship_type) {
            showError('Please Select Sponsorship Type.');
            return false;
        }
        if (!sponsorFormData.sponsor_name) {
            showError('Please Enter Sponsor Name.');
            $('#sponsor_name').focus();
            return false;
        }
        if (!sponsorFormData.phone_number) {
            showError('Please Enter Phone Number.');
            $('#phone_number').focus();
            return false;
        }
        if (!sponsorFormData.email) {
            showError('Please Enter Email.');
            $('#email').focus();
            return false;
        }
        if (!validateEmail(sponsorFormData.email)) {
            showError('Please Enter Valid Email.');
            $('#email').focus();
            return false;
        }
        if (!sponsorFormData.cost_per_year) {
            showError('Please Enter Cost Per Year.');
            $('#cost_per_year').focus();
            return false;
        }
        var url = !sponsorFormData.sponsor_id ? 'save' : 'update';
        $('#save_sponsor_btn').hide();
        $('#spinner_sponsor_btn').html(spinnerTemplate);
        $('#spinner_sponsor_btn').show();
        $.ajax({
            type: 'POST',
            url: 'admin/sponsor/' + url + '_sponsor',
            data: sponsorFormData,
            success: function (response) {
                var parseData = JSON.parse(response);
                $('#spinner_sponsor_btn').hide();
                $('#save_sponsor_btn').show();
                if (parseData.success == false) {
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                sponsorDatatable.ajax.reload();
                if (url == 'save') {
                    that.sponsorForm(false);
                } else {
                    $('#sponsor_form_container').html('');
                }
            }
        });
    },
    askForSponsorGroup: function (sponsorId) {
        var noEvent = "$(this).closest('.stack-bar-bottom').hide();";
        var yesEvent = 'Sponsor.listview.deleteSponsor(' + sponsorId + ')';
        showConfirmation('warning', yesEvent, noEvent, true);
    },
    deleteSponsor: function (sponsorId) {
        if (!sponsorId) {
            showError('Please select proper Sponsor');
            return false;
        }
        $('#sponsor_delete_btn_' + sponsorId).html(spinnerTemplate);
        $.ajax({
            type: 'POST',
            url: 'admin/sponsor/delete_sponsor_by_id',
            data: {"sponsor_id": sponsorId},
            success: function (response) {
                var parseData = JSON.parse(response);
                $('.stack-bar-bottom').hide();
                $('#sponsor_delete_btn_' + sponsorId).html(deleteTemplate);
                if (parseData.success == false) {
                    showError(parseData.message);
                    return false;
                }
                showSuccess(parseData.message);
                sponsorDatatable.row(currentActiveRowForSponsor)
                        .remove().draw(false);
            }
        });
    }
});