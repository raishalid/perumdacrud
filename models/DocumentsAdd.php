<?php

namespace PHPMaker2023\crudperumdautama;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class DocumentsAdd extends Documents
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "DocumentsAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "DocumentsAdd";

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        return rtrim(UrlFor($route->getName(), $args), "/") . "?";
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Set field visibility
    public function setVisibility()
    {
        $this->id->Visible = false;
        $this->departement_id->setVisibility();
        $this->company_id->setVisibility();
        $this->type->setVisibility();
        $this->document_number->setVisibility();
        $this->order_number->setVisibility();
        $this->status->setVisibility();
        $this->issued_at->setVisibility();
        $this->due_at->setVisibility();
        $this->amount->setVisibility();
        $this->currency_code->setVisibility();
        $this->currency_rate->setVisibility();
        $this->category_id->setVisibility();
        $this->contact_id->setVisibility();
        $this->contact_name->setVisibility();
        $this->contact_email->setVisibility();
        $this->contact_tax_number->setVisibility();
        $this->contact_phone->setVisibility();
        $this->contact_address->setVisibility();
        $this->contact_city->setVisibility();
        $this->contact_zip_code->setVisibility();
        $this->contact_state->setVisibility();
        $this->contact_country->setVisibility();
        $this->notes->setVisibility();
        $this->footer->setVisibility();
        $this->parent_id->setVisibility();
        $this->created_from->setVisibility();
        $this->created_by->setVisibility();
        $this->created_at->setVisibility();
        $this->updated_at->setVisibility();
        $this->deleted_at->setVisibility();
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer;
        $this->TableVar = 'documents';
        $this->TableName = 'documents';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (documents)
        if (!isset($GLOBALS["documents"]) || get_class($GLOBALS["documents"]) == PROJECT_NAMESPACE . "documents") {
            $GLOBALS["documents"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'documents');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();
    }

    // Get content from stream
    public function getContents(): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

        // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show response for API
                $ar = array_merge($this->getMessages(), $url ? ["url" => GetUrl($url)] : []);
                WriteJson($ar);
            }
            $this->clearMessages(); // Clear messages for API request
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response (Assume return to modal for simplicity)
            if ($this->IsModal) { // Show as modal
                $result = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page => View page
                    $result["caption"] = $this->getModalCaption($pageName);
                    $result["view"] = $pageName == "DocumentsView"; // If View page, no primary button
                } else { // List page
                    // $result["list"] = $this->PageID == "search"; // Refresh List page if current page is Search page
                    $result["error"] = $this->getFailureMessage(); // List page should not be shown as modal => error
                    $this->clearFailureMessage();
                }
                WriteJson($result);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id->Visible = false;
        }
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;
        $name = $ar["name"] ?? Post("name");
        $isQuery = ContainsString($name, "query_builder_rule");
        if ($isQuery) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $CopyRecord;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $UserProfile, $Language, $Security, $CurrentForm, $SkipHeaderFooter;

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->setVisibility();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Hide fields for add/edit
        if (!$this->UseAjaxActions) {
            $this->hideFieldsForAddEdit();
        }
        // Use inline delete
        if ($this->UseAjaxActions) {
            $this->InlineDelete = true;
        }

        // Load default values for add
        $this->loadDefaultValues();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action", "") !== "") {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
                $this->setKey($this->OldKey); // Set up record key
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record or default values
        $rsold = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$rsold) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("DocumentsList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($rsold)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "DocumentsList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "DocumentsView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "DocumentsList") {
                            Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "DocumentsList"; // Return list page content
                        }
                    }
                    if (IsJsonResponse()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->IsModal && $this->UseAjaxActions) { // Return JSON error message
                    WriteJson([ "success" => false, "validation" => $this->getValidationErrors(), "error" => $this->getFailureMessage() ]);
                    $this->clearFailureMessage();
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->category_id->DefaultValue = $this->category_id->getDefault(); // PHP
        $this->category_id->OldValue = $this->category_id->DefaultValue;
        $this->parent_id->DefaultValue = $this->parent_id->getDefault(); // PHP
        $this->parent_id->OldValue = $this->parent_id->DefaultValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'departement_id' first before field var 'x_departement_id'
        $val = $CurrentForm->hasValue("departement_id") ? $CurrentForm->getValue("departement_id") : $CurrentForm->getValue("x_departement_id");
        if (!$this->departement_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->departement_id->Visible = false; // Disable update for API request
            } else {
                $this->departement_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'company_id' first before field var 'x_company_id'
        $val = $CurrentForm->hasValue("company_id") ? $CurrentForm->getValue("company_id") : $CurrentForm->getValue("x_company_id");
        if (!$this->company_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->company_id->Visible = false; // Disable update for API request
            } else {
                $this->company_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'type' first before field var 'x_type'
        $val = $CurrentForm->hasValue("type") ? $CurrentForm->getValue("type") : $CurrentForm->getValue("x_type");
        if (!$this->type->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->type->Visible = false; // Disable update for API request
            } else {
                $this->type->setFormValue($val);
            }
        }

        // Check field name 'document_number' first before field var 'x_document_number'
        $val = $CurrentForm->hasValue("document_number") ? $CurrentForm->getValue("document_number") : $CurrentForm->getValue("x_document_number");
        if (!$this->document_number->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->document_number->Visible = false; // Disable update for API request
            } else {
                $this->document_number->setFormValue($val);
            }
        }

        // Check field name 'order_number' first before field var 'x_order_number'
        $val = $CurrentForm->hasValue("order_number") ? $CurrentForm->getValue("order_number") : $CurrentForm->getValue("x_order_number");
        if (!$this->order_number->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->order_number->Visible = false; // Disable update for API request
            } else {
                $this->order_number->setFormValue($val);
            }
        }

        // Check field name 'status' first before field var 'x_status'
        $val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
            }
        }

        // Check field name 'issued_at' first before field var 'x_issued_at'
        $val = $CurrentForm->hasValue("issued_at") ? $CurrentForm->getValue("issued_at") : $CurrentForm->getValue("x_issued_at");
        if (!$this->issued_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->issued_at->Visible = false; // Disable update for API request
            } else {
                $this->issued_at->setFormValue($val, true, $validate);
            }
            $this->issued_at->CurrentValue = UnFormatDateTime($this->issued_at->CurrentValue, $this->issued_at->formatPattern());
        }

        // Check field name 'due_at' first before field var 'x_due_at'
        $val = $CurrentForm->hasValue("due_at") ? $CurrentForm->getValue("due_at") : $CurrentForm->getValue("x_due_at");
        if (!$this->due_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->due_at->Visible = false; // Disable update for API request
            } else {
                $this->due_at->setFormValue($val, true, $validate);
            }
            $this->due_at->CurrentValue = UnFormatDateTime($this->due_at->CurrentValue, $this->due_at->formatPattern());
        }

        // Check field name 'amount' first before field var 'x_amount'
        $val = $CurrentForm->hasValue("amount") ? $CurrentForm->getValue("amount") : $CurrentForm->getValue("x_amount");
        if (!$this->amount->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->amount->Visible = false; // Disable update for API request
            } else {
                $this->amount->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'currency_code' first before field var 'x_currency_code'
        $val = $CurrentForm->hasValue("currency_code") ? $CurrentForm->getValue("currency_code") : $CurrentForm->getValue("x_currency_code");
        if (!$this->currency_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->currency_code->Visible = false; // Disable update for API request
            } else {
                $this->currency_code->setFormValue($val);
            }
        }

        // Check field name 'currency_rate' first before field var 'x_currency_rate'
        $val = $CurrentForm->hasValue("currency_rate") ? $CurrentForm->getValue("currency_rate") : $CurrentForm->getValue("x_currency_rate");
        if (!$this->currency_rate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->currency_rate->Visible = false; // Disable update for API request
            } else {
                $this->currency_rate->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'category_id' first before field var 'x_category_id'
        $val = $CurrentForm->hasValue("category_id") ? $CurrentForm->getValue("category_id") : $CurrentForm->getValue("x_category_id");
        if (!$this->category_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->category_id->Visible = false; // Disable update for API request
            } else {
                $this->category_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'contact_id' first before field var 'x_contact_id'
        $val = $CurrentForm->hasValue("contact_id") ? $CurrentForm->getValue("contact_id") : $CurrentForm->getValue("x_contact_id");
        if (!$this->contact_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_id->Visible = false; // Disable update for API request
            } else {
                $this->contact_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'contact_name' first before field var 'x_contact_name'
        $val = $CurrentForm->hasValue("contact_name") ? $CurrentForm->getValue("contact_name") : $CurrentForm->getValue("x_contact_name");
        if (!$this->contact_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_name->Visible = false; // Disable update for API request
            } else {
                $this->contact_name->setFormValue($val);
            }
        }

        // Check field name 'contact_email' first before field var 'x_contact_email'
        $val = $CurrentForm->hasValue("contact_email") ? $CurrentForm->getValue("contact_email") : $CurrentForm->getValue("x_contact_email");
        if (!$this->contact_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_email->Visible = false; // Disable update for API request
            } else {
                $this->contact_email->setFormValue($val);
            }
        }

        // Check field name 'contact_tax_number' first before field var 'x_contact_tax_number'
        $val = $CurrentForm->hasValue("contact_tax_number") ? $CurrentForm->getValue("contact_tax_number") : $CurrentForm->getValue("x_contact_tax_number");
        if (!$this->contact_tax_number->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_tax_number->Visible = false; // Disable update for API request
            } else {
                $this->contact_tax_number->setFormValue($val);
            }
        }

        // Check field name 'contact_phone' first before field var 'x_contact_phone'
        $val = $CurrentForm->hasValue("contact_phone") ? $CurrentForm->getValue("contact_phone") : $CurrentForm->getValue("x_contact_phone");
        if (!$this->contact_phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_phone->Visible = false; // Disable update for API request
            } else {
                $this->contact_phone->setFormValue($val);
            }
        }

        // Check field name 'contact_address' first before field var 'x_contact_address'
        $val = $CurrentForm->hasValue("contact_address") ? $CurrentForm->getValue("contact_address") : $CurrentForm->getValue("x_contact_address");
        if (!$this->contact_address->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_address->Visible = false; // Disable update for API request
            } else {
                $this->contact_address->setFormValue($val);
            }
        }

        // Check field name 'contact_city' first before field var 'x_contact_city'
        $val = $CurrentForm->hasValue("contact_city") ? $CurrentForm->getValue("contact_city") : $CurrentForm->getValue("x_contact_city");
        if (!$this->contact_city->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_city->Visible = false; // Disable update for API request
            } else {
                $this->contact_city->setFormValue($val);
            }
        }

        // Check field name 'contact_zip_code' first before field var 'x_contact_zip_code'
        $val = $CurrentForm->hasValue("contact_zip_code") ? $CurrentForm->getValue("contact_zip_code") : $CurrentForm->getValue("x_contact_zip_code");
        if (!$this->contact_zip_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_zip_code->Visible = false; // Disable update for API request
            } else {
                $this->contact_zip_code->setFormValue($val);
            }
        }

        // Check field name 'contact_state' first before field var 'x_contact_state'
        $val = $CurrentForm->hasValue("contact_state") ? $CurrentForm->getValue("contact_state") : $CurrentForm->getValue("x_contact_state");
        if (!$this->contact_state->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_state->Visible = false; // Disable update for API request
            } else {
                $this->contact_state->setFormValue($val);
            }
        }

        // Check field name 'contact_country' first before field var 'x_contact_country'
        $val = $CurrentForm->hasValue("contact_country") ? $CurrentForm->getValue("contact_country") : $CurrentForm->getValue("x_contact_country");
        if (!$this->contact_country->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contact_country->Visible = false; // Disable update for API request
            } else {
                $this->contact_country->setFormValue($val);
            }
        }

        // Check field name 'notes' first before field var 'x_notes'
        $val = $CurrentForm->hasValue("notes") ? $CurrentForm->getValue("notes") : $CurrentForm->getValue("x_notes");
        if (!$this->notes->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->notes->Visible = false; // Disable update for API request
            } else {
                $this->notes->setFormValue($val);
            }
        }

        // Check field name 'footer' first before field var 'x_footer'
        $val = $CurrentForm->hasValue("footer") ? $CurrentForm->getValue("footer") : $CurrentForm->getValue("x_footer");
        if (!$this->footer->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->footer->Visible = false; // Disable update for API request
            } else {
                $this->footer->setFormValue($val);
            }
        }

        // Check field name 'parent_id' first before field var 'x_parent_id'
        $val = $CurrentForm->hasValue("parent_id") ? $CurrentForm->getValue("parent_id") : $CurrentForm->getValue("x_parent_id");
        if (!$this->parent_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->parent_id->Visible = false; // Disable update for API request
            } else {
                $this->parent_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'created_from' first before field var 'x_created_from'
        $val = $CurrentForm->hasValue("created_from") ? $CurrentForm->getValue("created_from") : $CurrentForm->getValue("x_created_from");
        if (!$this->created_from->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->created_from->Visible = false; // Disable update for API request
            } else {
                $this->created_from->setFormValue($val);
            }
        }

        // Check field name 'created_by' first before field var 'x_created_by'
        $val = $CurrentForm->hasValue("created_by") ? $CurrentForm->getValue("created_by") : $CurrentForm->getValue("x_created_by");
        if (!$this->created_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->created_by->Visible = false; // Disable update for API request
            } else {
                $this->created_by->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'created_at' first before field var 'x_created_at'
        $val = $CurrentForm->hasValue("created_at") ? $CurrentForm->getValue("created_at") : $CurrentForm->getValue("x_created_at");
        if (!$this->created_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->created_at->Visible = false; // Disable update for API request
            } else {
                $this->created_at->setFormValue($val);
            }
            $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        }

        // Check field name 'updated_at' first before field var 'x_updated_at'
        $val = $CurrentForm->hasValue("updated_at") ? $CurrentForm->getValue("updated_at") : $CurrentForm->getValue("x_updated_at");
        if (!$this->updated_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->updated_at->Visible = false; // Disable update for API request
            } else {
                $this->updated_at->setFormValue($val);
            }
            $this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
        }

        // Check field name 'deleted_at' first before field var 'x_deleted_at'
        $val = $CurrentForm->hasValue("deleted_at") ? $CurrentForm->getValue("deleted_at") : $CurrentForm->getValue("x_deleted_at");
        if (!$this->deleted_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->deleted_at->Visible = false; // Disable update for API request
            } else {
                $this->deleted_at->setFormValue($val);
            }
            $this->deleted_at->CurrentValue = UnFormatDateTime($this->deleted_at->CurrentValue, $this->deleted_at->formatPattern());
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->departement_id->CurrentValue = $this->departement_id->FormValue;
        $this->company_id->CurrentValue = $this->company_id->FormValue;
        $this->type->CurrentValue = $this->type->FormValue;
        $this->document_number->CurrentValue = $this->document_number->FormValue;
        $this->order_number->CurrentValue = $this->order_number->FormValue;
        $this->status->CurrentValue = $this->status->FormValue;
        $this->issued_at->CurrentValue = $this->issued_at->FormValue;
        $this->issued_at->CurrentValue = UnFormatDateTime($this->issued_at->CurrentValue, $this->issued_at->formatPattern());
        $this->due_at->CurrentValue = $this->due_at->FormValue;
        $this->due_at->CurrentValue = UnFormatDateTime($this->due_at->CurrentValue, $this->due_at->formatPattern());
        $this->amount->CurrentValue = $this->amount->FormValue;
        $this->currency_code->CurrentValue = $this->currency_code->FormValue;
        $this->currency_rate->CurrentValue = $this->currency_rate->FormValue;
        $this->category_id->CurrentValue = $this->category_id->FormValue;
        $this->contact_id->CurrentValue = $this->contact_id->FormValue;
        $this->contact_name->CurrentValue = $this->contact_name->FormValue;
        $this->contact_email->CurrentValue = $this->contact_email->FormValue;
        $this->contact_tax_number->CurrentValue = $this->contact_tax_number->FormValue;
        $this->contact_phone->CurrentValue = $this->contact_phone->FormValue;
        $this->contact_address->CurrentValue = $this->contact_address->FormValue;
        $this->contact_city->CurrentValue = $this->contact_city->FormValue;
        $this->contact_zip_code->CurrentValue = $this->contact_zip_code->FormValue;
        $this->contact_state->CurrentValue = $this->contact_state->FormValue;
        $this->contact_country->CurrentValue = $this->contact_country->FormValue;
        $this->notes->CurrentValue = $this->notes->FormValue;
        $this->footer->CurrentValue = $this->footer->FormValue;
        $this->parent_id->CurrentValue = $this->parent_id->FormValue;
        $this->created_from->CurrentValue = $this->created_from->FormValue;
        $this->created_by->CurrentValue = $this->created_by->FormValue;
        $this->created_at->CurrentValue = $this->created_at->FormValue;
        $this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, $this->created_at->formatPattern());
        $this->updated_at->CurrentValue = $this->updated_at->FormValue;
        $this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, $this->updated_at->formatPattern());
        $this->deleted_at->CurrentValue = $this->deleted_at->FormValue;
        $this->deleted_at->CurrentValue = UnFormatDateTime($this->deleted_at->CurrentValue, $this->deleted_at->formatPattern());
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->id->setDbValue($row['id']);
        $this->departement_id->setDbValue($row['departement_id']);
        $this->company_id->setDbValue($row['company_id']);
        $this->type->setDbValue($row['type']);
        $this->document_number->setDbValue($row['document_number']);
        $this->order_number->setDbValue($row['order_number']);
        $this->status->setDbValue($row['status']);
        $this->issued_at->setDbValue($row['issued_at']);
        $this->due_at->setDbValue($row['due_at']);
        $this->amount->setDbValue($row['amount']);
        $this->currency_code->setDbValue($row['currency_code']);
        $this->currency_rate->setDbValue($row['currency_rate']);
        $this->category_id->setDbValue($row['category_id']);
        $this->contact_id->setDbValue($row['contact_id']);
        $this->contact_name->setDbValue($row['contact_name']);
        $this->contact_email->setDbValue($row['contact_email']);
        $this->contact_tax_number->setDbValue($row['contact_tax_number']);
        $this->contact_phone->setDbValue($row['contact_phone']);
        $this->contact_address->setDbValue($row['contact_address']);
        $this->contact_city->setDbValue($row['contact_city']);
        $this->contact_zip_code->setDbValue($row['contact_zip_code']);
        $this->contact_state->setDbValue($row['contact_state']);
        $this->contact_country->setDbValue($row['contact_country']);
        $this->notes->setDbValue($row['notes']);
        $this->footer->setDbValue($row['footer']);
        $this->parent_id->setDbValue($row['parent_id']);
        $this->created_from->setDbValue($row['created_from']);
        $this->created_by->setDbValue($row['created_by']);
        $this->created_at->setDbValue($row['created_at']);
        $this->updated_at->setDbValue($row['updated_at']);
        $this->deleted_at->setDbValue($row['deleted_at']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['departement_id'] = $this->departement_id->DefaultValue;
        $row['company_id'] = $this->company_id->DefaultValue;
        $row['type'] = $this->type->DefaultValue;
        $row['document_number'] = $this->document_number->DefaultValue;
        $row['order_number'] = $this->order_number->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        $row['issued_at'] = $this->issued_at->DefaultValue;
        $row['due_at'] = $this->due_at->DefaultValue;
        $row['amount'] = $this->amount->DefaultValue;
        $row['currency_code'] = $this->currency_code->DefaultValue;
        $row['currency_rate'] = $this->currency_rate->DefaultValue;
        $row['category_id'] = $this->category_id->DefaultValue;
        $row['contact_id'] = $this->contact_id->DefaultValue;
        $row['contact_name'] = $this->contact_name->DefaultValue;
        $row['contact_email'] = $this->contact_email->DefaultValue;
        $row['contact_tax_number'] = $this->contact_tax_number->DefaultValue;
        $row['contact_phone'] = $this->contact_phone->DefaultValue;
        $row['contact_address'] = $this->contact_address->DefaultValue;
        $row['contact_city'] = $this->contact_city->DefaultValue;
        $row['contact_zip_code'] = $this->contact_zip_code->DefaultValue;
        $row['contact_state'] = $this->contact_state->DefaultValue;
        $row['contact_country'] = $this->contact_country->DefaultValue;
        $row['notes'] = $this->notes->DefaultValue;
        $row['footer'] = $this->footer->DefaultValue;
        $row['parent_id'] = $this->parent_id->DefaultValue;
        $row['created_from'] = $this->created_from->DefaultValue;
        $row['created_by'] = $this->created_by->DefaultValue;
        $row['created_at'] = $this->created_at->DefaultValue;
        $row['updated_at'] = $this->updated_at->DefaultValue;
        $row['deleted_at'] = $this->deleted_at->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        if ($this->OldKey != "") {
            $this->setKey($this->OldKey);
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn);
            if ($rs && ($row = $rs->fields)) {
                $this->loadRowValues($row); // Load row values
                return $row;
            }
        }
        $this->loadRowValues(); // Load default row values
        return null;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id
        $this->id->RowCssClass = "row";

        // departement_id
        $this->departement_id->RowCssClass = "row";

        // company_id
        $this->company_id->RowCssClass = "row";

        // type
        $this->type->RowCssClass = "row";

        // document_number
        $this->document_number->RowCssClass = "row";

        // order_number
        $this->order_number->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // issued_at
        $this->issued_at->RowCssClass = "row";

        // due_at
        $this->due_at->RowCssClass = "row";

        // amount
        $this->amount->RowCssClass = "row";

        // currency_code
        $this->currency_code->RowCssClass = "row";

        // currency_rate
        $this->currency_rate->RowCssClass = "row";

        // category_id
        $this->category_id->RowCssClass = "row";

        // contact_id
        $this->contact_id->RowCssClass = "row";

        // contact_name
        $this->contact_name->RowCssClass = "row";

        // contact_email
        $this->contact_email->RowCssClass = "row";

        // contact_tax_number
        $this->contact_tax_number->RowCssClass = "row";

        // contact_phone
        $this->contact_phone->RowCssClass = "row";

        // contact_address
        $this->contact_address->RowCssClass = "row";

        // contact_city
        $this->contact_city->RowCssClass = "row";

        // contact_zip_code
        $this->contact_zip_code->RowCssClass = "row";

        // contact_state
        $this->contact_state->RowCssClass = "row";

        // contact_country
        $this->contact_country->RowCssClass = "row";

        // notes
        $this->notes->RowCssClass = "row";

        // footer
        $this->footer->RowCssClass = "row";

        // parent_id
        $this->parent_id->RowCssClass = "row";

        // created_from
        $this->created_from->RowCssClass = "row";

        // created_by
        $this->created_by->RowCssClass = "row";

        // created_at
        $this->created_at->RowCssClass = "row";

        // updated_at
        $this->updated_at->RowCssClass = "row";

        // deleted_at
        $this->deleted_at->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewValue = FormatNumber($this->id->ViewValue, $this->id->formatPattern());

            // departement_id
            $this->departement_id->ViewValue = $this->departement_id->CurrentValue;
            $this->departement_id->ViewValue = FormatNumber($this->departement_id->ViewValue, $this->departement_id->formatPattern());

            // company_id
            $this->company_id->ViewValue = $this->company_id->CurrentValue;
            $this->company_id->ViewValue = FormatNumber($this->company_id->ViewValue, $this->company_id->formatPattern());

            // type
            $this->type->ViewValue = $this->type->CurrentValue;

            // document_number
            $this->document_number->ViewValue = $this->document_number->CurrentValue;

            // order_number
            $this->order_number->ViewValue = $this->order_number->CurrentValue;

            // status
            $this->status->ViewValue = $this->status->CurrentValue;

            // issued_at
            $this->issued_at->ViewValue = $this->issued_at->CurrentValue;
            $this->issued_at->ViewValue = FormatDateTime($this->issued_at->ViewValue, $this->issued_at->formatPattern());

            // due_at
            $this->due_at->ViewValue = $this->due_at->CurrentValue;
            $this->due_at->ViewValue = FormatDateTime($this->due_at->ViewValue, $this->due_at->formatPattern());

            // amount
            $this->amount->ViewValue = $this->amount->CurrentValue;
            $this->amount->ViewValue = FormatNumber($this->amount->ViewValue, $this->amount->formatPattern());

            // currency_code
            $this->currency_code->ViewValue = $this->currency_code->CurrentValue;

            // currency_rate
            $this->currency_rate->ViewValue = $this->currency_rate->CurrentValue;
            $this->currency_rate->ViewValue = FormatNumber($this->currency_rate->ViewValue, $this->currency_rate->formatPattern());

            // category_id
            $this->category_id->ViewValue = $this->category_id->CurrentValue;
            $this->category_id->ViewValue = FormatNumber($this->category_id->ViewValue, $this->category_id->formatPattern());

            // contact_id
            $this->contact_id->ViewValue = $this->contact_id->CurrentValue;
            $this->contact_id->ViewValue = FormatNumber($this->contact_id->ViewValue, $this->contact_id->formatPattern());

            // contact_name
            $this->contact_name->ViewValue = $this->contact_name->CurrentValue;

            // contact_email
            $this->contact_email->ViewValue = $this->contact_email->CurrentValue;

            // contact_tax_number
            $this->contact_tax_number->ViewValue = $this->contact_tax_number->CurrentValue;

            // contact_phone
            $this->contact_phone->ViewValue = $this->contact_phone->CurrentValue;

            // contact_address
            $this->contact_address->ViewValue = $this->contact_address->CurrentValue;

            // contact_city
            $this->contact_city->ViewValue = $this->contact_city->CurrentValue;

            // contact_zip_code
            $this->contact_zip_code->ViewValue = $this->contact_zip_code->CurrentValue;

            // contact_state
            $this->contact_state->ViewValue = $this->contact_state->CurrentValue;

            // contact_country
            $this->contact_country->ViewValue = $this->contact_country->CurrentValue;

            // notes
            $this->notes->ViewValue = $this->notes->CurrentValue;

            // footer
            $this->footer->ViewValue = $this->footer->CurrentValue;

            // parent_id
            $this->parent_id->ViewValue = $this->parent_id->CurrentValue;
            $this->parent_id->ViewValue = FormatNumber($this->parent_id->ViewValue, $this->parent_id->formatPattern());

            // created_from
            $this->created_from->ViewValue = $this->created_from->CurrentValue;

            // created_by
            $this->created_by->ViewValue = $this->created_by->CurrentValue;
            $this->created_by->ViewValue = FormatNumber($this->created_by->ViewValue, $this->created_by->formatPattern());

            // created_at
            $this->created_at->ViewValue = $this->created_at->CurrentValue;
            $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, $this->created_at->formatPattern());

            // updated_at
            $this->updated_at->ViewValue = $this->updated_at->CurrentValue;
            $this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, $this->updated_at->formatPattern());

            // deleted_at
            $this->deleted_at->ViewValue = $this->deleted_at->CurrentValue;
            $this->deleted_at->ViewValue = FormatDateTime($this->deleted_at->ViewValue, $this->deleted_at->formatPattern());

            // departement_id
            $this->departement_id->HrefValue = "";

            // company_id
            $this->company_id->HrefValue = "";

            // type
            $this->type->HrefValue = "";

            // document_number
            $this->document_number->HrefValue = "";

            // order_number
            $this->order_number->HrefValue = "";

            // status
            $this->status->HrefValue = "";

            // issued_at
            $this->issued_at->HrefValue = "";

            // due_at
            $this->due_at->HrefValue = "";

            // amount
            $this->amount->HrefValue = "";

            // currency_code
            $this->currency_code->HrefValue = "";

            // currency_rate
            $this->currency_rate->HrefValue = "";

            // category_id
            $this->category_id->HrefValue = "";

            // contact_id
            $this->contact_id->HrefValue = "";

            // contact_name
            $this->contact_name->HrefValue = "";

            // contact_email
            $this->contact_email->HrefValue = "";

            // contact_tax_number
            $this->contact_tax_number->HrefValue = "";

            // contact_phone
            $this->contact_phone->HrefValue = "";

            // contact_address
            $this->contact_address->HrefValue = "";

            // contact_city
            $this->contact_city->HrefValue = "";

            // contact_zip_code
            $this->contact_zip_code->HrefValue = "";

            // contact_state
            $this->contact_state->HrefValue = "";

            // contact_country
            $this->contact_country->HrefValue = "";

            // notes
            $this->notes->HrefValue = "";

            // footer
            $this->footer->HrefValue = "";

            // parent_id
            $this->parent_id->HrefValue = "";

            // created_from
            $this->created_from->HrefValue = "";

            // created_by
            $this->created_by->HrefValue = "";

            // created_at
            $this->created_at->HrefValue = "";

            // updated_at
            $this->updated_at->HrefValue = "";

            // deleted_at
            $this->deleted_at->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // departement_id
            $this->departement_id->setupEditAttributes();
            $this->departement_id->EditValue = HtmlEncode($this->departement_id->CurrentValue);
            $this->departement_id->PlaceHolder = RemoveHtml($this->departement_id->caption());
            if (strval($this->departement_id->EditValue) != "" && is_numeric($this->departement_id->EditValue)) {
                $this->departement_id->EditValue = FormatNumber($this->departement_id->EditValue, null);
            }

            // company_id
            $this->company_id->setupEditAttributes();
            $this->company_id->EditValue = HtmlEncode($this->company_id->CurrentValue);
            $this->company_id->PlaceHolder = RemoveHtml($this->company_id->caption());
            if (strval($this->company_id->EditValue) != "" && is_numeric($this->company_id->EditValue)) {
                $this->company_id->EditValue = FormatNumber($this->company_id->EditValue, null);
            }

            // type
            $this->type->setupEditAttributes();
            if (!$this->type->Raw) {
                $this->type->CurrentValue = HtmlDecode($this->type->CurrentValue);
            }
            $this->type->EditValue = HtmlEncode($this->type->CurrentValue);
            $this->type->PlaceHolder = RemoveHtml($this->type->caption());

            // document_number
            $this->document_number->setupEditAttributes();
            if (!$this->document_number->Raw) {
                $this->document_number->CurrentValue = HtmlDecode($this->document_number->CurrentValue);
            }
            $this->document_number->EditValue = HtmlEncode($this->document_number->CurrentValue);
            $this->document_number->PlaceHolder = RemoveHtml($this->document_number->caption());

            // order_number
            $this->order_number->setupEditAttributes();
            if (!$this->order_number->Raw) {
                $this->order_number->CurrentValue = HtmlDecode($this->order_number->CurrentValue);
            }
            $this->order_number->EditValue = HtmlEncode($this->order_number->CurrentValue);
            $this->order_number->PlaceHolder = RemoveHtml($this->order_number->caption());

            // status
            $this->status->setupEditAttributes();
            if (!$this->status->Raw) {
                $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->CurrentValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // issued_at
            $this->issued_at->setupEditAttributes();
            $this->issued_at->EditValue = HtmlEncode(FormatDateTime($this->issued_at->CurrentValue, $this->issued_at->formatPattern()));
            $this->issued_at->PlaceHolder = RemoveHtml($this->issued_at->caption());

            // due_at
            $this->due_at->setupEditAttributes();
            $this->due_at->EditValue = HtmlEncode(FormatDateTime($this->due_at->CurrentValue, $this->due_at->formatPattern()));
            $this->due_at->PlaceHolder = RemoveHtml($this->due_at->caption());

            // amount
            $this->amount->setupEditAttributes();
            $this->amount->EditValue = HtmlEncode($this->amount->CurrentValue);
            $this->amount->PlaceHolder = RemoveHtml($this->amount->caption());
            if (strval($this->amount->EditValue) != "" && is_numeric($this->amount->EditValue)) {
                $this->amount->EditValue = FormatNumber($this->amount->EditValue, null);
            }

            // currency_code
            $this->currency_code->setupEditAttributes();
            if (!$this->currency_code->Raw) {
                $this->currency_code->CurrentValue = HtmlDecode($this->currency_code->CurrentValue);
            }
            $this->currency_code->EditValue = HtmlEncode($this->currency_code->CurrentValue);
            $this->currency_code->PlaceHolder = RemoveHtml($this->currency_code->caption());

            // currency_rate
            $this->currency_rate->setupEditAttributes();
            $this->currency_rate->EditValue = HtmlEncode($this->currency_rate->CurrentValue);
            $this->currency_rate->PlaceHolder = RemoveHtml($this->currency_rate->caption());
            if (strval($this->currency_rate->EditValue) != "" && is_numeric($this->currency_rate->EditValue)) {
                $this->currency_rate->EditValue = FormatNumber($this->currency_rate->EditValue, null);
            }

            // category_id
            $this->category_id->setupEditAttributes();
            $this->category_id->EditValue = HtmlEncode($this->category_id->CurrentValue);
            $this->category_id->PlaceHolder = RemoveHtml($this->category_id->caption());
            if (strval($this->category_id->EditValue) != "" && is_numeric($this->category_id->EditValue)) {
                $this->category_id->EditValue = FormatNumber($this->category_id->EditValue, null);
            }

            // contact_id
            $this->contact_id->setupEditAttributes();
            $this->contact_id->EditValue = HtmlEncode($this->contact_id->CurrentValue);
            $this->contact_id->PlaceHolder = RemoveHtml($this->contact_id->caption());
            if (strval($this->contact_id->EditValue) != "" && is_numeric($this->contact_id->EditValue)) {
                $this->contact_id->EditValue = FormatNumber($this->contact_id->EditValue, null);
            }

            // contact_name
            $this->contact_name->setupEditAttributes();
            if (!$this->contact_name->Raw) {
                $this->contact_name->CurrentValue = HtmlDecode($this->contact_name->CurrentValue);
            }
            $this->contact_name->EditValue = HtmlEncode($this->contact_name->CurrentValue);
            $this->contact_name->PlaceHolder = RemoveHtml($this->contact_name->caption());

            // contact_email
            $this->contact_email->setupEditAttributes();
            if (!$this->contact_email->Raw) {
                $this->contact_email->CurrentValue = HtmlDecode($this->contact_email->CurrentValue);
            }
            $this->contact_email->EditValue = HtmlEncode($this->contact_email->CurrentValue);
            $this->contact_email->PlaceHolder = RemoveHtml($this->contact_email->caption());

            // contact_tax_number
            $this->contact_tax_number->setupEditAttributes();
            if (!$this->contact_tax_number->Raw) {
                $this->contact_tax_number->CurrentValue = HtmlDecode($this->contact_tax_number->CurrentValue);
            }
            $this->contact_tax_number->EditValue = HtmlEncode($this->contact_tax_number->CurrentValue);
            $this->contact_tax_number->PlaceHolder = RemoveHtml($this->contact_tax_number->caption());

            // contact_phone
            $this->contact_phone->setupEditAttributes();
            if (!$this->contact_phone->Raw) {
                $this->contact_phone->CurrentValue = HtmlDecode($this->contact_phone->CurrentValue);
            }
            $this->contact_phone->EditValue = HtmlEncode($this->contact_phone->CurrentValue);
            $this->contact_phone->PlaceHolder = RemoveHtml($this->contact_phone->caption());

            // contact_address
            $this->contact_address->setupEditAttributes();
            $this->contact_address->EditValue = HtmlEncode($this->contact_address->CurrentValue);
            $this->contact_address->PlaceHolder = RemoveHtml($this->contact_address->caption());

            // contact_city
            $this->contact_city->setupEditAttributes();
            if (!$this->contact_city->Raw) {
                $this->contact_city->CurrentValue = HtmlDecode($this->contact_city->CurrentValue);
            }
            $this->contact_city->EditValue = HtmlEncode($this->contact_city->CurrentValue);
            $this->contact_city->PlaceHolder = RemoveHtml($this->contact_city->caption());

            // contact_zip_code
            $this->contact_zip_code->setupEditAttributes();
            if (!$this->contact_zip_code->Raw) {
                $this->contact_zip_code->CurrentValue = HtmlDecode($this->contact_zip_code->CurrentValue);
            }
            $this->contact_zip_code->EditValue = HtmlEncode($this->contact_zip_code->CurrentValue);
            $this->contact_zip_code->PlaceHolder = RemoveHtml($this->contact_zip_code->caption());

            // contact_state
            $this->contact_state->setupEditAttributes();
            if (!$this->contact_state->Raw) {
                $this->contact_state->CurrentValue = HtmlDecode($this->contact_state->CurrentValue);
            }
            $this->contact_state->EditValue = HtmlEncode($this->contact_state->CurrentValue);
            $this->contact_state->PlaceHolder = RemoveHtml($this->contact_state->caption());

            // contact_country
            $this->contact_country->setupEditAttributes();
            if (!$this->contact_country->Raw) {
                $this->contact_country->CurrentValue = HtmlDecode($this->contact_country->CurrentValue);
            }
            $this->contact_country->EditValue = HtmlEncode($this->contact_country->CurrentValue);
            $this->contact_country->PlaceHolder = RemoveHtml($this->contact_country->caption());

            // notes
            $this->notes->setupEditAttributes();
            $this->notes->EditValue = HtmlEncode($this->notes->CurrentValue);
            $this->notes->PlaceHolder = RemoveHtml($this->notes->caption());

            // footer
            $this->footer->setupEditAttributes();
            $this->footer->EditValue = HtmlEncode($this->footer->CurrentValue);
            $this->footer->PlaceHolder = RemoveHtml($this->footer->caption());

            // parent_id
            $this->parent_id->setupEditAttributes();
            $this->parent_id->EditValue = HtmlEncode($this->parent_id->CurrentValue);
            $this->parent_id->PlaceHolder = RemoveHtml($this->parent_id->caption());
            if (strval($this->parent_id->EditValue) != "" && is_numeric($this->parent_id->EditValue)) {
                $this->parent_id->EditValue = FormatNumber($this->parent_id->EditValue, null);
            }

            // created_from
            $this->created_from->setupEditAttributes();
            if (!$this->created_from->Raw) {
                $this->created_from->CurrentValue = HtmlDecode($this->created_from->CurrentValue);
            }
            $this->created_from->EditValue = HtmlEncode($this->created_from->CurrentValue);
            $this->created_from->PlaceHolder = RemoveHtml($this->created_from->caption());

            // created_by
            $this->created_by->setupEditAttributes();
            $this->created_by->EditValue = HtmlEncode($this->created_by->CurrentValue);
            $this->created_by->PlaceHolder = RemoveHtml($this->created_by->caption());
            if (strval($this->created_by->EditValue) != "" && is_numeric($this->created_by->EditValue)) {
                $this->created_by->EditValue = FormatNumber($this->created_by->EditValue, null);
            }

            // created_at

            // updated_at

            // deleted_at

            // Add refer script

            // departement_id
            $this->departement_id->HrefValue = "";

            // company_id
            $this->company_id->HrefValue = "";

            // type
            $this->type->HrefValue = "";

            // document_number
            $this->document_number->HrefValue = "";

            // order_number
            $this->order_number->HrefValue = "";

            // status
            $this->status->HrefValue = "";

            // issued_at
            $this->issued_at->HrefValue = "";

            // due_at
            $this->due_at->HrefValue = "";

            // amount
            $this->amount->HrefValue = "";

            // currency_code
            $this->currency_code->HrefValue = "";

            // currency_rate
            $this->currency_rate->HrefValue = "";

            // category_id
            $this->category_id->HrefValue = "";

            // contact_id
            $this->contact_id->HrefValue = "";

            // contact_name
            $this->contact_name->HrefValue = "";

            // contact_email
            $this->contact_email->HrefValue = "";

            // contact_tax_number
            $this->contact_tax_number->HrefValue = "";

            // contact_phone
            $this->contact_phone->HrefValue = "";

            // contact_address
            $this->contact_address->HrefValue = "";

            // contact_city
            $this->contact_city->HrefValue = "";

            // contact_zip_code
            $this->contact_zip_code->HrefValue = "";

            // contact_state
            $this->contact_state->HrefValue = "";

            // contact_country
            $this->contact_country->HrefValue = "";

            // notes
            $this->notes->HrefValue = "";

            // footer
            $this->footer->HrefValue = "";

            // parent_id
            $this->parent_id->HrefValue = "";

            // created_from
            $this->created_from->HrefValue = "";

            // created_by
            $this->created_by->HrefValue = "";

            // created_at
            $this->created_at->HrefValue = "";

            // updated_at
            $this->updated_at->HrefValue = "";

            // deleted_at
            $this->deleted_at->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language, $Security;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->departement_id->Visible && $this->departement_id->Required) {
            if (!$this->departement_id->IsDetailKey && EmptyValue($this->departement_id->FormValue)) {
                $this->departement_id->addErrorMessage(str_replace("%s", $this->departement_id->caption(), $this->departement_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->departement_id->FormValue)) {
            $this->departement_id->addErrorMessage($this->departement_id->getErrorMessage(false));
        }
        if ($this->company_id->Visible && $this->company_id->Required) {
            if (!$this->company_id->IsDetailKey && EmptyValue($this->company_id->FormValue)) {
                $this->company_id->addErrorMessage(str_replace("%s", $this->company_id->caption(), $this->company_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->company_id->FormValue)) {
            $this->company_id->addErrorMessage($this->company_id->getErrorMessage(false));
        }
        if ($this->type->Visible && $this->type->Required) {
            if (!$this->type->IsDetailKey && EmptyValue($this->type->FormValue)) {
                $this->type->addErrorMessage(str_replace("%s", $this->type->caption(), $this->type->RequiredErrorMessage));
            }
        }
        if ($this->document_number->Visible && $this->document_number->Required) {
            if (!$this->document_number->IsDetailKey && EmptyValue($this->document_number->FormValue)) {
                $this->document_number->addErrorMessage(str_replace("%s", $this->document_number->caption(), $this->document_number->RequiredErrorMessage));
            }
        }
        if ($this->order_number->Visible && $this->order_number->Required) {
            if (!$this->order_number->IsDetailKey && EmptyValue($this->order_number->FormValue)) {
                $this->order_number->addErrorMessage(str_replace("%s", $this->order_number->caption(), $this->order_number->RequiredErrorMessage));
            }
        }
        if ($this->status->Visible && $this->status->Required) {
            if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
            }
        }
        if ($this->issued_at->Visible && $this->issued_at->Required) {
            if (!$this->issued_at->IsDetailKey && EmptyValue($this->issued_at->FormValue)) {
                $this->issued_at->addErrorMessage(str_replace("%s", $this->issued_at->caption(), $this->issued_at->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->issued_at->FormValue, $this->issued_at->formatPattern())) {
            $this->issued_at->addErrorMessage($this->issued_at->getErrorMessage(false));
        }
        if ($this->due_at->Visible && $this->due_at->Required) {
            if (!$this->due_at->IsDetailKey && EmptyValue($this->due_at->FormValue)) {
                $this->due_at->addErrorMessage(str_replace("%s", $this->due_at->caption(), $this->due_at->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->due_at->FormValue, $this->due_at->formatPattern())) {
            $this->due_at->addErrorMessage($this->due_at->getErrorMessage(false));
        }
        if ($this->amount->Visible && $this->amount->Required) {
            if (!$this->amount->IsDetailKey && EmptyValue($this->amount->FormValue)) {
                $this->amount->addErrorMessage(str_replace("%s", $this->amount->caption(), $this->amount->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->amount->FormValue)) {
            $this->amount->addErrorMessage($this->amount->getErrorMessage(false));
        }
        if ($this->currency_code->Visible && $this->currency_code->Required) {
            if (!$this->currency_code->IsDetailKey && EmptyValue($this->currency_code->FormValue)) {
                $this->currency_code->addErrorMessage(str_replace("%s", $this->currency_code->caption(), $this->currency_code->RequiredErrorMessage));
            }
        }
        if ($this->currency_rate->Visible && $this->currency_rate->Required) {
            if (!$this->currency_rate->IsDetailKey && EmptyValue($this->currency_rate->FormValue)) {
                $this->currency_rate->addErrorMessage(str_replace("%s", $this->currency_rate->caption(), $this->currency_rate->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->currency_rate->FormValue)) {
            $this->currency_rate->addErrorMessage($this->currency_rate->getErrorMessage(false));
        }
        if ($this->category_id->Visible && $this->category_id->Required) {
            if (!$this->category_id->IsDetailKey && EmptyValue($this->category_id->FormValue)) {
                $this->category_id->addErrorMessage(str_replace("%s", $this->category_id->caption(), $this->category_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->category_id->FormValue)) {
            $this->category_id->addErrorMessage($this->category_id->getErrorMessage(false));
        }
        if ($this->contact_id->Visible && $this->contact_id->Required) {
            if (!$this->contact_id->IsDetailKey && EmptyValue($this->contact_id->FormValue)) {
                $this->contact_id->addErrorMessage(str_replace("%s", $this->contact_id->caption(), $this->contact_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->contact_id->FormValue)) {
            $this->contact_id->addErrorMessage($this->contact_id->getErrorMessage(false));
        }
        if ($this->contact_name->Visible && $this->contact_name->Required) {
            if (!$this->contact_name->IsDetailKey && EmptyValue($this->contact_name->FormValue)) {
                $this->contact_name->addErrorMessage(str_replace("%s", $this->contact_name->caption(), $this->contact_name->RequiredErrorMessage));
            }
        }
        if ($this->contact_email->Visible && $this->contact_email->Required) {
            if (!$this->contact_email->IsDetailKey && EmptyValue($this->contact_email->FormValue)) {
                $this->contact_email->addErrorMessage(str_replace("%s", $this->contact_email->caption(), $this->contact_email->RequiredErrorMessage));
            }
        }
        if ($this->contact_tax_number->Visible && $this->contact_tax_number->Required) {
            if (!$this->contact_tax_number->IsDetailKey && EmptyValue($this->contact_tax_number->FormValue)) {
                $this->contact_tax_number->addErrorMessage(str_replace("%s", $this->contact_tax_number->caption(), $this->contact_tax_number->RequiredErrorMessage));
            }
        }
        if ($this->contact_phone->Visible && $this->contact_phone->Required) {
            if (!$this->contact_phone->IsDetailKey && EmptyValue($this->contact_phone->FormValue)) {
                $this->contact_phone->addErrorMessage(str_replace("%s", $this->contact_phone->caption(), $this->contact_phone->RequiredErrorMessage));
            }
        }
        if ($this->contact_address->Visible && $this->contact_address->Required) {
            if (!$this->contact_address->IsDetailKey && EmptyValue($this->contact_address->FormValue)) {
                $this->contact_address->addErrorMessage(str_replace("%s", $this->contact_address->caption(), $this->contact_address->RequiredErrorMessage));
            }
        }
        if ($this->contact_city->Visible && $this->contact_city->Required) {
            if (!$this->contact_city->IsDetailKey && EmptyValue($this->contact_city->FormValue)) {
                $this->contact_city->addErrorMessage(str_replace("%s", $this->contact_city->caption(), $this->contact_city->RequiredErrorMessage));
            }
        }
        if ($this->contact_zip_code->Visible && $this->contact_zip_code->Required) {
            if (!$this->contact_zip_code->IsDetailKey && EmptyValue($this->contact_zip_code->FormValue)) {
                $this->contact_zip_code->addErrorMessage(str_replace("%s", $this->contact_zip_code->caption(), $this->contact_zip_code->RequiredErrorMessage));
            }
        }
        if ($this->contact_state->Visible && $this->contact_state->Required) {
            if (!$this->contact_state->IsDetailKey && EmptyValue($this->contact_state->FormValue)) {
                $this->contact_state->addErrorMessage(str_replace("%s", $this->contact_state->caption(), $this->contact_state->RequiredErrorMessage));
            }
        }
        if ($this->contact_country->Visible && $this->contact_country->Required) {
            if (!$this->contact_country->IsDetailKey && EmptyValue($this->contact_country->FormValue)) {
                $this->contact_country->addErrorMessage(str_replace("%s", $this->contact_country->caption(), $this->contact_country->RequiredErrorMessage));
            }
        }
        if ($this->notes->Visible && $this->notes->Required) {
            if (!$this->notes->IsDetailKey && EmptyValue($this->notes->FormValue)) {
                $this->notes->addErrorMessage(str_replace("%s", $this->notes->caption(), $this->notes->RequiredErrorMessage));
            }
        }
        if ($this->footer->Visible && $this->footer->Required) {
            if (!$this->footer->IsDetailKey && EmptyValue($this->footer->FormValue)) {
                $this->footer->addErrorMessage(str_replace("%s", $this->footer->caption(), $this->footer->RequiredErrorMessage));
            }
        }
        if ($this->parent_id->Visible && $this->parent_id->Required) {
            if (!$this->parent_id->IsDetailKey && EmptyValue($this->parent_id->FormValue)) {
                $this->parent_id->addErrorMessage(str_replace("%s", $this->parent_id->caption(), $this->parent_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->parent_id->FormValue)) {
            $this->parent_id->addErrorMessage($this->parent_id->getErrorMessage(false));
        }
        if ($this->created_from->Visible && $this->created_from->Required) {
            if (!$this->created_from->IsDetailKey && EmptyValue($this->created_from->FormValue)) {
                $this->created_from->addErrorMessage(str_replace("%s", $this->created_from->caption(), $this->created_from->RequiredErrorMessage));
            }
        }
        if ($this->created_by->Visible && $this->created_by->Required) {
            if (!$this->created_by->IsDetailKey && EmptyValue($this->created_by->FormValue)) {
                $this->created_by->addErrorMessage(str_replace("%s", $this->created_by->caption(), $this->created_by->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->created_by->FormValue)) {
            $this->created_by->addErrorMessage($this->created_by->getErrorMessage(false));
        }
        if ($this->created_at->Visible && $this->created_at->Required) {
            if (!$this->created_at->IsDetailKey && EmptyValue($this->created_at->FormValue)) {
                $this->created_at->addErrorMessage(str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
            }
        }
        if ($this->updated_at->Visible && $this->updated_at->Required) {
            if (!$this->updated_at->IsDetailKey && EmptyValue($this->updated_at->FormValue)) {
                $this->updated_at->addErrorMessage(str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
            }
        }
        if ($this->deleted_at->Visible && $this->deleted_at->Required) {
            if (!$this->deleted_at->IsDetailKey && EmptyValue($this->deleted_at->FormValue)) {
                $this->deleted_at->addErrorMessage(str_replace("%s", $this->deleted_at->caption(), $this->deleted_at->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set new row
        $rsnew = [];

        // departement_id
        $this->departement_id->setDbValueDef($rsnew, $this->departement_id->CurrentValue, false);

        // company_id
        $this->company_id->setDbValueDef($rsnew, $this->company_id->CurrentValue, false);

        // type
        $this->type->setDbValueDef($rsnew, $this->type->CurrentValue, false);

        // document_number
        $this->document_number->setDbValueDef($rsnew, $this->document_number->CurrentValue, false);

        // order_number
        $this->order_number->setDbValueDef($rsnew, $this->order_number->CurrentValue, false);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, false);

        // issued_at
        $this->issued_at->setDbValueDef($rsnew, UnFormatDateTime($this->issued_at->CurrentValue, $this->issued_at->formatPattern()), false);

        // due_at
        $this->due_at->setDbValueDef($rsnew, UnFormatDateTime($this->due_at->CurrentValue, $this->due_at->formatPattern()), false);

        // amount
        $this->amount->setDbValueDef($rsnew, $this->amount->CurrentValue, false);

        // currency_code
        $this->currency_code->setDbValueDef($rsnew, $this->currency_code->CurrentValue, false);

        // currency_rate
        $this->currency_rate->setDbValueDef($rsnew, $this->currency_rate->CurrentValue, false);

        // category_id
        $this->category_id->setDbValueDef($rsnew, $this->category_id->CurrentValue, strval($this->category_id->CurrentValue) == "");

        // contact_id
        $this->contact_id->setDbValueDef($rsnew, $this->contact_id->CurrentValue, false);

        // contact_name
        $this->contact_name->setDbValueDef($rsnew, $this->contact_name->CurrentValue, false);

        // contact_email
        $this->contact_email->setDbValueDef($rsnew, $this->contact_email->CurrentValue, false);

        // contact_tax_number
        $this->contact_tax_number->setDbValueDef($rsnew, $this->contact_tax_number->CurrentValue, false);

        // contact_phone
        $this->contact_phone->setDbValueDef($rsnew, $this->contact_phone->CurrentValue, false);

        // contact_address
        $this->contact_address->setDbValueDef($rsnew, $this->contact_address->CurrentValue, false);

        // contact_city
        $this->contact_city->setDbValueDef($rsnew, $this->contact_city->CurrentValue, false);

        // contact_zip_code
        $this->contact_zip_code->setDbValueDef($rsnew, $this->contact_zip_code->CurrentValue, false);

        // contact_state
        $this->contact_state->setDbValueDef($rsnew, $this->contact_state->CurrentValue, false);

        // contact_country
        $this->contact_country->setDbValueDef($rsnew, $this->contact_country->CurrentValue, false);

        // notes
        $this->notes->setDbValueDef($rsnew, $this->notes->CurrentValue, false);

        // footer
        $this->footer->setDbValueDef($rsnew, $this->footer->CurrentValue, false);

        // parent_id
        $this->parent_id->setDbValueDef($rsnew, $this->parent_id->CurrentValue, strval($this->parent_id->CurrentValue) == "");

        // created_from
        $this->created_from->setDbValueDef($rsnew, $this->created_from->CurrentValue, false);

        // created_by
        $this->created_by->setDbValueDef($rsnew, $this->created_by->CurrentValue, false);

        // created_at
        $this->created_at->CurrentValue = $this->created_at->getAutoUpdateValue(); // PHP
        $this->created_at->setDbValueDef($rsnew, $this->created_at->CurrentValue);

        // updated_at
        $this->updated_at->CurrentValue = $this->updated_at->getAutoUpdateValue(); // PHP
        $this->updated_at->setDbValueDef($rsnew, $this->updated_at->CurrentValue);

        // deleted_at
        $this->deleted_at->CurrentValue = $this->deleted_at->getAutoUpdateValue(); // PHP
        $this->deleted_at->setDbValueDef($rsnew, $this->deleted_at->CurrentValue);

        // Update current values
        $this->setCurrentValues($rsnew);
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            } elseif (!EmptyValue($this->DbErrorMessage)) { // Show database error
                $this->setFailureMessage($this->DbErrorMessage);
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_ADD_ACTION"), $table => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("DocumentsList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0 && count($fld->Lookup->FilterFields) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $key = $row["lf"];
                    if (IsFloatType($fld->Type)) { // Handle float field
                        $key = (float)$key;
                    }
                    $ar[strval($key)] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Page Breaking event
    public function pageBreaking(&$break, &$content)
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"break-after:page;\"></div>"; // Modify page break content
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
