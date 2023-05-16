<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$SectorsEdit = &$Page;
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
<form name="fsectorsedit" id="fsectorsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { sectors: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fsectorsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsectorsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["sector_category_id", [fields.sector_category_id.visible && fields.sector_category_id.required ? ew.Validators.required(fields.sector_category_id.caption) : null], fields.sector_category_id.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["slug", [fields.slug.visible && fields.slug.required ? ew.Validators.required(fields.slug.caption) : null], fields.slug.isInvalid],
            ["anak_perusahaan", [fields.anak_perusahaan.visible && fields.anak_perusahaan.required ? ew.Validators.required(fields.anak_perusahaan.caption) : null], fields.anak_perusahaan.isInvalid],
            ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
            ["html_content", [fields.html_content.visible && fields.html_content.required ? ew.Validators.required(fields.html_content.caption) : null], fields.html_content.isInvalid],
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
            "sector_category_id": <?= $Page->sector_category_id->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="sectors">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_sectors_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_sectors_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="sectors" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sector_category_id->Visible) { // sector_category_id ?>
    <div id="r_sector_category_id"<?= $Page->sector_category_id->rowAttributes() ?>>
        <label id="elh_sectors_sector_category_id" for="x_sector_category_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sector_category_id->caption() ?><?= $Page->sector_category_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sector_category_id->cellAttributes() ?>>
<span id="el_sectors_sector_category_id">
    <select
        id="x_sector_category_id"
        name="x_sector_category_id"
        class="form-select ew-select<?= $Page->sector_category_id->isInvalidClass() ?>"
        <?php if (!$Page->sector_category_id->IsNativeSelect) { ?>
        data-select2-id="fsectorsedit_x_sector_category_id"
        <?php } ?>
        data-table="sectors"
        data-field="x_sector_category_id"
        data-value-separator="<?= $Page->sector_category_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->sector_category_id->getPlaceHolder()) ?>"
        <?= $Page->sector_category_id->editAttributes() ?>>
        <?= $Page->sector_category_id->selectOptionListHtml("x_sector_category_id") ?>
    </select>
    <?= $Page->sector_category_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->sector_category_id->getErrorMessage() ?></div>
<?= $Page->sector_category_id->Lookup->getParamTag($Page, "p_x_sector_category_id") ?>
<?php if (!$Page->sector_category_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fsectorsedit", function() {
    var options = { name: "x_sector_category_id", selectId: "fsectorsedit_x_sector_category_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fsectorsedit.lists.sector_category_id?.lookupOptions.length) {
        options.data = { id: "x_sector_category_id", form: "fsectorsedit" };
    } else {
        options.ajax = { id: "x_sector_category_id", form: "fsectorsedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.sectors.fields.sector_category_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_sectors_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_sectors_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="sectors" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->slug->Visible) { // slug ?>
    <div id="r_slug"<?= $Page->slug->rowAttributes() ?>>
        <label id="elh_sectors_slug" for="x_slug" class="<?= $Page->LeftColumnClass ?>"><?= $Page->slug->caption() ?><?= $Page->slug->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->slug->cellAttributes() ?>>
<span id="el_sectors_slug">
<span<?= $Page->slug->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->slug->getDisplayValue($Page->slug->EditValue))) ?>"></span>
<input type="hidden" data-table="sectors" data-field="x_slug" data-hidden="1" name="x_slug" id="x_slug" value="<?= HtmlEncode($Page->slug->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->anak_perusahaan->Visible) { // anak_perusahaan ?>
    <div id="r_anak_perusahaan"<?= $Page->anak_perusahaan->rowAttributes() ?>>
        <label id="elh_sectors_anak_perusahaan" for="x_anak_perusahaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->anak_perusahaan->caption() ?><?= $Page->anak_perusahaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->anak_perusahaan->cellAttributes() ?>>
<span id="el_sectors_anak_perusahaan">
<input type="<?= $Page->anak_perusahaan->getInputTextType() ?>" name="x_anak_perusahaan" id="x_anak_perusahaan" data-table="sectors" data-field="x_anak_perusahaan" value="<?= $Page->anak_perusahaan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->anak_perusahaan->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->anak_perusahaan->formatPattern()) ?>"<?= $Page->anak_perusahaan->editAttributes() ?> aria-describedby="x_anak_perusahaan_help">
<?= $Page->anak_perusahaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->anak_perusahaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_sectors_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_sectors_description">
<?php $Page->description->EditAttrs->appendClass("editor"); ?>
<textarea data-table="sectors" data-field="x_description" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help"><?= $Page->description->EditValue ?></textarea>
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
<script>
loadjs.ready(["fsectorsedit", "editor"], function() {
    ew.createEditor("fsectorsedit", "x_description", 35, 4, <?= $Page->description->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->html_content->Visible) { // html_content ?>
    <div id="r_html_content"<?= $Page->html_content->rowAttributes() ?>>
        <label id="elh_sectors_html_content" for="x_html_content" class="<?= $Page->LeftColumnClass ?>"><?= $Page->html_content->caption() ?><?= $Page->html_content->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->html_content->cellAttributes() ?>>
<span id="el_sectors_html_content">
<textarea data-table="sectors" data-field="x_html_content" name="x_html_content" id="x_html_content" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->html_content->getPlaceHolder()) ?>"<?= $Page->html_content->editAttributes() ?> aria-describedby="x_html_content_help"><?= $Page->html_content->EditValue ?></textarea>
<?= $Page->html_content->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->html_content->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fsectorsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fsectorsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("sectors");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
