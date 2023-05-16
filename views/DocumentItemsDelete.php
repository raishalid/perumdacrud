<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$DocumentItemsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { document_items: currentTable } });
var currentPageID = ew.PAGE_ID = "delete";
var currentForm;
var fdocument_itemsdelete;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fdocument_itemsdelete")
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
<form name="fdocument_itemsdelete" id="fdocument_itemsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="document_items">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_document_items_id" class="document_items_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
        <th class="<?= $Page->type->headerCellClass() ?>"><span id="elh_document_items_type" class="document_items_type"><?= $Page->type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->document_id->Visible) { // document_id ?>
        <th class="<?= $Page->document_id->headerCellClass() ?>"><span id="elh_document_items_document_id" class="document_items_document_id"><?= $Page->document_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->departemen_id->Visible) { // departemen_id ?>
        <th class="<?= $Page->departemen_id->headerCellClass() ?>"><span id="elh_document_items_departemen_id" class="document_items_departemen_id"><?= $Page->departemen_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
        <th class="<?= $Page->company_id->headerCellClass() ?>"><span id="elh_document_items_company_id" class="document_items_company_id"><?= $Page->company_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->item_id->Visible) { // item_id ?>
        <th class="<?= $Page->item_id->headerCellClass() ?>"><span id="elh_document_items_item_id" class="document_items_item_id"><?= $Page->item_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_document_items_name" class="document_items_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sku->Visible) { // sku ?>
        <th class="<?= $Page->sku->headerCellClass() ?>"><span id="elh_document_items_sku" class="document_items_sku"><?= $Page->sku->caption() ?></span></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th class="<?= $Page->quantity->headerCellClass() ?>"><span id="elh_document_items_quantity" class="document_items_quantity"><?= $Page->quantity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->price->Visible) { // price ?>
        <th class="<?= $Page->price->headerCellClass() ?>"><span id="elh_document_items_price" class="document_items_price"><?= $Page->price->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tax->Visible) { // tax ?>
        <th class="<?= $Page->tax->headerCellClass() ?>"><span id="elh_document_items_tax" class="document_items_tax"><?= $Page->tax->caption() ?></span></th>
<?php } ?>
<?php if ($Page->discount_type->Visible) { // discount_type ?>
        <th class="<?= $Page->discount_type->headerCellClass() ?>"><span id="elh_document_items_discount_type" class="document_items_discount_type"><?= $Page->discount_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->discount_rate->Visible) { // discount_rate ?>
        <th class="<?= $Page->discount_rate->headerCellClass() ?>"><span id="elh_document_items_discount_rate" class="document_items_discount_rate"><?= $Page->discount_rate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <th class="<?= $Page->total->headerCellClass() ?>"><span id="elh_document_items_total" class="document_items_total"><?= $Page->total->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
        <th class="<?= $Page->created_from->headerCellClass() ?>"><span id="elh_document_items_created_from" class="document_items_created_from"><?= $Page->created_from->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
        <th class="<?= $Page->created_by->headerCellClass() ?>"><span id="elh_document_items_created_by" class="document_items_created_by"><?= $Page->created_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
        <th class="<?= $Page->created_at->headerCellClass() ?>"><span id="elh_document_items_created_at" class="document_items_created_at"><?= $Page->created_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
        <th class="<?= $Page->updated_at->headerCellClass() ?>"><span id="elh_document_items_updated_at" class="document_items_updated_at"><?= $Page->updated_at->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deleted_at->Visible) { // deleted_at ?>
        <th class="<?= $Page->deleted_at->headerCellClass() ?>"><span id="elh_document_items_deleted_at" class="document_items_deleted_at"><?= $Page->deleted_at->caption() ?></span></th>
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
<?php if ($Page->type->Visible) { // type ?>
        <td<?= $Page->type->cellAttributes() ?>>
<span id="">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->document_id->Visible) { // document_id ?>
        <td<?= $Page->document_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->document_id->viewAttributes() ?>>
<?= $Page->document_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->departemen_id->Visible) { // departemen_id ?>
        <td<?= $Page->departemen_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->departemen_id->viewAttributes() ?>>
<?= $Page->departemen_id->getViewValue() ?></span>
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
<?php if ($Page->item_id->Visible) { // item_id ?>
        <td<?= $Page->item_id->cellAttributes() ?>>
<span id="">
<span<?= $Page->item_id->viewAttributes() ?>>
<?= $Page->item_id->getViewValue() ?></span>
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
<?php if ($Page->sku->Visible) { // sku ?>
        <td<?= $Page->sku->cellAttributes() ?>>
<span id="">
<span<?= $Page->sku->viewAttributes() ?>>
<?= $Page->sku->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <td<?= $Page->quantity->cellAttributes() ?>>
<span id="">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->price->Visible) { // price ?>
        <td<?= $Page->price->cellAttributes() ?>>
<span id="">
<span<?= $Page->price->viewAttributes() ?>>
<?= $Page->price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tax->Visible) { // tax ?>
        <td<?= $Page->tax->cellAttributes() ?>>
<span id="">
<span<?= $Page->tax->viewAttributes() ?>>
<?= $Page->tax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->discount_type->Visible) { // discount_type ?>
        <td<?= $Page->discount_type->cellAttributes() ?>>
<span id="">
<span<?= $Page->discount_type->viewAttributes() ?>>
<?= $Page->discount_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->discount_rate->Visible) { // discount_rate ?>
        <td<?= $Page->discount_rate->cellAttributes() ?>>
<span id="">
<span<?= $Page->discount_rate->viewAttributes() ?>>
<?= $Page->discount_rate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <td<?= $Page->total->cellAttributes() ?>>
<span id="">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
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
