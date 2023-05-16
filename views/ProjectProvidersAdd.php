<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ProjectProvidersAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { project_providers: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fproject_providersadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fproject_providersadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["provider_name", [fields.provider_name.visible && fields.provider_name.required ? ew.Validators.required(fields.provider_name.caption) : null], fields.provider_name.isInvalid],
            ["provider_info", [fields.provider_info.visible && fields.provider_info.required ? ew.Validators.required(fields.provider_info.caption) : null], fields.provider_info.isInvalid],
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
<form name="fproject_providersadd" id="fproject_providersadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="project_providers">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->provider_name->Visible) { // provider_name ?>
    <div id="r_provider_name"<?= $Page->provider_name->rowAttributes() ?>>
        <label id="elh_project_providers_provider_name" for="x_provider_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->provider_name->caption() ?><?= $Page->provider_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->provider_name->cellAttributes() ?>>
<span id="el_project_providers_provider_name">
<input type="<?= $Page->provider_name->getInputTextType() ?>" name="x_provider_name" id="x_provider_name" data-table="project_providers" data-field="x_provider_name" value="<?= $Page->provider_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->provider_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->provider_name->formatPattern()) ?>"<?= $Page->provider_name->editAttributes() ?> aria-describedby="x_provider_name_help">
<?= $Page->provider_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->provider_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->provider_info->Visible) { // provider_info ?>
    <div id="r_provider_info"<?= $Page->provider_info->rowAttributes() ?>>
        <label id="elh_project_providers_provider_info" for="x_provider_info" class="<?= $Page->LeftColumnClass ?>"><?= $Page->provider_info->caption() ?><?= $Page->provider_info->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->provider_info->cellAttributes() ?>>
<span id="el_project_providers_provider_info">
<textarea data-table="project_providers" data-field="x_provider_info" name="x_provider_info" id="x_provider_info" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->provider_info->getPlaceHolder()) ?>"<?= $Page->provider_info->editAttributes() ?> aria-describedby="x_provider_info_help"><?= $Page->provider_info->EditValue ?></textarea>
<?= $Page->provider_info->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->provider_info->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->slug->Visible) { // slug ?>
    <div id="r_slug"<?= $Page->slug->rowAttributes() ?>>
        <label id="elh_project_providers_slug" for="x_slug" class="<?= $Page->LeftColumnClass ?>"><?= $Page->slug->caption() ?><?= $Page->slug->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->slug->cellAttributes() ?>>
<span id="el_project_providers_slug">
<input type="<?= $Page->slug->getInputTextType() ?>" name="x_slug" id="x_slug" data-table="project_providers" data-field="x_slug" value="<?= $Page->slug->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->slug->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->slug->formatPattern()) ?>"<?= $Page->slug->editAttributes() ?> aria-describedby="x_slug_help">
<?= $Page->slug->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->slug->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fproject_providersadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fproject_providersadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("project_providers");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
