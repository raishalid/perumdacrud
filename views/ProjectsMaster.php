<?php

namespace PHPMaker2023\crudperumdautama;

// Table
$projects = Container("projects");
?>
<?php if ($projects->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_projectsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($projects->id->Visible) { // id ?>
        <tr id="r_id"<?= $projects->id->rowAttributes() ?>>
            <td class="<?= $projects->TableLeftColumnClass ?>"><?= $projects->id->caption() ?></td>
            <td<?= $projects->id->cellAttributes() ?>>
<span id="el_projects_id">
<span<?= $projects->id->viewAttributes() ?>>
<?= $projects->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($projects->project_category_id->Visible) { // project_category_id ?>
        <tr id="r_project_category_id"<?= $projects->project_category_id->rowAttributes() ?>>
            <td class="<?= $projects->TableLeftColumnClass ?>"><?= $projects->project_category_id->caption() ?></td>
            <td<?= $projects->project_category_id->cellAttributes() ?>>
<span id="el_projects_project_category_id">
<span<?= $projects->project_category_id->viewAttributes() ?>>
<?= $projects->project_category_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($projects->project_provider_id->Visible) { // project_provider_id ?>
        <tr id="r_project_provider_id"<?= $projects->project_provider_id->rowAttributes() ?>>
            <td class="<?= $projects->TableLeftColumnClass ?>"><?= $projects->project_provider_id->caption() ?></td>
            <td<?= $projects->project_provider_id->cellAttributes() ?>>
<span id="el_projects_project_provider_id">
<span<?= $projects->project_provider_id->viewAttributes() ?>>
<?= $projects->project_provider_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($projects->project_status_id->Visible) { // project_status_id ?>
        <tr id="r_project_status_id"<?= $projects->project_status_id->rowAttributes() ?>>
            <td class="<?= $projects->TableLeftColumnClass ?>"><?= $projects->project_status_id->caption() ?></td>
            <td<?= $projects->project_status_id->cellAttributes() ?>>
<span id="el_projects_project_status_id">
<span<?= $projects->project_status_id->viewAttributes() ?>>
<?= $projects->project_status_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($projects->funding_source_id->Visible) { // funding_source_id ?>
        <tr id="r_funding_source_id"<?= $projects->funding_source_id->rowAttributes() ?>>
            <td class="<?= $projects->TableLeftColumnClass ?>"><?= $projects->funding_source_id->caption() ?></td>
            <td<?= $projects->funding_source_id->cellAttributes() ?>>
<span id="el_projects_funding_source_id">
<span<?= $projects->funding_source_id->viewAttributes() ?>>
<?= $projects->funding_source_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($projects->project_name->Visible) { // project_name ?>
        <tr id="r_project_name"<?= $projects->project_name->rowAttributes() ?>>
            <td class="<?= $projects->TableLeftColumnClass ?>"><?= $projects->project_name->caption() ?></td>
            <td<?= $projects->project_name->cellAttributes() ?>>
<span id="el_projects_project_name">
<span<?= $projects->project_name->viewAttributes() ?>>
<?= $projects->project_name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($projects->project_budget->Visible) { // project_budget ?>
        <tr id="r_project_budget"<?= $projects->project_budget->rowAttributes() ?>>
            <td class="<?= $projects->TableLeftColumnClass ?>"><?= $projects->project_budget->caption() ?></td>
            <td<?= $projects->project_budget->cellAttributes() ?>>
<span id="el_projects_project_budget">
<span<?= $projects->project_budget->viewAttributes() ?>>
<?= $projects->project_budget->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($projects->project_start->Visible) { // project_start ?>
        <tr id="r_project_start"<?= $projects->project_start->rowAttributes() ?>>
            <td class="<?= $projects->TableLeftColumnClass ?>"><?= $projects->project_start->caption() ?></td>
            <td<?= $projects->project_start->cellAttributes() ?>>
<span id="el_projects_project_start">
<span<?= $projects->project_start->viewAttributes() ?>>
<?= $projects->project_start->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($projects->project_duration->Visible) { // project_duration ?>
        <tr id="r_project_duration"<?= $projects->project_duration->rowAttributes() ?>>
            <td class="<?= $projects->TableLeftColumnClass ?>"><?= $projects->project_duration->caption() ?></td>
            <td<?= $projects->project_duration->cellAttributes() ?>>
<span id="el_projects_project_duration">
<span<?= $projects->project_duration->viewAttributes() ?>>
<?= $projects->project_duration->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($projects->project_html->Visible) { // project_html ?>
        <tr id="r_project_html"<?= $projects->project_html->rowAttributes() ?>>
            <td class="<?= $projects->TableLeftColumnClass ?>"><?= $projects->project_html->caption() ?></td>
            <td<?= $projects->project_html->cellAttributes() ?>>
<span id="el_projects_project_html">
<span<?= $projects->project_html->viewAttributes() ?>>
<?= $projects->project_html->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($projects->slug->Visible) { // slug ?>
        <tr id="r_slug"<?= $projects->slug->rowAttributes() ?>>
            <td class="<?= $projects->TableLeftColumnClass ?>"><?= $projects->slug->caption() ?></td>
            <td<?= $projects->slug->cellAttributes() ?>>
<span id="el_projects_slug">
<span<?= $projects->slug->viewAttributes() ?>>
<?= $projects->slug->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($projects->created_at->Visible) { // created_at ?>
        <tr id="r_created_at"<?= $projects->created_at->rowAttributes() ?>>
            <td class="<?= $projects->TableLeftColumnClass ?>"><?= $projects->created_at->caption() ?></td>
            <td<?= $projects->created_at->cellAttributes() ?>>
<span id="el_projects_created_at">
<span<?= $projects->created_at->viewAttributes() ?>>
<?= $projects->created_at->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($projects->updated_at->Visible) { // updated_at ?>
        <tr id="r_updated_at"<?= $projects->updated_at->rowAttributes() ?>>
            <td class="<?= $projects->TableLeftColumnClass ?>"><?= $projects->updated_at->caption() ?></td>
            <td<?= $projects->updated_at->cellAttributes() ?>>
<span id="el_projects_updated_at">
<span<?= $projects->updated_at->viewAttributes() ?>>
<?= $projects->updated_at->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
