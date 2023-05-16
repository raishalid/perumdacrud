<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ItemsEdit = &$Page;
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
<form name="fitemsedit" id="fitemsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { items: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fitemsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fitemsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["company_id", [fields.company_id.visible && fields.company_id.required ? ew.Validators.required(fields.company_id.caption) : null, ew.Validators.integer], fields.company_id.isInvalid],
            ["departement_id", [fields.departement_id.visible && fields.departement_id.required ? ew.Validators.required(fields.departement_id.caption) : null, ew.Validators.integer], fields.departement_id.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["sale_price", [fields.sale_price.visible && fields.sale_price.required ? ew.Validators.required(fields.sale_price.caption) : null, ew.Validators.float], fields.sale_price.isInvalid],
            ["purchase_price", [fields.purchase_price.visible && fields.purchase_price.required ? ew.Validators.required(fields.purchase_price.caption) : null, ew.Validators.float], fields.purchase_price.isInvalid],
            ["tax_id", [fields.tax_id.visible && fields.tax_id.required ? ew.Validators.required(fields.tax_id.caption) : null, ew.Validators.integer], fields.tax_id.isInvalid],
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="items">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_items_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_items_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="items" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
    <div id="r_company_id"<?= $Page->company_id->rowAttributes() ?>>
        <label id="elh_items_company_id" for="x_company_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->company_id->caption() ?><?= $Page->company_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->company_id->cellAttributes() ?>>
<span id="el_items_company_id">
<input type="<?= $Page->company_id->getInputTextType() ?>" name="x_company_id" id="x_company_id" data-table="items" data-field="x_company_id" value="<?= $Page->company_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->company_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->company_id->formatPattern()) ?>"<?= $Page->company_id->editAttributes() ?> aria-describedby="x_company_id_help">
<?= $Page->company_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->company_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->departement_id->Visible) { // departement_id ?>
    <div id="r_departement_id"<?= $Page->departement_id->rowAttributes() ?>>
        <label id="elh_items_departement_id" for="x_departement_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->departement_id->caption() ?><?= $Page->departement_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->departement_id->cellAttributes() ?>>
<span id="el_items_departement_id">
<input type="<?= $Page->departement_id->getInputTextType() ?>" name="x_departement_id" id="x_departement_id" data-table="items" data-field="x_departement_id" value="<?= $Page->departement_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->departement_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->departement_id->formatPattern()) ?>"<?= $Page->departement_id->editAttributes() ?> aria-describedby="x_departement_id_help">
<?= $Page->departement_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->departement_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_items_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_items_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="items" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="191" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_items_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_items_description">
<textarea data-table="items" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sale_price->Visible) { // sale_price ?>
    <div id="r_sale_price"<?= $Page->sale_price->rowAttributes() ?>>
        <label id="elh_items_sale_price" for="x_sale_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sale_price->caption() ?><?= $Page->sale_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sale_price->cellAttributes() ?>>
<span id="el_items_sale_price">
<input type="<?= $Page->sale_price->getInputTextType() ?>" name="x_sale_price" id="x_sale_price" data-table="items" data-field="x_sale_price" value="<?= $Page->sale_price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->sale_price->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->sale_price->formatPattern()) ?>"<?= $Page->sale_price->editAttributes() ?> aria-describedby="x_sale_price_help">
<?= $Page->sale_price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sale_price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->purchase_price->Visible) { // purchase_price ?>
    <div id="r_purchase_price"<?= $Page->purchase_price->rowAttributes() ?>>
        <label id="elh_items_purchase_price" for="x_purchase_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->purchase_price->caption() ?><?= $Page->purchase_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->purchase_price->cellAttributes() ?>>
<span id="el_items_purchase_price">
<input type="<?= $Page->purchase_price->getInputTextType() ?>" name="x_purchase_price" id="x_purchase_price" data-table="items" data-field="x_purchase_price" value="<?= $Page->purchase_price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->purchase_price->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->purchase_price->formatPattern()) ?>"<?= $Page->purchase_price->editAttributes() ?> aria-describedby="x_purchase_price_help">
<?= $Page->purchase_price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->purchase_price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tax_id->Visible) { // tax_id ?>
    <div id="r_tax_id"<?= $Page->tax_id->rowAttributes() ?>>
        <label id="elh_items_tax_id" for="x_tax_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tax_id->caption() ?><?= $Page->tax_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tax_id->cellAttributes() ?>>
<span id="el_items_tax_id">
<input type="<?= $Page->tax_id->getInputTextType() ?>" name="x_tax_id" id="x_tax_id" data-table="items" data-field="x_tax_id" value="<?= $Page->tax_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tax_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tax_id->formatPattern()) ?>"<?= $Page->tax_id->editAttributes() ?> aria-describedby="x_tax_id_help">
<?= $Page->tax_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tax_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->enabled->Visible) { // enabled ?>
    <div id="r_enabled"<?= $Page->enabled->rowAttributes() ?>>
        <label id="elh_items_enabled" class="<?= $Page->LeftColumnClass ?>"><?= $Page->enabled->caption() ?><?= $Page->enabled->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->enabled->cellAttributes() ?>>
<span id="el_items_enabled">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->enabled->isInvalidClass() ?>" data-table="items" data-field="x_enabled" data-boolean name="x_enabled" id="x_enabled" value="1"<?= ConvertToBool($Page->enabled->CurrentValue) ? " checked" : "" ?><?= $Page->enabled->editAttributes() ?> aria-describedby="x_enabled_help">
    <div class="invalid-feedback"><?= $Page->enabled->getErrorMessage() ?></div>
</div>
<?= $Page->enabled->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
    <div id="r_created_from"<?= $Page->created_from->rowAttributes() ?>>
        <label id="elh_items_created_from" for="x_created_from" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_from->caption() ?><?= $Page->created_from->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_from->cellAttributes() ?>>
<span id="el_items_created_from">
<input type="<?= $Page->created_from->getInputTextType() ?>" name="x_created_from" id="x_created_from" data-table="items" data-field="x_created_from" value="<?= $Page->created_from->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->created_from->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_from->formatPattern()) ?>"<?= $Page->created_from->editAttributes() ?> aria-describedby="x_created_from_help">
<?= $Page->created_from->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_from->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <div id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <label id="elh_items_created_by" for="x_created_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by->caption() ?><?= $Page->created_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by->cellAttributes() ?>>
<span id="el_items_created_by">
<input type="<?= $Page->created_by->getInputTextType() ?>" name="x_created_by" id="x_created_by" data-table="items" data-field="x_created_by" value="<?= $Page->created_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by->formatPattern()) ?>"<?= $Page->created_by->editAttributes() ?> aria-describedby="x_created_by_help">
<?= $Page->created_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fitemsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fitemsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("items");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
