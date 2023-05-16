<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ProjectsUpdate = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { projects: currentTable } });
var currentPageID = ew.PAGE_ID = "update";
var currentForm;
var fprojectsupdate;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fprojectsupdate")
        .setPageId("update")

        // Add fields
        .setFields([
            ["project_category_id", [fields.project_category_id.visible && fields.project_category_id.required ? ew.Validators.required(fields.project_category_id.caption) : null], fields.project_category_id.isInvalid],
            ["project_provider_id", [fields.project_provider_id.visible && fields.project_provider_id.required ? ew.Validators.required(fields.project_provider_id.caption) : null], fields.project_provider_id.isInvalid],
            ["project_status_id", [fields.project_status_id.visible && fields.project_status_id.required ? ew.Validators.required(fields.project_status_id.caption) : null], fields.project_status_id.isInvalid],
            ["funding_source_id", [fields.funding_source_id.visible && fields.funding_source_id.required ? ew.Validators.required(fields.funding_source_id.caption) : null, ew.Validators.integer, ew.Validators.selected], fields.funding_source_id.isInvalid],
            ["project_name", [fields.project_name.visible && fields.project_name.required ? ew.Validators.required(fields.project_name.caption) : null], fields.project_name.isInvalid],
            ["project_description", [fields.project_description.visible && fields.project_description.required ? ew.Validators.required(fields.project_description.caption) : null], fields.project_description.isInvalid],
            ["project_budget", [fields.project_budget.visible && fields.project_budget.required ? ew.Validators.required(fields.project_budget.caption) : null, ew.Validators.float, ew.Validators.selected], fields.project_budget.isInvalid],
            ["project_target", [fields.project_target.visible && fields.project_target.required ? ew.Validators.required(fields.project_target.caption) : null], fields.project_target.isInvalid],
            ["project_start", [fields.project_start.visible && fields.project_start.required ? ew.Validators.required(fields.project_start.caption) : null, ew.Validators.datetime(fields.project_start.clientFormatPattern), ew.Validators.selected], fields.project_start.isInvalid],
            ["project_duration", [fields.project_duration.visible && fields.project_duration.required ? ew.Validators.required(fields.project_duration.caption) : null], fields.project_duration.isInvalid],
            ["project_html", [fields.project_html.visible && fields.project_html.required ? ew.Validators.required(fields.project_html.caption) : null], fields.project_html.isInvalid],
            ["project_headgbr", [fields.project_headgbr.visible && fields.project_headgbr.required ? ew.Validators.required(fields.project_headgbr.caption) : null], fields.project_headgbr.isInvalid],
            ["slug", [fields.slug.visible && fields.slug.required ? ew.Validators.required(fields.slug.caption) : null], fields.slug.isInvalid],
            ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(fields.created_at.clientFormatPattern), ew.Validators.selected], fields.created_at.isInvalid],
            ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(fields.updated_at.clientFormatPattern), ew.Validators.selected], fields.updated_at.isInvalid]
        ])

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
            "project_category_id": <?= $Page->project_category_id->toClientList($Page) ?>,
            "project_provider_id": <?= $Page->project_provider_id->toClientList($Page) ?>,
            "project_status_id": <?= $Page->project_status_id->toClientList($Page) ?>,
            "funding_source_id": <?= $Page->funding_source_id->toClientList($Page) ?>,
        })
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
<form name="fprojectsupdate" id="fprojectsupdate" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="projects">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div id="tbl_projectsupdate" class="ew-update-div"><!-- page -->
    <?php if (!$Page->isConfirm()) { // Confirm page ?>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="u" id="u" data-ew-action="select-all"><label class="form-check-label" for="u"><?= $Language->phrase("SelectAll") ?></label>
    </div>
    <?php } ?>
