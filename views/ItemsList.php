<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ItemsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { items: currentTable } });
var currentPageID = ew.PAGE_ID = "list";
var currentForm;
var <?= $Page->FormName ?>;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("<?= $Page->FormName ?>")
        .setPageId("list")
        .setSubmitWithFetch(<?= $Page->UseAjaxActions ? "true" : "false" ?>)
        .setFormKeyCountName("<?= $Page->FormKeyCountName ?>")
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
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<form name="fitemssrch" id="fitemssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="fitemssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { items: currentTable } });
var currentForm;
var fitemssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fitemssrch")
        .setPageId("list")
<?php if ($Page->UseAjaxActions) { ?>
        .setSubmitWithFetch(true)
<?php } ?>

        // Dynamic selection lists
        .setLists({
        })

        // Filters
        .setFilterList(<?= $Page->getFilterList() ?>)
        .build();
    window[form.id] = form;
    currentSearchForm = form;
    loadjs.done(form.id);
});
</script>
<input type="hidden" name="cmd" value="search">
<?php if (!$Page->isExport() && !($Page->CurrentAction && $Page->CurrentAction != "search") && $Page->hasSearchFields()) { ?>
<div class="ew-extended-search container-fluid ps-2">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fitemssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fitemssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fitemssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fitemssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
<?php } ?>
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="list<?= ($Page->TotalRecords == 0 && !$Page->isAdd()) ? " ew-no-record" : "" ?>">
<div id="ew-list">
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Page->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Page->TableGridClass ?>">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
</div>
<?php } ?>
<form name="<?= $Page->FormName ?>" id="<?= $Page->FormName ?>" class="ew-form ew-list-form" action="<?= $Page->PageAction ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="items">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_items" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_itemslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_items_id" class="items_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
        <th data-name="company_id" class="<?= $Page->company_id->headerCellClass() ?>"><div id="elh_items_company_id" class="items_company_id"><?= $Page->renderFieldHeader($Page->company_id) ?></div></th>
