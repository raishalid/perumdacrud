<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$DepartementsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { departements: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fdepartementsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdepartementsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["division_id", [fields.division_id.visible && fields.division_id.required ? ew.Validators.required(fields.division_id.caption) : null, ew.Validators.integer], fields.division_id.isInvalid],
            ["departement_name", [fields.departement_name.visible && fields.departement_name.required ? ew.Validators.required(fields.departement_name.caption) : null], fields.departement_name.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid]
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
<form name="fdepartementsadd" id="fdepartementsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="departements">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->division_id->Visible) { // division_id ?>
    <div id="r_division_id"<?= $Page->division_id->rowAttributes() ?>>
        <label id="elh_departements_division_id" for="x_division_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->division_id->caption() ?><?= $Page->division_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->division_id->cellAttributes() ?>>
<span id="el_departements_division_id">
<input type="<?= $Page->division_id->getInputTextType() ?>" name="x_division_id" id="x_division_id" data-table="departements" data-field="x_division_id" value="<?= $Page->division_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->division_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->division_id->formatPattern()) ?>"<?= $Page->division_id->editAttributes() ?> aria-describedby="x_division_id_help">
<?= $Page->division_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->division_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->departement_name->Visible) { // departement_name ?>
    <div id="r_departement_name"<?= $Page->departement_name->rowAttributes() ?>>
        <label id="elh_departements_departement_name" for="x_departement_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->departement_name->caption() ?><?= $Page->departement_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->departement_name->cellAttributes() ?>>
<span id="el_departements_departement_name">
<input type="<?= $Page->departement_name->getInputTextType() ?>" name="x_departement_name" id="x_departement_name" data-table="departements" data-field="x_departement_name" value="<?= $Page->departement_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->departement_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->departement_name->formatPattern()) ?>"<?= $Page->departement_name->editAttributes() ?> aria-describedby="x_departement_name_help">
<?= $Page->departement_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->departement_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_departements_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_departements_description">
<textarea data-table="departements" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fdepartementsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fdepartementsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("departements");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
