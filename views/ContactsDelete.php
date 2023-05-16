<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ContactsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { contacts: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fcontactsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fcontactsdelete")
        .setPageId("delete")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fcontactsdelete" id="fcontactsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="contacts">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_contacts_id" class="contacts_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
        <th class="<?= $Page->company_id->headerCellClass() ?>"><span id="elh_contacts_company_id" class="contacts_company_id"><?= $Page->company_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th class="<?= $Page->type->headerCellClass() ?>"><span id="elh_contacts_type" class="contacts_type"><?= $Page->type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_contacts_name" class="contacts_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_contacts__email" class="contacts__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <th class="<?= $Page->user_id->headerCellClass() ?>"><span id="elh_contacts_user_id" class="contacts_user_id"><?= $Page->user_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tax_number->Visible) { // tax_number ?>
        <th class="<?= $Page->tax_number->headerCellClass() ?>"><span id="elh_contacts_tax_number" class="contacts_tax_number"><?= $Page->tax_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <th class="<?= $Page->phone->headerCellClass() ?>"><span id="elh_contacts_phone" class="contacts_phone"><?= $Page->phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
        <th class="<?= $Page->city->headerCellClass() ?>"><span id="elh_contacts_city" class="contacts_city"><?= $Page->city->caption() ?></span></th>
<?php } ?>
<?php if ($Page->zip_code->Visible) { // zip_code ?>
        <th class="<?= $Page->zip_code->headerCellClass() ?>"><span id="elh_contacts_zip_code" class="contacts_zip_code"><?= $Page->zip_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
        <th class="<?= $Page->state->headerCellClass() ?>"><span id="elh_contacts_state" class="contacts_state"><?= $Page->state->caption() ?></span></th>
<?php } ?>
<?php if ($Page->country->Visible) { // country ?>
        <th class="<?= $Page->country->headerCellClass() ?>"><span id="elh_contacts_country" class="contacts_country"><?= $Page->country->caption() ?></span></th>
<?php } ?>
<?php if ($Page->website->Visible) { // website ?>
        <th class="<?= $Page->website->headerCellClass() ?>"><span id="elh_contacts_website" class="contacts_website"><?= $Page->website->caption() ?></span></th>
<?php } ?>
<?php if ($Page->currency_code->Visible) { // currency_code ?>
        <th class="<?= $Page->currency_code->headerCellClass() ?>"><span id="elh_contacts_currency_code" class="contacts_currency_code"><?= $Page->currency_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->enabled->Visible) { // enabled ?>
        <th class="<?= $Page->enabled->headerCellClass() ?>"><span id="elh_contacts_enabled" class="contacts_enabled"><?= $Page->enabled->caption() ?></span></th>
<?php } ?>
<?php if ($Page->reference->Visible) { // reference ?>
        <th class="<?= $Page->reference->headerCellClass() ?>"><span id="elh_contacts_reference" class="contacts_reference"><?= $Page->reference->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
        <th class="<?= $Page->created_from->headerCellClass() ?>"><span id="elh_contacts_created_from" class="contacts_created_from"><?= $Page->created_from->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_contacts_created_by" class="contacts_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_contacts_created_at" class="contacts_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_contacts_updated_at" class="contacts_updated_at"><?= $Page->updated_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deleted_at->Visible) { // deleted_at ?>
        <th class="<?= $Page->deleted_at->headerCellClass() ?>"><span id="elh_contacts_deleted_at" class="contacts_deleted_at"><?= $Page->deleted_at->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
        <td<?= $Page->company_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->company_id->viewAttributes() ?>>
<?= $Page->company_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <td<?= $Page->type->cellAttributes() ?>>
<span id="">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <td<?= $Page->name->cellAttributes() ?>>
<span id="">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <td<?= $Page->_email->cellAttributes() ?>>
<span id="">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
        <td<?= $Page->user_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tax_number->Visible) { // tax_number ?>
        <td<?= $Page->tax_number->cellAttributes() ?>>
<span id="">
<span<?= $Page->tax_number->viewAttributes() ?>>
<?= $Page->tax_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
        <td<?= $Page->phone->cellAttributes() ?>>
<span id="">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
        <td<?= $Page->city->cellAttributes() ?>>
<span id="">
<span<?= $Page->city->viewAttributes() ?>>
<?= $Page->city->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->zip_code->Visible) { // zip_code ?>
        <td<?= $Page->zip_code->cellAttributes() ?>>
<span id="">
<span<?= $Page->zip_code->viewAttributes() ?>>
<?= $Page->zip_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
        <td<?= $Page->state->cellAttributes() ?>>
<span id="">
<span<?= $Page->state->viewAttributes() ?>>
<?= $Page->state->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->country->Visible) { // country ?>
        <td<?= $Page->country->cellAttributes() ?>>
<span id="">
<span<?= $Page->country->viewAttributes() ?>>
<?= $Page->country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->website->Visible) { // website ?>
        <td<?= $Page->website->cellAttributes() ?>>
<span id="">
<span<?= $Page->website->viewAttributes() ?>>
<?= $Page->website->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->currency_code->Visible) { // currency_code ?>
        <td<?= $Page->currency_code->cellAttributes() ?>>
<span id="">
<span<?= $Page->currency_code->viewAttributes() ?>>
<?= $Page->currency_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->enabled->Visible) { // enabled ?>
        <td<?= $Page->enabled->cellAttributes() ?>>
<span id="">
<span<?= $Page->enabled->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_enabled_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->enabled->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->enabled->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_enabled_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->reference->Visible) { // reference ?>
        <td<?= $Page->reference->cellAttributes() ?>>
<span id="">
<span<?= $Page->reference->viewAttributes() ?>>
<?= $Page->reference->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
        <td<?= $Page->created_from->cellAttributes() ?>>
<span id="">
<span<?= $Page->created_from->viewAttributes() ?>>
<?= $Page->created_from->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <td<?= $Page->created_by->cellAttributes() ?>>
<span id="">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <td<?= $Page->created_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td<?= $Page->updated_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->deleted_at->Visible) { // deleted_at ?>
        <td<?= $Page->deleted_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->deleted_at->viewAttributes() ?>>
<?= $Page->deleted_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
