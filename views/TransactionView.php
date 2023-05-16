<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$TransactionView = &$Page;
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
<form name="ftransactionview" id="ftransactionview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transaction: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var ftransactionview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ftransactionview")
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
<input type="hidden" name="t" value="transaction">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_transaction_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->acc_id->Visible) { // acc_id ?>
    <tr id="r_acc_id"<?= $Page->acc_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_acc_id"><?= $Page->acc_id->caption() ?></span></td>
        <td data-name="acc_id"<?= $Page->acc_id->cellAttributes() ?>>
<span id="el_transaction_acc_id">
<span<?= $Page->acc_id->viewAttributes() ?>>
<?= $Page->acc_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->paid_at->Visible) { // paid_at ?>
    <tr id="r_paid_at"<?= $Page->paid_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_paid_at"><?= $Page->paid_at->caption() ?></span></td>
        <td data-name="paid_at"<?= $Page->paid_at->cellAttributes() ?>>
<span id="el_transaction_paid_at">
<span<?= $Page->paid_at->viewAttributes() ?>>
<?= $Page->paid_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->departement_id->Visible) { // departement_id ?>
    <tr id="r_departement_id"<?= $Page->departement_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_departement_id"><?= $Page->departement_id->caption() ?></span></td>
        <td data-name="departement_id"<?= $Page->departement_id->cellAttributes() ?>>
<span id="el_transaction_departement_id">
<span<?= $Page->departement_id->viewAttributes() ?>>
<?= $Page->departement_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->type_id->Visible) { // type_id ?>
    <tr id="r_type_id"<?= $Page->type_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_type_id"><?= $Page->type_id->caption() ?></span></td>
        <td data-name="type_id"<?= $Page->type_id->cellAttributes() ?>>
<span id="el_transaction_type_id">
<span<?= $Page->type_id->viewAttributes() ?>>
<?= $Page->type_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
    <tr id="r_amount"<?= $Page->amount->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_amount"><?= $Page->amount->caption() ?></span></td>
        <td data-name="amount"<?= $Page->amount->cellAttributes() ?>>
<span id="el_transaction_amount">
<span<?= $Page->amount->viewAttributes() ?>>
<?= $Page->amount->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->currency_code->Visible) { // currency_code ?>
    <tr id="r_currency_code"<?= $Page->currency_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_currency_code"><?= $Page->currency_code->caption() ?></span></td>
        <td data-name="currency_code"<?= $Page->currency_code->cellAttributes() ?>>
<span id="el_transaction_currency_code">
<span<?= $Page->currency_code->viewAttributes() ?>>
<?= $Page->currency_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->currency_rate->Visible) { // currency_rate ?>
    <tr id="r_currency_rate"<?= $Page->currency_rate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_currency_rate"><?= $Page->currency_rate->caption() ?></span></td>
        <td data-name="currency_rate"<?= $Page->currency_rate->cellAttributes() ?>>
<span id="el_transaction_currency_rate">
<span<?= $Page->currency_rate->viewAttributes() ?>>
<?= $Page->currency_rate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->document_id->Visible) { // document_id ?>
    <tr id="r_document_id"<?= $Page->document_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_document_id"><?= $Page->document_id->caption() ?></span></td>
        <td data-name="document_id"<?= $Page->document_id->cellAttributes() ?>>
<span id="el_transaction_document_id">
<span<?= $Page->document_id->viewAttributes() ?>>
<?= $Page->document_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->contact_id->Visible) { // contact_id ?>
    <tr id="r_contact_id"<?= $Page->contact_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_contact_id"><?= $Page->contact_id->caption() ?></span></td>
        <td data-name="contact_id"<?= $Page->contact_id->cellAttributes() ?>>
<span id="el_transaction_contact_id">
<span<?= $Page->contact_id->viewAttributes() ?>>
<?= $Page->contact_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <tr id="r_description"<?= $Page->description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_description"><?= $Page->description->caption() ?></span></td>
        <td data-name="description"<?= $Page->description->cellAttributes() ?>>
<span id="el_transaction_description">
<span<?= $Page->description->viewAttributes() ?>>
<?= $Page->description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->acc_category_id->Visible) { // acc_category_id ?>
    <tr id="r_acc_category_id"<?= $Page->acc_category_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_acc_category_id"><?= $Page->acc_category_id->caption() ?></span></td>
        <td data-name="acc_category_id"<?= $Page->acc_category_id->cellAttributes() ?>>
<span id="el_transaction_acc_category_id">
<span<?= $Page->acc_category_id->viewAttributes() ?>>
<?= $Page->acc_category_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->payment_method->Visible) { // payment_method ?>
    <tr id="r_payment_method"<?= $Page->payment_method->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_payment_method"><?= $Page->payment_method->caption() ?></span></td>
        <td data-name="payment_method"<?= $Page->payment_method->cellAttributes() ?>>
<span id="el_transaction_payment_method">
<span<?= $Page->payment_method->viewAttributes() ?>>
<?= $Page->payment_method->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->reference->Visible) { // reference ?>
    <tr id="r_reference"<?= $Page->reference->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_reference"><?= $Page->reference->caption() ?></span></td>
        <td data-name="reference"<?= $Page->reference->cellAttributes() ?>>
<span id="el_transaction_reference">
<span<?= $Page->reference->viewAttributes() ?>>
<?= $Page->reference->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->parent_id->Visible) { // parent_id ?>
    <tr id="r_parent_id"<?= $Page->parent_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_parent_id"><?= $Page->parent_id->caption() ?></span></td>
        <td data-name="parent_id"<?= $Page->parent_id->cellAttributes() ?>>
<span id="el_transaction_parent_id">
<span<?= $Page->parent_id->viewAttributes() ?>>
<?= $Page->parent_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->reconciled->Visible) { // reconciled ?>
    <tr id="r_reconciled"<?= $Page->reconciled->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_reconciled"><?= $Page->reconciled->caption() ?></span></td>
        <td data-name="reconciled"<?= $Page->reconciled->cellAttributes() ?>>
<span id="el_transaction_reconciled">
<span<?= $Page->reconciled->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_reconciled_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->reconciled->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->reconciled->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_reconciled_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
    <tr id="r_created_from"<?= $Page->created_from->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_created_from"><?= $Page->created_from->caption() ?></span></td>
        <td data-name="created_from"<?= $Page->created_from->cellAttributes() ?>>
<span id="el_transaction_created_from">
<span<?= $Page->created_from->viewAttributes() ?>>
<?= $Page->created_from->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <tr id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_created_by"><?= $Page->created_by->caption() ?></span></td>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el_transaction_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_transaction_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_transaction_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deleted_at->Visible) { // deleted_at ?>
    <tr id="r_deleted_at"<?= $Page->deleted_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_transaction_deleted_at"><?= $Page->deleted_at->caption() ?></span></td>
        <td data-name="deleted_at"<?= $Page->deleted_at->cellAttributes() ?>>
<span id="el_transaction_deleted_at">
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
