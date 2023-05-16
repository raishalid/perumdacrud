<?php

namespace PHPMaker2023\crudperumdautama;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class TransactionAdd extends Transaction
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "TransactionAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "TransactionAdd";

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
        $this->acc_id->setVisibility();
        $this->paid_at->setVisibility();
        $this->departement_id->setVisibility();
        $this->type_id->setVisibility();
        $this->amount->setVisibility();
        $this->currency_code->setVisibility();
        $this->currency_rate->setVisibility();
        $this->document_id->setVisibility();
        $this->contact_id->setVisibility();
        $this->description->setVisibility();
        $this->acc_category_id->setVisibility();
        $this->payment_method->setVisibility();
        $this->reference->setVisibility();
        $this->parent_id->setVisibility();
        $this->reconciled->setVisibility();
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
        $this->TableVar = 'transaction';
        $this->TableName = 'transaction';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (transaction)
        if (!isset($GLOBALS["transaction"]) || get_class($GLOBALS["transaction"]) == PROJECT_NAMESPACE . "transaction") {
            $GLOBALS["transaction"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'transaction');
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
                    $result["view"] = $pageName == "TransactionView"; // If View page, no primary button
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

        // Set up lookup cache
        $this->setupLookupOptions($this->reconciled);

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
                    $this->terminate("TransactionList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "TransactionList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "TransactionView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "TransactionList") {
                            Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "TransactionList"; // Return list page content
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
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'acc_id' first before field var 'x_acc_id'
        $val = $CurrentForm->hasValue("acc_id") ? $CurrentForm->getValue("acc_id") : $CurrentForm->getValue("x_acc_id");
        if (!$this->acc_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->acc_id->Visible = false; // Disable update for API request
            } else {
                $this->acc_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'paid_at' first before field var 'x_paid_at'
        $val = $CurrentForm->hasValue("paid_at") ? $CurrentForm->getValue("paid_at") : $CurrentForm->getValue("x_paid_at");
        if (!$this->paid_at->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->paid_at->Visible = false; // Disable update for API request
            } else {
                $this->paid_at->setFormValue($val, true, $validate);
            }
            $this->paid_at->CurrentValue = UnFormatDateTime($this->paid_at->CurrentValue, $this->paid_at->formatPattern());
        }

        // Check field name 'departement_id' first before field var 'x_departement_id'
        $val = $CurrentForm->hasValue("departement_id") ? $CurrentForm->getValue("departement_id") : $CurrentForm->getValue("x_departement_id");
        if (!$this->departement_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->departement_id->Visible = false; // Disable update for API request
            } else {
                $this->departement_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'type_id' first before field var 'x_type_id'
        $val = $CurrentForm->hasValue("type_id") ? $CurrentForm->getValue("type_id") : $CurrentForm->getValue("x_type_id");
        if (!$this->type_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->type_id->Visible = false; // Disable update for API request
            } else {
                $this->type_id->setFormValue($val, true, $validate);
            }
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

        // Check field name 'document_id' first before field var 'x_document_id'
        $val = $CurrentForm->hasValue("document_id") ? $CurrentForm->getValue("document_id") : $CurrentForm->getValue("x_document_id");
        if (!$this->document_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->document_id->Visible = false; // Disable update for API request
            } else {
                $this->document_id->setFormValue($val, true, $validate);
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

        // Check field name 'description' first before field var 'x_description'
        $val = $CurrentForm->hasValue("description") ? $CurrentForm->getValue("description") : $CurrentForm->getValue("x_description");
        if (!$this->description->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->description->Visible = false; // Disable update for API request
            } else {
                $this->description->setFormValue($val);
            }
        }

        // Check field name 'acc_category_id' first before field var 'x_acc_category_id'
        $val = $CurrentForm->hasValue("acc_category_id") ? $CurrentForm->getValue("acc_category_id") : $CurrentForm->getValue("x_acc_category_id");
        if (!$this->acc_category_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->acc_category_id->Visible = false; // Disable update for API request
            } else {
                $this->acc_category_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'payment_method' first before field var 'x_payment_method'
        $val = $CurrentForm->hasValue("payment_method") ? $CurrentForm->getValue("payment_method") : $CurrentForm->getValue("x_payment_method");
        if (!$this->payment_method->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->payment_method->Visible = false; // Disable update for API request
            } else {
                $this->payment_method->setFormValue($val);
            }
        }

        // Check field name 'reference' first before field var 'x_reference'
        $val = $CurrentForm->hasValue("reference") ? $CurrentForm->getValue("reference") : $CurrentForm->getValue("x_reference");
        if (!$this->reference->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->reference->Visible = false; // Disable update for API request
            } else {
                $this->reference->setFormValue($val);
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

        // Check field name 'reconciled' first before field var 'x_reconciled'
        $val = $CurrentForm->hasValue("reconciled") ? $CurrentForm->getValue("reconciled") : $CurrentForm->getValue("x_reconciled");
        if (!$this->reconciled->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->reconciled->Visible = false; // Disable update for API request
            } else {
                $this->reconciled->setFormValue($val);
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
                $this->created_by->setFormValue($val);
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
        $this->acc_id->CurrentValue = $this->acc_id->FormValue;
        $this->paid_at->CurrentValue = $this->paid_at->FormValue;
        $this->paid_at->CurrentValue = UnFormatDateTime($this->paid_at->CurrentValue, $this->paid_at->formatPattern());
        $this->departement_id->CurrentValue = $this->departement_id->FormValue;
        $this->type_id->CurrentValue = $this->type_id->FormValue;
        $this->amount->CurrentValue = $this->amount->FormValue;
        $this->currency_code->CurrentValue = $this->currency_code->FormValue;
        $this->currency_rate->CurrentValue = $this->currency_rate->FormValue;
        $this->document_id->CurrentValue = $this->document_id->FormValue;
        $this->contact_id->CurrentValue = $this->contact_id->FormValue;
        $this->description->CurrentValue = $this->description->FormValue;
        $this->acc_category_id->CurrentValue = $this->acc_category_id->FormValue;
        $this->payment_method->CurrentValue = $this->payment_method->FormValue;
        $this->reference->CurrentValue = $this->reference->FormValue;
        $this->parent_id->CurrentValue = $this->parent_id->FormValue;
        $this->reconciled->CurrentValue = $this->reconciled->FormValue;
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
        $this->acc_id->setDbValue($row['acc_id']);
        $this->paid_at->setDbValue($row['paid_at']);
        $this->departement_id->setDbValue($row['departement_id']);
        $this->type_id->setDbValue($row['type_id']);
        $this->amount->setDbValue($row['amount']);
        $this->currency_code->setDbValue($row['currency_code']);
        $this->currency_rate->setDbValue($row['currency_rate']);
        $this->document_id->setDbValue($row['document_id']);
        $this->contact_id->setDbValue($row['contact_id']);
        $this->description->setDbValue($row['description']);
        $this->acc_category_id->setDbValue($row['acc_category_id']);
        $this->payment_method->setDbValue($row['payment_method']);
        $this->reference->setDbValue($row['reference']);
        $this->parent_id->setDbValue($row['parent_id']);
        $this->reconciled->setDbValue($row['reconciled']);
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
        $row['acc_id'] = $this->acc_id->DefaultValue;
        $row['paid_at'] = $this->paid_at->DefaultValue;
        $row['departement_id'] = $this->departement_id->DefaultValue;
        $row['type_id'] = $this->type_id->DefaultValue;
        $row['amount'] = $this->amount->DefaultValue;
        $row['currency_code'] = $this->currency_code->DefaultValue;
        $row['currency_rate'] = $this->currency_rate->DefaultValue;
        $row['document_id'] = $this->document_id->DefaultValue;
        $row['contact_id'] = $this->contact_id->DefaultValue;
        $row['description'] = $this->description->DefaultValue;
        $row['acc_category_id'] = $this->acc_category_id->DefaultValue;
        $row['payment_method'] = $this->payment_method->DefaultValue;
        $row['reference'] = $this->reference->DefaultValue;
        $row['parent_id'] = $this->parent_id->DefaultValue;
        $row['reconciled'] = $this->reconciled->DefaultValue;
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

        // acc_id
        $this->acc_id->RowCssClass = "row";

        // paid_at
        $this->paid_at->RowCssClass = "row";

        // departement_id
        $this->departement_id->RowCssClass = "row";

        // type_id
        $this->type_id->RowCssClass = "row";

        // amount
        $this->amount->RowCssClass = "row";

        // currency_code
        $this->currency_code->RowCssClass = "row";

        // currency_rate
        $this->currency_rate->RowCssClass = "row";

        // document_id
        $this->document_id->RowCssClass = "row";

        // contact_id
        $this->contact_id->RowCssClass = "row";

        // description
        $this->description->RowCssClass = "row";

        // acc_category_id
        $this->acc_category_id->RowCssClass = "row";

        // payment_method
        $this->payment_method->RowCssClass = "row";

        // reference
        $this->reference->RowCssClass = "row";

        // parent_id
        $this->parent_id->RowCssClass = "row";

        // reconciled
        $this->reconciled->RowCssClass = "row";

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

            // acc_id
            $this->acc_id->ViewValue = $this->acc_id->CurrentValue;
            $this->acc_id->ViewValue = FormatNumber($this->acc_id->ViewValue, $this->acc_id->formatPattern());

            // paid_at
            $this->paid_at->ViewValue = $this->paid_at->CurrentValue;
            $this->paid_at->ViewValue = FormatDateTime($this->paid_at->ViewValue, $this->paid_at->formatPattern());

            // departement_id
            $this->departement_id->ViewValue = $this->departement_id->CurrentValue;
            $this->departement_id->ViewValue = FormatNumber($this->departement_id->ViewValue, $this->departement_id->formatPattern());

            // type_id
            $this->type_id->ViewValue = $this->type_id->CurrentValue;
            $this->type_id->ViewValue = FormatNumber($this->type_id->ViewValue, $this->type_id->formatPattern());

            // amount
            $this->amount->ViewValue = $this->amount->CurrentValue;
            $this->amount->ViewValue = FormatNumber($this->amount->ViewValue, $this->amount->formatPattern());

            // currency_code
            $this->currency_code->ViewValue = $this->currency_code->CurrentValue;

            // currency_rate
            $this->currency_rate->ViewValue = $this->currency_rate->CurrentValue;
            $this->currency_rate->ViewValue = FormatNumber($this->currency_rate->ViewValue, $this->currency_rate->formatPattern());

            // document_id
            $this->document_id->ViewValue = $this->document_id->CurrentValue;
            $this->document_id->ViewValue = FormatNumber($this->document_id->ViewValue, $this->document_id->formatPattern());

            // contact_id
            $this->contact_id->ViewValue = $this->contact_id->CurrentValue;
            $this->contact_id->ViewValue = FormatNumber($this->contact_id->ViewValue, $this->contact_id->formatPattern());

            // description
            $this->description->ViewValue = $this->description->CurrentValue;

            // acc_category_id
            $this->acc_category_id->ViewValue = $this->acc_category_id->CurrentValue;
            $this->acc_category_id->ViewValue = FormatNumber($this->acc_category_id->ViewValue, $this->acc_category_id->formatPattern());

            // payment_method
            $this->payment_method->ViewValue = $this->payment_method->CurrentValue;

            // reference
            $this->reference->ViewValue = $this->reference->CurrentValue;

            // parent_id
            $this->parent_id->ViewValue = $this->parent_id->CurrentValue;
            $this->parent_id->ViewValue = FormatNumber($this->parent_id->ViewValue, $this->parent_id->formatPattern());

            // reconciled
            if (ConvertToBool($this->reconciled->CurrentValue)) {
                $this->reconciled->ViewValue = $this->reconciled->tagCaption(1) != "" ? $this->reconciled->tagCaption(1) : "Yes";
            } else {
                $this->reconciled->ViewValue = $this->reconciled->tagCaption(2) != "" ? $this->reconciled->tagCaption(2) : "No";
            }

            // created_from
            $this->created_from->ViewValue = $this->created_from->CurrentValue;

            // created_by
            $this->created_by->ViewValue = $this->created_by->CurrentValue;

            // created_at
            $this->created_at->ViewValue = $this->created_at->CurrentValue;
            $this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, $this->created_at->formatPattern());

            // updated_at
            $this->updated_at->ViewValue = $this->updated_at->CurrentValue;
            $this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, $this->updated_at->formatPattern());

            // deleted_at
            $this->deleted_at->ViewValue = $this->deleted_at->CurrentValue;
            $this->deleted_at->ViewValue = FormatDateTime($this->deleted_at->ViewValue, $this->deleted_at->formatPattern());

            // acc_id
            $this->acc_id->HrefValue = "";

            // paid_at
            $this->paid_at->HrefValue = "";

            // departement_id
            $this->departement_id->HrefValue = "";

            // type_id
            $this->type_id->HrefValue = "";

            // amount
            $this->amount->HrefValue = "";

            // currency_code
            $this->currency_code->HrefValue = "";

            // currency_rate
            $this->currency_rate->HrefValue = "";

            // document_id
            $this->document_id->HrefValue = "";

            // contact_id
            $this->contact_id->HrefValue = "";

            // description
            $this->description->HrefValue = "";

            // acc_category_id
            $this->acc_category_id->HrefValue = "";

            // payment_method
            $this->payment_method->HrefValue = "";

            // reference
            $this->reference->HrefValue = "";

            // parent_id
            $this->parent_id->HrefValue = "";

            // reconciled
            $this->reconciled->HrefValue = "";

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
            // acc_id
            $this->acc_id->setupEditAttributes();
            $this->acc_id->EditValue = HtmlEncode($this->acc_id->CurrentValue);
            $this->acc_id->PlaceHolder = RemoveHtml($this->acc_id->caption());
            if (strval($this->acc_id->EditValue) != "" && is_numeric($this->acc_id->EditValue)) {
                $this->acc_id->EditValue = FormatNumber($this->acc_id->EditValue, null);
            }

            // paid_at
            $this->paid_at->setupEditAttributes();
            $this->paid_at->EditValue = HtmlEncode(FormatDateTime($this->paid_at->CurrentValue, $this->paid_at->formatPattern()));
            $this->paid_at->PlaceHolder = RemoveHtml($this->paid_at->caption());

            // departement_id
            $this->departement_id->setupEditAttributes();
            $this->departement_id->EditValue = HtmlEncode($this->departement_id->CurrentValue);
            $this->departement_id->PlaceHolder = RemoveHtml($this->departement_id->caption());
            if (strval($this->departement_id->EditValue) != "" && is_numeric($this->departement_id->EditValue)) {
                $this->departement_id->EditValue = FormatNumber($this->departement_id->EditValue, null);
            }

            // type_id
            $this->type_id->setupEditAttributes();
            $this->type_id->EditValue = HtmlEncode($this->type_id->CurrentValue);
            $this->type_id->PlaceHolder = RemoveHtml($this->type_id->caption());
            if (strval($this->type_id->EditValue) != "" && is_numeric($this->type_id->EditValue)) {
                $this->type_id->EditValue = FormatNumber($this->type_id->EditValue, null);
            }

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

            // document_id
            $this->document_id->setupEditAttributes();
            $this->document_id->EditValue = HtmlEncode($this->document_id->CurrentValue);
            $this->document_id->PlaceHolder = RemoveHtml($this->document_id->caption());
            if (strval($this->document_id->EditValue) != "" && is_numeric($this->document_id->EditValue)) {
                $this->document_id->EditValue = FormatNumber($this->document_id->EditValue, null);
            }

            // contact_id
            $this->contact_id->setupEditAttributes();
            $this->contact_id->EditValue = HtmlEncode($this->contact_id->CurrentValue);
            $this->contact_id->PlaceHolder = RemoveHtml($this->contact_id->caption());
            if (strval($this->contact_id->EditValue) != "" && is_numeric($this->contact_id->EditValue)) {
                $this->contact_id->EditValue = FormatNumber($this->contact_id->EditValue, null);
            }

            // description
            $this->description->setupEditAttributes();
            $this->description->EditValue = HtmlEncode($this->description->CurrentValue);
            $this->description->PlaceHolder = RemoveHtml($this->description->caption());

            // acc_category_id
            $this->acc_category_id->setupEditAttributes();
            $this->acc_category_id->EditValue = HtmlEncode($this->acc_category_id->CurrentValue);
            $this->acc_category_id->PlaceHolder = RemoveHtml($this->acc_category_id->caption());
            if (strval($this->acc_category_id->EditValue) != "" && is_numeric($this->acc_category_id->EditValue)) {
                $this->acc_category_id->EditValue = FormatNumber($this->acc_category_id->EditValue, null);
            }

            // payment_method
            $this->payment_method->setupEditAttributes();
            if (!$this->payment_method->Raw) {
                $this->payment_method->CurrentValue = HtmlDecode($this->payment_method->CurrentValue);
            }
            $this->payment_method->EditValue = HtmlEncode($this->payment_method->CurrentValue);
            $this->payment_method->PlaceHolder = RemoveHtml($this->payment_method->caption());

            // reference
            $this->reference->setupEditAttributes();
            if (!$this->reference->Raw) {
                $this->reference->CurrentValue = HtmlDecode($this->reference->CurrentValue);
            }
            $this->reference->EditValue = HtmlEncode($this->reference->CurrentValue);
            $this->reference->PlaceHolder = RemoveHtml($this->reference->caption());

            // parent_id
            $this->parent_id->setupEditAttributes();
            $this->parent_id->EditValue = HtmlEncode($this->parent_id->CurrentValue);
            $this->parent_id->PlaceHolder = RemoveHtml($this->parent_id->caption());
            if (strval($this->parent_id->EditValue) != "" && is_numeric($this->parent_id->EditValue)) {
                $this->parent_id->EditValue = FormatNumber($this->parent_id->EditValue, null);
            }

            // reconciled
            $this->reconciled->EditValue = $this->reconciled->options(false);
            $this->reconciled->PlaceHolder = RemoveHtml($this->reconciled->caption());

            // created_from
            $this->created_from->setupEditAttributes();
            if (!$this->created_from->Raw) {
                $this->created_from->CurrentValue = HtmlDecode($this->created_from->CurrentValue);
            }
            $this->created_from->EditValue = HtmlEncode($this->created_from->CurrentValue);
            $this->created_from->PlaceHolder = RemoveHtml($this->created_from->caption());

            // created_by
            $this->created_by->setupEditAttributes();
            if (!$this->created_by->Raw) {
                $this->created_by->CurrentValue = HtmlDecode($this->created_by->CurrentValue);
            }
            $this->created_by->EditValue = HtmlEncode($this->created_by->CurrentValue);
            $this->created_by->PlaceHolder = RemoveHtml($this->created_by->caption());

            // created_at

            // updated_at

            // deleted_at

            // Add refer script

            // acc_id
            $this->acc_id->HrefValue = "";

            // paid_at
            $this->paid_at->HrefValue = "";

            // departement_id
            $this->departement_id->HrefValue = "";

            // type_id
            $this->type_id->HrefValue = "";

            // amount
            $this->amount->HrefValue = "";

            // currency_code
            $this->currency_code->HrefValue = "";

            // currency_rate
            $this->currency_rate->HrefValue = "";

            // document_id
            $this->document_id->HrefValue = "";

            // contact_id
            $this->contact_id->HrefValue = "";

            // description
            $this->description->HrefValue = "";

            // acc_category_id
            $this->acc_category_id->HrefValue = "";

            // payment_method
            $this->payment_method->HrefValue = "";

            // reference
            $this->reference->HrefValue = "";

            // parent_id
            $this->parent_id->HrefValue = "";

            // reconciled
            $this->reconciled->HrefValue = "";

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
        if ($this->acc_id->Visible && $this->acc_id->Required) {
            if (!$this->acc_id->IsDetailKey && EmptyValue($this->acc_id->FormValue)) {
                $this->acc_id->addErrorMessage(str_replace("%s", $this->acc_id->caption(), $this->acc_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->acc_id->FormValue)) {
            $this->acc_id->addErrorMessage($this->acc_id->getErrorMessage(false));
        }
        if ($this->paid_at->Visible && $this->paid_at->Required) {
            if (!$this->paid_at->IsDetailKey && EmptyValue($this->paid_at->FormValue)) {
                $this->paid_at->addErrorMessage(str_replace("%s", $this->paid_at->caption(), $this->paid_at->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->paid_at->FormValue, $this->paid_at->formatPattern())) {
            $this->paid_at->addErrorMessage($this->paid_at->getErrorMessage(false));
        }
        if ($this->departement_id->Visible && $this->departement_id->Required) {
            if (!$this->departement_id->IsDetailKey && EmptyValue($this->departement_id->FormValue)) {
                $this->departement_id->addErrorMessage(str_replace("%s", $this->departement_id->caption(), $this->departement_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->departement_id->FormValue)) {
            $this->departement_id->addErrorMessage($this->departement_id->getErrorMessage(false));
        }
        if ($this->type_id->Visible && $this->type_id->Required) {
            if (!$this->type_id->IsDetailKey && EmptyValue($this->type_id->FormValue)) {
                $this->type_id->addErrorMessage(str_replace("%s", $this->type_id->caption(), $this->type_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->type_id->FormValue)) {
            $this->type_id->addErrorMessage($this->type_id->getErrorMessage(false));
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
        if ($this->document_id->Visible && $this->document_id->Required) {
            if (!$this->document_id->IsDetailKey && EmptyValue($this->document_id->FormValue)) {
                $this->document_id->addErrorMessage(str_replace("%s", $this->document_id->caption(), $this->document_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->document_id->FormValue)) {
            $this->document_id->addErrorMessage($this->document_id->getErrorMessage(false));
        }
        if ($this->contact_id->Visible && $this->contact_id->Required) {
            if (!$this->contact_id->IsDetailKey && EmptyValue($this->contact_id->FormValue)) {
                $this->contact_id->addErrorMessage(str_replace("%s", $this->contact_id->caption(), $this->contact_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->contact_id->FormValue)) {
            $this->contact_id->addErrorMessage($this->contact_id->getErrorMessage(false));
        }
        if ($this->description->Visible && $this->description->Required) {
            if (!$this->description->IsDetailKey && EmptyValue($this->description->FormValue)) {
                $this->description->addErrorMessage(str_replace("%s", $this->description->caption(), $this->description->RequiredErrorMessage));
            }
        }
        if ($this->acc_category_id->Visible && $this->acc_category_id->Required) {
            if (!$this->acc_category_id->IsDetailKey && EmptyValue($this->acc_category_id->FormValue)) {
                $this->acc_category_id->addErrorMessage(str_replace("%s", $this->acc_category_id->caption(), $this->acc_category_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->acc_category_id->FormValue)) {
            $this->acc_category_id->addErrorMessage($this->acc_category_id->getErrorMessage(false));
        }
        if ($this->payment_method->Visible && $this->payment_method->Required) {
            if (!$this->payment_method->IsDetailKey && EmptyValue($this->payment_method->FormValue)) {
                $this->payment_method->addErrorMessage(str_replace("%s", $this->payment_method->caption(), $this->payment_method->RequiredErrorMessage));
            }
        }
        if ($this->reference->Visible && $this->reference->Required) {
            if (!$this->reference->IsDetailKey && EmptyValue($this->reference->FormValue)) {
                $this->reference->addErrorMessage(str_replace("%s", $this->reference->caption(), $this->reference->RequiredErrorMessage));
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
        if ($this->reconciled->Visible && $this->reconciled->Required) {
            if ($this->reconciled->FormValue == "") {
                $this->reconciled->addErrorMessage(str_replace("%s", $this->reconciled->caption(), $this->reconciled->RequiredErrorMessage));
            }
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

        // acc_id
        $this->acc_id->setDbValueDef($rsnew, $this->acc_id->CurrentValue, false);

        // paid_at
        $this->paid_at->setDbValueDef($rsnew, UnFormatDateTime($this->paid_at->CurrentValue, $this->paid_at->formatPattern()), false);

        // departement_id
        $this->departement_id->setDbValueDef($rsnew, $this->departement_id->CurrentValue, false);

        // type_id
        $this->type_id->setDbValueDef($rsnew, $this->type_id->CurrentValue, false);

        // amount
        $this->amount->setDbValueDef($rsnew, $this->amount->CurrentValue, false);

        // currency_code
        $this->currency_code->setDbValueDef($rsnew, $this->currency_code->CurrentValue, false);

        // currency_rate
        $this->currency_rate->setDbValueDef($rsnew, $this->currency_rate->CurrentValue, false);

        // document_id
        $this->document_id->setDbValueDef($rsnew, $this->document_id->CurrentValue, false);

        // contact_id
        $this->contact_id->setDbValueDef($rsnew, $this->contact_id->CurrentValue, false);

        // description
        $this->description->setDbValueDef($rsnew, $this->description->CurrentValue, false);

        // acc_category_id
        $this->acc_category_id->setDbValueDef($rsnew, $this->acc_category_id->CurrentValue, false);

        // payment_method
        $this->payment_method->setDbValueDef($rsnew, $this->payment_method->CurrentValue, false);

        // reference
        $this->reference->setDbValueDef($rsnew, $this->reference->CurrentValue, false);

        // parent_id
        $this->parent_id->setDbValueDef($rsnew, $this->parent_id->CurrentValue, false);

        // reconciled
        $tmpBool = $this->reconciled->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->reconciled->setDbValueDef($rsnew, $tmpBool, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("TransactionList"), "", $this->TableVar, true);
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
                case "x_reconciled":
                    break;
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
