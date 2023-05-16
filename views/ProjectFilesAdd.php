<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ProjectFilesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { project_files: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fproject_filesadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fproject_filesadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["project_id", [fields.project_id.visible && fields.project_id.required ? ew.Validators.required(fields.project_id.caption) : null], fields.project_id.isInvalid],
            ["file_name", [fields.file_name.visible && fields.file_name.required ? ew.Validators.required(fields.file_name.caption) : null], fields.file_name.isInvalid],
            ["file_path", [fields.file_path.visible && fields.file_path.required ? ew.Validators.fileRequired(fields.file_path.caption) : null], fields.file_path.isInvalid],
            ["file_info", [fields.file_info.visible && fields.file_info.required ? ew.Validators.required(fields.file_info.caption) : null], fields.file_info.isInvalid],
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
            "project_id": <?= $Page->project_id->toClientList($Page) ?>,
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
<form name="fproject_filesadd" id="fproject_filesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="project_files">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "projects") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="projects">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->project_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->project_id->Visible) { // project_id ?>
    <div id="r_project_id"<?= $Page->project_id->rowAttributes() ?>>
        <label id="elh_project_files_project_id" for="x_project_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->project_id->caption() ?><?= $Page->project_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->project_id->cellAttributes() ?>>
<?php if ($Page->project_id->getSessionValue() != "") { ?>
<span<?= $Page->project_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->project_id->getDisplayValue($Page->project_id->ViewValue) ?></span></span>
<input type="hidden" id="x_project_id" name="x_project_id" value="<?= HtmlEncode($Page->project_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_project_files_project_id">
    <select
        id="x_project_id"
        name="x_project_id"
        class="form-select ew-select<?= $Page->project_id->isInvalidClass() ?>"
        <?php if (!$Page->project_id->IsNativeSelect) { ?>
        data-select2-id="fproject_filesadd_x_project_id"
        <?php } ?>
        data-table="project_files"
        data-field="x_project_id"
        data-value-separator="<?= $Page->project_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->project_id->getPlaceHolder()) ?>"
        <?= $Page->project_id->editAttributes() ?>>
        <?= $Page->project_id->selectOptionListHtml("x_project_id") ?>
    </select>
    <?= $Page->project_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->project_id->getErrorMessage() ?></div>
<?= $Page->project_id->Lookup->getParamTag($Page, "p_x_project_id") ?>
<?php if (!$Page->project_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fproject_filesadd", function() {
    var options = { name: "x_project_id", selectId: "fproject_filesadd_x_project_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fproject_filesadd.lists.project_id?.lookupOptions.length) {
        options.data = { id: "x_project_id", form: "fproject_filesadd" };
    } else {
        options.ajax = { id: "x_project_id", form: "fproject_filesadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.project_files.fields.project_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->file_name->Visible) { // file_name ?>
    <div id="r_file_name"<?= $Page->file_name->rowAttributes() ?>>
        <label id="elh_project_files_file_name" for="x_file_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->file_name->caption() ?><?= $Page->file_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->file_name->cellAttributes() ?>>
<span id="el_project_files_file_name">
<input type="<?= $Page->file_name->getInputTextType() ?>" name="x_file_name" id="x_file_name" data-table="project_files" data-field="x_file_name" value="<?= $Page->file_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->file_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->file_name->formatPattern()) ?>"<?= $Page->file_name->editAttributes() ?> aria-describedby="x_file_name_help">
<?= $Page->file_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->file_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->file_path->Visible) { // file_path ?>
    <div id="r_file_path"<?= $Page->file_path->rowAttributes() ?>>
        <label id="elh_project_files_file_path" class="<?= $Page->LeftColumnClass ?>"><?= $Page->file_path->caption() ?><?= $Page->file_path->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->file_path->cellAttributes() ?>>
<span id="el_project_files_file_path">
<div id="fd_x_file_path" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_file_path"
        name="x_file_path"
        class="form-control ew-file-input"
        title="<?= $Page->file_path->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="project_files"
        data-field="x_file_path"
        data-size="255"
        data-accept-file-types="<?= $Page->file_path->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->file_path->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->file_path->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_file_path_help"
        <?= ($Page->file_path->ReadOnly || $Page->file_path->Disabled) ? " disabled" : "" ?>
        <?= $Page->file_path->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
    <?= $Page->file_path->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->file_path->getErrorMessage() ?></div>
</div>
<input type="hidden" name="fn_x_file_path" id= "fn_x_file_path" value="<?= $Page->file_path->Upload->FileName ?>">
<input type="hidden" name="fa_x_file_path" id= "fa_x_file_path" value="0">
<table id="ft_x_file_path" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->file_info->Visible) { // file_info ?>
    <div id="r_file_info"<?= $Page->file_info->rowAttributes() ?>>
        <label id="elh_project_files_file_info" for="x_file_info" class="<?= $Page->LeftColumnClass ?>"><?= $Page->file_info->caption() ?><?= $Page->file_info->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->file_info->cellAttributes() ?>>
<span id="el_project_files_file_info">
<textarea data-table="project_files" data-field="x_file_info" name="x_file_info" id="x_file_info" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->file_info->getPlaceHolder()) ?>"<?= $Page->file_info->editAttributes() ?> aria-describedby="x_file_info_help"><?= $Page->file_info->EditValue ?></textarea>
<?= $Page->file_info->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->file_info->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->slug->Visible) { // slug ?>
    <div id="r_slug"<?= $Page->slug->rowAttributes() ?>>
        <label id="elh_project_files_slug" for="x_slug" class="<?= $Page->LeftColumnClass ?>"><?= $Page->slug->caption() ?><?= $Page->slug->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->slug->cellAttributes() ?>>
<span id="el_project_files_slug">
<input type="<?= $Page->slug->getInputTextType() ?>" name="x_slug" id="x_slug" data-table="project_files" data-field="x_slug" value="<?= $Page->slug->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->slug->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->slug->formatPattern()) ?>"<?= $Page->slug->editAttributes() ?> aria-describedby="x_slug_help">
<?= $Page->slug->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->slug->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fproject_filesadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fproject_filesadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("project_files");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
