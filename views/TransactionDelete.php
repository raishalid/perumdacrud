<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$TransactionDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transaction: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var ftransactiondelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ftransactiondelete")
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
<form name="ftransactiondelete" id="ftransactiondelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transaction">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_transaction_id" class="transaction_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->acc_id->Visible) { // acc_id ?>
        <th class="<?= $Page->acc_id->headerCellClass() ?>"><span id="elh_transaction_acc_id" class="transaction_acc_id"><?= $Page->acc_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->paid_at->Visible) { // paid_at ?>
        <th class="<?= $Page->paid_at->headerCellClass() ?>"><span id="elh_transaction_paid_at" class="transaction_paid_at"><?= $Page->paid_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->departement_id->Visible) { // departement_id ?>
        <th class="<?= $Page->departement_id->headerCellClass() ?>"><span id="elh_transaction_departement_id" class="transaction_departement_id"><?= $Page->departement_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->type_id->Visible) { // type_id ?>
        <th class="<?= $Page->type_id->headerCellClass() ?>"><span id="elh_transaction_type_id" class="transaction_type_id"><?= $Page->type_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
        <th class="<?= $Page->amount->headerCellClass() ?>"><span id="elh_transaction_amount" class="transaction_amount"><?= $Page->amount->caption() ?></span></th>
<?php } ?>
<?php if ($Page->currency_code->Visible) { // currency_code ?>
        <th class="<?= $Page->currency_code->headerCellClass() ?>"><span id="elh_transaction_currency_code" class="transaction_currency_code"><?= $Page->currency_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->currency_rate->Visible) { // currency_rate ?>
        <th class="<?= $Page->currency_rate->headerCellClass() ?>"><span id="elh_transaction_currency_rate" class="transaction_currency_rate"><?= $Page->currency_rate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->document_id->Visible) { // document_id ?>
        <th class="<?= $Page->document_id->headerCellClass() ?>"><span id="elh_transaction_document_id" class="transaction_document_id"><?= $Page->document_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contact_id->Visible) { // contact_id ?>
        <th class="<?= $Page->contact_id->headerCellClass() ?>"><span id="elh_transaction_contact_id" class="transaction_contact_id"><?= $Page->contact_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->acc_category_id->Visible) { // acc_category_id ?>
        <th class="<?= $Page->acc_category_id->headerCellClass() ?>"><span id="elh_transaction_acc_category_id" class="transaction_acc_category_id"><?= $Page->acc_category_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->payment_method->Visible) { // payment_method ?>
        <th class="<?= $Page->payment_method->headerCellClass() ?>"><span id="elh_transaction_payment_method" class="transaction_payment_method"><?= $Page->payment_method->caption() ?></span></th>
<?php } ?>
<?php if ($Page->reference->Visible) { // reference ?>
        <th class="<?= $Page->reference->headerCellClass() ?>"><span id="elh_transaction_reference" class="transaction_reference"><?= $Page->reference->caption() ?></span></th>
<?php } ?>
<?php if ($Page->parent_id->Visible) { // parent_id ?>
        <th class="<?= $Page->parent_id->headerCellClass() ?>"><span id="elh_transaction_parent_id" class="transaction_parent_id"><?= $Page->parent_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->reconciled->Visible) { // reconciled ?>
        <th class="<?= $Page->reconciled->headerCellClass() ?>"><span id="elh_transaction_reconciled" class="transaction_reconciled"><?= $Page->reconciled->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
        <th class="<?= $Page->created_from->headerCellClass() ?>"><span id="elh_transaction_created_from" class="transaction_created_from"><?= $Page->created_from->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_transaction_created_by" class="transaction_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_transaction_created_at" class="transaction_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_transaction_updated_at" class="transaction_updated_at"><?= $Page->updated_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deleted_at->Visible) { // deleted_at ?>
        <th class="<?= $Page->deleted_at->headerCellClass() ?>"><span id="elh_transaction_deleted_at" class="transaction_deleted_at"><?= $Page->deleted_at->caption() ?></span></th>
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
<?php if ($Page->acc_id->Visible) { // acc_id ?>
        <td<?= $Page->acc_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->acc_id->viewAttributes() ?>>
<?= $Page->acc_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->paid_at->Visible) { // paid_at ?>
        <td<?= $Page->paid_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->paid_at->viewAttributes() ?>>
<?= $Page->paid_at->getViewValue() ?></span>
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
<?php if ($Page->type_id->Visible) { // type_id ?>
        <td<?= $Page->type_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->type_id->viewAttributes() ?>>
<?= $Page->type_id->getViewValue() ?></span>
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
<?php if ($Page->document_id->Visible) { // document_id ?>
        <td<?= $Page->document_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->document_id->viewAttributes() ?>>
<?= $Page->document_id->getViewValue() ?></span>
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
<?php if ($Page->acc_category_id->Visible) { // acc_category_id ?>
        <td<?= $Page->acc_category_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->acc_category_id->viewAttributes() ?>>
<?= $Page->acc_category_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->payment_method->Visible) { // payment_method ?>
        <td<?= $Page->payment_method->cellAttributes() ?>>
<span id="">
<span<?= $Page->payment_method->viewAttributes() ?>>
<?= $Page->payment_method->getViewValue() ?></span>
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
<?php if ($Page->parent_id->Visible) { // parent_id ?>
        <td<?= $Page->parent_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->parent_id->viewAttributes() ?>>
<?= $Page->parent_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->reconciled->Visible) { // reconciled ?>
        <td<?= $Page->reconciled->cellAttributes() ?>>
<span id="">
<span<?= $Page->reconciled->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_reconciled_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->reconciled->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->reconciled->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_reconciled_<?= $Page->RowCount ?>"></label>
</div></span>
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