<?php } ?>
<?php if ($Page->departement_id->Visible) { // departement_id ?>
        <th data-name="departement_id" class="<?= $Page->departement_id->headerCellClass() ?>"><div id="elh_items_departement_id" class="items_departement_id"><?= $Page->renderFieldHeader($Page->departement_id) ?></div></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th data-name="name" class="<?= $Page->name->headerCellClass() ?>"><div id="elh_items_name" class="items_name"><?= $Page->renderFieldHeader($Page->name) ?></div></th>
<?php } ?>
<?php if ($Page->sale_price->Visible) { // sale_price ?>
        <th data-name="sale_price" class="<?= $Page->sale_price->headerCellClass() ?>"><div id="elh_items_sale_price" class="items_sale_price"><?= $Page->renderFieldHeader($Page->sale_price) ?></div></th>
<?php } ?>
<?php if ($Page->purchase_price->Visible) { // purchase_price ?>
        <th data-name="purchase_price" class="<?= $Page->purchase_price->headerCellClass() ?>"><div id="elh_items_purchase_price" class="items_purchase_price"><?= $Page->renderFieldHeader($Page->purchase_price) ?></div></th>
<?php } ?>
<?php if ($Page->tax_id->Visible) { // tax_id ?>
        <th data-name="tax_id" class="<?= $Page->tax_id->headerCellClass() ?>"><div id="elh_items_tax_id" class="items_tax_id"><?= $Page->renderFieldHeader($Page->tax_id) ?></div></th>
<?php } ?>
<?php if ($Page->enabled->Visible) { // enabled ?>
        <th data-name="enabled" class="<?= $Page->enabled->headerCellClass() ?>"><div id="elh_items_enabled" class="items_enabled"><?= $Page->renderFieldHeader($Page->enabled) ?></div></th>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
        <th data-name="created_from" class="<?= $Page->created_from->headerCellClass() ?>"><div id="elh_items_created_from" class="items_created_from"><?= $Page->renderFieldHeader($Page->created_from) ?></div></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th data-name="created_by" class="<?= $Page->created_by->headerCellClass() ?>"><div id="elh_items_created_by" class="items_created_by"><?= $Page->renderFieldHeader($Page->created_by) ?></div></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th data-name="created_at" class="<?= $Page->created_at->headerCellClass() ?>"><div id="elh_items_created_at" class="items_created_at"><?= $Page->renderFieldHeader($Page->created_at) ?></div></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th data-name="updated_at" class="<?= $Page->updated_at->headerCellClass() ?>"><div id="elh_items_updated_at" class="items_updated_at"><?= $Page->renderFieldHeader($Page->updated_at) ?></div></th>
<?php } ?>
<?php if ($Page->deleted_at->Visible) { // deleted_at ?>
        <th data-name="deleted_at" class="<?= $Page->deleted_at->headerCellClass() ?>"><div id="elh_items_deleted_at" class="items_deleted_at"><?= $Page->renderFieldHeader($Page->deleted_at) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Page->getPageNumber() ?>">
<?php
$Page->setupGrid();
while ($Page->RecordCount < $Page->StopRecord || $Page->RowIndex === '$rowindex$') {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->setupRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_items_id" class="el_items_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->company_id->Visible) { // company_id ?>
        <td data-name="company_id"<?= $Page->company_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_items_company_id" class="el_items_company_id">
<span<?= $Page->company_id->viewAttributes() ?>>
<?= $Page->company_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->departement_id->Visible) { // departement_id ?>
        <td data-name="departement_id"<?= $Page->departement_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_items_departement_id" class="el_items_departement_id">
<span<?= $Page->departement_id->viewAttributes() ?>>
<?= $Page->departement_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->name->Visible) { // name ?>
        <td data-name="name"<?= $Page->name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_items_name" class="el_items_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sale_price->Visible) { // sale_price ?>
        <td data-name="sale_price"<?= $Page->sale_price->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_items_sale_price" class="el_items_sale_price">
<span<?= $Page->sale_price->viewAttributes() ?>>
<?= $Page->sale_price->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->purchase_price->Visible) { // purchase_price ?>
        <td data-name="purchase_price"<?= $Page->purchase_price->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_items_purchase_price" class="el_items_purchase_price">
<span<?= $Page->purchase_price->viewAttributes() ?>>
<?= $Page->purchase_price->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tax_id->Visible) { // tax_id ?>
        <td data-name="tax_id"<?= $Page->tax_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_items_tax_id" class="el_items_tax_id">
<span<?= $Page->tax_id->viewAttributes() ?>>
<?= $Page->tax_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->enabled->Visible) { // enabled ?>
        <td data-name="enabled"<?= $Page->enabled->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_items_enabled" class="el_items_enabled">
<span<?= $Page->enabled->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_enabled_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->enabled->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->enabled->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_enabled_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_from->Visible) { // created_from ?>
        <td data-name="created_from"<?= $Page->created_from->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_items_created_from" class="el_items_created_from">
<span<?= $Page->created_from->viewAttributes() ?>>
<?= $Page->created_from->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_by->Visible) { // created_by ?>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_items_created_by" class="el_items_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_at->Visible) { // created_at ?>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_items_created_at" class="el_items_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_items_updated_at" class="el_items_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->deleted_at->Visible) { // deleted_at ?>
        <td data-name="deleted_at"<?= $Page->deleted_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_items_deleted_at" class="el_items_deleted_at">
<span<?= $Page->deleted_at->viewAttributes() ?>>
<?= $Page->deleted_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (
        $Page->Recordset &&
        !$Page->Recordset->EOF &&
        $Page->RowIndex !== '$rowindex$' &&
        (!$Page->isGridAdd() || $Page->CurrentMode == "copy") &&
        (!(($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0))
    ) {
        $Page->Recordset->moveNext();
    }
    // Reset for template row
    if ($Page->RowIndex === '$rowindex$') {
        $Page->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Page->isCopy() || $Page->isAdd()) && $Page->RowIndex == 0) {
        $Page->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction && !$Page->UseAjaxActions) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd() && !($Page->isGridEdit() && $Page->ModalGridEdit) && !$Page->isMultiEdit()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("items");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
