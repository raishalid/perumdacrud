<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$RoleHasPermissionsView = &$Page;
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
<form name="frole_has_permissionsview" id="frole_has_permissionsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { role_has_permissions: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var frole_has_permissionsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("frole_has_permissionsview")
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
<input type="hidden" name="t" value="role_has_permissions">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->permission_id->Visible) { // permission_id ?>
    <tr id="r_permission_id"<?= $Page->permission_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_role_has_permissions_permission_id"><?= $Page->permission_id->caption() ?></span></td>
        <td data-name="permission_id"<?= $Page->permission_id->cellAttributes() ?>>
<span id="el_role_has_permissions_permission_id">
<span<?= $Page->permission_id->viewAttributes() ?>>
<?= $Page->permission_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->role_id->Visible) { // role_id ?>
    <tr id="r_role_id"<?= $Page->role_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_role_has_permissions_role_id"><?= $Page->role_id->caption() ?></span></td>
        <td data-name="role_id"<?= $Page->role_id->cellAttributes() ?>>
<span id="el_role_has_permissions_role_id">
<span<?= $Page->role_id->viewAttributes() ?>>
<?= $Page->role_id->getViewValue() ?></span>
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
