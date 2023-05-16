<?php

namespace PHPMaker2023\crudperumdautama;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class ContactsEdit extends Contacts
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "ContactsEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "ContactsEdit";

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
        $this->id->setVisibility();
        $this->company_id->setVisibility();
        $this->type->setVisibility();
        $this->name->setVisibility();
        $this->_email->setVisibility();
        $this->user_id->setVisibility();
        $this->tax_number->setVisibility();
        $this->phone->setVisibility();
        $this->address->setVisibility();
        $this->city->setVisibility();
        $this->zip_code->setVisibility();
        $this->state->setVisibility();
        $this->country->setVisibility();
        $this->website->setVisibility();
        $this->currency_code->setVisibility();
        $this->enabled->setVisibility();
        $this->reference->setVisibility();
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
        $this->TableVar = 'contacts';
        $this->TableName = 'contacts';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-edit-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (contacts)
        if (!isset($GLOBALS["contacts"]) || get_class($GLOBALS["contacts"]) == PROJECT_NAMESPACE . "contacts") {
            $GLOBALS["contacts"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'contacts');
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
                    $result["view"] = $pageName == "ContactsView"; // If View page, no primary button
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

    // Properties
    public $FormClassName = "ew-form ew-edit-form overlay-wrapper";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

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
        $this->setupLookupOptions($this->enabled);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("id") ?? Key(0) ?? Route(2)) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->id->setOldValue($this->id->QueryStringValue);
            } elseif (Post("id") !== null) {
                $this->id->setFormValue(Post("id"));
                $this->id->setOldValue($this->id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action", "") !== "") {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("id") ?? Route("id")) !== null) {
                    $this->id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                    // Load current record
                    $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("ContactsList"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "ContactsList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) {
                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "ContactsList") {
                            Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "ContactsList"; // Return list page content
                        }
                    }
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsJsonResponse()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
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
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
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

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey) {
            $this->id->setFormValue($val);
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

        // Check field name 'name' first before field var 'x_name'
        $val = $CurrentForm->hasValue("name") ? $CurrentForm->getValue("name") : $CurrentForm->getValue("x_name");
        if (!$this->name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->name->Visible = false; // Disable update for API request
            } else {
                $this->name->setFormValue($val);
            }
        }

        // Check field name 'email' first before field var 'x__email'
        $val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
        if (!$this->_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_email->Visible = false; // Disable update for API request
            } else {
                $this->_email->setFormValue($val);
            }
        }

        // Check field name 'user_id' first before field var 'x_user_id'
        $val = $CurrentForm->hasValue("user_id") ? $CurrentForm->getValue("user_id") : $CurrentForm->getValue("x_user_id");
        if (!$this->user_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->user_id->Visible = false; // Disable update for API request
            } else {
                $this->user_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'tax_number' first before field var 'x_tax_number'
        $val = $CurrentForm->hasValue("tax_number") ? $CurrentForm->getValue("tax_number") : $CurrentForm->getValue("x_tax_number");
        if (!$this->tax_number->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tax_number->Visible = false; // Disable update for API request
            } else {
                $this->tax_number->setFormValue($val);
            }
        }

        // Check field name 'phone' first before field var 'x_phone'
        $val = $CurrentForm->hasValue("phone") ? $CurrentForm->getValue("phone") : $CurrentForm->getValue("x_phone");
        if (!$this->phone->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->phone->Visible = false; // Disable update for API request
            } else {
                $this->phone->setFormValue($val);
            }
        }

        // Check field name 'address' first before field var 'x_address'
        $val = $CurrentForm->hasValue("address") ? $CurrentForm->getValue("address") : $CurrentForm->getValue("x_address");
        if (!$this->address->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->address->Visible = false; // Disable update for API request
            } else {
                $this->address->setFormValue($val);
            }
        }

        // Check field name 'city' first before field var 'x_city'
        $val = $CurrentForm->hasValue("city") ? $CurrentForm->getValue("city") : $CurrentForm->getValue("x_city");
        if (!$this->city->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->city->Visible = false; // Disable update for API request
            } else {
                $this->city->setFormValue($val);
            }
        }

        // Check field name 'zip_code' first before field var 'x_zip_code'
        $val = $CurrentForm->hasValue("zip_code") ? $CurrentForm->getValue("zip_code") : $CurrentForm->getValue("x_zip_code");
        if (!$this->zip_code->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->zip_code->Visible = false; // Disable update for API request
            } else {
                $this->zip_code->setFormValue($val);
            }
        }

        // Check field name 'state' first before field var 'x_state'
        $val = $CurrentForm->hasValue("state") ? $CurrentForm->getValue("state") : $CurrentForm->getValue("x_state");
        if (!$this->state->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->state->Visible = false; // Disable update for API request
            } else {
                $this->state->setFormValue($val);
            }
        }

        // Check field name 'country' first before field var 'x_country'
        $val = $CurrentForm->hasValue("country") ? $CurrentForm->getValue("country") : $CurrentForm->getValue("x_country");
        if (!$this->country->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->country->Visible = false; // Disable update for API request
            } else {
                $this->country->setFormValue($val);
            }
        }

        // Check field name 'website' first before field var 'x_website'
        $val = $CurrentForm->hasValue("website") ? $CurrentForm->getValue("website") : $CurrentForm->getValue("x_website");
        if (!$this->website->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->website->Visible = false; // Disable update for API request
            } else {
                $this->website->setFormValue($val);
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

        // Check field name 'enabled' first before field var 'x_enabled'
        $val = $CurrentForm->hasValue("enabled") ? $CurrentForm->getValue("enabled") : $CurrentForm->getValue("x_enabled");
        if (!$this->enabled->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->enabled->Visible = false; // Disable update for API request
            } else {
                $this->enabled->setFormValue($val);
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
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->company_id->CurrentValue = $this->company_id->FormValue;
        $this->type->CurrentValue = $this->type->FormValue;
        $this->name->CurrentValue = $this->name->FormValue;
        $this->_email->CurrentValue = $this->_email->FormValue;
        $this->user_id->CurrentValue = $this->user_id->FormValue;
        $this->tax_number->CurrentValue = $this->tax_number->FormValue;
        $this->phone->CurrentValue = $this->phone->FormValue;
        $this->address->CurrentValue = $this->address->FormValue;
        $this->city->CurrentValue = $this->city->FormValue;
        $this->zip_code->CurrentValue = $this->zip_code->FormValue;
        $this->state->CurrentValue = $this->state->FormValue;
        $this->country->CurrentValue = $this->country->FormValue;
        $this->website->CurrentValue = $this->website->FormValue;
        $this->currency_code->CurrentValue = $this->currency_code->FormValue;
        $this->enabled->CurrentValue = $this->enabled->FormValue;
        $this->reference->CurrentValue = $this->reference->FormValue;
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
        $this->company_id->setDbValue($row['company_id']);
        $this->type->setDbValue($row['type']);
        $this->name->setDbValue($row['name']);
        $this->_email->setDbValue($row['email']);
        $this->user_id->setDbValue($row['user_id']);
        $this->tax_number->setDbValue($row['tax_number']);
        $this->phone->setDbValue($row['phone']);
        $this->address->setDbValue($row['address']);
        $this->city->setDbValue($row['city']);
        $this->zip_code->setDbValue($row['zip_code']);
        $this->state->setDbValue($row['state']);
        $this->country->setDbValue($row['country']);
        $this->website->setDbValue($row['website']);
        $this->currency_code->setDbValue($row['currency_code']);
        $this->enabled->setDbValue($row['enabled']);
        $this->reference->setDbValue($row['reference']);
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
        $row['company_id'] = $this->company_id->DefaultValue;
        $row['type'] = $this->type->DefaultValue;
        $row['name'] = $this->name->DefaultValue;
        $row['email'] = $this->_email->DefaultValue;
        $row['user_id'] = $this->user_id->DefaultValue;
        $row['tax_number'] = $this->tax_number->DefaultValue;
        $row['phone'] = $this->phone->DefaultValue;
        $row['address'] = $this->address->DefaultValue;
        $row['city'] = $this->city->DefaultValue;
        $row['zip_code'] = $this->zip_code->DefaultValue;
        $row['state'] = $this->state->DefaultValue;
        $row['country'] = $this->country->DefaultValue;
        $row['website'] = $this->website->DefaultValue;
        $row['currency_code'] = $this->currency_code->DefaultValue;
        $row['enabled'] = $this->enabled->DefaultValue;
        $row['reference'] = $this->reference->DefaultValue;
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

        // company_id
        $this->company_id->RowCssClass = "row";

        // type
        $this->type->RowCssClass = "row";

        // name
        $this->name->RowCssClass = "row";

        // email
        $this->_email->RowCssClass = "row";

        // user_id
        $this->user_id->RowCssClass = "row";

        // tax_number
        $this->tax_number->RowCssClass = "row";

        // phone
        $this->phone->RowCssClass = "row";

        // address
        $this->address->RowCssClass = "row";

        // city
        $this->city->RowCssClass = "row";

        // zip_code
        $this->zip_code->RowCssClass = "row";

        // state
        $this->state->RowCssClass = "row";

        // country
        $this->country->RowCssClass = "row";

        // website
        $this->website->RowCssClass = "row";

        // currency_code
        $this->currency_code->RowCssClass = "row";

        // enabled
        $this->enabled->RowCssClass = "row";

        // reference
        $this->reference->RowCssClass = "row";

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

            // company_id
            $this->company_id->ViewValue = $this->company_id->CurrentValue;
            $this->company_id->ViewValue = FormatNumber($this->company_id->ViewValue, $this->company_id->formatPattern());

            // type
            $this->type->ViewValue = $this->type->CurrentValue;

            // name
            $this->name->ViewValue = $this->name->CurrentValue;

            // email
            $this->_email->ViewValue = $this->_email->CurrentValue;

            // user_id
            $this->user_id->ViewValue = $this->user_id->CurrentValue;
            $this->user_id->ViewValue = FormatNumber($this->user_id->ViewValue, $this->user_id->formatPattern());

            // tax_number
            $this->tax_number->ViewValue = $this->tax_number->CurrentValue;

            // phone
            $this->phone->ViewValue = $this->phone->CurrentValue;

            // address
            $this->address->ViewValue = $this->address->CurrentValue;

            // city
            $this->city->ViewValue = $this->city->CurrentValue;

            // zip_code
            $this->zip_code->ViewValue = $this->zip_code->CurrentValue;

            // state
            $this->state->ViewValue = $this->state->CurrentValue;

            // country
            $this->country->ViewValue = $this->country->CurrentValue;

            // website
            $this->website->ViewValue = $this->website->CurrentValue;

            // currency_code
            $this->currency_code->ViewValue = $this->currency_code->CurrentValue;

            // enabled
            if (ConvertToBool($this->enabled->CurrentValue)) {
                $this->enabled->ViewValue = $this->enabled->tagCaption(1) != "" ? $this->enabled->tagCaption(1) : "Yes";
            } else {
                $this->enabled->ViewValue = $this->enabled->tagCaption(2) != "" ? $this->enabled->tagCaption(2) : "No";
            }

            // reference
            $this->reference->ViewValue = $this->reference->CurrentValue;

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

            // id
            $this->id->HrefValue = "";

            // company_id
            $this->company_id->HrefValue = "";

            // type
            $this->type->HrefValue = "";

            // name
            $this->name->HrefValue = "";

            // email
            $this->_email->HrefValue = "";

            // user_id
            $this->user_id->HrefValue = "";

            // tax_number
            $this->tax_number->HrefValue = "";

            // phone
            $this->phone->HrefValue = "";

            // address
            $this->address->HrefValue = "";

            // city
            $this->city->HrefValue = "";

            // zip_code
            $this->zip_code->HrefValue = "";

            // state
            $this->state->HrefValue = "";

            // country
            $this->country->HrefValue = "";

            // website
            $this->website->HrefValue = "";

            // currency_code
            $this->currency_code->HrefValue = "";

            // enabled
            $this->enabled->HrefValue = "";

            // reference
            $this->reference->HrefValue = "";

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
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->setupEditAttributes();
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->EditValue = FormatNumber($this->id->EditValue, $this->id->formatPattern());

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

            // name
            $this->name->setupEditAttributes();
            if (!$this->name->Raw) {
                $this->name->CurrentValue = HtmlDecode($this->name->CurrentValue);
            }
            $this->name->EditValue = HtmlEncode($this->name->CurrentValue);
            $this->name->PlaceHolder = RemoveHtml($this->name->caption());

            // email
            $this->_email->setupEditAttributes();
            if (!$this->_email->Raw) {
                $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
            }
            $this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
            $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

            // user_id
            $this->user_id->setupEditAttributes();
            $this->user_id->EditValue = HtmlEncode($this->user_id->CurrentValue);
            $this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());
            if (strval($this->user_id->EditValue) != "" && is_numeric($this->user_id->EditValue)) {
                $this->user_id->EditValue = FormatNumber($this->user_id->EditValue, null);
            }

            // tax_number
            $this->tax_number->setupEditAttributes();
            if (!$this->tax_number->Raw) {
                $this->tax_number->CurrentValue = HtmlDecode($this->tax_number->CurrentValue);
            }
            $this->tax_number->EditValue = HtmlEncode($this->tax_number->CurrentValue);
            $this->tax_number->PlaceHolder = RemoveHtml($this->tax_number->caption());

            // phone
            $this->phone->setupEditAttributes();
            if (!$this->phone->Raw) {
                $this->phone->CurrentValue = HtmlDecode($this->phone->CurrentValue);
            }
            $this->phone->EditValue = HtmlEncode($this->phone->CurrentValue);
            $this->phone->PlaceHolder = RemoveHtml($this->phone->caption());

            // address
            $this->address->setupEditAttributes();
            $this->address->EditValue = HtmlEncode($this->address->CurrentValue);
            $this->address->PlaceHolder = RemoveHtml($this->address->caption());

            // city
            $this->city->setupEditAttributes();
            if (!$this->city->Raw) {
                $this->city->CurrentValue = HtmlDecode($this->city->CurrentValue);
            }
            $this->city->EditValue = HtmlEncode($this->city->CurrentValue);
            $this->city->PlaceHolder = RemoveHtml($this->city->caption());

            // zip_code
            $this->zip_code->setupEditAttributes();
            if (!$this->zip_code->Raw) {
                $this->zip_code->CurrentValue = HtmlDecode($this->zip_code->CurrentValue);
            }
            $this->zip_code->EditValue = HtmlEncode($this->zip_code->CurrentValue);
            $this->zip_code->PlaceHolder = RemoveHtml($this->zip_code->caption());

            // state
            $this->state->setupEditAttributes();
            if (!$this->state->Raw) {
                $this->state->CurrentValue = HtmlDecode($this->state->CurrentValue);
            }
            $this->state->EditValue = HtmlEncode($this->state->CurrentValue);
            $this->state->PlaceHolder = RemoveHtml($this->state->caption());

            // country
            $this->country->setupEditAttributes();
            if (!$this->country->Raw) {
                $this->country->CurrentValue = HtmlDecode($this->country->CurrentValue);
            }
            $this->country->EditValue = HtmlEncode($this->country->CurrentValue);
            $this->country->PlaceHolder = RemoveHtml($this->country->caption());

            // website
            $this->website->setupEditAttributes();
            if (!$this->website->Raw) {
                $this->website->CurrentValue = HtmlDecode($this->website->CurrentValue);
            }
            $this->website->EditValue = HtmlEncode($this->website->CurrentValue);
            $this->website->PlaceHolder = RemoveHtml($this->website->caption());

            // currency_code
            $this->currency_code->setupEditAttributes();
            if (!$this->currency_code->Raw) {
                $this->currency_code->CurrentValue = HtmlDecode($this->currency_code->CurrentValue);
            }
            $this->currency_code->EditValue = HtmlEncode($this->currency_code->CurrentValue);
            $this->currency_code->PlaceHolder = RemoveHtml($this->currency_code->caption());

            // enabled
            $this->enabled->EditValue = $this->enabled->options(false);
            $this->enabled->PlaceHolder = RemoveHtml($this->enabled->caption());

            // reference
            $this->reference->setupEditAttributes();
            if (!$this->reference->Raw) {
                $this->reference->CurrentValue = HtmlDecode($this->reference->CurrentValue);
            }
            $this->reference->EditValue = HtmlEncode($this->reference->CurrentValue);
            $this->reference->PlaceHolder = RemoveHtml($this->reference->caption());

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

            // Edit refer script

            // id
            $this->id->HrefValue = "";

            // company_id
            $this->company_id->HrefValue = "";

            // type
            $this->type->HrefValue = "";

            // name
            $this->name->HrefValue = "";

            // email
            $this->_email->HrefValue = "";

            // user_id
            $this->user_id->HrefValue = "";

            // tax_number
            $this->tax_number->HrefValue = "";

            // phone
            $this->phone->HrefValue = "";

            // address
            $this->address->HrefValue = "";

            // city
            $this->city->HrefValue = "";

            // zip_code
            $this->zip_code->HrefValue = "";

            // state
            $this->state->HrefValue = "";

            // country
            $this->country->HrefValue = "";

            // website
            $this->website->HrefValue = "";

            // currency_code
            $this->currency_code->HrefValue = "";

            // enabled
            $this->enabled->HrefValue = "";

            // reference
            $this->reference->HrefValue = "";

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
        if ($this->id->Visible && $this->id->Required) {
            if (!$this->id->IsDetailKey && EmptyValue($this->id->FormValue)) {
                $this->id->addErrorMessage(str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
            }
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
        if ($this->name->Visible && $this->name->Required) {
            if (!$this->name->IsDetailKey && EmptyValue($this->name->FormValue)) {
                $this->name->addErrorMessage(str_replace("%s", $this->name->caption(), $this->name->RequiredErrorMessage));
            }
        }
        if ($this->_email->Visible && $this->_email->Required) {
            if (!$this->_email->IsDetailKey && EmptyValue($this->_email->FormValue)) {
                $this->_email->addErrorMessage(str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
            }
        }
        if ($this->user_id->Visible && $this->user_id->Required) {
            if (!$this->user_id->IsDetailKey && EmptyValue($this->user_id->FormValue)) {
                $this->user_id->addErrorMessage(str_replace("%s", $this->user_id->caption(), $this->user_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->user_id->FormValue)) {
            $this->user_id->addErrorMessage($this->user_id->getErrorMessage(false));
        }
        if ($this->tax_number->Visible && $this->tax_number->Required) {
            if (!$this->tax_number->IsDetailKey && EmptyValue($this->tax_number->FormValue)) {
                $this->tax_number->addErrorMessage(str_replace("%s", $this->tax_number->caption(), $this->tax_number->RequiredErrorMessage));
            }
        }
        if ($this->phone->Visible && $this->phone->Required) {
            if (!$this->phone->IsDetailKey && EmptyValue($this->phone->FormValue)) {
                $this->phone->addErrorMessage(str_replace("%s", $this->phone->caption(), $this->phone->RequiredErrorMessage));
            }
        }
        if ($this->address->Visible && $this->address->Required) {
            if (!$this->address->IsDetailKey && EmptyValue($this->address->FormValue)) {
                $this->address->addErrorMessage(str_replace("%s", $this->address->caption(), $this->address->RequiredErrorMessage));
            }
        }
        if ($this->city->Visible && $this->city->Required) {
            if (!$this->city->IsDetailKey && EmptyValue($this->city->FormValue)) {
                $this->city->addErrorMessage(str_replace("%s", $this->city->caption(), $this->city->RequiredErrorMessage));
            }
        }
        if ($this->zip_code->Visible && $this->zip_code->Required) {
            if (!$this->zip_code->IsDetailKey && EmptyValue($this->zip_code->FormValue)) {
                $this->zip_code->addErrorMessage(str_replace("%s", $this->zip_code->caption(), $this->zip_code->RequiredErrorMessage));
            }
        }
        if ($this->state->Visible && $this->state->Required) {
            if (!$this->state->IsDetailKey && EmptyValue($this->state->FormValue)) {
                $this->state->addErrorMessage(str_replace("%s", $this->state->caption(), $this->state->RequiredErrorMessage));
            }
        }
        if ($this->country->Visible && $this->country->Required) {
            if (!$this->country->IsDetailKey && EmptyValue($this->country->FormValue)) {
                $this->country->addErrorMessage(str_replace("%s", $this->country->caption(), $this->country->RequiredErrorMessage));
            }
        }
        if ($this->website->Visible && $this->website->Required) {
            if (!$this->website->IsDetailKey && EmptyValue($this->website->FormValue)) {
                $this->website->addErrorMessage(str_replace("%s", $this->website->caption(), $this->website->RequiredErrorMessage));
            }
        }
        if ($this->currency_code->Visible && $this->currency_code->Required) {
            if (!$this->currency_code->IsDetailKey && EmptyValue($this->currency_code->FormValue)) {
                $this->currency_code->addErrorMessage(str_replace("%s", $this->currency_code->caption(), $this->currency_code->RequiredErrorMessage));
            }
        }
        if ($this->enabled->Visible && $this->enabled->Required) {
            if ($this->enabled->FormValue == "") {
                $this->enabled->addErrorMessage(str_replace("%s", $this->enabled->caption(), $this->enabled->RequiredErrorMessage));
            }
        }
        if ($this->reference->Visible && $this->reference->Required) {
            if (!$this->reference->IsDetailKey && EmptyValue($this->reference->FormValue)) {
                $this->reference->addErrorMessage(str_replace("%s", $this->reference->caption(), $this->reference->RequiredErrorMessage));
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

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
        }

        // Set new row
        $rsnew = [];

        // company_id
        $this->company_id->setDbValueDef($rsnew, $this->company_id->CurrentValue, $this->company_id->ReadOnly);

        // type
        $this->type->setDbValueDef($rsnew, $this->type->CurrentValue, $this->type->ReadOnly);

        // name
        $this->name->setDbValueDef($rsnew, $this->name->CurrentValue, $this->name->ReadOnly);

        // email
        $this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, $this->_email->ReadOnly);

        // user_id
        $this->user_id->setDbValueDef($rsnew, $this->user_id->CurrentValue, $this->user_id->ReadOnly);

        // tax_number
        $this->tax_number->setDbValueDef($rsnew, $this->tax_number->CurrentValue, $this->tax_number->ReadOnly);

        // phone
        $this->phone->setDbValueDef($rsnew, $this->phone->CurrentValue, $this->phone->ReadOnly);

        // address
        $this->address->setDbValueDef($rsnew, $this->address->CurrentValue, $this->address->ReadOnly);

        // city
        $this->city->setDbValueDef($rsnew, $this->city->CurrentValue, $this->city->ReadOnly);

        // zip_code
        $this->zip_code->setDbValueDef($rsnew, $this->zip_code->CurrentValue, $this->zip_code->ReadOnly);

        // state
        $this->state->setDbValueDef($rsnew, $this->state->CurrentValue, $this->state->ReadOnly);

        // country
        $this->country->setDbValueDef($rsnew, $this->country->CurrentValue, $this->country->ReadOnly);

        // website
        $this->website->setDbValueDef($rsnew, $this->website->CurrentValue, $this->website->ReadOnly);

        // currency_code
        $this->currency_code->setDbValueDef($rsnew, $this->currency_code->CurrentValue, $this->currency_code->ReadOnly);

        // enabled
        $tmpBool = $this->enabled->CurrentValue;
        if ($tmpBool != "1" && $tmpBool != "0") {
            $tmpBool = !empty($tmpBool) ? "1" : "0";
        }
        $this->enabled->setDbValueDef($rsnew, $tmpBool, $this->enabled->ReadOnly);

        // reference
        $this->reference->setDbValueDef($rsnew, $this->reference->CurrentValue, $this->reference->ReadOnly);

        // created_from
        $this->created_from->setDbValueDef($rsnew, $this->created_from->CurrentValue, $this->created_from->ReadOnly);

        // created_by
        $this->created_by->setDbValueDef($rsnew, $this->created_by->CurrentValue, $this->created_by->ReadOnly);

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

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);
        if ($updateRow) {
            if (count($rsnew) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($rsnew, "", $rsold);
                if (!$editRow && !EmptyValue($this->DbErrorMessage)) { // Show database error
                    $this->setFailureMessage($this->DbErrorMessage);
                }
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("UpdateCancelled"));
            }
            $editRow = false;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_EDIT_ACTION"), $table => $row]);
        }
        return $editRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ContactsList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
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
                case "x_enabled":
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

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        $pageNo = Get(Config("TABLE_PAGE_NUMBER"));
        $startRec = Get(Config("TABLE_START_REC"));
        $infiniteScroll = false;
        $recordNo = $pageNo ?? $startRec; // Record number = page number or start record
        if ($recordNo !== null && is_numeric($recordNo)) {
            $this->StartRecord = $recordNo;
        } else {
            $this->StartRecord = $this->getStartRecordNumber();
        }

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || intval($this->StartRecord) <= 0) { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
        }
        if (!$infiniteScroll) {
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Get page count
    public function pageCount() {
        return ceil($this->TotalRecords / $this->DisplayRecords);
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
