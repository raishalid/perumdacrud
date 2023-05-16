<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$BeritasEdit = &$Page;
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
<form name="fberitasedit" id="fberitasedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { beritas: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fberitasedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fberitasedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["judul", [fields.judul.visible && fields.judul.required ? ew.Validators.required(fields.judul.caption) : null], fields.judul.isInvalid],
            ["kategori_berita_id", [fields.kategori_berita_id.visible && fields.kategori_berita_id.required ? ew.Validators.required(fields.kategori_berita_id.caption) : null], fields.kategori_berita_id.isInvalid],
            ["tanggal_terbit", [fields.tanggal_terbit.visible && fields.tanggal_terbit.required ? ew.Validators.required(fields.tanggal_terbit.caption) : null, ew.Validators.datetime(fields.tanggal_terbit.clientFormatPattern)], fields.tanggal_terbit.isInvalid],
            ["excerpts", [fields.excerpts.visible && fields.excerpts.required ? ew.Validators.required(fields.excerpts.caption) : null], fields.excerpts.isInvalid],
            ["slug", [fields.slug.visible && fields.slug.required ? ew.Validators.required(fields.slug.caption) : null], fields.slug.isInvalid],
            ["author", [fields.author.visible && fields.author.required ? ew.Validators.required(fields.author.caption) : null], fields.author.isInvalid],
            ["isi_berita", [fields.isi_berita.visible && fields.isi_berita.required ? ew.Validators.required(fields.isi_berita.caption) : null], fields.isi_berita.isInvalid],
            ["gbr_berita", [fields.gbr_berita.visible && fields.gbr_berita.required ? ew.Validators.fileRequired(fields.gbr_berita.caption) : null], fields.gbr_berita.isInvalid],
            ["headline", [fields.headline.visible && fields.headline.required ? ew.Validators.required(fields.headline.caption) : null], fields.headline.isInvalid],
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
            "kategori_berita_id": <?= $Page->kategori_berita_id->toClientList($Page) ?>,
            "headline": <?= $Page->headline->toClientList($Page) ?>,
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
<input type="hidden" name="t" value="beritas">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_beritas_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_beritas_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="beritas" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->judul->Visible) { // judul ?>
    <div id="r_judul"<?= $Page->judul->rowAttributes() ?>>
        <label id="elh_beritas_judul" for="x_judul" class="<?= $Page->LeftColumnClass ?>"><?= $Page->judul->caption() ?><?= $Page->judul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->judul->cellAttributes() ?>>
<span id="el_beritas_judul">
<input type="<?= $Page->judul->getInputTextType() ?>" name="x_judul" id="x_judul" data-table="beritas" data-field="x_judul" value="<?= $Page->judul->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->judul->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->judul->formatPattern()) ?>"<?= $Page->judul->editAttributes() ?> aria-describedby="x_judul_help">
<?= $Page->judul->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->judul->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kategori_berita_id->Visible) { // kategori_berita_id ?>
    <div id="r_kategori_berita_id"<?= $Page->kategori_berita_id->rowAttributes() ?>>
        <label id="elh_beritas_kategori_berita_id" for="x_kategori_berita_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kategori_berita_id->caption() ?><?= $Page->kategori_berita_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kategori_berita_id->cellAttributes() ?>>
<span id="el_beritas_kategori_berita_id">
    <select
        id="x_kategori_berita_id"
        name="x_kategori_berita_id"
        class="form-select ew-select<?= $Page->kategori_berita_id->isInvalidClass() ?>"
        <?php if (!$Page->kategori_berita_id->IsNativeSelect) { ?>
        data-select2-id="fberitasedit_x_kategori_berita_id"
        <?php } ?>
        data-table="beritas"
        data-field="x_kategori_berita_id"
        data-value-separator="<?= $Page->kategori_berita_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->kategori_berita_id->getPlaceHolder()) ?>"
        <?= $Page->kategori_berita_id->editAttributes() ?>>
        <?= $Page->kategori_berita_id->selectOptionListHtml("x_kategori_berita_id") ?>
    </select>
    <?= $Page->kategori_berita_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->kategori_berita_id->getErrorMessage() ?></div>
<?= $Page->kategori_berita_id->Lookup->getParamTag($Page, "p_x_kategori_berita_id") ?>
<?php if (!$Page->kategori_berita_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fberitasedit", function() {
    var options = { name: "x_kategori_berita_id", selectId: "fberitasedit_x_kategori_berita_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fberitasedit.lists.kategori_berita_id?.lookupOptions.length) {
        options.data = { id: "x_kategori_berita_id", form: "fberitasedit" };
    } else {
        options.ajax = { id: "x_kategori_berita_id", form: "fberitasedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.beritas.fields.kategori_berita_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tanggal_terbit->Visible) { // tanggal_terbit ?>
    <div id="r_tanggal_terbit"<?= $Page->tanggal_terbit->rowAttributes() ?>>
        <label id="elh_beritas_tanggal_terbit" for="x_tanggal_terbit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tanggal_terbit->caption() ?><?= $Page->tanggal_terbit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tanggal_terbit->cellAttributes() ?>>
<span id="el_beritas_tanggal_terbit">
<input type="<?= $Page->tanggal_terbit->getInputTextType() ?>" name="x_tanggal_terbit" id="x_tanggal_terbit" data-table="beritas" data-field="x_tanggal_terbit" value="<?= $Page->tanggal_terbit->EditValue ?>" placeholder="<?= HtmlEncode($Page->tanggal_terbit->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->tanggal_terbit->formatPattern()) ?>"<?= $Page->tanggal_terbit->editAttributes() ?> aria-describedby="x_tanggal_terbit_help">
<?= $Page->tanggal_terbit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tanggal_terbit->getErrorMessage() ?></div>
<?php if (!$Page->tanggal_terbit->ReadOnly && !$Page->tanggal_terbit->Disabled && !isset($Page->tanggal_terbit->EditAttrs["readonly"]) && !isset($Page->tanggal_terbit->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fberitasedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fberitasedit", "x_tanggal_terbit", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->excerpts->Visible) { // excerpts ?>
    <div id="r_excerpts"<?= $Page->excerpts->rowAttributes() ?>>
        <label id="elh_beritas_excerpts" for="x_excerpts" class="<?= $Page->LeftColumnClass ?>"><?= $Page->excerpts->caption() ?><?= $Page->excerpts->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->excerpts->cellAttributes() ?>>
<span id="el_beritas_excerpts">
<textarea data-table="beritas" data-field="x_excerpts" name="x_excerpts" id="x_excerpts" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->excerpts->getPlaceHolder()) ?>"<?= $Page->excerpts->editAttributes() ?> aria-describedby="x_excerpts_help"><?= $Page->excerpts->EditValue ?></textarea>
<?= $Page->excerpts->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->excerpts->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->slug->Visible) { // slug ?>
    <div id="r_slug"<?= $Page->slug->rowAttributes() ?>>
        <label id="elh_beritas_slug" for="x_slug" class="<?= $Page->LeftColumnClass ?>"><?= $Page->slug->caption() ?><?= $Page->slug->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->slug->cellAttributes() ?>>
<span id="el_beritas_slug">
<input type="<?= $Page->slug->getInputTextType() ?>" name="x_slug" id="x_slug" data-table="beritas" data-field="x_slug" value="<?= $Page->slug->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->slug->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->slug->formatPattern()) ?>"<?= $Page->slug->editAttributes() ?> aria-describedby="x_slug_help">
<?= $Page->slug->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->slug->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->author->Visible) { // author ?>
    <div id="r_author"<?= $Page->author->rowAttributes() ?>>
        <label id="elh_beritas_author" for="x_author" class="<?= $Page->LeftColumnClass ?>"><?= $Page->author->caption() ?><?= $Page->author->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->author->cellAttributes() ?>>
<span id="el_beritas_author">
<input type="<?= $Page->author->getInputTextType() ?>" name="x_author" id="x_author" data-table="beritas" data-field="x_author" value="<?= $Page->author->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->author->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->author->formatPattern()) ?>"<?= $Page->author->editAttributes() ?> aria-describedby="x_author_help">
<?= $Page->author->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->author->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->isi_berita->Visible) { // isi_berita ?>
    <div id="r_isi_berita"<?= $Page->isi_berita->rowAttributes() ?>>
        <label id="elh_beritas_isi_berita" class="<?= $Page->LeftColumnClass ?>"><?= $Page->isi_berita->caption() ?><?= $Page->isi_berita->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->isi_berita->cellAttributes() ?>>
<span id="el_beritas_isi_berita">
<?php $Page->isi_berita->EditAttrs->appendClass("editor"); ?>
<textarea data-table="beritas" data-field="x_isi_berita" name="x_isi_berita" id="x_isi_berita" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->isi_berita->getPlaceHolder()) ?>"<?= $Page->isi_berita->editAttributes() ?> aria-describedby="x_isi_berita_help"><?= $Page->isi_berita->EditValue ?></textarea>
<?= $Page->isi_berita->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->isi_berita->getErrorMessage() ?></div>
<script>
loadjs.ready(["fberitasedit", "editor"], function() {
    ew.createEditor("fberitasedit", "x_isi_berita", 35, 4, <?= $Page->isi_berita->ReadOnly || false ? "true" : "false" ?>);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gbr_berita->Visible) { // gbr_berita ?>
    <div id="r_gbr_berita"<?= $Page->gbr_berita->rowAttributes() ?>>
        <label id="elh_beritas_gbr_berita" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gbr_berita->caption() ?><?= $Page->gbr_berita->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gbr_berita->cellAttributes() ?>>
<span id="el_beritas_gbr_berita">
<div id="fd_x_gbr_berita" class="fileinput-button ew-file-drop-zone">
    <input
        type="file"
        id="x_gbr_berita"
        name="x_gbr_berita"
        class="form-control ew-file-input"
        title="<?= $Page->gbr_berita->title() ?>"
        lang="<?= CurrentLanguageID() ?>"
        data-table="beritas"
        data-field="x_gbr_berita"
        data-size="65535"
        data-accept-file-types="<?= $Page->gbr_berita->acceptFileTypes() ?>"
        data-max-file-size="<?= $Page->gbr_berita->UploadMaxFileSize ?>"
        data-max-number-of-files="null"
        data-disable-image-crop="<?= $Page->gbr_berita->ImageCropper ? 0 : 1 ?>"
        aria-describedby="x_gbr_berita_help"
        <?= ($Page->gbr_berita->ReadOnly || $Page->gbr_berita->Disabled) ? " disabled" : "" ?>
        <?= $Page->gbr_berita->editAttributes() ?>
    >
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
    <?= $Page->gbr_berita->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->gbr_berita->getErrorMessage() ?></div>
</div>
<input type="hidden" name="fn_x_gbr_berita" id= "fn_x_gbr_berita" value="<?= $Page->gbr_berita->Upload->FileName ?>">
<input type="hidden" name="fa_x_gbr_berita" id= "fa_x_gbr_berita" value="<?= (Post("fa_x_gbr_berita") == "0") ? "0" : "1" ?>">
<table id="ft_x_gbr_berita" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->headline->Visible) { // headline ?>
    <div id="r_headline"<?= $Page->headline->rowAttributes() ?>>
        <label id="elh_beritas_headline" class="<?= $Page->LeftColumnClass ?>"><?= $Page->headline->caption() ?><?= $Page->headline->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->headline->cellAttributes() ?>>
<span id="el_beritas_headline">
<template id="tp_x_headline">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="beritas" data-field="x_headline" name="x_headline" id="x_headline"<?= $Page->headline->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_headline" class="ew-item-list"></div>
<selection-list hidden
    id="x_headline"
    name="x_headline"
    value="<?= HtmlEncode($Page->headline->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_headline"
    data-target="dsl_x_headline"
    data-repeatcolumn="5"
    class="form-control<?= $Page->headline->isInvalidClass() ?>"
    data-table="beritas"
    data-field="x_headline"
    data-value-separator="<?= $Page->headline->displayValueSeparatorAttribute() ?>"
    <?= $Page->headline->editAttributes() ?>></selection-list>
<?= $Page->headline->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->headline->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fberitasedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fberitasedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("beritas");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
