<div>
    <button type="button" class="btn btn-xs btn-primary btn-font" id="sponsor_edit_btn_{{sponsor_id}}" onclick="Sponsor.listview.editSponsor('{{sponsor_id}}')">
        <label class="fa fa-pencil label-btn-icon"></label>
        &nbsp;<label class="label-btn-fonts">Edit</label>
    </button>
    <button type="button" class="btn btn-xs btn-danger" id="sponsor_delete_btn_{{sponsor_id}}" onclick="Sponsor.listview.askForSponsorGroup('{{sponsor_id}}')">
        {{{delete_template}}}
    </button>
</div>