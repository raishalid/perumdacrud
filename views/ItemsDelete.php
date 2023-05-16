<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ItemsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { items: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fitemsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fitemsdelete")
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
<form name="fitemsdelete" id="fitemsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="items">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_items_id" class="items_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
        <th class="<?= $Page->company_id->headerCellClass() ?>"><span id="elh_items_company_id" class="items_company_id"><?= $Page->company_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->departement_id->Visible) { // departement_id ?>
        <th class="<?= $Page->departement_id->headerCellClass() ?>"><span id="elh_items_departement_id" class="items_departement_id"><?= $Page->departement_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_items_name" class="items_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sale_price->Visible) { // sale_price ?>
        <th class="<?= $Page->sale_price->headerCellClass() ?>"><span id="elh_items_sale_price" class="items_sale_price"><?= $Page->sale_price->caption() ?></span></th>
<?php } ?>
<?php if ($Page->purchase_price->Visible) { // purchase_price ?>
        <th class="<?= $Page->purchase_price->headerCellClass() ?>"><span id="elh_items_purchase_price" class="items_purchase_price"><?= $Page->purchase_price->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tax_id->Visible) { // tax_id ?>
        <th class="<?= $Page->tax_id->headerCellClass() ?>"><span id="elh_items_tax_id" class="items_tax_id"><?= $Page->tax_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->enabled->Visible) { // enabled ?>
        <th class="<?= $Page->enabled->headerCellClass() ?>"><span id="elh_items_enabled" class="items_enabled"><?= $Page->enabled->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
        <th class="<?= $Page->created_from->headerCellClass() ?>"><span id="elh_items_created_from" class="items_created_from"><?= $Page->created_from->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_items_created_by" class="items_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_items_created_at" class="items_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_items_updated_at" class="items_updated_at"><?= $Page->updated_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deleted_at->Visible) { // deleted_at ?>
        <th class="<?= $Page->deleted_at->headerCellClass() ?>"><span id="elh_items_deleted_at" class="items_deleted_at"><?= $Page->deleted_at->caption() ?></span></th>
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
<?php if ($Page->company_id->Visible) { // company_id ?>
        <td<?= $Page->company_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->company_id->viewAttributes() ?>>
<?= $Page->company_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->departement_id->Visible) { // departement_id ?>
        <td<?= $Page->departement_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->departement_id->viewAttributes() ?>>
<?= $Page->departement_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <td<?= $Page->name->cellAttributes() ?>>
<span id="">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sale_price->Visible) { // sale_price ?>
        <td<?= $Page->sale_price->cellAttributes() ?>>
<span id="">
<span<?= $Page->sale_price->viewAttributes() ?>>
<?= $Page->sale_price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->purchase_price->Visible) { // purchase_price ?>
        <td<?= $Page->purchase_price->cellAttributes() ?>>
<span id="">
<span<?= $Page->purchase_price->viewAttributes() ?>>
<?= $Page->purchase_price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tax_id->Visible) { // tax_id ?>
        <td<?= $Page->tax_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->tax_id->viewAttributes() ?>>
<?= $Page->tax_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->enabled->Visible) { // enabled ?>
        <td<?= $Page->enabled->cellAttributes() ?>>
<span id="">
<span<?= $Page->enabled->viewAttributes() ?>>
<div class="form-check d-inline-block">
    <input type="checkbox" id="x_enabled_<?= $Page->RowCount ?>" class="form-check-input" value="<?= $Page->enabled->getViewValue() ?>" disabled<?php if (ConvertToBool($Page->enabled->CurrentValue)) { ?> checked<?php } ?>>
    <label class="form-check-label" for="x_enabled_<?= $Page->RowCount ?>"></label>
</div></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
        <td<?= $Page->created_from->cellAttributes() ?>>
<span id="">
<span<?= $Page->created_from->viewAttributes() ?>>
<?= $Page->created_from->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <td<?= $Page->created_by->cellAttributes() ?>>
<span id="">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
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
<?php if ($Page->deleted_at->Visible) { // deleted_at ?>
        <td<?= $Page->deleted_at->cellAttributes() ?>>
<span id="">
<span<?= $Page->deleted_at->viewAttributes() ?>>
<?= $Page->deleted_at->getViewValue() ?></span>
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
