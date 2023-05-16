<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ModelHasPermissionsView = &$Page;
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
<form name="fmodel_has_permissionsview" id="fmodel_has_permissionsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { model_has_permissions: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fmodel_has_permissionsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmodel_has_permissionsview")
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
<input type="hidden" name="t" value="model_has_permissions">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->permission_id->Visible) { // permission_id ?>
    <tr id="r_permission_id"<?= $Page->permission_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_model_has_permissions_permission_id"><?= $Page->permission_id->caption() ?></span></td>
        <td data-name="permission_id"<?= $Page->permission_id->cellAttributes() ?>>
<span id="el_model_has_permissions_permission_id">
<span<?= $Page->permission_id->viewAttributes() ?>>
<?= $Page->permission_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->model_type->Visible) { // model_type ?>
    <tr id="r_model_type"<?= $Page->model_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_model_has_permissions_model_type"><?= $Page->model_type->caption() ?></span></td>
        <td data-name="model_type"<?= $Page->model_type->cellAttributes() ?>>
<span id="el_model_has_permissions_model_type">
<span<?= $Page->model_type->viewAttributes() ?>>
<?= $Page->model_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->model_id->Visible) { // model_id ?>
    <tr id="r_model_id"<?= $Page->model_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_model_has_permissions_model_id"><?= $Page->model_id->caption() ?></span></td>
        <td data-name="model_id"<?= $Page->model_id->cellAttributes() ?>>
<span id="el_model_has_permissions_model_id">
<span<?= $Page->model_id->viewAttributes() ?>>
<?= $Page->model_id->getViewValue() ?></span>
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
