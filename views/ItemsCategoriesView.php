<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ItemsCategoriesView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="view">
<form name="fitems_categoriesview" id="fitems_categoriesview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { items_categories: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fitems_categoriesview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fitems_categoriesview")
        .setPageId("view")
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<?php } ?>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="items_categories">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_items_categories_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_items_categories_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->departement_id->Visible) { // departement_id ?>
    <tr id="r_departement_id"<?= $Page->departement_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_items_categories_departement_id"><?= $Page->departement_id->caption() ?></span></td>
        <td data-name="departement_id"<?= $Page->departement_id->cellAttributes() ?>>
<span id="el_items_categories_departement_id">
<span<?= $Page->departement_id->viewAttributes() ?>>
<?= $Page->departement_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->company_id->Visible) { // company_id ?>
    <tr id="r_company_id"<?= $Page->company_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_items_categories_company_id"><?= $Page->company_id->caption() ?></span></td>
        <td data-name="company_id"<?= $Page->company_id->cellAttributes() ?>>
<span id="el_items_categories_company_id">
<span<?= $Page->company_id->viewAttributes() ?>>
<?= $Page->company_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <tr id="r_name"<?= $Page->name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_items_categories_name"><?= $Page->name->caption() ?></span></td>
        <td data-name="name"<?= $Page->name->cellAttributes() ?>>
<span id="el_items_categories_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <tr id="r_type"<?= $Page->type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_items_categories_type"><?= $Page->type->caption() ?></span></td>
        <td data-name="type"<?= $Page->type->cellAttributes() ?>>
<span id="el_items_categories_type">
<span<?= $Page->type->viewAttributes() ?>>
<?= $Page->type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->color->Visible) { // color ?>
    <tr id="r_color"<?= $Page->color->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_items_categories_color"><?= $Page->color->caption() ?></span></td>
        <td data-name="color"<?= $Page->color->cellAttributes() ?>>
<span id="el_items_categories_color">
<span<?= $Page->color->viewAttributes() ?>>
<?= $Page->color->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->enabled->Visible) { // enabled ?>
    <tr id="r_enabled"<?= $Page->enabled->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_items_categories_enabled"><?= $Page->enabled->caption() ?></span></td>
        <td data-name="enabled"<?= $Page->enabled->cellAttributes() ?>>
<span id="el_items_categories_enabled">
<span<?= $Page->enabled->viewAttributes() ?>>
<?= $Page->enabled->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_from->Visible) { // created_from ?>
    <tr id="r_created_from"<?= $Page->created_from->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_items_categories_created_from"><?= $Page->created_from->caption() ?></span></td>
        <td data-name="created_from"<?= $Page->created_from->cellAttributes() ?>>
<span id="el_items_categories_created_from">
<span<?= $Page->created_from->viewAttributes() ?>>
<?= $Page->created_from->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_by->Visible) { // created_by ?>
    <tr id="r_created_by"<?= $Page->created_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_items_categories_created_by"><?= $Page->created_by->caption() ?></span></td>
        <td data-name="created_by"<?= $Page->created_by->cellAttributes() ?>>
<span id="el_items_categories_created_by">
<span<?= $Page->created_by->viewAttributes() ?>>
<?= $Page->created_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_items_categories_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_items_categories_created_at">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_items_categories_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_items_categories_updated_at">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deleted_at->Visible) { // deleted_at ?>
    <tr id="r_deleted_at"<?= $Page->deleted_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_items_categories_deleted_at"><?= $Page->deleted_at->caption() ?></span></td>
        <td data-name="deleted_at"<?= $Page->deleted_at->cellAttributes() ?>>
<span id="el_items_categories_deleted_at">
<span<?= $Page->deleted_at->viewAttributes() ?>>
<?= $Page->deleted_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->parent_id->Visible) { // parent_id ?>
    <tr id="r_parent_id"<?= $Page->parent_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_items_categories_parent_id"><?= $Page->parent_id->caption() ?></span></td>
        <td data-name="parent_id"<?= $Page->parent_id->cellAttributes() ?>>
<span id="el_items_categories_parent_id">
<span<?= $Page->parent_id->viewAttributes() ?>>
<?= $Page->parent_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