<?php if ($Page->project_category_id->Visible && (!$Page->isConfirm() || $Page->project_category_id->multiUpdateSelected())) { // project_category_id ?>
    <div id="r_project_category_id"<?= $Page->project_category_id->rowAttributes() ?>>
        <label for="x_project_category_id" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_project_category_id" id="u_project_category_id" class="form-check-input ew-multi-select" value="1"<?= $Page->project_category_id->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_project_category_id"><?= $Page->project_category_id->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->project_category_id->cellAttributes() ?>>
                <span id="el_projects_project_category_id">
                    <select
                        id="x_project_category_id"
                        name="x_project_category_id"
                        class="form-select ew-select<?= $Page->project_category_id->isInvalidClass() ?>"
                        <?php if (!$Page->project_category_id->IsNativeSelect) { ?>
                        data-select2-id="fprojectsupdate_x_project_category_id"
                        <?php } ?>
                        data-table="projects"
                        data-field="x_project_category_id"
                        data-value-separator="<?= $Page->project_category_id->displayValueSeparatorAttribute() ?>"
                        data-placeholder="<?= HtmlEncode($Page->project_category_id->getPlaceHolder()) ?>"
                        <?= $Page->project_category_id->editAttributes() ?>>
                        <?= $Page->project_category_id->selectOptionListHtml("x_project_category_id") ?>
                    </select>
                    <?= $Page->project_category_id->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->project_category_id->getErrorMessage() ?></div>
                <?= $Page->project_category_id->Lookup->getParamTag($Page, "p_x_project_category_id") ?>
                <?php if (!$Page->project_category_id->IsNativeSelect) { ?>
                <script>
                loadjs.ready("fprojectsupdate", function() {
                    var options = { name: "x_project_category_id", selectId: "fprojectsupdate_x_project_category_id" },
                        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                    if (!el)
                        return;
                    options.closeOnSelect = !options.multiple;
                    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                    if (fprojectsupdate.lists.project_category_id?.lookupOptions.length) {
                        options.data = { id: "x_project_category_id", form: "fprojectsupdate" };
                    } else {
                        options.ajax = { id: "x_project_category_id", form: "fprojectsupdate", limit: ew.LOOKUP_PAGE_SIZE };
                    }
                    options.minimumResultsForSearch = Infinity;
                    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.projects.fields.project_category_id.selectOptions);
                    ew.createSelect(options);
                });
                </script>
                <?php } ?>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->project_provider_id->Visible && (!$Page->isConfirm() || $Page->project_provider_id->multiUpdateSelected())) { // project_provider_id ?>
    <div id="r_project_provider_id"<?= $Page->project_provider_id->rowAttributes() ?>>
        <label for="x_project_provider_id" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_project_provider_id" id="u_project_provider_id" class="form-check-input ew-multi-select" value="1"<?= $Page->project_provider_id->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_project_provider_id"><?= $Page->project_provider_id->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->project_provider_id->cellAttributes() ?>>
                <span id="el_projects_project_provider_id">
                    <select
                        id="x_project_provider_id"
                        name="x_project_provider_id"
                        class="form-select ew-select<?= $Page->project_provider_id->isInvalidClass() ?>"
                        <?php if (!$Page->project_provider_id->IsNativeSelect) { ?>
                        data-select2-id="fprojectsupdate_x_project_provider_id"
                        <?php } ?>
                        data-table="projects"
                        data-field="x_project_provider_id"
                        data-value-separator="<?= $Page->project_provider_id->displayValueSeparatorAttribute() ?>"
                        data-placeholder="<?= HtmlEncode($Page->project_provider_id->getPlaceHolder()) ?>"
                        <?= $Page->project_provider_id->editAttributes() ?>>
                        <?= $Page->project_provider_id->selectOptionListHtml("x_project_provider_id") ?>
                    </select>
                    <?= $Page->project_provider_id->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->project_provider_id->getErrorMessage() ?></div>
                <?= $Page->project_provider_id->Lookup->getParamTag($Page, "p_x_project_provider_id") ?>
                <?php if (!$Page->project_provider_id->IsNativeSelect) { ?>
                <script>
                loadjs.ready("fprojectsupdate", function() {
                    var options = { name: "x_project_provider_id", selectId: "fprojectsupdate_x_project_provider_id" },
                        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                    if (!el)
                        return;
                    options.closeOnSelect = !options.multiple;
                    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                    if (fprojectsupdate.lists.project_provider_id?.lookupOptions.length) {
                        options.data = { id: "x_project_provider_id", form: "fprojectsupdate" };
                    } else {
                        options.ajax = { id: "x_project_provider_id", form: "fprojectsupdate", limit: ew.LOOKUP_PAGE_SIZE };
                    }
                    options.minimumResultsForSearch = Infinity;
                    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.projects.fields.project_provider_id.selectOptions);
                    ew.createSelect(options);
                });
                </script>
                <?php } ?>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->project_status_id->Visible && (!$Page->isConfirm() || $Page->project_status_id->multiUpdateSelected())) { // project_status_id ?>
    <div id="r_project_status_id"<?= $Page->project_status_id->rowAttributes() ?>>
        <label for="x_project_status_id" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_project_status_id" id="u_project_status_id" class="form-check-input ew-multi-select" value="1"<?= $Page->project_status_id->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_project_status_id"><?= $Page->project_status_id->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->project_status_id->cellAttributes() ?>>
                <span id="el_projects_project_status_id">
                    <select
                        id="x_project_status_id"
                        name="x_project_status_id"
                        class="form-select ew-select<?= $Page->project_status_id->isInvalidClass() ?>"
                        <?php if (!$Page->project_status_id->IsNativeSelect) { ?>
                        data-select2-id="fprojectsupdate_x_project_status_id"
                        <?php } ?>
                        data-table="projects"
                        data-field="x_project_status_id"
                        data-value-separator="<?= $Page->project_status_id->displayValueSeparatorAttribute() ?>"
                        data-placeholder="<?= HtmlEncode($Page->project_status_id->getPlaceHolder()) ?>"
                        <?= $Page->project_status_id->editAttributes() ?>>
                        <?= $Page->project_status_id->selectOptionListHtml("x_project_status_id") ?>
                    </select>
                    <?= $Page->project_status_id->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->project_status_id->getErrorMessage() ?></div>
                <?= $Page->project_status_id->Lookup->getParamTag($Page, "p_x_project_status_id") ?>
                <?php if (!$Page->project_status_id->IsNativeSelect) { ?>
                <script>
                loadjs.ready("fprojectsupdate", function() {
                    var options = { name: "x_project_status_id", selectId: "fprojectsupdate_x_project_status_id" },
                        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                    if (!el)
                        return;
                    options.closeOnSelect = !options.multiple;
                    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                    if (fprojectsupdate.lists.project_status_id?.lookupOptions.length) {
                        options.data = { id: "x_project_status_id", form: "fprojectsupdate" };
                    } else {
                        options.ajax = { id: "x_project_status_id", form: "fprojectsupdate", limit: ew.LOOKUP_PAGE_SIZE };
                    }
                    options.minimumResultsForSearch = Infinity;
                    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.projects.fields.project_status_id.selectOptions);
                    ew.createSelect(options);
                });
                </script>
                <?php } ?>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->funding_source_id->Visible && (!$Page->isConfirm() || $Page->funding_source_id->multiUpdateSelected())) { // funding_source_id ?>
    <div id="r_funding_source_id"<?= $Page->funding_source_id->rowAttributes() ?>>
        <label class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_funding_source_id" id="u_funding_source_id" class="form-check-input ew-multi-select" value="1"<?= $Page->funding_source_id->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_funding_source_id"><?= $Page->funding_source_id->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->funding_source_id->cellAttributes() ?>>
                <span id="el_projects_funding_source_id">
                <?php
                if (IsRTL()) {
                    $Page->funding_source_id->EditAttrs["dir"] = "rtl";
                }
                ?>
                <span id="as_x_funding_source_id" class="ew-auto-suggest">
                    <input type="<?= $Page->funding_source_id->getInputTextType() ?>" class="form-control" name="sv_x_funding_source_id" id="sv_x_funding_source_id" value="<?= RemoveHtml($Page->funding_source_id->EditValue) ?>" autocomplete="off" size="30" placeholder="<?= HtmlEncode($Page->funding_source_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->funding_source_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->funding_source_id->formatPattern()) ?>"<?= $Page->funding_source_id->editAttributes() ?> aria-describedby="x_funding_source_id_help">
                </span>
                <selection-list hidden class="form-control" data-table="projects" data-field="x_funding_source_id" data-input="sv_x_funding_source_id" data-value-separator="<?= $Page->funding_source_id->displayValueSeparatorAttribute() ?>" name="x_funding_source_id" id="x_funding_source_id" value="<?= HtmlEncode($Page->funding_source_id->CurrentValue) ?>"></selection-list>
                <?= $Page->funding_source_id->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->funding_source_id->getErrorMessage() ?></div>
                <script>
                loadjs.ready("fprojectsupdate", function() {
                    fprojectsupdate.createAutoSuggest(Object.assign({"id":"x_funding_source_id","forceSelect":false}, { lookupAllDisplayFields: <?= $Page->funding_source_id->Lookup->LookupAllDisplayFields ? "true" : "false" ?> }, ew.vars.tables.projects.fields.funding_source_id.autoSuggestOptions));
                });
                </script>
                <?= $Page->funding_source_id->Lookup->getParamTag($Page, "p_x_funding_source_id") ?>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->project_name->Visible && (!$Page->isConfirm() || $Page->project_name->multiUpdateSelected())) { // project_name ?>
    <div id="r_project_name"<?= $Page->project_name->rowAttributes() ?>>
        <label for="x_project_name" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_project_name" id="u_project_name" class="form-check-input ew-multi-select" value="1"<?= $Page->project_name->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_project_name"><?= $Page->project_name->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->project_name->cellAttributes() ?>>
                <span id="el_projects_project_name">
                <input type="<?= $Page->project_name->getInputTextType() ?>" name="x_project_name" id="x_project_name" data-table="projects" data-field="x_project_name" value="<?= $Page->project_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->project_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->project_name->formatPattern()) ?>"<?= $Page->project_name->editAttributes() ?> aria-describedby="x_project_name_help">
                <?= $Page->project_name->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->project_name->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->project_description->Visible && (!$Page->isConfirm() || $Page->project_description->multiUpdateSelected())) { // project_description ?>
    <div id="r_project_description"<?= $Page->project_description->rowAttributes() ?>>
        <label class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_project_description" id="u_project_description" class="form-check-input ew-multi-select" value="1"<?= $Page->project_description->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_project_description"><?= $Page->project_description->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->project_description->cellAttributes() ?>>
                <span id="el_projects_project_description">
                <?php $Page->project_description->EditAttrs->appendClass("editor"); ?>
                <textarea data-table="projects" data-field="x_project_description" name="x_project_description" id="x_project_description" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->project_description->getPlaceHolder()) ?>"<?= $Page->project_description->editAttributes() ?> aria-describedby="x_project_description_help"><?= $Page->project_description->EditValue ?></textarea>
                <?= $Page->project_description->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->project_description->getErrorMessage() ?></div>
                <script>
                loadjs.ready(["fprojectsupdate", "editor"], function() {
                    ew.createEditor("fprojectsupdate", "x_project_description", 35, 4, <?= $Page->project_description->ReadOnly || false ? "true" : "false" ?>);
                });
                </script>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->project_budget->Visible && (!$Page->isConfirm() || $Page->project_budget->multiUpdateSelected())) { // project_budget ?>
    <div id="r_project_budget"<?= $Page->project_budget->rowAttributes() ?>>
        <label for="x_project_budget" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_project_budget" id="u_project_budget" class="form-check-input ew-multi-select" value="1"<?= $Page->project_budget->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_project_budget"><?= $Page->project_budget->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->project_budget->cellAttributes() ?>>
                <span id="el_projects_project_budget">
                <input type="<?= $Page->project_budget->getInputTextType() ?>" name="x_project_budget" id="x_project_budget" data-table="projects" data-field="x_project_budget" value="<?= $Page->project_budget->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->project_budget->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->project_budget->formatPattern()) ?>"<?= $Page->project_budget->editAttributes() ?> aria-describedby="x_project_budget_help">
                <?= $Page->project_budget->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->project_budget->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->project_target->Visible && (!$Page->isConfirm() || $Page->project_target->multiUpdateSelected())) { // project_target ?>
    <div id="r_project_target"<?= $Page->project_target->rowAttributes() ?>>
        <label for="x_project_target" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_project_target" id="u_project_target" class="form-check-input ew-multi-select" value="1"<?= $Page->project_target->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_project_target"><?= $Page->project_target->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->project_target->cellAttributes() ?>>
                <span id="el_projects_project_target">
                <textarea data-table="projects" data-field="x_project_target" name="x_project_target" id="x_project_target" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->project_target->getPlaceHolder()) ?>"<?= $Page->project_target->editAttributes() ?> aria-describedby="x_project_target_help"><?= $Page->project_target->EditValue ?></textarea>
                <?= $Page->project_target->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->project_target->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->project_start->Visible && (!$Page->isConfirm() || $Page->project_start->multiUpdateSelected())) { // project_start ?>
    <div id="r_project_start"<?= $Page->project_start->rowAttributes() ?>>
        <label for="x_project_start" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_project_start" id="u_project_start" class="form-check-input ew-multi-select" value="1"<?= $Page->project_start->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_project_start"><?= $Page->project_start->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->project_start->cellAttributes() ?>>
                <span id="el_projects_project_start">
                <input type="<?= $Page->project_start->getInputTextType() ?>" name="x_project_start" id="x_project_start" data-table="projects" data-field="x_project_start" value="<?= $Page->project_start->EditValue ?>" placeholder="<?= HtmlEncode($Page->project_start->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->project_start->formatPattern()) ?>"<?= $Page->project_start->editAttributes() ?> aria-describedby="x_project_start_help">
                <?= $Page->project_start->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->project_start->getErrorMessage() ?></div>
                <?php if (!$Page->project_start->ReadOnly && !$Page->project_start->Disabled && !isset($Page->project_start->EditAttrs["readonly"]) && !isset($Page->project_start->EditAttrs["disabled"])) { ?>
                <script>
                loadjs.ready(["fprojectsupdate", "datetimepicker"], function () {
                    let format = "<?= DateFormat(0) ?>",
                        options = {
                            localization: {
                                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                                hourCycle: format.match(/H/) ? "h24" : "h12",
                                format,
                                ...ew.language.phrase("datetimepicker")
                            },
                            display: {
                                icons: {
                                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                                },
                                components: {
                                    hours: !!format.match(/h/i),
                                    minutes: !!format.match(/m/),
                                    seconds: !!format.match(/s/i)
                                },
                                theme: ew.isDark() ? "dark" : "auto"
                            }
                        };
                    ew.createDateTimePicker("fprojectsupdate", "x_project_start", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
                });
                </script>
                <?php } ?>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->project_duration->Visible && (!$Page->isConfirm() || $Page->project_duration->multiUpdateSelected())) { // project_duration ?>
    <div id="r_project_duration"<?= $Page->project_duration->rowAttributes() ?>>
        <label for="x_project_duration" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_project_duration" id="u_project_duration" class="form-check-input ew-multi-select" value="1"<?= $Page->project_duration->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_project_duration"><?= $Page->project_duration->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->project_duration->cellAttributes() ?>>
                <span id="el_projects_project_duration">
                <input type="<?= $Page->project_duration->getInputTextType() ?>" name="x_project_duration" id="x_project_duration" data-table="projects" data-field="x_project_duration" value="<?= $Page->project_duration->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->project_duration->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->project_duration->formatPattern()) ?>"<?= $Page->project_duration->editAttributes() ?> aria-describedby="x_project_duration_help">
                <?= $Page->project_duration->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->project_duration->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->project_html->Visible && (!$Page->isConfirm() || $Page->project_html->multiUpdateSelected())) { // project_html ?>
    <div id="r_project_html"<?= $Page->project_html->rowAttributes() ?>>
        <label class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_project_html" id="u_project_html" class="form-check-input ew-multi-select" value="1"<?= $Page->project_html->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_project_html"><?= $Page->project_html->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->project_html->cellAttributes() ?>>
                <span id="el_projects_project_html">
                <?php $Page->project_html->EditAttrs->appendClass("editor"); ?>
                <textarea data-table="projects" data-field="x_project_html" name="x_project_html" id="x_project_html" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->project_html->getPlaceHolder()) ?>"<?= $Page->project_html->editAttributes() ?> aria-describedby="x_project_html_help"><?= $Page->project_html->EditValue ?></textarea>
                <?= $Page->project_html->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->project_html->getErrorMessage() ?></div>
                <script>
                loadjs.ready(["fprojectsupdate", "editor"], function() {
                    ew.createEditor("fprojectsupdate", "x_project_html", 0, 0, <?= $Page->project_html->ReadOnly || false ? "true" : "false" ?>);
                });
                </script>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->project_headgbr->Visible && (!$Page->isConfirm() || $Page->project_headgbr->multiUpdateSelected())) { // project_headgbr ?>
    <div id="r_project_headgbr"<?= $Page->project_headgbr->rowAttributes() ?>>
        <label for="x_project_headgbr" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_project_headgbr" id="u_project_headgbr" class="form-check-input ew-multi-select" value="1"<?= $Page->project_headgbr->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_project_headgbr"><?= $Page->project_headgbr->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->project_headgbr->cellAttributes() ?>>
                <span id="el_projects_project_headgbr">
                <textarea data-table="projects" data-field="x_project_headgbr" name="x_project_headgbr" id="x_project_headgbr" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->project_headgbr->getPlaceHolder()) ?>"<?= $Page->project_headgbr->editAttributes() ?> aria-describedby="x_project_headgbr_help"><?= $Page->project_headgbr->EditValue ?></textarea>
                <?= $Page->project_headgbr->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->project_headgbr->getErrorMessage() ?></div>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible && (!$Page->isConfirm() || $Page->created_at->multiUpdateSelected())) { // created_at ?>
    <div id="r_created_at"<?= $Page->created_at->rowAttributes() ?>>
        <label for="x_created_at" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_created_at" id="u_created_at" class="form-check-input ew-multi-select" value="1"<?= $Page->created_at->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_created_at"><?= $Page->created_at->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->created_at->cellAttributes() ?>>
                <span id="el_projects_created_at">
                <input type="<?= $Page->created_at->getInputTextType() ?>" name="x_created_at" id="x_created_at" data-table="projects" data-field="x_created_at" value="<?= $Page->created_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->created_at->formatPattern()) ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
                <?= $Page->created_at->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
                <?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
                <script>
                loadjs.ready(["fprojectsupdate", "datetimepicker"], function () {
                    let format = "<?= DateFormat(0) ?>",
                        options = {
                            localization: {
                                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                                hourCycle: format.match(/H/) ? "h24" : "h12",
                                format,
                                ...ew.language.phrase("datetimepicker")
                            },
                            display: {
                                icons: {
                                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                                },
                                components: {
                                    hours: !!format.match(/h/i),
                                    minutes: !!format.match(/m/),
                                    seconds: !!format.match(/s/i)
                                },
                                theme: ew.isDark() ? "dark" : "auto"
                            }
                        };
                    ew.createDateTimePicker("fprojectsupdate", "x_created_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
                });
                </script>
                <?php } ?>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible && (!$Page->isConfirm() || $Page->updated_at->multiUpdateSelected())) { // updated_at ?>
    <div id="r_updated_at"<?= $Page->updated_at->rowAttributes() ?>>
        <label for="x_updated_at" class="<?= $Page->LeftColumnClass ?>">
            <div class="form-check">
                <input type="checkbox" name="u_updated_at" id="u_updated_at" class="form-check-input ew-multi-select" value="1"<?= $Page->updated_at->multiUpdateSelected() ? " checked" : "" ?>>
                <label class="form-check-label" for="u_updated_at"><?= $Page->updated_at->caption() ?></label>
            </div>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->updated_at->cellAttributes() ?>>
                <span id="el_projects_updated_at">
                <input type="<?= $Page->updated_at->getInputTextType() ?>" name="x_updated_at" id="x_updated_at" data-table="projects" data-field="x_updated_at" value="<?= $Page->updated_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->updated_at->formatPattern()) ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
                <?= $Page->updated_at->getCustomMessage() ?>
                <div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
                <?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
                <script>
                loadjs.ready(["fprojectsupdate", "datetimepicker"], function () {
                    let format = "<?= DateFormat(0) ?>",
                        options = {
                            localization: {
                                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem(),
                                hourCycle: format.match(/H/) ? "h24" : "h12",
                                format,
                                ...ew.language.phrase("datetimepicker")
                            },
                            display: {
                                icons: {
                                    previous: ew.IS_RTL ? "fa-solid fa-chevron-right" : "fa-solid fa-chevron-left",
                                    next: ew.IS_RTL ? "fa-solid fa-chevron-left" : "fa-solid fa-chevron-right"
                                },
                                components: {
                                    hours: !!format.match(/h/i),
                                    minutes: !!format.match(/m/),
                                    seconds: !!format.match(/s/i)
                                },
                                theme: ew.isDark() ? "dark" : "auto"
                            }
                        };
                    ew.createDateTimePicker("fprojectsupdate", "x_updated_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
                });
                </script>
                <?php } ?>
                </span>
            </div>
        </div>
    </div>
<?php } ?>
</div><!-- /page -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fprojectsupdate"><?= $Language->phrase("UpdateBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fprojectsupdate" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
