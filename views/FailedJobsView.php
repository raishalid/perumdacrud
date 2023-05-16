<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$FailedJobsView = &$Page;
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
<form name="ffailed_jobsview" id="ffailed_jobsview" class="ew-form ew-view-form overlay-wrapper" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { failed_jobs: currentTable } });
var currentPageID = ew.PAGE_ID = "view";
var currentForm;
var ffailed_jobsview;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("ffailed_jobsview")
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
<input type="hidden" name="t" value="failed_jobs">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="<?= $Page->TableClass ?>">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_failed_jobs_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_failed_jobs_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->uuid->Visible) { // uuid ?>
    <tr id="r_uuid"<?= $Page->uuid->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_failed_jobs_uuid"><?= $Page->uuid->caption() ?></span></td>
        <td data-name="uuid"<?= $Page->uuid->cellAttributes() ?>>
<span id="el_failed_jobs_uuid">
<span<?= $Page->uuid->viewAttributes() ?>>
<?= $Page->uuid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->connection->Visible) { // connection ?>
    <tr id="r_connection"<?= $Page->connection->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_failed_jobs_connection"><?= $Page->connection->caption() ?></span></td>
        <td data-name="connection"<?= $Page->connection->cellAttributes() ?>>
<span id="el_failed_jobs_connection">
<span<?= $Page->connection->viewAttributes() ?>>
<?= $Page->connection->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->queue->Visible) { // queue ?>
    <tr id="r_queue"<?= $Page->queue->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_failed_jobs_queue"><?= $Page->queue->caption() ?></span></td>
        <td data-name="queue"<?= $Page->queue->cellAttributes() ?>>
<span id="el_failed_jobs_queue">
<span<?= $Page->queue->viewAttributes() ?>>
<?= $Page->queue->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->payload->Visible) { // payload ?>
    <tr id="r_payload"<?= $Page->payload->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_failed_jobs_payload"><?= $Page->payload->caption() ?></span></td>
        <td data-name="payload"<?= $Page->payload->cellAttributes() ?>>
<span id="el_failed_jobs_payload">
<span<?= $Page->payload->viewAttributes() ?>>
<?= $Page->payload->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->exception->Visible) { // exception ?>
    <tr id="r_exception"<?= $Page->exception->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_failed_jobs_exception"><?= $Page->exception->caption() ?></span></td>
        <td data-name="exception"<?= $Page->exception->cellAttributes() ?>>
<span id="el_failed_jobs_exception">
<span<?= $Page->exception->viewAttributes() ?>>
<?= $Page->exception->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->failed_at->Visible) { // failed_at ?>
    <tr id="r_failed_at"<?= $Page->failed_at->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_failed_jobs_failed_at"><?= $Page->failed_at->caption() ?></span></td>
        <td data-name="failed_at"<?= $Page->failed_at->cellAttributes() ?>>
<span id="el_failed_jobs_failed_at">
<span<?= $Page->failed_at->viewAttributes() ?>>
<?= $Page->failed_at->getViewValue() ?></span>
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
