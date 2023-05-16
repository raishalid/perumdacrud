<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$DocumentTotalsEdit = &$Page;
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
<form name="fdocument_totalsedit" id="fdocument_totalsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { document_totals: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fdocument_totalsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdocument_totalsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["type", [fields.type.visible && fields.type.required ? ew.Validators.required(fields.type.caption) : null], fields.type.isInvalid],
            ["document_id", [fields.document_id.visible && fields.document_id.required ? ew.Validators.required(fields.document_id.caption) : null, ew.Validators.integer], fields.document_id.isInvalid],
            ["departement_id", [fields.departement_id.visible && fields.departement_id.required ? ew.Validators.required(fields.departement_id.caption) : null, ew.Validators.integer], fields.departement_id.isInvalid],
            ["company_id", [fields.company_id.visible && fields.company_id.required ? ew.Validators.required(fields.company_id.caption) : null, ew.Validators.integer], fields.company_id.isInvalid],
            ["code", [fields.code.visible && fields.code.required ? ew.Validators.required(fields.code.caption) : null], fields.code.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["amount", [fields.amount.visible && fields.amount.required ? ew.Validators.required(fields.amount.caption) : null, ew.Validators.float], fields.amount.isInvalid],
            ["sort_order", [fields.sort_order.visible && fields.sort_order.required ? ew.Validators.required(fields.sort_order.caption) : null, ew.Validators.integer], fields.sort_order.isInvalid],
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="document_totals">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_document_totals_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_document_totals_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="document_totals" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <div id="r_type"<?= $Page->type->rowAttributes() ?>>
        <label id="elh_document_totals_type" for="x_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->type->caption() ?><?= $Page->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->type->cellAttributes() ?>>
<span id="el_document_totals_type">
<input type="<?= $Page->type->getInputTextType() ?>" name="x_type" id="x_type" data-table="document_totals" data-field="x_type" value="<?= $Page->type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->type->formatPattern()) ?>"<?= $Page->type->editAttributes() ?> aria-describedby="x_type_help">
<?= $Page->type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->document_id->Visible) { // document_id ?>
    <div id="r_document_id"<?= $Page->document_id->rowAttributes() ?>>
        <label id="elh_document_totals_document_id" for="x_document_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->document_id->caption() ?><?= $Page->document_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->document_id->cellAttributes() ?>>
<span id="el_document_totals_document_id">
<input type="<?= $Page->document_id->getInputTextType() ?>" name="x_document_id" id="x_document_id" data-table="document_totals" data-field="x_document_id" value="<?= $Page->document_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->document_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->document_id->formatPattern()) ?>"<?= $Page->document_id->editAttributes() ?> aria-describedby="x_document_id_help">
<?= $Page->document_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->document_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->departement_id->Visible) { // departement_id ?>
    <div id="r_departement_id"<?= $Page->departement_id->rowAttributes() ?>>
        <label id="elh_document_totals_departement_id" for="x_departement_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->departement_id->caption() ?><?= $Page->departement_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->departement_id->cellAttributes() ?>>
<span id="el_document_totals_departement_id">
<input type="<?= $Page->departement_id->getInputTextType() ?>" name="x_departement_id" id="x_departement_id" data-table="document_totals" data-field="x_departement_id" value="<?= $Page->departement_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->departement_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->departement_id->formatPattern()) ?>"<?= $Page->departement_id->editAttributes() ?> aria-describedby="x_departement_id_help">
<?= $Page->departement_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->departement_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
    <div id="r_company_id"<?= $Page->company_id->rowAttributes() ?>>
        <label id="elh_document_totals_company_id" for="x_company_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->company_id->caption() ?><?= $Page->company_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->company_id->cellAttributes() ?>>
<span id="el_document_totals_company_id">
<input type="<?= $Page->company_id->getInputTextType() ?>" name="x_company_id" id="x_company_id" data-table="document_totals" data-field="x_company_id" value="<?= $Page->company_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->company_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->company_id->formatPattern()) ?>"<?= $Page->company_id->editAttributes() ?> aria-describedby="x_company_id_help">
<?= $Page->company_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->company_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->code->Visible) { // code ?>
    <div id="r_code"<?= $Page->code->rowAttributes() ?>>
        <label id="elh_document_totals_code" for="x_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->code->caption() ?><?= $Page->code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->code->cellAttributes() ?>>
<span id="el_document_totals_code">
<input type="<?= $Page->code->getInputTextType() ?>" name="x_code" id="x_code" data-table="document_totals" data-field="x_code" value="<?= $Page->code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->code->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->code->formatPattern()) ?>"<?= $Page->code->editAttributes() ?> aria-describedby="x_code_help">
<?= $Page->code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_document_totals_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_document_totals_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="document_totals" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
    <div id="r_amount"<?= $Page->amount->rowAttributes() ?>>
        <label id="elh_document_totals_amount" for="x_amount" class="<?= $Page->LeftColumnClass ?>"><?= $Page->amount->caption() ?><?= $Page->amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->amount->cellAttributes() ?>>
<span id="el_document_totals_amount">
<input type="<?= $Page->amount->getInputTextType() ?>" name="x_amount" id="x_amount" data-table="document_totals" data-field="x_amount" value="<?= $Page->amount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->amount->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->amount->formatPattern()) ?>"<?= $Page->amount->editAttributes() ?> aria-describedby="x_amount_help">
<?= $Page->amount->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->amount->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sort_order->Visible) { // sort_order ?>
    <div id="r_sort_order"<?= $Page->sort_order->rowAttributes() ?>>
        <label id="elh_document_totals_sort_order" for="x_sort_order" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sort_order->caption() ?><?= $Page->sort_order->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sort_order->cellAttributes() ?>>
<span id="el_document_totals_sort_order">
<input type="<?= $Page->sort_order->getInputTextType() ?>" name="x_sort_order" id="x_sort_order" data-table="document_totals" data-field="x_sort_order" value="<?= $Page->sort_order->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->sort_order->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->sort_order->formatPattern()) ?>"<?= $Page->sort_order->editAttributes() ?> aria-describedby="x_sort_order_help">
<?= $Page->sort_order->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sort_order->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
    <div id="r_created_from"<?= $Page->created_from->rowAttributes() ?>>
        <label id="elh_document_totals_created_from" for="x_created_from" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_from->caption() ?><?= $Page->created_from->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_from->cellAttributes() ?>>
<span id="el_document_totals_created_from">
<input type="<?= $Page->created_from->getInputTextType() ?>" name="x_created_from" id="x_created_from" data-table="document_totals" data-field="x_created_from" value="<?= $Page->created_from->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->created_from->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_from->formatPattern()) ?>"<?= $Page->created_from->editAttributes() ?> aria-describedby="x_created_from_help">
<?= $Page->created_from->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_from->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <div id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <label id="elh_document_totals_created_by" for="x_created_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by->caption() ?><?= $Page->created_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by->cellAttributes() ?>>
<span id="el_document_totals_created_by">
<input type="<?= $Page->created_by->getInputTextType() ?>" name="x_created_by" id="x_created_by" data-table="document_totals" data-field="x_created_by" value="<?= $Page->created_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by->formatPattern()) ?>"<?= $Page->created_by->editAttributes() ?> aria-describedby="x_created_by_help">
<?= $Page->created_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fdocument_totalsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fdocument_totalsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("document_totals");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
