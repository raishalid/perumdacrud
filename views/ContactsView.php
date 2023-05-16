<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ContactsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<form name="fcontactsview" id="fcontactsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { contacts: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fcontactsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fcontactsview")
        .setPageId("view")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="contacts">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_contacts_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
    <tr id="r_company_id"<?= $Page->company_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_company_id"><?= $Page->company_id->caption() ?></span></td>
        <td data-name="company_id"<?= $Page->company_id->cellAttributes() ?>>
<span id="el_contacts_company_id">
<span<?= $Page->company_id->viewAttributes() ?>>
<?= $Page->company_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <tr id="r_type"<?= $Page->type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_type"><?= $Page->type->caption() ?></span></td>
        <td data-name="type"<?= $Page->type->cellAttributes() ?>>
<span id="el_contacts_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <tr id="r_name"<?= $Page->name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_name"><?= $Page->name->caption() ?></span></td>
        <td data-name="name"<?= $Page->name->cellAttributes() ?>>
<span id="el_contacts_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <tr id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts__email"><?= $Page->_email->caption() ?></span></td>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el_contacts__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <tr id="r_user_id"<?= $Page->user_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_user_id"><?= $Page->user_id->caption() ?></span></td>
        <td data-name="user_id"<?= $Page->user_id->cellAttributes() ?>>
<span id="el_contacts_user_id">
<span<?= $Page->user_id->viewAttributes() ?>>
<?= $Page->user_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tax_number->Visible) { // tax_number ?>
    <tr id="r_tax_number"<?= $Page->tax_number->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_tax_number"><?= $Page->tax_number->caption() ?></span></td>
        <td data-name="tax_number"<?= $Page->tax_number->cellAttributes() ?>>
<span id="el_contacts_tax_number">
<span<?= $Page->tax_number->viewAttributes() ?>>
<?= $Page->tax_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <tr id="r_phone"<?= $Page->phone->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_phone"><?= $Page->phone->caption() ?></span></td>
        <td data-name="phone"<?= $Page->phone->cellAttributes() ?>>
<span id="el_contacts_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <tr id="r_address"<?= $Page->address->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_address"><?= $Page->address->caption() ?></span></td>
        <td data-name="address"<?= $Page->address->cellAttributes() ?>>
<span id="el_contacts_address">
<span<?= $Page->address->viewAttributes() ?>>
<?= $Page->address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
    <tr id="r_city"<?= $Page->city->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_city"><?= $Page->city->caption() ?></span></td>
        <td data-name="city"<?= $Page->city->cellAttributes() ?>>
<span id="el_contacts_city">
<span<?= $Page->city->viewAttributes() ?>>
<?= $Page->city->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->zip_code->Visible) { // zip_code ?>
    <tr id="r_zip_code"<?= $Page->zip_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_zip_code"><?= $Page->zip_code->caption() ?></span></td>
        <td data-name="zip_code"<?= $Page->zip_code->cellAttributes() ?>>
<span id="el_contacts_zip_code">
<span<?= $Page->zip_code->viewAttributes() ?>>
<?= $Page->zip_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
    <tr id="r_state"<?= $Page->state->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_state"><?= $Page->state->caption() ?></span></td>
        <td data-name="state"<?= $Page->state->cellAttributes() ?>>
<span id="el_contacts_state">
<span<?= $Page->state->viewAttributes() ?>>
<?= $Page->state->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->country->Visible) { // country ?>
    <tr id="r_country"<?= $Page->country->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_country"><?= $Page->country->caption() ?></span></td>
        <td data-name="country"<?= $Page->country->cellAttributes() ?>>
<span id="el_contacts_country">
<span<?= $Page->country->viewAttributes() ?>>
<?= $Page->country->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->website->Visible) { // website ?>
    <tr id="r_website"<?= $Page->website->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_website"><?= $Page->website->caption() ?></span></td>
        <td data-name="website"<?= $Page->website->cellAttributes() ?>>
<span id="el_contacts_website">
<span<?= $Page->website->viewAttributes() ?>>
<?= $Page->website->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->currency_code->Visible) { // currency_code ?>
    <tr id="r_currency_code"<?= $Page->currency_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_currency_code"><?= $Page->currency_code->caption() ?></span></td>
        <td data-name="currency_code"<?= $Page->currency_code->cellAttributes() ?>>
<span id="el_contacts_currency_code">
<span<?= $Page->currency_code->viewAttributes() ?>>
<?= $Page->currency_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->enabled->Visible) { // enabled ?>
    <tr id="r_enabled"<?= $Page->enabled->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_enabled"><?= $Page->enabled->caption() ?></span></td>
        <td data-name="enabled"<?= $Page->enabled->cellAttributes() ?>>
<span id="el_contacts_enabled">
<span<?= $Page->enabled->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_enabled_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->enabled->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->enabled->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_enabled_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->reference->Visible) { // reference ?>
    <tr id="r_reference"<?= $Page->reference->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_reference"><?= $Page->reference->caption() ?></span></td>
        <td data-name="reference"<?= $Page->reference->cellAttributes() ?>>
<span id="el_contacts_reference">
<span<?= $Page->reference->viewAttributes() ?>>
<?= $Page->reference->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
    <tr id="r_created_from"<?= $Page->created_from->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_created_from"><?= $Page->created_from->caption() ?></span></td>
        <td data-name="created_from"<?= $Page->created_from->cellAttributes() ?>>
<span id="el_contacts_created_from">
<span<?= $Page->created_from->viewAttributes() ?>>
<?= $Page->created_from->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <tr id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_created_by"><?= $Page->created_by->caption() ?></span></td>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el_contacts_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_contacts_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_contacts_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deleted_at->Visible) { // deleted_at ?>
    <tr id="r_deleted_at"<?= $Page->deleted_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_contacts_deleted_at"><?= $Page->deleted_at->caption() ?></span></td>
        <td data-name="deleted_at"<?= $Page->deleted_at->cellAttributes() ?>>
<span id="el_contacts_deleted_at">
<span<?= $Page->deleted_at->viewAttributes() ?>>
<?= $Page->deleted_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
