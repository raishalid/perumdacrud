<?php

namespace PHPMaker2023\crudperumdautama;

// Set up and run Grid object
$Grid = Container("ProjectInvestorsGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fproject_investorsgrid;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { project_investors: currentTable } });
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fproject_investorsgrid")
        .setPageId("grid")
        .setFormKeyCountName("<?= $Grid->FormKeyCountName ?>")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["project_id", [fields.project_id.visible && fields.project_id.required ? ew.Validators.required(fields.project_id.caption) : null], fields.project_id.isInvalid],
            ["investor_id", [fields.investor_id.visible && fields.investor_id.required ? ew.Validators.required(fields.investor_id.caption) : null], fields.investor_id.isInvalid],
            ["contribution_amount", [fields.contribution_amount.visible && fields.contribution_amount.required ? ew.Validators.required(fields.contribution_amount.caption) : null, ew.Validators.float], fields.contribution_amount.isInvalid],
            ["slug", [fields.slug.visible && fields.slug.required ? ew.Validators.required(fields.slug.caption) : null], fields.slug.isInvalid],
            ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null], fields.created_at.isInvalid],
            ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null], fields.updated_at.isInvalid]
        ])

        // Check empty row
        .setEmptyRow(
            function (rowIndex) {
                let fobj = this.getForm(),
                    fields = [["project_id",false],["investor_id",false],["contribution_amount",false],["slug",false]];
                if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
                    return false;
                return true;
            }
        )

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
            "project_id": <?= $Grid->project_id->toClientList($Grid) ?>,
            "investor_id": <?= $Grid->investor_id->toClientList($Grid) ?>,
        })
        .build();
    window[form.id] = form;
    loadjs.done(form.id);
});
</script>
<?php } ?>
<main class="list">
<div id="ew-list">
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?= $Grid->isAddOrEdit() ? " ew-grid-add-edit" : "" ?> <?= $Grid->TableGridClass ?>">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<div id="fproject_investorsgrid" class="ew-form ew-list-form">
<div id="gmp_project_investors" class="card-body ew-grid-middle-panel <?= $Grid->TableContainerClass ?>" style="<?= $Grid->TableContainerStyle ?>">
<table id="tbl_project_investorsgrid" class="<?= $Grid->TableClass ?>"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Grid->id->headerCellClass() ?>"><div id="elh_project_investors_id" class="project_investors_id"><?= $Grid->renderFieldHeader($Grid->id) ?></div></th>
<?php } ?>
<?php if ($Grid->project_id->Visible) { // project_id ?>
        <th data-name="project_id" class="<?= $Grid->project_id->headerCellClass() ?>"><div id="elh_project_investors_project_id" class="project_investors_project_id"><?= $Grid->renderFieldHeader($Grid->project_id) ?></div></th>
<?php } ?>
<?php if ($Grid->investor_id->Visible) { // investor_id ?>
        <th data-name="investor_id" class="<?= $Grid->investor_id->headerCellClass() ?>"><div id="elh_project_investors_investor_id" class="project_investors_investor_id"><?= $Grid->renderFieldHeader($Grid->investor_id) ?></div></th>
<?php } ?>
<?php if ($Grid->contribution_amount->Visible) { // contribution_amount ?>
        <th data-name="contribution_amount" class="<?= $Grid->contribution_amount->headerCellClass() ?>"><div id="elh_project_investors_contribution_amount" class="project_investors_contribution_amount"><?= $Grid->renderFieldHeader($Grid->contribution_amount) ?></div></th>
<?php } ?>
<?php if ($Grid->slug->Visible) { // slug ?>
        <th data-name="slug" class="<?= $Grid->slug->headerCellClass() ?>"><div id="elh_project_investors_slug" class="project_investors_slug"><?= $Grid->renderFieldHeader($Grid->slug) ?></div></th>
<?php } ?>
<?php if ($Grid->created_at->Visible) { // created_at ?>
        <th data-name="created_at" class="<?= $Grid->created_at->headerCellClass() ?>"><div id="elh_project_investors_created_at" class="project_investors_created_at"><?= $Grid->renderFieldHeader($Grid->created_at) ?></div></th>
<?php } ?>
<?php if ($Grid->updated_at->Visible) { // updated_at ?>
        <th data-name="updated_at" class="<?= $Grid->updated_at->headerCellClass() ?>"><div id="elh_project_investors_updated_at" class="project_investors_updated_at"><?= $Grid->renderFieldHeader($Grid->updated_at) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody data-page="<?= $Grid->getPageNumber() ?>">
<?php
$Grid->setupGrid();
while ($Grid->RecordCount < $Grid->StopRecord || $Grid->RowIndex === '$rowindex$') {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->setupRow();

        // Skip 1) delete row / empty row for confirm page, 2) hidden row
        if (
            $Grid->RowAction != "delete" &&
            $Grid->RowAction != "insertdelete" &&
            !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow()) &&
            $Grid->RowAction != "hide"
        ) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->id->Visible) { // id ?>
        <td data-name="id"<?= $Grid->id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_id" class="el_project_investors_id"></span>
<input type="hidden" data-table="project_investors" data-field="x_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_id" id="o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_id" class="el_project_investors_id">
<span<?= $Grid->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->id->getDisplayValue($Grid->id->EditValue))) ?>"></span>
<input type="hidden" data-table="project_investors" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_id" class="el_project_investors_id">
<span<?= $Grid->id->viewAttributes() ?>>
<?= $Grid->id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="project_investors" data-field="x_id" data-hidden="1" name="fproject_investorsgrid$x<?= $Grid->RowIndex ?>_id" id="fproject_investorsgrid$x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->FormValue) ?>">
<input type="hidden" data-table="project_investors" data-field="x_id" data-hidden="1" data-old name="fproject_investorsgrid$o<?= $Grid->RowIndex ?>_id" id="fproject_investorsgrid$o<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="project_investors" data-field="x_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_id" id="x<?= $Grid->RowIndex ?>_id" value="<?= HtmlEncode($Grid->id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->project_id->Visible) { // project_id ?>
        <td data-name="project_id"<?= $Grid->project_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->project_id->getSessionValue() != "") { ?>
<span<?= $Grid->project_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->project_id->getDisplayValue($Grid->project_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_project_id" name="x<?= $Grid->RowIndex ?>_project_id" value="<?= HtmlEncode($Grid->project_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_project_id" class="el_project_investors_project_id">
    <select
        id="x<?= $Grid->RowIndex ?>_project_id"
        name="x<?= $Grid->RowIndex ?>_project_id"
        class="form-select ew-select<?= $Grid->project_id->isInvalidClass() ?>"
        <?php if (!$Grid->project_id->IsNativeSelect) { ?>
        data-select2-id="fproject_investorsgrid_x<?= $Grid->RowIndex ?>_project_id"
        <?php } ?>
        data-table="project_investors"
        data-field="x_project_id"
        data-value-separator="<?= $Grid->project_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->project_id->getPlaceHolder()) ?>"
        <?= $Grid->project_id->editAttributes() ?>>
        <?= $Grid->project_id->selectOptionListHtml("x{$Grid->RowIndex}_project_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->project_id->getErrorMessage() ?></div>
<?= $Grid->project_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_project_id") ?>
<?php if (!$Grid->project_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fproject_investorsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_project_id", selectId: "fproject_investorsgrid_x<?= $Grid->RowIndex ?>_project_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fproject_investorsgrid.lists.project_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_project_id", form: "fproject_investorsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_project_id", form: "fproject_investorsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.project_investors.fields.project_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="project_investors" data-field="x_project_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_project_id" id="o<?= $Grid->RowIndex ?>_project_id" value="<?= HtmlEncode($Grid->project_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->project_id->getSessionValue() != "") { ?>
<span<?= $Grid->project_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->project_id->getDisplayValue($Grid->project_id->ViewValue) ?></span></span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_project_id" name="x<?= $Grid->RowIndex ?>_project_id" value="<?= HtmlEncode($Grid->project_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_project_id" class="el_project_investors_project_id">
    <select
        id="x<?= $Grid->RowIndex ?>_project_id"
        name="x<?= $Grid->RowIndex ?>_project_id"
        class="form-select ew-select<?= $Grid->project_id->isInvalidClass() ?>"
        <?php if (!$Grid->project_id->IsNativeSelect) { ?>
        data-select2-id="fproject_investorsgrid_x<?= $Grid->RowIndex ?>_project_id"
        <?php } ?>
        data-table="project_investors"
        data-field="x_project_id"
        data-value-separator="<?= $Grid->project_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->project_id->getPlaceHolder()) ?>"
        <?= $Grid->project_id->editAttributes() ?>>
        <?= $Grid->project_id->selectOptionListHtml("x{$Grid->RowIndex}_project_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->project_id->getErrorMessage() ?></div>
<?= $Grid->project_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_project_id") ?>
<?php if (!$Grid->project_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fproject_investorsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_project_id", selectId: "fproject_investorsgrid_x<?= $Grid->RowIndex ?>_project_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fproject_investorsgrid.lists.project_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_project_id", form: "fproject_investorsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_project_id", form: "fproject_investorsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.project_investors.fields.project_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_project_id" class="el_project_investors_project_id">
<span<?= $Grid->project_id->viewAttributes() ?>>
<?= $Grid->project_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="project_investors" data-field="x_project_id" data-hidden="1" name="fproject_investorsgrid$x<?= $Grid->RowIndex ?>_project_id" id="fproject_investorsgrid$x<?= $Grid->RowIndex ?>_project_id" value="<?= HtmlEncode($Grid->project_id->FormValue) ?>">
<input type="hidden" data-table="project_investors" data-field="x_project_id" data-hidden="1" data-old name="fproject_investorsgrid$o<?= $Grid->RowIndex ?>_project_id" id="fproject_investorsgrid$o<?= $Grid->RowIndex ?>_project_id" value="<?= HtmlEncode($Grid->project_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->investor_id->Visible) { // investor_id ?>
        <td data-name="investor_id"<?= $Grid->investor_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_investor_id" class="el_project_investors_investor_id">
    <select
        id="x<?= $Grid->RowIndex ?>_investor_id"
        name="x<?= $Grid->RowIndex ?>_investor_id"
        class="form-select ew-select<?= $Grid->investor_id->isInvalidClass() ?>"
        <?php if (!$Grid->investor_id->IsNativeSelect) { ?>
        data-select2-id="fproject_investorsgrid_x<?= $Grid->RowIndex ?>_investor_id"
        <?php } ?>
        data-table="project_investors"
        data-field="x_investor_id"
        data-value-separator="<?= $Grid->investor_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->investor_id->getPlaceHolder()) ?>"
        <?= $Grid->investor_id->editAttributes() ?>>
        <?= $Grid->investor_id->selectOptionListHtml("x{$Grid->RowIndex}_investor_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->investor_id->getErrorMessage() ?></div>
<?= $Grid->investor_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_investor_id") ?>
<?php if (!$Grid->investor_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fproject_investorsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_investor_id", selectId: "fproject_investorsgrid_x<?= $Grid->RowIndex ?>_investor_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fproject_investorsgrid.lists.investor_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_investor_id", form: "fproject_investorsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_investor_id", form: "fproject_investorsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.project_investors.fields.investor_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="project_investors" data-field="x_investor_id" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_investor_id" id="o<?= $Grid->RowIndex ?>_investor_id" value="<?= HtmlEncode($Grid->investor_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_investor_id" class="el_project_investors_investor_id">
    <select
        id="x<?= $Grid->RowIndex ?>_investor_id"
        name="x<?= $Grid->RowIndex ?>_investor_id"
        class="form-select ew-select<?= $Grid->investor_id->isInvalidClass() ?>"
        <?php if (!$Grid->investor_id->IsNativeSelect) { ?>
        data-select2-id="fproject_investorsgrid_x<?= $Grid->RowIndex ?>_investor_id"
        <?php } ?>
        data-table="project_investors"
        data-field="x_investor_id"
        data-value-separator="<?= $Grid->investor_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->investor_id->getPlaceHolder()) ?>"
        <?= $Grid->investor_id->editAttributes() ?>>
        <?= $Grid->investor_id->selectOptionListHtml("x{$Grid->RowIndex}_investor_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->investor_id->getErrorMessage() ?></div>
<?= $Grid->investor_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_investor_id") ?>
<?php if (!$Grid->investor_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fproject_investorsgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_investor_id", selectId: "fproject_investorsgrid_x<?= $Grid->RowIndex ?>_investor_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fproject_investorsgrid.lists.investor_id?.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_investor_id", form: "fproject_investorsgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_investor_id", form: "fproject_investorsgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.project_investors.fields.investor_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_investor_id" class="el_project_investors_investor_id">
<span<?= $Grid->investor_id->viewAttributes() ?>>
<?= $Grid->investor_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="project_investors" data-field="x_investor_id" data-hidden="1" name="fproject_investorsgrid$x<?= $Grid->RowIndex ?>_investor_id" id="fproject_investorsgrid$x<?= $Grid->RowIndex ?>_investor_id" value="<?= HtmlEncode($Grid->investor_id->FormValue) ?>">
<input type="hidden" data-table="project_investors" data-field="x_investor_id" data-hidden="1" data-old name="fproject_investorsgrid$o<?= $Grid->RowIndex ?>_investor_id" id="fproject_investorsgrid$o<?= $Grid->RowIndex ?>_investor_id" value="<?= HtmlEncode($Grid->investor_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->contribution_amount->Visible) { // contribution_amount ?>
        <td data-name="contribution_amount"<?= $Grid->contribution_amount->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_contribution_amount" class="el_project_investors_contribution_amount">
<input type="<?= $Grid->contribution_amount->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_contribution_amount" id="x<?= $Grid->RowIndex ?>_contribution_amount" data-table="project_investors" data-field="x_contribution_amount" value="<?= $Grid->contribution_amount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->contribution_amount->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->contribution_amount->formatPattern()) ?>"<?= $Grid->contribution_amount->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->contribution_amount->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="project_investors" data-field="x_contribution_amount" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_contribution_amount" id="o<?= $Grid->RowIndex ?>_contribution_amount" value="<?= HtmlEncode($Grid->contribution_amount->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_contribution_amount" class="el_project_investors_contribution_amount">
<input type="<?= $Grid->contribution_amount->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_contribution_amount" id="x<?= $Grid->RowIndex ?>_contribution_amount" data-table="project_investors" data-field="x_contribution_amount" value="<?= $Grid->contribution_amount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->contribution_amount->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->contribution_amount->formatPattern()) ?>"<?= $Grid->contribution_amount->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->contribution_amount->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_contribution_amount" class="el_project_investors_contribution_amount">
<span<?= $Grid->contribution_amount->viewAttributes() ?>>
<?= $Grid->contribution_amount->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="project_investors" data-field="x_contribution_amount" data-hidden="1" name="fproject_investorsgrid$x<?= $Grid->RowIndex ?>_contribution_amount" id="fproject_investorsgrid$x<?= $Grid->RowIndex ?>_contribution_amount" value="<?= HtmlEncode($Grid->contribution_amount->FormValue) ?>">
<input type="hidden" data-table="project_investors" data-field="x_contribution_amount" data-hidden="1" data-old name="fproject_investorsgrid$o<?= $Grid->RowIndex ?>_contribution_amount" id="fproject_investorsgrid$o<?= $Grid->RowIndex ?>_contribution_amount" value="<?= HtmlEncode($Grid->contribution_amount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->slug->Visible) { // slug ?>
        <td data-name="slug"<?= $Grid->slug->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_slug" class="el_project_investors_slug">
<input type="<?= $Grid->slug->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_slug" id="x<?= $Grid->RowIndex ?>_slug" data-table="project_investors" data-field="x_slug" value="<?= $Grid->slug->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->slug->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->slug->formatPattern()) ?>"<?= $Grid->slug->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->slug->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="project_investors" data-field="x_slug" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_slug" id="o<?= $Grid->RowIndex ?>_slug" value="<?= HtmlEncode($Grid->slug->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_slug" class="el_project_investors_slug">
<input type="<?= $Grid->slug->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_slug" id="x<?= $Grid->RowIndex ?>_slug" data-table="project_investors" data-field="x_slug" value="<?= $Grid->slug->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->slug->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Grid->slug->formatPattern()) ?>"<?= $Grid->slug->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->slug->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_slug" class="el_project_investors_slug">
<span<?= $Grid->slug->viewAttributes() ?>>
<?= $Grid->slug->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="project_investors" data-field="x_slug" data-hidden="1" name="fproject_investorsgrid$x<?= $Grid->RowIndex ?>_slug" id="fproject_investorsgrid$x<?= $Grid->RowIndex ?>_slug" value="<?= HtmlEncode($Grid->slug->FormValue) ?>">
<input type="hidden" data-table="project_investors" data-field="x_slug" data-hidden="1" data-old name="fproject_investorsgrid$o<?= $Grid->RowIndex ?>_slug" id="fproject_investorsgrid$o<?= $Grid->RowIndex ?>_slug" value="<?= HtmlEncode($Grid->slug->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->created_at->Visible) { // created_at ?>
        <td data-name="created_at"<?= $Grid->created_at->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="project_investors" data-field="x_created_at" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_created_at" id="o<?= $Grid->RowIndex ?>_created_at" value="<?= HtmlEncode($Grid->created_at->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_created_at" class="el_project_investors_created_at">
<span<?= $Grid->created_at->viewAttributes() ?>>
<?= $Grid->created_at->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="project_investors" data-field="x_created_at" data-hidden="1" name="fproject_investorsgrid$x<?= $Grid->RowIndex ?>_created_at" id="fproject_investorsgrid$x<?= $Grid->RowIndex ?>_created_at" value="<?= HtmlEncode($Grid->created_at->FormValue) ?>">
<input type="hidden" data-table="project_investors" data-field="x_created_at" data-hidden="1" data-old name="fproject_investorsgrid$o<?= $Grid->RowIndex ?>_created_at" id="fproject_investorsgrid$o<?= $Grid->RowIndex ?>_created_at" value="<?= HtmlEncode($Grid->created_at->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->updated_at->Visible) { // updated_at ?>
        <td data-name="updated_at"<?= $Grid->updated_at->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="project_investors" data-field="x_updated_at" data-hidden="1" data-old name="o<?= $Grid->RowIndex ?>_updated_at" id="o<?= $Grid->RowIndex ?>_updated_at" value="<?= HtmlEncode($Grid->updated_at->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowIndex == '$rowindex$' ? '$rowindex$' : $Grid->RowCount ?>_project_investors_updated_at" class="el_project_investors_updated_at">
<span<?= $Grid->updated_at->viewAttributes() ?>>
<?= $Grid->updated_at->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="project_investors" data-field="x_updated_at" data-hidden="1" name="fproject_investorsgrid$x<?= $Grid->RowIndex ?>_updated_at" id="fproject_investorsgrid$x<?= $Grid->RowIndex ?>_updated_at" value="<?= HtmlEncode($Grid->updated_at->FormValue) ?>">
<input type="hidden" data-table="project_investors" data-field="x_updated_at" data-hidden="1" data-old name="fproject_investorsgrid$o<?= $Grid->RowIndex ?>_updated_at" id="fproject_investorsgrid$o<?= $Grid->RowIndex ?>_updated_at" value="<?= HtmlEncode($Grid->updated_at->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script data-rowindex="<?= $Grid->RowIndex ?>">
loadjs.ready(["fproject_investorsgrid","load"], () => fproject_investorsgrid.updateLists(<?= $Grid->RowIndex ?><?= $Grid->isAdd() || $Grid->isEdit() || $Grid->isCopy() || $Grid->RowIndex === '$rowindex$' ? ", true" : "" ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (
        $Grid->Recordset &&
        !$Grid->Recordset->EOF &&
        $Grid->RowIndex !== '$rowindex$' &&
        (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy") &&
        (!(($Grid->isCopy() || $Grid->isAdd()) && $Grid->RowIndex == 0))
    ) {
        $Grid->Recordset->moveNext();
    }
    // Reset for template row
    if ($Grid->RowIndex === '$rowindex$') {
        $Grid->RowIndex = 0;
    }
    // Reset inline add/copy row
    if (($Grid->isCopy() || $Grid->isAdd()) && $Grid->RowIndex == 0) {
        $Grid->RowIndex = 1;
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fproject_investorsgrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
</div>
</main>
<?php if (!$Grid->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("project_investors");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
