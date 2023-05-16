<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$FailedJobsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { failed_jobs: currentTable } });
var currentPageID = ew.PAGE_ID = "add";
var currentForm;
var ffailed_jobsadd;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ffailed_jobsadd")
        .setPageId("add")

        // Add fields
        .setFields([
            ["uuid", [fields.uuid.visible && fields.uuid.required ? ew.Validators.required(fields.uuid.caption) : null], fields.uuid.isInvalid],
            ["connection", [fields.connection.visible && fields.connection.required ? ew.Validators.required(fields.connection.caption) : null], fields.connection.isInvalid],
            ["queue", [fields.queue.visible && fields.queue.required ? ew.Validators.required(fields.queue.caption) : null], fields.queue.isInvalid],
            ["payload", [fields.payload.visible && fields.payload.required ? ew.Validators.required(fields.payload.caption) : null], fields.payload.isInvalid],
            ["exception", [fields.exception.visible && fields.exception.required ? ew.Validators.required(fields.exception.caption) : null], fields.exception.isInvalid],
            ["failed_at", [fields.failed_at.visible && fields.failed_at.required ? ew.Validators.required(fields.failed_at.caption) : null, ew.Validators.datetime(fields.failed_at.clientFormatPattern)], fields.failed_at.isInvalid]
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
<form name="ffailed_jobsadd" id="ffailed_jobsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="failed_jobs">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->uuid->Visible) { // uuid ?>
    <div id="r_uuid"<?= $Page->uuid->rowAttributes() ?>>
        <label id="elh_failed_jobs_uuid" for="x_uuid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->uuid->caption() ?><?= $Page->uuid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->uuid->cellAttributes() ?>>
<span id="el_failed_jobs_uuid">
<input type="<?= $Page->uuid->getInputTextType() ?>" name="x_uuid" id="x_uuid" data-table="failed_jobs" data-field="x_uuid" value="<?= $Page->uuid->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->uuid->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->uuid->formatPattern()) ?>"<?= $Page->uuid->editAttributes() ?> aria-describedby="x_uuid_help">
<?= $Page->uuid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->uuid->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->connection->Visible) { // connection ?>
    <div id="r_connection"<?= $Page->connection->rowAttributes() ?>>
        <label id="elh_failed_jobs_connection" for="x_connection" class="<?= $Page->LeftColumnClass ?>"><?= $Page->connection->caption() ?><?= $Page->connection->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->connection->cellAttributes() ?>>
<span id="el_failed_jobs_connection">
<textarea data-table="failed_jobs" data-field="x_connection" name="x_connection" id="x_connection" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->connection->getPlaceHolder()) ?>"<?= $Page->connection->editAttributes() ?> aria-describedby="x_connection_help"><?= $Page->connection->EditValue ?></textarea>
<?= $Page->connection->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->connection->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->queue->Visible) { // queue ?>
    <div id="r_queue"<?= $Page->queue->rowAttributes() ?>>
        <label id="elh_failed_jobs_queue" for="x_queue" class="<?= $Page->LeftColumnClass ?>"><?= $Page->queue->caption() ?><?= $Page->queue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->queue->cellAttributes() ?>>
<span id="el_failed_jobs_queue">
<textarea data-table="failed_jobs" data-field="x_queue" name="x_queue" id="x_queue" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->queue->getPlaceHolder()) ?>"<?= $Page->queue->editAttributes() ?> aria-describedby="x_queue_help"><?= $Page->queue->EditValue ?></textarea>
<?= $Page->queue->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->queue->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->payload->Visible) { // payload ?>
    <div id="r_payload"<?= $Page->payload->rowAttributes() ?>>
        <label id="elh_failed_jobs_payload" for="x_payload" class="<?= $Page->LeftColumnClass ?>"><?= $Page->payload->caption() ?><?= $Page->payload->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->payload->cellAttributes() ?>>
<span id="el_failed_jobs_payload">
<textarea data-table="failed_jobs" data-field="x_payload" name="x_payload" id="x_payload" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->payload->getPlaceHolder()) ?>"<?= $Page->payload->editAttributes() ?> aria-describedby="x_payload_help"><?= $Page->payload->EditValue ?></textarea>
<?= $Page->payload->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->payload->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->exception->Visible) { // exception ?>
    <div id="r_exception"<?= $Page->exception->rowAttributes() ?>>
        <label id="elh_failed_jobs_exception" for="x_exception" class="<?= $Page->LeftColumnClass ?>"><?= $Page->exception->caption() ?><?= $Page->exception->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->exception->cellAttributes() ?>>
<span id="el_failed_jobs_exception">
<textarea data-table="failed_jobs" data-field="x_exception" name="x_exception" id="x_exception" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->exception->getPlaceHolder()) ?>"<?= $Page->exception->editAttributes() ?> aria-describedby="x_exception_help"><?= $Page->exception->EditValue ?></textarea>
<?= $Page->exception->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->exception->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->failed_at->Visible) { // failed_at ?>
    <div id="r_failed_at"<?= $Page->failed_at->rowAttributes() ?>>
        <label id="elh_failed_jobs_failed_at" for="x_failed_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->failed_at->caption() ?><?= $Page->failed_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->failed_at->cellAttributes() ?>>
<span id="el_failed_jobs_failed_at">
<input type="<?= $Page->failed_at->getInputTextType() ?>" name="x_failed_at" id="x_failed_at" data-table="failed_jobs" data-field="x_failed_at" value="<?= $Page->failed_at->EditValue ?>" placeholder="<?= HtmlEncode($Page->failed_at->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->failed_at->formatPattern()) ?>"<?= $Page->failed_at->editAttributes() ?> aria-describedby="x_failed_at_help">
<?= $Page->failed_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->failed_at->getErrorMessage() ?></div>
<?php if (!$Page->failed_at->ReadOnly && !$Page->failed_at->Disabled && !isset($Page->failed_at->EditAttrs["readonly"]) && !isset($Page->failed_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffailed_jobsadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ffailed_jobsadd", "x_failed_at", ew.deepAssign({"useCurrent":false,"display":{"sideBySide":false}}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="ffailed_jobsadd"><?= $Language->phrase("AddBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="ffailed_jobsadd" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("failed_jobs");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
