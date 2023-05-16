<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ContactsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { contacts: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fcontactsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fcontactsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["company_id", [fields.company_id.visible && fields.company_id.required ? ew.Validators.required(fields.company_id.caption) : null, ew.Validators.integer], fields.company_id.isInvalid],
            ["type", [fields.type.visible && fields.type.required ? ew.Validators.required(fields.type.caption) : null], fields.type.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
            ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null, ew.Validators.integer], fields.user_id.isInvalid],
            ["tax_number", [fields.tax_number.visible && fields.tax_number.required ? ew.Validators.required(fields.tax_number.caption) : null], fields.tax_number.isInvalid],
            ["phone", [fields.phone.visible && fields.phone.required ? ew.Validators.required(fields.phone.caption) : null], fields.phone.isInvalid],
            ["address", [fields.address.visible && fields.address.required ? ew.Validators.required(fields.address.caption) : null], fields.address.isInvalid],
            ["city", [fields.city.visible && fields.city.required ? ew.Validators.required(fields.city.caption) : null], fields.city.isInvalid],
            ["zip_code", [fields.zip_code.visible && fields.zip_code.required ? ew.Validators.required(fields.zip_code.caption) : null], fields.zip_code.isInvalid],
            ["state", [fields.state.visible && fields.state.required ? ew.Validators.required(fields.state.caption) : null], fields.state.isInvalid],
            ["country", [fields.country.visible && fields.country.required ? ew.Validators.required(fields.country.caption) : null], fields.country.isInvalid],
            ["website", [fields.website.visible && fields.website.required ? ew.Validators.required(fields.website.caption) : null], fields.website.isInvalid],
            ["currency_code", [fields.currency_code.visible && fields.currency_code.required ? ew.Validators.required(fields.currency_code.caption) : null], fields.currency_code.isInvalid],
            ["enabled", [fields.enabled.visible && fields.enabled.required ? ew.Validators.required(fields.enabled.caption) : null], fields.enabled.isInvalid],
            ["reference", [fields.reference.visible && fields.reference.required ? ew.Validators.required(fields.reference.caption) : null], fields.reference.isInvalid],
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
<form name="fcontactsadd" id="fcontactsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="contacts">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->company_id->Visible) { // company_id ?>
    <div id="r_company_id"<?= $Page->company_id->rowAttributes() ?>>
        <label id="elh_contacts_company_id" for="x_company_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->company_id->caption() ?><?= $Page->company_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->company_id->cellAttributes() ?>>
<span id="el_contacts_company_id">
<input type="<?= $Page->company_id->getInputTextType() ?>" name="x_company_id" id="x_company_id" data-table="contacts" data-field="x_company_id" value="<?= $Page->company_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->company_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->company_id->formatPattern()) ?>"<?= $Page->company_id->editAttributes() ?> aria-describedby="x_company_id_help">
<?= $Page->company_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->company_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <div id="r_type"<?= $Page->type->rowAttributes() ?>>
        <label id="elh_contacts_type" for="x_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->type->caption() ?><?= $Page->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->type->cellAttributes() ?>>
<span id="el_contacts_type">
<input type="<?= $Page->type->getInputTextType() ?>" name="x_type" id="x_type" data-table="contacts" data-field="x_type" value="<?= $Page->type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->type->formatPattern()) ?>"<?= $Page->type->editAttributes() ?> aria-describedby="x_type_help">
<?= $Page->type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_contacts_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_contacts_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="contacts" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <label id="elh_contacts__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span id="el_contacts__email">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="contacts" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->_email->formatPattern()) ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <div id="r_user_id"<?= $Page->user_id->rowAttributes() ?>>
        <label id="elh_contacts_user_id" for="x_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_id->caption() ?><?= $Page->user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user_id->cellAttributes() ?>>
