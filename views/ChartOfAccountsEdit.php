<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$ChartOfAccountsEdit = &$Page;
?>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<main class="edit">
<form name="fchart_of_accountsedit" id="fchart_of_accountsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { chart_of_accounts: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fchart_of_accountsedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fchart_of_accountsedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.integer], fields.id.isInvalid],
            ["account_code", [fields.account_code.visible && fields.account_code.required ? ew.Validators.required(fields.account_code.caption) : null], fields.account_code.isInvalid],
            ["account_name", [fields.account_name.visible && fields.account_name.required ? ew.Validators.required(fields.account_name.caption) : null], fields.account_name.isInvalid],
            ["parent_account_id", [fields.parent_account_id.visible && fields.parent_account_id.required ? ew.Validators.required(fields.parent_account_id.caption) : null, ew.Validators.integer], fields.parent_account_id.isInvalid],
            ["normal_balance", [fields.normal_balance.visible && fields.normal_balance.required ? ew.Validators.required(fields.normal_balance.caption) : null], fields.normal_balance.isInvalid],
            ["type_account", [fields.type_account.visible && fields.type_account.required ? ew.Validators.required(fields.type_account.caption) : null], fields.type_account.isInvalid]
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
        })
        .build();
    window[form.id] = form;
    currentForm = form;
    loadjs.done(form.id);
});
</script>
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="chart_of_accounts">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_chart_of_accounts_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_chart_of_accounts_id">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="chart_of_accounts" data-field="x_id" value="<?= $Page->id->EditValue ?>" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->id->formatPattern()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
<input type="hidden" data-table="chart_of_accounts" data-field="x_id" data-hidden="1" data-old name="o_id" id="o_id" value="<?= HtmlEncode($Page->id->OldValue ?? $Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->account_code->Visible) { // account_code ?>
    <div id="r_account_code"<?= $Page->account_code->rowAttributes() ?>>
        <label id="elh_chart_of_accounts_account_code" for="x_account_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->account_code->caption() ?><?= $Page->account_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->account_code->cellAttributes() ?>>
<span id="el_chart_of_accounts_account_code">
<input type="<?= $Page->account_code->getInputTextType() ?>" name="x_account_code" id="x_account_code" data-table="chart_of_accounts" data-field="x_account_code" value="<?= $Page->account_code->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->account_code->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->account_code->formatPattern()) ?>"<?= $Page->account_code->editAttributes() ?> aria-describedby="x_account_code_help">
<?= $Page->account_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->account_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->account_name->Visible) { // account_name ?>
    <div id="r_account_name"<?= $Page->account_name->rowAttributes() ?>>
        <label id="elh_chart_of_accounts_account_name" for="x_account_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->account_name->caption() ?><?= $Page->account_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->account_name->cellAttributes() ?>>
<span id="el_chart_of_accounts_account_name">
<input type="<?= $Page->account_name->getInputTextType() ?>" name="x_account_name" id="x_account_name" data-table="chart_of_accounts" data-field="x_account_name" value="<?= $Page->account_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->account_name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->account_name->formatPattern()) ?>"<?= $Page->account_name->editAttributes() ?> aria-describedby="x_account_name_help">
<?= $Page->account_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->account_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->parent_account_id->Visible) { // parent_account_id ?>
    <div id="r_parent_account_id"<?= $Page->parent_account_id->rowAttributes() ?>>
        <label id="elh_chart_of_accounts_parent_account_id" for="x_parent_account_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->parent_account_id->caption() ?><?= $Page->parent_account_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->parent_account_id->cellAttributes() ?>>
<span id="el_chart_of_accounts_parent_account_id">
<input type="<?= $Page->parent_account_id->getInputTextType() ?>" name="x_parent_account_id" id="x_parent_account_id" data-table="chart_of_accounts" data-field="x_parent_account_id" value="<?= $Page->parent_account_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->parent_account_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->parent_account_id->formatPattern()) ?>"<?= $Page->parent_account_id->editAttributes() ?> aria-describedby="x_parent_account_id_help">
<?= $Page->parent_account_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->parent_account_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fchart_of_accountsedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fchart_of_accountsedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
    </div><!-- /buttons offset -->
<?= $Page->IsModal ? "</template>" : "</div>" ?><!-- /buttons .row -->
</form>
</main>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("chart_of_accounts");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
