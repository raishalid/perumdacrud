<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ChartOfAccountsView = &$Page;
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
<form name="fchart_of_accountsview" id="fchart_of_accountsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { chart_of_accounts: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fchart_of_accountsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fchart_of_accountsview")
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
<input type="hidden" name="t" value="chart_of_accounts">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_chart_of_accounts_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_chart_of_accounts_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->account_code->Visible) { // account_code ?>
    <tr id="r_account_code"<?= $Page->account_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_chart_of_accounts_account_code"><?= $Page->account_code->caption() ?></span></td>
        <td data-name="account_code"<?= $Page->account_code->cellAttributes() ?>>
<span id="el_chart_of_accounts_account_code">
<span<?= $Page->account_code->viewAttributes() ?>>
<?= $Page->account_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->account_name->Visible) { // account_name ?>
    <tr id="r_account_name"<?= $Page->account_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_chart_of_accounts_account_name"><?= $Page->account_name->caption() ?></span></td>
        <td data-name="account_name"<?= $Page->account_name->cellAttributes() ?>>
<span id="el_chart_of_accounts_account_name">
<span<?= $Page->account_name->viewAttributes() ?>>
<?= $Page->account_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->parent_account_id->Visible) { // parent_account_id ?>
    <tr id="r_parent_account_id"<?= $Page->parent_account_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_chart_of_accounts_parent_account_id"><?= $Page->parent_account_id->caption() ?></span></td>
        <td data-name="parent_account_id"<?= $Page->parent_account_id->cellAttributes() ?>>
<span id="el_chart_of_accounts_parent_account_id">
<span<?= $Page->parent_account_id->viewAttributes() ?>>
<?= $Page->parent_account_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->normal_balance->Visible) { // normal_balance ?>
    <tr id="r_normal_balance"<?= $Page->normal_balance->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_chart_of_accounts_normal_balance"><?= $Page->normal_balance->caption() ?></span></td>
        <td data-name="normal_balance"<?= $Page->normal_balance->cellAttributes() ?>>
<span id="el_chart_of_accounts_normal_balance">
<span<?= $Page->normal_balance->viewAttributes() ?>>
<?= $Page->normal_balance->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->type_account->Visible) { // type_account ?>
    <tr id="r_type_account"<?= $Page->type_account->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_chart_of_accounts_type_account"><?= $Page->type_account->caption() ?></span></td>
        <td data-name="type_account"<?= $Page->type_account->cellAttributes() ?>>
<span id="el_chart_of_accounts_type_account">
<span<?= $Page->type_account->viewAttributes() ?>>
<?= $Page->type_account->getViewValue() ?></span>
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
