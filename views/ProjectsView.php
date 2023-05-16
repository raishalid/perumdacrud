<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ProjectsView = &$Page;
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
<form name="fprojectsview" id="fprojectsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { projects: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var fprojectsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fprojectsview")
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
<input type="hidden" name="t" value="projects">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_projects_id" data-page="1">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->project_category_id->Visible) { // project_category_id ?>
    <tr id="r_project_category_id"<?= $Page->project_category_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_project_category_id"><?= $Page->project_category_id->caption() ?></span></td>
        <td data-name="project_category_id"<?= $Page->project_category_id->cellAttributes() ?>>
<span id="el_projects_project_category_id" data-page="1">
<span<?= $Page->project_category_id->viewAttributes() ?>>
<?= $Page->project_category_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->project_provider_id->Visible) { // project_provider_id ?>
    <tr id="r_project_provider_id"<?= $Page->project_provider_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_project_provider_id"><?= $Page->project_provider_id->caption() ?></span></td>
        <td data-name="project_provider_id"<?= $Page->project_provider_id->cellAttributes() ?>>
<span id="el_projects_project_provider_id" data-page="1">
<span<?= $Page->project_provider_id->viewAttributes() ?>>
<?= $Page->project_provider_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->project_status_id->Visible) { // project_status_id ?>
    <tr id="r_project_status_id"<?= $Page->project_status_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_project_status_id"><?= $Page->project_status_id->caption() ?></span></td>
        <td data-name="project_status_id"<?= $Page->project_status_id->cellAttributes() ?>>
<span id="el_projects_project_status_id" data-page="1">
<span<?= $Page->project_status_id->viewAttributes() ?>>
<?= $Page->project_status_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->funding_source_id->Visible) { // funding_source_id ?>
    <tr id="r_funding_source_id"<?= $Page->funding_source_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_funding_source_id"><?= $Page->funding_source_id->caption() ?></span></td>
        <td data-name="funding_source_id"<?= $Page->funding_source_id->cellAttributes() ?>>
<span id="el_projects_funding_source_id" data-page="1">
<span<?= $Page->funding_source_id->viewAttributes() ?>>
<?= $Page->funding_source_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->project_name->Visible) { // project_name ?>
    <tr id="r_project_name"<?= $Page->project_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_project_name"><?= $Page->project_name->caption() ?></span></td>
        <td data-name="project_name"<?= $Page->project_name->cellAttributes() ?>>
<span id="el_projects_project_name" data-page="1">
<span<?= $Page->project_name->viewAttributes() ?>>
<?= $Page->project_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->project_description->Visible) { // project_description ?>
    <tr id="r_project_description"<?= $Page->project_description->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_project_description"><?= $Page->project_description->caption() ?></span></td>
        <td data-name="project_description"<?= $Page->project_description->cellAttributes() ?>>
<span id="el_projects_project_description" data-page="1">
<span<?= $Page->project_description->viewAttributes() ?>>
<?= $Page->project_description->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->project_budget->Visible) { // project_budget ?>
    <tr id="r_project_budget"<?= $Page->project_budget->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_project_budget"><?= $Page->project_budget->caption() ?></span></td>
        <td data-name="project_budget"<?= $Page->project_budget->cellAttributes() ?>>
<span id="el_projects_project_budget" data-page="1">
<span<?= $Page->project_budget->viewAttributes() ?>>
<?= $Page->project_budget->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->project_target->Visible) { // project_target ?>
    <tr id="r_project_target"<?= $Page->project_target->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_project_target"><?= $Page->project_target->caption() ?></span></td>
        <td data-name="project_target"<?= $Page->project_target->cellAttributes() ?>>
<span id="el_projects_project_target" data-page="1">
<span<?= $Page->project_target->viewAttributes() ?>>
<?= $Page->project_target->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->project_start->Visible) { // project_start ?>
    <tr id="r_project_start"<?= $Page->project_start->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_project_start"><?= $Page->project_start->caption() ?></span></td>
        <td data-name="project_start"<?= $Page->project_start->cellAttributes() ?>>
<span id="el_projects_project_start" data-page="1">
<span<?= $Page->project_start->viewAttributes() ?>>
<?= $Page->project_start->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->project_duration->Visible) { // project_duration ?>
    <tr id="r_project_duration"<?= $Page->project_duration->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_project_duration"><?= $Page->project_duration->caption() ?></span></td>
        <td data-name="project_duration"<?= $Page->project_duration->cellAttributes() ?>>
<span id="el_projects_project_duration" data-page="1">
<span<?= $Page->project_duration->viewAttributes() ?>>
<?= $Page->project_duration->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->project_html->Visible) { // project_html ?>
    <tr id="r_project_html"<?= $Page->project_html->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_project_html"><?= $Page->project_html->caption() ?></span></td>
        <td data-name="project_html"<?= $Page->project_html->cellAttributes() ?>>
<span id="el_projects_project_html" data-page="1">
<span<?= $Page->project_html->viewAttributes() ?>>
<?= $Page->project_html->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->project_headgbr->Visible) { // project_headgbr ?>
    <tr id="r_project_headgbr"<?= $Page->project_headgbr->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_project_headgbr"><?= $Page->project_headgbr->caption() ?></span></td>
        <td data-name="project_headgbr"<?= $Page->project_headgbr->cellAttributes() ?>>
<span id="el_projects_project_headgbr" data-page="1">
<span<?= $Page->project_headgbr->viewAttributes() ?>>
<?= $Page->project_headgbr->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->slug->Visible) { // slug ?>
    <tr id="r_slug"<?= $Page->slug->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_slug"><?= $Page->slug->caption() ?></span></td>
        <td data-name="slug"<?= $Page->slug->cellAttributes() ?>>
<span id="el_projects_slug" data-page="1">
<span<?= $Page->slug->viewAttributes() ?>>
<?= $Page->slug->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <tr id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_created_at"><?= $Page->created_at->caption() ?></span></td>
        <td data-name="created_at"<?= $Page->created_at->cellAttributes() ?>>
<span id="el_projects_created_at" data-page="1">
<span<?= $Page->created_at->viewAttributes() ?>>
<?= $Page->created_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <tr id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_projects_updated_at"><?= $Page->updated_at->caption() ?></span></td>
        <td data-name="updated_at"<?= $Page->updated_at->cellAttributes() ?>>
<span id="el_projects_updated_at" data-page="1">
<span<?= $Page->updated_at->viewAttributes() ?>>
<?= $Page->updated_at->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<?php
    $Page->DetailPages->ValidKeys = explode(",", $Page->getCurrentDetailTable());
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav<?= $Page->DetailPages->containerClasses() ?>" id="details_Page"><!-- tabs -->
    <ul class="<?= $Page->DetailPages->navClasses() ?>" role="tablist"><!-- .nav -->
<?php
    if (in_array("project_investors", explode(",", $Page->getCurrentDetailTable())) && $project_investors->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("project_investors") ?><?= $Page->DetailPages->activeClasses("project_investors") ?>" data-bs-target="#tab_project_investors" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_project_investors" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("project_investors")) ?>"><?= $Language->tablePhrase("project_investors", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("project_files", explode(",", $Page->getCurrentDetailTable())) && $project_files->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("project_files") ?><?= $Page->DetailPages->activeClasses("project_files") ?>" data-bs-target="#tab_project_files" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_project_files" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("project_files")) ?>"><?= $Language->tablePhrase("project_files", "TblCaption") ?></button></li>
<?php
    }
?>
    </ul><!-- /.nav -->
    <div class="<?= $Page->DetailPages->tabContentClasses() ?>"><!-- .tab-content -->
<?php
    if (in_array("project_investors", explode(",", $Page->getCurrentDetailTable())) && $project_investors->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("project_investors") ?><?= $Page->DetailPages->activeClasses("project_investors") ?>" id="tab_project_investors" role="tabpanel"><!-- page* -->
<?php include_once "ProjectInvestorsGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("project_files", explode(",", $Page->getCurrentDetailTable())) && $project_files->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("project_files") ?><?= $Page->DetailPages->activeClasses("project_files") ?>" id="tab_project_files" role="tabpanel"><!-- page* -->
<?php include_once "ProjectFilesGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
    </div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
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
