<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$TaxesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { taxes: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var ftaxesadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ftaxesadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["company_id", [fields.company_id.visible && fields.company_id.required ? ew.Validators.required(fields.company_id.caption) : null, ew.Validators.integer], fields.company_id.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["rate", [fields.rate.visible && fields.rate.required ? ew.Validators.required(fields.rate.caption) : null, ew.Validators.float], fields.rate.isInvalid],
            ["type", [fields.type.visible && fields.type.required ? ew.Validators.required(fields.type.caption) : null], fields.type.isInvalid],
            ["enabled", [fields.enabled.visible && fields.enabled.required ? ew.Validators.required(fields.enabled.caption) : null], fields.enabled.isInvalid],
            ["created_from", [fields.created_from.visible && fields.created_from.required ? ew.Validators.required(fields.created_from.caption) : null], fields.created_from.isInvalid],
            ["created_by", [fields.created_by.visible && fields.created_by.required ? ew.Validators.required(fields.created_by.caption) : null, ew.Validators.integer], fields.created_by.isInvalid],
            ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null], fields.created_at.isInvalid],
            ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null], fields.updated_at.isInvalid],
            ["deleted_at", [fields.deleted_at.visible && fields.deleted_at.required ? ew.Validators.required(fields.deleted_at.caption) : null], fields.deleted_at.isInvalid]
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
            "enabled": <?= $Page->enabled->toClientList($Page) ?>,
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
<form name="ftaxesadd" id="ftaxesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="taxes">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->company_id->Visible) { // company_id ?>
    <div id="r_company_id"<?= $Page->company_id->rowAttributes() ?>>
        <label id="elh_taxes_company_id" for="x_company_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->company_id->caption() ?><?= $Page->company_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->company_id->cellAttributes() ?>>
<span id="el_taxes_company_id">
<input type="<?= $Page->company_id->getInputTextType() ?>" name="x_company_id" id="x_company_id" data-table="taxes" data-field="x_company_id" value="<?= $Page->company_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->company_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->company_id->formatPattern()) ?>"<?= $Page->company_id->editAttributes() ?> aria-describedby="x_company_id_help">
<?= $Page->company_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->company_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_taxes_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_taxes_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="taxes" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="191" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rate->Visible) { // rate ?>
    <div id="r_rate"<?= $Page->rate->rowAttributes() ?>>
        <label id="elh_taxes_rate" for="x_rate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rate->caption() ?><?= $Page->rate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rate->cellAttributes() ?>>
<span id="el_taxes_rate">
<input type="<?= $Page->rate->getInputTextType() ?>" name="x_rate" id="x_rate" data-table="taxes" data-field="x_rate" value="<?= $Page->rate->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->rate->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->rate->formatPattern()) ?>"<?= $Page->rate->editAttributes() ?> aria-describedby="x_rate_help">
<?= $Page->rate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rate->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <div id="r_type"<?= $Page->type->rowAttributes() ?>>
        <label id="elh_taxes_type" for="x_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->type->caption() ?><?= $Page->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->type->cellAttributes() ?>>
<span id="el_taxes_type">
<input type="<?= $Page->type->getInputTextType() ?>" name="x_type" id="x_type" data-table="taxes" data-field="x_type" value="<?= $Page->type->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->type->formatPattern()) ?>"<?= $Page->type->editAttributes() ?> aria-describedby="x_type_help">
<?= $Page->type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->enabled->Visible) { // enabled ?>
    <div id="r_enabled"<?= $Page->enabled->rowAttributes() ?>>
        <label id="elh_taxes_enabled" class="<?= $Page->LeftColumnClass ?>"><?= $Page->enabled->caption() ?><?= $Page->enabled->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->enabled->cellAttributes() ?>>
<span id="el_taxes_enabled">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->enabled->isInvalidClass() ?>" data-table="taxes" data-field="x_enabled" data-boolean name="x_enabled" id="x_enabled" value="1"<?= ConvertToBool($Page->enabled->CurrentValue) ? " checked" : "" ?><?= $Page->enabled->editAttributes() ?> aria-describedby="x_enabled_help">
    <div class="invalid-feedback"><?= $Page->enabled->getErrorMessage() ?></div>
</div>
<?= $Page->enabled->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
    <div id="r_created_from"<?= $Page->created_from->rowAttributes() ?>>
        <label id="elh_taxes_created_from" for="x_created_from" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_from->caption() ?><?= $Page->created_from->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_from->cellAttributes() ?>>
<span id="el_taxes_created_from">
<input type="<?= $Page->created_from->getInputTextType() ?>" name="x_created_from" id="x_created_from" data-table="taxes" data-field="x_created_from" value="<?= $Page->created_from->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->created_from->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_from->formatPattern()) ?>"<?= $Page->created_from->editAttributes() ?> aria-describedby="x_created_from_help">
<?= $Page->created_from->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_from->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <div id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <label id="elh_taxes_created_by" for="x_created_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by->caption() ?><?= $Page->created_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by->cellAttributes() ?>>
<span id="el_taxes_created_by">
<input type="<?= $Page->created_by->getInputTextType() ?>" name="x_created_by" id="x_created_by" data-table="taxes" data-field="x_created_by" value="<?= $Page->created_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by->formatPattern()) ?>"<?= $Page->created_by->editAttributes() ?> aria-describedby="x_created_by_help">
<?= $Page->created_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="ftaxesadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="ftaxesadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("taxes");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
