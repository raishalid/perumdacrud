<?php

namespace PHPMaker2023\crudperumdautama;

// Page object
$CustomersEdit = &$Page;
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
<form name="fcustomersedit" id="fcustomersedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post" novalidate autocomplete="on">
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { customers: currentTable } });
var currentPageID = ew.PAGE_ID = "edit";
var currentForm;
var fcustomersedit;
loadjs.ready(["wrapper", "head"], function () {
    let $ = jQuery;
    let fields = currentTable.fields;

    // Form object
    let form = new ew.FormBuilder()
        .setId("fcustomersedit")
        .setPageId("edit")

        // Add fields
        .setFields([
            ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
            ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
            ["slug", [fields.slug.visible && fields.slug.required ? ew.Validators.required(fields.slug.caption) : null], fields.slug.isInvalid],
            ["review", [fields.review.visible && fields.review.required ? ew.Validators.required(fields.review.caption) : null], fields.review.isInvalid],
            ["photo", [fields.photo.visible && fields.photo.required ? ew.Validators.required(fields.photo.caption) : null], fields.photo.isInvalid],
            ["product_id", [fields.product_id.visible && fields.product_id.required ? ew.Validators.required(fields.product_id.caption) : null, ew.Validators.integer], fields.product_id.isInvalid],
            ["service_id", [fields.service_id.visible && fields.service_id.required ? ew.Validators.required(fields.service_id.caption) : null, ew.Validators.integer], fields.service_id.isInvalid],
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
<input type="hidden" name="t" value="customers">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<?php if (IsJsonResponse()) { ?>
<input type="hidden" name="json" value="1">
<?php } ?>
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_customers_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_customers_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="customers" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_customers_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_customers_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="customers" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->name->formatPattern()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->slug->Visible) { // slug ?>
    <div id="r_slug"<?= $Page->slug->rowAttributes() ?>>
        <label id="elh_customers_slug" for="x_slug" class="<?= $Page->LeftColumnClass ?>"><?= $Page->slug->caption() ?><?= $Page->slug->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->slug->cellAttributes() ?>>
<span id="el_customers_slug">
<input type="<?= $Page->slug->getInputTextType() ?>" name="x_slug" id="x_slug" data-table="customers" data-field="x_slug" value="<?= $Page->slug->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->slug->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->slug->formatPattern()) ?>"<?= $Page->slug->editAttributes() ?> aria-describedby="x_slug_help">
<?= $Page->slug->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->slug->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->review->Visible) { // review ?>
    <div id="r_review"<?= $Page->review->rowAttributes() ?>>
        <label id="elh_customers_review" for="x_review" class="<?= $Page->LeftColumnClass ?>"><?= $Page->review->caption() ?><?= $Page->review->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->review->cellAttributes() ?>>
<span id="el_customers_review">
<textarea data-table="customers" data-field="x_review" name="x_review" id="x_review" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->review->getPlaceHolder()) ?>"<?= $Page->review->editAttributes() ?> aria-describedby="x_review_help"><?= $Page->review->EditValue ?></textarea>
<?= $Page->review->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->review->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->photo->Visible) { // photo ?>
    <div id="r_photo"<?= $Page->photo->rowAttributes() ?>>
        <label id="elh_customers_photo" for="x_photo" class="<?= $Page->LeftColumnClass ?>"><?= $Page->photo->caption() ?><?= $Page->photo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->photo->cellAttributes() ?>>
<span id="el_customers_photo">
<input type="<?= $Page->photo->getInputTextType() ?>" name="x_photo" id="x_photo" data-table="customers" data-field="x_photo" value="<?= $Page->photo->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->photo->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->photo->formatPattern()) ?>"<?= $Page->photo->editAttributes() ?> aria-describedby="x_photo_help">
<?= $Page->photo->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->photo->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->product_id->Visible) { // product_id ?>
    <div id="r_product_id"<?= $Page->product_id->rowAttributes() ?>>
        <label id="elh_customers_product_id" for="x_product_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->product_id->caption() ?><?= $Page->product_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->product_id->cellAttributes() ?>>
<span id="el_customers_product_id">
<input type="<?= $Page->product_id->getInputTextType() ?>" name="x_product_id" id="x_product_id" data-table="customers" data-field="x_product_id" value="<?= $Page->product_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->product_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->product_id->formatPattern()) ?>"<?= $Page->product_id->editAttributes() ?> aria-describedby="x_product_id_help">
<?= $Page->product_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->product_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->service_id->Visible) { // service_id ?>
    <div id="r_service_id"<?= $Page->service_id->rowAttributes() ?>>
        <label id="elh_customers_service_id" for="x_service_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->service_id->caption() ?><?= $Page->service_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->service_id->cellAttributes() ?>>
<span id="el_customers_service_id">
<input type="<?= $Page->service_id->getInputTextType() ?>" name="x_service_id" id="x_service_id" data-table="customers" data-field="x_service_id" value="<?= $Page->service_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->service_id->getPlaceHolder()) ?>" data-format-pattern="<?= HtmlEncode($Page->service_id->formatPattern()) ?>"<?= $Page->service_id->editAttributes() ?> aria-describedby="x_service_id_help">
<?= $Page->service_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->service_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?= $Page->IsModal ? '<template class="ew-modal-buttons">' : '<div class="row ew-buttons">' ?><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" form="fcustomersedit"><?= $Language->phrase("SaveBtn") ?></button>
<?php if (IsJsonResponse()) { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-bs-dismiss="modal"><?= $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" form="fcustomersedit" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
    ew.addEventHandlers("customers");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
