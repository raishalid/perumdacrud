<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ModelHasRolesDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { model_has_roles: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fmodel_has_rolesdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmodel_has_rolesdelete")
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
<form name="fmodel_has_rolesdelete" id="fmodel_has_rolesdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="model_has_roles">
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
<?php if ($Page->role_id->Visible) { // role_id ?>
        <th class="<?= $Page->role_id->headerCellClass() ?>"><span id="elh_model_has_roles_role_id" class="model_has_roles_role_id"><?= $Page->role_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->model_type->Visible) { // model_type ?>
        <th class="<?= $Page->model_type->headerCellClass() ?>"><span id="elh_model_has_roles_model_type" class="model_has_roles_model_type"><?= $Page->model_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->model_id->Visible) { // model_id ?>
        <th class="<?= $Page->model_id->headerCellClass() ?>"><span id="elh_model_has_roles_model_id" class="model_has_roles_model_id"><?= $Page->model_id->caption() ?></span></th>
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
<?php if ($Page->role_id->Visible) { // role_id ?>
        <td<?= $Page->role_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->role_id->viewAttributes() ?>>
<?= $Page->role_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->model_type->Visible) { // model_type ?>
        <td<?= $Page->model_type->cellAttributes() ?>>
<span id="">
<span<?= $Page->model_type->viewAttributes() ?>>
<?= $Page->model_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->model_id->Visible) { // model_id ?>
        <td<?= $Page->model_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->model_id->viewAttributes() ?>>
<?= $Page->model_id->getViewValue() ?></span>
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
