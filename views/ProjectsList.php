<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ProjectsList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { projects: currentTable } });
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
<form name="fprojectssrch" id="fprojectssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>" novalidate autocomplete="on">
<div id="fprojectssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { projects: currentTable } });
var currentForm;
var fprojectssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery,
        fields = currentTable.fields;

    // Form object for search
    let form = new ew.FormBuilder()
        .setId("fprojectssrch")
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fprojectssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fprojectssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fprojectssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fprojectssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<input type="hidden" name="t" value="projects">
<?php if ($Page->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div id="gmp_projects" class="card-body ew-grid-middle-panel <?= $Page->TableContainerClass ?>" style="<?= $Page->TableContainerStyle ?>">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit() || $Page->isMultiEdit()) { ?>
<table id="tbl_projectslist" class="<?= $Page->TableClass ?>"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_projects_id" class="projects_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->project_category_id->Visible) { // project_category_id ?>
        <th data-name="project_category_id" class="<?= $Page->project_category_id->headerCellClass() ?>"><div id="elh_projects_project_category_id" class="projects_project_category_id"><?= $Page->renderFieldHeader($Page->project_category_id) ?></div></th>
<?php } ?>
<?php if ($Page->project_provider_id->Visible) { // project_provider_id ?>
        <th data-name="project_provider_id" class="<?= $Page->project_provider_id->headerCellClass() ?>"><div id="elh_projects_project_provider_id" class="projects_project_provider_id"><?= $Page->renderFieldHeader($Page->project_provider_id) ?></div></th>
<?php } ?>
<?php if ($Page->project_status_id->Visible) { // project_status_id ?>
        <th data-name="project_status_id" class="<?= $Page->project_status_id->headerCellClass() ?>"><div id="elh_projects_project_status_id" class="projects_project_status_id"><?= $Page->renderFieldHeader($Page->project_status_id) ?></div></th>
<?php } ?>
<?php if ($Page->funding_source_id->Visible) { // funding_source_id ?>
        <th data-name="funding_source_id" class="<?= $Page->funding_source_id->headerCellClass() ?>"><div id="elh_projects_funding_source_id" class="projects_funding_source_id"><?= $Page->renderFieldHeader($Page->funding_source_id) ?></div></th>
<?php } ?>
<?php if ($Page->project_name->Visible) { // project_name ?>
        <th data-name="project_name" class="<?= $Page->project_name->headerCellClass() ?>"><div id="elh_projects_project_name" class="projects_project_name"><?= $Page->renderFieldHeader($Page->project_name) ?></div></th>
<?php } ?>
<?php if ($Page->project_budget->Visible) { // project_budget ?>
        <th data-name="project_budget" class="<?= $Page->project_budget->headerCellClass() ?>"><div id="elh_projects_project_budget" class="projects_project_budget"><?= $Page->renderFieldHeader($Page->project_budget) ?></div></th>
<?php } ?>
<?php if ($Page->project_start->Visible) { // project_start ?>
        <th data-name="project_start" class="<?= $Page->project_start->headerCellClass() ?>"><div id="elh_projects_project_start" class="projects_project_start"><?= $Page->renderFieldHeader($Page->project_start) ?></div></th>
<?php } ?>
<?php if ($Page->project_duration->Visible) { // project_duration ?>
        <th data-name="project_duration" class="<?= $Page->project_duration->headerCellClass() ?>"><div id="elh_projects_project_duration" class="projects_project_duration"><?= $Page->renderFieldHeader($Page->project_duration) ?></div></th>
<?php } ?>
<?php if ($Page->project_html->Visible) { // project_html ?>
        <th data-name="project_html" class="<?= $Page->project_html->headerCellClass() ?>"><div id="elh_projects_project_html" class="projects_project_html"><?= $Page->renderFieldHeader($Page->project_html) ?></div></th>
<?php } ?>
<?php if ($Page->slug->Visible) { // slug ?>
        <th data-name="slug" class="<?= $Page->slug->headerCellClass() ?>"><div id="elh_projects_slug" class="projects_slug"><?= $Page->renderFieldHeader($Page->slug) ?></div></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th data-name="created_at" class="<?= $Page->created_at->headerCellClass() ?>"><div id="elh_projects_created_at" class="projects_created_at"><?= $Page->renderFieldHeader($Page->created_at) ?></div></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th data-name="updated_at" class="<?= $Page->updated_at->headerCellClass() ?>"><div id="elh_projects_updated_at" class="projects_updated_at"><?= $Page->renderFieldHeader($Page->updated_at) ?></div></th>
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
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_projects_id" class="el_projects_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->project_category_id->Visible) { // project_category_id ?>
        <td data-name="project_category_id"<?= $Page->project_category_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_projects_project_category_id" class="el_projects_project_category_id">
<span<?= $Page->project_category_id->viewAttributes() ?>>
<?= $Page->project_category_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->project_provider_id->Visible) { // project_provider_id ?>
        <td data-name="project_provider_id"<?= $Page->project_provider_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_projects_project_provider_id" class="el_projects_project_provider_id">
<span<?= $Page->project_provider_id->viewAttributes() ?>>
<?= $Page->project_provider_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->project_status_id->Visible) { // project_status_id ?>
        <td data-name="project_status_id"<?= $Page->project_status_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_projects_project_status_id" class="el_projects_project_status_id">
<span<?= $Page->project_status_id->viewAttributes() ?>>
<?= $Page->project_status_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->funding_source_id->Visible) { // funding_source_id ?>
        <td data-name="funding_source_id"<?= $Page->funding_source_id->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_projects_funding_source_id" class="el_projects_funding_source_id">
<span<?= $Page->funding_source_id->viewAttributes() ?>>
<?= $Page->funding_source_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->project_name->Visible) { // project_name ?>
        <td data-name="project_name"<?= $Page->project_name->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_projects_project_name" class="el_projects_project_name">
<span<?= $Page->project_name->viewAttributes() ?>>
<?= $Page->project_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->project_budget->Visible) { // project_budget ?>
        <td data-name="project_budget"<?= $Page->project_budget->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_projects_project_budget" class="el_projects_project_budget">
<span<?= $Page->project_budget->viewAttributes() ?>>
<?= $Page->project_budget->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->project_start->Visible) { // project_start ?>
        <td data-name="project_start"<?= $Page->project_start->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_projects_project_start" class="el_projects_project_start">
<span<?= $Page->project_start->viewAttributes() ?>>
<?= $Page->project_start->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->project_duration->Visible) { // project_duration ?>
        <td data-name="project_duration"<?= $Page->project_duration->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_projects_project_duration" class="el_projects_project_duration">
<span<?= $Page->project_duration->viewAttributes() ?>>
<?= $Page->project_duration->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->project_html->Visible) { // project_html ?>
        <td data-name="project_html"<?= $Page->project_html->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_projects_project_html" class="el_projects_project_html">
<span<?= $Page->project_html->viewAttributes() ?>>
<?= $Page->project_html->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->slug->Visible) { // slug ?>
        <td data-name="slug"<?= $Page->slug->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_projects_slug" class="el_projects_slug">
<span<?= $Page->slug->viewAttributes() ?>>
<?= $Page->slug->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->created_at->Visible) { // created_at ?>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_projects_created_at" class="el_projects_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el<?= $Page->RowIndex == '$rowindex$' ? '$rowindex$' : $Page->RowCount ?>_projects_updated_at" class="el_projects_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
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
    ew.addEventHandlers("projects");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
