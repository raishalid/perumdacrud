<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$MigrationsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { migrations: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fmigrationsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fmigrationsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["migration", [fields.migration.visible && fields.migration.required ? ew.Validators.required(fields.migration.caption) : null], fields.migration.isInvalid],
            ["batch", [fields.batch.visible && fields.batch.required ? ew.Validators.required(fields.batch.caption) : null, ew.Validators.integer], fields.batch.isInvalid]
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
<form name="fmigrationsadd" id="fmigrationsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="migrations">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->migration->Visible) { // migration ?>
    <div id="r_migration"<?= $Page->migration->rowAttributes() ?>>
        <label id="elh_migrations_migration" for="x_migration" class="<?= $Page->LeftColumnClass ?>"><?= $Page->migration->caption() ?><?= $Page->migration->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->migration->cellAttributes() ?>>
<span id="el_migrations_migration">
<input type="<?= $Page->migration->getInputTextType() ?>" name="x_migration" id="x_migration" data-table="migrations" data-field="x_migration" value="<?= $Page->migration->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->migration->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->migration->formatPattern()) ?>"<?= $Page->migration->editAttributes() ?> aria-describedby="x_migration_help">
<?= $Page->migration->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->migration->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->batch->Visible) { // batch ?>
    <div id="r_batch"<?= $Page->batch->rowAttributes() ?>>
        <label id="elh_migrations_batch" for="x_batch" class="<?= $Page->LeftColumnClass ?>"><?= $Page->batch->caption() ?><?= $Page->batch->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->batch->cellAttributes() ?>>
<span id="el_migrations_batch">
<input type="<?= $Page->batch->getInputTextType() ?>" name="x_batch" id="x_batch" data-table="migrations" data-field="x_batch" value="<?= $Page->batch->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->batch->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->batch->formatPattern()) ?>"<?= $Page->batch->editAttributes() ?> aria-describedby="x_batch_help">
<?= $Page->batch->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->batch->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fmigrationsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fmigrationsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("migrations");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
