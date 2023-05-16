<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ProjectsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { projects: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fprojectsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fprojectsdelete")
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
<form name="fprojectsdelete" id="fprojectsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="projects">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_projects_id" class="projects_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->project_category_id->Visible) { // project_category_id ?>
        <th class="<?= $Page->project_category_id->headerCellClass() ?>"><span id="elh_projects_project_category_id" class="projects_project_category_id"><?= $Page->project_category_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->project_provider_id->Visible) { // project_provider_id ?>
        <th class="<?= $Page->project_provider_id->headerCellClass() ?>"><span id="elh_projects_project_provider_id" class="projects_project_provider_id"><?= $Page->project_provider_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->project_status_id->Visible) { // project_status_id ?>
        <th class="<?= $Page->project_status_id->headerCellClass() ?>"><span id="elh_projects_project_status_id" class="projects_project_status_id"><?= $Page->project_status_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->funding_source_id->Visible) { // funding_source_id ?>
        <th class="<?= $Page->funding_source_id->headerCellClass() ?>"><span id="elh_projects_funding_source_id" class="projects_funding_source_id"><?= $Page->funding_source_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->project_name->Visible) { // project_name ?>
        <th class="<?= $Page->project_name->headerCellClass() ?>"><span id="elh_projects_project_name" class="projects_project_name"><?= $Page->project_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->project_budget->Visible) { // project_budget ?>
        <th class="<?= $Page->project_budget->headerCellClass() ?>"><span id="elh_projects_project_budget" class="projects_project_budget"><?= $Page->project_budget->caption() ?></span></th>
<?php } ?>
<?php if ($Page->project_start->Visible) { // project_start ?>
        <th class="<?= $Page->project_start->headerCellClass() ?>"><span id="elh_projects_project_start" class="projects_project_start"><?= $Page->project_start->caption() ?></span></th>
<?php } ?>
<?php if ($Page->project_duration->Visible) { // project_duration ?>
        <th class="<?= $Page->project_duration->headerCellClass() ?>"><span id="elh_projects_project_duration" class="projects_project_duration"><?= $Page->project_duration->caption() ?></span></th>
<?php } ?>
<?php if ($Page->project_html->Visible) { // project_html ?>
        <th class="<?= $Page->project_html->headerCellClass() ?>"><span id="elh_projects_project_html" class="projects_project_html"><?= $Page->project_html->caption() ?></span></th>
<?php } ?>
<?php if ($Page->slug->Visible) { // slug ?>
        <th class="<?= $Page->slug->headerCellClass() ?>"><span id="elh_projects_slug" class="projects_slug"><?= $Page->slug->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_projects_created_at" class="projects_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_projects_updated_at" class="projects_updated_at"><?= $Page->updated_at->caption() ?></span></th>
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
<?php if ($Page->project_category_id->Visible) { // project_category_id ?>
        <td<?= $Page->project_category_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->project_category_id->viewAttributes() ?>>
<?= $Page->project_category_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->project_provider_id->Visible) { // project_provider_id ?>
        <td<?= $Page->project_provider_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->project_provider_id->viewAttributes() ?>>
<?= $Page->project_provider_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->project_status_id->Visible) { // project_status_id ?>
        <td<?= $Page->project_status_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->project_status_id->viewAttributes() ?>>
<?= $Page->project_status_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->funding_source_id->Visible) { // funding_source_id ?>
        <td<?= $Page->funding_source_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->funding_source_id->viewAttributes() ?>>
<?= $Page->funding_source_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->project_name->Visible) { // project_name ?>
        <td<?= $Page->project_name->cellAttributes() ?>>
<span id="">
<span<?= $Page->project_name->viewAttributes() ?>>
<?= $Page->project_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->project_budget->Visible) { // project_budget ?>
        <td<?= $Page->project_budget->cellAttributes() ?>>
<span id="">
<span<?= $Page->project_budget->viewAttributes() ?>>
<?= $Page->project_budget->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->project_start->Visible) { // project_start ?>
        <td<?= $Page->project_start->cellAttributes() ?>>
<span id="">
<span<?= $Page->project_start->viewAttributes() ?>>
<?= $Page->project_start->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->project_duration->Visible) { // project_duration ?>
        <td<?= $Page->project_duration->cellAttributes() ?>>
<span id="">
<span<?= $Page->project_duration->viewAttributes() ?>>
<?= $Page->project_duration->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->project_html->Visible) { // project_html ?>
        <td<?= $Page->project_html->cellAttributes() ?>>
<span id="">
<span<?= $Page->project_html->viewAttributes() ?>>
<?= $Page->project_html->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->slug->Visible) { // slug ?>
        <td<?= $Page->slug->cellAttributes() ?>>
<span id="">
<span<?= $Page->slug->viewAttributes() ?>>
<?= $Page->slug->getViewValue() ?></span>
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
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <td<?= $Page->updated_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
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
