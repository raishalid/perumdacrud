<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$BeritasDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { beritas: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fberitasdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fberitasdelete")
        .setPageId("delete")
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
<form name="fberitasdelete" id="fberitasdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="beritas">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid <?= $Page->TableGridClass ?>">
<div class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<table class="<?= $Page->TableClass ?>">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_beritas_id" class="beritas_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->judul->Visible) { // judul ?>
        <th class="<?= $Page->judul->headerCellClass() ?>"><span id="elh_beritas_judul" class="beritas_judul"><?= $Page->judul->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kategori_berita_id->Visible) { // kategori_berita_id ?>
        <th class="<?= $Page->kategori_berita_id->headerCellClass() ?>"><span id="elh_beritas_kategori_berita_id" class="beritas_kategori_berita_id"><?= $Page->kategori_berita_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tanggal_terbit->Visible) { // tanggal_terbit ?>
        <th class="<?= $Page->tanggal_terbit->headerCellClass() ?>"><span id="elh_beritas_tanggal_terbit" class="beritas_tanggal_terbit"><?= $Page->tanggal_terbit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->author->Visible) { // author ?>
        <th class="<?= $Page->author->headerCellClass() ?>"><span id="elh_beritas_author" class="beritas_author"><?= $Page->author->caption() ?></span></th>
<?php } ?>
<?php if ($Page->headline->Visible) { // headline ?>
        <th class="<?= $Page->headline->headerCellClass() ?>"><span id="elh_beritas_headline" class="beritas_headline"><?= $Page->headline->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_beritas_created_at" class="beritas_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->judul->Visible) { // judul ?>
        <td<?= $Page->judul->cellAttributes() ?>>
<span id="">
<span<?= $Page->judul->viewAttributes() ?>>
<?= $Page->judul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kategori_berita_id->Visible) { // kategori_berita_id ?>
        <td<?= $Page->kategori_berita_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->kategori_berita_id->viewAttributes() ?>>
<?= $Page->kategori_berita_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tanggal_terbit->Visible) { // tanggal_terbit ?>
        <td<?= $Page->tanggal_terbit->cellAttributes() ?>>
<span id="">
<span<?= $Page->tanggal_terbit->viewAttributes() ?>>
<?= $Page->tanggal_terbit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->author->Visible) { // author ?>
        <td<?= $Page->author->cellAttributes() ?>>
<span id="">
<span<?= $Page->author->viewAttributes() ?>>
<?= $Page->author->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->headline->Visible) { // headline ?>
        <td<?= $Page->headline->cellAttributes() ?>>
<span id="">
<span<?= $Page->headline->viewAttributes() ?>>
<?= $Page->headline->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <td<?= $Page->created_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div class="ew-buttons ew-desktop-buttons">
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
