<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$DocumentsView = &$Page;
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
<form name="fdocumentsview" id="fdocumentsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { documents: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fdocumentsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdocumentsview")
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
<input type="hidden" name="t" value="documents">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_documents_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->departement_id->Visible) { // departement_id ?>
    <tr id="r_departement_id"<?= $Page->departement_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_departement_id"><?= $Page->departement_id->caption() ?></span></td>
        <td data-name="departement_id"<?= $Page->departement_id->cellAttributes() ?>>
<span id="el_documents_departement_id">
<span<?= $Page->departement_id->viewAttributes() ?>>
<?= $Page->departement_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
    <tr id="r_company_id"<?= $Page->company_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_company_id"><?= $Page->company_id->caption() ?></span></td>
        <td data-name="company_id"<?= $Page->company_id->cellAttributes() ?>>
<span id="el_documents_company_id">
<span<?= $Page->company_id->viewAttributes() ?>>
<?= $Page->company_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <tr id="r_type"<?= $Page->type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_type"><?= $Page->type->caption() ?></span></td>
        <td data-name="type"<?= $Page->type->cellAttributes() ?>>
<span id="el_documents_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->document_number->Visible) { // document_number ?>
    <tr id="r_document_number"<?= $Page->document_number->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_document_number"><?= $Page->document_number->caption() ?></span></td>
        <td data-name="document_number"<?= $Page->document_number->cellAttributes() ?>>
<span id="el_documents_document_number">
<span<?= $Page->document_number->viewAttributes() ?>>
<?= $Page->document_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->order_number->Visible) { // order_number ?>
    <tr id="r_order_number"<?= $Page->order_number->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_order_number"><?= $Page->order_number->caption() ?></span></td>
        <td data-name="order_number"<?= $Page->order_number->cellAttributes() ?>>
<span id="el_documents_order_number">
<span<?= $Page->order_number->viewAttributes() ?>>
<?= $Page->order_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_documents_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->issued_at->Visible) { // issued_at ?>
    <tr id="r_issued_at"<?= $Page->issued_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_issued_at"><?= $Page->issued_at->caption() ?></span></td>
        <td data-name="issued_at"<?= $Page->issued_at->cellAttributes() ?>>
<span id="el_documents_issued_at">
<span<?= $Page->issued_at->viewAttributes() ?>>
<?= $Page->issued_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->due_at->Visible) { // due_at ?>
    <tr id="r_due_at"<?= $Page->due_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_due_at"><?= $Page->due_at->caption() ?></span></td>
        <td data-name="due_at"<?= $Page->due_at->cellAttributes() ?>>
<span id="el_documents_due_at">
<span<?= $Page->due_at->viewAttributes() ?>>
<?= $Page->due_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
    <tr id="r_amount"<?= $Page->amount->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_amount"><?= $Page->amount->caption() ?></span></td>
        <td data-name="amount"<?= $Page->amount->cellAttributes() ?>>
<span id="el_documents_amount">
<span<?= $Page->amount->viewAttributes() ?>>
<?= $Page->amount->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->currency_code->Visible) { // currency_code ?>
    <tr id="r_currency_code"<?= $Page->currency_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_currency_code"><?= $Page->currency_code->caption() ?></span></td>
        <td data-name="currency_code"<?= $Page->currency_code->cellAttributes() ?>>
<span id="el_documents_currency_code">
<span<?= $Page->currency_code->viewAttributes() ?>>
<?= $Page->currency_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->currency_rate->Visible) { // currency_rate ?>
    <tr id="r_currency_rate"<?= $Page->currency_rate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_currency_rate"><?= $Page->currency_rate->caption() ?></span></td>
        <td data-name="currency_rate"<?= $Page->currency_rate->cellAttributes() ?>>
<span id="el_documents_currency_rate">
<span<?= $Page->currency_rate->viewAttributes() ?>>
<?= $Page->currency_rate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->category_id->Visible) { // category_id ?>
    <tr id="r_category_id"<?= $Page->category_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_category_id"><?= $Page->category_id->caption() ?></span></td>
        <td data-name="category_id"<?= $Page->category_id->cellAttributes() ?>>
<span id="el_documents_category_id">
<span<?= $Page->category_id->viewAttributes() ?>>
<?= $Page->category_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_id->Visible) { // contact_id ?>
    <tr id="r_contact_id"<?= $Page->contact_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_contact_id"><?= $Page->contact_id->caption() ?></span></td>
        <td data-name="contact_id"<?= $Page->contact_id->cellAttributes() ?>>
<span id="el_documents_contact_id">
<span<?= $Page->contact_id->viewAttributes() ?>>
<?= $Page->contact_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_name->Visible) { // contact_name ?>
    <tr id="r_contact_name"<?= $Page->contact_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_contact_name"><?= $Page->contact_name->caption() ?></span></td>
        <td data-name="contact_name"<?= $Page->contact_name->cellAttributes() ?>>
<span id="el_documents_contact_name">
<span<?= $Page->contact_name->viewAttributes() ?>>
<?= $Page->contact_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_email->Visible) { // contact_email ?>
    <tr id="r_contact_email"<?= $Page->contact_email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_contact_email"><?= $Page->contact_email->caption() ?></span></td>
        <td data-name="contact_email"<?= $Page->contact_email->cellAttributes() ?>>
<span id="el_documents_contact_email">
<span<?= $Page->contact_email->viewAttributes() ?>>
<?= $Page->contact_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_tax_number->Visible) { // contact_tax_number ?>
    <tr id="r_contact_tax_number"<?= $Page->contact_tax_number->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_contact_tax_number"><?= $Page->contact_tax_number->caption() ?></span></td>
        <td data-name="contact_tax_number"<?= $Page->contact_tax_number->cellAttributes() ?>>
<span id="el_documents_contact_tax_number">
<span<?= $Page->contact_tax_number->viewAttributes() ?>>
<?= $Page->contact_tax_number->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_phone->Visible) { // contact_phone ?>
    <tr id="r_contact_phone"<?= $Page->contact_phone->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_contact_phone"><?= $Page->contact_phone->caption() ?></span></td>
        <td data-name="contact_phone"<?= $Page->contact_phone->cellAttributes() ?>>
<span id="el_documents_contact_phone">
<span<?= $Page->contact_phone->viewAttributes() ?>>
<?= $Page->contact_phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_address->Visible) { // contact_address ?>
    <tr id="r_contact_address"<?= $Page->contact_address->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_contact_address"><?= $Page->contact_address->caption() ?></span></td>
        <td data-name="contact_address"<?= $Page->contact_address->cellAttributes() ?>>
<span id="el_documents_contact_address">
<span<?= $Page->contact_address->viewAttributes() ?>>
<?= $Page->contact_address->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_city->Visible) { // contact_city ?>
    <tr id="r_contact_city"<?= $Page->contact_city->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_contact_city"><?= $Page->contact_city->caption() ?></span></td>
        <td data-name="contact_city"<?= $Page->contact_city->cellAttributes() ?>>
<span id="el_documents_contact_city">
<span<?= $Page->contact_city->viewAttributes() ?>>
<?= $Page->contact_city->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_zip_code->Visible) { // contact_zip_code ?>
    <tr id="r_contact_zip_code"<?= $Page->contact_zip_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_contact_zip_code"><?= $Page->contact_zip_code->caption() ?></span></td>
        <td data-name="contact_zip_code"<?= $Page->contact_zip_code->cellAttributes() ?>>
<span id="el_documents_contact_zip_code">
<span<?= $Page->contact_zip_code->viewAttributes() ?>>
<?= $Page->contact_zip_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_state->Visible) { // contact_state ?>
    <tr id="r_contact_state"<?= $Page->contact_state->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_contact_state"><?= $Page->contact_state->caption() ?></span></td>
        <td data-name="contact_state"<?= $Page->contact_state->cellAttributes() ?>>
<span id="el_documents_contact_state">
<span<?= $Page->contact_state->viewAttributes() ?>>
<?= $Page->contact_state->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_country->Visible) { // contact_country ?>
    <tr id="r_contact_country"<?= $Page->contact_country->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_contact_country"><?= $Page->contact_country->caption() ?></span></td>
        <td data-name="contact_country"<?= $Page->contact_country->cellAttributes() ?>>
<span id="el_documents_contact_country">
<span<?= $Page->contact_country->viewAttributes() ?>>
<?= $Page->contact_country->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <tr id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_notes"><?= $Page->notes->caption() ?></span></td>
        <td data-name="notes"<?= $Page->notes->cellAttributes() ?>>
<span id="el_documents_notes">
<span<?= $Page->notes->viewAttributes() ?>>
<?= $Page->notes->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->footer->Visible) { // footer ?>
    <tr id="r_footer"<?= $Page->footer->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_footer"><?= $Page->footer->caption() ?></span></td>
        <td data-name="footer"<?= $Page->footer->cellAttributes() ?>>
<span id="el_documents_footer">
<span<?= $Page->footer->viewAttributes() ?>>
<?= $Page->footer->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->parent_id->Visible) { // parent_id ?>
    <tr id="r_parent_id"<?= $Page->parent_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_parent_id"><?= $Page->parent_id->caption() ?></span></td>
        <td data-name="parent_id"<?= $Page->parent_id->cellAttributes() ?>>
<span id="el_documents_parent_id">
<span<?= $Page->parent_id->viewAttributes() ?>>
<?= $Page->parent_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
    <tr id="r_created_from"<?= $Page->created_from->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_created_from"><?= $Page->created_from->caption() ?></span></td>
        <td data-name="created_from"<?= $Page->created_from->cellAttributes() ?>>
<span id="el_documents_created_from">
<span<?= $Page->created_from->viewAttributes() ?>>
<?= $Page->created_from->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <tr id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_created_by"><?= $Page->created_by->caption() ?></span></td>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el_documents_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_documents_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_documents_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deleted_at->Visible) { // deleted_at ?>
    <tr id="r_deleted_at"<?= $Page->deleted_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_documents_deleted_at"><?= $Page->deleted_at->caption() ?></span></td>
        <td data-name="deleted_at"<?= $Page->deleted_at->cellAttributes() ?>>
<span id="el_documents_deleted_at">
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
