<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$TransactionList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transaction: currentTable } });
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
<form name="ftransactionsrch" id="ftransactionsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="ftransactionsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transaction: currentTable } });
var currentForm;
var ftransactionsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("ftransactionsrch")
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="ftransactionsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="ftransactionsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="ftransactionsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="ftransactionsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="transaction">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_transaction" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_transactionlist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_transaction_id" class="transaction_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->acc_id->Visible) { // acc_id ?>
        <th data-name="acc_id" class="<?= $Page->acc_id->headerCellClass() ?>"><div id="elh_transaction_acc_id" class="transaction_acc_id"><?= $Page->renderFieldHeader($Page->acc_id) ?></div></th>
<?php } ?>
<?php if ($Page->paid_at->Visible) { // paid_at ?>
        <th data-name="paid_at" class="<?= $Page->paid_at->headerCellClass() ?>"><div id="elh_transaction_paid_at" class="transaction_paid_at"><?= $Page->renderFieldHeader($Page->paid_at) ?></div></th>
<?php } ?>
<?php if ($Page->departement_id->Visible) { // departement_id ?>
        <th data-name="departement_id" class="<?= $Page->departement_id->headerCellClass() ?>"><div id="elh_transaction_departement_id" class="transaction_departement_id"><?= $Page->renderFieldHeader($Page->departement_id) ?></div></th>
<?php } ?>
<?php if ($Page->type_id->Visible) { // type_id ?>
        <th data-name="type_id" class="<?= $Page->type_id->headerCellClass() ?>"><div id="elh_transaction_type_id" class="transaction_type_id"><?= $Page->renderFieldHeader($Page->type_id) ?></div></th>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
        <th data-name="amount" class="<?= $Page->amount->headerCellClass() ?>"><div id="elh_transaction_amount" class="transaction_amount"><?= $Page->renderFieldHeader($Page->amount) ?></div></th>
<?php } ?>
<?php if ($Page->currency_code->Visible) { // currency_code ?>
        <th data-name="currency_code" class="<?= $Page->currency_code->headerCellClass() ?>"><div id="elh_transaction_currency_code" class="transaction_currency_code"><?= $Page->renderFieldHeader($Page->currency_code) ?></div></th>
<?php } ?>
<?php if ($Page->currency_rate->Visible) { // currency_rate ?>
        <th data-name="currency_rate" class="<?= $Page->currency_rate->headerCellClass() ?>"><div id="elh_transaction_currency_rate" class="transaction_currency_rate"><?= $Page->renderFieldHeader($Page->currency_rate) ?></div></th>
<?php } ?>
<?php if ($Page->document_id->Visible) { // document_id ?>
        <th data-name="document_id" class="<?= $Page->document_id->headerCellClass() ?>"><div id="elh_transaction_document_id" class="transaction_document_id"><?= $Page->renderFieldHeader($Page->document_id) ?></div></th>
<?php } ?>
<?php if ($Page->contact_id->Visible) { // contact_id ?>
        <th data-name="contact_id" class="<?= $Page->contact_id->headerCellClass() ?>"><div id="elh_transaction_contact_id" class="transaction_contact_id"><?= $Page->renderFieldHeader($Page->contact_id) ?></div></th>
<?php } ?>
<?php if ($Page->acc_category_id->Visible) { // acc_category_id ?>
        <th data-name="acc_category_id" class="<?= $Page->acc_category_id->headerCellClass() ?>"><div id="elh_transaction_acc_category_id" class="transaction_acc_category_id"><?= $Page->renderFieldHeader($Page->acc_category_id) ?></div></th>
<?php } ?>
<?php if ($Page->payment_method->Visible) { // payment_method ?>
        <th data-name="payment_method" class="<?= $Page->payment_method->headerCellClass() ?>"><div id="elh_transaction_payment_method" class="transaction_payment_method"><?= $Page->renderFieldHeader($Page->payment_method) ?></div></th>
<?php } ?>
<?php if ($Page->reference->Visible) { // reference ?>
        <th data-name="reference" class="<?= $Page->reference->headerCellClass() ?>"><div id="elh_transaction_reference" class="transaction_reference"><?= $Page->renderFieldHeader($Page->reference) ?></div></th>
<?php } ?>
<?php if ($Page->parent_id->Visible) { // parent_id ?>
        <th data-name="parent_id" class="<?= $Page->parent_id->headerCellClass() ?>"><div id="elh_transaction_parent_id" class="transaction_parent_id"><?= $Page->renderFieldHeader($Page->parent_id) ?></div></th>
<?php } ?>
<?php if ($Page->reconciled->Visible) { // reconciled ?>
        <th data-name="reconciled" class="<?= $Page->reconciled->headerCellClass() ?>"><div id="elh_transaction_reconciled" class="transaction_reconciled"><?= $Page->renderFieldHeader($Page->reconciled) ?></div></th>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
        <th data-name="created_from" class="<?= $Page->created_from->headerCellClass() ?>"><div id="elh_transaction_created_from" class="transaction_created_from"><?= $Page->renderFieldHeader($Page->created_from) ?></div></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th data-name="created_by" class="<?= $Page->created_by->headerCellClass() ?>"><div id="elh_transaction_created_by" class="transaction_created_by"><?= $Page->renderFieldHeader($Page->created_by) ?></div></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th data-name="created_at" class="<?= $Page->created_at->headerCellClass() ?>"><div id="elh_transaction_created_at" class="transaction_created_at"><?= $Page->renderFieldHeader($Page->created_at) ?></div></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th data-name="updated_at" class="<?= $Page->updated_at->headerCellClass() ?>"><div id="elh_transaction_updated_at" class="transaction_updated_at"><?= $Page->renderFieldHeader($Page->updated_at) ?></div></th>
<?php } ?>
<?php if ($Page->deleted_at->Visible) { // deleted_at ?>
        <th data-name="deleted_at" class="<?= $Page->deleted_at->headerCellClass() ?>"><div id="elh_transaction_deleted_at" class="transaction_deleted_at"><?= $Page->renderFieldHeader($Page->deleted_at) ?></div></th>
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
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_id" class="el_transaction_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->acc_id->Visible) { // acc_id ?>
        <td data-name="acc_id"<?= $Page->acc_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_acc_id" class="el_transaction_acc_id">
<span<?= $Page->acc_id->viewAttributes() ?>>
<?= $Page->acc_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->paid_at->Visible) { // paid_at ?>
        <td data-name="paid_at"<?= $Page->paid_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_paid_at" class="el_transaction_paid_at">
<span<?= $Page->paid_at->viewAttributes() ?>>
<?= $Page->paid_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->departement_id->Visible) { // departement_id ?>
        <td data-name="departement_id"<?= $Page->departement_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_departement_id" class="el_transaction_departement_id">
<span<?= $Page->departement_id->viewAttributes() ?>>
<?= $Page->departement_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->type_id->Visible) { // type_id ?>
        <td data-name="type_id"<?= $Page->type_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_type_id" class="el_transaction_type_id">
<span<?= $Page->type_id->viewAttributes() ?>>
<?= $Page->type_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->amount->Visible) { // amount ?>
        <td data-name="amount"<?= $Page->amount->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_amount" class="el_transaction_amount">
<span<?= $Page->amount->viewAttributes() ?>>
<?= $Page->amount->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->currency_code->Visible) { // currency_code ?>
        <td data-name="currency_code"<?= $Page->currency_code->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_currency_code" class="el_transaction_currency_code">
<span<?= $Page->currency_code->viewAttributes() ?>>
<?= $Page->currency_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->currency_rate->Visible) { // currency_rate ?>
        <td data-name="currency_rate"<?= $Page->currency_rate->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_currency_rate" class="el_transaction_currency_rate">
<span<?= $Page->currency_rate->viewAttributes() ?>>
<?= $Page->currency_rate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->document_id->Visible) { // document_id ?>
        <td data-name="document_id"<?= $Page->document_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_document_id" class="el_transaction_document_id">
<span<?= $Page->document_id->viewAttributes() ?>>
<?= $Page->document_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_id->Visible) { // contact_id ?>
        <td data-name="contact_id"<?= $Page->contact_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_contact_id" class="el_transaction_contact_id">
<span<?= $Page->contact_id->viewAttributes() ?>>
<?= $Page->contact_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->acc_category_id->Visible) { // acc_category_id ?>
        <td data-name="acc_category_id"<?= $Page->acc_category_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_acc_category_id" class="el_transaction_acc_category_id">
<span<?= $Page->acc_category_id->viewAttributes() ?>>
<?= $Page->acc_category_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->payment_method->Visible) { // payment_method ?>
        <td data-name="payment_method"<?= $Page->payment_method->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_payment_method" class="el_transaction_payment_method">
<span<?= $Page->payment_method->viewAttributes() ?>>
<?= $Page->payment_method->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->reference->Visible) { // reference ?>
        <td data-name="reference"<?= $Page->reference->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_reference" class="el_transaction_reference">
<span<?= $Page->reference->viewAttributes() ?>>
<?= $Page->reference->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->parent_id->Visible) { // parent_id ?>
        <td data-name="parent_id"<?= $Page->parent_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_parent_id" class="el_transaction_parent_id">
<span<?= $Page->parent_id->viewAttributes() ?>>
<?= $Page->parent_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->reconciled->Visible) { // reconciled ?>
        <td data-name="reconciled"<?= $Page->reconciled->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_reconciled" class="el_transaction_reconciled">
<span<?= $Page->reconciled->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_reconciled_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->reconciled->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->reconciled->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_reconciled_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_from->Visible) { // created_from ?>
        <td data-name="created_from"<?= $Page->created_from->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_created_from" class="el_transaction_created_from">
<span<?= $Page->created_from->viewAttributes() ?>>
<?= $Page->created_from->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_by->Visible) { // created_by ?>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_created_by" class="el_transaction_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_at->Visible) { // created_at ?>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_created_at" class="el_transaction_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_updated_at" class="el_transaction_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->deleted_at->Visible) { // deleted_at ?>
        <td data-name="deleted_at"<?= $Page->deleted_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_transaction_deleted_at" class="el_transaction_deleted_at">
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
    ew.addEventHandlers("transaction");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
