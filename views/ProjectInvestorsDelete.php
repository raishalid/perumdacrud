<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ProjectInvestorsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { project_investors: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fproject_investorsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fproject_investorsdelete")
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
<form name="fproject_investorsdelete" id="fproject_investorsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="project_investors">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_project_investors_id" class="project_investors_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->project_id->Visible) { // project_id ?>
        <th class="<?= $Page->project_id->headerCellClass() ?>"><span id="elh_project_investors_project_id" class="project_investors_project_id"><?= $Page->project_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->investor_id->Visible) { // investor_id ?>
        <th class="<?= $Page->investor_id->headerCellClass() ?>"><span id="elh_project_investors_investor_id" class="project_investors_investor_id"><?= $Page->investor_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->contribution_amount->Visible) { // contribution_amount ?>
        <th class="<?= $Page->contribution_amount->headerCellClass() ?>"><span id="elh_project_investors_contribution_amount" class="project_investors_contribution_amount"><?= $Page->contribution_amount->caption() ?></span></th>
<?php } ?>
<?php if ($Page->slug->Visible) { // slug ?>
        <th class="<?= $Page->slug->headerCellClass() ?>"><span id="elh_project_investors_slug" class="project_investors_slug"><?= $Page->slug->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_project_investors_created_at" class="project_investors_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_project_investors_updated_at" class="project_investors_updated_at"><?= $Page->updated_at->caption() ?></span></th>
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
<?php if ($Page->project_id->Visible) { // project_id ?>
        <td<?= $Page->project_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->project_id->viewAttributes() ?>>
<?= $Page->project_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->investor_id->Visible) { // investor_id ?>
        <td<?= $Page->investor_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->investor_id->viewAttributes() ?>>
<?= $Page->investor_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->contribution_amount->Visible) { // contribution_amount ?>
        <td<?= $Page->contribution_amount->cellAttributes() ?>>
<span id="">
<span<?= $Page->contribution_amount->viewAttributes() ?>>
<?= $Page->contribution_amount->getViewValue() ?></span>
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
