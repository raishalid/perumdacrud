<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$FundingSourcesEdit = &$Page;
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
<form name="ffunding_sourcesedit" id="ffunding_sourcesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { funding_sources: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var ffunding_sourcesedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ffunding_sourcesedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["fundingsource_name", [fields.fundingsource_name.visible && fields.fundingsource_name.required ? ew.Validators.required(fields.fundingsource_name.caption) : null], fields.fundingsource_name.isInvalid],
            ["fundingsource_description", [fields.fundingsource_description.visible && fields.fundingsource_description.required ? ew.Validators.required(fields.fundingsource_description.caption) : null], fields.fundingsource_description.isInvalid],
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
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="funding_sources">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_funding_sources_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_funding_sources_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="funding_sources" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fundingsource_name->Visible) { // fundingsource_name ?>
    <div id="r_fundingsource_name"<?= $Page->fundingsource_name->rowAttributes() ?>>
        <label id="elh_funding_sources_fundingsource_name" for="x_fundingsource_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fundingsource_name->caption() ?><?= $Page->fundingsource_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fundingsource_name->cellAttributes() ?>>
<span id="el_funding_sources_fundingsource_name">
<input type="<?= $Page->fundingsource_name->getInputTextType() ?>" name="x_fundingsource_name" id="x_fundingsource_name" data-table="funding_sources" data-field="x_fundingsource_name" value="<?= $Page->fundingsource_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->fundingsource_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->fundingsource_name->formatPattern()) ?>"<?= $Page->fundingsource_name->editAttributes() ?> aria-describedby="x_fundingsource_name_help">
<?= $Page->fundingsource_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fundingsource_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->fundingsource_description->Visible) { // fundingsource_description ?>
    <div id="r_fundingsource_description"<?= $Page->fundingsource_description->rowAttributes() ?>>
        <label id="elh_funding_sources_fundingsource_description" for="x_fundingsource_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->fundingsource_description->caption() ?><?= $Page->fundingsource_description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->fundingsource_description->cellAttributes() ?>>
<span id="el_funding_sources_fundingsource_description">
<textarea data-table="funding_sources" data-field="x_fundingsource_description" name="x_fundingsource_description" id="x_fundingsource_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->fundingsource_description->getPlaceHolder()) ?>"<?= $Page->fundingsource_description->editAttributes() ?> aria-describedby="x_fundingsource_description_help"><?= $Page->fundingsource_description->EditValue ?></textarea>
<?= $Page->fundingsource_description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->fundingsource_description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->slug->Visible) { // slug ?>
    <div id="r_slug"<?= $Page->slug->rowAttributes() ?>>
        <label id="elh_funding_sources_slug" for="x_slug" class="<?= $Page->LeftColumnClass ?>"><?= $Page->slug->caption() ?><?= $Page->slug->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->slug->cellAttributes() ?>>
<span id="el_funding_sources_slug">
<input type="<?= $Page->slug->getInputTextType() ?>" name="x_slug" id="x_slug" data-table="funding_sources" data-field="x_slug" value="<?= $Page->slug->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->slug->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->slug->formatPattern()) ?>"<?= $Page->slug->editAttributes() ?> aria-describedby="x_slug_help">
<?= $Page->slug->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->slug->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="ffunding_sourcesedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="ffunding_sourcesedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("funding_sources");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
