<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ProjectInvestorsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { project_investors: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fproject_investorsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fproject_investorsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["project_id", [fields.project_id.visible && fields.project_id.required ? ew.Validators.required(fields.project_id.caption) : null], fields.project_id.isInvalid],
            ["investor_id", [fields.investor_id.visible && fields.investor_id.required ? ew.Validators.required(fields.investor_id.caption) : null], fields.investor_id.isInvalid],
            ["contribution_amount", [fields.contribution_amount.visible && fields.contribution_amount.required ? ew.Validators.required(fields.contribution_amount.caption) : null, ew.Validators.float], fields.contribution_amount.isInvalid],
            ["slug", [fields.slug.visible && fields.slug.required ? ew.Validators.required(fields.slug.caption) : null], fields.slug.isInvalid],
            ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null], fields.created_at.isInvalid],
            ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null], fields.updated_at.isInvalid]
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
            "project_id": <?= $Page->project_id->toClientList($Page) ?>,
            "investor_id": <?= $Page->investor_id->toClientList($Page) ?>,
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
<form name="fproject_investorsadd" id="fproject_investorsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="project_investors">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "projects") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="projects">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->project_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->project_id->Visible) { // project_id ?>
    <div id="r_project_id"<?= $Page->project_id->rowAttributes() ?>>
        <label id="elh_project_investors_project_id" for="x_project_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->project_id->caption() ?><?= $Page->project_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->project_id->cellAttributes() ?>>
<?php if ($Page->project_id->getSessionValue() != "") { ?>
<span<?= $Page->project_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Page->project_id->getDisplayValue($Page->project_id->ViewValue) ?></span></span>
<input type="hidden" id="x_project_id" name="x_project_id" value="<?= HtmlEncode($Page->project_id->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_project_investors_project_id">
    <select
        id="x_project_id"
        name="x_project_id"
        class="form-select ew-select<?= $Page->project_id->isInvalidClass() ?>"
        <?php if (!$Page->project_id->IsNativeSelect) { ?>
        data-select2-id="fproject_investorsadd_x_project_id"
        <?php } ?>
        data-table="project_investors"
        data-field="x_project_id"
        data-value-separator="<?= $Page->project_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->project_id->getPlaceHolder()) ?>"
        <?= $Page->project_id->editAttributes() ?>>
        <?= $Page->project_id->selectOptionListHtml("x_project_id") ?>
    </select>
    <?= $Page->project_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->project_id->getErrorMessage() ?></div>
<?= $Page->project_id->Lookup->getParamTag($Page, "p_x_project_id") ?>
<?php if (!$Page->project_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fproject_investorsadd", function() {
    var options = { name: "x_project_id", selectId: "fproject_investorsadd_x_project_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fproject_investorsadd.lists.project_id?.lookupOptions.length) {
        options.data = { id: "x_project_id", form: "fproject_investorsadd" };
    } else {
        options.ajax = { id: "x_project_id", form: "fproject_investorsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.project_investors.fields.project_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->investor_id->Visible) { // investor_id ?>
    <div id="r_investor_id"<?= $Page->investor_id->rowAttributes() ?>>
        <label id="elh_project_investors_investor_id" for="x_investor_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->investor_id->caption() ?><?= $Page->investor_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->investor_id->cellAttributes() ?>>
<span id="el_project_investors_investor_id">
    <select
        id="x_investor_id"
        name="x_investor_id"
        class="form-select ew-select<?= $Page->investor_id->isInvalidClass() ?>"
        <?php if (!$Page->investor_id->IsNativeSelect) { ?>
        data-select2-id="fproject_investorsadd_x_investor_id"
        <?php } ?>
        data-table="project_investors"
        data-field="x_investor_id"
        data-value-separator="<?= $Page->investor_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->investor_id->getPlaceHolder()) ?>"
        <?= $Page->investor_id->editAttributes() ?>>
        <?= $Page->investor_id->selectOptionListHtml("x_investor_id") ?>
    </select>
    <?= $Page->investor_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->investor_id->getErrorMessage() ?></div>
<?= $Page->investor_id->Lookup->getParamTag($Page, "p_x_investor_id") ?>
<?php if (!$Page->investor_id->IsNativeSelect) { ?>
<script>
loadjs.ready("fproject_investorsadd", function() {
    var options = { name: "x_investor_id", selectId: "fproject_investorsadd_x_investor_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    if (!el)
        return;
    options.closeOnSelect = !options.multiple;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fproject_investorsadd.lists.investor_id?.lookupOptions.length) {
        options.data = { id: "x_investor_id", form: "fproject_investorsadd" };
    } else {
        options.ajax = { id: "x_investor_id", form: "fproject_investorsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.project_investors.fields.investor_id.selectOptions);
    ew.createSelect(options);
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->contribution_amount->Visible) { // contribution_amount ?>
    <div id="r_contribution_amount"<?= $Page->contribution_amount->rowAttributes() ?>>
        <label id="elh_project_investors_contribution_amount" for="x_contribution_amount" class="<?= $Page->LeftColumnClass ?>"><?= $Page->contribution_amount->caption() ?><?= $Page->contribution_amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->contribution_amount->cellAttributes() ?>>
<span id="el_project_investors_contribution_amount">
<input type="<?= $Page->contribution_amount->getInputTextType() ?>" name="x_contribution_amount" id="x_contribution_amount" data-table="project_investors" data-field="x_contribution_amount" value="<?= $Page->contribution_amount->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->contribution_amount->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->contribution_amount->formatPattern()) ?>"<?= $Page->contribution_amount->editAttributes() ?> aria-describedby="x_contribution_amount_help">
<?= $Page->contribution_amount->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->contribution_amount->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->slug->Visible) { // slug ?>
    <div id="r_slug"<?= $Page->slug->rowAttributes() ?>>
        <label id="elh_project_investors_slug" for="x_slug" class="<?= $Page->LeftColumnClass ?>"><?= $Page->slug->caption() ?><?= $Page->slug->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->slug->cellAttributes() ?>>
<span id="el_project_investors_slug">
<input type="<?= $Page->slug->getInputTextType() ?>" name="x_slug" id="x_slug" data-table="project_investors" data-field="x_slug" value="<?= $Page->slug->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->slug->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->slug->formatPattern()) ?>"<?= $Page->slug->editAttributes() ?> aria-describedby="x_slug_help">
<?= $Page->slug->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->slug->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fproject_investorsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fproject_investorsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
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
    ew.addEventHandlers("project_investors");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
