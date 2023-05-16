<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ModelHasRolesEdit = &$Page;
?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fmodel_has_rolesedit" id="fmodel_has_rolesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { model_has_roles: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fmodel_has_rolesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmodel_has_rolesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["role_id", [fields.role_id.visible && fields.role_id.required ? ew.Validators.required(fields.role_id.caption) : null, ew.Validators.integer], fields.role_id.isInvalid],
            ["model_type", [fields.model_type.visible && fields.model_type.required ? ew.Validators.required(fields.model_type.caption) : null], fields.model_type.isInvalid],
            ["model_id", [fields.model_id.visible && fields.model_id.required ? ew.Validators.required(fields.model_id.caption) : null, ew.Validators.integer], fields.model_id.isInvalid]
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="model_has_roles">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->role_id->Visible) { // role_id ?>
    <div id="r_role_id"<?= $Page->role_id->rowAttributes() ?>>
        <label id="elh_model_has_roles_role_id" for="x_role_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->role_id->caption() ?><?= $Page->role_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->role_id->cellAttributes() ?>>
<span id="el_model_has_roles_role_id">
<input type="<?= $Page->role_id->getInputTextType() ?>" name="x_role_id" id="x_role_id" data-table="model_has_roles" data-field="x_role_id" value="<?= $Page->role_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->role_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->role_id->formatPattern()) ?>"<?= $Page->role_id->editAttributes() ?> aria-describedby="x_role_id_help">
<?= $Page->role_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->role_id->getErrorMessage() ?></div>
<input type="hidden" data-table="model_has_roles" data-field="x_role_id" data-hidden="1" data-old name="o_role_id" id="o_role_id" value="<?= HtmlEncode($Page->role_id->OldValue ?? $Page->role_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->model_type->Visible) { // model_type ?>
    <div id="r_model_type"<?= $Page->model_type->rowAttributes() ?>>
        <label id="elh_model_has_roles_model_type" for="x_model_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->model_type->caption() ?><?= $Page->model_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->model_type->cellAttributes() ?>>
<span id="el_model_has_roles_model_type">
<input type="<?= $Page->model_type->getInputTextType() ?>" name="x_model_type" id="x_model_type" data-table="model_has_roles" data-field="x_model_type" value="<?= $Page->model_type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->model_type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->model_type->formatPattern()) ?>"<?= $Page->model_type->editAttributes() ?> aria-describedby="x_model_type_help">
<?= $Page->model_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->model_type->getErrorMessage() ?></div>
<input type="hidden" data-table="model_has_roles" data-field="x_model_type" data-hidden="1" data-old name="o_model_type" id="o_model_type" value="<?= HtmlEncode($Page->model_type->OldValue ?? $Page->model_type->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->model_id->Visible) { // model_id ?>
    <div id="r_model_id"<?= $Page->model_id->rowAttributes() ?>>
        <label id="elh_model_has_roles_model_id" for="x_model_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->model_id->caption() ?><?= $Page->model_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->model_id->cellAttributes() ?>>
<span id="el_model_has_roles_model_id">
<input type="<?= $Page->model_id->getInputTextType() ?>" name="x_model_id" id="x_model_id" data-table="model_has_roles" data-field="x_model_id" value="<?= $Page->model_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->model_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->model_id->formatPattern()) ?>"<?= $Page->model_id->editAttributes() ?> aria-describedby="x_model_id_help">
<?= $Page->model_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->model_id->getErrorMessage() ?></div>
<input type="hidden" data-table="model_has_roles" data-field="x_model_id" data-hidden="1" data-old name="o_model_id" id="o_model_id" value="<?= HtmlEncode($Page->model_id->OldValue ?? $Page->model_id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmodel_has_rolesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmodel_has_rolesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("model_has_roles");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
