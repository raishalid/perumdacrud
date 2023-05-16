<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$InvestorsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { investors: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var finvestorsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("finvestorsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["investor_name", [fields.investor_name.visible && fields.investor_name.required ? ew.Validators.required(fields.investor_name.caption) : null], fields.investor_name.isInvalid],
            ["investor_info", [fields.investor_info.visible && fields.investor_info.required ? ew.Validators.required(fields.investor_info.caption) : null], fields.investor_info.isInvalid],
            ["slug", [fields.slug.visible && fields.slug.required ? ew.Validators.required(fields.slug.caption) : null], fields.slug.isInvalid],
            ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null], fields.created_at.isInvalid],
            ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null], fields.updated_at.isInvalid]
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
<form name="finvestorsadd" id="finvestorsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="investors">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->investor_name->Visible) { // investor_name ?>
    <div id="r_investor_name"<?= $Page->investor_name->rowAttributes() ?>>
        <label id="elh_investors_investor_name" for="x_investor_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->investor_name->caption() ?><?= $Page->investor_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->investor_name->cellAttributes() ?>>
<span id="el_investors_investor_name">
<input type="<?= $Page->investor_name->getInputTextType() ?>" name="x_investor_name" id="x_investor_name" data-table="investors" data-field="x_investor_name" value="<?= $Page->investor_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->investor_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->investor_name->formatPattern()) ?>"<?= $Page->investor_name->editAttributes() ?> aria-describedby="x_investor_name_help">
<?= $Page->investor_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->investor_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->investor_info->Visible) { // investor_info ?>
    <div id="r_investor_info"<?= $Page->investor_info->rowAttributes() ?>>
        <label id="elh_investors_investor_info" for="x_investor_info" class="<?= $Page->LeftColumnClass ?>"><?= $Page->investor_info->caption() ?><?= $Page->investor_info->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->investor_info->cellAttributes() ?>>
<span id="el_investors_investor_info">
<textarea data-table="investors" data-field="x_investor_info" name="x_investor_info" id="x_investor_info" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->investor_info->getPlaceHolder()) ?>"<?= $Page->investor_info->editAttributes() ?> aria-describedby="x_investor_info_help"><?= $Page->investor_info->EditValue ?></textarea>
<?= $Page->investor_info->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->investor_info->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->slug->Visible) { // slug ?>
    <div id="r_slug"<?= $Page->slug->rowAttributes() ?>>
        <label id="elh_investors_slug" for="x_slug" class="<?= $Page->LeftColumnClass ?>"><?= $Page->slug->caption() ?><?= $Page->slug->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->slug->cellAttributes() ?>>
<span id="el_investors_slug">
<input type="<?= $Page->slug->getInputTextType() ?>" name="x_slug" id="x_slug" data-table="investors" data-field="x_slug" value="<?= $Page->slug->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->slug->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->slug->formatPattern()) ?>"<?= $Page->slug->editAttributes() ?> aria-describedby="x_slug_help">
<?= $Page->slug->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->slug->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="finvestorsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="finvestorsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("investors");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
