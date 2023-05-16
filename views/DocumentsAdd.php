<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$DocumentsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { documents: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fdocumentsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdocumentsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["departement_id", [fields.departement_id.visible && fields.departement_id.required ? ew.Validators.required(fields.departement_id.caption) : null, ew.Validators.integer], fields.departement_id.isInvalid],
            ["company_id", [fields.company_id.visible && fields.company_id.required ? ew.Validators.required(fields.company_id.caption) : null, ew.Validators.integer], fields.company_id.isInvalid],
            ["type", [fields.type.visible && fields.type.required ? ew.Validators.required(fields.type.caption) : null], fields.type.isInvalid],
            ["document_number", [fields.document_number.visible && fields.document_number.required ? ew.Validators.required(fields.document_number.caption) : null], fields.document_number.isInvalid],
            ["order_number", [fields.order_number.visible && fields.order_number.required ? ew.Validators.required(fields.order_number.caption) : null], fields.order_number.isInvalid],
            ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
            ["issued_at", [fields.issued_at.visible && fields.issued_at.required ? ew.Validators.required(fields.issued_at.caption) : null, ew.Validators.datetime(fields.issued_at.clientFormatPattern)], fields.issued_at.isInvalid],
            ["due_at", [fields.due_at.visible && fields.due_at.required ? ew.Validators.required(fields.due_at.caption) : null, ew.Validators.datetime(fields.due_at.clientFormatPattern)], fields.due_at.isInvalid],
            ["amount", [fields.amount.visible && fields.amount.required ? ew.Validators.required(fields.amount.caption) : null, ew.Validators.float], fields.amount.isInvalid],
            ["currency_code", [fields.currency_code.visible && fields.currency_code.required ? ew.Validators.required(fields.currency_code.caption) : null], fields.currency_code.isInvalid],
            ["currency_rate", [fields.currency_rate.visible && fields.currency_rate.required ? ew.Validators.required(fields.currency_rate.caption) : null, ew.Validators.float], fields.currency_rate.isInvalid],
            ["category_id", [fields.category_id.visible && fields.category_id.required ? ew.Validators.required(fields.category_id.caption) : null, ew.Validators.integer], fields.category_id.isInvalid],
            ["contact_id", [fields.contact_id.visible && fields.contact_id.required ? ew.Validators.required(fields.contact_id.caption) : null, ew.Validators.integer], fields.contact_id.isInvalid],
            ["contact_name", [fields.contact_name.visible && fields.contact_name.required ? ew.Validators.required(fields.contact_name.caption) : null], fields.contact_name.isInvalid],
            ["contact_email", [fields.contact_email.visible && fields.contact_email.required ? ew.Validators.required(fields.contact_email.caption) : null], fields.contact_email.isInvalid],
            ["contact_tax_number", [fields.contact_tax_number.visible && fields.contact_tax_number.required ? ew.Validators.required(fields.contact_tax_number.caption) : null], fields.contact_tax_number.isInvalid],
            ["contact_phone", [fields.contact_phone.visible && fields.contact_phone.required ? ew.Validators.required(fields.contact_phone.caption) : null], fields.contact_phone.isInvalid],
            ["contact_address", [fields.contact_address.visible && fields.contact_address.required ? ew.Validators.required(fields.contact_address.caption) : null], fields.contact_address.isInvalid],
            ["contact_city", [fields.contact_city.visible && fields.contact_city.required ? ew.Validators.required(fields.contact_city.caption) : null], fields.contact_city.isInvalid],
            ["contact_zip_code", [fields.contact_zip_code.visible && fields.contact_zip_code.required ? ew.Validators.required(fields.contact_zip_code.caption) : null], fields.contact_zip_code.isInvalid],
            ["contact_state", [fields.contact_state.visible && fields.contact_state.required ? ew.Validators.required(fields.contact_state.caption) : null], fields.contact_state.isInvalid],
            ["contact_country", [fields.contact_country.visible && fields.contact_country.required ? ew.Validators.required(fields.contact_country.caption) : null], fields.contact_country.isInvalid],
            ["notes", [fields.notes.visible && fields.notes.required ? ew.Validators.required(fields.notes.caption) : null], fields.notes.isInvalid],
            ["footer", [fields.footer.visible && fields.footer.required ? ew.Validators.required(fields.footer.caption) : null], fields.footer.isInvalid],
            ["parent_id", [fields.parent_id.visible && fields.parent_id.required ? ew.Validators.required(fields.parent_id.caption) : null, ew.Validators.integer], fields.parent_id.isInvalid],
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
<form name="fdocumentsadd" id="fdocumentsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="documents">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->departement_id->Visible) { // departement_id ?>
    <div id="r_departement_id"<?= $Page->departement_id->rowAttributes() ?>>
        <label id="elh_documents_departement_id" for="x_departement_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->departement_id->caption() ?><?= $Page->departement_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->departement_id->cellAttributes() ?>>
<span id="el_documents_departement_id">
<input type="<?= $Page->departement_id->getInputTextType() ?>" name="x_departement_id" id="x_departement_id" data-table="documents" data-field="x_departement_id" value="<?= $Page->departement_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->departement_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->departement_id->formatPattern()) ?>"<?= $Page->departement_id->editAttributes() ?> aria-describedby="x_departement_id_help">
<?= $Page->departement_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->departement_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
    <div id="r_company_id"<?= $Page->company_id->rowAttributes() ?>>
        <label id="elh_documents_company_id" for="x_company_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->company_id->caption() ?><?= $Page->company_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->company_id->cellAttributes() ?>>
<span id="el_documents_company_id">
<input type="<?= $Page->company_id->getInputTextType() ?>" name="x_company_id" id="x_company_id" data-table="documents" data-field="x_company_id" value="<?= $Page->company_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->company_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->company_id->formatPattern()) ?>"<?= $Page->company_id->editAttributes() ?> aria-describedby="x_company_id_help">
<?= $Page->company_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->company_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <div id="r_type"<?= $Page->type->rowAttributes() ?>>
        <label id="elh_documents_type" for="x_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->type->caption() ?><?= $Page->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->type->cellAttributes() ?>>
<span id="el_documents_type">
<input type="<?= $Page->type->getInputTextType() ?>" name="x_type" id="x_type" data-table="documents" data-field="x_type" value="<?= $Page->type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->type->formatPattern()) ?>"<?= $Page->type->editAttributes() ?> aria-describedby="x_type_help">
<?= $Page->type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->document_number->Visible) { // document_number ?>
    <div id="r_document_number"<?= $Page->document_number->rowAttributes() ?>>
        <label id="elh_documents_document_number" for="x_document_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->document_number->caption() ?><?= $Page->document_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->document_number->cellAttributes() ?>>
<span id="el_documents_document_number">
<input type="<?= $Page->document_number->getInputTextType() ?>" name="x_document_number" id="x_document_number" data-table="documents" data-field="x_document_number" value="<?= $Page->document_number->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->document_number->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->document_number->formatPattern()) ?>"<?= $Page->document_number->editAttributes() ?> aria-describedby="x_document_number_help">
<?= $Page->document_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->document_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->order_number->Visible) { // order_number ?>
    <div id="r_order_number"<?= $Page->order_number->rowAttributes() ?>>
        <label id="elh_documents_order_number" for="x_order_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->order_number->caption() ?><?= $Page->order_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->order_number->cellAttributes() ?>>
<span id="el_documents_order_number">
<input type="<?= $Page->order_number->getInputTextType() ?>" name="x_order_number" id="x_order_number" data-table="documents" data-field="x_order_number" value="<?= $Page->order_number->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->order_number->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->order_number->formatPattern()) ?>"<?= $Page->order_number->editAttributes() ?> aria-describedby="x_order_number_help">
<?= $Page->order_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->order_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_documents_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_documents_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="documents" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->status->formatPattern()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->issued_at->Visible) { // issued_at ?>
    <div id="r_issued_at"<?= $Page->issued_at->rowAttributes() ?>>
        <label id="elh_documents_issued_at" for="x_issued_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->issued_at->caption() ?><?= $Page->issued_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->issued_at->cellAttributes() ?>>
<span id="el_documents_issued_at">
<input type="<?= $Page->issued_at->getInputTextType() ?>" name="x_issued_at" id="x_issued_at" data-table="documents" data-field="x_issued_at" value="<?= $Page->issued_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->issued_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->issued_at->formatPattern()) ?>"<?= $Page->issued_at->editAttributes() ?> aria-describedby="x_issued_at_help">
<?= $Page->issued_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->issued_at->getErrorMessage() ?></div>
<?php if (!$Page->issued_at->ReadOnly && !$Page->issued_at->Disabled && !isset($Page->issued_at->EditAttrs["readonly"]) && !isset($Page->issued_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdocumentsadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.isDark() ? "dark" : "auto"
            }
        };
    ew.createDateTimePicker("fdocumentsadd", "x_issued_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->due_at->Visible) { // due_at ?>
    <div id="r_due_at"<?= $Page->due_at->rowAttributes() ?>>
        <label id="elh_documents_due_at" for="x_due_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->due_at->caption() ?><?= $Page->due_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->due_at->cellAttributes() ?>>
<span id="el_documents_due_at">
<input type="<?= $Page->due_at->getInputTextType() ?>" name="x_due_at" id="x_due_at" data-table="documents" data-field="x_due_at" value="<?= $Page->due_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->due_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->due_at->formatPattern()) ?>"<?= $Page->due_at->editAttributes() ?> aria-describedby="x_due_at_help">
<?= $Page->due_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->due_at->getErrorMessage() ?></div>
<?php if (!$Page->due_at->ReadOnly && !$Page->due_at->Disabled && !isset($Page->due_at->EditAttrs["readonly"]) && !isset($Page->due_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdocumentsadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                hourCycle: format.match(/H/) ? "h24" : "h12",
                format,
                ...ew.language.phrase("datetimepicker")
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i)
                },
                theme: ew.isDark() ? "dark" : "auto"
            }
        };
    ew.createDateTimePicker("fdocumentsadd", "x_due_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
    <div id="r_amount"<?= $Page->amount->rowAttributes() ?>>
        <label id="elh_documents_amount" for="x_amount" class="<?= $Page->LeftColumnClass ?>"><?= $Page->amount->caption() ?><?= $Page->amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->amount->cellAttributes() ?>>
<span id="el_documents_amount">
<input type="<?= $Page->amount->getInputTextType() ?>" name="x_amount" id="x_amount" data-table="documents" data-field="x_amount" value="<?= $Page->amount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->amount->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->amount->formatPattern()) ?>"<?= $Page->amount->editAttributes() ?> aria-describedby="x_amount_help">
<?= $Page->amount->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->amount->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->currency_code->Visible) { // currency_code ?>
    <div id="r_currency_code"<?= $Page->currency_code->rowAttributes() ?>>
        <label id="elh_documents_currency_code" for="x_currency_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->currency_code->caption() ?><?= $Page->currency_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->currency_code->cellAttributes() ?>>
<span id="el_documents_currency_code">
<input type="<?= $Page->currency_code->getInputTextType() ?>" name="x_currency_code" id="x_currency_code" data-table="documents" data-field="x_currency_code" value="<?= $Page->currency_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->currency_code->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->currency_code->formatPattern()) ?>"<?= $Page->currency_code->editAttributes() ?> aria-describedby="x_currency_code_help">
<?= $Page->currency_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->currency_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->currency_rate->Visible) { // currency_rate ?>
    <div id="r_currency_rate"<?= $Page->currency_rate->rowAttributes() ?>>
        <label id="elh_documents_currency_rate" for="x_currency_rate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->currency_rate->caption() ?><?= $Page->currency_rate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->currency_rate->cellAttributes() ?>>
<span id="el_documents_currency_rate">
<input type="<?= $Page->currency_rate->getInputTextType() ?>" name="x_currency_rate" id="x_currency_rate" data-table="documents" data-field="x_currency_rate" value="<?= $Page->currency_rate->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->currency_rate->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->currency_rate->formatPattern()) ?>"<?= $Page->currency_rate->editAttributes() ?> aria-describedby="x_currency_rate_help">
<?= $Page->currency_rate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->currency_rate->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->category_id->Visible) { // category_id ?>
    <div id="r_category_id"<?= $Page->category_id->rowAttributes() ?>>
        <label id="elh_documents_category_id" for="x_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->category_id->caption() ?><?= $Page->category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->category_id->cellAttributes() ?>>
<span id="el_documents_category_id">
<input type="<?= $Page->category_id->getInputTextType() ?>" name="x_category_id" id="x_category_id" data-table="documents" data-field="x_category_id" value="<?= $Page->category_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->category_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->category_id->formatPattern()) ?>"<?= $Page->category_id->editAttributes() ?> aria-describedby="x_category_id_help">
<?= $Page->category_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->category_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_id->Visible) { // contact_id ?>
    <div id="r_contact_id"<?= $Page->contact_id->rowAttributes() ?>>
        <label id="elh_documents_contact_id" for="x_contact_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_id->caption() ?><?= $Page->contact_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contact_id->cellAttributes() ?>>
<span id="el_documents_contact_id">
<input type="<?= $Page->contact_id->getInputTextType() ?>" name="x_contact_id" id="x_contact_id" data-table="documents" data-field="x_contact_id" value="<?= $Page->contact_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->contact_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contact_id->formatPattern()) ?>"<?= $Page->contact_id->editAttributes() ?> aria-describedby="x_contact_id_help">
<?= $Page->contact_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_name->Visible) { // contact_name ?>
    <div id="r_contact_name"<?= $Page->contact_name->rowAttributes() ?>>
        <label id="elh_documents_contact_name" for="x_contact_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_name->caption() ?><?= $Page->contact_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contact_name->cellAttributes() ?>>
<span id="el_documents_contact_name">
<input type="<?= $Page->contact_name->getInputTextType() ?>" name="x_contact_name" id="x_contact_name" data-table="documents" data-field="x_contact_name" value="<?= $Page->contact_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->contact_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contact_name->formatPattern()) ?>"<?= $Page->contact_name->editAttributes() ?> aria-describedby="x_contact_name_help">
<?= $Page->contact_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_email->Visible) { // contact_email ?>
    <div id="r_contact_email"<?= $Page->contact_email->rowAttributes() ?>>
        <label id="elh_documents_contact_email" for="x_contact_email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_email->caption() ?><?= $Page->contact_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contact_email->cellAttributes() ?>>
<span id="el_documents_contact_email">
<input type="<?= $Page->contact_email->getInputTextType() ?>" name="x_contact_email" id="x_contact_email" data-table="documents" data-field="x_contact_email" value="<?= $Page->contact_email->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->contact_email->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contact_email->formatPattern()) ?>"<?= $Page->contact_email->editAttributes() ?> aria-describedby="x_contact_email_help">
<?= $Page->contact_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_tax_number->Visible) { // contact_tax_number ?>
    <div id="r_contact_tax_number"<?= $Page->contact_tax_number->rowAttributes() ?>>
        <label id="elh_documents_contact_tax_number" for="x_contact_tax_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_tax_number->caption() ?><?= $Page->contact_tax_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contact_tax_number->cellAttributes() ?>>
<span id="el_documents_contact_tax_number">
<input type="<?= $Page->contact_tax_number->getInputTextType() ?>" name="x_contact_tax_number" id="x_contact_tax_number" data-table="documents" data-field="x_contact_tax_number" value="<?= $Page->contact_tax_number->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->contact_tax_number->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contact_tax_number->formatPattern()) ?>"<?= $Page->contact_tax_number->editAttributes() ?> aria-describedby="x_contact_tax_number_help">
<?= $Page->contact_tax_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_tax_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_phone->Visible) { // contact_phone ?>
    <div id="r_contact_phone"<?= $Page->contact_phone->rowAttributes() ?>>
        <label id="elh_documents_contact_phone" for="x_contact_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_phone->caption() ?><?= $Page->contact_phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contact_phone->cellAttributes() ?>>
<span id="el_documents_contact_phone">
<input type="<?= $Page->contact_phone->getInputTextType() ?>" name="x_contact_phone" id="x_contact_phone" data-table="documents" data-field="x_contact_phone" value="<?= $Page->contact_phone->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->contact_phone->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contact_phone->formatPattern()) ?>"<?= $Page->contact_phone->editAttributes() ?> aria-describedby="x_contact_phone_help">
<?= $Page->contact_phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_address->Visible) { // contact_address ?>
    <div id="r_contact_address"<?= $Page->contact_address->rowAttributes() ?>>
        <label id="elh_documents_contact_address" for="x_contact_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_address->caption() ?><?= $Page->contact_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contact_address->cellAttributes() ?>>
<span id="el_documents_contact_address">
<textarea data-table="documents" data-field="x_contact_address" name="x_contact_address" id="x_contact_address" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->contact_address->getPlaceHolder()) ?>"<?= $Page->contact_address->editAttributes() ?> aria-describedby="x_contact_address_help"><?= $Page->contact_address->EditValue ?></textarea>
<?= $Page->contact_address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_city->Visible) { // contact_city ?>
    <div id="r_contact_city"<?= $Page->contact_city->rowAttributes() ?>>
        <label id="elh_documents_contact_city" for="x_contact_city" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_city->caption() ?><?= $Page->contact_city->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contact_city->cellAttributes() ?>>
<span id="el_documents_contact_city">
<input type="<?= $Page->contact_city->getInputTextType() ?>" name="x_contact_city" id="x_contact_city" data-table="documents" data-field="x_contact_city" value="<?= $Page->contact_city->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->contact_city->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contact_city->formatPattern()) ?>"<?= $Page->contact_city->editAttributes() ?> aria-describedby="x_contact_city_help">
<?= $Page->contact_city->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_city->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_zip_code->Visible) { // contact_zip_code ?>
    <div id="r_contact_zip_code"<?= $Page->contact_zip_code->rowAttributes() ?>>
        <label id="elh_documents_contact_zip_code" for="x_contact_zip_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_zip_code->caption() ?><?= $Page->contact_zip_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contact_zip_code->cellAttributes() ?>>
<span id="el_documents_contact_zip_code">
<input type="<?= $Page->contact_zip_code->getInputTextType() ?>" name="x_contact_zip_code" id="x_contact_zip_code" data-table="documents" data-field="x_contact_zip_code" value="<?= $Page->contact_zip_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->contact_zip_code->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contact_zip_code->formatPattern()) ?>"<?= $Page->contact_zip_code->editAttributes() ?> aria-describedby="x_contact_zip_code_help">
<?= $Page->contact_zip_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_zip_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_state->Visible) { // contact_state ?>
    <div id="r_contact_state"<?= $Page->contact_state->rowAttributes() ?>>
        <label id="elh_documents_contact_state" for="x_contact_state" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_state->caption() ?><?= $Page->contact_state->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contact_state->cellAttributes() ?>>
<span id="el_documents_contact_state">
<input type="<?= $Page->contact_state->getInputTextType() ?>" name="x_contact_state" id="x_contact_state" data-table="documents" data-field="x_contact_state" value="<?= $Page->contact_state->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->contact_state->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contact_state->formatPattern()) ?>"<?= $Page->contact_state->editAttributes() ?> aria-describedby="x_contact_state_help">
<?= $Page->contact_state->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_state->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_country->Visible) { // contact_country ?>
    <div id="r_contact_country"<?= $Page->contact_country->rowAttributes() ?>>
        <label id="elh_documents_contact_country" for="x_contact_country" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_country->caption() ?><?= $Page->contact_country->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contact_country->cellAttributes() ?>>
<span id="el_documents_contact_country">
<input type="<?= $Page->contact_country->getInputTextType() ?>" name="x_contact_country" id="x_contact_country" data-table="documents" data-field="x_contact_country" value="<?= $Page->contact_country->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->contact_country->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contact_country->formatPattern()) ?>"<?= $Page->contact_country->editAttributes() ?> aria-describedby="x_contact_country_help">
<?= $Page->contact_country->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_country->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->notes->Visible) { // notes ?>
    <div id="r_notes"<?= $Page->notes->rowAttributes() ?>>
        <label id="elh_documents_notes" for="x_notes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->notes->caption() ?><?= $Page->notes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->notes->cellAttributes() ?>>
<span id="el_documents_notes">
<textarea data-table="documents" data-field="x_notes" name="x_notes" id="x_notes" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->notes->getPlaceHolder()) ?>"<?= $Page->notes->editAttributes() ?> aria-describedby="x_notes_help"><?= $Page->notes->EditValue ?></textarea>
<?= $Page->notes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->notes->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->footer->Visible) { // footer ?>
    <div id="r_footer"<?= $Page->footer->rowAttributes() ?>>
        <label id="elh_documents_footer" for="x_footer" class="<?= $Page->LeftColumnClass ?>"><?= $Page->footer->caption() ?><?= $Page->footer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->footer->cellAttributes() ?>>
<span id="el_documents_footer">
<textarea data-table="documents" data-field="x_footer" name="x_footer" id="x_footer" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->footer->getPlaceHolder()) ?>"<?= $Page->footer->editAttributes() ?> aria-describedby="x_footer_help"><?= $Page->footer->EditValue ?></textarea>
<?= $Page->footer->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->footer->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->parent_id->Visible) { // parent_id ?>
    <div id="r_parent_id"<?= $Page->parent_id->rowAttributes() ?>>
        <label id="elh_documents_parent_id" for="x_parent_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->parent_id->caption() ?><?= $Page->parent_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->parent_id->cellAttributes() ?>>
<span id="el_documents_parent_id">
<input type="<?= $Page->parent_id->getInputTextType() ?>" name="x_parent_id" id="x_parent_id" data-table="documents" data-field="x_parent_id" value="<?= $Page->parent_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->parent_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->parent_id->formatPattern()) ?>"<?= $Page->parent_id->editAttributes() ?> aria-describedby="x_parent_id_help">
<?= $Page->parent_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->parent_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
    <div id="r_created_from"<?= $Page->created_from->rowAttributes() ?>>
        <label id="elh_documents_created_from" for="x_created_from" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_from->caption() ?><?= $Page->created_from->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_from->cellAttributes() ?>>
<span id="el_documents_created_from">
<input type="<?= $Page->created_from->getInputTextType() ?>" name="x_created_from" id="x_created_from" data-table="documents" data-field="x_created_from" value="<?= $Page->created_from->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->created_from->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_from->formatPattern()) ?>"<?= $Page->created_from->editAttributes() ?> aria-describedby="x_created_from_help">
<?= $Page->created_from->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_from->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <div id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <label id="elh_documents_created_by" for="x_created_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by->caption() ?><?= $Page->created_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by->cellAttributes() ?>>
<span id="el_documents_created_by">
<input type="<?= $Page->created_by->getInputTextType() ?>" name="x_created_by" id="x_created_by" data-table="documents" data-field="x_created_by" value="<?= $Page->created_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by->formatPattern()) ?>"<?= $Page->created_by->editAttributes() ?> aria-describedby="x_created_by_help">
<?= $Page->created_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fdocumentsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fdocumentsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("documents");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
