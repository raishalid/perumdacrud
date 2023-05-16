<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$DocumentsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { documents: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fdocumentsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdocumentsdelete")
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
<form name="fdocumentsdelete" id="fdocumentsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="documents">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_documents_id" class="documents_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->departement_id->Visible) { // departement_id ?>
        <th class="<?= $Page->departement_id->headerCellClass() ?>"><span id="elh_documents_departement_id" class="documents_departement_id"><?= $Page->departement_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
        <th class="<?= $Page->company_id->headerCellClass() ?>"><span id="elh_documents_company_id" class="documents_company_id"><?= $Page->company_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th class="<?= $Page->type->headerCellClass() ?>"><span id="elh_documents_type" class="documents_type"><?= $Page->type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->document_number->Visible) { // document_number ?>
        <th class="<?= $Page->document_number->headerCellClass() ?>"><span id="elh_documents_document_number" class="documents_document_number"><?= $Page->document_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->order_number->Visible) { // order_number ?>
        <th class="<?= $Page->order_number->headerCellClass() ?>"><span id="elh_documents_order_number" class="documents_order_number"><?= $Page->order_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_documents_status" class="documents_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->issued_at->Visible) { // issued_at ?>
        <th class="<?= $Page->issued_at->headerCellClass() ?>"><span id="elh_documents_issued_at" class="documents_issued_at"><?= $Page->issued_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->due_at->Visible) { // due_at ?>
        <th class="<?= $Page->due_at->headerCellClass() ?>"><span id="elh_documents_due_at" class="documents_due_at"><?= $Page->due_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
        <th class="<?= $Page->amount->headerCellClass() ?>"><span id="elh_documents_amount" class="documents_amount"><?= $Page->amount->caption() ?></span></th>
<?php } ?>
<?php if ($Page->currency_code->Visible) { // currency_code ?>
        <th class="<?= $Page->currency_code->headerCellClass() ?>"><span id="elh_documents_currency_code" class="documents_currency_code"><?= $Page->currency_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->currency_rate->Visible) { // currency_rate ?>
        <th class="<?= $Page->currency_rate->headerCellClass() ?>"><span id="elh_documents_currency_rate" class="documents_currency_rate"><?= $Page->currency_rate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->category_id->Visible) { // category_id ?>
        <th class="<?= $Page->category_id->headerCellClass() ?>"><span id="elh_documents_category_id" class="documents_category_id"><?= $Page->category_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_id->Visible) { // contact_id ?>
        <th class="<?= $Page->contact_id->headerCellClass() ?>"><span id="elh_documents_contact_id" class="documents_contact_id"><?= $Page->contact_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_name->Visible) { // contact_name ?>
        <th class="<?= $Page->contact_name->headerCellClass() ?>"><span id="elh_documents_contact_name" class="documents_contact_name"><?= $Page->contact_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_email->Visible) { // contact_email ?>
        <th class="<?= $Page->contact_email->headerCellClass() ?>"><span id="elh_documents_contact_email" class="documents_contact_email"><?= $Page->contact_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_tax_number->Visible) { // contact_tax_number ?>
        <th class="<?= $Page->contact_tax_number->headerCellClass() ?>"><span id="elh_documents_contact_tax_number" class="documents_contact_tax_number"><?= $Page->contact_tax_number->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_phone->Visible) { // contact_phone ?>
        <th class="<?= $Page->contact_phone->headerCellClass() ?>"><span id="elh_documents_contact_phone" class="documents_contact_phone"><?= $Page->contact_phone->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_city->Visible) { // contact_city ?>
        <th class="<?= $Page->contact_city->headerCellClass() ?>"><span id="elh_documents_contact_city" class="documents_contact_city"><?= $Page->contact_city->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_zip_code->Visible) { // contact_zip_code ?>
        <th class="<?= $Page->contact_zip_code->headerCellClass() ?>"><span id="elh_documents_contact_zip_code" class="documents_contact_zip_code"><?= $Page->contact_zip_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_state->Visible) { // contact_state ?>
        <th class="<?= $Page->contact_state->headerCellClass() ?>"><span id="elh_documents_contact_state" class="documents_contact_state"><?= $Page->contact_state->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_country->Visible) { // contact_country ?>
        <th class="<?= $Page->contact_country->headerCellClass() ?>"><span id="elh_documents_contact_country" class="documents_contact_country"><?= $Page->contact_country->caption() ?></span></th>
<?php } ?>
<?php if ($Page->parent_id->Visible) { // parent_id ?>
        <th class="<?= $Page->parent_id->headerCellClass() ?>"><span id="elh_documents_parent_id" class="documents_parent_id"><?= $Page->parent_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
        <th class="<?= $Page->created_from->headerCellClass() ?>"><span id="elh_documents_created_from" class="documents_created_from"><?= $Page->created_from->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_documents_created_by" class="documents_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_documents_created_at" class="documents_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_documents_updated_at" class="documents_updated_at"><?= $Page->updated_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deleted_at->Visible) { // deleted_at ?>
        <th class="<?= $Page->deleted_at->headerCellClass() ?>"><span id="elh_documents_deleted_at" class="documents_deleted_at"><?= $Page->deleted_at->caption() ?></span></th>
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
<?php if ($Page->departement_id->Visible) { // departement_id ?>
        <td<?= $Page->departement_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->departement_id->viewAttributes() ?>>
<?= $Page->departement_id->getViewValue() ?></span>
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
<?php if ($Page->document_number->Visible) { // document_number ?>
        <td<?= $Page->document_number->cellAttributes() ?>>
<span id="">
<span<?= $Page->document_number->viewAttributes() ?>>
<?= $Page->document_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->order_number->Visible) { // order_number ?>
        <td<?= $Page->order_number->cellAttributes() ?>>
<span id="">
<span<?= $Page->order_number->viewAttributes() ?>>
<?= $Page->order_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->issued_at->Visible) { // issued_at ?>
        <td<?= $Page->issued_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->issued_at->viewAttributes() ?>>
<?= $Page->issued_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->due_at->Visible) { // due_at ?>
        <td<?= $Page->due_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->due_at->viewAttributes() ?>>
<?= $Page->due_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
        <td<?= $Page->amount->cellAttributes() ?>>
<span id="">
<span<?= $Page->amount->viewAttributes() ?>>
<?= $Page->amount->getViewValue() ?></span>
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
<?php if ($Page->currency_rate->Visible) { // currency_rate ?>
        <td<?= $Page->currency_rate->cellAttributes() ?>>
<span id="">
<span<?= $Page->currency_rate->viewAttributes() ?>>
<?= $Page->currency_rate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->category_id->Visible) { // category_id ?>
        <td<?= $Page->category_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->category_id->viewAttributes() ?>>
<?= $Page->category_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_id->Visible) { // contact_id ?>
        <td<?= $Page->contact_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->contact_id->viewAttributes() ?>>
<?= $Page->contact_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_name->Visible) { // contact_name ?>
        <td<?= $Page->contact_name->cellAttributes() ?>>
<span id="">
<span<?= $Page->contact_name->viewAttributes() ?>>
<?= $Page->contact_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_email->Visible) { // contact_email ?>
        <td<?= $Page->contact_email->cellAttributes() ?>>
<span id="">
<span<?= $Page->contact_email->viewAttributes() ?>>
<?= $Page->contact_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_tax_number->Visible) { // contact_tax_number ?>
        <td<?= $Page->contact_tax_number->cellAttributes() ?>>
<span id="">
<span<?= $Page->contact_tax_number->viewAttributes() ?>>
<?= $Page->contact_tax_number->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_phone->Visible) { // contact_phone ?>
        <td<?= $Page->contact_phone->cellAttributes() ?>>
<span id="">
<span<?= $Page->contact_phone->viewAttributes() ?>>
<?= $Page->contact_phone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_city->Visible) { // contact_city ?>
        <td<?= $Page->contact_city->cellAttributes() ?>>
<span id="">
<span<?= $Page->contact_city->viewAttributes() ?>>
<?= $Page->contact_city->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_zip_code->Visible) { // contact_zip_code ?>
        <td<?= $Page->contact_zip_code->cellAttributes() ?>>
<span id="">
<span<?= $Page->contact_zip_code->viewAttributes() ?>>
<?= $Page->contact_zip_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_state->Visible) { // contact_state ?>
        <td<?= $Page->contact_state->cellAttributes() ?>>
<span id="">
<span<?= $Page->contact_state->viewAttributes() ?>>
<?= $Page->contact_state->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contact_country->Visible) { // contact_country ?>
        <td<?= $Page->contact_country->cellAttributes() ?>>
<span id="">
<span<?= $Page->contact_country->viewAttributes() ?>>
<?= $Page->contact_country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->parent_id->Visible) { // parent_id ?>
        <td<?= $Page->parent_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->parent_id->viewAttributes() ?>>
<?= $Page->parent_id->getViewValue() ?></span>
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