<span id="el_contacts_user_id">
<input type="<?= $Page->user_id->getInputTextType() ?>" name="x_user_id" id="x_user_id" data-table="contacts" data-field="x_user_id" value="<?= $Page->user_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->user_id->formatPattern()) ?>"<?= $Page->user_id->editAttributes() ?> aria-describedby="x_user_id_help">
<?= $Page->user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tax_number->Visible) { // tax_number ?>
    <div id="r_tax_number"<?= $Page->tax_number->rowAttributes() ?>>
        <label id="elh_contacts_tax_number" for="x_tax_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tax_number->caption() ?><?= $Page->tax_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tax_number->cellAttributes() ?>>
<span id="el_contacts_tax_number">
<input type="<?= $Page->tax_number->getInputTextType() ?>" name="x_tax_number" id="x_tax_number" data-table="contacts" data-field="x_tax_number" value="<?= $Page->tax_number->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->tax_number->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tax_number->formatPattern()) ?>"<?= $Page->tax_number->editAttributes() ?> aria-describedby="x_tax_number_help">
<?= $Page->tax_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tax_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <div id="r_phone"<?= $Page->phone->rowAttributes() ?>>
        <label id="elh_contacts_phone" for="x_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone->caption() ?><?= $Page->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->phone->cellAttributes() ?>>
<span id="el_contacts_phone">
<input type="<?= $Page->phone->getInputTextType() ?>" name="x_phone" id="x_phone" data-table="contacts" data-field="x_phone" value="<?= $Page->phone->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->phone->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->phone->formatPattern()) ?>"<?= $Page->phone->editAttributes() ?> aria-describedby="x_phone_help">
<?= $Page->phone->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->phone->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address->Visible) { // address ?>
    <div id="r_address"<?= $Page->address->rowAttributes() ?>>
        <label id="elh_contacts_address" for="x_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address->caption() ?><?= $Page->address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address->cellAttributes() ?>>
<span id="el_contacts_address">
<textarea data-table="contacts" data-field="x_address" name="x_address" id="x_address" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->address->getPlaceHolder()) ?>"<?= $Page->address->editAttributes() ?> aria-describedby="x_address_help"><?= $Page->address->EditValue ?></textarea>
<?= $Page->address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->city->Visible) { // city ?>
    <div id="r_city"<?= $Page->city->rowAttributes() ?>>
        <label id="elh_contacts_city" for="x_city" class="<?= $Page->LeftColumnClass ?>"><?= $Page->city->caption() ?><?= $Page->city->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->city->cellAttributes() ?>>
<span id="el_contacts_city">
<input type="<?= $Page->city->getInputTextType() ?>" name="x_city" id="x_city" data-table="contacts" data-field="x_city" value="<?= $Page->city->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->city->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->city->formatPattern()) ?>"<?= $Page->city->editAttributes() ?> aria-describedby="x_city_help">
<?= $Page->city->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->city->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->zip_code->Visible) { // zip_code ?>
    <div id="r_zip_code"<?= $Page->zip_code->rowAttributes() ?>>
        <label id="elh_contacts_zip_code" for="x_zip_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->zip_code->caption() ?><?= $Page->zip_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->zip_code->cellAttributes() ?>>
<span id="el_contacts_zip_code">
<input type="<?= $Page->zip_code->getInputTextType() ?>" name="x_zip_code" id="x_zip_code" data-table="contacts" data-field="x_zip_code" value="<?= $Page->zip_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->zip_code->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->zip_code->formatPattern()) ?>"<?= $Page->zip_code->editAttributes() ?> aria-describedby="x_zip_code_help">
<?= $Page->zip_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->zip_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->state->Visible) { // state ?>
    <div id="r_state"<?= $Page->state->rowAttributes() ?>>
        <label id="elh_contacts_state" for="x_state" class="<?= $Page->LeftColumnClass ?>"><?= $Page->state->caption() ?><?= $Page->state->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->state->cellAttributes() ?>>
<span id="el_contacts_state">
<input type="<?= $Page->state->getInputTextType() ?>" name="x_state" id="x_state" data-table="contacts" data-field="x_state" value="<?= $Page->state->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->state->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->state->formatPattern()) ?>"<?= $Page->state->editAttributes() ?> aria-describedby="x_state_help">
<?= $Page->state->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->state->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->country->Visible) { // country ?>
    <div id="r_country"<?= $Page->country->rowAttributes() ?>>
        <label id="elh_contacts_country" for="x_country" class="<?= $Page->LeftColumnClass ?>"><?= $Page->country->caption() ?><?= $Page->country->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->country->cellAttributes() ?>>
<span id="el_contacts_country">
<input type="<?= $Page->country->getInputTextType() ?>" name="x_country" id="x_country" data-table="contacts" data-field="x_country" value="<?= $Page->country->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->country->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->country->formatPattern()) ?>"<?= $Page->country->editAttributes() ?> aria-describedby="x_country_help">
<?= $Page->country->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->country->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->website->Visible) { // website ?>
    <div id="r_website"<?= $Page->website->rowAttributes() ?>>
        <label id="elh_contacts_website" for="x_website" class="<?= $Page->LeftColumnClass ?>"><?= $Page->website->caption() ?><?= $Page->website->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->website->cellAttributes() ?>>
<span id="el_contacts_website">
<input type="<?= $Page->website->getInputTextType() ?>" name="x_website" id="x_website" data-table="contacts" data-field="x_website" value="<?= $Page->website->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->website->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->website->formatPattern()) ?>"<?= $Page->website->editAttributes() ?> aria-describedby="x_website_help">
<?= $Page->website->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->website->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->currency_code->Visible) { // currency_code ?>
    <div id="r_currency_code"<?= $Page->currency_code->rowAttributes() ?>>
        <label id="elh_contacts_currency_code" for="x_currency_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->currency_code->caption() ?><?= $Page->currency_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->currency_code->cellAttributes() ?>>
<span id="el_contacts_currency_code">
<input type="<?= $Page->currency_code->getInputTextType() ?>" name="x_currency_code" id="x_currency_code" data-table="contacts" data-field="x_currency_code" value="<?= $Page->currency_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->currency_code->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->currency_code->formatPattern()) ?>"<?= $Page->currency_code->editAttributes() ?> aria-describedby="x_currency_code_help">
<?= $Page->currency_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->currency_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->enabled->Visible) { // enabled ?>
    <div id="r_enabled"<?= $Page->enabled->rowAttributes() ?>>
        <label id="elh_contacts_enabled" class="<?= $Page->LeftColumnClass ?>"><?= $Page->enabled->caption() ?><?= $Page->enabled->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->enabled->cellAttributes() ?>>
<span id="el_contacts_enabled">
<div class="form-check d-inline-block">
    <input type="checkbox" class="form-check-input<?= $Page->enabled->isInvalidClass() ?>" data-table="contacts" data-field="x_enabled" data-boolean name="x_enabled" id="x_enabled" value="1"<?= ConvertToBool($Page->enabled->CurrentValue) ? " checked" : "" ?><?= $Page->enabled->editAttributes() ?> aria-describedby="x_enabled_help">
    <div class="invalid-feedback"><?= $Page->enabled->getErrorMessage() ?></div>
</div>
<?= $Page->enabled->getCustomMessage() ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->reference->Visible) { // reference ?>
    <div id="r_reference"<?= $Page->reference->rowAttributes() ?>>
        <label id="elh_contacts_reference" for="x_reference" class="<?= $Page->LeftColumnClass ?>"><?= $Page->reference->caption() ?><?= $Page->reference->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->reference->cellAttributes() ?>>
<span id="el_contacts_reference">
<input type="<?= $Page->reference->getInputTextType() ?>" name="x_reference" id="x_reference" data-table="contacts" data-field="x_reference" value="<?= $Page->reference->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->reference->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->reference->formatPattern()) ?>"<?= $Page->reference->editAttributes() ?> aria-describedby="x_reference_help">
<?= $Page->reference->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->reference->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
    <div id="r_created_from"<?= $Page->created_from->rowAttributes() ?>>
        <label id="elh_contacts_created_from" for="x_created_from" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_from->caption() ?><?= $Page->created_from->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_from->cellAttributes() ?>>
<span id="el_contacts_created_from">
<input type="<?= $Page->created_from->getInputTextType() ?>" name="x_created_from" id="x_created_from" data-table="contacts" data-field="x_created_from" value="<?= $Page->created_from->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->created_from->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_from->formatPattern()) ?>"<?= $Page->created_from->editAttributes() ?> aria-describedby="x_created_from_help">
<?= $Page->created_from->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_from->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <div id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <label id="elh_contacts_created_by" for="x_created_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_by->caption() ?><?= $Page->created_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_by->cellAttributes() ?>>
<span id="el_contacts_created_by">
<input type="<?= $Page->created_by->getInputTextType() ?>" name="x_created_by" id="x_created_by" data-table="contacts" data-field="x_created_by" value="<?= $Page->created_by->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->created_by->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_by->formatPattern()) ?>"<?= $Page->created_by->editAttributes() ?> aria-describedby="x_created_by_help">
<?= $Page->created_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fcontactsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fcontactsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("contacts");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
