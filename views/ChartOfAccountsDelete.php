<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ChartOfAccountsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { chart_of_accounts: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fchart_of_accountsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fchart_of_accountsdelete")
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
<form name="fchart_of_accountsdelete" id="fchart_of_accountsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="chart_of_accounts">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_chart_of_accounts_id" class="chart_of_accounts_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->account_code->Visible) { // account_code ?>
        <th class="<?= $Page->account_code->headerCellClass() ?>"><span id="elh_chart_of_accounts_account_code" class="chart_of_accounts_account_code"><?= $Page->account_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->account_name->Visible) { // account_name ?>
        <th class="<?= $Page->account_name->headerCellClass() ?>"><span id="elh_chart_of_accounts_account_name" class="chart_of_accounts_account_name"><?= $Page->account_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->parent_account_id->Visible) { // parent_account_id ?>
        <th class="<?= $Page->parent_account_id->headerCellClass() ?>"><span id="elh_chart_of_accounts_parent_account_id" class="chart_of_accounts_parent_account_id"><?= $Page->parent_account_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->normal_balance->Visible) { // normal_balance ?>
        <th class="<?= $Page->normal_balance->headerCellClass() ?>"><span id="elh_chart_of_accounts_normal_balance" class="chart_of_accounts_normal_balance"><?= $Page->normal_balance->caption() ?></span></th>
<?php } ?>
<?php if ($Page->type_account->Visible) { // type_account ?>
        <th class="<?= $Page->type_account->headerCellClass() ?>"><span id="elh_chart_of_accounts_type_account" class="chart_of_accounts_type_account"><?= $Page->type_account->caption() ?></span></th>
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
<?php if ($Page->account_code->Visible) { // account_code ?>
        <td<?= $Page->account_code->cellAttributes() ?>>
<span id="">
<span<?= $Page->account_code->viewAttributes() ?>>
<?= $Page->account_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->account_name->Visible) { // account_name ?>
        <td<?= $Page->account_name->cellAttributes() ?>>
<span id="">
<span<?= $Page->account_name->viewAttributes() ?>>
<?= $Page->account_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->parent_account_id->Visible) { // parent_account_id ?>
        <td<?= $Page->parent_account_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->parent_account_id->viewAttributes() ?>>
<?= $Page->parent_account_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->normal_balance->Visible) { // normal_balance ?>
        <td<?= $Page->normal_balance->cellAttributes() ?>>
<span id="">
<span<?= $Page->normal_balance->viewAttributes() ?>>
<?= $Page->normal_balance->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->type_account->Visible) { // type_account ?>
        <td<?= $Page->type_account->cellAttributes() ?>>
<span id="">
<span<?= $Page->type_account->viewAttributes() ?>>
<?= $Page->type_account->getViewValue() ?></span>
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
