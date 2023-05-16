<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$DocumentItemsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { document_items: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fdocument_itemsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdocument_itemsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["type", [fields.type.visible && fields.type.required ? ew.Validators.required(fields.type.caption) : null], fields.type.isInvalid],
            ["document_id", [fields.document_id.visible && fields.document_id.required ? ew.Validators.required(fields.document_id.caption) : null, ew.Validators.integer], fields.document_id.isInvalid],
            ["departemen_id", [fields.departemen_id.visible && fields.departemen_id.required ? ew.Validators.required(fields.departemen_id.caption) : null, ew.Validators.integer], fields.departemen_id.isInvalid],
            ["company_id", [fields.company_id.visible && fields.company_id.required ? ew.Validators.required(fields.company_id.caption) : null, ew.Validators.integer], fields.company_id.isInvalid],
            ["item_id", [fields.item_id.visible && fields.item_id.required ? ew.Validators.required(fields.item_id.caption) : null, ew.Validators.integer], fields.item_id.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["sku", [fields.sku.visible && fields.sku.required ? ew.Validators.required(fields.sku.caption) : null], fields.sku.isInvalid],
            ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.float], fields.quantity.isInvalid],
            ["price", [fields.price.visible && fields.price.required ? ew.Validators.required(fields.price.caption) : null, ew.Validators.float], fields.price.isInvalid],
            ["tax", [fields.tax.visible && fields.tax.required ? ew.Validators.required(fields.tax.caption) : null, ew.Validators.float], fields.tax.isInvalid],
            ["discount_type", [fields.discount_type.visible && fields.discount_type.required ? ew.Validators.required(fields.discount_type.caption) : null], fields.discount_type.isInvalid],
            ["discount_rate", [fields.discount_rate.visible && fields.discount_rate.required ? ew.Validators.required(fields.discount_rate.caption) : null, ew.Validators.float], fields.discount_rate.isInvalid],
            ["total", [fields.total.visible && fields.total.required ? ew.Validators.required(fields.total.caption) : null, ew.Validators.float], fields.total.isInvalid],
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
<form name="fdocument_itemsadd" id="fdocument_itemsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="document_items">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->type->Visible) { // type ?>
    <div id="r_type"<?= $Page->type->rowAttributes() ?>>
        <label id="elh_document_items_type" for="x_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->type->caption() ?><?= $Page->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->type->cellAttributes() ?>>
