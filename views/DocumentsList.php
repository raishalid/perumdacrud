<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$DocumentsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { documents: currentTable } });
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
<form name="fdocumentssrch" id="fdocumentssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="fdocumentssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { documents: currentTable } });
var currentForm;
var fdocumentssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fdocumentssrch")
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fdocumentssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fdocumentssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fdocumentssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fdocumentssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="documents">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_documents" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_documentslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_documents_id" class="documents_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->departement_id->Visible) { // departement_id ?>
        <th data-name="departement_id" class="<?= $Page->departement_id->headerCellClass() ?>"><div id="elh_documents_departement_id" class="documents_departement_id"><?= $Page->renderFieldHeader($Page->departement_id) ?></div></th>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
        <th data-name="company_id" class="<?= $Page->company_id->headerCellClass() ?>"><div id="elh_documents_company_id" class="documents_company_id"><?= $Page->renderFieldHeader($Page->company_id) ?></div></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th data-name="type" class="<?= $Page->type->headerCellClass() ?>"><div id="elh_documents_type" class="documents_type"><?= $Page->renderFieldHeader($Page->type) ?></div></th>
<?php } ?>
<?php if ($Page->document_number->Visible) { // document_number ?>
        <th data-name="document_number" class="<?= $Page->document_number->headerCellClass() ?>"><div id="elh_documents_document_number" class="documents_document_number"><?= $Page->renderFieldHeader($Page->document_number) ?></div></th>
<?php } ?>
<?php if ($Page->order_number->Visible) { // order_number ?>
        <th data-name="order_number" class="<?= $Page->order_number->headerCellClass() ?>"><div id="elh_documents_order_number" class="documents_order_number"><?= $Page->renderFieldHeader($Page->order_number) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_documents_status" class="documents_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->issued_at->Visible) { // issued_at ?>
        <th data-name="issued_at" class="<?= $Page->issued_at->headerCellClass() ?>"><div id="elh_documents_issued_at" class="documents_issued_at"><?= $Page->renderFieldHeader($Page->issued_at) ?></div></th>
<?php } ?>
<?php if ($Page->due_at->Visible) { // due_at ?>
        <th data-name="due_at" class="<?= $Page->due_at->headerCellClass() ?>"><div id="elh_documents_due_at" class="documents_due_at"><?= $Page->renderFieldHeader($Page->due_at) ?></div></th>
<?php } ?>
<?php if ($Page->amount->Visible) { // amount ?>
        <th data-name="amount" class="<?= $Page->amount->headerCellClass() ?>"><div id="elh_documents_amount" class="documents_amount"><?= $Page->renderFieldHeader($Page->amount) ?></div></th>
<?php } ?>
<?php if ($Page->currency_code->Visible) { // currency_code ?>
        <th data-name="currency_code" class="<?= $Page->currency_code->headerCellClass() ?>"><div id="elh_documents_currency_code" class="documents_currency_code"><?= $Page->renderFieldHeader($Page->currency_code) ?></div></th>
<?php } ?>
<?php if ($Page->currency_rate->Visible) { // currency_rate ?>
        <th data-name="currency_rate" class="<?= $Page->currency_rate->headerCellClass() ?>"><div id="elh_documents_currency_rate" class="documents_currency_rate"><?= $Page->renderFieldHeader($Page->currency_rate) ?></div></th>
<?php } ?>
<?php if ($Page->category_id->Visible) { // category_id ?>
        <th data-name="category_id" class="<?= $Page->category_id->headerCellClass() ?>"><div id="elh_documents_category_id" class="documents_category_id"><?= $Page->renderFieldHeader($Page->category_id) ?></div></th>
<?php } ?>
<?php if ($Page->contact_id->Visible) { // contact_id ?>
        <th data-name="contact_id" class="<?= $Page->contact_id->headerCellClass() ?>"><div id="elh_documents_contact_id" class="documents_contact_id"><?= $Page->renderFieldHeader($Page->contact_id) ?></div></th>
<?php } ?>
<?php if ($Page->contact_name->Visible) { // contact_name ?>
        <th data-name="contact_name" class="<?= $Page->contact_name->headerCellClass() ?>"><div id="elh_documents_contact_name" class="documents_contact_name"><?= $Page->renderFieldHeader($Page->contact_name) ?></div></th>
<?php } ?>
<?php if ($Page->contact_email->Visible) { // contact_email ?>
        <th data-name="contact_email" class="<?= $Page->contact_email->headerCellClass() ?>"><div id="elh_documents_contact_email" class="documents_contact_email"><?= $Page->renderFieldHeader($Page->contact_email) ?></div></th>
<?php } ?>
<?php if ($Page->contact_tax_number->Visible) { // contact_tax_number ?>
        <th data-name="contact_tax_number" class="<?= $Page->contact_tax_number->headerCellClass() ?>"><div id="elh_documents_contact_tax_number" class="documents_contact_tax_number"><?= $Page->renderFieldHeader($Page->contact_tax_number) ?></div></th>
<?php } ?>
<?php if ($Page->contact_phone->Visible) { // contact_phone ?>
        <th data-name="contact_phone" class="<?= $Page->contact_phone->headerCellClass() ?>"><div id="elh_documents_contact_phone" class="documents_contact_phone"><?= $Page->renderFieldHeader($Page->contact_phone) ?></div></th>
<?php } ?>
<?php if ($Page->contact_city->Visible) { // contact_city ?>
        <th data-name="contact_city" class="<?= $Page->contact_city->headerCellClass() ?>"><div id="elh_documents_contact_city" class="documents_contact_city"><?= $Page->renderFieldHeader($Page->contact_city) ?></div></th>
<?php } ?>
<?php if ($Page->contact_zip_code->Visible) { // contact_zip_code ?>
        <th data-name="contact_zip_code" class="<?= $Page->contact_zip_code->headerCellClass() ?>"><div id="elh_documents_contact_zip_code" class="documents_contact_zip_code"><?= $Page->renderFieldHeader($Page->contact_zip_code) ?></div></th>
<?php } ?>
<?php if ($Page->contact_state->Visible) { // contact_state ?>
        <th data-name="contact_state" class="<?= $Page->contact_state->headerCellClass() ?>"><div id="elh_documents_contact_state" class="documents_contact_state"><?= $Page->renderFieldHeader($Page->contact_state) ?></div></th>
<?php } ?>
<?php if ($Page->contact_country->Visible) { // contact_country ?>
        <th data-name="contact_country" class="<?= $Page->contact_country->headerCellClass() ?>"><div id="elh_documents_contact_country" class="documents_contact_country"><?= $Page->renderFieldHeader($Page->contact_country) ?></div></th>
<?php } ?>
<?php if ($Page->parent_id->Visible) { // parent_id ?>
        <th data-name="parent_id" class="<?= $Page->parent_id->headerCellClass() ?>"><div id="elh_documents_parent_id" class="documents_parent_id"><?= $Page->renderFieldHeader($Page->parent_id) ?></div></th>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
        <th data-name="created_from" class="<?= $Page->created_from->headerCellClass() ?>"><div id="elh_documents_created_from" class="documents_created_from"><?= $Page->renderFieldHeader($Page->created_from) ?></div></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th data-name="created_by" class="<?= $Page->created_by->headerCellClass() ?>"><div id="elh_documents_created_by" class="documents_created_by"><?= $Page->renderFieldHeader($Page->created_by) ?></div></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th data-name="created_at" class="<?= $Page->created_at->headerCellClass() ?>"><div id="elh_documents_created_at" class="documents_created_at"><?= $Page->renderFieldHeader($Page->created_at) ?></div></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th data-name="updated_at" class="<?= $Page->updated_at->headerCellClass() ?>"><div id="elh_documents_updated_at" class="documents_updated_at"><?= $Page->renderFieldHeader($Page->updated_at) ?></div></th>
<?php } ?>
<?php if ($Page->deleted_at->Visible) { // deleted_at ?>
        <th data-name="deleted_at" class="<?= $Page->deleted_at->headerCellClass() ?>"><div id="elh_documents_deleted_at" class="documents_deleted_at"><?= $Page->renderFieldHeader($Page->deleted_at) ?></div></th>
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
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_id" class="el_documents_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->departement_id->Visible) { // departement_id ?>
        <td data-name="departement_id"<?= $Page->departement_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_departement_id" class="el_documents_departement_id">
<span<?= $Page->departement_id->viewAttributes() ?>>
<?= $Page->departement_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->company_id->Visible) { // company_id ?>
        <td data-name="company_id"<?= $Page->company_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_company_id" class="el_documents_company_id">
<span<?= $Page->company_id->viewAttributes() ?>>
<?= $Page->company_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->type->Visible) { // type ?>
        <td data-name="type"<?= $Page->type->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_type" class="el_documents_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->document_number->Visible) { // document_number ?>
        <td data-name="document_number"<?= $Page->document_number->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_document_number" class="el_documents_document_number">
<span<?= $Page->document_number->viewAttributes() ?>>
<?= $Page->document_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->order_number->Visible) { // order_number ?>
        <td data-name="order_number"<?= $Page->order_number->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_order_number" class="el_documents_order_number">
<span<?= $Page->order_number->viewAttributes() ?>>
<?= $Page->order_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_status" class="el_documents_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->issued_at->Visible) { // issued_at ?>
        <td data-name="issued_at"<?= $Page->issued_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_issued_at" class="el_documents_issued_at">
<span<?= $Page->issued_at->viewAttributes() ?>>
<?= $Page->issued_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->due_at->Visible) { // due_at ?>
        <td data-name="due_at"<?= $Page->due_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_due_at" class="el_documents_due_at">
<span<?= $Page->due_at->viewAttributes() ?>>
<?= $Page->due_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->amount->Visible) { // amount ?>
        <td data-name="amount"<?= $Page->amount->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_amount" class="el_documents_amount">
<span<?= $Page->amount->viewAttributes() ?>>
<?= $Page->amount->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->currency_code->Visible) { // currency_code ?>
        <td data-name="currency_code"<?= $Page->currency_code->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_currency_code" class="el_documents_currency_code">
<span<?= $Page->currency_code->viewAttributes() ?>>
<?= $Page->currency_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->currency_rate->Visible) { // currency_rate ?>
        <td data-name="currency_rate"<?= $Page->currency_rate->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_currency_rate" class="el_documents_currency_rate">
<span<?= $Page->currency_rate->viewAttributes() ?>>
<?= $Page->currency_rate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->category_id->Visible) { // category_id ?>
        <td data-name="category_id"<?= $Page->category_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_category_id" class="el_documents_category_id">
<span<?= $Page->category_id->viewAttributes() ?>>
<?= $Page->category_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_id->Visible) { // contact_id ?>
        <td data-name="contact_id"<?= $Page->contact_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_contact_id" class="el_documents_contact_id">
<span<?= $Page->contact_id->viewAttributes() ?>>
<?= $Page->contact_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_name->Visible) { // contact_name ?>
        <td data-name="contact_name"<?= $Page->contact_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_contact_name" class="el_documents_contact_name">
<span<?= $Page->contact_name->viewAttributes() ?>>
<?= $Page->contact_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_email->Visible) { // contact_email ?>
        <td data-name="contact_email"<?= $Page->contact_email->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_contact_email" class="el_documents_contact_email">
<span<?= $Page->contact_email->viewAttributes() ?>>
<?= $Page->contact_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_tax_number->Visible) { // contact_tax_number ?>
        <td data-name="contact_tax_number"<?= $Page->contact_tax_number->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_contact_tax_number" class="el_documents_contact_tax_number">
<span<?= $Page->contact_tax_number->viewAttributes() ?>>
<?= $Page->contact_tax_number->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_phone->Visible) { // contact_phone ?>
        <td data-name="contact_phone"<?= $Page->contact_phone->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_contact_phone" class="el_documents_contact_phone">
<span<?= $Page->contact_phone->viewAttributes() ?>>
<?= $Page->contact_phone->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_city->Visible) { // contact_city ?>
        <td data-name="contact_city"<?= $Page->contact_city->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_contact_city" class="el_documents_contact_city">
<span<?= $Page->contact_city->viewAttributes() ?>>
<?= $Page->contact_city->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_zip_code->Visible) { // contact_zip_code ?>
        <td data-name="contact_zip_code"<?= $Page->contact_zip_code->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_contact_zip_code" class="el_documents_contact_zip_code">
<span<?= $Page->contact_zip_code->viewAttributes() ?>>
<?= $Page->contact_zip_code->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_state->Visible) { // contact_state ?>
        <td data-name="contact_state"<?= $Page->contact_state->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_contact_state" class="el_documents_contact_state">
<span<?= $Page->contact_state->viewAttributes() ?>>
<?= $Page->contact_state->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->contact_country->Visible) { // contact_country ?>
        <td data-name="contact_country"<?= $Page->contact_country->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_contact_country" class="el_documents_contact_country">
<span<?= $Page->contact_country->viewAttributes() ?>>
<?= $Page->contact_country->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->parent_id->Visible) { // parent_id ?>
        <td data-name="parent_id"<?= $Page->parent_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_parent_id" class="el_documents_parent_id">
<span<?= $Page->parent_id->viewAttributes() ?>>
<?= $Page->parent_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_from->Visible) { // created_from ?>
        <td data-name="created_from"<?= $Page->created_from->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_created_from" class="el_documents_created_from">
<span<?= $Page->created_from->viewAttributes() ?>>
<?= $Page->created_from->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_by->Visible) { // created_by ?>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_created_by" class="el_documents_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_at->Visible) { // created_at ?>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_created_at" class="el_documents_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_updated_at" class="el_documents_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->deleted_at->Visible) { // deleted_at ?>
        <td data-name="deleted_at"<?= $Page->deleted_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_documents_deleted_at" class="el_documents_deleted_at">
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
    ew.addEventHandlers("documents");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
