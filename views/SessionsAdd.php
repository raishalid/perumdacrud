<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$SessionsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { sessions: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var fsessionsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fsessionsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["user_id", [fields.user_id.visible && fields.user_id.required ? ew.Validators.required(fields.user_id.caption) : null, ew.Validators.integer], fields.user_id.isInvalid],
            ["ip_address", [fields.ip_address.visible && fields.ip_address.required ? ew.Validators.required(fields.ip_address.caption) : null], fields.ip_address.isInvalid],
            ["user_agent", [fields.user_agent.visible && fields.user_agent.required ? ew.Validators.required(fields.user_agent.caption) : null], fields.user_agent.isInvalid],
            ["payload", [fields.payload.visible && fields.payload.required ? ew.Validators.required(fields.payload.caption) : null], fields.payload.isInvalid],
            ["last_activity", [fields.last_activity.visible && fields.last_activity.required ? ew.Validators.required(fields.last_activity.caption) : null, ew.Validators.integer], fields.last_activity.isInvalid]
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
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fsessionsadd" id="fsessionsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="sessions">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_sessions_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_sessions_id">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="sessions" data-field="x_id" value="<?= $Page->id->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->id->formatPattern()) ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user_id->Visible) { // user_id ?>
    <div id="r_user_id"<?= $Page->user_id->rowAttributes() ?>>
        <label id="elh_sessions_user_id" for="x_user_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_id->caption() ?><?= $Page->user_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user_id->cellAttributes() ?>>
<span id="el_sessions_user_id">
<input type="<?= $Page->user_id->getInputTextType() ?>" name="x_user_id" id="x_user_id" data-table="sessions" data-field="x_user_id" value="<?= $Page->user_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->user_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->user_id->formatPattern()) ?>"<?= $Page->user_id->editAttributes() ?> aria-describedby="x_user_id_help">
<?= $Page->user_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ip_address->Visible) { // ip_address ?>
    <div id="r_ip_address"<?= $Page->ip_address->rowAttributes() ?>>
        <label id="elh_sessions_ip_address" for="x_ip_address" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ip_address->caption() ?><?= $Page->ip_address->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ip_address->cellAttributes() ?>>
<span id="el_sessions_ip_address">
<input type="<?= $Page->ip_address->getInputTextType() ?>" name="x_ip_address" id="x_ip_address" data-table="sessions" data-field="x_ip_address" value="<?= $Page->ip_address->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->ip_address->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->ip_address->formatPattern()) ?>"<?= $Page->ip_address->editAttributes() ?> aria-describedby="x_ip_address_help">
<?= $Page->ip_address->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ip_address->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user_agent->Visible) { // user_agent ?>
    <div id="r_user_agent"<?= $Page->user_agent->rowAttributes() ?>>
        <label id="elh_sessions_user_agent" for="x_user_agent" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user_agent->caption() ?><?= $Page->user_agent->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user_agent->cellAttributes() ?>>
<span id="el_sessions_user_agent">
<textarea data-table="sessions" data-field="x_user_agent" name="x_user_agent" id="x_user_agent" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->user_agent->getPlaceHolder()) ?>"<?= $Page->user_agent->editAttributes() ?> aria-describedby="x_user_agent_help"><?= $Page->user_agent->EditValue ?></textarea>
<?= $Page->user_agent->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user_agent->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->payload->Visible) { // payload ?>
    <div id="r_payload"<?= $Page->payload->rowAttributes() ?>>
        <label id="elh_sessions_payload" for="x_payload" class="<?= $Page->LeftColumnClass ?>"><?= $Page->payload->caption() ?><?= $Page->payload->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->payload->cellAttributes() ?>>
<span id="el_sessions_payload">
<textarea data-table="sessions" data-field="x_payload" name="x_payload" id="x_payload" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->payload->getPlaceHolder()) ?>"<?= $Page->payload->editAttributes() ?> aria-describedby="x_payload_help"><?= $Page->payload->EditValue ?></textarea>
<?= $Page->payload->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->payload->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->last_activity->Visible) { // last_activity ?>
    <div id="r_last_activity"<?= $Page->last_activity->rowAttributes() ?>>
        <label id="elh_sessions_last_activity" for="x_last_activity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->last_activity->caption() ?><?= $Page->last_activity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->last_activity->cellAttributes() ?>>
<span id="el_sessions_last_activity">
<input type="<?= $Page->last_activity->getInputTextType() ?>" name="x_last_activity" id="x_last_activity" data-table="sessions" data-field="x_last_activity" value="<?= $Page->last_activity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->last_activity->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->last_activity->formatPattern()) ?>"<?= $Page->last_activity->editAttributes() ?> aria-describedby="x_last_activity_help">
<?= $Page->last_activity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->last_activity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fsessionsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fsessionsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("sessions");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
