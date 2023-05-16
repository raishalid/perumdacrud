<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$TransactionEdit = &$Page;
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
<form name="ftransactionedit" id="ftransactionedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transaction: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var ftransactionedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ftransactionedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["acc_id", [fields.acc_id.visible && fields.acc_id.required ? ew.Validators.required(fields.acc_id.caption) : null, ew.Validators.integer], fields.acc_id.isInvalid],
            ["paid_at", [fields.paid_at.visible && fields.paid_at.required ? ew.Validators.required(fields.paid_at.caption) : null, ew.Validators.datetime(fields.paid_at.clientFormatPattern)], fields.paid_at.isInvalid],
            ["departement_id", [fields.departement_id.visible && fields.departement_id.required ? ew.Validators.required(fields.departement_id.caption) : null, ew.Validators.integer], fields.departement_id.isInvalid],
            ["type_id", [fields.type_id.visible && fields.type_id.required ? ew.Validators.required(fields.type_id.caption) : null, ew.Validators.integer], fields.type_id.isInvalid],
            ["amount", [fields.amount.visible && fields.amount.required ? ew.Validators.required(fields.amount.caption) : null, ew.Validators.float], fields.amount.isInvalid],
            ["currency_code", [fields.currency_code.visible && fields.currency_code.required ? ew.Validators.required(fields.currency_code.caption) : null], fields.currency_code.isInvalid],
            ["currency_rate", [fields.currency_rate.visible && fields.currency_rate.required ? ew.Validators.required(fields.currency_rate.caption) : null, ew.Validators.float], fields.currency_rate.isInvalid],
            ["document_id", [fields.document_id.visible && fields.document_id.required ? ew.Validators.required(fields.document_id.caption) : null, ew.Validators.integer], fields.document_id.isInvalid],
            ["contact_id", [fields.contact_id.visible && fields.contact_id.required ? ew.Validators.required(fields.contact_id.caption) : null, ew.Validators.integer], fields.contact_id.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["acc_category_id", [fields.acc_category_id.visible && fields.acc_category_id.required ? ew.Validators.required(fields.acc_category_id.caption) : null, ew.Validators.integer], fields.acc_category_id.isInvalid],
            ["payment_method", [fields.payment_method.visible && fields.payment_method.required ? ew.Validators.required(fields.payment_method.caption) : null], fields.payment_method.isInvalid],
            ["reference", [fields.reference.visible && fields.reference.required ? ew.Validators.required(fields.reference.caption) : null], fields.reference.isInvalid],
            ["parent_id", [fields.parent_id.visible && fields.parent_id.required ? ew.Validators.required(fields.parent_id.caption) : null, ew.Validators.integer], fields.parent_id.isInvalid],
            ["reconciled", [fields.reconciled.visible && fields.reconciled.required ? ew.Validators.required(fields.reconciled.caption) : null], fields.reconciled.isInvalid],
            ["created_from", [fields.created_from.visible && fields.created_from.required ? ew.Validators.required(fields.created_from.caption) : null], fields.created_from.isInvalid],
            ["created_by", [fields.created_by.visible && fields.created_by.required ? ew.Validators.required(fields.created_by.caption) : null], fields.created_by.isInvalid],
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
            "reconciled": <?= $Page->reconciled->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="transaction">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_transaction_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_transaction_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="transaction" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->acc_id->Visible) { // acc_id ?>
    <div id="r_acc_id"<?= $Page->acc_id->rowAttributes() ?>>
        <label id="elh_transaction_acc_id" for="x_acc_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->acc_id->caption() ?><?= $Page->acc_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->acc_id->cellAttributes() ?>>
<span id="el_transaction_acc_id">
<input type="<?= $Page->acc_id->getInputTextType() ?>" name="x_acc_id" id="x_acc_id" data-table="transaction" data-field="x_acc_id" value="<?= $Page->acc_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->acc_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->acc_id->formatPattern()) ?>"<?= $Page->acc_id->editAttributes() ?> aria-describedby="x_acc_id_help">
<?= $Page->acc_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->acc_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->paid_at->Visible) { // paid_at ?>
    <div id="r_paid_at"<?= $Page->paid_at->rowAttributes() ?>>
        <label id="elh_transaction_paid_at" for="x_paid_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->paid_at->caption() ?><?= $Page->paid_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->paid_at->cellAttributes() ?>>
<span id="el_transaction_paid_at">
<input type="<?= $Page->paid_at->getInputTextType() ?>" name="x_paid_at" id="x_paid_at" data-table="transaction" data-field="x_paid_at" value="<?= $Page->paid_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->paid_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->paid_at->formatPattern()) ?>"<?= $Page->paid_at->editAttributes() ?> aria-describedby="x_paid_at_help">
<?= $Page->paid_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->paid_at->getErrorMessage() ?></div>
<?php if (!$Page->paid_at->ReadOnly && !$Page->paid_at->Disabled && !isset($Page->paid_at->EditAttrs["readonly"]) && !isset($Page->paid_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransactionedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftransactionedit", "x_paid_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->departement_id->Visible) { // departement_id ?>
    <div id="r_departement_id"<?= $Page->departement_id->rowAttributes() ?>>
        <label id="elh_transaction_departement_id" for="x_departement_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->departement_id->caption() ?><?= $Page->departement_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->departement_id->cellAttributes() ?>>
<span id="el_transaction_departement_id">
<input type="<?= $Page->departement_id->getInputTextType() ?>" name="x_departement_id" id="x_departement_id" data-table="transaction" data-field="x_departement_id" value="<?= $Page->departement_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->departement_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->departement_id->formatPattern()) ?>"<?= $Page->departement_id->editAttributes() ?> aria-describedby="x_departement_id_help">
<?= $Page->departement_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->departement_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->type_id->Visible) { // type_id ?>
    <div id="r_type_id"<?= $Page->type_id->rowAttributes() ?>>
        <label id="elh_transaction_type_id" for="x_type_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->type_id->caption() ?><?= $Page->type_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->type_id->cellAttributes() ?>>
<span id="el_transaction_type_id">
<input type="<?= $Page->type_id->getInputTextType() ?>" name="x_type_id" id="x_type_id" data-table="transaction" data-field="x_type_id" value="<?= $Page->type_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->type_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->type_id->formatPattern()) ?>"<?= $Page->type_id->editAttributes() ?> aria-describedby="x_type_id_help">
<?= $Page->type_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->type_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
    <div id="r_amount"<?= $Page->amount->rowAttributes() ?>>
        <label id="elh_transaction_amount" for="x_amount" class="<?= $Page->LeftColumnClass ?>"><?= $Page->amount->caption() ?><?= $Page->amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->amount->cellAttributes() ?>>
<span id="el_transaction_amount">
<input type="<?= $Page->amount->getInputTextType() ?>" name="x_amount" id="x_amount" data-table="transaction" data-field="x_amount" value="<?= $Page->amount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->amount->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->amount->formatPattern()) ?>"<?= $Page->amount->editAttributes() ?> aria-describedby="x_amount_help">
<?= $Page->amount->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->amount->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->currency_code->Visible) { // currency_code ?>
    <div id="r_currency_code"<?= $Page->currency_code->rowAttributes() ?>>
        <label id="elh_transaction_currency_code" for="x_currency_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->currency_code->caption() ?><?= $Page->currency_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->currency_code->cellAttributes() ?>>
<span id="el_transaction_currency_code">
<input type="<?= $Page->currency_code->getInputTextType() ?>" name="x_currency_code" id="x_currency_code" data-table="transaction" data-field="x_currency_code" value="<?= $Page->currency_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->currency_code->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->currency_code->formatPattern()) ?>"<?= $Page->currency_code->editAttributes() ?> aria-describedby="x_currency_code_help">
<?= $Page->currency_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->currency_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->currency_rate->Visible) { // currency_rate ?>
    <div id="r_currency_rate"<?= $Page->currency_rate->rowAttributes() ?>>
        <label id="elh_transaction_currency_rate" for="x_currency_rate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->currency_rate->caption() ?><?= $Page->currency_rate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->currency_rate->cellAttributes() ?>>
<span id="el_transaction_currency_rate">
<input type="<?= $Page->currency_rate->getInputTextType() ?>" name="x_currency_rate" id="x_currency_rate" data-table="transaction" data-field="x_currency_rate" value="<?= $Page->currency_rate->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->currency_rate->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->currency_rate->formatPattern()) ?>"<?= $Page->currency_rate->editAttributes() ?> aria-describedby="x_currency_rate_help">
<?= $Page->currency_rate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->currency_rate->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->document_id->Visible) { // document_id ?>
    <div id="r_document_id"<?= $Page->document_id->rowAttributes() ?>>
        <label id="elh_transaction_document_id" for="x_document_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->document_id->caption() ?><?= $Page->document_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->document_id->cellAttributes() ?>>
<span id="el_transaction_document_id">
<input type="<?= $Page->document_id->getInputTextType() ?>" name="x_document_id" id="x_document_id" data-table="transaction" data-field="x_document_id" value="<?= $Page->document_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->document_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->document_id->formatPattern()) ?>"<?= $Page->document_id->editAttributes() ?> aria-describedby="x_document_id_help">
<?= $Page->document_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->document_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contact_id->Visible) { // contact_id ?>
    <div id="r_contact_id"<?= $Page->contact_id->rowAttributes() ?>>
        <label id="elh_transaction_contact_id" for="x_contact_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contact_id->caption() ?><?= $Page->contact_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contact_id->cellAttributes() ?>>
<span id="el_transaction_contact_id">
<input type="<?= $Page->contact_id->getInputTextType() ?>" name="x_contact_id" id="x_contact_id" data-table="transaction" data-field="x_contact_id" value="<?= $Page->contact_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->contact_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contact_id->formatPattern()) ?>"<?= $Page->contact_id->editAttributes() ?> aria-describedby="x_contact_id_help">
<?= $Page->contact_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contact_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_transaction_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_transaction_description">
<textarea data-table="transaction" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->acc_category_id->Visible) { // acc_category_id ?>
    <div id="r_acc_category_id"<?= $Page->acc_category_id->rowAttributes() ?>>
        <label id="elh_transaction_acc_category_id" for="x_acc_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->acc_category_id->caption() ?><?= $Page->acc_category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->acc_category_id->cellAttributes() ?>>
<span id="el_transaction_acc_category_id">
<input type="<?= $Page->acc_category_id->getInputTextType() ?>" name="x_acc_category_id" id="x_acc_category_id" data-table="transaction" data-field="x_acc_category_id" value="<?= $Page->acc_category_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->acc_category_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->acc_category_id->formatPattern()) ?>"<?= $Page->acc_category_id->editAttributes() ?> aria-describedby="x_acc_category_id_help">
<?= $Page->acc_category_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->acc_category_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->payment_method->Visible) { // payment_method ?>
    <div id="r_payment_method"<?= $Page->payment_method->rowAttributes() ?>>
        <label id="elh_transaction_payment_method" for="x_payment_method" class="<?= $Page->LeftColumnClass ?>"><?= $Page->payment_method->caption() ?><?= $Page->payment_method->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->payment_method->cellAttributes() ?>>
<span id="el_transaction_payment_method">
<input type="<?= $Page->payment_method->getInputTextType() ?>" name="x_payment_method" id="x_payment_method" data-table="transaction" data-field="x_payment_method" value="<?= $Page->payment_method->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->payment_method->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->payment_method->formatPattern()) ?>"<?= $Page->payment_method->editAttributes() ?> aria-describedby="x_payment_method_help">
<?= $Page->payment_method->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->payment_method->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->reference->Visible) { // reference ?>
    <div id="r_reference"<?= $Page->reference->rowAttributes() ?>>
        <label id="elh_transaction_reference" for="x_reference" class="<?= $Page->LeftColumnClass ?>"><?= $Page->reference->caption() ?><?= $Page->reference->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->reference->cellAttributes() ?>>
<span id="el_transaction_reference">
<input type="<?= $Page->reference->getInputTextType() ?>" name="x_reference" id="x_reference" data-table="transaction" data-field="x_reference" value="<?= $Page->reference->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->reference->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->reference->formatPattern()) ?>"<?= $Page->reference->editAttributes() ?> aria-describedby="x_reference_help">
<?= $Page->reference->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->reference->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->parent_id->Visible) { // parent_id ?>
    <div id="r_parent_id"<?= $Page->parent_id->rowAttributes() ?>>
        <label id="elh_transaction_parent_id" for="x_parent_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->parent_id->caption() ?><?= $Page->parent_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->parent_id->cellAttributes() ?>>
<span id="el_transaction_parent_id">
<input type="<?= $Page->parent_id->getInputTextType() ?>" name="x_parent_id" id="x_parent_id" data-table="transaction" data-field="x_parent_id" value="<?= $Page->parent_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->parent_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->parent_id->formatPattern()) ?>"<?= $Page->parent_id->editAttributes() ?> aria-describedby="x_parent_id_help">
<?= $Page->parent_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->parent_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->reconciled->Visible) { // reconciled ?>
    <div id="r_reconciled"<?= $Page->reconciled->rowAttributes() ?>>
        <label id="elh_transaction_reconciled" class="<?= $Page->LeftColumnClass ?>"><?= $Page->reconciled->caption() ?><?= $Page->reconciled->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->reconciled->cellAttributes() ?>>
<span id="el_transaction_reconciled">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->reconciled->isInvalidClass() ?>" data-table="transaction" data-field="x_reconciled" data-boolean name="x_reconciled" id="x_reconciled" value="1"<?= ConvertToBool($Page->reconciled->CurrentValue) ? " checked" : "" ?><?= $Page->reconciled->editAttributes() ?> aria-describedby="x_reconciled_help">
    <div class="invalid-feedback"><?= $Page->reconciled->getErrorMessage() ?></div>
</div>
<?= $Page->reconciled->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
    <div id="r_created_from"<?= $Page->created_from->rowAttributes() ?>>
        <label id="elh_transaction_created_from" for="x_created_from" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_from->caption() ?><?= $Page->created_from->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_from->cellAttributes() ?>>
<span id="el_transaction_created_from">
<input type="<?= $Page->created_from->getInputTextType() ?>" name="x_created_from" id="x_created_from" data-table="transaction" data-field="x_created_from" value="<?= $Page->created_from->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->created_from->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_from->formatPattern()) ?>"<?= $Page->created_from->editAttributes() ?> aria-describedby="x_created_from_help">
<?= $Page->created_from->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_from->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <div id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <label id="elh_transaction_created_by" for="x_created_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by->caption() ?><?= $Page->created_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by->cellAttributes() ?>>
<span id="el_transaction_created_by">
<input type="<?= $Page->created_by->getInputTextType() ?>" name="x_created_by" id="x_created_by" data-table="transaction" data-field="x_created_by" value="<?= $Page->created_by->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->created_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by->formatPattern()) ?>"<?= $Page->created_by->editAttributes() ?> aria-describedby="x_created_by_help">
<?= $Page->created_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="ftransactionedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="ftransactionedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("transaction");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