<span id="el_document_items_type">
<input type="<?= $Page->type->getInputTextType() ?>" name="x_type" id="x_type" data-table="document_items" data-field="x_type" value="<?= $Page->type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->type->formatPattern()) ?>"<?= $Page->type->editAttributes() ?> aria-describedby="x_type_help">
<?= $Page->type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->document_id->Visible) { // document_id ?>
    <div id="r_document_id"<?= $Page->document_id->rowAttributes() ?>>
        <label id="elh_document_items_document_id" for="x_document_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->document_id->caption() ?><?= $Page->document_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->document_id->cellAttributes() ?>>
<span id="el_document_items_document_id">
<input type="<?= $Page->document_id->getInputTextType() ?>" name="x_document_id" id="x_document_id" data-table="document_items" data-field="x_document_id" value="<?= $Page->document_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->document_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->document_id->formatPattern()) ?>"<?= $Page->document_id->editAttributes() ?> aria-describedby="x_document_id_help">
<?= $Page->document_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->document_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->departemen_id->Visible) { // departemen_id ?>
    <div id="r_departemen_id"<?= $Page->departemen_id->rowAttributes() ?>>
        <label id="elh_document_items_departemen_id" for="x_departemen_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->departemen_id->caption() ?><?= $Page->departemen_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->departemen_id->cellAttributes() ?>>
<span id="el_document_items_departemen_id">
<input type="<?= $Page->departemen_id->getInputTextType() ?>" name="x_departemen_id" id="x_departemen_id" data-table="document_items" data-field="x_departemen_id" value="<?= $Page->departemen_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->departemen_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->departemen_id->formatPattern()) ?>"<?= $Page->departemen_id->editAttributes() ?> aria-describedby="x_departemen_id_help">
<?= $Page->departemen_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->departemen_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
    <div id="r_company_id"<?= $Page->company_id->rowAttributes() ?>>
        <label id="elh_document_items_company_id" for="x_company_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->company_id->caption() ?><?= $Page->company_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->company_id->cellAttributes() ?>>
<span id="el_document_items_company_id">
<input type="<?= $Page->company_id->getInputTextType() ?>" name="x_company_id" id="x_company_id" data-table="document_items" data-field="x_company_id" value="<?= $Page->company_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->company_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->company_id->formatPattern()) ?>"<?= $Page->company_id->editAttributes() ?> aria-describedby="x_company_id_help">
<?= $Page->company_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->company_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->item_id->Visible) { // item_id ?>
    <div id="r_item_id"<?= $Page->item_id->rowAttributes() ?>>
        <label id="elh_document_items_item_id" for="x_item_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->item_id->caption() ?><?= $Page->item_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->item_id->cellAttributes() ?>>
<span id="el_document_items_item_id">
<input type="<?= $Page->item_id->getInputTextType() ?>" name="x_item_id" id="x_item_id" data-table="document_items" data-field="x_item_id" value="<?= $Page->item_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->item_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->item_id->formatPattern()) ?>"<?= $Page->item_id->editAttributes() ?> aria-describedby="x_item_id_help">
<?= $Page->item_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->item_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_document_items_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_document_items_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="document_items" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_document_items_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_document_items_description">
<textarea data-table="document_items" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sku->Visible) { // sku ?>
    <div id="r_sku"<?= $Page->sku->rowAttributes() ?>>
        <label id="elh_document_items_sku" for="x_sku" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sku->caption() ?><?= $Page->sku->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sku->cellAttributes() ?>>
<span id="el_document_items_sku">
<input type="<?= $Page->sku->getInputTextType() ?>" name="x_sku" id="x_sku" data-table="document_items" data-field="x_sku" value="<?= $Page->sku->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->sku->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->sku->formatPattern()) ?>"<?= $Page->sku->editAttributes() ?> aria-describedby="x_sku_help">
<?= $Page->sku->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sku->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <div id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <label id="elh_document_items_quantity" for="x_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quantity->caption() ?><?= $Page->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->quantity->cellAttributes() ?>>
<span id="el_document_items_quantity">
<input type="<?= $Page->quantity->getInputTextType() ?>" name="x_quantity" id="x_quantity" data-table="document_items" data-field="x_quantity" value="<?= $Page->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->quantity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->quantity->formatPattern()) ?>"<?= $Page->quantity->editAttributes() ?> aria-describedby="x_quantity_help">
<?= $Page->quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->price->Visible) { // price ?>
    <div id="r_price"<?= $Page->price->rowAttributes() ?>>
        <label id="elh_document_items_price" for="x_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->price->caption() ?><?= $Page->price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->price->cellAttributes() ?>>
<span id="el_document_items_price">
<input type="<?= $Page->price->getInputTextType() ?>" name="x_price" id="x_price" data-table="document_items" data-field="x_price" value="<?= $Page->price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->price->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->price->formatPattern()) ?>"<?= $Page->price->editAttributes() ?> aria-describedby="x_price_help">
<?= $Page->price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tax->Visible) { // tax ?>
    <div id="r_tax"<?= $Page->tax->rowAttributes() ?>>
        <label id="elh_document_items_tax" for="x_tax" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tax->caption() ?><?= $Page->tax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tax->cellAttributes() ?>>
<span id="el_document_items_tax">
<input type="<?= $Page->tax->getInputTextType() ?>" name="x_tax" id="x_tax" data-table="document_items" data-field="x_tax" value="<?= $Page->tax->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tax->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tax->formatPattern()) ?>"<?= $Page->tax->editAttributes() ?> aria-describedby="x_tax_help">
<?= $Page->tax->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tax->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->discount_type->Visible) { // discount_type ?>
    <div id="r_discount_type"<?= $Page->discount_type->rowAttributes() ?>>
        <label id="elh_document_items_discount_type" for="x_discount_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->discount_type->caption() ?><?= $Page->discount_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->discount_type->cellAttributes() ?>>
<span id="el_document_items_discount_type">
<input type="<?= $Page->discount_type->getInputTextType() ?>" name="x_discount_type" id="x_discount_type" data-table="document_items" data-field="x_discount_type" value="<?= $Page->discount_type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->discount_type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->discount_type->formatPattern()) ?>"<?= $Page->discount_type->editAttributes() ?> aria-describedby="x_discount_type_help">
<?= $Page->discount_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->discount_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->discount_rate->Visible) { // discount_rate ?>
    <div id="r_discount_rate"<?= $Page->discount_rate->rowAttributes() ?>>
        <label id="elh_document_items_discount_rate" for="x_discount_rate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->discount_rate->caption() ?><?= $Page->discount_rate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->discount_rate->cellAttributes() ?>>
<span id="el_document_items_discount_rate">
<input type="<?= $Page->discount_rate->getInputTextType() ?>" name="x_discount_rate" id="x_discount_rate" data-table="document_items" data-field="x_discount_rate" value="<?= $Page->discount_rate->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->discount_rate->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->discount_rate->formatPattern()) ?>"<?= $Page->discount_rate->editAttributes() ?> aria-describedby="x_discount_rate_help">
<?= $Page->discount_rate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->discount_rate->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
    <div id="r_total"<?= $Page->total->rowAttributes() ?>>
        <label id="elh_document_items_total" for="x_total" class="<?= $Page->LeftColumnClass ?>"><?= $Page->total->caption() ?><?= $Page->total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->total->cellAttributes() ?>>
<span id="el_document_items_total">
<input type="<?= $Page->total->getInputTextType() ?>" name="x_total" id="x_total" data-table="document_items" data-field="x_total" value="<?= $Page->total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->total->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->total->formatPattern()) ?>"<?= $Page->total->editAttributes() ?> aria-describedby="x_total_help">
<?= $Page->total->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
    <div id="r_created_from"<?= $Page->created_from->rowAttributes() ?>>
        <label id="elh_document_items_created_from" for="x_created_from" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_from->caption() ?><?= $Page->created_from->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_from->cellAttributes() ?>>
<span id="el_document_items_created_from">
<input type="<?= $Page->created_from->getInputTextType() ?>" name="x_created_from" id="x_created_from" data-table="document_items" data-field="x_created_from" value="<?= $Page->created_from->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->created_from->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_from->formatPattern()) ?>"<?= $Page->created_from->editAttributes() ?> aria-describedby="x_created_from_help">
<?= $Page->created_from->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_from->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <div id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <label id="elh_document_items_created_by" for="x_created_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by->caption() ?><?= $Page->created_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by->cellAttributes() ?>>
<span id="el_document_items_created_by">
<input type="<?= $Page->created_by->getInputTextType() ?>" name="x_created_by" id="x_created_by" data-table="document_items" data-field="x_created_by" value="<?= $Page->created_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by->formatPattern()) ?>"<?= $Page->created_by->editAttributes() ?> aria-describedby="x_created_by_help">
<?= $Page->created_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fdocument_itemsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fdocument_itemsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("document_items");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
