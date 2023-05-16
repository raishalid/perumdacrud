<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$RoleHasPermissionsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { role_has_permissions: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var frole_has_permissionsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("frole_has_permissionsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["permission_id", [fields.permission_id.visible && fields.permission_id.required ? ew.Validators.required(fields.permission_id.caption) : null, ew.Validators.integer], fields.permission_id.isInvalid],
            ["role_id", [fields.role_id.visible && fields.role_id.required ? ew.Validators.required(fields.role_id.caption) : null, ew.Validators.integer], fields.role_id.isInvalid]
        ])

        // Form_CustomValidate
        .setCustomValidate(
            function (fobj) { // DO NOT CHANGE THIS LINE! (except for adding "async" keyword)!
                    // Your custom validation code here, return false if invalid.
                    return true;
                }
        )

        // Use JavaScript validation or not
        .setValidateRequired(ew.CLIENT_VALIDATE)

        // Dynamic selection lists
        .setLists({
        })
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
<form name="frole_has_permissionsadd" id="frole_has_permissionsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="role_has_permissions">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->permission_id->Visible) { // permission_id ?>
    <div id="r_permission_id"<?= $Page->permission_id->rowAttributes() ?>>
        <label id="elh_role_has_permissions_permission_id" for="x_permission_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->permission_id->caption() ?><?= $Page->permission_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->permission_id->cellAttributes() ?>>
<span id="el_role_has_permissions_permission_id">
<input type="<?= $Page->permission_id->getInputTextType() ?>" name="x_permission_id" id="x_permission_id" data-table="role_has_permissions" data-field="x_permission_id" value="<?= $Page->permission_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->permission_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->permission_id->formatPattern()) ?>"<?= $Page->permission_id->editAttributes() ?> aria-describedby="x_permission_id_help">
<?= $Page->permission_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->permission_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->role_id->Visible) { // role_id ?>
    <div id="r_role_id"<?= $Page->role_id->rowAttributes() ?>>
        <label id="elh_role_has_permissions_role_id" for="x_role_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->role_id->caption() ?><?= $Page->role_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->role_id->cellAttributes() ?>>
<span id="el_role_has_permissions_role_id">
<input type="<?= $Page->role_id->getInputTextType() ?>" name="x_role_id" id="x_role_id" data-table="role_has_permissions" data-field="x_role_id" value="<?= $Page->role_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->role_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->role_id->formatPattern()) ?>"<?= $Page->role_id->editAttributes() ?> aria-describedby="x_role_id_help">
<?= $Page->role_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->role_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="frole_has_permissionsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="frole_has_permissionsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("role_has_permissions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
