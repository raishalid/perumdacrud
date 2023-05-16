<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$PersonalAccessTokensEdit = &$Page;
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
<form name="fpersonal_access_tokensedit" id="fpersonal_access_tokensedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { personal_access_tokens: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fpersonal_access_tokensedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fpersonal_access_tokensedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["tokenable_type", [fields.tokenable_type.visible && fields.tokenable_type.required ? ew.Validators.required(fields.tokenable_type.caption) : null], fields.tokenable_type.isInvalid],
            ["tokenable_id", [fields.tokenable_id.visible && fields.tokenable_id.required ? ew.Validators.required(fields.tokenable_id.caption) : null, ew.Validators.integer], fields.tokenable_id.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["_token", [fields._token.visible && fields._token.required ? ew.Validators.required(fields._token.caption) : null], fields._token.isInvalid],
            ["abilities", [fields.abilities.visible && fields.abilities.required ? ew.Validators.required(fields.abilities.caption) : null], fields.abilities.isInvalid],
            ["last_used_at", [fields.last_used_at.visible && fields.last_used_at.required ? ew.Validators.required(fields.last_used_at.caption) : null, ew.Validators.datetime(fields.last_used_at.clientFormatPattern)], fields.last_used_at.isInvalid],
            ["expires_at", [fields.expires_at.visible && fields.expires_at.required ? ew.Validators.required(fields.expires_at.caption) : null, ew.Validators.datetime(fields.expires_at.clientFormatPattern)], fields.expires_at.isInvalid],
            ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern)], fields.created_at.isInvalid],
            ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(fields.updated_at.clientFormatPattern)], fields.updated_at.isInvalid]
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
<input type="hidden" name="t" value="personal_access_tokens">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_personal_access_tokens_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_personal_access_tokens_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="personal_access_tokens" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tokenable_type->Visible) { // tokenable_type ?>
    <div id="r_tokenable_type"<?= $Page->tokenable_type->rowAttributes() ?>>
        <label id="elh_personal_access_tokens_tokenable_type" for="x_tokenable_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tokenable_type->caption() ?><?= $Page->tokenable_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tokenable_type->cellAttributes() ?>>
<span id="el_personal_access_tokens_tokenable_type">
<input type="<?= $Page->tokenable_type->getInputTextType() ?>" name="x_tokenable_type" id="x_tokenable_type" data-table="personal_access_tokens" data-field="x_tokenable_type" value="<?= $Page->tokenable_type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->tokenable_type->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tokenable_type->formatPattern()) ?>"<?= $Page->tokenable_type->editAttributes() ?> aria-describedby="x_tokenable_type_help">
<?= $Page->tokenable_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tokenable_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tokenable_id->Visible) { // tokenable_id ?>
    <div id="r_tokenable_id"<?= $Page->tokenable_id->rowAttributes() ?>>
        <label id="elh_personal_access_tokens_tokenable_id" for="x_tokenable_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tokenable_id->caption() ?><?= $Page->tokenable_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tokenable_id->cellAttributes() ?>>
<span id="el_personal_access_tokens_tokenable_id">
<input type="<?= $Page->tokenable_id->getInputTextType() ?>" name="x_tokenable_id" id="x_tokenable_id" data-table="personal_access_tokens" data-field="x_tokenable_id" value="<?= $Page->tokenable_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tokenable_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tokenable_id->formatPattern()) ?>"<?= $Page->tokenable_id->editAttributes() ?> aria-describedby="x_tokenable_id_help">
<?= $Page->tokenable_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tokenable_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_personal_access_tokens_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_personal_access_tokens_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="personal_access_tokens" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_token->Visible) { // token ?>
    <div id="r__token"<?= $Page->_token->rowAttributes() ?>>
        <label id="elh_personal_access_tokens__token" for="x__token" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_token->caption() ?><?= $Page->_token->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_token->cellAttributes() ?>>
<span id="el_personal_access_tokens__token">
<input type="<?= $Page->_token->getInputTextType() ?>" name="x__token" id="x__token" data-table="personal_access_tokens" data-field="x__token" value="<?= $Page->_token->EditValue ?>" size="30" maxlength="64" placeholder="<?= HtmlEncode($Page->_token->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->_token->formatPattern()) ?>"<?= $Page->_token->editAttributes() ?> aria-describedby="x__token_help">
<?= $Page->_token->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_token->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->abilities->Visible) { // abilities ?>
    <div id="r_abilities"<?= $Page->abilities->rowAttributes() ?>>
        <label id="elh_personal_access_tokens_abilities" for="x_abilities" class="<?= $Page->LeftColumnClass ?>"><?= $Page->abilities->caption() ?><?= $Page->abilities->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->abilities->cellAttributes() ?>>
<span id="el_personal_access_tokens_abilities">
<textarea data-table="personal_access_tokens" data-field="x_abilities" name="x_abilities" id="x_abilities" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->abilities->getPlaceHolder()) ?>"<?= $Page->abilities->editAttributes() ?> aria-describedby="x_abilities_help"><?= $Page->abilities->EditValue ?></textarea>
<?= $Page->abilities->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->abilities->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->last_used_at->Visible) { // last_used_at ?>
    <div id="r_last_used_at"<?= $Page->last_used_at->rowAttributes() ?>>
        <label id="elh_personal_access_tokens_last_used_at" for="x_last_used_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->last_used_at->caption() ?><?= $Page->last_used_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->last_used_at->cellAttributes() ?>>
<span id="el_personal_access_tokens_last_used_at">
<input type="<?= $Page->last_used_at->getInputTextType() ?>" name="x_last_used_at" id="x_last_used_at" data-table="personal_access_tokens" data-field="x_last_used_at" value="<?= $Page->last_used_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->last_used_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->last_used_at->formatPattern()) ?>"<?= $Page->last_used_at->editAttributes() ?> aria-describedby="x_last_used_at_help">
<?= $Page->last_used_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->last_used_at->getErrorMessage() ?></div>
<?php if (!$Page->last_used_at->ReadOnly && !$Page->last_used_at->Disabled && !isset($Page->last_used_at->EditAttrs["readonly"]) && !isset($Page->last_used_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpersonal_access_tokensedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpersonal_access_tokensedit", "x_last_used_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->expires_at->Visible) { // expires_at ?>
    <div id="r_expires_at"<?= $Page->expires_at->rowAttributes() ?>>
        <label id="elh_personal_access_tokens_expires_at" for="x_expires_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->expires_at->caption() ?><?= $Page->expires_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->expires_at->cellAttributes() ?>>
<span id="el_personal_access_tokens_expires_at">
<input type="<?= $Page->expires_at->getInputTextType() ?>" name="x_expires_at" id="x_expires_at" data-table="personal_access_tokens" data-field="x_expires_at" value="<?= $Page->expires_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->expires_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->expires_at->formatPattern()) ?>"<?= $Page->expires_at->editAttributes() ?> aria-describedby="x_expires_at_help">
<?= $Page->expires_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->expires_at->getErrorMessage() ?></div>
<?php if (!$Page->expires_at->ReadOnly && !$Page->expires_at->Disabled && !isset($Page->expires_at->EditAttrs["readonly"]) && !isset($Page->expires_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpersonal_access_tokensedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpersonal_access_tokensedit", "x_expires_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label id="elh_personal_access_tokens_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->created_at->cellAttributes() ?>>
<span id="el_personal_access_tokens_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="personal_access_tokens" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_at->formatPattern()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpersonal_access_tokensedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpersonal_access_tokensedit", "x_created_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label id="elh_personal_access_tokens_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_personal_access_tokens_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="personal_access_tokens" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->updated_at->formatPattern()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpersonal_access_tokensedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpersonal_access_tokensedit", "x_updated_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fpersonal_access_tokensedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fpersonal_access_tokensedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("personal_access_tokens");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
