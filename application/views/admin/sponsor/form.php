<form role="form" method="post" name="sponsor_form" id="sponsor_form">
    <input type="hidden" name="sponsor_id" id="sponsor_id" class="form-control">
    <div class="box-body with-border">
        <div class="form-group col-md-3">
            <label>Sponsorship Type</label>
            <select name="sponsorship_type" id="sponsorship_type" class="form-control select2" data-placeholder="Sponsorship Type">
            </select>
        </div>
        <div class="form-group col-md-3">
            <label>Sponsor Name</label>
            <input type="text" name="sponsor_name" id="sponsor_name" class="form-control" placeholder="Sponsor Name">
        </div>
        <div class="form-group col-md-6">
            <label>Address</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Address">
        </div>
        <div class="form-group col-md-3">
            <label>Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number">
        </div>
        <div class="form-group col-md-3">
            <label>Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group col-md-3">
            <label>Website</label>
            <input type="text" name="website" id="website" class="form-control" placeholder="Website">
        </div>
        <div class="form-group col-md-3">
            <label>Cost Per Year</label>
            <input type="text" name="cost_per_year" id="cost_per_year" class="form-control text-right"
                   onkeyup="checkNumeric($(this));" onblur="roundOff($(this));"
                   placeholder="Cost Per Year">
        </div>
    </div>
    <div class="box-footer">
        <button type="button" class="btn btn-xs btn-primary save_sponsor_btn" id="save_sponsor_btn"
                onclick="Sponsor.listview.saveSponsor();">
            <label class="fa fa-check label-btn-icon"></label>
            &nbsp;<label class="label-btn-fonts" id="sponsor_form_btn_text">Save</label>
        </button>
        <a class="btn btn-xs btn-primary" id="spinner_sponsor_btn" style="display: none">
        </a>
        <button type="button" class="btn btn-xs btn-default" id="cancel_sponsor_btn" onclick="$('#sponsor_form_container').html('');">
            <label class="fa fa-close label-btn-icon"></label>
            &nbsp;<label class="label-btn-fonts">Cancel</label>
        </button>
    </div>
</form>