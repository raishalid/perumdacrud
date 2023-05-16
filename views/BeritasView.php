<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$BeritasView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<form name="fberitasview" id="fberitasview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { beritas: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fberitasview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fberitasview")
        .setPageId("view")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="beritas">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_beritas_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_beritas_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->judul->Visible) { // judul ?>
    <tr id="r_judul"<?= $Page->judul->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_beritas_judul"><?= $Page->judul->caption() ?></span></td>
        <td data-name="judul"<?= $Page->judul->cellAttributes() ?>>
<span id="el_beritas_judul">
<span<?= $Page->judul->viewAttributes() ?>>
<?= $Page->judul->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kategori_berita_id->Visible) { // kategori_berita_id ?>
    <tr id="r_kategori_berita_id"<?= $Page->kategori_berita_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_beritas_kategori_berita_id"><?= $Page->kategori_berita_id->caption() ?></span></td>
        <td data-name="kategori_berita_id"<?= $Page->kategori_berita_id->cellAttributes() ?>>
<span id="el_beritas_kategori_berita_id">
<span<?= $Page->kategori_berita_id->viewAttributes() ?>>
<?= $Page->kategori_berita_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tanggal_terbit->Visible) { // tanggal_terbit ?>
    <tr id="r_tanggal_terbit"<?= $Page->tanggal_terbit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_beritas_tanggal_terbit"><?= $Page->tanggal_terbit->caption() ?></span></td>
        <td data-name="tanggal_terbit"<?= $Page->tanggal_terbit->cellAttributes() ?>>
<span id="el_beritas_tanggal_terbit">
<span<?= $Page->tanggal_terbit->viewAttributes() ?>>
<?= $Page->tanggal_terbit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->excerpts->Visible) { // excerpts ?>
    <tr id="r_excerpts"<?= $Page->excerpts->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_beritas_excerpts"><?= $Page->excerpts->caption() ?></span></td>
        <td data-name="excerpts"<?= $Page->excerpts->cellAttributes() ?>>
<span id="el_beritas_excerpts">
<span<?= $Page->excerpts->viewAttributes() ?>>
<?= $Page->excerpts->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->slug->Visible) { // slug ?>
    <tr id="r_slug"<?= $Page->slug->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_beritas_slug"><?= $Page->slug->caption() ?></span></td>
        <td data-name="slug"<?= $Page->slug->cellAttributes() ?>>
<span id="el_beritas_slug">
<span<?= $Page->slug->viewAttributes() ?>>
<?= $Page->slug->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->author->Visible) { // author ?>
    <tr id="r_author"<?= $Page->author->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_beritas_author"><?= $Page->author->caption() ?></span></td>
        <td data-name="author"<?= $Page->author->cellAttributes() ?>>
<span id="el_beritas_author">
<span<?= $Page->author->viewAttributes() ?>>
<?= $Page->author->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->isi_berita->Visible) { // isi_berita ?>
    <tr id="r_isi_berita"<?= $Page->isi_berita->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_beritas_isi_berita"><?= $Page->isi_berita->caption() ?></span></td>
        <td data-name="isi_berita"<?= $Page->isi_berita->cellAttributes() ?>>
<span id="el_beritas_isi_berita">
<span<?= $Page->isi_berita->viewAttributes() ?>>
<?= $Page->isi_berita->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gbr_berita->Visible) { // gbr_berita ?>
    <tr id="r_gbr_berita"<?= $Page->gbr_berita->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_beritas_gbr_berita"><?= $Page->gbr_berita->caption() ?></span></td>
        <td data-name="gbr_berita"<?= $Page->gbr_berita->cellAttributes() ?>>
<span id="el_beritas_gbr_berita">
<span>
<?= GetFileViewTag($Page->gbr_berita, $Page->gbr_berita->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->headline->Visible) { // headline ?>
    <tr id="r_headline"<?= $Page->headline->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_beritas_headline"><?= $Page->headline->caption() ?></span></td>
        <td data-name="headline"<?= $Page->headline->cellAttributes() ?>>
<span id="el_beritas_headline">
<span<?= $Page->headline->viewAttributes() ?>>
<?= $Page->headline->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_beritas_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_beritas_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_beritas_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_beritas_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
